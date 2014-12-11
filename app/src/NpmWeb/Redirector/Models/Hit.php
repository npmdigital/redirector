<?php namespace NpmWeb\Redirector\Models;

use NpmWeb\LaravelBase\Models\BaseModel;

class Hit extends BaseModel {

    public static $rules = array(
        'domain_id' => array('required'),
        'server_values' => array('required'),
    );

    public $fillable = array(
        'domain_id', 'server_values'
    );

}
