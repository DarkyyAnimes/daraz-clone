@extends('Layouts.adminLayout')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Users</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
</div>
@if (session('message'))    
<div class="col-lg-12 mb-4">
    <div class="card bg-success text-white shadow">
        <div class="card-body">
            {{session('message')}}
        </div>
    </div>
</div>
@endif

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Sellers</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>User Name</th>
                        <th>Address</th>
                        <th>Email </th>
                        <th>Phone no</th>                    
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>User Name</th>
                        <th>Address</th>
                        <th>Email </th>
                        <th>Phone no</th>                    
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($users as $user)                        
                        <tr>
                            <td>{{$user->name}}</td>
                            <td>{{$user->address}}</td>
                            <td>{{$user->email }}</td>
                            <td>{{$user->phone_no}}</td>
                            <td class="flex">                                
                                <a href="{{route('admin.delete.user',["id"=>$user->id])}}" class="btn-secondary btn">Delete</a>                                
                            </td>                       
                        </tr>
                    @endforeach                
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection