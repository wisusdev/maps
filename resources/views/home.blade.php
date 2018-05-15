@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-primary mb-3">

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