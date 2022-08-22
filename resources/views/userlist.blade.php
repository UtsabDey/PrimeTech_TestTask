@extends('layouts.app')

@section('title', 'User List')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h4>
                            All User List
                            <div class="btn-group float-end">
                                <a href="{{ route('users.show', Auth::user()->id) }}" class="btn btn-info btn-sm me-2"><i class="fas fa-user-cog me-1"></i>Profile Settings</a>
                                <a href="{{ route('users.index') }}" class="btn btn-primary btn-sm"
                                data-bs-toggle="modal" data-bs-target="#addUser"><i class="fas fa-plus me-2"></i>Add User</a>
                            </div>
                        </h4>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered table-striped table-hover" id="dataTable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">First Name</th>
                                    <th scope="col">Last Name</th>
                                    <th scope="col">User Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    <tr>
                                        <th scope="row">{{ $index++ }}</th>
                                        <td>{{ $user->fname }}</td>
                                        <td>{{ $user->lname }}</td>
                                        <td>{{ $user->uname }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td class="text-center">
                                            <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#deleteUser{{ $user->id }}"><i
                                                    class="fas fa-trash me-1"></i>Delete</a>
                                        </td>
                                    </tr>
                                    @include('deletemodal')
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('addmodal')
@endsection
