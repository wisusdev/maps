@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-3">
            <ul class="list-group">
                @foreach($category as $cat)
                <li class="list-group-item">
                    <a href="{{url('cat/'.$cat->id)}}"><img src="{{url('/category/media/'.$cat->icon)}}"> {{$cat->name}}</a>
                    <div class="dropdown">
                      <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-share-alt-square"></i></a>

                      <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" target="_blank" href="http://www.facebook.com/sharer.php?u={{url('cat/'.$cat->id)}}&t={{$cat->name}}">Compartir en Facebook</a>
                        <a class="dropdown-item" target="_blank" href="https://twitter.com/intent/tweet?text={{url('cat/'.$cat->id)}}">Compartir en Twitter</a>
                      </div>
                    </div>
                </li>
                @endforeach
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