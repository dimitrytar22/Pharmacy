@extends('layouts.admin')

@section('title')
    User Details
@endsection

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="{{ route('admin.users.index') }}" class="btn btn-primary">← Back to Users</a>
        </div>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="text-primary">User №{{ $user->id }}</h2>
        </div>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-4">User Information</h5>
                <div class="row mb-3">
                    <div class="col-md-3 fw-bold">Name:</div>
                    <div class="col-md-9">{{ $user->name }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3 fw-bold">Email:</div>
                    <div class="col-md-9">{{ $user->email }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3 fw-bold">Email Verified:</div>
                    <div class="col-md-9">
                        {{ $user->email_verified_at ? $user->email_verified_at->format('Y-m-d H:i') : 'Not verified' }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3 fw-bold">Role:</div>
                    <div class="col-md-9">
                        <span class="badge bg-primary">{{ $user->role }}</span>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3 fw-bold">Created At:</div>
                    <div class="col-md-9">{{ $user->created_at ? $user->created_at->format('Y-m-d H:i') : 'Null' }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3 fw-bold">Updated At:</div>
                    <div class="col-md-9">{{$user->updated_at ? $user->updated_at->format('Y-m-d H:i') : 'Null' }}</div>
                </div>
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('admin.users.orders.index', $user) }}"
                       class="btn btn-sm btn-primary me-1">Orders</a>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
