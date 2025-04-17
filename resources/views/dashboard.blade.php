@extends('layouts.admin')

@section('title', 'Admin Dashboard - Haz Creatives Studio')

@section('header', 'Dashboard Overview')

@section('content')
    <div class="container-fluid" data-aos="fade-up">
        <!-- Stats Cards -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-subtitle mb-2 text-secondary">Total Messages</h6>
                                <h2 class="card-title mb-0 text-white" style="font-size: 2.5rem;">
                                    {{ \App\Models\Message::count() }}</h2>
                            </div>
                            <i class="fas fa-envelope fa-2x text-secondary"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-subtitle mb-2 text-secondary">Unread Messages</h6>
                                <h2 class="card-title mb-0 text-white" style="font-size: 2.5rem;">
                                    {{ \App\Models\Message::where('is_read', false)->count() }}</h2>
                            </div>
                            <i class="fas fa-envelope-open fa-2x text-secondary"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-subtitle mb-2 text-secondary">Today's Messages</h6>
                                <h2 class="card-title mb-0 text-white" style="font-size: 2.5rem;">
                                    {{ \App\Models\Message::whereDate('created_at', today())->count() }}</h2>
                            </div>
                            <i class="fas fa-calendar-day fa-2x text-secondary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity & Quick Actions -->
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0 text-white">Recent Messages</h5>
                        <a href="{{ route('admin.messages.index') }}" class="btn btn-sm btn-outline-light">
                            View All Messages
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="list-group list-group-flush">
                            @php
                                $recentMessages = \App\Models\Message::latest()->take(5)->get();
                            @endphp
                            @forelse($recentMessages as $message)
                                <div class="list-group-item {{ !$message->is_read ? 'bg-dark' : '' }}">
                                    <div class="d-flex w-100 justify-content-between align-items-center">
                                        <h6 class="mb-1">
                                            <a href="{{ route('admin.messages.show', $message) }}"
                                                class="text-white text-decoration-none">
                                                {{ $message->subject }}
                                            </a>
                                            @if (!$message->is_read)
                                                <span class="badge bg-primary ms-2">New</span>
                                            @endif
                                        </h6>
                                        <small class="text-secondary">{{ $message->created_at->diffForHumans() }}</small>
                                    </div>
                                    <p class="mb-1 text-secondary">From: {{ $message->name }}</p>
                                    <p class="mb-1 text-secondary">{{ Str::limit($message->message, 100) }}</p>
                                    <div class="mt-2">
                                        <a href="{{ route('admin.messages.show', $message) }}"
                                            class="btn btn-sm btn-outline-light">
                                            <i class="fas fa-eye me-1"></i>View
                                        </a>
                                        @if (!$message->is_read)
                                            <form action="{{ route('admin.messages.mark-read', $message) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-sm btn-outline-primary ms-1">
                                                    <i class="fas fa-check me-1"></i>Mark as Read
                                                </button>
                                            </form>
                                        @endif
                                        <a href="mailto:{{ $message->email }}" class="btn btn-sm btn-outline-light ms-1">
                                            <i class="fas fa-reply me-1"></i>Reply
                                        </a>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center text-secondary py-3">
                                    No recent messages
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0 text-white">Quick Actions</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-3">
                            <a href="{{ route('admin.messages.index') }}" class="btn btn-outline-light">
                                <i class="fas fa-envelope me-2"></i>View Messages
                            </a>
                            <a href="{{ route('home') }}" target="_blank" class="btn btn-outline-light">
                                <i class="fas fa-external-link-alt me-2"></i>View Website
                            </a>
                            <a href="{{ route('profile.edit') }}" class="btn btn-outline-light">
                                <i class="fas fa-user-cog me-2"></i>Profile Settings
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
