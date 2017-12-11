@extends('layouts.app')

@section('content')


<div class="col-8 offset-2" style="box-shadow: rgba(0, 0, 0, 0.47) 0px 0px 53px;">
  <div class="head-line secondary-text" style="color: rgb(170, 170, 170);"><h2>ERROR(404) : </h2></div>
  <div class="subheader" style="color: rgb(73, 73, 73);"><!-- react-text: 138 -->Oops, the page you're<!-- /react-text --><br><!-- react-text: 140 -->looking for does not exist.<!-- /react-text --></div>
  <div class="hr"></div>
  <div class="">
    {{  $exception->getMessage() }}
  </div>
  <div class="context" style="color: rgb(170, 170, 170);">You may want to head back to the homepage. If you think something is broken, report a problem.</div>
  <br>
  <div class="buttons-container">
    <a class="btn" href="/home" target="" style="background: rgb(46, 204, 113); color: rgb(255, 255, 255);">
      <span class="fa fa-home"></span>
      <!-- react-text: 147 -->Go To Homepage<!-- /react-text -->
    </a>


  </div>
  <br>
</div>
<br><br>

@endsection
