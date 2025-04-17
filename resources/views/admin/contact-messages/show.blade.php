@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Message Details</h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.contact.index') }}" class="btn btn-sm btn-default">
                                Back to Messages
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Name:</strong> {{ $message->name }}</p>
                                <p><strong>Email:</strong> {{ $message->email }}</p>
                                <p><strong>Subject:</strong> {{ $message->subject }}</p>
                                <p><strong>Date:</strong> {{ $message->created_at->format('M d, Y H:i') }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Status:</strong>
                                    <span class="badge {{ $message->is_read ? 'bg-success' : 'bg-warning' }}">
                                        {{ $message->is_read ? 'Read' : 'Unread' }}
                                    </span>
                                </p>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12">
                                <h4>Message</h4>
                                <div class="border p-3 bg-light">
                                    {{ $message->message }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
