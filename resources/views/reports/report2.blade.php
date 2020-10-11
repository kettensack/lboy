

@extends('layouts.app')

@section('title','MKZ_index_blade')

@section('content')

<style>
	table {
	font-size: 12px;
	/* font-family: Impact, Charcoal, sans-serif; */
	}
	th {
	font-size: 12px;
	/* font-family: Impact, Charcoal, sans-serif; */
	}    

    th {
        background-color:#666060;
    }
</style> 

{{-- <form action = "{{ route('report.report1', ['jahr'=>$sjahr]) }}" method ="get"> --}}
    <form method="get" action="{{ route('report.report2' ) }}">
        <label for="year">  Jahr : </label>
        
        <select class="options" name="year" id="year" selected="selected">
            <option value="" disabled selected hidden>...</option>
            <option name = "year" value={{$jahr+4  }} > {{ $jahr+4 }}</option>
            <option name = "year" value={{$jahr+3  }} > {{ $jahr+3 }}</option>
            <option name = "year" value={{$jahr+2  }} > {{ $jahr+2 }}</option>
            <option name = "year" value={{$jahr+1  }} > {{ $jahr+1 }}</option>
            <option name = "year" value={{$jahr  }} > _{{ $jahr }}</option>
            <option name = "year" value={{$jahr-1}}>{{ $jahr-1 }}</option>
            <option name = "year" value={{$jahr-2}}>{{ $jahr-2 }}</option>
            <option name = "year" value={{$jahr-3}}>{{ $jahr-3 }}</option>
            <option name = "year" value={{$jahr-4}}>{{ $jahr-4 }}</option>
            <option name = "year" value={{$jahr-5}}>{{ $jahr-5 }}</option>
            <option name = "year" value={{$jahr-6}}>{{ $jahr-6 }}</option>
            <option name = "year" value={{$jahr-7}}>{{ $jahr-7 }}</option>
        </select>
        <label for="Spanne">  Spanne : </label>        
        <select class="options" name="spanne" id="spanne">
            {{-- <option value="" disabled selected hidden>...</option> --}}
            <option name = "spanne" value=12 >12 Monate</option>
            <option name = "spanne" value=24 >24 Monate</option>
            <option name = "spanne" value=36 >36 Monate</option>
            <option name = "spanne" value=1000 >alle</option>
        </select>
        <label for="kunde">  Kunde : </label>        
        <select class="options" name="kunde" id="kunde">
            @foreach($kunden as $yKunde)
            <option name = "kunde" value={{$yKunde->id_kunde}} >{{$yKunde->name}}</option>
            @endforeach
        </select>
        <button type="submit" id="btn_submit" hidden="hidden">Submit</button>
        </form>

        {{-- <b class="sub-header">report / mkz: {{ $show}}</b> --}}
        <br>
        <div class="table-responsive">
        <table class="table table-striped table-bordered table-dark">
            <tr>
                <th><H6>report / mkz / Jahr : {{ $show}}</H6></th>
                <th>Traglast</th>
                <th>Norm</th>
                <th>Einsatz</th>
                @for ($i = 1; $i < 13; $i++)
                    <th>
                        @if ($i == $monat && $show == $jahr)
                            <p> __ {{ $rowMonth[$i-1] }} __</p>
                            @else
                            {{$rowMonth[$i-1]}}
                        @endif
                    </th>
                @endfor
                <th>Summe</th>
            </tr>
            <tr>
                @foreach($rowTyp as $keyrow=>$row)
                
                            <th>{{$row->bez_ravel}}</th>
                            <th>{{$row->traglast}}</th>
                            <th>{{$row->norm}}</th>
                            <th>{{$row->einsatz}}</th>
                        
                    @foreach ($uvvData[0] as $key=>$data)
                                
                    @if ($key == 2 or $key == 5 or $key == 8 ) 
                    <td style="border-right: 1px solid black"> 
                        @else
                            <td>
                                @endif
                                    
                                    {{$uvvData[$keyrow][$key]}}
                                    @if ( $uvvOver[$keyrow][$key] )
                                        <H6><span class="badge badge-pill badge-danger"> {{$uvvOver[$keyrow][$key]}} </span></H6>
                                        @endif
                                        @if ( $svData[$keyrow][$key] )
                                        <H6><span class="badge badge-pill badge-warning"> {{$svData[$keyrow][$key]}} </span></H6>
                                        @endif
                                    @if ($show >= $jahr)
                                        

                                    
                                    

                                        @if ($key == $monat-1 && $uvvNowOverRow[$keyrow] !=0) 
                                            {{-- <H6><span class="badge badge-pill badge-danger"> {{ $uvvNowOverRow[$keyrow] }} </span></H6> --}}
                                            <button type="button" class="btn btn-danger btn-sm">
                                                 uvv  <span class="badge badge-light">{{ $uvvNowOverRow[$keyrow] }}</span>
                                              </button>
                                        @endif
                                        @if ($key == $monat-1 && $svNowOverRow[$keyrow] !=0) 
                                        {{-- <H6><span class="badge badge-pill badge-warning"> {{ $svNowOverRow[$keyrow] }} </span></H6> --}}
                                        <button type="button" class="btn btn-warning btn-sm">
                                             sv  <span class="badge badge-light">{{ $svNowOverRow[$keyrow] }}</span>
                                          </button>
                                        @endif
                                    @endif
                        
                                </td>
                        
                    @endforeach
                        <th>
                            @if (isset($uvvSumRow[$keyrow]))
                                <H6><span class="badge badge-pill badge-danger">{{$uvvSumRow[$keyrow]}}</span></H6>
                            @endif
                            @if (isset($svSumRow[$keyrow]))
                                <H6><span class="badge badge-pill badge-warning">{{$svSumRow[$keyrow]}}</span></H6>
                            @endif
                            {{ $uvvSumRowBlack[$keyrow] }}
                            
                        </th>
                        
                    </tr>
            
            
                @endforeach 
            
                <tr>
                    <th></th><th></th><th></th><th></th><th></th><th></th>
                    <th></th><th></th><th></th><th></th><th></th><th></th>
                    <th></th><th></th><th></th><th></th><th></th>
                </tr>
            <tr>    
            <th>UVV___gültig</th><th></th><th></th><th></th>
                @foreach ($uvvSumCol as $key=>$data)
                    <th>{{$uvvSumCol[$key]}}
                    
                </th>
                @endforeach
                <th></th>
            </tr>
            <tr>    
                <th>UVV___ungültig</th><th></th><th></th><th></th>
                    @foreach ($uvvSumColRed as $key=>$data)
                        <th>
                            
                            
                            
                            @if ($key == 0 || $key == 3 || $key == 6 || $key == 9 )
                                @if ($key >= 0 && $key <= 2 && $uvvSumQua[0] != null)
                                <button type="button" class="btn btn-danger">Quartal 1 : {{$uvvSumQua[0]}}</button>
                                @endif
                                @if ($key >= 3 && $key <= 5 && $uvvSumQua[1] != null)
                                <button type="button" class="btn btn-danger">Quartal 2 : {{$uvvSumQua[1]}}</button>
                                @endif
                                @if ($key >= 6 && $key <= 8 && $uvvSumQua[2] != null)
                                <button type="button" class="btn btn-danger">Quartal 3 : {{$uvvSumQua[2]}}</button>
                                @endif
                                @if ($key >= 9 && $key <= 11 && $uvvSumQua[3] != null)
                                <button type="button" class="btn btn-danger">Quartal 4 : {{$uvvSumQua[3]}}</button>
                                @endif
                            @endif
                            @if (isset($uvvSumColRed[$key]))
                            <H6><span class="badge badge-pill badge-danger"> {{ $uvvSumColRed[$key] }} </span></H6>
                            @endif
                        </th>
                    @endforeach
                    <th></th>
                </tr>
            <tr>
                <th>SV____ungültig</th><th></th><th></th><th></th>
                    @foreach ($uvvSumCol as $key=>$data)
                    <th>
                        @if (isset($svSumCol[$key]))    
                        {{-- <button type="button" class="btn btn-warning btn-sm">{{$svSumCol[$key]}}</button> --}}
                        <H6><span class="badge badge-pill badge-warning "> {{ $svSumCol[$key] }} </span></H6>
                        
                        @endif    
                    </th>
                    @endforeach
                    <th></th>
                </tr>
            
            {{-- <tr>
                <th>UVV____ungültig____Quartal</th><th></th><th></th><th></th>
                <th><button type="button" class="btn btn-danger">{{$uvvSumQua[0]}}</button></th><th></th><th>
                <th><button type="button" class="btn btn-danger">{{$uvvSumQua[1]}}</button></th><th></th><th>
                <th><button type="button" class="btn btn-danger">{{$uvvSumQua[2]}}</button></th><th></th><th>
                <th><button type="button" class="btn btn-danger">{{$uvvSumQua[3]}}</button></th><th></th><th>
                <th><button type="button" class="btn btn-danger">{{ $uvvSumFound }}</button></th>
            </tr> --}}
            <tr>
                <th>SV____ungültig____Quartal</th><th></th><th></th><th></th>
                <th><button type="button" class="btn btn-warning">{{$svSumQua[0]}}</button></th><th></th><th>
                <th><button type="button" class="btn btn-warning">{{$svSumQua[1]}}</button></th><th></th><th>
                <th><button type="button" class="btn btn-warning">{{$svSumQua[2]}}</button></th><th></th><th>
                <th><button type="button" class="btn btn-warning">{{$svSumQua[3]}}</button></th><th></th><th>
                <th><button type="button" class="btn btn-warning">{{ $svSumFound }}</button></th>
            </tr>
            <tr>
                <th>UVV____gültig____Quartal</th><th></th><th></th><th></th>
                <th><button type="button" class="btn btn-outline-dark">{{$sumQua[0]}}</button></th><th></th><th>
                <th><button type="button" class="btn btn-outline-dark">{{$sumQua[1]}}</button></th><th></th><th>
                <th><button type="button" class="btn btn-outline-dark">{{$sumQua[2]}}</button></th><th></th><th>
                <th><button type="button" class="btn btn-outline-dark">{{$sumQua[3]}}</button></th><th></th><th>
                <th><button type="button" class="btn btn-outline-dark">{{ $sumYear }}</button></th>
            </tr>
        </table> 
    </div> 

<script type="text/javascript">
    $(function(){
        $("#year").val({{$show}}).attr("selected","selected");
    });
    $(function(){
        $("#spanne").val({{$spanne}}).attr("selected","selected");
    });
    $(function(){
        $("#kunde").val({{$kunde}}).attr("selected","selected");
    });
    $( ".options" ).change(function() {
        $("#btn_submit").click();
    }); 
     
</script>
                   
@endsection
