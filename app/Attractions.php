<?php namespace App;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Attractions extends Model {

    protected $connection = 'mysql';
    protected $primaryKey = 'id';
    protected $table = 'attractions';
    protected $fillable = array(
        'name',
        'location_id',
        'address',
        'category',
        'link',
        'latitude',
        'longitude',
        'active'
    );

    // public $timestamps = false;

}