<?php namespace App\Models;

// use NpmWeb\LaravelBase\Models\BaseModel;
// class Domain extends BaseModel {

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model as Eloquent;

class Domain extends Eloquent
{

    protected $fillable = ['name', 'redirect_url', 'status', 'active'];

    public function scopeMatching($query, $domain)
    {
        return $query->whereRaw('? LIKE CONCAT(\'%\',name)', [$domain]);
    }

    public function hits()
    {
        return $this->hasMany(Hit::class);
    }

    public function scopeDomainsWithHits($query)
    {
        $yearAgo = Carbon::now()->subYears(1)->toDateString();

        // select d.*, COUNT(*) as hits
        // from domains as d
        // join hits as h on h.domain_id = d.id
        // where h.created_at >= '2015-05-13'
        // group by d.id
        // order by d.name asc;

        return DB::table('domains as d')
                   ->select(['d.*', DB::raw('COUNT(h.id) AS hits')])
                   ->join('hits AS h', 'h.domain_id', '=', 'd.id')
                   ->where('h.created_at', '>=', $yearAgo)
                   ->groupBy('d.name')
                   ->orderBy('d.name', 'ASC');
    }

    public function scopeFindWithHits($query, $id)
    {
        $yearAgo = Carbon::now()->subYears(1)->toDateString();

        return $query->where('domains.id', '=', $id)
                     ->select(['domains.*', DB::raw('COUNT(*) AS hits')])
                     ->leftJoin('hits AS h', 'domains.id', '=', 'h.domain_id')
                     ->where('h.created_at', '>=', $yearAgo)
                     ->first();
    }
}
