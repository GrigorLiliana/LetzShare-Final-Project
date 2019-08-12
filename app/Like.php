<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
   protected $primarykey = 'like_id';

  /*  protected function setKeysForSaveQuery(Builder $query)
    {
        $query
            ->where('user_id', '=', $this->getAttribute('user_id'))
            ->where('category_id', '=', $this->getAttribute('category_id'));
        return $query;
    }*/
}
