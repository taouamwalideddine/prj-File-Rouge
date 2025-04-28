@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-6">Pending Teacher Approvals</h1>

    @if($teachers->isEmpty())
        <p>No pending teacher requests.</p>
    @else
        <div class="bg-white rounded shadow overflow-hidden">
            @foreach($teachers as $teacher)
            <div class="p-4 border-b flex justify-between items-center">
                <div>
                    <h3 class="font-medium">{{ $teacher->name }}</h3>
                    <p class="text-gray-600">{{ $teacher->email }}</p>
                    <p class="text-sm text-yellow-600">Pending since {{ $teacher->created_at->diffForHumans() }}</p>
                </div>
                <div class="flex space-x-2">
                    <form method="POST" action="{{ route('admin.teachers.approve', $teacher) }}">
                        @csrf
                        <button type="submit" class="bg-green-600 text-white px-3 py-1 rounded">Approve</button>
                    </form>
                    <form method="POST" action="{{ route('admin.teachers.reject', $teacher) }}">
                        @csrf @method('DELETE')
                        <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded">Reject</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
        <div class="mt-4">
            {{ $teachers->links() }}
        </div>
    @endif
</div>
@endsection
