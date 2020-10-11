

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
        background-color:#DDDDDD;
    }
</style> 

{{-- <form action = "{{ route('report.report1', ['jahr'=>$sjahr]) }}" method ="get"> --}}
    <form method="get" action="{{ route('report.report2' ) }}">
        <label for="year">Jahr</label>
        
        <select name="year" id="year">
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
        <button type="submit" id="btn_index">Submit</button>
        </form>
        <hr>
        <b class="sub-header">report / mkz: {{ $show}}</b>
        <hr>
        <div class="table-responsive">
        <table class="table table-striped">
            <tr>
                <th>Artikel</th>
                <th>Traglast</th>
                <th>Norm</th>
                <th>Einsatz</th>
                @for ($i = 1; $i < 13; $i++)
                    <th>
                        @if ($i == $monat && $show == $jahr)
                            <p>({{$rowMonth[$i-1]}})</p>
                            @else
                            {{$i}}
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
                        
                    @foreach ($rowData[0] as $key=>$data)
                                
                                <td>
                                    
                                    {{$rowData[$keyrow][$key]}}

                                    @if ($show >= $jahr)
                                    @if ( $uvvOver[$keyrow][$key] )
                                    <H6><span class="badge badge-pill badge-danger"> {{$uvvOver[$keyrow][$key]}} </span></H6>
                                    @endif

                                    @if ( $svData[$keyrow][$key] )
                                    <H6><span class="badge badge-pill badge-warning"> {{$svData[$keyrow][$key]}} </span></H6>
                                    @endif
                                    

                                        @if ($key == $monat-1 && $abgelaufen[$keyrow] !=0) 
                                            {{-- <H6><span class="badge badge-pill badge-danger"> {{ $abgelaufen[$keyrow] }} </span></H6> --}}
                                            <button type="button" class="btn btn-danger btn-sm">
                                                 uvv  <span class="badge badge-light">{{ $abgelaufen[$keyrow] }}</span>
                                              </button>
                                        @endif
                                        @if ($key == $monat-1 && $svAbgelaufen[$keyrow] !=0) 
                                        {{-- <H6><span class="badge badge-pill badge-warning"> {{ $svAbgelaufen[$keyrow] }} </span></H6> --}}
                                        <button type="button" class="btn btn-warning btn-sm">
                                             sv  <span class="badge badge-light">{{ $svAbgelaufen[$keyrow] }}</span>
                                          </button>
                                        @endif
                                    @endif
                        
                                </td>
                        
                    @endforeach
                    <th>{{ $sumRow[$keyrow] }}
                        @if (isset($svSumRow[$keyrow]))
                        <H6><span class="badge badge-pill badge-warning">{{$svSumRow[$keyrow]}} </span></H6>
                        @endif
                        
                    </th>
                    
            </tr>
            
            <tr>
                @endforeach 

            <th></th><th></th><th></th><th></th>

                @foreach ($sumCol as $key=>$data)
                    <th>{{$sumCol[$key]}}</th>
                @endforeach
                <th></th>
            </tr>
            <tr>
                <th></th><th></th><th></th><th></th>
                <th><button type="button" class="btn btn-outline-dark">{{$sumQua[0]}}</button></th><th></th><th>
                <th><button type="button" class="btn btn-outline-dark">{{$sumQua[1]}}</button></th><th></th><th>
                <th><button type="button" class="btn btn-outline-dark">{{$sumQua[2]}}</button></th><th></th><th>
                <th><button type="button" class="btn btn-outline-dark">{{$sumQua[3]}}</button></th><th></th><th>
                <th><button type="button" class="btn btn-outline-dark">{{ $sumYear }}</button></th>
            </tr>
            {{-- <tr>
                <th></th><th></th><th></th><th></th>
                <th><button type="button" class="btn btn-danger">{{$uvvSumQua[0]}}</button></th><th></th><th>
                <th><button type="button" class="btn btn-danger">{{$uvvSumQua[1]}}</button></th><th></th><th>
                <th><button type="button" class="btn btn-danger">{{$uvvSumQua[2]}}</button></th><th></th><th>
                <th><button type="button" class="btn btn-danger">{{$uvvSumQua[3]}}</button></th><th></th><th>
                <th><button type="button" class="btn btn-danger">{{ $uvvSumFound }}</button></th>
            </tr> --}}
            <tr>
                <th></th><th></th><th></th><th></th>
                <th><button type="button" class="btn btn-warning">{{$svSumQua[0]}}</button></th><th></th><th>
                <th><button type="button" class="btn btn-warning">{{$svSumQua[1]}}</button></th><th></th><th>
                <th><button type="button" class="btn btn-warning">{{$svSumQua[2]}}</button></th><th></th><th>
                <th><button type="button" class="btn btn-warning">{{$svSumQua[3]}}</button></th><th></th><th>
                <th><button type="button" class="btn btn-warning">{{ $svSumFound }}</button></th>
            </tr>
        </table> 
    </div>                  
@endsection
