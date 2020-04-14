<?php

namespace App\Http\Controllers;
use App\MapSite;
use App\SiteDescription;
use Validator;
use Response;
use DB;

class MapController extends Controller
{
    public function getSelectionMap()
    {
        $bodyid = 'map-page';

        return view('maps.selection', compact('bodyid'));
    }
    public function getLibrariesMap()
    {
        $bodyid = 'map-page';
        return view('maps.libraries', compact('bodyid'));
    }
    public function getMapSite($id)
    {
        $site = MapSite::find($id);
        $bodyid = 'map-page';
        return view('maps.map-site', compact('site','bodyid'));
    }
    public function getSiteDescriptionMap($id)
    {
        $site = SiteDescription::find($id);
        $bodyid = 'map-page';
        return view('maps.site-description', compact('site','bodyid'));
    }

}
