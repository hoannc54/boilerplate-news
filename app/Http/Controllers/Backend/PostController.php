<?php

namespace App\Http\Controllers\Backend;

use App\Models\Auth\User;
use App\Models\Category;
use App\Models\Post;
use Carbon\Carbon;
use Faker\Provider\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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
        if ($logged_in_user->hasRole(['administrator', 'admod'])){
            $data['posts'] = Post::with(['user', 'categories'])->orderBy('updated_at', 'desc')->get();
        }else{
            $data['posts'] = Post::where('author', $logged_in_user->id)->with(['user', 'categories'])->orderBy('updated_at', 'desc')->get();
        }
        $data['categories'] = [0 => 'Tất cả danh mục'] + Category::getNestedList('title', 'id', Category::LIST_INDENT);
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
        try{
            $new_post = [
                'title' => $request->get('title'),
                'content' => $request->get('content'),
                'status' => $request->get('status'),
                'visibility' => $request->get('visibility'),
                'author' => Auth::id(),
                'date' => $request->get('date', null)
            ];
            if (empty($new_post['date'])){
                $new_post['date'] = Carbon::now()->toDateTimeString();
            }
            if ($new_post['status'] == 'password'){
                if (!empty($request->get('password')))
                    $new_post['password'] = Hash::make($request->get('password'));
            }
            $post_current = Post::create($new_post);
            if ($request->has('image')){
                $ext = $request->file('image')->getClientOriginalExtension();
                $filename = $post_current->id . '.' . $ext;

                $path_public = 'images/posts';
                $path_uploaded = $request->file('image')->move(public_path($path_public), $filename);
                if (!empty($path_uploaded)){
                    $post_current->img_path = $path_public . '/' . $filename;
                    $post_current->save();
                }

            }

            $categories = $request->get('categories');
            $post_current->categories()->attach($categories);

            return redirect()->route('admin.post.index');
        }catch (\Exception $exception){
            return back()->withFlashDanger($exception->getMessage());
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
        $data['post'] = Post::find($id);
        $data['categories'] = Category::getNestedList('title', 'id', Category::LIST_INDENT);
        return view('backend.posts.edit', $data);
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
        try{
            $new_post = [
                'title' => $request->get('title'),
                'content' => $request->get('content'),
                'status' => $request->get('status'),
                'visibility' => $request->get('visibility'),
                'author' => Auth::id(),
                'date' => $request->get('date', null)
            ];
            if (empty($new_post['date'])){
                $new_post['date'] = Carbon::now()->toDateTimeString();
            }
            if ($new_post['status'] == 'password'){
                if (!empty($request->get('password')))
                    $new_post['password'] = Hash::make($request->get('password'));
            }
            $post_current = Post::find($id);
            $post_current->update($new_post);
            if ($request->has('image')){
                $ext = $request->file('image')->getClientOriginalExtension();
                $filename = $post_current->id . '.' . $ext;

                $path_public = 'images/posts';
                $path_uploaded = $request->file('image')->move(public_path($path_public), $filename);
                if (!empty($path_uploaded)){
                    $post_current->img_path = $path_public . '/' . $filename;
                    $post_current->save();
                }

            }

            $categories = $request->get('categories');
            $post_current->categories()->attach($categories);

            return redirect()->route('admin.post.index');
        }catch (\Exception $exception){
            return back()->withFlashDanger($exception->getMessage());
        }
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
