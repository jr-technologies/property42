<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 3/16/2016
 * Time: 9:57 AM
 */

namespace App\Repositories\Repositories\Sql;

use App\DB\Providers\SQL\Factories\Factories\PropertyDocument\PropertyDocumentFactory;
use App\Repositories\Interfaces\Repositories\AgenciesRepoInterface;

class PropertyDocumentRepository extends SqlRepository implements AgenciesRepoInterface
{
    public $factory;
    public function __construct()
    {
        $this->factory = new PropertyDocumentFactory();
    }
    public function storeMultiple(array $propertyDocuments)
    {
        return $this->factory->storeMultiple($propertyDocuments);
    }
}
