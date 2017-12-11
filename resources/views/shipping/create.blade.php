@extends('layouts.app')

@section('content')

  <div class="col-12">
      <form action="/shipping" method="post" class="form" enctype="multipart/form-data">
      {{ csrf_field() }}
    <div class="card">
          <div class="card-header">
              <strong>Shipping :</strong> สร้างประเภทการขนส่ง
          </div>
          <div class="card-block">

                  <div class="form-group row">
                      <label class="col-2 col-form-label" for="input-name">ชื่อประเภทขนส่ง</label>
                      <div class="col-6">
                          <input type="text" id="input-name" required name="input-name" class="form-control col-6" placeholder="ชื่อขนส่ง">
                      </div>

                  </div>
                  <div class="form-group row">
                      <label class="col-2 col-form-label"  for="input-url">เวบสำหรับติดตาม</label>
                      <div class="col-6">
                          <input type="text" id="input-url" name="input-url" class="form-control col-6" placeholder="เวบ Tracking">
                      </div>

                  </div>
                  {{-- <div class="form-group row">
                    <label for="base-image" class="col-2 col-form-label">โลโก้</label>
                    <div class="col-10">
                        <input type="file" class="form-control-file" id="base-image" name="base_image" aria-describedby="fileHelp">
                        <small id="fileHelp" class="form-text text-muted">กรุณาเลือกไฟล์ jpg หรือ png สำหรับ logo.</small>
                    </div>

                  </div> --}}


          </div>
          <div class="card-footer">
              <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> เพิ่ม</button>
             <a href="/shipping" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> ยกเลิก</a>
              
          </div>
      </div>
      </form>
  </div>

@endsection
