@extends('layouts.app')
@section('title','create mkz event')


{{-- 
// id_test
// is_uvv
// id_liftboy
// date
// pruefer
// id_user Aufsteigend 1
    // cbx_bremse1
    // cbx_bremse2
    // cbx_kupplung
    // cbx_kfp
    // cbx_dichtung1
// cbx_typenschild
// dez_hakenmaul
// dez_hakengrund
    // txt
    // txt_chain
    // warnung
// traglast
// id_article
    // cbx_haken_service
// date_sv
// baujahr
    // cbx_bbelag1
    // cbx_bbelag2
    // cbx_kbelag
    // cbx_dichtung2
// sv_faellig
    // cbx_kf_service
    // cbx_kontakte
// DEKRA_PRUEFER
// EXTERN
// REP_BESCHREIBUNG
// TEILE
    // cbx_kupplung_service
    // cbx_haken_ufo
    // cbx_stopper_ufo
// B1_SO
// B1_SU
// B1_SL
// B2_SO
// B2_SU
// B2_SL 
// Kenziffern ....müssen die überhaupt hier rein ???
// Kenziffern ....müssen die überhaupt hier rein ???
// umbauHaken (noch nicht in Datenbank) müssen die überhaupt hier rein ???
// umbauKette (noch nicht in Datenbank) müssen die überhaupt hier rein ???
--}}
@section('content')
<style>
    /* input[type=radio] {
    width: 30px;
    height: 30px;
} */
/* Customize the label (the container) */
.contain {
  display: block;
  position: relative;
  padding-left: 35px;
  margin-bottom: 12px;
  cursor: pointer;
  /* font-size: 22px; */
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Hide the browser's default radio button */
.contain input {
  /*position: absolute;*/
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}

/* Create a custom radio button */
.checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 25px;
  width: 25px;
  background-color: #eee;
  border-radius: 50%;
}

/* On mouse-over, add a grey background color */
.contain:hover input~.checkmark {
  background-color: #ccc;
}

/* When the radio button is checked, add a blue background */
.contain input:checked~.checkmark {
  background-color: #2196F3;
}

/* Create the indicator (the dot/circle - hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the indicator (dot/circle) when checked */
.contain input:checked~.checkmark:after {
  display: block;
}

