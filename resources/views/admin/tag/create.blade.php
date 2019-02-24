@extends('admin.dashboard')
@section('content')

<hr/>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <h3 class="text-center text-success"></h3>
                <div class="card-header"><h3>Add Tag</h3></div>

                <div class="card-body well">
                    <form action="{{route('admin.tag.store')}}" method="POST" >
                        @csrf

                        <div class="form-group ">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('Tag Name') }}</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="tagName">
                                <span class="text-danger">{{$errors->has('tagName')?$errors->first('tagName'):''}}</span>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <a  href="{{route ('admin.tag.index')}}"class="btn btn-danger">
                                    Back
                                </a>
                                <button type="submit" class="btn btn-success">
                                    {{ __('Save') }}
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