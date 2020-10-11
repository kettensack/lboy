

@extends('layouts.app')
@section('title','edit Tbl_kunde')
@section('content')

<div class="col-6">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form method="post" action="{{ route('kunden.update' , $kunde->id) }}">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="name">name</label>
                <Input Type="text" class="form-control" value="{{ $kunde->name }}" name="name">
                @error ('name') {{$message}} @enderror
            </div>
            <div class="form-group">
                <label for="ort">ort</label>
                <Input Type="text" class="form-control" value="{{ $kunde->ort }}" name="ort">
                @error ('ort') {{$message}} @enderror
            </div>
            <div class="form-group">
                <label for="strasse">strasse</label>
                <Input Type="text" class="form-control" value="{{ $kunde->strasse }}" name="strasse">
                @error ('strasse') {{$message}} @enderror
            </div>
            
            <input type="submit" value="Update Kunde">
        </form>
    </div>            

@endsection
