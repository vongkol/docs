<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
class Sub2Controller extends Controller
{
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
        $i = DB::table("sub2")
            ->insertGetId($data);
        return $i;
    }
    public function delete($id)
    {
        if (Auth::user()==null)
        {
            return 0;
        }
        $i = DB::table("sub2")
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
        $i=DB::table("sub2")
            ->where("id", $r->id)
            ->update($data);
        return $i;
    }
}
