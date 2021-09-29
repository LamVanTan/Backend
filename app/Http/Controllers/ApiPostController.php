<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class ApiPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = Post::latest()->paginate(10);

        return response()->json($post);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->get('slide_url'))
        {
            $image = $request->get('slide_url');
            $name = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
            \Image::make($request->get('slide_url'))->save(public_path('images/').$name);
        }

        $post = new Post;
        $post->title = $request->title;
        $post->content = $request->content;
        $post->status = $request->status;
        $post->slide_url = $name;
        $post->save();

        return response()->json(['message' => 'Thêm thành công', $post]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        return response()->json($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        $post->delete();

        return response()->json(['message' => 'Xóa thành công']);
    }

    public function updatePost(Request $request, $id)
    {
        $post = Post::find($id);

        $post->title = $request->title;
        $post->content = $request->content;
        $post->status = $request->status;

        $post->save();

        return response()->json(['message' => 'Cập nhập thành công', $post]);
    }

    public function deletePost($id)
    {
        $post = Post::find($id);

        $post->delete();

        return response()->json(['message' => 'Xóa thành công']);
    }

    

    public function getListPostPublic()
    {
        $post = Post::where('status', '=', 1)->paginate(10);

        return response()->json($post);
    }

    public function getPostDetail($id) 
    {
        $post = Post::find($id);

        return response()->json($post);
    }
}
