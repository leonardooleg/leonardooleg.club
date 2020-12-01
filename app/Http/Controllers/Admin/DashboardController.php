<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Status;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class DashboardController extends Controller
{
    public function __construct()
    {
       // $this->middleware('auth');
    }

    // Dashboard
    public function dashboard()
    {
        $orders = Order::all();
        $arr = [
            'Январь',
            'Февраль',
            'Март',
            'Апрель',
            'Май',
            'Июнь',
            'Июль',
            'Август',
            'Сентябрь',
            'Октябрь',
            'Ноябрь',
            'Декабрь'
        ];
        $day=date('j');
        $month= date('n');
        $month_arr = $month-1;

        for ($i=1; $i<=$day; $i++){
            $graf_month[] = mb_substr($arr[$month_arr], 0, 3, 'UTF-8') .' '. $i;
            $graf_data[] = Order::where('status','>',1)->whereDay('created_at', '=',$i)->count();
        }
        $max=0;
        for ($i=1; $i<=$month; $i++){
            $col_month[] = $arr[$i-1];
            $count= Order::where('status','>',1)->whereMonth('created_at', '=',$i)->count();
            $col_data[] = $count;
            $max= $count+$max;
        }


        return view("admin.dashboard", [

            'user' => Auth::user()->name,
            'statuses' => Status::all(),
            'orders' => $orders,
            'month_arr' => $arr[$month_arr],
            'labels' => $graf_month,
            'graf_data' => $graf_data,
            'col_month' => $col_month,
            'col_data' => $col_data,
            'col_max' => $max

        ]);
    }

    //График
    public function chartData()
    {
        return [
            'labels' => ['март', 'апрель', 'май', 'июнь'],
            'datasets' => array(
                [
                    'label' => 'Продажи',
                    'backgroundColor' => '#F26202',
                    'data' => [1000, 5000, 100, 300],
                ],
                [
                    'label' => 'Заказы',
                    'backgroundColor' => '#3490dc',
                    'data' => [15000, 500, 1000, 3000],
                ])
        ];
    }
}
