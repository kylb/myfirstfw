<?php
namespace App\Controllers;
use Core\BaseController;
use Core\Container;

class PostsController extends BaseController
{
    public function index(){
        $this->setPageTitle('Posts');
        $model = Container::newModel('Post');
        $this->view->nome = "Powered by: Kylb";
        $this->view->posts = $model->all();
        $this->renderView("posts/index","layout");
    }
    public function show($param,$request){
        $model = Container::newModel('Post');
        $this->view->nome = "Powered by: Kylb - Post";
        $this->view->post = $model->getPost($param);
        $this->setPageTitle("{$this->view->post->title}");
        $this->renderView("posts/show","layout");
    }
}
