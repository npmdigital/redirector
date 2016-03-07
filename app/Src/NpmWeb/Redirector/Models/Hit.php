<?php namespace NpmWeb\Redirector\Models;

use NpmWeb\LaravelBase\Models\BaseModel;

class Hit extends BaseModel {

    public static $rules = array(
        'domain_id' => array('required'),
        'server_values' => array('required'),
        'referer' => array('max:200'),
        'path' => array('required','max:200'),
    );

    public $fillable = array(
        'domain_id', 'server_values', 'referer', 'path',
    );

}
