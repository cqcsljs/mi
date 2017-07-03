<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Hash;
use Session;
class LoginController extends Controller
{
    public function login(Request $request)
    {
        $data = $request->all();
//        dd($data);
        //设置一个@字符串
        $str = '@';

        //判断传过来的nick_name 来判断用户时用手机号登陆还是邮箱登陆
        if(strpos($data['nick_name'],$str ) == true){
            $email = DB::table('member')->where('email', '=', $data['nick_name'])->get();
            if($email == []){
                return back()->with('error', '邮箱错误')->withInput();
            }
//            dd($email[0]->password);

            if(Hash::check($data['password'], $email[0]->password)){
                $request->session()->put('user_detail', $email);
                return redirect('/');
            }else{
                return back()->with('password', '密码错误')->withInput();
            }

        }else{

            $phone = DB::table('member')->where('phone', '=', $data['nick_name'])->get();
//            dump($phone);
            if($phone == []){
                return back()->with('error', '手机号码错误错误')->withInput();
            }

            if(Hash::check($data['password'], $phone[0]->password)){
                return redirect('/');
            }else{
                return back()->with('password', '密码错误')->withInput();
            }
        }




//      dump($data);
//      dd($phone);

    }
}