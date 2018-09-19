<?php namespace App;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class ApiList extends Model {

    protected $connection = 'mysql';
    protected $primaryKey = 'id';
    protected $table = 'api_lists';
    protected $fillable = array(
        'name',
        'feed_url'
    );

}