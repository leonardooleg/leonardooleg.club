<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use function App\Http\Controllers\Admin;

class ProviderController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $providers = Provider::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.providers.index', [
            'providers' => $providers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.providers.create', [
            'providers' => Provider::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $Providers = new Provider($request->all());
        $Providers->save();
        return redirect()->route('admin.providers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Provider $provider
     * @return Response
     */
    public function show(Provider $Providers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Provider $Providers
     * @return Response
     */
    public function edit($id)
    {
        return view('admin.providers.edit', [
            'providers' => Provider::all(),
            'provider' => Provider::findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $task = Provider::findOrFail($id);
        $input = $request->all();
        $task->fill($input)->save();
        return back()->with('success', 'Your Provider has been added successfully. Please wait for the admin to approve.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Provider $provider
     * @return Response
     */
    public function destroy(Provider $provider)
    {
        $provider->delete();
        return redirect()->route('admin.providers.index');
    }

}
