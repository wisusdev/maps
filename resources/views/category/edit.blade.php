@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-4">
            <div class="card border-primary mb-3">
                <div class="card-header">Crear punto</div>
                <div class="card-body">
                    <form method="post" action="{{ url('category/'.$category->id) }}" enctype="multipart/form-data">
                        @csrf {{ method_field('PUT') }}
                        <div class="form-group">
                            <label for="name">Titulo de marcador</label> 
                            <input id="name" name="name" value='{{$category->name}}' placeholder="Nombre de la categoria" type="text" required="required" class="form-control here">
                        </div>
                      	<div class="form-group">
					      	<label for="description">Descipcion</label>
					      	<textarea class="form-control" id="description" name="description" rows="3">{{$category->description}}</textarea>
					    </div>

					  	<div class="form-group">
      						<label for="icon">Icono</label>
      						<input type="file" class="form-control-file" id="icon" name="icon" aria-describedby="fileHelp">
    					</div>

    					<div class="form-group">
  							<img class="img-fluid" src="{{ url('/category/media/'.$category->icon) }}" alt="Card image">
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