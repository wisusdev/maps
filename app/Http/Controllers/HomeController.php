<?php

namespace App\Http\Controllers;

use App\Map;
use App\Category;
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
        $category = Category::all();

        $gmap = new GMaps();

        foreach ($maps as $map) {

            $config = array();
            $config['center'] = $map->latitude. ','. $map->longitude;
            $config['map_height'] = '500px';
            $config['scrollwheel'] = true;
            
            $config['styles'] = array(
                    array("name"=>"Red Parks", "definition"=>array(
                        array("featureType"=>"all", "stylers"=>array(array("saturation"=>"-30"))),
                        array("featureType"=>"poi.park", "stylers"=>array(array("saturation"=>"10"), array("hue"=>"#990000")))
                    )),
                    array("name"=>"Black Roads", "definition"=>array(
                        array("featureType"=>"all", "stylers"=>array(array("saturation"=>"-70"))),
                        array("featureType"=>"road.arterial", "elementType"=>"geometry", "stylers"=>array(array("hue"=>"#000000")))
                    )),
                    array("name"=>"No Businesses", "definition"=>array(
                        array("featureType"=>"poi.business", "elementType"=>"labels", "stylers"=>array(array("visibility"=>"off")))
                    ))
            );

            $config['stylesAsMapTypes'] = true;
            $config['stylesAsMapTypesDefault'] = "No Businesses"; 
            $config['trafficOverlay'] = TRUE;
            $config['bicyclingOverlay'] = TRUE;
            $config['zoom'] = 'auto';

            $config['onzoomchanged'] ='

            var zoom = map.getZoom();

            for (i = 0; i < markers_map.length; i++) {
                markers_map[i].setVisible(zoom >= 14);
            }

            console.log(zoom)

            ';

            $gmap->initialize($config);

            //Add Marker
            $marker['position'] = $map->latitude. ','. $map->longitude;
            $marker['infowindow_content'] = '<h3>'.$map->title.'</h3>'.$map->description;
            $marker['icon'] = url('/category/media/'.$map->category->icon);

            $gmap->add_marker($marker);
        }

        $map = $gmap->create_map();

        return view('home', compact('map', 'category'));
    }

    public function cat($id)
    {
        $category = Category::findOrFail($id);

        $gmap = new GMaps();

        foreach ($category->maps as $map) {

            $config = array();
            $config['center'] = $map->latitude. ','. $map->longitude;
            $config['map_height'] = '500px';
            $config['scrollwheel'] = true;
            
            $config['styles'] = array(
                    array("name"=>"Red Parks", "definition"=>array(
                        array("featureType"=>"all", "stylers"=>array(array("saturation"=>"-30"))),
                        array("featureType"=>"poi.park", "stylers"=>array(array("saturation"=>"10"), array("hue"=>"#990000")))
                    )),
                    array("name"=>"Black Roads", "definition"=>array(
                        array("featureType"=>"all", "stylers"=>array(array("saturation"=>"-70"))),
                        array("featureType"=>"road.arterial", "elementType"=>"geometry", "stylers"=>array(array("hue"=>"#000000")))
                    )),
                    array("name"=>"No Businesses", "definition"=>array(
                        array("featureType"=>"poi.business", "elementType"=>"labels", "stylers"=>array(array("visibility"=>"off")))
                    ))
            );

            $config['stylesAsMapTypes'] = true;
            $config['stylesAsMapTypesDefault'] = "No Businesses"; 
            $config['trafficOverlay'] = TRUE;
            $config['bicyclingOverlay'] = TRUE;
            $config['zoom'] = 'auto';

            $config['onzoomchanged'] ='

            var zoom = map.getZoom();

            for (i = 0; i < markers_map.length; i++) {
                markers_map[i].setVisible(zoom >= 14);
            }

            console.log(zoom)

            ';

            $gmap->initialize($config);

            //Add Marker
            $marker['position'] = $map->latitude. ','. $map->longitude;
            $marker['infowindow_content'] = '<h3>'.$map->title.'</h3>'.$map->description;
            $marker['icon'] = url('/category/media/'.$category->icon);

            $gmap->add_marker($marker);
        }

        $map = $gmap->create_map();

        return view('category.show', compact('map', 'category'));
    }
}
