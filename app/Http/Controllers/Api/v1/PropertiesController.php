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
use App\Http\Requests\Requests\Property\DeletePropertyRequest;
use App\Http\Requests\Requests\Property\GetUserPropertiesRequest;
use App\Http\Requests\Requests\Property\UpdatePropertyRequest;
use App\Http\Responses\Responses\ApiResponse;
use App\Repositories\Providers\Providers\PropertiesJsonRepoProvider;
use App\Repositories\Providers\Providers\PropertiesRepoProvider;
use App\Repositories\Repositories\Sql\PropertyDocumentsRepository;
use App\Repositories\Repositories\Sql\PropertyFeatureValuesRepository;
use Illuminate\Support\Facades\Event;

class PropertiesController extends ApiController

{
    private $properties = null;
    private $propertyFeatureValues = null;
    public $response = null;
    private $propertyDocuments = null;
    private $userProperties = null;

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
        Event::fire(new PropertyUpdated($property));
        return $this->response->respond(['data'=>['property'=>
            $property]]);

    }
    public function delete(DeletePropertyRequest $property)
    {
        $property = $property->getPropertyModel();
        $this->properties->delete($property);
        Event::fire(new PropertyDeleted($property));
        return $this->response->respond(['data'=>['property'=>
               $property]]);
    }
    public function getUserProperties(GetUserPropertiesRequest $request)
    {
        return $this->response->respond(['data' => [
            'properties' => $this->userProperties->getUserProperties($request->all()),
        ]]);
    }

    public function storeFiles(array $files, $path, $propertyId)
    {
        $propertyDocuments = [];
        foreach($files as $file)
        {
            $document = new PropertyDocument();
            $document->path = $this->storeFileInDirectory($file['file'], $path);
            $document->propertyId = $propertyId;
            $document->type = 'image';
            $document->title = isset($file['title'])?$file['title']:'';
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

    private function getSecureFileName($file)
    {
        return md5(rand(1,10));
    }

    private function inStoragePropertyDocPath(Property $property)
    {
        return 'users/'.md5($property->ownerId).'/properties/'.md5($property->id);
    }
}