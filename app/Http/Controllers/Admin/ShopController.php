<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Shop;


class ShopController extends Controller
{
    public function index()
    {
        return view('admin.shop.edit',[
            'shop'=>Shop::first(),
        ]);
    }



    public function edit()
    {
        return view('admin.shop.edit',[
        'shop'=>Shop::first(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $shop = Shop::first();
        $input = $request->all();

        $shop->fill($input)->save();

        return back()->with('success', 'Your Textile has been added successfully. Please wait for the admin to approve.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {


    }
}
