<?php

namespace App\Http\Controllers;

use function foo\func;
use Illuminate\Http\Request;
use DB;
class FrontController extends Controller
{
    // index
    public function index(Request $r)
    {
        $user = $r->session()->get("user");
        if($user==null)
        {
            return redirect('/front/login');
        }
        $data['roots'] = DB::table("document_category")->where("active",1)->orderBy('name')->get();
        return view("fronts.index", $data);
    }
    public function request(Request $r)
    {
        $user = $r->session()->get("user");
        if($user==null)
        {
            return redirect('/front/login');
        }
        return view("fronts.request");
    }
    public function login()
    {
        return view("fronts.login");
    }
    public function dologin(Request $r)
    {
        $username = $r->username;
        $password = md5($r->password);
        $user = DB::table("front_users")->where("username", $username)->where("password", $password)->first();
        if($user!==null)
        {
            $r->session()->put("user", $user);
            return redirect("/front/home");
        }
        else{
            $r->session()->flash("sms", "ឈ្មោះ ឬលេខសម្ងាត់មិនត្រឹមត្រូវទេ!");
            return redirect("/front/login")->withInput();
        }
    }
    public function logout(Request $r)
    {
        $r->session()->forget("user");
        return redirect("/front/login");
    }
    public function sub1($id)
    {
        $data['root'] = DB::table("document_category")->where("id", $id)->first();
        $data['sub1s'] = DB::table("sub1")->where("parent_id", $id)->where("active", 1)->orderBy("name")->get();
        $data['docs'] = DB::table("documents")->where("category_id", $id)->where("type", "root")->where("active",1)->orderBy("title")->get();
        return view("fronts.sub1", $data);
    }
    public function sub2($id)
    {
        $data['sub1'] = DB::table("sub1")->where("id", $id)->first();
        $data['root'] = DB::table("document_category")->where("id", $data['sub1']->parent_id)->first();
        $data['sub2s'] = DB::table("sub2")->where("parent_id", $id)->where("active",1)->orderBy("name")->get();
        $data['docs'] = DB::table("documents")->where("category_id", $id)->where("type", "sub1")->where("active",1)->orderBy("title")->get();
        return view("fronts.sub2", $data);
    }
    public function sub3($id)
    {
        $data['sub2'] = DB::table("sub2")->where("id", $id)->first();
        $data['sub1'] = DB::table("sub1")->where("id", $data['sub2']->parent_id)->first();
        $data['root'] = DB::table("document_category")->where("id", $data['sub1']->parent_id)->first();
        $data['sub3s'] = DB::table("sub3")->where("parent_id", $id)->where("active",1)->orderBy("name")->get();
        $data['docs'] = DB::table("documents")->where("category_id", $id)->where("type", "sub2")->where("active",1)->orderBy("title")->get();
        return view("fronts.sub3", $data);
    }
    public function sub4($id)
    {
        $data['sub3'] = DB::table("sub3")->where("id", $id)->first();
        $data["sub2"] = DB::table("sub2")->where("id", $data["sub3"]->parent_id)->first();
        $data["sub1"] = DB::table("sub1")->where("id", $data["sub2"]->parent_id)->first();
        $data["root"] = DB::table("document_category")->where("id", $data["sub1"]->parent_id)->first();
        $data['docs'] = DB::table("documents")->where("category_id", $id)->where("type", "sub3")->where("active",1)->orderBy("title")->get();
        return view("fronts.sub4", $data);
    }
    public function search(Request $r)
    {
        $user = $r->session()->get("user");
        if($user==null)
        {
            return redirect('/front/login');
        }
        $data['q'] = "";
        $data['docs'] = [];
        return view("fronts.search", $data);
    }
    public function do_search(Request $r)
    {
        $user = $r->session()->get("user");
        if($user==null)
        {
            return redirect('/front/login');
        }
        $q = $r->q;
        $data['q'] = $q;
        if ($q=="")
        {
            // list all document
            $data['docs'] = DB::table("documents")->where("active",1)->orderBy("title")->get();
            return view("fronts.search", $data);
        }
        else{
            $arr = explode(" ", $q);
            if (count($arr)==1)
            {
                $data['docs'] = DB::table("documents")
                    ->where("active",1)
                    ->where(function ($query) use ($arr){
                        $query->orWhere("title", "like", "%{$arr[0]}%")
                            ->orWhere("description", "like", "%{$arr[0]}%")
                            ->orWhere("file_name", "like", "%{$arr[0]}%")
                            ->orWhere("id", $arr[0]);
                    })
                    ->orderBy("title")->get();
                return view("fronts.search", $data);
            }
            else if(count($arr)==2)
            {
                $data['docs'] = DB::table("documents")
                    ->where("active",1)
                    ->where(function ($query) use ($arr){
                        $query->orWhere("title", "like", "%{$arr[0]}%")
                            ->orWhere("title", "like", "%{{$arr[1]}%")
                            ->orWhere("description", "like", "%{$arr[0]}%")
                            ->orWhere("description", "like", "%{$arr[1]}%")
                            ->orWhere("file_name", "like", "%{$arr[0]}%")
                            ->orWhere("file_name", "like", "%{$arr[1]}%")
                            ->orWhere("id", $arr[0])
                            ->orWhere("id", $arr[1]);
                    })
                    ->orderBy("title")->get();
                return view("fronts.search", $data);
            }
            else
            {
                $data['docs'] = DB::table("documents")
                    ->where("active",1)
                    ->where(function ($query) use ($arr){
                        $query->orWhere("title", "like", "%{$arr[0]}%")
                            ->orWhere("title", "like", "%{{$arr[1]}%")
                            ->orWhere("title", "like", "%{{$arr[2]}%")
                            ->orWhere("description", "like", "%{$arr[0]}%")
                            ->orWhere("description", "like", "%{$arr[1]}%")
                            ->orWhere("description", "like", "%{$arr[2]}%")
                            ->orWhere("file_name", "like", "%{$arr[0]}%")
                            ->orWhere("file_name", "like", "%{$arr[1]}%")
                            ->orWhere("file_name", "like", "%{$arr[2]}%")
                            ->orWhere("id", $arr[0])
                            ->orWhere("id", $arr[1])
                            ->orWhere("id", $arr[2]);
                    })
                    ->orderBy("title")->get();
                return view("fronts.search", $data);
            }
        }

    }
    public function setting(Request $r)
    {
        $user = $r->session()->get("user");
        if($user==null)
        {
            return redirect('/front/login');
        }
        $data['user'] = $user;
        return view("fronts.setting", $data);
    }
    public function dosetting(Request $r)
    {
        $user = $r->session()->get("user");
        if($user==null)
        {
            return redirect('/front/login');
        }
        $id = $r->id;
        $username = $r->username;
        $pass = $r->password;
        $data = array(
            "username" => $username
        );
        if ($pass!="")
        {
            $data['password'] = md5($pass);
        }
        $i = DB::table("front_users")->where("id", $id)->update($data);
        $user = DB::table("front_users")->where("id", $id)->first();
        $r->session()->put("user", $user);
        $r->session()->flash("sms", "ពត៌មានត្រូវបានកែប្រែដោយជោគជ័យ!");
        return redirect("/front/setting");
    }
    public function home(Request $r)
    {
        $user = $r->session()->get("user");
        if($user==null)
        {
            return redirect('/front/login');
        }
        $data["sliders"] = DB::table("sliders")->where("active", 1)->get();
        return view("fronts.home", $data);
    }
}
