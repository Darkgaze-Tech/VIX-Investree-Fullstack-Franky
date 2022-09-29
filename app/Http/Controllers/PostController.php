<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    // Get all posts
    public function index(Request $request){
        $posts = auth()->user()->posts()->paginate(10);
        
        if ($request->wantsJson()){
            return response()->json([
                'success' => true,
                'data' => $posts
            ]);
        }
        else {
            return view('template.posts.index', ['posts' => $posts, 'success' => true]);
        }
    }
    
    // Show detail post
    public function show(Request $request, $id){
        $post = auth()->user()->posts()->find($id);

        if(!$post){
            if ($request->wantsJson()){
                return response()->json([
                    'success' => false,
                    'message' => 'Post not found'
                ], 400);
            }
            else{
                return view('template.posts.show', ['post' => $post, 'success' => false, 'message' => 'Post not found']);
            }
        }

        if ($request->wantsJson()){
            return response()->json([
                'success' => true,
                'data' => $post->toArray()
            ]);
        }
        else {
            return view('template.posts.show', ['post' => $post, 'success' => true, 'message' => 'Post found']);
        }

    }

    // Route to create page view
    public function create(){
        $categories = auth()->user()->categories;
        return view('template.posts.create', ['categories' => $categories]);
    }

    // Route to edit page view
    public function edit(Post $post)
    {
        $categories = auth()->user()->categories;
        return view('template.posts.edit',['categories' => $categories, 'post' => $post]);
    }

    // Create new post 
    public function store(Request $request){
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,jpg,png|max:1000',
            'category_id' => 'required',
        ]);

        $post = new Post();
        $post->title = $request->title;
        $post->content = $request->content;
        $post->category_id = $request->category_id;

        if (isset($request->image)){
            $dirpath = public_path('image');
            $name = $request['image']->getClientOriginalExtension();
            $filename = time().'.'.$name;
            $file = $request['image']->move($dirpath, $filename);
            $post->image = 'image/'.$filename;
        }

        if(auth()->user()->posts()->save($post)){
            if ($request->wantsJson()){
                return response()->json([
                    'success' => true,
                    'data' => $post->toArray()
                ]);
            }
            else {
                $request->session()->flash('message','New post has been added');
                return redirect()->to('posts');
            }
        }
        else{
            if ($request->wantsJson()){
                return response()->json([
                    'success' => false,
                    'message' => 'Post not added'
                ], 500);
            }
            else {
                $request->session()->flash('message','Post not added');
                return redirect()->to('posts');
            }
        }
    }
    
    // Update post 
    public function update(Request $request, $id){
        $post = auth()->user()->posts()->find($id);
        if(!$post){
            if ($request->wantsJson()){
                return response()->json([
                    'success' => false,
                    'message' => 'Post not found'
                ], 400);
            }
            else {
                $request->session()->flash('message','Post '.$id.' not found');
                return redirect()->to('posts');
            }
        }

        $u = new Post();
        $u->title = $request->title;
        $u->content = $request->content;
        $u->category_id = $request->category_id;

        if (isset($request->image)){
            $dirpath = public_path('image');
            $name = $request['image']->getClientOriginalExtension();
            $filename = time().'.'.$name;
            $file = $request['image']->move($dirpath, $filename);
            $u->image = 'image/'.$filename;
        }
        else {
            $u->image = null;
        }
        $updated = $post->fill(['title' => $u->title, 'content' => $u->content, 'category_id' => $u->category_id, 'image' => $u->image])->save();

        if($updated){
            if ($request->wantsJson()){
                return response()->json([
                    'data' => $post,
                    'success' => true
                ]);
            }
            else {
                $request->session()->flash('message','Post '.$id.' updated');
                return redirect()->to('posts');
            }
        }
        else{
            if ($request->wantsJson()){
                return response()->json([
                    'success' => false,
                    'message' => 'Post could not be updated'
                ], 500);
            }
            else {
                $request->session()->flash('message','Post '.$id.' could not be updated');
                return redirect()->to('posts');
            }
        }
    }

    // Delete post 
    public function destroy(Request $request, $id){
        $post = auth()->user()->posts()->find($id);

        if(!$post){
            if ($request->wantsJson()){
                return response()->json([
                    'success' => false,
                    'message' => 'Post not found'
                ], 400);
            }
            else {
                $request->session()->flash('message','Post '.$id.' not found');
                return redirect()->to('posts');
            }
        }

        if ($post->delete()){
            if ($request->wantsJson()){
                return response()->json([
                    'success' => true,
                    'message' => 'Post has been deleted'
                ]);
            }
            else{
                $request->session()->flash('message','Post '.$id.' has been deleted');
                return redirect()->to('posts');
            }
        }
        else {
            if ($request->wantsJson()){
                return response()->json([
                    'success' => false,
                    'message' => 'Post could not be deleted'
                ], 500);
            }
            else{
                $request->session()->flash('message','Post '.$id.' could not be deleted');
                return redirect()->to('posts');
            }
        }
    }
}
