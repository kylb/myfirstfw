<?php
namespace App\Models;
//use Core\BaseModel;
use Core\BaseModelEloquent;

class User extends BaseModelEloquent{
    public $table = 'users';
    public $timestamp = false;
    protected $fillable = ['name', 'email','password'];

    public function rules(){
        return [
            'name' => 'max:255',
            'email' => 'email'
        ];
    }
}