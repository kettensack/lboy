@extends('layouts.app')

@section('title','search')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

@component('components.searchbar')
@endcomponent



<table id="table_id" class="table table-bordered table-hover">
    <thead class="thead-dark">
        <tr>
            <td>Artikeltyp</td>
            <td>Raveltitel</td>
            <td>id-nr</td>
            <td>sn-nr</td>  
              
            <td colspan="2">Action</td>
        </tr>
    </thead>
    <tbody>
        @if ($targets->count() == 0)
        <tr>
            <td colspan="5">Nothing to display.</td>
        </tr>
        @endif
    @foreach($targets as $e)
    
        <tr>
            <td>{{ $e->bez_artikeltyp }}</td>
            <td>{{ $e->bez_ravel }}</td> 
            <td>{{ $e->id_club }}</td>
            <td>{{ $e->snnr }}</td>  
            <td>
                <form action = "{{ route('searchBar.show', ['id_liftboy'=>$e->id_liftboy]) }}" method ="get">
                    @csrf
                    <input type="hidden"  name="inputlb" value={{$e->id_liftboy}}>
                    <button type="submit" class="btn btn-sm btn-primary">show</submit>
                </form>
            </td>
                       
        </tr>
    @endforeach    
    </tbody>
</table>

{!! $targets->appends(request()->except('page'))->render() !!}

<p>Displaying {{$targets->count()}} of {{ $targets->total() }} target(s).</p>

<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>    
@endsection


{{-- id_artikeltyp": "1"
      +"bez_artikeltyp": "Motorkettenzug"
      +"info": null
      +"klasse": "Hebezeuge"
      +"norm": "D8"
      +"DGUV Vorschrift": null
      +"created_at": "2020-08-02 08:32:59"
      +"deleted_at": null
      +"id_artikel": 3
      +"traglast": 320
      +"einsatz": "PLUS"
      +"bez_ravel": "0,32t MKZ 2er-SET D8+ 18m*"
      +"bez_hersteller": "SB 030/10"
      +"bez_mo2": "RiggingLift D8 Plus 320"
      +"updated_at": null
      +"id_liftboy": 1010
      +"id_club": 100030091
      +"snnr": "G29092"
      +"baujahr": 2016
      +"prueffrist": 12
      +"id_kunde": 1
      +"abgang_me": null
      +"abgang_oe": null
      +"doppelstrang": null
      +"ueberlaenge": null
      +"comment": null --}}
