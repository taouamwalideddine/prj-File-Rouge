@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-6">User Management</h1>

    <div class="bg-white rounded shadow overflow-hidden">
        @foreach($users as $user)
        <div class="p-4 border-b flex justify-between items-center">
            <div>
                <h3 class="font-medium">{{ $user->name }}</h3>
                <p class="text-gray-600">{{ $user->email }} ({{ ucfirst($user->role) }})</p>
            </div>
            <div>
                @if($user->trashed())
                    <form method="POST" action="{{ route('admin.users.unban', $user->id) }}">
                        @csrf
                        <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded">Unban</button>
                    </form>
                @else
                    <form method="POST" action="{{ route('admin.users.ban', $user) }}">
                        @csrf @method('DELETE')
                        <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded">Ban</button>
                    </form>
                @endif
            </div>
        </div>
        @endforeach
    </div>
    <div class="mt-4">
        {{ $users->links() }}
    </div>
</div>
@endsection
