@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">

        @include('_massage')

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/asers') }}">User</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add User</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <h6 class="card-title">Add User</h6>

                        <form class="forms-sample" method="POST" action="{{ url('admin/users/add') }}">
                            {{ csrf_field() }}
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Name <span style="color: red">*</span> </label>
                                <div class="col-sm-9">
                                    <input type="text" name="name" class="form-control" placeholder="Name" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Username<span style="color: red">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" name="username" class="form-control" placeholder="Username"
                                        required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Email<span style="color: red">*</span></label>
                                <div class="col-sm-9">
                                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                                    <span style="color:red">{{ $errors->first('email') }}</span>
                                </div>
                            </div>


                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Phone<span style="color: red">*</span></label>
                                <div class="col-sm-9">
                                    <input type="number" name="phone" class="form-control" placeholder="Phone" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Role<span style="color: red">*</span></label>
                                <div class="col-sm-9">
                                    <select name="role" class="form-control" required>
                                        <option value="">Select Role</option>
                                        <option value="admin">Admin</option>
                                        <option value="agent">Agent</option>
                                        <option value="user">User</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Status<span style="color: red">*</span></label>
                                <div class="col-sm-9">
                                    <select name="status" class="form-control" required>
                                        <option value="">Select Role</option>
                                        <option value="active">Active</option>
                                        <option value="inactive">InActive</option>
                                    </select>
                                </div>
                            </div>
                            {{-- <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Password</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" autocomplete="off" placeholder="Password"
                                        required>
                                </div>
                            </div> --}}
                            <button type="submit" class="btn btn-primary me-2">Submit</button>
                            <a href="{{ url('admin/users') }}" class="btn btn-secondary">Back</a>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
