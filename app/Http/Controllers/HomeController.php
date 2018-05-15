<?php

namespace App\Http\Controllers;

use App\Map;
use Illuminate\Http\Request;
use FarhanWazir\GoogleMaps\GMaps;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $maps = Map::all();

        $gmap = new GMaps();

        foreach ($maps as $map) {
            $config = array();
            $config['center'] = $map->latitude. ','. $map->longitude;
            $config['zoom'] = '14';
            $config['map_height'] = '500px';
            $config['scrollwheel'] = false;

            $gmap->initialize($config);

            //Add Marker
            $marker['position'] = $map->latitude. ','. $map->longitude;
            $marker['infowindow_content'] = $map->title;
            $marker['icon'] = 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png';

            $gmap->add_marker($marker);
        }


        $map = $gmap->create_map();

        return view('home', compact('map'));
    }
}
