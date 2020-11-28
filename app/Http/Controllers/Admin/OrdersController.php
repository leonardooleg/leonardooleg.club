<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Darryldecode\Cart\CartCollection;
use Darryldecode\Cart\CartCondition;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Order;
use App\Models\Status;
use App\Models\Textile;
use App\Models\Textileable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::orderBy('created_at', 'desc')->paginate(30);
        $all_statuses = Status::all();

        $client = new \RetailCrm\ApiClient(
            'https://silkandlace2.retailcrm.ru/',
            'ctdh3KV0salK3A32t2I7TFTiSjem712B',
            \RetailCrm\ApiClient::V5
        );
        foreach ($orders as $order){
            $id_retail[]=$order->id_retailcrm;

        }

        try {
            $response = $client->request->ordersStatuses($id_retail,array());
        } catch (\RetailCrm\Exception\CurlException $e) {
            echo "Connection error: " . $e->getMessage();
        }

        if ($response->isSuccessful()) {
            foreach ($response->orders as $order_one){
                foreach ($orders as $s_order) {
                    if ($s_order->id_retailcrm == $order_one["id"]) {
                        if ($order_one['status'] != $s_order->status_code) {
                            foreach ($all_statuses as $one_statuses) {
                                if ($order_one['status'] == $one_statuses["status_code"]) {
                                    $affected = DB::table('orders')
                                        ->where('id', $s_order->id)
                                        ->update(['status' => $one_statuses["id"]]);
                                    $i = 0;
                                    foreach ($orders as $order) {
                                        if ($order->id == $s_order->id) {
                                            $orders[$i]->status = $one_statuses["id"];
                                            $orders[$i]->status_name = $one_statuses["status_name"];
                                            $orders[$i]->status_code = $one_statuses["status_code"];
                                        }
                                        $i++;

                                    }

                                }
                            }

                        }
                    }
                }

            }
          } else {
                echo sprintf(
                "Error: [HTTP-code %s] %s",
                $response->getStatusCode(),
                $response->getErrorMsg()
                );

        }

        return view('admin.orders.index',[
            'orders'=>$orders,
            'statuses'=>$all_statuses
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function edit($id)
    {
        $order= Order::where('id', $id)->first();
        $all_statuses = Status::all();
        foreach ($all_statuses as $one_status){
            if ($order["status"] == $one_status->id){
                $order["status_code"]=$one_status->status_code;
                $order["status_name"]=$one_status->status_name;
            }
        }
        $client = new \RetailCrm\ApiClient(
            'https://silkandlace2.retailcrm.ru/',
            'ctdh3KV0salK3A32t2I7TFTiSjem712B',
            \RetailCrm\ApiClient::V5
        );

        $id_retail[]=$order->id_retailcrm;



        try {
            $response = $client->request->ordersStatuses($id_retail,array());
        } catch (\RetailCrm\Exception\CurlException $e) {
            echo "Connection error: " . $e->getMessage();
        }

        if ($response->isSuccessful()) {
            foreach ($response->orders as $order_one){
                    if($order->id_retailcrm == $order_one["id"]){
                        if($order_one['status']!=$order->status_code){
                            foreach ($all_statuses as $one_statuses){
                                if($order_one['status']==$one_statuses["status_code"]){
                                    $affected = DB::table('orders')
                                        ->where('id', $order->id)
                                        ->update(['status' => $one_statuses["id"]]);
                                    $order["status_"]=$one_statuses["id"];
                                    $order["status_name"]=$one_statuses["status_name"];
                                    $order["status_code"]=$one_statuses["status_code"];


                                }
                            }

                        }
                    }


            }
        } else {
            echo sprintf(
                "Error: [HTTP-code %s] %s",
                $response->getStatusCode(),
                $response->getErrorMsg()
            );

        }
        $cartCollection = $order->cart_data;
        $items = json_decode($cartCollection, true);


        return view('admin.orders.edit', [
            'order' => $order,
            'statuses' => $all_statuses,
            'items' => $items,

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $input = $request->all();
        $client = new \RetailCrm\ApiClient(
            'https://silkandlace2.retailcrm.ru/',
            'ctdh3KV0salK3A32t2I7TFTiSjem712B',
            \RetailCrm\ApiClient::V5
        );

        $id_retail[]=$order->id_retailcrm;



        try {
            $response = $client->request->ordersStatuses($id_retail,array());
        } catch (\RetailCrm\Exception\CurlException $e) {
            echo "Connection error: " . $e->getMessage();
        }

        if ($response->isSuccessful()) {

        }
        if($input['status']==2 and $order->status!=2){
            $temps= json_decode($order->cart_data);
            foreach ($temps as $temp){
                $t= Product::where('id',$temp->attributes->id)->update(['count' => DB::raw('count-1')]);
            }
        }
        $order->fill($input)->save();

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
