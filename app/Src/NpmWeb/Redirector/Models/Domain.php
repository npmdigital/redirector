<?php namespace NpmWeb\Redirector\Models;

// use NpmWeb\LaravelBase\Models\BaseModel;
// class Domain extends BaseModel {

use Illuminate\Database\Eloquent\Model as Eloquent;

class Domain extends Eloquent
{

    protected $fillable = ['name', 'redirect_url', 'status', 'active'];

    public static $rules = array(
        'name' => array('required','max:100'),
        'redirect_url' => array('required','max:300'),
        'status' => array('required','integer','in:301,302'),
    );

    public function scopeMatching($query, $domain)
    {
        return $query->whereRaw('? LIKE CONCAT(\'%\',name)', [$domain]);
    }
}
