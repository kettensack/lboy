

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
    <form method="get" action="{{ route('report.report1' ) }}">
    <label for="year">Jahr</label>
    
    <select name="year" id="year">
        <option value="" disabled selected hidden>Choose...</option>
      <option name = "year" value={{$jahr  }} > {{ $jahr }}</option>
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

                        {{-- @foreach($mkzevents as $key =>  $group)  --}}
                            {{-- @foreach($mkzevents as  $array)
                                <P>{{ $array['id_liftboy'] }}</p>
                                    <P>{{ $array['created_at'] }}</p>
                            @endforeach --}}

                            
                                <br><br>
                                <b class="sub-header">Auswertung / letzte Prüfung / Jahr: {{ $show}}</b>
                            
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <tr>
                                            {{-- 'Typ','Traglast','Norm','Einsatz', --}}
                                            <th>Typ</th>
                                            <th>@sortablelink('Traglast')</th>
                                            <th>@sortablelink('Norm')</th>
                                            <th>@sortablelink('Einsatz')</th>
                                            @foreach($rowMonth as $row)
                                            <th>{{$row}}</th>
                                            @endforeach
                                           
                                        </tr>
                                        @php $sum=0;$spinat = array();$row=0; @endphp
                                        @if($mkzevents->count())
                                        @foreach($rowTyp as $typ)
                                        
                                            <tr>  
                                                <th>{{$typ->bez_ravel}}</th>
                                                <th>{{$typ->traglast}}</th>
                                                <th>{{$typ->norm}}</th>
                                                <th>{{$typ->einsatz}}</th>
                                                @php $c=0; @endphp
                                                @for ($i = 0; $i < 12; $i++)
                                                
                                                    @foreach($mkzevents as $key =>  $group) 
                                                        @foreach($group as $keygroup =>  $erg)
                                                            @if ($loop->first)
                                                                @if ($erg->id_article == $typ->id_artikel)
                                                                    @if (date('Y', strtotime($erg->created_at)) == ($show))
                                                                        @if (date('m', strtotime($erg->created_at)) == $i+1)
                                                                            @php $c=$c+1; @endphp
                                                                        @endif
                                                                    @endif
                                                                @endif
                                                                @break
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                        @if($c != 0)
                                                        <td>
                                                        {{-- <button type="button" style="opacity: {{0.5+$c/30}}; font-size: {{10+$c/75}}px;"  --}}
                                                        <button type="button"  
                                                            @if ( $i === 0 || $i === 1 || $i === 2 )
                                                            class="btn btn-light">
                                                            @elseif ( $i === 3 || $i === 4 || $i === 5 )
                                                            class="btn btn-success">
                                                            @elseif ( $i === 6 || $i === 7 || $i === 8 )
                                                            class="btn btn-danger">
                                                            @elseif ( $i === 9 || $i === 10 || $i === 11 )
                                                            class="btn btn-primary">
                                                            @endif        

                                                            {{ ($c) }} 
                                                          </button>
                                                          
                                                        </td>
                                                        {{-- <td><a href="{{ url('searchBar.show', $typ->id_artikel, $i) }}" class="btn btn-info">{{ $c }}</a></td> --}}
                                                        {{-- <td style="background-color:#AAAAAA">{{ $c }}</td> --}}
                                                        @else
                                                        <td></td>
                                                        @endif
                                                        @php $sum=$sum+$c;
                                                        $spinat[$row][$i] =  $c;
                                                        $c=0; @endphp
                                                @endfor 
                                                @if($sum != 0)
                                            <th> <button type="button" class="btn btn-link"> {{ $sum }} </button> </th>
                                            @else
                                            <th></th>
                                            @endif 
                                                @php $sum=0; @endphp  
                                            </tr>
                                            @php $row++; @endphp
                                        @endforeach
                                        <tr>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        
                                        @php $row=0; $count=0; $total=0; $q1=0; $q2=0; $q3=0; $q4=0; @endphp
                                        @for ($i = 0; $i < 12; $i++)
                                            @foreach($rowTyp as $typ)
                                            
                                            
                                                @php
                                                $x = $spinat[$row][$i];
                                                $count=$count+$x;
                                                @endphp
                                                
                                                
                                                @php $row++; @endphp
                                            @endforeach
                                            @if($count != 0)
                                            {{-- <th> {{ $count }} </th> --}}
                                            <th> <button type="button" class="btn btn-link"> {{ $count }} </button> </th>
                                            @else
                                            <th></th>
                                            @endif
                                            @if ($i<3) @php $q1=$q1+$count; @endphp
                                            @elseif ($i <6) @php $q2=$q2+$count; @endphp
                                            @elseif ($i<9) @php $q3=$q3+$count; @endphp
                                            @elseif ($i<12) @php $q4=$q4+$count; @endphp
                                            @endif
                                            @php $total=$total+$count;$row=0; $count=0; @endphp
                                        @endfor
                                        {{-- <span class="badge badge-pill badge-success">{{ $total }}</span></th> --}}
                                        <th></th>
                                        @endif
                                        </tr>
                                        <tr>
                                            <th></th><th></th>                                            
                                            <th></th><th></th><th><button type="button" class="btn btn-light"> {{ $q1 }}</th>
                                            <th></th><th></th><th><button type="button" class="btn btn-success"> {{ $q2 }}</th>
                                            <th></th><th></th><th><button type="button" class="btn btn-danger"> {{ $q3 }}</th>
                                            <th></th><th></th><th><button type="button" class="btn btn-primary"> {{ $q4 }}</th>
                                            <th></th><th></th>
                                            <th><button type="button" class="btn btn-outline-dark">{{ $total }}</button></th>
                                        </tr>
                                    </table>
                                   
                                </div>
                                                       

                   
@endsection
