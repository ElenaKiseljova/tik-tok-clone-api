<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  //   public function index()
  //   {
  //     //
  //   }

  /**
   * Show the form for creating a new resource.
   */
  //   public function create()
  //   {
  //     //
  //   }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $request->validate([
      'post_id' => 'required',
      'comment' => 'required',
    ]);

    try {
      $comment = new Comment;

      $comment->user_id = auth()->user()->id;
      $comment->post_id = $request->input('post_id');
      $comment->text = $request->input('text');

      $comment->save();

      return response()->json([
        'success' => 'OK',
      ], 200);
    } catch (\Exception $e) {
      return response()->json([
        'error' => $e->getMessage(),
      ], 400);
    }
  }

  /**
   * Display the specified resource.
   */
  //   public function show(Comment $comment)
  //   {
  //     //
  //   }

  /**
   * Show the form for editing the specified resource.
   */
  //   public function edit(Comment $comment)
  //   {
  //     //
  //   }

  /**
   * Update the specified resource in storage.
   */
  //   public function update(Request $request, Comment $comment)
  //   {
  //     //
  //   }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy($id)
  {
    try {
      $comment = Comment::find($id);

      $comment->delete();

      return response()->json([
        'success' => 'OK',
      ], 200);
    } catch (\Exception $e) {
      return response()->json([
        'error' => $e->getMessage(),
      ], 400);
    }
  }
}
