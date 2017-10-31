<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
class CategoryController extends Controller
{
    //index
    public function index()
    {
        if (Auth::user()==null)
        {
            return redirect('/login');
        }
        $data['cats'] = DB::table('document_category')
            ->orderBy('name')
            ->paginate(18);
        return view("categories.index", $data);
    }
    public function save(Request $r)
    {
        if (Auth::user()==null)
        {
            return 0;
        }
        $data = array(
            "name" => $r->name
        );
        $i = DB::table("document_category")
            ->insertGetId($data);
        return $i;
    }
    public function update(Request $r)
    {
        if (Auth::user()==null)
        {
            return 0;
        }
        $data = array(
            "name" => $r->name
        );
        $i=DB::table("document_category")
            ->where("id", $r->id)
            ->update($data);
        return $i;
    }
    public function delete($id)
    {
        if (Auth::user()==null)
        {
            return 0;
        }
        $i = DB::table("document_category")
            ->where("id", $id)
            ->delete();
        return $i;
    }
    public function sub1($id)
    {
        if (Auth::user()==null)
        {
            return redirect('/login');
        }
        $data['parent'] = DB::table("document_category")
            ->where("id", $id)->first();
        $data['subs'] = DB::table("sub1")
            ->where('active', 1)
            ->where('parent_id', $id)
            ->orderBy("name")
            ->get();
        return view("categories.sub1", $data);
    }
    public function sub2($id)
    {
        if (Auth::user()==null)
        {
            return redirect('/login');
        }
        $data['sub1'] = DB::table("sub1")
            ->where('id', $id)
            ->first();

        $data['parent'] = DB::table("document_category")
            ->where("id", $data['sub1']->parent_id)->first();
        $data['subs'] = DB::table("sub2")
            ->where('active', 1)
            ->where('parent_id', $id)
            ->orderBy("name")
            ->get();
        return view("categories.sub2", $data);
    }
    public function savesub1(Request $r)
    {
        if (Auth::user()==null)
        {
            return 0;
        }
        $data = array(
            "name" => $r->name,
            "parent_id" => $r->parent_id
        );
        $i = DB::table("sub1")
            ->insertGetId($data);
        return $i;
    }
    public function deletesub1($id)
    {
        if (Auth::user()==null)
        {
            return 0;
        }
        $i = DB::table("sub1")
            ->where("id", $id)
            ->delete();
        return $i;
    }
    public function updatesub1(Request $r)
    {
        if (Auth::user()==null)
        {
            return 0;
        }
        $data = array(
            "name" => $r->name
        );
        $i=DB::table("sub1")
            ->where("id", $r->id)
            ->update($data);
        return $i;
    }
}
