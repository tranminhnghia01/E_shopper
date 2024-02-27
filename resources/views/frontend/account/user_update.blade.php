@extends('frontend.layouts.app')
@section('container')
<div  class="col-sm-6">
    <div class="signup-form"><!--sign up form-->
        <h2>User Update!</h2>
        @if (session('msg'))
					<div class="alert alert-{{session('style')}}">
						{{ session('msg') }}
					</div>
				@endif
        <form action="" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <div class="col-md-12">
                        <input type="text" placeholder="Johnathan Doe" class="form-control form-control-line" name="name" value="{{ $user->name }}">
                        @error('name')
                        <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <input type="email" placeholder="johnathan@admin.com" class="form-control form-control-line" name="email" id="example-email"  value="{{ $user->email}}">
                        @error('email')
                        <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <input type="password" class="form-control form-control-line" name="password"  value="" placeholder="..........">
                        @error('password')
                        <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12">
                        <input type="text" placeholder="123 456 7890" class="form-control form-control-line" name="phone" value="{{ $user->phone }}">
                        @error('phone')
                        <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <input type="text" placeholder="123 456 7890" class="form-control form-control-line" name="address" value="{{ $user->address }}">
                        @error('phone')
                        <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <select class="form-control form-control-line" name="id_country">
                            @foreach ($country as $key )
                                <option  value="{{  $key->id }}">{{ $key->country_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-md-12">
                        <input type="file" class="form-control form-control-line" name="avatar">
                        @error('avatar')
                        <span style="color: red"></span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-12">
                        <button class="btn btn-success">Update Profile</button>
                    </div>
                </div>
        </form>
    </div><!--/sign up form-->
</div>

@endsection