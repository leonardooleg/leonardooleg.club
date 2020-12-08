<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;


class CountryController extends Controller
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
        $countries = Country::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.countries.index', [
            'countries' => $countries
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.countries.create', [
            'countries' => Country::all()
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
        $countries = new Country($request->all());
        $countries->save();
        return redirect()->route('admin.countries.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Country $category
     * @return Response
     */
    public function show(Country $countries)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param country $countries
     * @return Response
     */
    public function edit($id)
    {
        $country = country::findOrFail($id);
        return view('admin.countries.edit', [
            'countries' => Country::all(),
            'country' => $country
        ]);
    }

    /**
     * Update the given user.
     *
     * @param  Request  $request
     * @param  string  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $task = Country::findOrFail($id);
        $input = $request->all();
        $task->fill($input)->save();
        return back()->with('success', 'Your country has been added successfully. Please wait for the admin to approve.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Country $country
     * @return Response
     */
    public function destroy(Country $country)
    {
        $country->delete();
        return redirect()->route('admin.countries.index');
    }

}
