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
          <a href="/report2" class="btn btn-sq-lg btn-warning">
            <i class="fa fa-check fa-5x"></i><br/>
            Motorkettenzug
          </a>
          <a href="/report3" class="btn btn-sq-lg btn-warning">
            <i class="fa fa-check fa-5x"></i><br/>
            Motorkettenzug #Test#
          </a>
        </p>
      </div>
  </div>
  {{-- <div class="row">
    <div class="col-lg-12">
      <p>
        <a href="#" class="btn btn-sq-lg btn-primary">
          <i class="fa fa-check fa-5x"></i><br/>
          Leiter
        </a>
        
      </p>
    </div>
  </div> --}}
 {{--  <div class="row">
    <div class="col-lg-12">
      <p>
        <a href="#" class="btn btn-sq-lg btn-success">
          <i class="fa fa-check fa-5x"></i><br/>
          Auffanggurt
        </a>
        <a href="#" class="btn btn-sq-lg btn-success">
          <i class="fa fa-check fa-5x"></i><br/>
          Haltegurt
        </a>
        <a href="#" class="btn btn-sq-lg btn-success">
          <i class="fa fa-check fa-5x"></i><br/>
          Sitzgurt
        </a>
        <a href="#" class="btn btn-sq-lg btn-success">
          <i class="fa fa-check fa-5x"></i><br/>
          Verbindungselemente
        </a>
        <a href="#" class="btn btn-sq-lg btn-success">
          <i class="fa fa-check fa-5x"></i><br/>
          Verbindungsmittel
        </a>
        <a href="#" class="btn btn-sq-lg btn-success">
          <i class="fa fa-check fa-5x"></i><br/>
          Falldämpfer
        </a>
      </p>
    </div>
  </div> --}}
  {{-- <div class="row">
    <div class="col-lg-12">
      <p>
        
        <a href="#" class="btn btn-sq-lg btn-success">
          <i class="fa fa-check fa-5x"></i><br/>
          Haltesystem
        </a>
        <a href="#" class="btn btn-sq-lg btn-success">
          <i class="fa fa-check fa-5x"></i><br/>
          Rundschlinge
        </a>
        <a href="#" class="btn btn-sq-lg btn-success">
          <i class="fa fa-check fa-5x"></i><br/>
          Bandschlinge
        </a>
        <a href="#" class="btn btn-sq-lg btn-success">
          <i class="fa fa-check fa-5x"></i><br/>
          Anschlageinrichtung
        </a>
        <a href="#" class="btn btn-sq-lg btn-success">
          <i class="fa fa-check fa-5x"></i><br/>
          Helm
        </a>
        <a href="#" class="btn btn-sq-lg btn-success">
          <i class="fa fa-check fa-5x"></i><br/>
          Abseilgerät
        </a>  
      </p>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <p>
        <a href="#" class="btn btn-sq-lg btn-success">
          <i class="fa fa-check fa-5x"></i><br/>
          Höhensicherungsgeräte
        </a>
        <a href="#" class="btn btn-sq-lg btn-success">
          <i class="fa fa-check fa-5x"></i><br/>
          Steigschutzeinrichtungen /feste Führung
        </a>
        <a href="#" class="btn btn-sq-lg btn-success">
          <i class="fa fa-check fa-5x"></i><br/>
          Mitlaufendes Auffanggerät / bewegliche Führung
        </a>
        <a href="#" class="btn btn-sq-lg btn-success">
          <i class="fa fa-check fa-5x"></i><br/>
          Seilklemmen
        </a>
        <a href="#" class="btn btn-sq-lg btn-success">
          <i class="fa fa-check fa-5x"></i><br/>
          Seil - Kernmantelseile mit geringer Dehnung
        </a>
        <a href="#" class="btn btn-sq-lg btn-success">
          <i class="fa fa-check fa-5x"></i><br/>
          Seil - Dynamische Bergseile
        </a>
        
      </p>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <p>
        <a href="#" class="btn btn-sq-lg btn-success">
          <i class="fa fa-check fa-5x"></i><br/>
          Karabiner
        </a>
      </p>
    </div>
  </div> --}}
  
</div>  






@endsection 