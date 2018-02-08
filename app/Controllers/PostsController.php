<?php
namespace App\Controllers;
use Core\BaseController;

class PostsController extends BaseController
{
    public function index(){
        $this->setPageTitle('Posts');
        $this->view->nome = "Powered by: Kylb";
        $this->renderView("posts/index","layout");
    }
    public function show($param,$request){
        echo "Ola Mundo: Post ". $param . "<br />";
        echo $request->get->nome;
    }
}
