@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-4">
            <div class="card border-primary mb-3">
                <div class="card-header">Crear punto</div>
                <div class="card-body">
                    <form method="post" action="{{ url('maps/'.$map->id) }}">
                        @csrf {{ method_field('PUT') }}
                        <div class="form-group">
                            <label for="title">Titulo de marcador</label> 
                            <input id="title" name="title" value='{{$map->title}}' placeholder="Nombre de marcador" type="text" required="required" class="form-control here">
                        </div>
                        <div class="form-group">
                            <label for="category">Categoria</label>
                            <select class="form-control" id="select"  name="category" placeholder="Opciones" required="required">
                                <option value="" selected disabled>Please select</option>
                                @foreach($category as $cat)
                                    <option value="{{$cat->id}}" {{$map->category_id == $cat->id ? 'selected' : ''}}>{{$cat->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label> 
                            <textarea class="form-control" id="description" name="description" rows="3">{{$map->description}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="location">Dirección</label> 
                            <input id="location" name="location" value='{{$map->address}}' placeholder="Dirección del marcador" type="text" required="required" class="form-control here">
                        </div>
                        <div class="form-group">
                            <label for="radius">Radio</label> 
                            <input id="radius" name="radius" value='{{$map->radius}}' placeholder="Radio del marcador" type="number" min="0" max="30" required="required" class="form-control here">
                        </div>
                        <div class="form-group">
                            <label for="lat">Latitud</label> 
                            <input id="lat" name="lat" value='{{$map->latitude}}' placeholder="Latitud del marcador" type="text" required="required" class="form-control here">
                        </div>
                        <div class="form-group">
                            <label for="long">Longitud</label> 
                            <input id="long" name="long" value='{{$map->longitude}}' placeholder="Longitud de el marcador" type="text" required="required" class="form-control here">
                        </div> 
                        <div class="form-group">
                            <button name="submit" type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-sm-8">
            <div class="card border-primary mb-3">
                <div class="card-body">
                    <div id="map"></div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('header')
    <script type="text/javascript" src='https://maps.googleapis.com/maps/api/js?libraries=places'></script>

    <script type="text/javascript" src="{{asset('js/locationpicker.jquery.js')}}"></script>
@endsection

@section('footer')
<script>
    $('#map').locationpicker({
        location: {
            latitude: '{{$map->latitude}}',
            longitude: '{{$map->longitude}}'
        },
        radius: '{{$map->radius}}',
       	zoom: 18,
        inputBinding: {
            latitudeInput: $('#lat'),
            longitudeInput: $('#long'),
            radiusInput: $('#radius'),
            locationNameInput: $('#location')
        },
        // Para cargar vista satelital
        mapTypeId: google.maps.MapTypeId.SATELLITE,

        enableAutocomplete: true,
        onchanged: function (currentLocation, radius, isMarkerDropped) {
            // Uncomment line below to show alert on each Location Changed event
            //alert("Location changed. New location (" + currentLocation.latitude + ", " + currentLocation.longitude + ")");
        }
    });
</script>
@endsection