<?php
namespace App\Models;
use Core\BaseModel;
use Core\BaseModelEloquent;
class Post extends BaseModelEloquent {

    public $table = 'posts';
    public $timestamps = false;
    protected $fillable = ['title', 'content'];

    public function rules(){
        return [
            'title' => 'max:255|min:5',
            'content' => 'min:10'
        ];
    }
}