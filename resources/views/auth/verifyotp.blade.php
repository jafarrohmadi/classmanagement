@extends('layouts.app')

@section('content')
<div class="container be-detail-container">
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3" style="text-align: center;margin: 0 auto;">
            <br>
            <img src="https://cdn2.iconfinder.com/data/icons/luchesa-part-3/128/SMS-512.png" class="img-responsive" style="width:200px; height:200px;margin:0 auto;"><br>
            
            <h1 class="text-center">Verify your login</h1><br>
            <p class="lead" style="align:center"></p><p> we send an message to your telegram to make sure you own it. Please cek your telegram and enter the security code below to finish setting up your account</p>  <p></p>
        <br>
       
            <form method="post" id="veryfyotp" action="{{ route('verify-otp') }}">
                <div class="row">                    
                <div class="form-group col-sm-8">
                     <span style="color:red;"></span>
                     <input type="text" class="form-control" name="code" placeholder="Enter your OTP number" required="">
                </div>
                <button type="submit" class="form-group btn btn-primary  pull-right col-sm-3">Verify</button>
                </div>
            </form>
        <br><br>
        </div>
    </div>        
</div>
@endsection
