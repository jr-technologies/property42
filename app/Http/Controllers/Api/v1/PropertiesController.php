<?php
/**
 * Created by WAQAS.
 * User: waqas
 * Date: 4/7/2016
 * Time: 11:10 AM
 */
namespace App\Http\Controllers\Api\V1;

use App\DB\Providers\SQL\Models\Property;
use App\DB\Providers\SQL\Models\PropertyDocument;
use App\Events\Events\Property\PropertyCreated;
use App\Events\Events\Property\PropertyDeleted;
use App\Events\Events\Property\PropertyUpdated;
use App\Http\Requests\Requests\AddToFavourite\AddToFavouriteRequest;
use App\Http\Requests\Requests\Property\AddPropertyRequest;
use App\Http\Requests\Requests\Property\CountPropertiesRequest;
use App\Http\Requests\Requests\Property\DeleteMultiplePropertiesRequest;
use App\Http\Requests\Requests\Property\DeletePropertyRequest;
use App\Http\Requests\Requests\Property\GetFavouritePropertyRequest;
use App\Http\Requests\Requests\Property\GetUserPropertiesRequest;
use App\Http\Requests\Requests\Property\RestorePropertyRequest;
use App\Http\Requests\Requests\Property\SearchPropertiesRequest;
use App\Http\Requests\Requests\Property\UpdatePropertyRequest;
use App\Http\Responses\Responses\ApiResponse;
use App\Libs\Helpers\Helper;
use App\Repositories\Providers\Providers\PropertiesJsonRepoProvider;
use App\Repositories\Providers\Providers\PropertiesRepoProvider;
use App\Repositories\Repositories\Sql\PropertyDocumentsRepository;
use App\Repositories\Repositories\Sql\PropertyFeatureValuesRepository;
use App\Traits\PropertyFilesReleaser;
use App\Transformers\Response\PropertyJson\PropertyJsonTransformer;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Request;

class PropertiesController extends ApiController
{
    use \App\Traits\Property\PropertyFilesReleaser;

    private $properties = null;
    private $propertyFeatureValues = null;
    public $response = null;
    private $propertyDocuments = null;
    private $propertiesJsonRepo = null;
    private $propertyJsonTransformer = null;
    private $propertyRepo = null;
    /**
     * @param PropertiesRepoProvider $repoProvider
     * @param ApiResponse $response
     */
    public function __construct(PropertiesRepoProvider $repoProvider,ApiResponse $response)
    {
        $this->properties = $repoProvider->repo();
        $this->propertyRepo = (new PropertiesRepoProvider())->repo();
        $this->response = $response;
        $this->propertyFeatureValues = new PropertyFeatureValuesRepository();
        $this->propertyDocuments = new PropertyDocumentsRepository();
        $this->propertiesJsonRepo= (new PropertiesJsonRepoProvider())->repo();
        $this->propertyJsonTransformer = new PropertyJsonTransformer();
    }

    public function store(AddPropertyRequest $request)
    {
        $property = $request->getPropertyModel();
        $propertyId = $this->properties->store($property);
        $this->propertyFeatureValues->storeMultiple($request->getFeaturesValues($propertyId));

        $property->id = $propertyId;
        $this->storeFiles($request->getFiles(), $this->inStoragePropertyDocPath($property), $propertyId);
        $property = $this->properties->getById($propertyId);
        Event::fire(new PropertyCreated($property));
        return $this->response->respond(['data' => [
            'property' => $property,
            'features' => $request->getFeaturesValues($propertyId),
            'propertiesCounts' => $this->properties->countProperties($request->user()->id)
        ]]);
    }
    public function getFavouriteProperties(GetFavouritePropertyRequest $request)
    {
        $params = $request->all();
        $favouriteProperties = $this->propertiesJsonRepo->getFavouriteProperties($params);
        $totalCount = count($favouriteProperties);
        return $this->response->respond(['data'=>[
            'properties'=>$favouriteProperties,
            'favouritesCount'=>$totalCount
        ]]);
    }
    public function update(UpdatePropertyRequest $request)
    {
        $property = $request->getPropertyModel();
        $this->properties->update($property);
        $this->propertyFeatureValues->updatePropertyFeatures($property->id, $request->getFeaturesValues($property->id));
        $this->updatePropertyFiles($request->getFiles(), $this->inStoragePropertyDocPath($property), $property->id);
        if(is_array($request->get('deletedFiles'))){$this->deleteByIds($request->get('deletedFiles'));}
        Event::fire(new PropertyUpdated($property));
        return $this->response->respond(['data'=>[
            'property'=>$this->releasePropertiesJsonFiles($this->propertiesJsonRepo->getUserProperties(['propertyId'=>$property->id]))[0]
        ]]);
    }

