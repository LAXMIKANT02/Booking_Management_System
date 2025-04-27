@extends('layout.baseview')
@section('title','Signup')
@section('style')
<style>
</style>
@endsection
@section('content')
    <div class="container h-100 mt-5">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="card" style="width:25rem">
                <div class="mt-4 mb-2">
                    <img class="mx-auto d-block" src="{{asset('assets\images\logo.png')}}" alt="logo" width="60">
                </div>
                <div class="mt-2 mb-2">
                    <h5 class="card-title text-center">Signup</h5>
                </div>
                <div class="mt-2 mb-2">
                    <p class="card-title text-center">Kindly Provide your Information for Registration</p>
                </div>
                <div class="card-body">

                @if ($errors->any())
                  <div class="alert alert-danger">
                          <ul>
                          @foreach ($errors->all() as $error)
                                   <li>{{ $error }}</li>
                                        @endforeach
                         </ul>
                     </div>
                        @endif

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form action="{{route('signup.create')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="phone_no" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="phone_no" name="phone_no" placeholder="Phone Number">
                            @error('phone_no')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="confirmpassword" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="confirmpassword" name="password_confirmation" placeholder="Confirm Password">
                            @error('password_confirmation')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">                           
                            <button type="submit" class="btn btn-primary mb-3" >Create User</button> 
                        </div>

                        <div class="mb-3">                           
                            <p class="card-title ">Already have an account? <a href="{{route('login')}}" style="text-decoration:none">Click to login</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('customjs')
<script>
</script>
@endsection
