<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Storage;
use Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
class UserController extends Controller
{
    public function getAll(Request $request)
    {
            $title = 'List User';
            $request_path = ucfirst($request->path());
            $user = User::paginate(4);
            return view('layout.admin.user.view', compact('title', 'request_path', 'user'));
    }
    public function insert(Request $request)
    {
        $request_path = ucfirst($request->path());
        if ($request->isMethod('post')) {
            $param = $request->post();
            unset($param['_token']);
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $request->image = $this->uploadFile('image', $request->file('image'));
            }
            $user = new User();
            $user->name = $request->name;
            // $user->phone = $request->phone;
            $user->address = $request->address;
            $user->email = $request->email;
            $user->username = $request->username;
            $user->password = Hash::make($request->password);
            $user['email_verified_at'] = Carbon::now('Asia/Ho_Chi_Minh');
            $user->image = $request->image;
            $user->role = $request->role;
            if ($user->save()) {
                Session::flash('success', 'Success User');
                return redirect()->route('user');
                // redirect->route : dien cai name
            } else {
                Session::flash('errors', 'Error User');
                return redirect()->route('insert');
            }
        }

        return view('layout.admin.user.add', compact('request_path'));
    }
    public function edit($id, Request $request)
    {
        $detail = User::find($id);
        if ($request->isMethod('post')) {
            $param = $request->post();
            $param['image'] = $detail->image;
            unset($param['_token']);
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                if ($param['image'] != '') {
                    if ($this->deleteFile($detail->image)) {
                        $param['image'] = $this->uploadFile('image', $request->file('image'));
                    }
                } else {
                    $param['image'] = $this->uploadFile('image', $request->file('image'));
                }
            }
            $param['password'] = Hash::make($request->password);
            $param['email_verified_at'] = Carbon::now('Asia/Ho_Chi_Minh');
            $update = User::where('id', $id)->update($param);
            if ($update) {
                Session::flash('success', 'Update success');
                return redirect()->route('user');
            } else {
                Session::flash('errors', 'Error update');
                return redirect()->route('detail', ['id' => $id]);
            }
        }
        return view('layout.admin.user.edit', compact('detail'));
    }
    public function profiles($id)
    {
        $user = User::find($id);
        return view('layout.admin.user.detail', compact('user'));
    }
    public function delete($id)
    {
        if ($id) {
            $deleted = User::where('id', $id)->delete();
            if ($deleted) {
                Session::flash('success', 'Delete Success');
                return redirect()->route('user');
            } else {
                Session::flash('errors', 'Delete fail');
                return redirect()->route('user');
            }
        }
        return redirect()->route('user');

    }
    public function view_delete(Request $request)
    {
        $title = 'List Deleted User';
        $request_path = ucfirst($request->path());
        $user_deleted = User::onlyTrashed()->get();
        return view('layout.admin.user.softdelete', compact('user_deleted', 'title', 'request_path'));
    }
    public function force($id)
    {
        $forceDelete = User::withTrashed()->where('id', $id)->forceDelete();
        if ($forceDelete) {
            Session::flash('success', 'Delete Success');
            return redirect()->route('view-delete');
        } else {
            Session::flash('errors', 'Delete fail');
            return redirect()->route('view-delete');
        }

    }
    public function restore($id)
    {
        $restore = User::withTrashed()->where('id', $id)->restore();
        if ($restore) {
            Session::flash('success', 'Move Success');
            return redirect()->route('user');
        } else {
            Session::flash('errors', 'Move fail');
            return redirect()->route('user');
        }
    }
    public function profiles_detail()
    {
        if (Auth::user()) {
            $profiles = Auth::user();
            return view('layout.admin.profiles',compact('profiles'));
        }
    }
    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                if (Auth::user()->role != 1) {
                    return redirect()->route('dashboard');
                } else {
                    Session::flash('success', 'Login success');
                    return redirect()->route('home');
                }
            }else {
                Session::flash('errors', 'Wrong login information');
                return redirect()->route('login');
            }
        }
        return view('layout.auth.login');
    }
    public function register(Request $request)
    {
        if ($request->isMethod('post')) { 
            $param = $request->except('_token');
            $param['password'] = Hash::make($request->password);
            $param['email_verified_at'] = Carbon::now('Asia/Ho_Chi_Minh');
            $user = User::create($param);
            if ($user->id) {
                Session::flash('success', 'Dang ky thanh cong');
                return redirect()->intended('register');
            } else {
                Session::flash('errors', 'Sai thong tin dang nhap');
                return redirect()->route('register');
            }
        }
        return view('layout.auth.resgister');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('home');
    }

    public function profile()  {
        if (Auth::user()) {
            $profiles = Auth::user();
            return view('layout.admin.profiles.profiles',compact('profiles'));
        }
    }
}
