<?php
namespace App\Controllers;
use App\Models\Post;
use Core\BaseController;
use Core\Redirect;
use Core\Validator;

class PostsController extends BaseController
{
    private $post;

    public function __construct() {
        parent::__construct();
        $this->post = new Post;
    }

    public function index(){
        $this->view->nome = "Posts";
        $this->setPageTitle($this->view->nome);
        $this->view->posts = $this->post->all();
        $this->renderView("posts/index","layout");
    }

    public function show($id){
        $this->view->nome = "Post";
        $this->view->post = $this->post->find($id);
        $this->setPageTitle("{$this->view->post->title}");
        $this->renderView("posts/show","layout");
    }

    public function create(){
        $this->view->nome = "New Post";
        $this->setPageTitle($this->view->nome);
        $this->renderView("posts/create","layout");
    }

    public function edit($id){
        $this->view->nome = "Edit Post";
        $this->view->post = $this->post->find($id);
        $this->setPageTitle("{$this->view->nome} - {$this->view->post->title}");
        $this->renderView("posts/edit","layout");
    }

    public function store($request)
    {
        $data = [
            'title' => $request->post->title,
            'content' => $request->post->content
        ];

        if(Validator::make($data,$this->post->rules())){
            return Redirect::route("/post/create");
        }
        try{
            $this->post->create($data);
            Redirect::route('/posts', [
                'success' => ['Post created with success.']
            ]);
        }catch(\Exception $e){
            Redirect::route('/posts', [
                'errors' => [$e->getMessage()]
            ]);
        }

        /*
         * Usando BaseModel
         * else {
            if ($this->post->create($data)) {
                Redirect::route('/posts', [
                    'success' => ['Post created with success.']
                ]);
            } else {
                Redirect::route('/posts', [
                    'errors' => ['Error: Post was not created.']
                ]);
            }
        }*/
    }

    public function update($id,$request){
        $data = [
            'title' => $request->post->title,
            'content' => $request->post->content
        ];
        /*$conditions =[
            'id' => $id
        ];*/
        if(Validator::make($data,$this->post->rules())){
            return Redirect::route("/post/{$id}/edit");
        }

        try{
            $this->post->find($id)->update($data);
            Redirect::route('/posts', [
                'success' => ['Post edited with success.']
            ]);
        }catch(\Exception $e){
            Redirect::route('/posts', [
                'errors' => [$e->getMessage()]
            ]);
        }

        /*
         * Usando BaseModel
         * else{
            if($this->post->update($data,$conditions)){
                Redirect::route('/posts', [
                    'success' => ['Post edited with success.']
                ]);
            } else{
                Redirect::route('/posts', [
                    'errors' => ['Error: Post was not updated.']
                ]);
            }
        }*/
    }

    public function delete($id){
        try{
            $this->post->find($id)->delete();
            Redirect::route('/posts', [
                'success' => ['Post deleted with success.']
            ]);
        }catch(\Exception $e){
            Redirect::route('/posts', [
                'errors' => [$e->getMessage()]
            ]);
        }

        /*
         * Usando BaseModel
         * $conditions = [
            'id' => $id
        ];
        if($this->post->delete($conditions)){
            Redirect::route('/posts', [
                'success' => ['Post deleted with success.']
            ]);
        } else{
            Redirect::route('/posts', [
                'errors' => ['Error: Post was not deleted.']
            ]);
        }*/
    }
}
