<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\OrderDetail;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Order;
use Session;

class OrderController extends Controller
{
    public function __construct() {
        $this->order = new Order();
    }
    public function getAll(Request $request)
    {
        $title = 'List Order';
        $orders = Order::paginate(4);
        $user = User::all();
        return view('layout.admin.order.view', compact('title', 'orders','user'));
    }
    public function handle($id) {
        $order = Order::find($id);
        $param = [
            'id_user'=>$order->id_user,
            'pttt'=>$order->pttt,
            'total'=>$order->total,
            'status'=>$order->status,
            'address_ship'=>$order->address_ship,
            'phone_ship'=>$order->phone_ship,
            'id_km'=>$order->id_km,
            'status_order'=>1,
        ];
        $update = Order::where('id','=',$id)->update($param);
        if ($update) {
            Session::flash('success', 'Update success');
            return redirect()->back()->with('success','Success');
        } else {
            Session::flash('errors', 'Error update');
            return redirect()->back()->with('errors','Fail');
        }
    }
    public function orderDetail()  {
        $title = 'List Order Detail';
        $book = Book::all();
        $order_detail = OrderDetail::paginate(4);
        return view('layout.admin.orderDetail.view',compact('order_detail','title','book'));
    }
}
