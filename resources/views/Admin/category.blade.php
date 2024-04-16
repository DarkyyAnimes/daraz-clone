@extends('Layouts.adminLayout')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Category</h1>
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
        <h6 class="m-0 font-weight-bold text-primary">Categories</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Category Name</th>                        
                        <th>Total Products </th>                                           
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Category Name</th>
                        <th>Total Products</th>
                        <th>Action </th>                    
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($categories as $category)                        
                        <tr>
                            <td>{{$category->category_name}}</td>
                            <td>{{0}}</td>                           
                            <td class="flex">                                
                                <a href="{{route('admin.edit.category',["id"=>$category->id] )}}" class="btn-primary btn">Edit</a>                                
                                <a href="{{route('admin.delete.category',["id"=>$category->id] )}}" class="btn-secondary btn">Delete</a>                                
                            </td>                       
                        </tr>
                    @endforeach                
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection