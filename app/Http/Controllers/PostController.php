<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Session;

class PostController extends Controller
{

    public function index(){
        $posts = Auth()->user()->posts()->paginate(10);
        return view('admin.posts.index',['posts'=>$posts]);
    }

    public function show(Post $post){
        return view('blog-post',['post' => $post]);
    }

    public function create(Post $post){
        return view('admin.posts.create');
    }

    public function store(){
        $input = request()->validate([
            'title' => 'required|min:8|max:255',
            'post_image' => 'file',
            'body' => 'required',
        ]);

        if(request('post_image')){
            $input['post_image'] = request('post_image')->store('images');
        }

        auth()->user()->posts()->create($input);

        Session::flash('post-created-message','post was created successfully');

        return redirect()->route('post.index');
    }

    public function edit(Post $post){
//        $this->authorize('view',$post);

        return view('admin.posts.edit',['post'=>$post]);
    }

    public function destroy(Post $post){
        $post->delete();

        Session::flash('message','post was deleted');

        return back();
    }

    public function update(Post $post){
        $input = request()->validate([
            'title' => 'required|min:8|max:255',
            'post_image' => 'file',
            'body' => 'required',
        ]);

        if(request('post_image')){
            $input['post_image'] = request('post_image')->store('images');
        }

        $this->authorize('update',$post);
        $post->update($input);

        Session::flash('post-updated-message','post with title was updated'.$input['title']);

        return redirect()->route('post.index');

    }
}
