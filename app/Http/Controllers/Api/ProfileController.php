<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AllPostsCollection;
use App\Http\Resources\UsersCollection;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  // public function index()
  // {
  //     //
  // }

  /**
   * Show the form for creating a new resource.
   */
  // public function create()
  // {
  //     //
  // }

  /**
   * Store a newly created resource in storage.
   */
  // public function store(Request $request)
  // {
  //     //
  // }

  /**
   * Display the specified resource.
   */
  public function show($id)
  {
    try {
      $posts = Post::where('user_id', $id)->orderBy('created_at', 'desc')->get();

      $user = User::where('id', $id)->get();

      return response()->json([
        'posts' => new AllPostsCollection($posts),
        'user' => new UsersCollection($user),
      ], 200);
    } catch (\Exception $e) {
      return response()->json([
        'error' => $e->getMessage(),
      ], 400);
    }
  }

  /**
   * Show the form for editing the specified resource.
   */
  // public function edit(string $id)
  // {
  //     //
  // }

  /**
   * Update the specified resource in storage.
   */
  // public function update(Request $request, string $id)
  // {
  //     //
  // }

  /**
   * Remove the specified resource from storage.
   */
  // public function destroy(string $id)
  // {
  //     //
  // }
}
