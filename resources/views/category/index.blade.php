@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
   		<div class="col-sm-12">			
			<div class="card border-warning mb-3">
			  <div class="card-header"><a href="{{url('category/create')}}">Crear Categoria</a></div>
			  <div class="card-body">
			  	<table class="table table-hover">
				  <tbody>
				  	@foreach($category as $cat)
				    <tr>
				      <th>{{$cat->name}}</th>
				      <td>
				      	<a class="btn btn-xs btn-primary" href="{{url('category/'.$cat->id.'/edit')}}">Editar</a>
				      	<form method="POST"
								action="{{ route('category.destroy', $cat->id) }}"
								style="display: inline">
								{{ csrf_field() }} {{ method_field('DELETE') }}
								<button class="btn btn-xs btn-danger"
									onclick="return confirm('¿Estás seguro de querer eliminar esta publicación?')"
								>Borrar</button>
							</form>

				      </td>
				    </tr>
				    @endforeach
				  </tbody>
				</table> 
			  </div>
			</div>
   		</div>
   	</div>
</div>

@endsection