<?php
namespace App\Controllers;
use Core\BaseController;
use Core\Container;
use Core\Redirect;
use Core\BaseModel;

class PostsController extends BaseController
{
    private $post;

    public function __construct() {
        parent::__construct();
        $this->post = Container::newModel('Post');
    }

    public function index(){
        $this->setPageTitle('Posts');
        $this->view->nome = "Powered by: Kylb";
        $this->view->posts = $this->post->all();
        $this->renderView("posts/index","layout");
    }

    public function show($id){
        $this->view->nome = "Powered by: Kylb - Post";
        $this->view->post = $this->post->find($id);
        $this->setPageTitle("{$this->view->post->title}");
        $this->renderView("posts/show","layout");
    }

    public function create(){
        $this->view->nome = "Powered by: Kylb - New Post";
        $this->setPageTitle("New Post");
        $this->renderView("posts/create","layout");
    }

    public function store($request){
        $data = [
            'title' => $request->post->title,
            'content' => $request->post->content
        ];
        if($this->post->create($data)){
            Redirect::route('/posts');
        } else{
            echo "Erro ao criar post.";
        }
    }

    public function edit($id){
        $this->view->nome = "Powered by: Kylb - Edit Post";
        $this->view->post = $this->post->find($id);
        $this->setPageTitle("Edit Post {$this->view->post->title}");
        $this->renderView("posts/edit","layout");
    }

    public function update($id,$request){
        $data = [
            'title' => $request->post->title,
            'content' => $request->post->content
        ];
        if($this->post->update($data,$id)){
            Redirect::route('/posts');
        } else{
            echo "Erro ao editar post.";
        }
    }

    public function delete($id){
        if($this->post->delete($id)){
            Redirect::route('/posts');
        } else{
            echo "Erro ao deletar post.";
        }
    }
}
