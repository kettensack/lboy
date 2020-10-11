@extends('layouts.app')
@section('title','create article')


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
    <form method="post" action="{{ route('article.store') }}">
        @csrf
        <div class="form-group">
            <label for="name">name</label>
            <Input Type="text" class="form-control" id="name" name="name">
            @error ('name') {{$message}} @enderror
        </div>
        <div class="form-group">
            <label for="id_club">id_club</label>
            <Input Type="number" max="9" class="form-control" id="id_club" name="id_club" >
            @error ('id_club') {{$message}} @enderror
        </div>
        <div class="form-group">
            <label for="abgangMitErl">abgangMitErl</label>
            <Input Type="number" class="form-control" id="abgangMitErl" name="abgangMitErl">
            @error ('abgangMitErl') {{$message}} @enderror
        </div>
        <div class="form-group">
            <label for="abgangOhneErl">abgangOhneErl</label>
            <Input Type="number" class="form-control" id="abgangOhneErl" name="abgangOhneErl">
            @error ('abgangOhneErl') {{$message}} @enderror
        </div>
        <input type="submit" value="create article">
    </form>
</div>            

@endsection
