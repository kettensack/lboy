@extends('layouts.app')

@section('title','kunden_blade')

@section('content')
    <h1>kunden page</h1>
    @foreach($data as $erg)
        <h1>{{$erg->name}}</h1>
    @endforeach
    <div class="alert alert-danger" role="alert" >
            <p>{{ session ('msg') }}</p>
    </div>  
    
@endsection

