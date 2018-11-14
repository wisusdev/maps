@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-3">
            <ul class="list-group">
            	<li class="list-group-item"><a href="{{route('home')}}">Inicio</a></li>
                <li class="list-group-item"><img src="{{url('/category/media/'.$category->icon)}}"> {{$category->name}}</li>
            </ul>
        </div>
        <div class="col-sm-9">
            <div class="card">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    {!! $map['html'] !!}
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('header')
    {!! $map['js'] !!}
@endsection