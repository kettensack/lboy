
{{-- 
'name' => 'required|String|min:1|max:20',
'ort' => 'required|String|min:1|max:50',
'strasse' => 'required|String|min:1|max:50',
'kuerzel' => 'required|String|min:1|max:3', 
--}}

@extends('layouts.app')

@section('title','kunden_index_blade')

@section('content')
<div class="container">
    <div class="mt-5">
        @if(session()->get('msg'))
            <div class="alert alert-sucess">
                {{session()->get('msg')}}
            </div>
        @endif 
    </div>
     
    <div class="table-responsive-md">
        <table class="table table-bordered table-hover" id="article_table" style="width:100%" cellpadding="0" cellspacing="0" border="0">
            <thead>
                <tr>
                    <td>id</td>
                    <td>name</td>
                    <td>ort</td>  
                    <td>strasse</td>  
                    <td colspan="2">Action</td>
                </tr>
            </thead>
            <tbody>
            @foreach($kunden as $kunde)
                <tr>
                    <td>{{ $kunde->id_kunde }}</td>
                    <td>{{ $kunde->name }}</td>
                    <td>{{ $kunde->ort }}</td>  
                    <td>{{ $kunde->strasse }}</td>  
                    {{-- <td><a href="{{route('kunden.edit', $kunde->id) }}" class="btn btn-primary">Edit</a></td>
                    <td>
                        <form action="{{route('kunden.destroy', $kunde->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">DELETE</button>
                        </form>
                        --}}
                    
                </td>
                </tr>
            @endforeach    
            </tbody>
        </table>
    </div>
</div>
                        
@endsection
