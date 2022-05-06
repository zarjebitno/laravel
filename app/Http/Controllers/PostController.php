<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Postimage;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at')->paginate(3);
        $categories = Category::all();

        return view('pages.home', [
            'posts' => $posts,
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('pages.user.posts.create', [
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->post_cat == 0) return;

        $request->validate([
            'post_title' => 'bail|required|max:255',
            'post_cat' => 'bail|required',
            'post_content' => 'bail|required'
        ]);

        $image = Postimage::upload($request->post_image);

        Post::create([
            'title' => $request->post_title,
            'content' => $request->post_content,
            'image' => $request->post_image ? $image : '',
            'cat_id' => $request->post_cat,
            'user_id' => Auth::id()
        ]);

        Log::channel('myCustomLogFile')->notice('New post ' . $request->post_title . ' created.');

        return redirect()->route('users.index')->with('success', 'Post uploaded.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        $categories = Category::all();

        return view('pages.post', [
            'post' => $post,
            'categories' => $categories
        ]);
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
        $categories = Category::all();

        return view('admin.posts.edit', [
            'post' => $post,
            'categories' => $categories
        ]);
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
        $post = Post::find($id);

        $image = Postimage::upload($request->post_image);

        $request->validate([
            'post_title' => 'bail|required|max:255',
            'post_cat' => 'bail|required',
            'post_content' => 'bail|required'
        ]);

        $post->update([
            'title' => $request->post_title,
            'content' => $request->post_content,
            'image' => $image ? $image : '',
            'cat_id' => $request->post_cat
        ]);

        $post->save();
        
        Log::channel('myCustomLogFile')->notice('Post ' . $id . ' updated.');
        return redirect()->route('users.index')->with('success', 'Post updated.');
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
        $commentsOnPost = Comment::where('post_id', $id);

        // delete all comments

        \DB::beginTransaction();

        try {
            $post->delete();
            $commentsOnPost->delete();
            
            Log::channel('myCustomLogFile')->notice('Post with an ID ' . $id . ' just deleted.');

            \DB::commit();
        } catch(Exception $e) {
            Log::channel('myCustomLogFile')->alert('Deleting post failed.');
            Log::channel('myCustomLogFile')->error($e->getMessage());

            \DB::rollBack();
            
            return redirect()->route('home')->with('errorMessage', 'A server error occurred!');
        }

        $allPosts = Post::paginate(3);
        return $allPosts;
    }

    public function getPostsByCategory($id) {
        $posts = Post::where('cat_id', $id)->paginate(3);
        $categories = Category::all();
        
        return view('pages.home', [
            'posts' => $posts,
            'categories' => $categories
        ]);
    }

    public function getPostsByUser($id) {
        $posts = Post::where('user_id', $id)->paginate(3);
        $categories = Category::all();
        
        return view('pages.home', [
            'posts' => $posts,
            'categories' => $categories
        ]);
    }

    public function getPostsAdminView() {
        $posts = Post::orderBy('created_at')->paginate(3);
        $categories = Category::all();

        return view('admin.pages.posts', [
            'posts' => $posts,
            'categories' => $categories
        ]);
    }

    public function fetch(Request $request) {
        $posts = Post::with('category')->with('comments')->with('user');

        if($request->searchInputValue) {
            $searchInputValue = $request->searchInputValue;
            $posts = $posts->where('title', 'like', '%' . $searchInputValue . '%');
        }

        if($request->sortValue) {
            if($request->sortValue == '1')
                $posts = $posts->orderBy('created_at');
            else
                $posts = $posts->orderBy('created_at');
        }

        $posts = $posts->paginate(3)->withQueryString();
        return $posts;
    }
}
