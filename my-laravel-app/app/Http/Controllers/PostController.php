<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * لیست همه پست‌ها همراه با کاربر و کامنت‌ها
     * GET /posts
     */
    public function index()
    {
        $posts = Post::with(['user', 'comments'])->get();

        return response()->json($posts);
    }

    /**
     * نمایش توضیح فرم ایجاد پست جدید
     * GET /posts/create
     */
    public function create()
    {
        return response()->json([
            'message' => 'اینجا معمولاً فرم ایجاد پست جدید نمایش داده می‌شود.',
        ]);
    }

    /**
     * ذخیره پست جدید در دیتابیس
     * POST /posts
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'title'   => 'required|string|max:255',
            'body'    => 'nullable|string',
        ]);

        $post = Post::create($validated);

        return response()->json([
            'message' => 'پست جدید با موفقیت ذخیره شد.',
            'data'    => $post,
        ]);
    }

    /**
     * نمایش یک پست خاص همراه با روابط
     * GET /posts/{id}
     */
    public function show(string $id)
    {
        $post = Post::with(['user', 'comments.user'])->findOrFail($id);

        return response()->json($post);
    }

    /**
     * نمایش توضیح فرم ویرایش پست
     * GET /posts/{id}/edit
     */
    public function edit(string $id)
    {
        return response()->json([
            'message' => "اینجا معمولاً فرم ویرایش پست {$id} نمایش داده می‌شود.",
        ]);
    }

    /**
     * به‌روزرسانی پست
     * PUT/PATCH /posts/{id}
     */
    public function update(Request $request, string $id)
    {
        $post = Post::findOrFail($id);

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'body'  => 'nullable|string',
        ]);

        $post->update($validated);

        return response()->json([
            'message' => "پست {$id} با موفقیت به‌روزرسانی شد.",
            'data'    => $post,
        ]);
    }

    /**
     * حذف پست
     * DELETE /posts/{id}
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return response()->json([
            'message' => "پست {$id} با موفقیت حذف شد.",
        ]);
    }
}
