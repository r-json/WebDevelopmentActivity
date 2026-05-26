@extends('common.main')
@section('title', 'Form')
@section('content3')

<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>    
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])     -->
    <style>
        .login-box {
            background-color: gainsboro;
            border: 3px solid transparent;
            border-radius: 8px; 
        }
    </style>
<!-- </head> -->

<!-- <body> -->
 <div class="container mt-5 mb-5">
        <div class="row g-4">
            
            <div class="col-lg-12 col-md-12">
                <form class="login-box border border-dark p-4" method = "POST" action = "{{route('user.submit')}}" >
                    @csrf
                    @if($errors->any())
                        @foreach($errors->all() as $error)
                            <div class="alert alert-danger" role="alert">
                                {{$error}}
                            </div>
                        @endforeach
                    @endif
                    <div class="mb-3">
                        <label for="exampleInputFirstName" class="form-label">First Name</label>
                        <input type="FirstName" class="form-control" id="exampleInputFirstName" name = "fname">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputMiddleName" class="form-label">Middle Name</label>
                        <input type="MiddleName" class="form-control" id="exampleInputMiddleName" name = "mname">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputLastName" class="form-label">Last Name</label>
                        <input type="LastName" class="form-control" id="exampleInputLastName" name = "lname">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp" name = "email">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword" name = "password">
                    </div>
                    <div class="mb-3 d-flex align-items-center gap-3">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="#" class="text-decoration-underline">Forgot password?</a>
                    </div>
                </form>

<!-- </body>
</html> -->
@endsection
