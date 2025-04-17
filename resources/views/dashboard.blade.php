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
                                <h6 class="card-subtitle mb-2 text-secondary">Total Visitors</h6>
                                <h2 class="card-title mb-0 text-white" style="font-size: 2.5rem;">1,234</h2>
                            </div>
                            <i class="fas fa-users fa-2x text-secondary"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-subtitle mb-2 text-secondary">Gallery Items</h6>
                                <h2 class="card-title mb-0 text-white" style="font-size: 2.5rem;">45</h2>
                            </div>
                            <i class="fas fa-images fa-2x text-secondary"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-subtitle mb-2 text-secondary">Messages</h6>
                                <h2 class="card-title mb-0 text-white" style="font-size: 2.5rem;">12</h2>
                            </div>
                            <i class="fas fa-envelope fa-2x text-secondary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity & Quick Actions -->
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0 text-white">Recent Activity</h5>
                    </div>
                    <div class="card-body">
                        <div class="list-group list-group-flush">
                            <div class="list-group-item">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1 text-white">New Contact Message</h6>
                                    <small class="text-secondary">3 mins ago</small>
                                </div>
                                <p class="mb-1 text-secondary">John Doe sent a message through the contact form.</p>
                            </div>
                            <div class="list-group-item">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1 text-white">Gallery Update</h6>
                                    <small class="text-secondary">1 hour ago</small>
                                </div>
                                <p class="mb-1 text-secondary">New images added to the gallery.</p>
                            </div>
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
                            <a href="#" class="btn btn-outline-light">
                                <i class="fas fa-plus me-2"></i>Add Gallery Item
                            </a>
                            <a href="#" class="btn btn-outline-light">
                                <i class="fas fa-envelope me-2"></i>View Messages
                            </a>
                            <a href="#" class="btn btn-outline-light">
                                <i class="fas fa-cog me-2"></i>Settings
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
