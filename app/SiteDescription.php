<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class SiteDescription extends Model
{
    protected $table = 'site_descriptions';
    protected $guarded = ['id'];
//    protected $dates = ['created_at','updated_at'];
    /*
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'emammal_user_id',
        'delivery_method',
        'mailing_address_sd',
        'mailing_address_stamps',
        'county',
        'site_type',
        'school_property_yn',
        'camera_facing',
        'property_type',
        'property_name',
        'fenced_yn',
        'hunting_yn',
        'hunting_details',
        'purposeful_feeding_yn',
        'accidental_food_yn',
        'outside_pets_yn',
        'camera_id',
        'created_at',
        'updated_at',
        'user_latitude',
        'user_longitude',
        'acf_uploader_yn',
        'acf_borrower_yn',
        'outside_dogs_yn',
        'outside_cats_yn',
        'outside_chickens_yn',
        'outside_horses_yn',
        'outside_none_yn',
        'deployment_name',
        'map_site_id',
        'date_submitted',
        'deployment_yn',
        'imported_yn',
        'gsheet_src',
        'acf_lat',
        'acf_long'
    ];
*/
    public function camera()
    {
        return $this->belongsTo('App\Camera','camera_id');
    }
    public function deployment()
    {
        return $this->hasOne('App\Deployment');
    }
    public function mapSite()
    {
        return $this->belongsTo('App\MapSite');
    }

    public function nowDatetime()
    {
        $now = Carbon::now();
        return $now;
    }

    public function getSelectedSites()
    {
        $sites = SiteDescription::whereNotNull('map_site_id')->get();
        return $sites;
    }
    public function getSelectedSite($id)
    {
        $site = SiteDescription::where('id','=',$id)->whereNotNull('map_site_id')->first();
        return $site;
    }

}
