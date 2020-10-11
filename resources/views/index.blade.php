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

@if (Route::has('login'))

                    @auth

                    @component('components.searchbar')
                    @endcomponent
                    
                    <div class="container">
                        <div class="row">
                          <div class="col-lg-12">
                            <p>
                              <a href="/dashboard" class="btn btn-sq-lg btn-success">
                                <br>
                                <i class="fa fa-user fa-5x"></i><br/>
                                {{-- Mein <br> --}}
                                Dashboard
                              </a>
                              <a href="/menue/reports" class="btn btn-sq-lg btn-info">
                                <br>
                                <i class="fa fa-signal fa-5x"></i><br/>
                                Reports
                                {{-- <br>anzeigen --}}
                            </a>
                             
                              <a href="#" class="btn btn-sq-lg btn-warning">
                                <br>
                                <i class="fa fa-file-pdf-o fa-5x"></i><br/>
                                Dokumente
                                {{-- <br>anzeigen --}}
                              </a>
                              <a href="/menue/stammdaten" class="btn btn-sq-lg btn-danger">
                                <br>
                                <i class="fa fa-cubes fa-5x"></i><br/>
                                Stammdaten
                                {{-- <br>anzeigen --}}
                              </a>
                              @if (Auth::user()->hasRole('admin'))
                              <a href="#" class="btn btn-sq-lg btn-dark">
                                <br>
                                <i class="fa fa-cog fa-5x"></i><br/>
                                Admin
                                {{-- <br>Backend --}}
                              </a>
                              @endif
                            </p>
                          </div>
                      </div>
                    </div>  
                    
                    @else
                        

                        @if (Route::has('register'))
                        <div class="mx-auto" style="width: 200px;">
                            <div class="card-body">
                                <h5 class="card-title">Sie sind nicht angemeldet</h5>
                                <i class="fa fa-braille fa-5x"></i><br/>  
                            </div>
                        </div>
                        @endif
                    @endauth

@endif

@endsection 