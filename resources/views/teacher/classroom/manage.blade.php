@extends('layouts.teacher')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <h2 class="text-xl font-semibold mb-4">Classroom Management</h2>

    <div class="mb-4">
        <h3 class="font-medium mb-2">Class Name: {{ $classroom->name }}</h3>
        <p class="text-gray-600">Class Code: {{ $classroom->id }}</p>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-gray-50">
                    <th class="px-4 py-2 text-left">Student Name</th>
                    <th class="px-4 py-2 text-left">Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $student)
                <tr class="border-t">
                    <td class="px-4 py-3">{{ $student->name }}</td>
                    <td class="px-4 py-3">{{ $student->email }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
