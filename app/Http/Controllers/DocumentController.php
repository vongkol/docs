<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
class DocumentController extends Controller
{
    // index
    public function index()
    {
        if (Auth::user()==null)
        {
            return redirect('/login');
        }
        return view("documents.index");
    }
    public function save(Request $r)
    {
        if (Auth::user()==null)
        {
            return redirect('/login');
        }
        $id = $r->id;

        if($id>0)
        {
            // update document
            $data = array(
                "title" => $r->doc_title,
                "description" => $r->description
            );
            if($r->hasFile("doc_file_name"))
            {
                $file = $r->file('doc_file_name');
                $file_name = $id . "-" .$file->getClientOriginalName();
                $destinationPath = 'uploads/';
                $file->move($destinationPath, $file_name);
                $data["file_name"] = $file_name;
                DB::table('documents')->where('id', $id)->update($data);
            }
            else{
                DB::table("documents")->where("id", $id)->update($data);
            }
            return json_encode(DB::table("documents")->where("id", $id)->first());
        }
        else{
            $data = array(
                "title" => $r->doc_title,
                "description" => $r->description,
                "category_id" => $r->category_id,
                "type" => $r->type
            );
            // add new document
            if($r->hasFile("doc_file_name"))
            {
                $i = DB::table("documents")->insertGetId($data);
                // insert success, now upload document to folder uploads
                if($i>0)
                {
                    $file = $r->file('doc_file_name');
                    $file_name = $i . "-" .$file->getClientOriginalName();
                    $destinationPath = 'uploads/';
                    $file->move($destinationPath, $file_name);
                    DB::table('documents')->where('id', $i)->update(['file_name' => $file_name]);
                }
                return json_encode(DB::table("documents")->where("id", $i)->first());
            }
            else{
                return "No";
            }
        }

    }
    public function get(Request $r)
    {
        $catid=$r->category_id;
        $cattype = $r->category_type;
        return DB::table("documents")->where("active", 1)->where("category_id", $catid)->where("type", $cattype)->get();
    }
    public function delete($id)
    {
        $i = DB::table("documents")->where("id", $id)->update(["active"=>0]);
        return $i;
    }
}
