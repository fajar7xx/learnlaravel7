<?php

namespace App\Http\Controllers;

use App\{Category, Post, Tag};
use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth')->except([
    //         'index',
    //         'show'
    //     ]);
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $posts = Post::latest()->paginate(6);

        // menggunakan eager loading biar query yang d proses lebih sedikit
        $posts = Post::latest()->paginate(6);
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get();
        $tags = Tag::get();
        return view('posts.create', [
            'post' => new Post,
            'categories' => $categories,
            'tags' => $tags
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        // dd($request->tags);
        // validate the field
        // validasi dlu
        // $this->validate($request, [
        //     'title' => 'required|min:3',
        //     'body' => 'required'
        // ]);

        // cara lainnya
        // $attr = $request->validate([
        //     'title' => 'required|min:3',
        //     'body' => 'required'
        // ]);

        // $attr = $this->validateRequest();
        
        // $post = new Post;
        // $post->title = $request->title;
        // $post->slug = \Str::slug($request->title);
        // $post->body = $request->body;
        // $post->save();

        // cool way
        // Post::create([
        //     'title' => $request->title,
        //     'slug' => \Str::slug($request->title),
        //     'body' => $request->body
        // ]);
            
        // another cool way
        // $post = $request->all();
        // $post['slug'] = \Str::slug($request->title);
        // Post::create($post);

        // assign title to the slug
        // ini cool way bagaimana setelah validasi langsung kemari
        
        
        $attr = $request->all();
        $slug = \Str::slug($request->title);
        $attr['slug'] = $slug;
        $attr['category_id'] = $request->category;
        $attr['user_id'] = auth()->id();
        
        // $thumbnail = $request->file('thumbnail');
        // $thumbnailUrl = $thumbnail->storeAs("images/posts", "{$slug}.{$thumbnail->extension()}");
        $thumbnailUrl = (request('thumbnail')->store('images/posts', 'public'));

        $attr['thumbnail'] = $thumbnailUrl;
        
        // crete new post
        $post = Post::create($attr);

        // simpan tagsnya yang many to many
        $post->tags()->attach(request('tags'));

        // flash message
        session()->flash('success', 'The post was created');
        return redirect('posts');
        // return redirect()->to('posts');
        // return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        // $post = Post::where('slug', $slug)->firstOrFail();
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::get();
        $tags = Tag::get();
        return view('posts.edit', compact(
            'post',
            'tags',
            'categories'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request ,Post $post)
    {
        // policy pada controller
        $this->authorize('update', $post);

        $attr = $request->all();
        $attr['category_id'] = $request->category;
        // $attr = $this->validateRequest();
        if($request->has('thumbnail')){
            Storage::delete("/public/" . $post->thumbnail);
            $pesan = "berhasil di hapus";
        }
        $thumbnailUrl = (request('thumbnail')->store('images/posts', 'public'));
        $attr['thumbnail'] = $thumbnailUrl;
        

        // crete new post
        $post->update($attr);
        // simpan tagsnya yang many to many
        $post->tags()->sync(request('tags'));

        // flash message
        session()->flash('success', 'The post was updated and ' . $pesan);
        return redirect('posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        // dd($post);
        $this->authorize('delete', $post);

        if(Storage::exists("/public/" . $post->thumbnail)){
            Storage::delete("/public/" . $post->thumbnail);
        }
        $post->tags()->detach();
        $post->delete();
        session()->flash('success', 'The posts has been deleted');
        return redirect('posts');
    } 

    // public function validateRequest()
    // {
    //     $validate = request()->validate([
    //         'title' => 'required|min:3',
    //         'body' => 'required'
    //     ]);

    //     return $validate;
    // }
}
