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
use App\Http\Requests\Requests\Property\AddPropertyRequest;
use App\Http\Requests\Requests\Property\CountPropertiesRequest;
use App\Http\Requests\Requests\Property\DeletePropertyRequest;
use App\Http\Requests\Requests\Property\GetUserPropertiesRequest;
use App\Http\Requests\Requests\Property\UpdatePropertyRequest;
use App\Http\Responses\Responses\ApiResponse;
use App\Libs\File\FileRelease;
use App\Libs\Helpers\Helper;
use App\Libs\Json\Creators\Creators\Property\PropertyJsonCreator;
use App\Repositories\Providers\Providers\PropertiesJsonRepoProvider;
use App\Repositories\Providers\Providers\PropertiesRepoProvider;
use App\Repositories\Repositories\Sql\PropertyDocumentsRepository;
use App\Repositories\Repositories\Sql\PropertyFeatureValuesRepository;
use App\Traits\PropertyFilesReleaser;
use App\Transformers\Response\PropertyJson\PropertyJsonTransformer;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\File;

class PropertiesController extends ApiController
{
    use \App\Traits\Property\PropertyFilesReleaser;

    private $properties = null;
    private $propertyFeatureValues = null;
    public $response = null;
    private $propertyDocuments = null;
    private $userProperties = null;
    private $propertyJsonTransformer = null;
    /**
     * @param PropertiesRepoProvider $repoProvider
     * @param ApiResponse $response
     */
    public function __construct(PropertiesRepoProvider $repoProvider,ApiResponse $response)
    {
        $this->properties = $repoProvider->repo();
        $this->response = $response;
        $this->propertyFeatureValues = new PropertyFeatureValuesRepository();
        $this->propertyDocuments = new PropertyDocumentsRepository();
        $this->userProperties= (new PropertiesJsonRepoProvider())->repo();
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
        ]]);

    }

    public function update(UpdatePropertyRequest $request)
    {
        $property = $request->getPropertyModel();
        $this->properties->update($property);
        $this->propertyFeatureValues->updatePropertyFeatures($property->id, $request->getFeaturesValues($property->id));
        $this->updatePropertyFiles($request->getFiles(), $this->inStoragePropertyDocPath($property), $property->id);
        Event::fire(new PropertyUpdated($property));
        return $this->response->respond(['data'=>[
            'property'=>$property
        ]]);
    }

    public function delete(DeletePropertyRequest $request)
    {
        $property = $request->getPropertyModel();
        $this->properties->delete($property);
        $userProperties = $this->userProperties->getUserProperties($request->get('searchParams'));
        $countUserSearchProperties = $this->userProperties->countSearchedUserProperties($request->get('searchParams'));
        $propertiesCounts  = $this->properties->countProperties($request->get('searchParams')['ownerId']);
        Event::fire(new PropertyUpdated($property));
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
        return $this->response->respond(['data'=>[
            'property'=>$property
        ]]);
    }

    public function getUserProperties(GetUserPropertiesRequest $request)
    {
        $properties = $this->releasePropertiesJsonFiles($this->userProperties->getUserProperties($request->all()));
        return $this->response->respond(['data' => [
            'properties' => $this->propertyJsonTransformer->transformCollection($properties),
        ]]);
    }

    public function updatePropertyFiles(array $files, $path, $propertyId)
    {
        $this->deletePropertyFiles($files);
        $this->storeFiles($files, $path, $propertyId);
    }

    public function deletePropertyFiles(array $files)
    {
        $ids = [];
        foreach($files as $file){ $ids[] = $file['id']; }
        $previousDocuments = $this->propertyDocuments->getByIds($ids);
        foreach($previousDocuments as $document /* @var $document PropertyDocument::class */)
        {
            File::delete(storage_path('app/').$document->path);
        }
        $this->propertyDocuments->deleteByIds($ids);
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
        return md5(rand(1,10));
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
}