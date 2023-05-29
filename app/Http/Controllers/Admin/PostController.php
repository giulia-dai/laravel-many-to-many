<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.posts.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $validated_data = $request->validated();

        $validated_data['slug'] = Post::generateSlug($request->title);

        $checkPost = Post::where('slug', $validated_data['slug'])->first();
        if ($checkPost) {
            return back()->withInput()->withErrors(['slug' => 'Impossibile creare slug,scegli un altro titolo!']);
        }


        if ($request->hasFile('cover_img')) {
            $path = Storage::put('cover', $request->cover_img);
            $validated_data['cover_img'] = $path;
        }

        $newPost = Post::create($validated_data); //con la create si fa la fill e la save con un comando solo


        if ($request->has('technologies')) {

            $newPost->technologies()->attach($request->technologies);
        }
        return redirect()->route('admin.posts.show', ['post' => $newPost->slug]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $types = Type::all();
        $technologies = Technology::all();

        return view('admin.posts.edit', compact('post', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $validated_data = $request->validated();
        $validated_data['slug'] = Post::generateSlug($request->title);

        $checkPost = Post::where('slug', $validated_data['slug'])->first();
        if ($checkPost) {
            return back()->withInput()->withErrors(['slug' => 'Impossibile creare slug,scegli un altro titolo!']);
        }


        if ($request->hasFile('cover_img')) {

            //se c'era già un file in precedenza cancellalo
            if ($post->cover_img) {
                Storage::delete($post->cover_img);
            }

            //poi carica la nuova immagine
            $path = Storage::put('cover', $request->cover_img);
            $validated_data['cover_img'] = $path;
        };

        $post->technologies()->sync($request->technologies);

        $post->update($validated_data);

        return redirect()->route('admin.posts.show', ['post' => $post->slug]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {

        //così viene cancellato anche il file all'interno della cartella cover se presente
        if ($post->cover_img) {
            Storage::delete($post->cover_img);
        }

        $post->delete();
        return redirect()->route('admin.posts.index');
    }


    public function deleteImage($slug)
    {

        $post = Post::where('slug', $slug)->firstOrFail();

        if ($post->cover_img) {
            Storage::delete($post->cover_img);
            $post->cover_img = null;
            $post->save();
        }

        return redirect()->route('admin.posts.edit', $post->slug);
    }
}
