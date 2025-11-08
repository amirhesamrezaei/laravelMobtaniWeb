@extends('layouts.app')

@section('content')
    <h1>ویرایش کاربر {{ $user->name }}</h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>نام:</label>
        <input type="text" name="name" value="{{ old('name', $user->name) }}"><br><br>

        <label>ایمیل:</label>
        <input type="email" name="email" value="{{ old('email', $user->email) }}"><br><br>

        <button type="submit">ذخیره تغییرات</button>
    </form>

    <br>
    <a href="{{ route('users.index') }}">بازگشت به لیست</a>
@endsection
