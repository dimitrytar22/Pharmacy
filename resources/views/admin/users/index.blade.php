@extends('layouts.admin')

@section('title')
    Users
@endsection

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="text-primary">Manage Users</h2>
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Add New User</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover align-middle">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Email Verified</th>
                    <th>Password</th>
                    <th>Role</th>
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td class="text-primary fw-semibold"><a href="{{route('admin.users.show', $user->id)}}">{{ $user->name }}</a></td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->email_verified_at ? $user->email_verified_at->format('Y-m-d') : 'Not verified' }}</td>
                        <td>••••••••</td>
                        <td><span class="badge bg-primary">{{ $user->role }}</span></td>
                        <td class="text-center">
                            <a href="{{ route('admin.users.orders.index', $user) }}" class="btn btn-sm btn-primary me-1">Orders</a>
                            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-primary me-1">Edit</a>
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mt-3">
            {{ $users->links() }}
        </div>
    </div>
@endsection
