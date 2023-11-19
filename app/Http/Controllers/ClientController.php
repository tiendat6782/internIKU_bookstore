<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Discount;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Rate;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Session;
use Auth;
use App\Models\User;
use DB;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->cate = new Category();
    }
    public function home()
    {
        $book = Book::limit(3)->get();
        return view('layout.client.home', compact('book'));
    }
    public function shop(Request $req)
    {
        $cate = $this->cate::all();
        $query = new Book();
        if ($req->isMethod('post')) {
            if ($req->keyCate != '') {
                $query = $query->where('id_cate', '=', $req->keyCate);
            }
            if ($req->keyBook != '') {
                $query = $query->where('name', 'like', $req->keyBook);
            }
            if ($req->keyAuthor != '') {
                $query = $query->where('author', 'like', $req->keyAuthor);
            }
        }
        $book = $query->paginate(8);
        return view('layout.client.shop', compact('book', 'cate'));
    }
    public function detail($id)
    {
        $book = Book::find($id);
        $cate = Category::find($book->id_cate);
        $rate = DB::table('rates')->leftJoin('users', 'users.id', '=', 'rates.id_user')->where('rates.id_book', '=', $id)->select('rates.*', 'users.name', 'users.image')->limit(4)->get();
        $flag = false;
        if (Auth::user()) {
            $checkUserOrdered = Order::where('id_user', '=', Auth::user()->id)->get();
            foreach ($checkUserOrdered as $key => $value) {
                $checkOrderDetail = OrderDetail::where('id_order', '=', $value->id)->get();
                if ($checkOrderDetail[0]->id_book == $id) {
                    $flag = true;
                }
            }
        }
        return view('layout.client.detail', compact('book', 'cate', 'flag', 'rate'));
    }
    public function contact()  {
        return view('layout.client.contact');
    }
    public function blog()  {
        return view('layout.client.blog');
    }
    public function addtocart($id)
    {
        $book = Book::find($id);
        $param = $book->id;
        $price = $book->price;
        $name = $book->name;
        $addtocart = Cart::add($param, $name, 1, $price);
        if ($addtocart) {
            return redirect()->back()->with('success', 'Add to cart successfully');
        }
    }
    public function getCart()
    {
        $getCart = Cart::content();
        $cart = [];
        foreach ($getCart as $key => $value) {
            $cart[] = [$value, Book::find($value->id)];
        }
        $subtotal = Cart::subtotal();
        $total = Cart::total();
        return view('layout.client.cart', compact('cart', 'total', 'subtotal'));
    }
    public function removeCart($id)
    {
        $delete = Cart::remove($id);
        if ($delete) {
            Session::flash('success', 'Delete Successfully');
            return redirect()->route('getCart');
        } else {
            Session::flash('errors', 'Delete Fail');
            return redirect()->route('getCart');
        }
    }
    public function updateCart(Request $request)
    {
        $qty = $request->post()['qty'];
        $rowId = $request->post()['rowId'];
        $data = array_combine($rowId, $qty);
        foreach ($data as $key => $value) {
            Cart::update($key, $value);
        }
        return redirect()->route('getCart');
    }
    public function profiles(Request $request)
    {
        if (Auth::user()) {
            $user = Auth::user();
            if ($request->isMethod('post')) {
                $param = $request->post();
                $param['image'] = $user->image;
                unset($param['_token']);
                if ($request->hasFile('image') && $request->file('image')->isValid()) {
                    if ($param['image'] != '') {
                        if ($this->deleteFile($user->image)) {
                            $param['image'] = $this->uploadFile('image', $request->file('image'));
                        }
                    } else {
                        $param['image'] = $this->uploadFile('image', $request->file('image'));
                    }
                }
                $id = $param['id_user'];
                unset($param['id_user']);
                // dd($param);
                $update = User::where('id', $id)->update($param);
                if ($update) {
                    Session::flash('success', 'Update success');
                    return redirect()->route('profiles_client');
                } else {
                    Session::flash('errors', 'Error update');
                    return redirect()->route('profiles_client', ['id' => $id]);
                }
            }
            return view('layout.client.profile', compact('user'));
        }
    }
    public function order(Request $request)
    {
        if (Auth::user()) {
            $getCart = Cart::content();
            $cart = [];
            foreach ($getCart as $key => $value) {
                $cart[] = [$value, Book::find($value->id)];
            }
            // dd(session('key'));
            $subtotal = Cart::subtotal();
            $total = Cart::total();
            if (session('key')) {
                $total = $total - ((session('key')[3] / 100) * $total);
            }
            if ($request->isMethod('post')) {
                if ($request->pttt == 0) {
                    $param = $request->post();
                    unset($param['_token']);
                    $param['id_user'] = Auth::user()->id;
                    $param['total'] = $total;
                    $param['status'] = 0; // 0  chua thanh toan , 1 da thanh toan , 2 dang giao hang
                    if (session('key')) {
                        $param['id_km'] = session('key')[0];
                    }
                    $order = Order::create($param);
                    if ($order) {
                        foreach ($cart as $key => $value) {
                            $cartItem = [
                                'id_order' => $order->id,
                                'id_book' => $value[0]->id,
                                'soLuong' => $value[0]->qty,
                                'price' => $value[0]->qty * $value[0]->price
                            ];
                            OrderDetail::create($cartItem);
                        }
                        Cart::destroy();
                        $request->session()->flush();
                    }
                    return redirect()->route('ordered');
                } elseif ($request->pttt == 1) {
                    $param = $request->post();
                    unset($param['_token']);
                    $param['id_user'] = Auth::user()->id;
                    $param['total'] = $total;
                    $param['status'] = 0; // 0  chua thanh toan , 1 da thanh toan , 2 dang giao hang
                    if (session('key')) {
                        $param['id_km'] = session('key')[1];
                    }
                    // dd($param);
                    $order = Order::create($param);
                    if ($order) {
                        foreach ($cart as $key => $value) {
                            $cartItem = [
                                'id_order' => $order->id,
                                'id_book' => $value[0]->id,
                                'soLuong' => $value[0]->qty,
                                'price' => $value[0]->qty * $value[0]->price
                            ];
                            OrderDetail::create($cartItem);
                        }
                        Cart::destroy();
                        $request->session()->flush();
                    }
                    $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
                    $vnp_Returnurl = route('ordered');
                    $vnp_TmnCode = "2FCPIC58"; //Mã website tại VNPAY 
                    $vnp_HashSecret = "TIGLZFDDYFRKMOPMAYQCTFJVCCRWGAGB"; //Chuỗi bí mật
                    $vnp_TxnRef = $order->id; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
                    $vnp_OrderInfo = 'Thanh Toán hóa đơn ';
                    $vnp_OrderType = 'DungTuan Store';
                    $vnp_Amount = $total * 100;
                    $vnp_Locale = "VN";
                    $vnp_BankCode = "NCB";
                    $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
                    $inputData = array(
                        "vnp_Version" => "2.1.0",
                        "vnp_TmnCode" => $vnp_TmnCode,
                        "vnp_Amount" => $vnp_Amount,
                        "vnp_Command" => "pay",
                        "vnp_CreateDate" => date('YmdHis'),
                        "vnp_CurrCode" => "VND",
                        "vnp_IpAddr" => $vnp_IpAddr,
                        "vnp_Locale" => $vnp_Locale,
                        "vnp_OrderInfo" => $vnp_OrderInfo,
                        "vnp_OrderType" => $vnp_OrderType,
                        "vnp_ReturnUrl" => $vnp_Returnurl,
                        "vnp_TxnRef" => $vnp_TxnRef

                    );

                    if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                        $inputData['vnp_BankCode'] = $vnp_BankCode;
                    }
                    ksort($inputData);
                    $query = "";
                    $i = 0;
                    $hashdata = "";
                    foreach ($inputData as $key => $value) {
                        if ($i == 1) {
                            $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                        } else {
                            $hashdata .= urlencode($key) . "=" . urlencode($value);
                            $i = 1;
                        }
                        $query .= urlencode($key) . "=" . urlencode($value) . '&';
                    }
                    $vnp_Url = $vnp_Url . "?" . $query;
                    if (isset($vnp_HashSecret)) {
                        $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
                        $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
                    }

                    $returnData = array(
                        'code' => '00',
                        'message' => 'success',
                        'data' => $vnp_Url
                    );
                    if ($request->isMethod('post')) {
                        $update = Order::where('id', '=', $order->id)->update(['status' => 1]);
                        Cart::destroy();
                        $request->session()->flush();
                        header('Location: ' . $vnp_Url);
                        die();
                    } else {
                        echo json_encode($returnData);
                    }
                }
            }
            return view('layout.client.checkout', compact('cart', 'subtotal', 'total'));
        }
    }
    public function addCouponCode(Request $request)
    {
        if ($request->isMethod('post')) {
            // dd($request->post());
            $resust = Discount::where('code', '=', $request->code)->get();
            if ($resust) {
                session(['key' => [$resust[0]->id, $resust[0]->name, $resust[0]->code, $resust[0]->giatri]]);
                return redirect()->back()->with('message', 'code ton tai');
            }
            return redirect()->back()->with('message', 'Code khong ton tai');
        }
    }
    public function ordered()
    {
        if (Auth::user()) {
            $ordered = Order::where('id_user', '=', Auth::user()->id)->get();
            $order_detail = OrderDetail::all();
            $book = Book::all();
            return view('layout.client.order', compact('ordered', 'order_detail', 'book'));
        }
    }
    public function cancel($id)
    {
        $order = Order::find($id);
        $param = [
            'id_user' => $order->id_user,
            'pttt' => $order->pttt,
            'total' => $order->total,
            'status' => $order->status,
            'address_ship' => $order->address_ship,
            'phone_ship' => $order->phone_ship,
            'id_km' => $order->id_km,
            'status_order' => 3,
        ];
        $update = Order::where('id', '=', $id)->update($param);
        if ($update) {
            Session::flash('success', 'Cảm ơn bạn đã sử dụng website của chúng tôi . Không biết bạn đang thắc mắc về dịch vụ nào của cửa hàng ');
            return redirect()->route('ordered');
        } else {
            Session::flash('errors', 'Error update');
            return redirect()->route('ordered');
        }
    }
    public function receive($id)
    {
        $order = Order::find($id);
        $param = [
            'id_user' => $order->id_user,
            'pttt' => $order->pttt,
            'total' => $order->total,
            'status' => 1,
            'address_ship' => $order->address_ship,
            'phone_ship' => $order->phone_ship,
            'id_km' => $order->id_km,
            'status_order' => 2,
        ];
        $update = Order::where('id', '=', $id)->update($param);
        if ($update) {
            Session::flash('success', 'Cảm ơn vì đã luôn tin dùng website của chúng tôi !');
            return redirect()->route('ordered');
        } else {
            Session::flash('errors', 'Error update');
            return redirect()->route('ordered');
        }
    }
    public function rate(Request $request)
    {
        $param = [
            'id_user' => Auth::user()->id,
            'id_book' => $request->id_book,
            'content' => $request->content,
            'rate' => $request->star
        ];
        $create = Rate::create($param);
        if ($create) {
            Session::flash('success_rate', 'Cảm ơn bạn đã đánh giá sản phẩm bên cửa hàng chúng tôi. ');
            return redirect()->route('detail', ['id' => $request->id_book]);
        } else {
            Session::flash('errors_rate', 'Error update');
            return redirect()->route('detail', ['id' => $request->id_book]);
        }
    }
}