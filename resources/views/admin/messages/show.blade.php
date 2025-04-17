@extends('layouts.admin')

@section('title', 'View Message - Haz Creatives Studio')

@section('header', 'View Message')

@section('content')
    <div class="container-fluid">
        <div class="mb-4">
            <a href="{{ route('admin.messages.index') }}" class="btn btn-outline-light">
                <i class="fas fa-arrow-left me-2"></i>Back to Messages
            </a>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0 text-white">{{ $message->subject }}</h5>
                    <div class="btn-group">
                        @if ($message->is_read)
                            <form action="{{ route('admin.messages.mark-unread', $message) }}" method="POST"
                                class="d-inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-outline-light">
                                    <i class="fas fa-envelope me-2"></i>Mark as Unread
                                </button>
                            </form>
                        @else
                            <form action="{{ route('admin.messages.mark-read', $message) }}" method="POST"
                                class="d-inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-outline-light">
                                    <i class="fas fa-envelope-open me-2"></i>Mark as Read
                                </button>
                            </form>
                        @endif
                        <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" class="d-inline ms-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger"
                                onclick="return confirm('Are you sure you want to delete this message?')">
                                <i class="fas fa-trash me-2"></i>Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h6 class="text-secondary mb-2">From</h6>
                        <p class="text-white mb-0">
                            {{ $message->name }}
                            <span class="text-secondary">&lt;{{ $message->email }}&gt;</span>
                        </p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <h6 class="text-secondary mb-2">Received</h6>
                        <p class="text-white mb-0">{{ $message->created_at->format('F j, Y g:i A') }}</p>
                    </div>
                </div>

                <div class="message-content">
                    <h6 class="text-secondary mb-2">Message</h6>
                    <div class="p-4 rounded bg-dark border border-secondary">
                        <p class="text-white mb-0" style="white-space: pre-wrap;">{{ $message->message }}</p>
                    </div>
                </div>

                <div class="mt-4">
                    <a href="mailto:{{ $message->email }}" class="btn btn-outline-light">
                        <i class="fas fa-reply me-2"></i>Reply via Email
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
