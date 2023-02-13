<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Http\Library\ApiHelpers;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;


class ApiController extends Controller
{
    use ApiHelpers;
    public function orderGet(Request $request): JsonResponse
    {
      
        if ($this->isAdmin($request->user())) {
            $orders = Order::all();
            return $this->onSuccess($orders, 'Все заказы');
        }
        
        return $this->onError(401, "У вас нет прав");
    }
    public function tokenAdd(): JsonResponse {
        if(Auth::check() && Auth::user()->role === 1){
            $user=auth()->user();
            $token= auth()->user()->createToken('auth_token', ['admin'])->plainTextToken;
           return $this->onSuccess($token, 'токен');
    }
    return $this->onError(401, "У вас нет прав");
    }
    public function editApi(Request $request,$id)
    {
       if ($this->isAdmin($request->user())) {
            $orders = Order::find($id);
            return $this->onSuccess($orders, 'заказ'.$id);
        }
         return $this->onError(401, "У вас нет прав");

      }
   
      public function storeApi(Request $request): JsonResponse
      {
          $user = $request->user();
          if ($this->isAdmin($user) ) {
            $orderProduct = Product::find([$request->product]);
            foreach($orderProduct as $prices){
             $orderPrice=$prices['price'];
            $product = Order::create([
    
                'email'  =>  $request->email,
                'phone'  => $request->phone,
                'addres' => $request->addres,
                'count'=> $request->count,
                'data_order'=>$request->data_order,
                'summa'=>intval($request->count) * intval($orderPrice),
                
            ]);
            $product->save();
            return $this->onSuccess($product, 'Заказ добавлен');
             }
          return $this->onError(401, 'Unauthorized Access');
      }
    }
    public function destroyApi(Request $request, $id): JsonResponse
    {   $user = $request->user();
         if ($this->isAdmin($user) ) {
        $order = Order::find($id)->delete();
        return $this->onSuccess($order, 'Заказ удален');
        
    }
    return $this->onError(401, 'Unauthorized Access');


}
}