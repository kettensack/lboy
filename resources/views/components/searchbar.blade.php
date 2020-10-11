<div class="d-flex flex-column flex-sm-row align-items-center p-3 px-sm-4 sm-3 bg-white border-bottom box-shadow">
    <i class="my-0 mr-sm-auto font-weight-normal fa fa-search"></i>
    {{-- <nav class="my-2 my-md-0 mr-md-3">
      <a class="p-2 text-dark" href="#">#</a>
      <a class="p-2 text-dark" href="#">#</a>
      <a class="p-2 text-dark" href="#">#</a>
      <a class="p-2 text-dark" href="#">#</a>
    </nav> --}}
    {{-- <input id="id_liftboy" type="text" class="mt-auto" size="9" maxlength="9" placeholder="ID-nr" > --}}
    <form method="get" action="{{ route('searchBar.show' ) }}">
        
        @csrf
        <input class ="searchin" id="inputid" name ="inputid" type="text" size="9" maxlength="9" placeholder="ID" autofocus>
        <input class ="searchin" id="inputsn" name ="inputsn" type="text" size="9" maxlength="9" placeholder="SN">
        <input class ="searchin" id="inputlb" name ="inputlb" type="text" size="9" maxlength="9" placeholder="LB">
        {{-- <button type="button" id="btn_index" onclick="window.location='{{ url('/mkz/history') }}'">search</button> --}}
        <button type="submit" id="btn_index">Submit</button>
    </form>
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

    $(".searchin").focus(function () {
        $( ".searchin" ).not($(this)).val(null);

    }); 
       
</script>    