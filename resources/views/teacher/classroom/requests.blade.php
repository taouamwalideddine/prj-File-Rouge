@extends('layouts.teacher')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold">Join Requests</h2>
        <a href="{{ route('teacher.classroom') }}" class="text-indigo-600 hover:underline">Back to Classroom</a>
    </div>

    @if($requests->isEmpty())
        <div class="text-center py-8">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linecap="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
            </svg>
            <h3 class="mt-2 text-lg font-medium">No pending requests</h3>
            <p class="mt-1 text-gray-500">Students' join requests will appear here.</p>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Request Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($requests as $request)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center">
                                    <span class="text-indigo-600 font-medium">{{ substr($request->name, 0, 1) }}</span>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $request->name }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $request->email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $request->pivot->created_at->format('M d, Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex space-x-2">
                                <form action="{{ route('teacher.accept', $request) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="text-indigo-600 hover:text-indigo-900 hover:bg-indigo-50 px-3 py-1 rounded">
                                        Accept
                                    </button>
                                </form>
                                <form action="{{ route('teacher.reject', $request) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="text-red-600 hover:text-red-900 hover:bg-red-50 px-3 py-1 rounded">
                                        Reject
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $requests->links() }}
        </div>
    @endif
</div>

<style>
    .pagination {
        display: flex;
        justify-content: center;
        margin-top: 1rem;
    }
    .page-item {
        margin: 0 0.25rem;
    }
    .page-link {
        padding: 0.5rem 0.75rem;
        border-radius: 0.25rem;
    }
    .page-item.active .page-link {
        background-color: #6366f1;
        color: white;
    }
    .page-item:not(.active) .page-link {
        color: #6366f1;
        border: 1px solid #e5e7eb;
    }
    .page-item:not(.active) .page-link:hover {
        background-color: #eef2ff;
    }
</style>
@endsection
