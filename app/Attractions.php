<?php namespace App;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Attractions extends Model {

    protected $hidden = ['active','id','location_id'];

    protected $connection = 'mysql';
    protected $primaryKey = 'id';
    protected $table = 'attractions';
    protected $fillable = array(
        'name',
        'location_id',
        'address',
        'description',
        'rating',
        'category',
        'link',
        'image',
        'latitude',
        'longitude',
        'active'
    );

    // public $timestamps = false;

}