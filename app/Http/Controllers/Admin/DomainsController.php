<?php namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Hit;
use App\Models\Domain;
use Maknz\Slack\Facades\Slack;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;


class DomainsController extends Controller
{


    public function index()
    {
        $domains = Cache::remember('domains', Carbon::now()->addMinutes(5), function()
        {
            return Domain::domainsWithHits()->get();
        });

        return View::make('admin.domains.index', ['domains' => $domains ]);
    }

    public function create()
    {
        return View::make('admin.domains.create');
    }

    public function store()
    {
        $domain = Domain::create(Input::only(['name', 'redirect_url', 'status']));
        Slack::send('Please add the domain `'.$domain->name.'` to the Redirector App at your earliest convenience. Thanks!');
        Session::flash('alert', 'Domain Added Successfully. A Slack message has been sent to the DevOps channel to complete this process.');
        return Redirect::route('admin.domains.index');
    }

    public function show($id)
    {
        $domain = Domain::findWithHits($id);
        $referers = Hit::domainReferers($id)->get();

        return View::make('admin.domains.show', ['domain' => $domain, 'referers' => $referers]);
    }

    public function edit($id)
    {
        return View::make('admin.domains.edit', ['domain' => Domain::find($id)]);
    }

    public function update($id)
    {
        $domain = Domain::find($id);
        $domain->update(Input::only(['name', 'redirect_url', 'status', 'active']));
        Session::flash('alert', 'Domain Updated Successfully.');
        return Redirect::route('admin.domains.index');
    }

    public function destroy($id)
    {
        $domain = Domain::find($id);
        $domain->delete();
        Slack::send('Please remove the domain `'.$domain->name.'` from the Redirector App at your earliest convenience. Thanks!');
        Session::flash('alert', 'Domain Destroyed Successfully.');
        return Redirect::route('admin.domains.index');
    }
}
