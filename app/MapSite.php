<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MapSite extends Model
{
    protected $table = 'map_sites';
    protected $guarded = ['id'];

    protected $fillable = [
        'site_number',
        'site_name',
        'lat',
        'long',
        'county',
        'land_cover',
        'property_name',
        'remarks',
        'status',
        'created_at',
        'updated_at',
        'source_gsheet_name',
        'display_on_map_yn',
        'fall_site_yn',
        'available_yn',
        'infowindow_content'
    ];

    public function siteDescriptions()
    {
        return $this->hasOne('App\SiteDescription');
    }
}
