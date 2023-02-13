<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Http\Library\ApiHelpers;
use Illuminate\Support\Facades\Validator;

use App\Models\Product;
use DataTables;


class OrderController extends Controller
{
    use ApiHelpers;
    public function destroy($id)
    {
        $company = Order::find($id)->delete();

        return response()->json($company);
    }

    public function edit($id)
    {
        $orders = Order::find($id);
        return response()->json($orders);
    }

    public function update(Request $req) {
        $orderProduct = Product::find([$request->product]);
        foreach($orderProduct as $prices){
         $orderPrice=$prices['price'];
        }
        $data = Order::find( $req->order_id );
        $data->email = $req->email;
        $data->phone = $req->phone;
        $data->addres = $req->addres;
        $data->data_order=$req->data_order;
        $data->summa=intval($req->count) * intval($orderPrice);
        $products = Product::find([$req->product]);
        $data->products()->detach($products,['count'=>$req->count]);
        $data->products()->attach($products,['count'=>$req->count]);
        $data->save();
        return response ()->json ($data);
    }

   public function store(Request $request) {
        $orderProduct = Product::find([$request->product]);
      foreach($orderProduct as $prices){
       $orderPrice=$prices['price'];
      }
$product = Order::create([
    
            'email'  =>  $request->email,
            'phone'  => $request->phone,
            'addres' => $request->addres,
            'count'=> $request->count,
            'data_order'=>$request->data_order,
            'summa'=>intval($request->count) * intval($orderPrice),
            
        ]);
    
        $products = Product::find([$request->product]);
    $product->products()->attach($products,['count'=>$request->count]);

}

    public function index(Request $request)
    {
        $products= Product::all();
       
        if ($request->ajax()) {
            $data = Order::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                  
                    ->addColumn('detail', function (Order $post) {
                        $products=$post->products;
                        foreach($products as $product){
                            $name= $product;
                           $text[] = 'Наименование товара:'.$name['name'].'   количество:'.$name['pivot']['count'].'   Цена:'.$name['price'].'руб'
                           ;

                            }
                        if(!empty($name)){
                         return  $text;
                        
                        }
                    })
                    ->addColumn('summa', function (Order $post) {
                        $products=$post->products;
                        foreach($products as $product){
                            $price= $product['price'] * $product['pivot']['count'];

                        }
                        if(!empty($price)){
                            return  $price;
                           
                           }
                       
                    })
                   
                    ->addColumn('action', function($row){
                        $btn = '<button  id="updateNewOrder" data-id="'.$row->id.'" class="edit btn btn-primary btn-sm">Изменить</button><button  id="deleteOrder" data-id="'.$row->id.'" class="delete btn btn-danger btn-sm">Удалить</button>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('order',['products'=>$products]);
    }

   
 




}
                    