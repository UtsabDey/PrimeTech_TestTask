@extends('layouts.app')

@section('title', 'Profile')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h4>
                            Profile Settings
                            <div class="btn-group float-end">
                                <a href="{{ route('users.index') }}" class="btn btn-sm btn-info me-2"><i class="fas fa-list me-1"></i>Goto User List</a>
                                <a href="#" class="btn btn-primary btn-sm"
                                data-bs-toggle="modal" data-bs-target="#editPass"><i class="fas fa-edit me-2"></i>Edit
                                Password</a>
                            </div>
                        </h4>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('users.update', Auth::user()->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="" class="form-label">First Name</label>
                                        <input type="text" class="form-control" id="fname" name="fname"
                                            value="{{ $user->fname }}" placeholder="First Name"
                                            >
                                        @error('fname')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Last Name</label>
                                        <input type="text" class="form-control" id="lname" name="lname"
                                            value="{{ $user->lname }}" aria-describedby="" placeholder="Last Name"
                                            required>
                                        @error('lname')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="" class="form-label">User Name</label>
                                        <input type="text" class="form-control" id="uname" name="uname"
                                            value="{{ $user->uname }}" placeholder="User Name" required>
                                        @error('uname')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Date of Birth</label>
                                        <input type="date" class="form-control" id="dob" name="dob"
                                            value="{{ $user->dob }}" placeholder="User Name">
                                        @error('dob')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            value="{{ $user->email }}" placeholder="Email Address" required>
                                        @error('email')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Present address</label>
                                        <textarea name="address" class="form-control" id="address" cols="30" rows="2" placeholder="Address">{{ $user->address }}</textarea>
                                        @error('address')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Image</label>
                                        <input type="file" class="form-control" id="image" name="image"><br>
                                        Image: &nbsp;
                                        @if ($user->image)
                                            <img src="{{ asset('images/profile/' . $user->image) }}" alt=""
                                                width="70px" />
                                        @else
                                            <span class="text-danger">No Image Found</span>
                                        @endif
                                        @error('image')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="" class="form-label">NID</label>
                                        <input type="text" class="form-control" id="nid" name="nid"
                                            value="{{ $user->nid }}" placeholder="NID">
                                        @error('nid')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary btn-block">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('editpass')
@endsection
