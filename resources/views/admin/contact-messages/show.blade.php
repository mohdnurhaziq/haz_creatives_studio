@extends('layouts.admin')

@section('title', 'View Contact Message')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4 text-white">View Contact Message</h1>
    
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
                    <span class="text-white font-medium">Message Details</span>
                </div>
                <div>
                    <a href="{{ route('admin.contact-messages.index') }}" class="btn btn-secondary bg-gray-600 hover:bg-gray-700 text-white font-medium py-2 px-4 rounded">
                        <i class="fas fa-arrow-left me-1"></i> Back to Messages
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label text-gray-300">Name:</label>
                        <p class="text-white">{{ $message->name }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label text-gray-300">Email:</label>
                        <p class="text-white">{{ $message->email }}</p>
                    </div>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label text-gray-300">Subject:</label>
                        <p class="text-white">{{ $message->subject }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label text-gray-300">Date:</label>
                        <p class="text-white">{{ $message->created_at->format('M d, Y H:i') }}</p>
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label text-gray-300">Message:</label>
                <div class="bg-gray-700 p-4 rounded text-white">
                    {{ $message->message }}
                </div>
            </div>

            <div class="d-flex justify-content-end">
                <a href="mailto:{{ $message->email }}" class="btn btn-info hover:bg-blue-700 text-white font-medium py-2 px-4 rounded me-2">
                    <i class="fas fa-reply me-1"></i> Reply
                </a>
                <form action="{{ route('admin.contact-messages.destroy', $message) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger hover:bg-red-700 text-white font-medium py-2 px-4 rounded" onclick="return confirm('Are you sure you want to delete this message?')">
                        <i class="fas fa-trash me-1"></i> Delete Message
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
