<?php
/**
 * Created by PhpStorm.
 * User: darryl
 * Date: 4/30/2017
 * Time: 10:58 AM
 */

namespace App\Http\Controllers;


use App\Models\Color;
use App\Models\Size;
use Auth;
use Darryldecode\Cart\CartCondition;
use http\Env\Request;
use Session;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
//use YandexCheckout\Client;
use CdekSDK\Requests;


class CartController extends Controller
{
    public function index()
    {
            $userId = (new Order)->user_guest();

            if (request()->ajax()) {
                $items = [];
                $cartCollection = \Cart::session($userId)->getContent();
                $cart = $cartCollection->sort();
                $cart->each(function ($item) use (&$items) {
                    $items[] = $item;
                });

                return response(array(
                    'success' => true,
                    'data' => $items,
                    'message' => 'cart get items success'
                ), 200, []);
            } else {
                return view('cart');
            }
    }

    public function shipping()
    {
        $userId = (new Order)->user_guest();

        if(request()->ajax())
        {
            $shipping = \Cart::session($userId)->getCondition('shippingType')->getValue();
            return response(array(
                'success' => true,
                'data' => $shipping,
                'message' => 'cart get items success'
            ),200,[]);
        }
        else
        {
            return view('cart');
        }
    }

    public function add()
    {
        $userId = (new \App\Models\Order)->user_guest();

        $name = request('name');
        $price = request('price');
        $qty = request('qty');
        $id = request('id');
        $attr= DB::table('attributeables')
            ->leftJoin('colors', 'colors.id', '=', 'attributeables.color_id')
            ->leftJoin('sizes', 'sizes.id', '=', 'attributeables.size_id')
            ->select('colors.name_color', 'colors.img_color', 'attributeables.color_id as color_id', 'sizes.rus_name_size', 'sizes.brand_name_size')
            ->where('attributeables.id', '=', request('checked_attr'))
            ->first();
        $img_color= $attr->img_color;
        $name_color= $attr->name_color;
        $brand_name_size= $attr->brand_name_size;
        $rus_name_size= $attr->rus_name_size;
        $customAttributes = [
            'id' => $id,
            'checked_attr' => request('checked_attr'),
            'color' => $attr->color_id,
            'color_code' => $img_color,
            'color_name' => $name_color,
            'size' => request('size'),
            'brand_name_size' => $brand_name_size,
            'rus_name_size' => $rus_name_size,
            'vendor_code' => request('vendor_code'),
            'img' => request('img')
        ];
        $cart_id = $id.$customAttributes['color'].$customAttributes['size'];
        $item = \Cart::session($userId)->add($cart_id, $name, $price, $qty, $customAttributes);
        return response(array(
            'success' => true,
            'data' => $item,
            'message' => "item added."
        ),201,[]);
    }

    public function addShipping()
    {
        $delivery=request('delivery');
       // $delivery=request('type');
        $city=request('city');
        $client = new \CdekSDK\CdekClient('VxnrnW9xHsyUXj3AW55AHextammXqLdx', '6IQmF7nyIoPotAlDGHJprTGIqjUeAUyr');

        if ($delivery=='cdek'){
            $request = new Requests\CalculationWithTariffListAuthorizedRequest();
            $request->setSenderCityPostCode('107014')
                ->setReceiverCityPostCode($city)
                ->addTariffToList(1)
                ->addTariffToList(8)
                ->addPackage([
                    'weight' => 0.7,
                    'length' => 30,
                    'width'  => 30,
                    'height' => 30,
                ]);

            $response = $client->sendCalculationWithTariffListRequest($request);

            /** @var \CdekSDK\Responses\CalculationWithTariffListResponse $response */
            if ($response->hasErrors()) {
                // обработка ошибок
            }
            foreach ($response->getResults() as $result) {
                if ($result->hasErrors()) {
                    // обработка ошибок
                    continue;
                }
                if (!$result->getStatus()) {
                    continue;
                }
               // $result->getTariffId();
                // int(1)
               $price= $result->getPrice();
                break;
                // double(1570)
                //$result->getDeliveryPeriodMin();
                // int(4)
                //$result->getDeliveryPeriodMax();
                // int(5)
            }
        }elseif ($delivery=='pochta'){
            $price=500;
        }elseif ($delivery=='emspochta'){
            $price=1000;
        }else{
            $price=0;
        }
        $userId = (new \App\Models\Order)->user_guest();
            $name = 'shippingType';
            $type = 'shipping';
            $target = 'total';


        \Cart::session($userId)->clearCartConditions();

        $cartCondition = new CartCondition([
            'name' => $name,
            'type' => $type,
            'target' => $target, // this condition will be applied to cart's subtotal when getSubTotal() is called.
            'value' => $price,
            'delivery' => $delivery,
            'CdekID' => request('CdekID'),
            'attributes' => array()
        ]);
//////////////////////////////////////
        \Cart::session($userId)->condition($cartCondition);

        return response(array(
            'success' => true,
            'data' => $cartCondition,
            'message' => "condition added."
        ),201,[]);
    }

