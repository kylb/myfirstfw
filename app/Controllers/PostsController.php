<?php
namespace App\Controllers;
use Core\BaseController;
use Core\Container;
use Core\Redirect;
use Core\Session;

class PostsController extends BaseController
{
    private $post;

    public function __construct() {
        parent::__construct();
        $this->post = Container::newModel('Post');
    }

    public function index(){
        if(Session::get('success')){
            $this->view->success = Session::get('success');
            Session::destroy('success');
        }
        if(Session::get('errors')){
            $this->view->errors = Session::get('errors');
            Session::destroy('errors');
        }
        $this->view->nome = "Posts";
        $this->setPageTitle($this->view->nome);
        $this->view->posts = $this->post->all();
        $this->renderView("posts/index","layout");
    }

    public function show($id){
        $this->view->nome = "Post";
        $this->setPageTitle("{$this->view->post->title}");
        $this->view->post = $this->post->find($id);
        $this->renderView("posts/show","layout");
    }

    public function create(){
        $this->view->nome = "New Post";
        $this->setPageTitle($this->view->nome);
        $this->renderView("posts/create","layout");
    }

    public function store($request){
        $data = [
            'title' => $request->post->title,
            'content' => $request->post->content
        ];
        if($this->post->create($data)){
            return Redirect::route('/posts', [
                'success' => ['Post created with success.']
            ]);
        } else{
            return Redirect::route('/posts', [
                'errors' => ['Error: Post was not created.']
            ]);
        }
    }

    public function edit($id){
        $this->view->nome = "Edit Post";
        $this->setPageTitle("{$this->view->nome } {$this->view->post->title}");
        $this->view->post = $this->post->find($id);
        $this->renderView("posts/edit","layout");
    }

    public function update($id,$request){
        $data = [
            'title' => $request->post->title,
            'content' => $request->post->content
        ];
        if($this->post->update($data,$id)){
            return Redirect::route('/posts', [
                'success' => ['Post updated with success.']
            ]);
        } else{
            return Redirect::route('/posts', [
                'errors' => ['Error: Post was not updated.']
            ]);
        }
    }

    public function delete($id){
        if($this->post->delete($id)){
            Redirect::route('/posts', [
                'success' => ['Post deleted with success.']
            ]);
        } else{
            return Redirect::route('/posts', [
                'errors' => ['Error: Post was not deleted.']
            ]);
        }
    }
}
