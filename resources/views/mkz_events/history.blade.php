@extends('layouts.app')
@section('title','create mkz event')

@section('content')

<style>
.opt {
  /* margin-top: 100px; */
  /* margin-bottom: 100px; */
  /* margin-right: 150px; */
  margin-left: 25px;
}
.btn-sq-lg {
  width: 110px !important;
  height: 110px !important;
}
</style>

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>            
@endif

@component('components.searchbar')
@endcomponent

<div class="card ">
    @if(isset($data->deleted_at ))
    <div class="card-header container-fluid alert-danger">
        <div class="row">
            <div class="col-sm-11">
                @if(isset($data->bez_ravel))
                {{$data->bez_ravel}}
                @endif
                <i class="fa fa-ban"></i>
                Artikel ist nicht mehr aktiv  
                {{-- <input type="button" value="edit" style="float: right;">               --}}
            </div>
            <div class="col-sm-1 ">
                <button  class="btn btn-secondary btn-sm" style="float: right;">Edit</button>
                {{-- <button class="btn btn-primary" style="margin-left: 1em">Edit</button> --}}
            </div>
        </div>
    </div>
    @else
    <div class="card-header container-fluid alert-primary">
        <div class="row">
            <div class="col-sm-11">
                @if(isset($data->bez_ravel))
                {{$data->bez_ravel}}
                @endif
            </div>
            <div class="col-sm-1 ">
                <button class="btn btn-secondary btn-sm" style="float: right;">Edit</button>
            </div>
        </div>
    </div>
    @endif
    <div class="card-body ">
        
                @if(isset($data ))
                    <p class="card-text">id_club : {{$data->id_club}}  ,  snnr : {{$data->snnr}}  ,  lb-nr : {{$data->id_liftboy}}  ,  baujahr : {{$data->baujahr}}</p>
                    @else
                    <p class="card-text">Keine Stammdaten vorhanden !</p>
                @endif
                
                @if(!isset($xdata))
                    <p class="card-text">Keine Artikeltyp erkannt !</p>
                @endif 
                @if(!isset($xdata))
                    <p class="card-text">Keine Artikel erkannt !</p>
                @endif 
                <div class="showMore" style="display:none">
                @if(isset($xdata))
                <hr>
                <p class="card-text">bez_mo2 : {{$data->bez_mo2}}</p>
                <p class="card-text">bez_hersteller : {{$data->bez_hersteller}}</p>
                <p class="card-text">Traglast : {{$data->traglast}} {{$data->norm}} {{$data->einsatz}}</p>
                @endif 
                @if(isset($xdata))
                <p class="card-text">Artikeltyp : {{$data->bez_artikeltyp}} / {{$data->klasse}}</p>
                <p class="card-text"></p>
                @endif 
                </div> 
                
                <button class="btn btn-info btn-sm" onclick="showMore()">...</button>
                @if(!isset($data->deleted_at ) AND (isset($data ))) 
                {{-- <button class="btn btn-success btn-sm"  style="float: right;">Prüfung</button> --}}
                <a href="{{ url('#/' . $data->id_liftboy) }}" class="btn btn-success btn btn-sq-lg  pull-right opt">
                    <i class="fa fa-sticky-note-o fa-5x"></i><br/>                    
                    ...event</a>
                <a href="{{ url('mkz_events/create/' . $data->id_liftboy) }}" class="btn btn-success btn btn-sq-lg  pull-right opt">
                    <i class="fa fa-check fa-5x"></i><br/>
                    Prüfung</a>
                @endif
                   
    </div> 
