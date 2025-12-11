<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * نمایش لیست همه کاربران
     * GET /users
     */
    public function index()
    {
        // استفاده از Eloquent برای گرفتن تمام کاربران از دیتابیس
        $users = User::all();

        return response()->json($users);
    }

    /**
     * نمایش فرم ایجاد کاربر جدید
     * GET /users/create
     * (در این تمرین فقط یک پیام تستی برمی‌گردانیم)
     */
    public function create()
    {
        return response()->json([
            'message' => 'اینجا معمولاً فرم ایجاد کاربر نمایش داده می‌شود.',
        ]);
    }

    /**
     * ذخیره کاربر جدید در دیتابیس
     * POST /users
     */
    public function store(Request $request)
    {
        // اعتبارسنجی ورودی‌ها
        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|string|max:20',
        ]);

        // ساخت کاربر جدید با استفاده از Eloquent
        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'phone'    => $validated['phone'] ?? null,
            // برای سادگی، یک پسورد پیش‌فرض تعیین می‌کنیم
            'password' => Hash::make('password123'),
        ]);

        return response()->json([
            'message' => 'کاربر با موفقیت در دیتابیس ذخیره شد.',
            'data'    => $user,
        ]);
    }

    /**
     * نمایش یک کاربر خاص
     * GET /users/{id}
     */
    public function show(string $id)
    {
        // اگر کاربر پیدا نشود، 404 برمی‌گرداند
        $user = User::findOrFail($id);

        return response()->json($user);
    }

    /**
     * نمایش فرم ویرایش کاربر
     * GET /users/{id}/edit
     */
    public function edit(string $id)
    {
        return response()->json([
            'message' => "اینجا معمولاً فرم ویرایش کاربر {$id} نمایش داده می‌شود.",
        ]);
    }

    /**
     * به‌روزرسانی اطلاعات کاربر
     * PUT/PATCH /users/{id}
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        // اعتبارسنجی برای ویرایش
        $validated = $request->validate([
            'name'  => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
        ]);

        // به‌روزرسانی فیلدها
        $user->update($validated);

        return response()->json([
            'message' => "کاربر {$id} با موفقیت به‌روزرسانی شد.",
            'data'    => $user,
        ]);
    }

    /**
     * حذف کاربر
     * DELETE /users/{id}
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json([
            'message' => "کاربر {$id} با موفقیت حذف شد.",
        ]);
    }
}
