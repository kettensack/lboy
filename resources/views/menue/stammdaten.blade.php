@extends('layouts.app')

@section('content')
<style>

.body { padding-top:20px; }

.panel-body .btn:not(.btn-block) { width:120px;margin-bottom:10px; }

.btn-sq-lg {
  width: 150px !important;
  height: 150px !important;
}
</style>

<div class="container">
    <div class="row">
      <div class="col-lg-12">
        <p>
          <a href="/artikel" class="btn btn-sq-lg btn-warning">
            <br>
            <i class="fa fa-cubes fa-5x"></i><br/>
            Artikel-Typen
          </a>
          <a href="#" class="btn btn-sq-lg btn-dark">
            <br>
            <i class="fa fa-cubes fa-5x"></i><br/>
            Artikel-Klassen
          </a>
          <a href="#" class="btn btn-sq-lg btn-dark">
            <br>
            <i class="fa fa-cube fa-5x"></i><br/>
            Artikel Search
          </a>
          <a href="/kunden" class="btn btn-sq-lg btn-warning">
            <br>
            <i class="fa fa-address-card fa-5x"></i><br/>
            Kunden
          </a>
          
          <a href="#" class="btn btn-sq-lg btn-dark">
            <br>
            <i class="fa fa-group fa-5x"></i><br/>
            Benutzer
          </a>
        </p>
      </div>
  </div>
  
  
  
</div>  






@endsection 