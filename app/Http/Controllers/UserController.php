<?php

namespace App\Http\Controllers;

use App\User;
use function foo\func;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function getSignup()
    {
        return view('user.signup');
    }

    public function postSignup(Request $request)
    {
        $this->validate($request, [
            'email'     => 'email|required|unique:users',
            'password'  => 'required|min:4'
        ]);

        $user = new User([
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $user->save();

        Auth::login($user);

        if (Session::has('oldUrl')) {
            $oldUrl = Session::get('oldUrl');
            Session::forget('oldUrl');
            return redirect()->to($oldUrl);
        }

        return redirect()->route('product.index');
    }

    public function getSignin()
    {
        return view('user.signin');
    }

    public function postSignin(Request $request)
    {
        $this->validate($request, [
            'email'     => 'email|required',
            'password'  => 'required|min:4'
        ]);

        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
            ])) {
            if (Session::has('oldUrl')) {
                $oldUrl = Session::get('oldUrl');
                Session::forget('oldUrl');
                return redirect()->to($oldUrl);
            }
            return redirect()->route('user.profile');
        }
        return redirect()->back();
    }

    public function getProfile()
    {
        $orders = Auth::user()->orders()->orderBy('created_at', 'desc')->get();
        $orders->transform(function ($order, $key) {
            $order->cart = unserialize($order->cart);
            return $order;
        });
        return view('user.profile', ['orders' => $orders]);
    }

    public function getLogout()
    {
        Auth::logout();
        return redirect()->route('user.signin');
    }
}
