@extends('admin.dashboard')
@section('content')
<hr/>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header"><h3>Update Profile</h3></div>

                <div class="card-body well">
                    <form action="{{route('admin.profile.update')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group ">
                            <label class="col-md-4 col-form-label text-md-right">{{ __(' Name') }}</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}">
                                <span class="text-danger">{{$errors->has('name')?$errors->first('name'):''}}</span>
                            </div>
                        </div>
                        
                        <div class="form-group ">
                            <label class="col-md-4 col-form-label text-md-right">{{ __(' Email') }}</label>
                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" value="{{ Auth::user()->email }}">
                                <span class="text-danger">{{$errors->has('email')?$errors->first('email'):''}}</span>
                            </div>
                        </div>
                        
                        <div class="form-group ">
                            <label class="col-md-4 col-form-label text-md-right">{{ __(' Image') }}</label>
                            <div class="col-md-6">
                                <input type="file" class="form-control" name="image">
                            </div>
                        </div>
                        
                        <div class="form-group ">
                            <div class="form-group ">
                                <label class="col-md-4 col-form-label text-md-right">{{ __(' About ') }}</label>

                                <div class="col-md-6">
                                    <textarea name="about" rows="5" class="form-control">{{ Auth::user()->about}}</textarea>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <a  href="{{route ('admin.dashboard')}}"class="btn btn-danger">
                                        Back
                                    </a>
                                    <button type="submit" class="btn btn-success">
                                        {{ __('Update Profile') }}
                                    </button>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
            </div>
        

    <div class="col-md-6">
            <div class="card">
                <div class="card-body well">
                    <form action="{{route('admin.password.update')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group ">
                            <label class="col-md-4 col-form-label text-md-right">{{ __(' Current Password') }}</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="old_password" placeholder="Type your old Password" >
                            </div>
                        </div>
                        
                        <div class="form-group ">
                            <label class="col-md-4 col-form-label text-md-right">{{ __(' New Password') }}</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password" placeholder="Enter new password" >
                            </div>
                        </div>
                        
                        <div class="form-group ">
                            <label class="col-md-4 col-form-label text-md-right">{{ __(' Confirm Password') }}</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm your password">
                            </div>
                        </div>
                        
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <a  href="{{route ('admin.dashboard')}}"class="btn btn-danger">
                                        Back
                                    </a>
                                    <button type="submit" class="btn btn-success">
                                        {{ __('Change Password') }}
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