<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
class AssetController extends Controller
{
    
    // index
    public function index()
    {
        $data['assets'] = DB::table("assets")->where("active",1)->orderBy("name")->get();
        return view("assets.index", $data);
    }
    public function create()
    {
        return view("assets.create");
    }
    public function save(Request $r)
    {
        $data = array(
            'name' => $r->name
        );
        $i = DB::table("assets")->insert($data);
        if($i)
        {
            $r->session()->flash("sms", "សម្ភារៈថ្មីបង្កើតបានដោយជោគជ័យ!");
            return redirect("/asset/create");
        }
        else{
            $r->session()->flash("sms1", "មិនអាចបង្កើតថ្មីបានទេ!");
            return redirect("/asset/create")->withInput();
        }
    }
    public function edit($id)
    {
        $data['asset'] = DB::table("assets")->where("id", $id)->first();
        return view("assets.edit", $data);
    }
    public function update(Request $r)
    {
        $data = array(
            'name' => $r->name
        );
        $i = DB::table("assets")->where("id",$r->id)->update($data);
        if($i)
        {
            $r->session()->flash("sms", "សម្ភារៈថ្មីបង្កើតបានដោយជោគជ័យ!");
            return redirect("/asset/edit/".$r->id);
        }
        else{
            $r->session()->flash("sms1", "មិនអាចបង្កើតថ្មីបានទេ!");
            return redirect("/asset/edit/".$r->id);
        }
    }
    public function delete($id)
    {
        DB::table("assets")->where("id", $id)->update(["active"=>0]);
        return redirect("/asset");
    }
}
