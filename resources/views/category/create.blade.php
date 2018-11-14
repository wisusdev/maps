@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-4">
            <div class="card border-primary mb-3">
                <div class="card-header">Crear Categoria</div>
                <div class="card-body">
                    <form method="post" action="{{ url('category') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Titulo de categoria</label> 
                            <input id="name" name="name" placeholder="Nombre de category" type="text" required="required" class="form-control here">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label> 
                           	<textarea class="form-control" id="description" name="description" placeholder="Description" rows="3" required="required"></textarea>
                        </div>
                     	<div class="form-group">
      						<label for="icon">Icono</label>
      						<input type="file" class="form-control-file" id="icon" name="icon" aria-describedby="fileHelp" required="required">
    					</div>
 
                        <div class="form-group">
                            <button name="submit" type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('header')

@endsection

@section('footer')

@endsection