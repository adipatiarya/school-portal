<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
      
        if ($request->ajax()) {

            $query = Post::with(['categories', 'tags']);

            if ($search = $request->get('search')) {
                $query->where(function($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")->orWhere('content', 'like', "%{$search}%");
                });
            }



            $posts = $query->paginate($request->get('length', 10));

            return response()->json([
                'draw' => intval($request->get('draw')),
                'recordsTotal' => $posts->total(),
                'recordsFiltered' => $posts->total(),
                'data' => $posts->map(function ($post) {
                    return array_merge(
                        $post->toArray(),
                        [
                            'categories' => $post->categories->map(fn($tax) => $tax->term->name)->toArray(),
                            'tags'       => $post->tags->map(fn($tax) => $tax->term->name)->toArray(),
                        ]
                    );
                }),
            ]);

            return response()->json($posts);

        }
        return view('admin.posts.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
         return view('admin.posts.crud');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
         return view('admin.posts.crud');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
