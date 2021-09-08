@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row custom-login">
        <div class="col-sm-4 m-auto">
            <form action="register" method="post">
                @csrf
                <div class="form-group">
                    <label for="exampleInputPassword1">User Name</label>
                    <input type="text" name="name" class="form-control" id="exampleInputPassword1" placeholder="User Name">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                </div>
                
                   
                <button type="submit" class="btn btn-primary">Register</button>
            </form>
        </div>
    </div>
</div>
@endsection