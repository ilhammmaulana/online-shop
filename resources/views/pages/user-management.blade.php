@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'User Management'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Users</h6>
                    <button type="button" class="btn bg-gradient-primary mt-1 mb-4" data-bs-toggle="modal"
                        data-bs-target="#createProduct">
                        Create user
                    </button>
                    <div class="modal fade" id="createProduct" tabindex="-1" role="dialog"
                        aria-labelledby="createModelProduct" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="createModelProduct">Craete User</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form enctype="multipart/form-data" action="{{ route('user-managements.store') }}"
                                        method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <img id="imagePreview" src="#" alt="Image Preview"
                                                style="display: none; max-width: 100%; max-height: 300px;">
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="name" class="h6">Name</label>
                                                <div class="form-group">
                                                    <input required type="text" name="name" class="form-control"
                                                        id="name" placeholder="User name">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="description" class="h6">Email</label>
                                                <div class="form-group">
                                                    <input required type="email" name="email" class="form-control"
                                                        id="email" placeholder="Email">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="password" class="h6">Password</label>
                                                <div class="form-group">
                                                    <input required placeholder="Password" name="password"
                                                        class="form-control" id="password" />
                                                    <span id="passwordError" class="text-danger"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="photo" class="h6">Product photo</label>
                                                <div class="form-group">
                                                    <input type="file" id="imageInput"
                                                        onchange="previewImage(event)"class="form-control" name="image">
                                                </div>
                                            </div>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn bg-gradient-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn bg-gradient-primary">Create</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Email
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Created at</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-3 py-1">
                                                <div>
                                                    <img src="{{ $user->image === null ? asset('assets/img/default.png') : url($user->image) }}"
                                                        class="avatar me-3" alt="image">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $user->name }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{ $user->email }}</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <p class="text-sm font-weight-bold mb-0">{{ $user->created_at }}</p>
                                        </td>
                                        <td class="align-middle text-end d-flex gap-2">
                                            <button type="button" class="btn btn-primary edit-button"
                                                data-bs-toggle="modal" data-bs-target="#editProduct"
                                                data-id="{{ $user->id }}" data-name="{{ $user->name }}"
                                                data-description="{{ $user->description }}"
                                                data-price="{{ (int) $user->price }}"
                                                data-category="{{ $user->category_id }}" data-stock="{{ $user->stock }}"
                                                data-image="{{ $user->image === null ? null : url($user->image) }}">

                                                Edit

                                            </button>
                                            <form action="{{ url('user-managements') . '/' . $user->id }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button TYPE="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
