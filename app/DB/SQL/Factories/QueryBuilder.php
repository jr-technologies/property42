<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 4/1/2016
 * Time: 9:28 PM
 */
namespace App\DB\SQL\Factories;

use Illuminate\Support\Facades\DB;

abstract class QueryBuilder {
    protected $table = "";
    protected $fillable = [];
    protected $model = null;
    public function __construct(){}

    public function first(array $where)
    {
        $user = DB::table($this->table)->where($where)->first();
        return $user;
    }

    protected function find($id)
    {
        return $this->map($this->first(['id'=>$id]));
    }

    public function insert(array $record)
    {

    }

    public function all()
    {
        return [];
    }

    public function get()
    {
        return $this->all();
    }

    public function map($result)
    {
        $vars = get_object_vars($this->model);
        foreach($vars as $var => $defaultValue)
        {
            $this->model->$var = $result->$var;
        }
        return $this->model;
    }

    public function mapCollection(array $results)
    {
        return array_map([$this, 'map'], $results);
    }
}