/* Style the indicator (dot/circle) */
.contain .checkmark:after {
  top: 9px;
  left: 9px;
  width: 8px;
  height: 8px;
  border-radius: 50%;
  background: white;
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




<div class="container">
    <form method="post" action="{{ route('mkz_events.store') }}">
        <input type="hidden"  name="id_liftboy" value={{$id_liftboy}}>
        <input type="hidden" name="id_eventtyp" value="1">
        @csrf
        <div class="card-deck mb-2 text-center">    
            <div class="card mb-2 box-shadow">
                <div class="card-header">
                    <h4 class="my-0 font-weight-normal">Kupplung angefahren</h4>
                </div>
                <div class="card-body d-flex flex-column">    
                    <label>
                        
                        <input type="checkbox" name="cbx_haken_ufo" value= "1" onClick="auswahl()"/>
                        <span></span>Haken angefahren
                    </label>
                    <label>
                        
                        <input type="checkbox" name="cbx_stopper_ufo" value= "1" onClick="auswahl()"/>
                        <span></span>Stopper angefahren
                    </label>
                </div>
            </div>
            <div class="card mb-2 box-shadow">
                <div class="card-header">
                    <h4 class="my-0 font-weight-normal">Justage</h4>
                </div>
                <div class="card-body d-flex flex-column">    
                    <div class="col">
                        <label>
                             
                            <input type="checkbox" name="cbx_bremse1" value="1" onClick="auswahl()"/>
                            <span></span>Bremse 1
                        </label>
                        <label>
                            
                            <input type="checkbox" name="cbx_bremse2" value= "1" onClick="auswahl()"/>
                            <span></span>Bremse 2
                        </label>
                        <label>
                    
                            <input type="checkbox" name="cbx_kupplung" value= "1" onClick="auswahl()"/>
                            <span></span>Kupplung
                        </label>                
                </div>
                </div>
            </div>
        </div>
        <div class="card-deck mb-2 text-center">    
            <div class="card mb-2 box-shadow">
                <div class="card-header">
                    <h4 class="my-0 font-weight-normal">Verschleißteile</h4>
                </div>
                <div class="card-body d-flex flex-column">    
                    <label>
                        
                        <input type="checkbox" name="cbx_bbelag1" value= "1" onClick="auswahl()"/>
                        <span></span>Bremsbelag 1
                    </label>
                    <label>
                        
                        <input type="checkbox" name="cbx_bbelag2" value= "1" onClick="auswahl()"/>
                        <span></span>Bremsbelag 1
                    </label>
                    <label>
                        
                        <input type="checkbox" name="cbx_kbelag" value= "1" onClick="auswahl()"/>
                        <span></span>Kupplungsbelag
                    </label>
                    <label>
                        
                        <input type="checkbox" name="cbx_kfp" value= "1" onClick="auswahl()"/>
                        <span></span>Kettenführungsplatte
                    </label>
                    <label>
                        <input type="checkbox" name="cbx_dichtung1" value= "1" onClick="auswahl()"/>
                        <span></span>Dichtung 1
                    </label>
                    <label>
                        <input type="checkbox" name="cbx_dichtung2" value= "1" onClick="auswahl()"/>
                        <span></span>Dichtung 2
                    </label>
                </div>
            </div>
            <div class="card mb-2 box-shadow">
                <div class="card-header">
                    <h4 class="my-0 font-weight-normal">Zyklisch</h4>
                </div>
                <div class="card-body d-flex flex-column">    
                    <div class="col">
                        <label>
                            <input type="checkbox" name="cbx_kf_service" value= "1"/>
                            <span></span>Kettennuß gesichtet
                        </label>
                        <label>
                            <input type="checkbox" name="cbx_kontakte" value= "1"/>
                            <span></span>Kontakte nachgezogen
                        </label>
                        <label>
                            <input type="checkbox" name="cbx_haken_service" value= "1"/>
                            <span></span>Haken geöffnet
                        </label>
                        <label>
                            <input type="checkbox" name="cbx_kupplung_service" value= "1"/>
                            <span></span>Kupplung geöffnet
                    </label>
                </div>
                </div>
            </div>
        </div>
        <div class="card-deck mb-2 text-center">    
            <div class="card mb-2 box-shadow">
                <div class="card-header">
                    <h4 class="my-0 font-weight-normal">Bemerkungen</h4>
                </div>
                <div class="card-body d-flex flex-column">    
                    <p class="card-text">Allgemein</p>
                    <textarea class="form-control" name ="txt" rows="3" cols="100" maxlength="480" wrap="soft"></textarea>
                    <p class="card-text">Kette</p>
                    <textarea class="form-control" name ="txt_chain" rows="2" cols="100" maxlength="480" wrap="soft"></textarea>
                </div>
            </div>
            <div class="card mb-2 box-shadow">
                <div class="card-header">
                    <h4 class="my-0 font-weight-normal">Warnungen anlegen</h4>
                </div>
                <div class="card-body d-flex flex-column">
                    <textarea class="form-control" name="warnung" cols="100" rows="2" maxlength="480" wrap="soft"></textarea> 
                </div>
            </div>
        </div>
        <div class="card-deck mb-2 text-center">    
            <div class="card mb-2 box-shadow">
                <div class="card-header">
                    <h4 class="my-0 font-weight-normal">Haken Maße</h4>
                </div>
                <div class="card-body d-flex flex-column">    
                    <label >Hakenmaß A (Hakengrund)</label>
                            <input class="number" size="5" maxlength="5" name="dez_hakenmaul" id ="nummer1">
                    <label >Hakenmaß B (Hakenmaul)</label>
                            <input class="number" size="5" maxlength="5" name="dez_hakengrund">
                </div>
            </div>
            <div class="card mb-2 box-shadow">
                <div class="card-header">
                    <h4 class="my-0 font-weight-normal">Luftspalt Maße</h4>
                </div>
                <div class="card-body d-flex flex-column">    
                    <div class="row">
                           
                        <div class="col-md-4 ">
                          {{-- <div class="form-group"> 
                              <div class="slidecontainer">
                                  <input type="input" id="myValue1" name="B1_SO" placeholder="Bremse_1 Oben" readonly>
                                  <input type="range" min="0.00" max="0.80" value="0" step="0.05" class="slider" id="myRange1">
                              </div>
                          </div>   --}}
                          {{-- <div class="form-group"> 
                              <div class="slidecontainer">
                                  <input type="input" id="myValue2" name="B1_SU" placeholder="Bremse_1 Unten" readonly>
                                  <input type="range" min="0.00" max="0.80" value="0" step="0.05" class="slider" id="myRange2">
                                  
                              </div>
                          </div>   --}}
                          {{-- <div class="form-group"> 
                              <div class="slidecontainer">
                                  <input type="input" id="myValue3" name="B1_SL" placeholder="Bremse_1 Links" readonly>
                                  <input type="range" min="0.00" max="0.80" value="0" step="0.05" class="slider" id="myRange3">
                                  
                              </div>
                          </div>                   --}}
                      </div>
                      <div class="col-md-4">
                          {{-- <div class="form-group"> 
                              <div class="slidecontainer">
                                  <input type="input" id="myValue4" name="B2_SO" placeholder="Bremse_2 Oben" readonly>
                                  <input type="range" min="0.00" max="0.80" value="0" step="0.05" class="slider" id="myRange4">
                                  
                              </div>
                          </div>   --}}
                          {{-- <div class="form-group"> 
                              <div class="slidecontainer">
                                  <input type="input" id="myValue5" name="B2_SU" placeholder="Bremse_2 Unten" readonly>
                                  <input type="range" min="0.00" max="0.80" value="0" step="0.05" class="slider" id="myRange5">
                                  
                              </div>
                          </div>   --}}
                          {{-- <div class="form-group"> 
                              <div class="slidecontainer">
                                  <input type="input" id="myValue6" name="B2_SL" placeholder="Bremse_2 Links" readonly>
                                  <input type="range" min="0.00" max="0.80" value="0" step="0.05" class="slider" id="myRange6">  
                                </div>
                            </div>                   --}}
                        </div>
                    </div>
                    <div class="form-group row justify-content-md-center">
                        <div class="col-auto" >
                            <input type="input" id="myValue1" name="B1_SO" placeholder="Bremse_1 Oben" readonly>
                            <input class="form-control" type="range" min="0.00" max="0.80" value="0" step="0.05" class="slider" id="myRange1">
                        </div>
                        <div class="col-auto">
                            <input type="input" id="myValue4" name="B2_SO" placeholder="Bremse_2 Oben" readonly>
                            <input class="form-control" type="range" min="0.00" max="0.80" value="0" step="0.05" class="slider" id="myRange4">
                        </div>
                        
                    </div>
                    <div class="form-group row justify-content-md-center">
                        <div class="col-auto" >
                            <input type="input" id="myValue2" name="B1_SU" placeholder="Bremse_1 Unten" readonly>
                            <input class="form-control" type="range" min="0.00" max="0.80" value="0" step="0.05" class="slider" id="myRange2">
                        </div>
                        <div class="col-auto">
                            <input type="input" id="myValue5" name="B2_SU" placeholder="Bremse_2 Unten" readonly>
                            <input class="form-control" type="range" min="0.00" max="0.80" value="0" step="0.05" class="slider" id="myRange5">
                        </div>
                        
                    </div>
                    <div class="form-group row justify-content-md-center">
                        <div class="col-auto" >
                            <input type="input" id="myValue3" name="B1_SL" placeholder="Bremse_1 Links" readonly>
                            <input class="form-control" type="range" min="0.00" max="0.80" value="0" step="0.05" class="slider" id="myRange3">
                        </div>
                        <div class="col-auto">
                            <input type="input" id="myValue6" name="B2_SL" placeholder="Bremse_2 Links" readonly>
                            <input class="form-control" type="range" min="0.00" max="0.80" value="0" step="0.05" class="slider" id="myRange6">
                        </div>
                        
                    </div>
                </div>
            </div>
            
        </div>
        <div class="card-deck mb-2 text-center">    
            
            <div class="card mb-2 box-shadow">
                <div class="card-header">
                    <h4 class="my-0 font-weight-normal">Status</h4>
                </div>
                <div class="card-body d-flex flex-column">    
                    <div class="col-auto">
                        
                        <div style="background-color: rgb(250, 248, 248)"><p>Kette-Umbau</p></div>
                        <form>
                            <label class="radio-inline contain">kein Umbau
                            <input type="radio" name="optradio" checked="true">
                            <span class="checkmark"></span>
                            </label>
                            <label class="radio-inline contain">Umbau
                            <input type="radio" name="optradio">
                            <span class="checkmark"></span>
                            </label>
                            <label class="radio-inline contain">Rückbau
                            <input type="radio" name="optradio">
                            <span class="checkmark"></span>
                            </label>
                            
                        <label >Kennziffer Kette
                            <input type="input" name="kennK" size="10" maxlength="10">
                        </label>
                        <br>    
                        <label >Kennziffer Haken
                            <input type="input" name="kennH" size="10" maxlength="10">
                        </label>
                        <br>
                        <label >Länge der Kette
                            <input type="input" name="laenge" size="10" maxlength="10">
                        </label>
                    
                                       
                    </div>
                </div>
            </div>
        </div>
           
            
            
        
        <button type="submit">Submit</button>
    </form>
</div>

{{-- <div class="card" >
            <h5 class="card-header">Umbau Kette/Haken</h5>
            <div class="card-body">
                <div class="checkarea";>
                        <label >Kennziffer Kette
                            <input type="input" name="kennziff-K" size="10" maxlength="10">
                            </label>
                        <label >Kennziffer Haken
                            <input type="input" name="kennziff_h" size="10" maxlength="10"></label>
                        <label >Länge der Kette
                            <input type="input" name="kennziff_h" size="10" maxlength="10"></label>
                            </label>
                </div>  
                <hr>
                        <label>
                            <input type="checkbox" value="Umbau_doppel" name ="chkbx" onClick="auswahl()"/>
                            <span></span>Umbau Doppelstrang (noch nicht in Datenbank)
                        </label>
                        <label>Umbau Überlänge (noch nicht in Datenbank)
                            <input type="checkbox" value="Umbau_ueberlang" name ="chkbx" onClick="auswahl()"/>
                            <span></span> 
                        </label>
            </div> 
        
        </div>          --}}

<script>
    //hakenmaße Input Felder
$('input.number').keyup(function(event) {
      
      // skip for arrow keys
      if(event.which >= 37 && event.which <= 40){
          event.preventDefault();
      }
        
      $(this).val(function(index, value) {
          return value
              .replace(/\D/g, '')
              .replace(/\B(?=(\d{2})+(?!\d))/g, ".")
          ;
      });
  });

     
function lenghtChecked($param) {
    $("#inputid").css("color", "green");
}
//   checkbox toggle 
$(".chb").change(function() {
    $(".chb").prop('checked', false);
    $(this).prop('checked', true);
});


  
//   script for the slider s     
var slider1 = document.getElementById("myRange1");
var spalt1 = document.getElementById("myValue1");
spalt1.innerHTML = slider1.value;
var slider2 = document.getElementById("myRange2");
var spalt2 = document.getElementById("myValue2");
spalt2.innerHTML = slider2.value;
var slider3 = document.getElementById("myRange3");
var spalt3 = document.getElementById("myValue3");
spalt3.innerHTML = slider3.value;

slider1.oninput = function() {
//  spalt1.innerHTML = this.value;
    document.getElementById('myValue1').value = this.value;
}  
slider2.oninput = function() {
//  spalt2.innerHTML = this.value;
    document.getElementById('myValue2').value = this.value;
} 
slider3.oninput = function() {
//  spalt3.innerHTML = this.value;
    document.getElementById('myValue3').value = this.value;
} 

var slider4 = document.getElementById("myRange4");
var spalt4 = document.getElementById("myValue4");
spalt4.innerHTML = slider1.value;
var slider5 = document.getElementById("myRange5");
var spalt5 = document.getElementById("myValue5");
spalt5.innerHTML = slider2.value;
var slider6 = document.getElementById("myRange6");
var spalt6 = document.getElementById("myValue6");
spalt6.innerHTML = slider3.value;

slider4.oninput = function() {
//  spalt4.innerHTML = this.value;
    document.getElementById('myValue4').value = this.value;
}  
slider5.oninput = function() {
//  spalt5.innerHTML = this.value;
    document.getElementById('myValue5').value = this.value;
} 
slider6.oninput = function() {
//  spalt6.innerHTML = this.value;
    document.getElementById('myValue6').value = this.value;
}

        
</script>    
@endsection