</div>
<br>
<div>
    @if(isset($xdata))
        @foreach ($xdata as $x)
        <div class="card-header container-fluid alert-dark">
            <div class="row">
                <div class="col-sm-11">
                    <p> {{ $x->created_at }} <i class="fa fa-caret-square-o-right"></i> {{ $x->event_typ }}-{{ $x->event_klasse }} <i class="fa fa-caret-square-o-right"></i>  {{ $x->name }}</p>
                </div>
                <div class="col-sm-1 ">
                    <button class="btn btn-secondary btn-sm" style="float: right;">Edit</button>
                </div>
            </div>
        </div>
        <div class="card-body ">
            <p>  </p>
            <p> id_event : {{ $x->id_event }} </p>
            
            @if (isset($x->id_expert))<p> Sachverständiger : {{ Auth::user()->getNameById('20') }} </p> @endif

            @if (isset($x->warnung))<p> warnung : {{ $x->warnung }} </p> @endif
            @if (isset($x->txt))<p> Bemerkung : {{ $x->txt }} </p> @endif
            @if (isset($x->txt_chain))<p> Bemerkung-Kette : {{ $x->txt_chain }} </p> @endif
            <hr>
            @if (isset($x->cbx_bremse1))<p> Bremse 1 justiert </p> @endif
            @if (isset($x->cbx_bremse2))<p> Bremse 2 justiert </p> @endif
            @if (isset($x->cbx_kupplung))<p> Kupplung justiert </p> @endif
            <hr>
            @if (isset($x->cbx_kfp))<p> Kettenführungsplatte getauscht </p> @endif
            @if (isset($x->cbx_dichtung1))<p> Dichtung 1 getauscht </p> @endif
            @if (isset($x->cbx_dichtung2))<p> Dichtung 2 getauscht  </p> @endif
            @if (isset($x->cbx_typenschild))<p> Typenschild getauscht </p> @endif

            {{-- @if (isset($x->dez_hakengrund))<p> Messung Haken-Grund: {{ $x->dez_hakengrund }} </p> @endif --}}
            
            @if (isset($x->cbx_bbelag1))<p> Breme1 Bremsbelag getauscht </p> @endif
            @if (isset($x->cbx_bbelag2))<p> Breme2 Bremsbelag getauscht  </p> @endif
            @if (isset($x->cbx_kbelag))<p> Kupplungsbeläge getauscht </p> @endif
            <hr>
            @if (isset($x->cbx_haken_service))<p> Haken geöffnet </p> @endif
            @if (isset($x->cbx_kf_service))<p> Kettenführung gesichtet </p> @endif
            @if (isset($x->cbx_kontakte))<p> Kontakte nachgezogen </p> @endif
            @if (isset($x->cbx_kupplung_service))<p> Kupplungsbaugruppe gesichtet </p> @endif
            <hr>
            @if (isset($x->cbx_haken_ufo))<p> cbx_haken_ufo : {{ $x->cbx_haken_ufo }} </p> @endif
            @if (isset($x->cbx_stopper_ufo))<p> cbx_stopper_ufo : {{ $x->cbx_stopper_ufo }} </p> @endif
            <hr>
            @if (isset($x->dez_hakenmaul))<p> Messung : Haken-Maul : {{ $x->dez_hakenmaul }}  ,  Haken-Grund: {{ $x->dez_hakengrund }} </p> @endif
            @if (isset($x->B1_SO))<p> Messung : B1_SO : {{ $x->B1_SO }}  ,  B1_SU : {{ $x->B1_SU }}  ,  B1_SL : {{ $x->B1_SL }}</p> @endif
                {{-- @if (isset($x->B1_SU))<p> B1_SU : {{ $x->B1_SU }} </p> @endif
                @if (isset($x->B1_SL))<p> B1_SL : {{ $x->B1_SL }} </p> @endif --}}
            @if (isset($x->B2_SO))<p> Messung : B2_SO : {{ $x->B2_SO }}  ,  B2_SU : {{ $x->B2_SU }}  ,  B2_SL : {{ $x->B2_SL }} </p> @endif
            {{-- @if (isset($x->B2_SU))<p> B2_SU : {{ $x->B2_SU }} </p> @endif
            @if (isset($x->B2_SL))<p> B2_SL : {{ $x->B2_SL }} </p> @endif --}}
            {{-- @if (($x->B1_SO) == null || ($x->B1_SU) == null || ($x->B1_SL) == null ) <p> keine Luftspaltmaße für Bremse 1 </p> @endif
            @if (($x->B2_SO) == null || ($x->B2_SU) == null || ($x->B2_SL) == null ) <p> keine Luftspaltmaße für Bremse 2 </p> @endif --}}


            
            
            {{-- <button class="btn btn-info btn-sm" onclick="showMore()">...</button> --}}
        </div>
           
        @endforeach    
    @endif
</div>

<script>
 function showMore() {
     $(".showMore").toggle();
 };   

</script>        
@endsection
