@extends('Layouts.adminLayout')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Category</h1>
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
@if ($errors->any())    
@foreach ($errors->all() as $error)  
<div class="col-lg-12 mb-4">
    <div class="card bg-danger text-white shadow">
        <div class="card-body">
            {{$error}}
        </div>
    </div>
</div>
@endforeach
@endif

<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{route('admin.post.edit.category' , ['id'=>$category->id])}}" method="post" enctype="multipart/form-data">
@csrf
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="inputEmail4">Categort Name :</label>
                    <input type="text" value="{{$category->category_name}}" name="category_name" class="form-control" id="inputEmail4" placeholder="Category name">
                </div>
                <div class="col-md-12">
                    <div class="form-group p-0 col-md-4">
                        <label for="inputEmail4">Parent Name :</label>
                        <select type="text" name="parent_category_name" class="form-control" id="inputEmail4" placeholder="Category name">
                            <option value="null">No Parent</option>
                            @foreach ($categories as $cat)
                            <option value="{{$cat->id}}" {{$category->parent_category == $cat->id ? 'selected' : ''}}>
                                {{$cat->category_name}}
                            </option>
                        @endforeach
                        
                        
                        </select>
                    </div>
                </div>
                <div class="form-group col-md-12">
                    <label for="inputPassword4">Category Image</label>
                    <br>
                    <div class="col-md-2">
                        <img src="{{ $category->category_image ? $category->category_image : "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTI4PG970kLEIAwXbJGaMfq5tlVDqnBbuDP_MRmm2JlhA&s" }}"
                            class="image-file object-fit-cover overflow-hidden ratio ratio-16x9" id="image_file" width="100%" alt="">
                    </div>
                    <br>
                    <input type="file" name="category_image" id="customFile" placeholder="Password">
                </div>
                <div class="form-group col-md-12">
                    <button type="submit" class="btn btn-primary" id="">Edit Category </button>
                </div>
            </div>
        </form>
    </div>
</div>
@push('scripts')
<script>
let customFile = document.getElementById('customFile');

customFile.addEventListener('change', () => {
    const file = customFile.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('image_file').src = e.target.result;
        }
        reader.readAsDataURL(file);
    }
});
</script>
@endpush
@endsection