@extends('layouts.teacher')

@section('title', 'Teacher Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="text-lg font-medium mb-2">Classroom</h3>
        <p class="text-2xl font-bold">{{ $classroom->name ?? 'Not created' }}</p>
        @if(!$classroom)
            <a href="{{ route('teacher.classroom.create') }}" class="text-blue-600 hover:underline mt-2 block">
                Create Classroom
            </a>
        @endif
    </div>

</div>
@endsection
