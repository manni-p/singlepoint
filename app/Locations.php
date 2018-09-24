<?php namespace App;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Locations extends Model {

    protected $connection = 'mysql';
    protected $primaryKey = 'id';
    protected $table = 'locations';
    protected $fillable = array(
        'name',
        'latitude',
        'longitude',
        'slug',
        'display_name',
        'more_link',
        'active'
    );

    // public $timestamps = false;

    public function attractions()
    {
        return $this->hasMany('App\Attractions','location_id','id');
    }

}