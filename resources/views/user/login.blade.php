@extends('layouts.app')

@section('content')

<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
              <form action="/login" method="POST">

                    <div class="card-group mb-0">
                    <div class="card p-4">
                            <div class="card-block">
                                <h1>Login</h1>
                                <p class="text-muted">Sign In to your account</p>
                                {{ csrf_field() }}
                                <div class="input-group mb-3">
                                    <span class="input-group-addon"><i class="icon-user"></i>
                                    </span>
                                    <input type="text" class="form-control input-focus" placeholder="Username" name="username">
                                </div>
                                <div class="input-group mb-4">
                                    <span class="input-group-addon"><i class="icon-lock"></i>
                                    </span>
                                    <input type="password" class="form-control" placeholder="Password" name="password">
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <button type="submit" class="btn btn-primary px-4">Login</button>
                                    </div>
                                    <div class="col-6 text-right">
                                        <button type="button" class="btn btn-link px-0">Forgot password?</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card card-inverse card-primary py-5 d-md-down-none" style="width:44%">
                            <div class="card-block text-center">
                                <div class="text-center">
                                  <table class="table table-bordered">
                                       <th>TYPE</th>
                                       <th>USER</th>
                                       <th>PASS</th>
                                      
                                       <tr>
                                           <td class="text-left">Admin</td>
                                           <td class="text-left">admin</td>
                                           <td>1234</td>

                                       </tr>
                                       <tr>
                                           <td class="text-left">Supplier</td>
                                           <td class="text-left">zraj</td>
                                           <td>1234</td>
                                       </tr>
                                       <tr>
                                           <td class="text-left">Supplier</td>
                                           <td class="text-left">zzrrr</td>
                                           <td>1234</td>
                                       </tr>
                                       <tr>
                                           <td class="text-left">Reseller</td>
                                           <td class="text-left">reseller</td>
                                           <td>1234</td>
                                       </tr>
                                       <tr>
                                           <td class="text-left">Reseller</td>
                                           <td class="text-left">resellera</td>
                                           <td>1234</td>
                                       </tr>
                                       <tr>
                                           <td class="text-left">Seller</td>
                                           <td class="text-left">maytinee</td>
                                           <td>1234</td>
                                       </tr>
                                       <tr>
                                           <td class="text-left">Seller</td>
                                           <td class="text-left">seller</td>
                                           <td>1234</td>
                                       </tr>
                                  </table>


                                </div>
                            </div>
                        </div>
                    </div>


              </form>

            </div>
        </div>
    </div>

@endsection
