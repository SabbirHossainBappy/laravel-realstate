@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Tables</a></li>
                <li class="breadcrumb-item active" aria-current="page">USERS List</li>
            </ol>
        </nav>
        {{-- search start --}}
        <div class="row">
            <div class="col-lg-12 stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Search Users</h4>
                        <form method="GET" action="">
                            <div class="row">
                                <div class="col-sm-2">
                                    <div class="mb-2">
                                        <label class="form-label">Id</label>
                                        <input type="text" name="id" class="form-control"
                                            value="{{ Request()->id }}" placeholder="Enter Id">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label">Name</label>
                                        <input type="text" name="name" class="form-control"
                                            value="{{ Request()->name }}" placeholder="Enter Name">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label">Uaser Name</label>
                                        <input type="text" name="username" class="form-control"
                                            value="{{ Request()->username }}" placeholder="Enter Username">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label">Email Id</label>
                                        <input type="text" name="email" class="form-control"
                                            value="{{ Request()->email }}" placeholder="Enter Email Id">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label"> Phone</label>
                                        <input type="text" name="phone" class="form-control"
                                            value="{{ Request()->phone }}" placeholder="Enter Phone">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="mb-4">
                                        <label class="form-label"> Website</label>
                                        <input type="text" name="website" class="form-control"
                                            value="{{ Request()->website }}" placeholder="Enter website">
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="mb-2">
                                        <label class="form-label"> Role</label>
                                        <select class=" form-control" name="role">
                                            <option value="">Select Role</option>
                                            <option value="admin" {{ Request()->role == 'admin' ? 'selected' : '' }}>Admin
                                            </option>
                                            <option value="agent"{{ Request()->role == 'agent' ? 'selected' : '' }}>Agent
                                            </option>
                                            <option value="user"{{ Request()->role == 'user' ? 'selected' : '' }}>User
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="mb-2">
                                        <label class="form-label "> Status</label>
                                        <select class=" form-control" name="status">
                                            <option value="">Select Status</option>
                                            <option value="active" {{ Request()->status == 'active' ? 'selected' : '' }}>
                                                Active</option>
                                            <option value="inactive"
                                                {{ Request()->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Search</button>
                            <a href="{{ url('admin/users') }}" class="btn btn-danger">Reset</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- end  search start --}}
        <br>

        <div class="row">
            <div class="col-lg-12 stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center flex-wrap ">
                            <h4 class="card-title">USERS List</h4>
                            <div class="d-flex align-items "> <a href="{{ url('admin/users/add') }}"
                                    class="btn btn-primary">Add User</a> </div>

                        </div>

                        <div class="table-responsive pt-3">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        {{-- <th>Website</th> --}}
                                        <th>Role</th>
                                        <th>Photo</th>
                                        <th>Status</th>
                                        {{-- <th>Created At</th> --}}
                                        <th>Updated At</th>
                                        {{-- <th>About</th> --}}
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($getRecord as $value)
                                        <tr class="table-primary text-dark">
                                            <td>{{ $value->id }}</td>
                                            <td>{{ $value->name }}</td>
                                            <td>{{ $value->username }}</td>
                                            <td>{{ $value->email }}</td>
                                            <td>{{ $value->phone }}</td>
                                            <td>{{ $value->address }}</td>
                                            {{-- <td>{{ $value->website }}</td> --}}
                                            <td>
                                                @if ($value->role == 'admin')
                                                    <span class="badge bg-info">Admin</span>
                                                @elseif ($value->role == 'agent')
                                                    <span class="badge bg-primary">Agent</span>
                                                @elseif ($value->role == 'user')
                                                    <span class="badge bg-success">User</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if (!empty($value->photo))
                                                    <img src="{{ asset('upload/' . $value->photo) }}"
                                                        style="width: 25%;   height:25%;">
                                                @endif
                                            </td>
                                            <td>
                                                @if ($value->status == 'active')
                                                    <span class="badge bg-info">Active</span>
                                                @elseif ($value->status == 'inactive')
                                                    <span class="badge bg-danger">Inactive</span>
                                                @endif
                                            </td>
                                            {{-- <td>{{ date('d-m-Y', strtotime($value->created_at)) }}</td> --}}
                                            <td>{{ date('d-m-Y', strtotime($value->updated_at)) }}</td>
                                            {{-- <td>{{ $value->about }}</td> --}}
                                            <td>
                                                <a class="dropdown-item d-flex align-items-center"
                                                    href="{{ url('admin/users/view/' . $value->id) }}"><svg
                                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-eye icon-sm me-2">
                                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                        <circle cx="12" cy="12" r="3"></circle>
                                                    </svg>
                                                    <span class="">View</span></a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="100%">No Record Found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div style="padding: 10px; float: right;">
                            {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
