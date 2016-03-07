<?php namespace NpmWeb\Redirector\Controllers\Admin;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use NpmWeb\Redirector\Controllers\BaseController;
use NpmWeb\Redirector\Models\Domain;
use App\Http\Controllers\Controller;
class DomainsController extends Controller
{

    public function index()
    {
        return View::make('admin.domains.index', ['domains' => Domain::all() ]);
    }

    public function create()
    {
        return View::make('admin.domains.create');
    }

    public function store()
    {
        $domain = Domain::create(Input::only(['name', 'redirect_url', 'status']));
        Session::flash('alert', 'Domain Added Successfully.');
        return Redirect::route('admin.domains.index');
    }

    public function show($id)
    {
        return View::make('admin.domains.show', ['domain' => Domain::find($id)]);
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
        Session::flash('alert', 'Domain Destroyed Successfully.');
        return Redirect::route('admin.domains.index');
    }
}
