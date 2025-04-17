@extends('layouts.admin')

@section('title', 'Messages - Haz Creatives Studio')

@section('header', 'Messages')

@section('content')
    <div class="container-fluid">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Status</th>
                                <th>From</th>
                                <th>Subject</th>
                                <th>Received</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($messages as $message)
                                <tr class="{{ !$message->is_read ? 'table-active' : '' }}">
                                    <td>
                                        @if (!$message->is_read)
                                            <span class="badge bg-primary">New</span>
                                        @else
                                            <span class="badge bg-secondary">Read</span>
                                        @endif
                                    </td>
                                    <td>{{ $message->name }}</td>
                                    <td>
                                        <a href="{{ route('admin.messages.show', $message) }}" class="text-decoration-none">
                                            {{ $message->subject }}
                                        </a>
                                    </td>
                                    <td>{{ $message->formatted_created_at }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('admin.messages.show', $message) }}"
                                                class="btn btn-sm btn-outline-light">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            @if ($message->is_read)
                                                <form action="{{ route('admin.messages.mark-unread', $message) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm btn-outline-light">
                                                        <i class="fas fa-envelope"></i>
                                                    </button>
                                                </form>
                                            @else
                                                <form action="{{ route('admin.messages.mark-read', $message) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm btn-outline-light">
                                                        <i class="fas fa-envelope-open"></i>
                                                    </button>
                                                </form>
                                            @endif
                                            <form action="{{ route('admin.messages.destroy', $message) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                                    onclick="return confirm('Are you sure you want to delete this message?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No messages found.</td>
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
