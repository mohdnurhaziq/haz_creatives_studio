@extends('layouts.admin')

@section('title', 'Contact Messages')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4 text-white">Contact Messages</h1>
    
    @if(session('success'))
        <div class="alert alert-success bg-green-900 border border-green-700 text-green-100 px-4 py-3 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="card bg-gray-800 border-gray-700 mb-4 shadow-sm">
        <div class="card-header bg-gray-800 border-gray-700">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <i class="fas fa-envelope me-1 text-gray-400"></i>
                    <span class="text-white font-medium">All Contact Messages</span>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-white">
                    <thead class="bg-gray-700">
                        <tr>
                            <th class="text-gray-300">ID</th>
                            <th class="text-gray-300">Name</th>
                            <th class="text-gray-300">Email</th>
                            <th class="text-gray-300">Subject</th>
                            <th class="text-gray-300">Status</th>
                            <th class="text-gray-300">Date</th>
                            <th class="text-gray-300">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($messages as $message)
                            <tr class="hover:bg-gray-700">
                                <td class="text-gray-300">{{ $message->id }}</td>
                                <td class="text-gray-300">{{ $message->name }}</td>
                                <td class="text-gray-300">{{ $message->email }}</td>
                                <td class="text-gray-300">{{ $message->subject }}</td>
                                <td>
                                    <span class="badge bg-{{ $message->read ? 'success' : 'warning' }}">
                                        {{ $message->read ? 'Read' : 'Unread' }}
                                    </span>
                                </td>
                                <td class="text-gray-300">{{ $message->created_at->format('M d, Y H:i') }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.contact-messages.show', $message) }}" class="btn btn-sm btn-info text-white hover:bg-blue-700">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <form action="{{ route('admin.contact-messages.destroy', $message) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger hover:bg-red-700" onclick="return confirm('Are you sure you want to delete this message?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-gray-400 py-4">No contact messages found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $messages->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
