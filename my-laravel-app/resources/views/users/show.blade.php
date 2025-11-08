@extends('layouts.app')

@section('content')
    <h1>مشاهده کاربر</h1>

    <p><strong>نام:</strong> {{ $user->name }}</p>
    <p><strong>ایمیل:</strong> {{ $user->email }}</p>

    <a href="{{ route('users.edit', $user->id) }}">ویرایش</a>
    <br><br>
    <a href="{{ route('users.index') }}">بازگشت به لیست</a>
@endsection
