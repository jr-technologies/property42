<?php
/**
 * Created by PhpStorm.
 * User: JR Tech
 * Date: 3/16/2016
 * Time: 9:59 AM
 */

namespace App\Repositories\Interfaces\Repositories;


interface UsersJsonRepoInterface
{
    function find($id);
    function all();
    function search();

    function update($user);
    function delete($id);
    function store($user);
}