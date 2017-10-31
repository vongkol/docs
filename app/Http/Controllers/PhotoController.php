<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
class PhotoController extends Controller
{
    //
    public function index()
    {
        $data['sliders'] = DB::table("photos")->where("active",1)->orderBy("id")->get();
        return view("sliders.index", $data);
    }
    public function create(){
    	return view("sliders.create");
    }

    public function save(Request $r)
    {
    	$this->validate($r, [
        'file_name' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    	]);

    	$filename = $r->file('file_name')->hashName();
    	$lastid = DB::table('photos')->orderBy('id', 'desc')->first();
    	$id=$lastid->id+1;
    	$image =$id.'_'.$filename;
		$r->file_name->move(public_path('uploads/slider'), $image);
        $data = array(
            'title' => $r->title,
            'file_name' => $image,
            'order' => $r->order
        );
        $i = DB::table('photos')->insert($data);
        if($i)
        {
        	
            $r->session()->flash("sms", "រូបភាពថ្មីបង្កើតបានដោយជោគជ័យ!");
            return redirect("/slider/create");
        }
        else{
            $r->session()->flash("sms1", "មិនអាច upload ថ្មីបានទេ!");
            return redirect("/slider/create")->withInput();
        }

    }

    public function edit($id)
    {
        $data['slider'] = DB::table("photos")->where("id", $id)->first();
        return view("sliders.edit", $data);
    }
    public function update(Request $r)
    {
        
        $id = $r->id;
    	$fname = $r->file('file_name');
    	if($fname!=""){
    		$this->validate($r, [
	        'file_name' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
	    	]);
	    	$filename = $fname->hashName();
	    	$image =$id.'_'.$filename;
			$r->file_name->move(public_path('uploads/slider'), $image);
			$data['file_name'] = $image;
    	}

        $data['title'] = $r->title;
        $data['order'] = $r->order;
           
        $i = DB::table('photos')->where("id", $id)->update($data);
        if($i)
        {
        	
            $r->session()->flash("sms", "ព័ត៌មានបានកែប្រែដោយជោគជ័យ!");
            return redirect("/slider");
        }
        else{
            $r->session()->flash("sms1", "មិនអាចកែប្រែបានទេ!");
            return redirect("/slider/edit")->withInput();
        }
    }

    public function delete($id)
    {
        DB::table("photos")->where("id", $id)->update(["active"=>0]);
        return redirect("/slider");
    }
}
