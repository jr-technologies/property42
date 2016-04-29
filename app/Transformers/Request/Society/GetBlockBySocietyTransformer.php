<?php
namespace App\Transformers\Request\Society;

use App\Transformers\Request\RequestTransformer;

class GetBlockBySocietyTransformer extends RequestTransformer
{
 public function transform()
 {
     return [
         'societyId'=>$this->request->input('society_id'),

     ];
 }
    }