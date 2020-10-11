@extends('layouts.app')
@section('title','edit article')
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
        
        <form method="post" action="{{ route('article.update' , $article->id) }}">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="name">name</label>
                <Input Type="text" class="form-control" value="{{ $article->name }}" name="name">
                @error ('name') {{$message}} @enderror
            </div>
            <div class="form-group">
                <label for="id_club">id_club</label>
                <Input Type="number" class="form-control" value="{{ $article->id_club }}" name="id_club">
                @error ('id_club') {{$message}} @enderror
            </div>
            <div class="form-group">
                <label for="abgangMitErl">abgangMitErl</label>
                <Input Type="number" class="form-control" value="{{ $article->abgangMitErl }}" name="abgangMitErl">
                @error ('abgangMitErl') {{$message}} @enderror
            </div>
            <div class="form-group">
                <label for="abgangOhneErl">abgangOhneErl</label>
                <Input Type="number" class="form-control" value="{{ $article->abgangOhneErl }}" name="abgangOhneErl">
                @error ('abgangOhneErl') {{$message}} @enderror
            </div>
            <input type="submit" value="Update article">
        </form>
    </div>            

@endsection
