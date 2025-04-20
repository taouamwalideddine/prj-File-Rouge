@extends('layouts.student')

@section('content')
<div class="container py-8">
    <h1 class="text-2xl font-bold mb-6">Classrooms</h1>

    <div class="mb-12">
        <h2 class="text-xl font-semibold mb-4">Your Classes</h2>
        @forelse($joinedClassrooms as $classroom)
            <div class="bg-white rounded-lg shadow p-6 mb-4 flex justify-between items-center">
                <div>
                    <h3 class="font-bold">{{ $classroom->name }}</h3>
                    <p>Teacher: {{ $classroom->teacher->name }}</p>
                </div>
                <a href="{{ route('student.classrooms.show', $classroom) }}"
                   class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    View Class
                </a>
            </div>
        @empty
            <p class="text-gray-500">You haven't joined any classes yet.</p>
        @endforelse
    </div>

    <div>
        <h2 class="text-xl font-semibold mb-4">Available Classes</h2>
        @forelse($availableClassrooms as $classroom)
            <div class="bg-white rounded-lg shadow p-6 mb-4 flex justify-between items-center">
                <div>
                    <h3 class="font-bold">{{ $classroom->name }}</h3>
                    <p>Teacher: {{ $classroom->teacher->name }}</p>
                </div>
                <form action="{{ route('student.classrooms.join', $classroom) }}" method="POST">
                    @csrf
                    <button type="submit"
                            class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                        Request to Join
                    </button>
                </form>
            </div>
        @empty
            <p class="text-gray-500">No available classrooms at this time.</p>
        @endforelse
    </div>
</div>
@endsection
