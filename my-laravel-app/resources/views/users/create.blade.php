@extends('layouts.app')

@section('content')
    <h1>ایجاد کاربر جدید</h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('users.store') }}" method="POST">
        @csrf

        <label>نام:</label>
        <input type="text" name="name" value="{{ old('name') }}"><br><br>

        <label>ایمیل:</label>
        <input type="email" name="email" value="{{ old('email') }}"><br><br>

        <label>رمز عبور:</label>
        <input type="password" name="password"><br><br>

        <button type="submit">ثبت کاربر</button>
    </form>

    <br>
    <a href="{{ route('users.index') }}">بازگشت به لیست</a>
@endsection
