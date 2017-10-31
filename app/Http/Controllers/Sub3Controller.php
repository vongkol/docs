<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
class Sub3Controller extends Controller
{
    // index
    public function index($id)
    {
        if (Auth::user()==null)
        {
            return redirect('/login');
        }
        $data['sub2'] = DB::table('sub2')
            ->where('id', $id)
            ->first();
        $data['sub1'] = DB::table("sub1")
            ->where('id', $data['sub2']->parent_id)
            ->first();

        $data['parent'] = DB::table("document_category")
            ->where("id", $data['sub1']->parent_id)->first();
        $data['subs'] = DB::table("sub3")
            ->where('active', 1)
            ->where('parent_id', $id)
            ->orderBy("name")
            ->get();
        return view("categories.sub3", $data);
    }
    public function save(Request $r)
    {
        if (Auth::user()==null)
        {
            return 0;
        }
        $data = array(
            "name" => $r->name,
            "parent_id" => $r->parent_id
        );
        $i = DB::table("sub3")
            ->insertGetId($data);
        return $i;
    }
    public function delete($id)
    {
        if (Auth::user()==null)
        {
            return 0;
        }
        $i = DB::table("sub3")
            ->where("id", $id)
            ->delete();
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
        $i=DB::table("sub3")
            ->where("id", $r->id)
            ->update($data);
        return $i;
    }
}
