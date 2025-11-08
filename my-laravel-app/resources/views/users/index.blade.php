@extends('layouts.app')

@section('content')
    <h1>لیست کاربران</h1>

    <a href="{{ route('users.create') }}">+ ایجاد کاربر جدید</a>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <ul>
        @forelse($users as $user)
            <li>
                {{ $user->name }} ( {{ $user->email }} )

                | <a href="{{ route('users.show', $user->id) }}">نمایش</a>
                | <a href="{{ route('users.edit', $user->id) }}">ویرایش</a>

                <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('حذف شود؟')">حذف</button>
                </form>
            </li>
        @empty
            <li>هیچ کاربری وجود ندارد.</li>
        @endforelse
    </ul>
@endsection
