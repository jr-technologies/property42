<?php

namespace App\DB\Providers\SQL\Factories\Factories\PropertyDocument;

/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/6/2016
 * Time: 9:58 AM
 */

use App\DB\Providers\SQL\Factories\Factories\PropertyDocument\Gateways\PropertyDocumentQueryBuilder;
use App\DB\Providers\SQL\Factories\SQLFactory;
use App\DB\Providers\SQL\Interfaces\SQLFactoriesInterface;
use App\DB\Providers\SQL\Models\PropertyDocument;

class PropertyDocumentFactory extends SQLFactory implements SQLFactoriesInterface
{
    private $tableGateway = null;
    public function __construct()
    {
        $this->model = new PropertyDocument();
        $this->tableGateway = new PropertyDocumentQueryBuilder();
    }

    function find($id)
    {
        return $this->map($this->tableGateway->find($id));
    }
    function all()
    {
       return $this->mapCollection($this->tableGateway->all());
    }
    public function update(propertyDocument $document)
    {
        $document->updatedAt = date('Y-m-d h:i:s');
        return $this->tableGateway->update($document->id ,$this->mapPropertyDocumentsOnTable($document));
    }
    public function store(propertyDocument $document)
    {
        $document->createdAt = date('Y-m-d h:i:s');
        return $this->tableGateway->insert($this->mapPropertyDocumentsOnTable($document));
    }
    public function delete(propertyDocument $document)
    {
        return $this->tableGateway->delete($document->id);
    }
    public function getBId(propertyDocument $document)
    {
        return $this->tableGateway->find($document->id);
    }
    public function storeMultiple(array $propertyDocuments)
    {
        return $this->tableGateway->insertMultiple($this->mapCollection($propertyDocuments));
    }
    private function mapPropertyDocumentsOnTable(propertyDocument $document)
    {
        return [
            'property_id' => $document->propertyId,
            'type'=>$document->type,
            'path'=>$document->path,
            'updated_at' => $document->updatedAt,
        ];
    }
    public function updateWhere(array $where, array $data)
    {
        return $this->tableGateway->updateWhere($where, $data);
    }

   function map($result)
    {
        $document  = new propertyDocument();
        $document->id = $result->id;
        $document->propertyId = $result->property_id;
        $document->type = $result->type;
        $document->path = $result->path;
        $document->createdAt = $result->created_at;
        $document->updatedAt = $result->updated_at;
        return $document;
    }
    public function deleteByProperty(propertyDocument $propertyDocument)
    {
        return $this->tableGateway->deleteWhere(['property_id'=>$propertyDocument->id]);
    }
    public function getTable()
    {
        return $this->tableGateway->getTable();
    }
    public function getByProperty(propertyDocument $propertyDocument)
    {
        return $this->tableGateway->getWhere(['property_id'=>$propertyDocument->id]);
    }
    private function setTable($table)
    {
        $this->tableGateway->setTable($table);
    }
}