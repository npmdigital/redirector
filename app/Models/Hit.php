<?php namespace App\Models;

// use NpmWeb\LaravelBase\Models\BaseModel;
// class Hit extends BaseModel

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model as Eloquent;

class Hit extends Eloquent
{

    public $fillable = ['domain_id', 'server_values', 'referer', 'path',];

    public function domain()
    {
        return $this->belongsTo(Domain::class);
    }

    public function scopeDomainReferers($query, $domain_id)
    {
        $yearAgo = Carbon::now()->subYears(1)->toDateString();

        return $query->select(['referer', DB::raw('COUNT(*) AS count')])
                     ->where('domain_id', '=', $domain_id)
                     ->where('created_at', '>=', $yearAgo)
                     ->groupBy('referer')
                     ->orderBy('count', 'DESC');
    }
}
