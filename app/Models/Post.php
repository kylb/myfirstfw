<?php
namespace App\Models;
use Core\BaseModel;

class Post extends BaseModel {

    protected $table = 'posts';

    public function rules(){
        return [
            'title' => 'max:140|required',
            'content' => 'min:10|max:900'
        ];
    }



}