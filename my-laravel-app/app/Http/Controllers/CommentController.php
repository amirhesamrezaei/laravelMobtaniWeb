<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * لیست همه کامنت‌ها همراه با پست و کاربر
     * GET /comments
     */
    public function index()
    {
        $comments = Comment::with(['post', 'user'])->get();

        return response()->json($comments);
    }

    /**
     * نمایش توضیح فرم ایجاد کامنت
     * GET /comments/create
     */
    public function create()
    {
        return response()->json([
            'message' => 'اینجا معمولاً فرم ایجاد کامنت جدید نمایش داده می‌شود.',
        ]);
    }

    /**
     * ذخیره کامنت جدید
     * POST /comments
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'post_id' => 'required|exists:posts,id',
            'user_id' => 'nullable|exists:users,id',
            'body'    => 'required|string',
        ]);

        $comment = Comment::create($validated);

        return response()->json([
            'message' => 'کامنت جدید با موفقیت ذخیره شد.',
            'data'    => $comment,
        ]);
    }

    /**
     * نمایش یک کامنت خاص
     * GET /comments/{id}
     */
    public function show(string $id)
    {
        $comment = Comment::with(['post', 'user'])->findOrFail($id);

        return response()->json($comment);
    }

    /**
     * توضیح فرم ویرایش کامنت
     * GET /comments/{id}/edit
     */
    public function edit(string $id)
    {
        return response()->json([
            'message' => "اینجا معمولاً فرم ویرایش کامنت {$id} نمایش داده می‌شود.",
        ]);
    }

    /**
     * به‌روزرسانی کامنت
     * PUT/PATCH /comments/{id}
     */
    public function update(Request $request, string $id)
    {
        $comment = Comment::findOrFail($id);

        $validated = $request->validate([
            'body' => 'sometimes|required|string',
        ]);

        $comment->update($validated);

        return response()->json([
            'message' => "کامنت {$id} با موفقیت به‌روزرسانی شد.",
            'data'    => $comment,
        ]);
    }

    /**
     * حذف کامنت
     * DELETE /comments/{id}
     */
    public function destroy(string $id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return response()->json([
            'message' => "کامنت {$id} با موفقیت حذف شد.",
        ]);
    }
}
