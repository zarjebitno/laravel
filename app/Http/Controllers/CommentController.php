<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::where('user_id', Auth::id())->get();
        
        return view('pages.user.comments', [
            'comments' => $comments
        ]);
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
    public function store(Post $post, Request $request)
    {
        $request->validate([
            'content' => 'required'
        ]);


        $comment = $post->comments()->create(
            $request->validate([
                'content' => 'required'
        ]) + ['user_id' => Auth::id()]);

        return Comment::where('post_id', $post->id)->with('user')->orderByDesc('created_at')->get();
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
        $commentToDelete = Comment::find($id);
        $commentToDelete->delete();

        $allComments = Comment::where('post_id', $commentToDelete->post_id)->with('user')->get();
        return response()->json($allComments);
    }

    public function deleteCommentAdmin(Request $request) {
        // $commentToDelete = Comment::find($id);
        // $commentToDelete->delete();

        // $allComments = Comment::paginate(10);
        // return response()->json($allComments);

        return $request->comment;
    }
}
