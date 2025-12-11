<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * نمایش لیست همه کاربران
     * متد مربوط به: GET /users
     */
    public function index()
    {
        // دیتای تستی (فعلاً دیتابیس نداریم)
        $users = [
            ['id' => 1, 'name' => 'Ali',  'email' => 'ali@example.com'],
            ['id' => 2, 'name' => 'Sara', 'email' => 'sara@example.com'],
        ];

        // برگرداندن داده‌ها به صورت JSON
        return response()->json($users);
    }

    /**
     * نمایش فرم ایجاد کاربر جدید
     * متد مربوط به: GET /users/create
     */
    public function create()
    {
        // در پروژه واقعی: اینجا معمولاً یک view برگردانده می‌شود
        // در این تمرین فقط یک پیام تستی برمی‌گردانیم
        return response()->json([
            'message' => 'اینجا معمولاً فرم ایجاد کاربر نمایش داده می‌شود.',
        ]);
    }

    /**
     * ذخیره کاربر جدید
     * متد مربوط به: POST /users
     */
    public function store(Request $request)
    {
        // در این تمرین نباید از دیتابیس استفاده کنیم
        // پس فقط داده‌های دریافتی را به صورت JSON برمی‌گردانیم
        return response()->json([
            'message' => 'کاربر جدید به صورت تستی ذخیره شد.',
            'data'    => $request->all(),
        ]);
    }

    /**
     * نمایش یک کاربر خاص
     * متد مربوط به: GET /users/{id}
     */
    public function show(string $id)
    {
        // داده تستی بر اساس id
        return response()->json([
            'id'    => $id,
            'name'  => 'Test User ' . $id,
            'email' => 'user' . $id . '@example.com',
        ]);
    }

    /**
     * نمایش فرم ویرایش کاربر
     * متد مربوط به: GET /users/{id}/edit
     */
    public function edit(string $id)
    {
        return response()->json([
            'message' => "اینجا معمولاً فرم ویرایش کاربر {$id} نمایش داده می‌شود.",
        ]);
    }

    /**
     * به‌روزرسانی اطلاعات کاربر
     * متد مربوط به: PUT/PATCH /users/{id}
     */
    public function update(Request $request, string $id)
    {
        return response()->json([
            'message' => "کاربر {$id} به صورت تستی به‌روزرسانی شد.",
            'data'    => $request->all(),
        ]);
    }

    /**
     * حذف کاربر
     * متد مربوط به: DELETE /users/{id}
     */
    public function destroy(string $id)
    {
        return response()->json([
            'message' => "کاربر {$id} به صورت تستی حذف شد.",
        ]);
    }
}
