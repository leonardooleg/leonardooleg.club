<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Status;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\Order;

class ProfileController extends Controller
{



    public function index(){
        $user = Auth::user();
        $orders= DB::table('orders')
            ->leftJoin('statuses', 'statuses.id', '=', 'orders.status')
            ->select('orders.*', 'statuses.status_name', 'statuses.status_code')
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();
        $all_statuses= Status::all()->toArray();
        $items =array();
        ////////
        $client = new \RetailCrm\ApiClient(
            'https://silkandlace2.retailcrm.ru/',
            'ctdh3KV0salK3A32t2I7TFTiSjem712B',
            \RetailCrm\ApiClient::V5
        );
        ///
        foreach ($orders as $order){
            $cartCollection = $order->cart_data;
            $items[] = json_decode($cartCollection, true);
            $id_retail[]=$order->id_retailcrm;

        }

        try {
            $response = $client->request->ordersStatuses($id_retail,array());
        } catch (\RetailCrm\Exception\CurlException $e) {
            echo "Connection error: " . $e->getMessage();
        }

        if ($response->isSuccessful()) {
            //echo $response->orders[0]['status'];
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

        return view('profile.index', compact('user', 'orders', 'items'));
    }

    public function profileEdit(){
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function profileUpdate(Request $request){
        $user = Auth::user();
        $avatar = $request->file('avatar'); //при завантажені файлів
        if ($avatar) {
            $data = "/" . $avatar->store('uploads/avatar', 'public');
           $user->avatar = $data;
        }
       /* if ($request->phone) {
            $user->phone = $request->phone;
        }*/
        if ($request->name) {
            $user->name = $request->name;
        }
        if ($request->email) {
            $user->email = $request->email;
        }
        if ($request->password) {
            $user->password = $request->password;
        }
        $user->save();
        return view('profile.edit', compact('user'));
    }


}
