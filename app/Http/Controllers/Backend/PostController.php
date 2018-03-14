<?php

namespace App\Http\Controllers\Backend;

use App\Models\Auth\User;
use App\Models\Category;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /** @var $logged_in_user User  */
    public $logged_in_user;
    function __construct()
    {
        $this->logged_in_user = Auth::user();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $logged_in_user = Auth::user();
//        dd($logged_in_user);
        if ($logged_in_user->hasRole(['administrator', 'admod'])){
            $data['posts'] = Post::with(['user'])->orderBy('updated_at', 'desc')->get();
        }else{
            $data['posts'] = Post::where('author', $logged_in_user->id)->with(['user'])->orderBy('updated_at', 'desc')->get();
        }

        return view('backend.posts.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['categories'] = Category::getNestedList('title', 'id', Category::LIST_INDENT);
        return view('backend.posts.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request->get('categories'));
//        dd($request->all());
        $new_post = new Post();
        $new_post->content = $request->get('content');
        $new_post->title = $request->get('title');
        $new_post->status = $request->get('status');
        $new_post->date = Carbon::now()->toDateTimeString();
        $new_post->author = Auth::id();
//        $category_ids = [$request->get('category_id')];
        $save = $new_post->save();
        if ($save){
            $post_current = Post::orderBy('created_at', 'desc')->first();
            $categories = $request->get('categories');
            $post_current->categories()->attach($categories);
            return redirect()->route('admin.post.index');
        }else{
            return back();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['post'] = Post::find($id);
        return view('backend.posts.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /** @var $post Post*/
        $post = Post::find($id);
        $post->categories()->detach();
        if ($post->delete()){
            return redirect()->route('admin.post.index')
                ->withFlashSuccess('Xoá bài viết thành công');
        }else{
            return redirect()->route('admin.post.index')
                ->withFlashDanger('Xoá bài viết không thành công');
        }
    }
}
