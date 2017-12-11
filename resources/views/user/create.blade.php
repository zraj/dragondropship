@extends('layouts.app')

@section('content')

<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
              <form action="/registration" method="POST">

                    <div class="card-group mb-0">
                    <div class="card p-4">
                            <div class="card-block">
                                <h1>เพิ่มผู้ใช้งาน</h1>
                                <p class="text-muted">create account</p>
                                {{ csrf_field() }}
                                <div class="input-group mb-3">
                                    <span class="input-group-addon">ชื่อ
                                    </span>
                                    <input type="text" class="form-control input-focus" placeholder="name" name="name">
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-addon">ชื่อ login
                                    </span>
                                    <input type="text" class="form-control" placeholder="Username" name="username">
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-addon">อีเมลล์
                                    </span>
                                    <input type="text" class="form-control" placeholder="email" name="email">
                                </div>
                                <div class="input-group mb-4">
                                    <span class="input-group-addon">กลุ่มผู้ใช้งาน
                                    </span>
                                   <select class="form-control" name="user_type">
                                       @foreach ($types as $type)
                                           <option value="{{$type->id}}">{{$type->type_name}}</option>
                                       @endforeach
                                   </select>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <button type="submit" class="btn btn-primary px-4">เพิ่ม</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="card card-inverse card-primary py-5 d-md-down-none" style="width:44%">
                            <div class="card-block text-center">
                                <div>

                                </div>
                            </div>
                        </div>
                    </div>


              </form>

            </div>
        </div>
    </div>

@endsection
