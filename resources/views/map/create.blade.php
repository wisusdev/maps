@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-4">
            <div class="card border-primary mb-3">
                <div class="card-header">Crear punto</div>
                <div class="card-body">
                    <form method="post" action="{{ url('maps') }}">
                        @csrf
                        <div class="form-group">
                            <label for="title">Titulo de marcador</label> 
                            <input id="title" name="title" placeholder="Nombre de marcador" type="text" required="required" class="form-control here">
                        </div>
                        <div class="form-group">
                            <label for="location">Dirección</label> 
                            <input id="location" name="location" placeholder="Dirección del marcador" type="text" required="required" class="form-control here">
                        </div>
                        <div class="form-group">
                            <label for="radius">Radio</label> 
                            <input id="radius" name="radius" placeholder="Radio del marcador" type="number" min="0" max="30" required="required" class="form-control here">
                        </div>
                        <div class="form-group">
                            <label for="lat">Latitud</label> 
                            <input id="lat" name="lat" placeholder="Latitud del marcador" type="text" required="required" class="form-control here">
                        </div>
                        <div class="form-group">
                            <label for="long">Longitud</label> 
                            <input id="long" name="long" placeholder="Longitud de el marcador" type="text" required="required" class="form-control here">
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
            latitude: 13.703579741428813,
            longitude: -89.24935216068269
        },
        radius: 30,
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