    public function cartCity()
    {
        function jsonp_decode($jsonp, $assoc = false) { // PHP 5.3 adds depth as third parameter to json_decode
            if($jsonp[0] !== '[' && $jsonp[0] !== '{') {
                $jsonp = substr($jsonp, strpos($jsonp, '('));
            }
            $jsonp = trim($jsonp);      // remove trailing newlines
            $jsonp = trim($jsonp,'()'); // remove leading and trailing parenthesis

            return json_decode($jsonp, $assoc);

        }
        $cdeks=file_get_contents("https://api.cdek.ru/city/getListByTerm/jsonp.php?q=".$_GET['search']."&callback=foo");
        $cdeks=jsonp_decode($cdeks);
       foreach ($cdeks->geonames as $cdek){
           $city[]=['city'=>$cdek->cityName.', '.$cdek->regionName, 'id'=>$cdek->postCodeArray[0], 'CdekID'=>$cdek->id];

       }
        return response()->json($city);

    }

    public function cartPVZ($CityId)
    {
        //не закінчив реалізацію, є тільки ця функція для впадающого поля для ПВЗ
        $client = new \CdekSDK\CdekClient('VxnrnW9xHsyUXj3AW55AHextammXqLdx', '6IQmF7nyIoPotAlDGHJprTGIqjUeAUyr');
        $request = new Requests\PvzListRequest();
        $request->setCityId($CityId);
        $request->setType(Requests\PvzListRequest::TYPE_ALL);
        $request->setCashless(true);
        $request->setCash(true);
        $request->setCodAllowed(true);
        $request->setDressingRoom(true);

        $response = $client->sendPvzListRequest($request);

        if ($response->hasErrors()) {
            // обработка ошибок
        }

        /** @var \CdekSDK\Responses\PvzListResponse $response */
        foreach ($response as $item) {
            /** @var \CdekSDK\Common\Pvz $item */
            // всевозможные параметры соответствуют полям из API СДЭК
            $item->Code;
            $item->Name;
            $item->Address;

            foreach ($item->OfficeImages as $image) {
                $image->getUrl();
            }
        }

        //return response()->json($city);

    }

    public function addCondition()
    {
        $userId = (new \App\Models\Order)->user_guest();

        /** @var \Illuminate\Validation\Validator $v */
        $v = validator(request()->all(),[
            'name' => 'required|string',
            'type' => 'required|string',
            'target' => 'required|string',
            'value' => 'required|string',
        ]);

        if($v->fails())
        {
            return response(array(
                'success' => false,
                'data' => [],
                'message' => $v->errors()->first()
            ),400,[]);
        }

        $name = request('name');
        $type = request('type');
        $target = request('target');
        $value = request('value');

        $cartCondition = new CartCondition([
            'name' => $name,
            'type' => $type,
            'target' => $target, // this condition will be applied to cart's subtotal when getSubTotal() is called.
            'value' => $value,
            'attributes' => array()
        ]);

        \Cart::session($userId)->condition($cartCondition);

        return response(array(
            'success' => true,
            'data' => $cartCondition,
            'message' => "condition added."
        ),201,[]);
    }

    public function clearCartConditions()
    {
        $userId = (new \App\Models\Order)->user_guest();

        \Cart::session($userId)->clearCartConditions();

        return response(array(
            'success' => true,
            'data' => [],
            'message' => "cart conditions cleared."
        ),200,[]);
    }

    public function update($cart_id,$actions)
    {
        $userId = (new \App\Models\Order)->user_guest();
        \Cart::session($userId);
        //$cart = \Cart::session($userId)->getContent();
       /* if($actions=='quantity1')
        $action=-1;
        else $action=1;*/
        \Cart::update($cart_id, array(
            'quantity' => array(
                'relative' => false,
                'value' => $actions
            ),
        ));
       // $cart2 = \Cart::session($userId)->getContent();
        return response(array(
        'success' => true,
        'data' => [],
        'message' => "cart updated."
    ),200,[]);
    }

    public function delete($id)
    {
        $userId = (new \App\Models\Order)->user_guest();

        \Cart::session($userId)->remove($id);
        \Cart::session($userId)->clearCartConditions();

        return response(array(
            'success' => true,
            'data' => $id,
            'message' => "cart item {$id} removed."
        ),200,[]);
    }

    public function details()
    {
        $userId = (new \App\Models\Order)->user_guest();

        // get subtotal applied condition amount
        $conditions = \Cart::session($userId)->getConditions();


        // get conditions that are applied to cart sub totals
        $subTotalConditions = $conditions->filter(function (CartCondition $condition) {
            return $condition->getTarget() == 'subtotal';
        })->map(function(CartCondition $c) use ($userId) {
            return [
                'name' => $c->getName(),
                'type' => $c->getType(),
                'target' => $c->getTarget(),
                'value' => $c->getValue(),
            ];
        });

        // get conditions that are applied to cart totals
        $totalConditions = $conditions->filter(function (CartCondition $condition) {
            return $condition->getTarget() == 'total';
        })->map(function(CartCondition $c) {
            return [
                'name' => $c->getName(),
                'type' => $c->getType(),
                'target' => $c->getTarget(),
                'value' => $c->getValue(),
            ];
        });

        return response(array(
            'success' => true,
            'data' => array(
                'total_quantity' => \Cart::session($userId)->getTotalQuantity(),
                'sub_total' => \Cart::session($userId)->getSubTotal(),
                'total' => \Cart::session($userId)->getTotal(),
                'cart_sub_total_conditions_count' => $subTotalConditions->count(),
                'cart_total_conditions_count' => $totalConditions->count(),
                /*'shipping' => str_replace('+','',\Cart::getCondition('shippingType')->getValue()),*/
            ),
            'message' => "Get cart details success."
        ),200,[]);
    }
}