    public function delete(DeletePropertyRequest $request)
    {
        $property = $request->getPropertyModel();
        $this->properties->delete($property);
        Event::fire(new PropertyUpdated($property));

        $userProperties = $this->propertiesJsonRepo->getUserProperties($request->get('searchParams'));
        $countUserSearchProperties = $this->propertiesJsonRepo->countSearchedUserProperties($request->get('searchParams'));
        $propertiesCounts  = $this->properties->countProperties($request->get('searchParams')['ownerId']);
        return $this->response->respond(['data'=>[
            'property'=>$property,
            'totalProperties'=>$countUserSearchProperties,
            'propertiesCounts' => $propertiesCounts,
            'properties'=>$userProperties
        ]]);
    }

    public function forceDelete(DeletePropertyRequest $request)
    {
        $property = $request->getPropertyModel();
        $this->properties->forceDelete($property);
        Event::fire(new PropertyDeleted($property));
        $userProperties = $this->propertiesJsonRepo->getUserProperties($request->get('searchParams'));
        $countUserSearchProperties = $this->propertiesJsonRepo->countSearchedUserProperties($request->get('searchParams'));
        $propertiesCounts  = $this->properties->countProperties($request->get('searchParams')['ownerId']);
        return $this->response->respond(['data'=>[
            'property'=>$property,
            'totalProperties'=>$countUserSearchProperties,
            'propertiesCounts' => $propertiesCounts,
            'properties'=>$userProperties
        ]]);
    }

    public function multiDelete(DeleteMultiplePropertiesRequest $request)
    {
        $propertyIds = $request->get('propertyIds');
        $this->properties->deleteByIds($propertyIds);
        $userProperties = $this->propertiesJsonRepo->getUserProperties($request->get('searchParams'));
        $countUserSearchProperties = $this->propertiesJsonRepo->countSearchedUserProperties($request->get('searchParams'));
        $propertiesCounts  = $this->properties->countProperties($request->get('searchParams')['ownerId']);
        return $this->response->respond(['data'=>[
            'totalProperties'=>$countUserSearchProperties,
            'propertiesCounts' => $propertiesCounts,
            'properties'=>$userProperties
        ]]);
    }
    public function multiForceDelete()
    {
        return $this->response->respond(['data'=>[
            'totalProperties'=>rand(10,200),
            'propertiesCounts' => (object)[],
            'properties'=>[]
        ]]);
    }

    public function restore(RestorePropertyRequest $request)
    {
        $this->propertyRepo->restoreProperty($this->propertyRepo->getById($request->get('propertyId')));
        $userProperties = $this->propertiesJsonRepo->getUserProperties($request->get('searchParams'));
        $countUserSearchProperties = $this->propertiesJsonRepo->countSearchedUserProperties($request->get('searchParams'));
        $propertiesCounts  = $this->properties->countProperties($request->get('searchParams')['ownerId']);
        return $this->response->respond(['data'=>[
            'property'=>$this->propertiesJsonRepo->getById($request->get('propertyId')),
            'totalProperties'=>$countUserSearchProperties,
            'propertiesCounts' => $propertiesCounts,
            'properties'=>$userProperties
        ]]);
    }

