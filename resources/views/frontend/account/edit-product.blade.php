@extends('frontend.layouts.app')
@section('container')
<div  class="col-sm-9">
    <div class="signup-form"><!--sign up form-->
        <h2>User Update!</h2>
        @if (session('msg'))
					<div class="alert alert-{{session('style')}}">
						{{ session('msg') }}
					</div>
				@endif
        <form  method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <div class="col-md-12">
                        <input type="text" placeholder="Name" class="form-control form-control-line" name="name" value="{{ $product->name }}">
                        @error('name')
                        <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-md-12">
                        <input type="text" placeholder="Price" class="form-control form-control-line" name="price" value="{{ $product->price }}">
                        @error('price')
                        <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                

                <div class="form-group">
                    <div class="col-sm-12">
                        <select class="form-control form-control-line" name="id_category">
                            @foreach ($category as $key )
                                @if ($key->id == $product->id_category)
                                    <option  value="{{  $key->id }}" selected>{{ $key->category_name }}</option>
                                @else
                                    <option  value="{{  $key->id }}" >{{ $key->category_name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <select class="form-control form-control-line" name="id_brand">
                            @foreach ($brand as $key )
                                @if ($key->id == $product->id_brand)
                                    <option  value="{{  $key->id }}" selected>{{ $key->brand_name }}</option>
                                @else
                                    <option  value="{{  $key->id }}" >{{ $key->brand_name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <select class="form-control form-control-line status" id="status" name="status">
                                <option value="0">new</option>
                                <option value="1">sale</option>
                        </select>
                    </div>
                </div>

                {{-- Show sale --}}
                <script>
                    $(document).ready(function(){
                        $('.group-sale').hide();
                        $('.status').change(function(){
                            var status = $('.status').val();
                            if (status ==0) {
                                $('.group-sale').hide();
                            }else{
                                $('.group-sale').show();
                            }
                        })
                    })
                </script>

                <div class="form-group group-sale">
                    <div class="col-md-4">
                        <input type="text" placeholder="0" class="form-control form-control-line" name="sale" value="" style="float: left;width:80px ;">
                        <p style=" display: inline;line-height: 40px;font-size: 18px;margin-left: 10px;">%</p>
                        @error('sale')
                        <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <input type="text" placeholder="Company profile" class="form-control form-control-line" name="company" value="{{ $product->company }}">
                        @error('company')
                        <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12">
                        <input type="file" class="form-control form-control-line" name="image[]" multiple="multiple">
                        @error('image')
                        <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group" >
                        @php
                            $image_product = json_decode($product->image);
                        @endphp 
                            @foreach ($image_product as $val)
                        <div class="col-3" style="float: left;padding: 15px">
                                <img src="{{ asset('frontend/images/product-details/small'.$val ) }}" alt="">
                                <input type="checkbox" style="height: 20px;" value="{{$val}}" name="hinhxoa[]">
                        </div>
                        @endforeach

                </div>
                
                
                <div class="form-group">
                    <div class="col-md-12">
                        <textarea name="detail" class="detail" placeholder="detail" rows="11">{{ $product->detail }}</textarea>
                        @error('avatar')
                        <span style="color: red"></span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-success">Edit</button>
                    </div>
                </div>
        </form>

    </div><!--/sign up form-->
</div>

@endsection