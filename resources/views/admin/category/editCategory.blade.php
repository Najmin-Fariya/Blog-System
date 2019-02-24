@extends('admin.dashboard')
@section('content')

<hr/>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <h3 class="text-center text-success"></h3>
                <div class="card-header"><h3>Edit Category</h3></div>

                <div class="card-body well">
                    <form action="{{route('admin.category.update',$category->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group ">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('Category Name') }}</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="categoryName" value="{{ $category-> categoryName}}">
                                <span class="text-danger">{{$errors->has('categoryName')?$errors->first('categoryName'):''}}</span>
                            </div>
                        </div>
                        
                        <div class="form-group ">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('Image') }}</label>

                            <div class="col-md-6">
                                <input type="file" class="form-control" name="image">
                                <span class="text-danger">{{$errors->has('image')?$errors->first('image'):''}}</span>
                            </div>
                        </div>
                        
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <a  href="{{route ('admin.category.index')}}"class="btn btn-danger">
                                    Back
                                </a>
                                <button type="submit" class="btn btn-success">
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection