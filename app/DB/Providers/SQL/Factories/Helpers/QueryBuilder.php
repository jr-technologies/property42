<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 4/1/2016
 * Time: 9:28 PM
 */
namespace App\DB\Providers\SQL\Factories\Helpers;

use Illuminate\Support\Facades\DB;

abstract class QueryBuilder {
    protected $table = "";
    public function __construct(){}

    public function first(array $where)
    {
        $result = DB::table($this->table)->where($where)->first();
        return $result;
    }

    public function findBy($column, $value)
    {
        return $this->first([$column => $value]);
    }

    public function find($id)
    {
        return $this->first(['id'=>$id]);
    }

    public function insert(array $record)
    {
        return DB::table($this->table)->insertGetId($record);
    }

    public function insertMultiple(array $records)
    {
        return DB::table($this->table)->insert($records);
    }

    public function update($id, $data)
    {
        return $this->updateWhere(['id' => $id], $data);
    }
    public function updateWhere(array $conditions, array $data)
    {
        $query = DB::table($this->table);
        foreach($conditions as $column => $value)
        {
            $query = $query->where($column,$value);
        }
        return $query->update($data);
    }

    public function all()
    {
        return DB::table($this->table)->get();
    }

    public function get()
    {
        return $this->all();
    }
}