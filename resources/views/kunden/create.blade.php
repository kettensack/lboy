@extends('layouts.app')
@section('title','create kunde')

{{-- 
'name' => 'required|String|min:1|max:20',
'ort' => 'required|String|min:1|max:50',
'strasse' => 'required|String|min:1|max:50',
'kuerzel' => 'required|String|min:1|max:3', 
--}}
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
    <form method="post" action="{{ route('kunden.store') }}">
        @csrf
        <div class="form-group">
            <label for="name">name</label>
            <Input Type="text" class="form-control" id="name" name="name">
            @error ('name') {{$message}} @enderror
        </div>
        <div class="form-group">
            <label for="ort">ort</label>
            <Input Type="text" max="9" class="form-control" id="ort" name="ort" >
            @error ('ort') {{$message}} @enderror
        </div>
        <div class="form-group">
            <label for="strasse">strasse</label>
            <Input Type="text" class="form-control" id="strasse" name="strasse">
            @error ('strasse') {{$message}} @enderror
        </div>

        <input type="submit" value="Create Kunde">
    </form>
</div>            

@endsection
