@extends('common.main')
@section('title', 'Page')
@section('content2')
<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
     -->
    <style>
        .login-box {
            background-color: gainsboro;
            border: 3px solid transparent;
            border-radius: 8px; 
        }
    </style>
<!-- </head> -->

<!-- <body> -->
    <div class="container mt-3 mb-5">
        <div class="row g-4">
            
            <div class="col-lg-4 col-md-5">
                <form class="login-box border border-dark p-4">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1">
                    </div>
                    <div class="mb-3 d-flex align-items-center gap-3">
                        <button type="submit" class="btn btn-primary">Login</button>
                        <a href="#" class="text-decoration-underline">Forgot password?</a>
                    </div>
                </form>
            </div>

            <div class="col-lg-8 col-md-7 border text-center p-4">
                <h1 class="display-4 fw-bold">Pricing</h1>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                
                <div class="row g-4 mb-5">
                    <div class="col-lg-4">
                        <img src="/images/AdventureTime.png" class="img-fluid border border-dark" alt="Image 1">
                    </div>
                    <div class="col-lg-4">
                        <img src="/images/AdventureTime.png" class="img-fluid border border-dark" alt="Image 2">
                    </div>
                    <div class="col-lg-4">
                        <img src="/images/AdventureTime.png" class="img-fluid border border-dark" alt="Image 3">
                    </div>
                    <div class="col-lg-4">
                        <img src="/images/AdventureTime.png" class="img-fluid border border-dark" alt="Image 4">
                    </div>
                    <div class="col-lg-4">
                        <img src="/images/AdventureTime.png" class="img-fluid border border-dark" alt="Image 5">
                    </div>
                    <div class="col-lg-4">
                        <img src="/images/AdventureTime.png" class="img-fluid border border-dark" alt="Image 6">
                    </div>
                </div>

                <h2 class="mb-4">Sample</h2>
                <table class="table text-start">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">First</th>
                            <th scope="col">Last</th>
                            <th scope="col">Handle</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>John</td>
                            <td>Doe</td>
                            <td>@social</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
<!-- </body>
</html> -->
@endsection
