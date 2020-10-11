@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header h5">Artikelsuche / index blade</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <!-------------------------------------------->
                    <span class='glyphicon glyphicon-search' aria-hidden='true' data-toggle="tooltip" data-placement="bottom"
                    title="" data-original-title="Scanner Modus ON"
                    class="red-tooltip"></span>
                        
                    <input id="inputid" type="text" size="9" maxlength="9" placeholder="ID-nr" >
                    {{-- <input id="inputsn" type="text" size="9" maxlength="9" placeholder="SN-nr" >
                    <input id="inputlb" type="text" size="9" maxlength="9" placeholder="LB-nr" >  --}}
                    <button type="button" id="btn_index" onclick="window.location='{{ url('/') }}'">search</button>
                    <!--------------------------------------------> 
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col"> 
<span class="hauptspan" id="input_panel">
<div class="panel panel-default">
    
  <div class="panel-body">
      

      <div class="card" id="div_buttons_treffer">
  <h5 class="card-header h5">Featured</h5>
  <div class="card-body">
    <h5 class="card-title">Mötörkettenzug</h5>
    <p class="card-text">daten daten</p>
    <p class="card-text">daten daten</p>
    <p class="card-text">daten daten</p>  
        	<span id="div_button_new_uvv_anlegen"> 
                <button type="button" class="btn btn-primary" >UVV erfassen</button> 
                
            </span>
            <span id="div_button_new_sv_speichern"> 
                <button type="button" class="btn btn-secondary" id="btn_save_sv">SV speichern</button> 
            </span>
  </div>
</div>   
      
    </div>
</div>
</span>
</div>    


<script>
$( document ).ready(function() {
    $("#inputid").keyup(function(){  
        if($("#inputid").val().length == 9){
            $("#inputid").css("color", "orange");
            $("#btn_index").click()
        }
        else {
            $("#inputid").css("color", "gray");
        }    
    });    
});    
function lenghtChecked($param) {
    $("#inputid").css("color", "green");
}    
</script>   
@endsection 