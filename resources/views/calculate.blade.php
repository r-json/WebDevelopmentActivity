@extends('common.main')
@section('title', 'Calculate')
@section('content')
    <style>
        .body-cont {
            color: blueviolet;
            font-size: 20px;
        }

        #fnamelabel {
            border: solid;
            border-width: 5px;
        }

        p {
            font-family: 'Times New Roman', Times, serif;
        }

        .body-cont .diff,
        .div-label {
            color: red
        }
    </style>

    <h1 style="color:blue">Calculate Page</h1>
       <i class="bi bi-android"></i>
    <h2>Sum: {{ $sum }}</h2>
    <h2 class="diff">Difference: {{ $difference }}</h2>
    <h2>Product: {{ $product }}</h2>
    <h2>Product and Sum: {{ $product }} and {{ $sum }}</h2>

    <div class="div-label">
        <label id="fnamelabel">SAMPLE LABEL 1</label>
        <button type="button" class="btn btn-danger">Danger</button>
    </div>

    <div class="container">
        <! -- provided by bootstrap -->
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Email address</label>
                <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Example textarea</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-4 col-sm-6 col-xs-4 border border-danger"> Col 4
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Example textarea</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
            </div>

            <div class="col-lg-12 col-md-4 col-sm-6 col-xs-4 border border-danger bg-info"> Col 4</div>
            <div class="col-lg-12 col-md-4 col-sm-6 col-xs-4 border border-danger"> Col 4</div>
        </div>
    </div>
@endsection