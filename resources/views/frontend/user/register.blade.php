<div class="col-sm-4">
    <div class="signup-form"><!--sign up form-->
        <h2>New User Signup!</h2>
        <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
            @csrf
                <input type="text" placeholder="User Name" name="name">
                @error('name')
                <span style="color: red">{{ $message }}</span>
                @enderror
                
                <input type="email" placeholder="Email Address" name="email" id="example-email">
                @error('email')
                <span style="color: red">{{ $message }}</span>
                @enderror

                <input type="password" name="password"  value="" placeholder="password">
                @error('password')
                <span style="color: red">{{ $message }}</span>
                @enderror

                <input type="file" name="avatar">
                @error('avatar')
                <span style="color: red"></span>
                @enderror

                <input type="text" placeholder="Your Phone" name="phone">
                @error('phone')
                <span style="color: red">{{ $message }}</span>
                @enderror

                <textarea rows="5"  name="address"></textarea>
                @error('address')
                <span style="color: red"></span>
                @enderror

                <select name="id_country">
                    @foreach ($country as $key )
                        <option  value="{{  $key->id }}">{{ $key->country_name }}</option>
                    @endforeach
                </select>
                
                <button class="btn btn-success">SignUp Profile</button>
        </form>
    </div><!--/sign up form-->
</div>