    public function getUserProperties(GetUserPropertiesRequest $request)
    {
        $properties = $this->releaseAllPropertiesFiles($this->propertiesJsonRepo->getUserProperties($request->all()));
        return $this->response->respond(['data' => [
            'properties' => $this->propertyJsonTransformer->transformCollection($properties),
            'totalProperties' => $this->propertiesJsonRepo->countSearchedUserProperties($request->all())
        ]]);
    }

    public function updatePropertyFiles(array $files, $path, $propertyId)
    {
        $deletableFiles = [];
        $storableFiles = [];
        foreach($files as $key=>$file)
        {
            if($file['file'] != 'null')
            {
                $storableFiles[$key] = $file;
                $deletableFiles[$key] = $file;
            }
        }
        $this->deletePropertyFiles($deletableFiles);
        $this->storeFiles($storableFiles, $path, $propertyId);
        $this->updateFilesPath($files);
    }

    public function updateFilesPath(array $files)
    {
        $ids = [];
        foreach($files as $file){ $ids[] = $file['id']; }
        $previousDocuments = $this->propertyDocuments->getByIds($ids);
        $updateableDocuments = [];
        foreach($previousDocuments as $pDocument)
        {
            foreach($files as $file){
                if($pDocument->id == $file['id'] && $pDocument->title != $file['title']){
                    $pDocument->title = $file['title'];
                    $updateableDocuments[] = $pDocument;
                }
            }
        }
        foreach($updateableDocuments as $document)
        {
            $this->propertyDocuments->update($document);
        }
    }
    public function deletePropertyFiles(array $files)
    {
        $ids = [];
        foreach($files as $file){ $ids[] = $file['id']; }
        $previousDocuments = $this->propertyDocuments->getByIds($ids);
        $this->deleteDocuments($previousDocuments);
    }

    public function deleteByIds(array $ids)
    {
        return $this->deleteDocuments($this->propertyDocuments->getByIds($ids));
    }

    public function deleteDocuments(array $documents)
    {
        $ids = Helper::propertyToArray($documents, 'id');
        foreach($documents as $document /* @var $document PropertyDocument::class */)
        {
            File::delete(storage_path('app/').$document->path);
        }
        return $this->propertyDocuments->deleteByIds($ids);
    }

    public function storeFiles(array $files, $path, $propertyId)
    {
        $propertyDocuments = [];
        foreach($files as $key => $file)
        {
            $document = new PropertyDocument();
            $document->path = $this->storeFileInDirectory($file['file'], $path);
            $document->propertyId = $propertyId;
            $document->type = 'image';
            $document->title = isset($file['title'])?$file['title']:'';
            $document->main = ($key == 'mainFile')?true:false;
            $propertyDocuments[] = $document;
        }
        return $this->propertyDocuments->storeMultiple($propertyDocuments);
    }

    public function storeFileInDirectory($file, $path)
    {
        $secureName = $this->getSecureFileName($file).'.'.$file->getClientOriginalExtension();
        $file->move(storage_path('app/').$path, $secureName);
        return $path.'/'.$secureName;
    }

    /**
     * @param $file
     * @return string
     */
    private function getSecureFileName($file)
    {
        return str_replace('.', '-',urlencode(bcrypt($file->getClientOriginalName())));
    }

    private function inStoragePropertyDocPath(Property $property)
    {
        return 'users/'.md5($property->ownerId).'/properties/'.md5($property->id);
    }

    public function countProperties(CountPropertiesRequest $countPropertiesRequest)
    {
        $user = $countPropertiesRequest->getUserModel();
        return $this->response->respond(['data'=>[
            'counts'=>$this->properties->countProperties($user->id)]]);
    }
    public function favouriteProperty(AddToFavouriteRequest $request)
    {
        return $this->response->respond(['data'=>[
            'favouriteProperty'=>$this->properties->favouriteProperty($request->favouriteProperty())]]);
    }
    public function search(SearchPropertiesRequest $request)
    {
        return $this->propertiesJsonRepo->search($request->getParams());
    }
}