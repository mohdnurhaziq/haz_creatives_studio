@extends('layouts.admin')

@section('title', 'Settings')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Settings</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Settings</li>
    </ol>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <div class="text-muted">General Settings</div>
                            <div class="stats-number">Configure System</div>
                        </div>
                        <div class="text-primary">
                            <i class="fas fa-cog fa-2x"></i>
                        </div>
                    </div>

                    <form action="{{ route('admin.settings.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="site_name" class="form-label text-muted">Site Name</label>
                            <input type="text" class="form-control" id="site_name" name="site_name" value="{{ $settings['site_name'] ?? '' }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="timezone" class="form-label text-muted">Timezone</label>
                            <select class="form-select" id="timezone" name="timezone" required>
                                <option value="">Select Timezone</option>
                                @foreach(timezone_identifiers_list() as $tz)
                                    <option value="{{ $tz }}" {{ ($settings['timezone'] ?? '') == $tz ? 'selected' : '' }}>{{ $tz }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="currency" class="form-label text-muted">Currency</label>
                            <select class="form-select" id="currency" name="currency" required>
                                <option value="">Select Currency</option>
                                <option value="USD" {{ ($settings['currency'] ?? '') == 'USD' ? 'selected' : '' }}>USD ($)</option>
                                <option value="EUR" {{ ($settings['currency'] ?? '') == 'EUR' ? 'selected' : '' }}>EUR (€)</option>
                                <option value="GBP" {{ ($settings['currency'] ?? '') == 'GBP' ? 'selected' : '' }}>GBP (£)</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="enable_email_notifications" name="enable_email_notifications" {{ ($settings['enable_email_notifications'] ?? false) ? 'checked' : '' }}>
                                <label class="form-check-label text-muted" for="enable_email_notifications">
                                    Enable Email Notifications
                                </label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="enable_sms_notifications" name="enable_sms_notifications" {{ ($settings['enable_sms_notifications'] ?? false) ? 'checked' : '' }}>
                                <label class="form-check-label text-muted" for="enable_sms_notifications">
                                    Enable SMS Notifications
                                </label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="maintenance_mode" name="maintenance_mode" {{ ($settings['maintenance_mode'] ?? false) ? 'checked' : '' }}>
                                <label class="form-check-label text-muted" for="maintenance_mode">
                                    Maintenance Mode
                                </label>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> Save Settings
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize any JavaScript enhancements here
    });
</script>
@endpush 