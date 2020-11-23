<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\BrandModel;

class BrandController extends Controller
{
	public function brandIndex()
    {
    	return view('Pages.AddNewBrand');
    }
    public function addBrand(Request $req)
    {
    	$name = $req->input('name');
        $slug = $req->input('slug');
        $strReplaceSlug =Str::slug($slug, '-');
        $result = BrandModel::insert([
        	'brand_name'=>$name,
        	'brand_slug'=>$strReplaceSlug,
        ]);
        if ($result == true) {
            return 1;
        } else {
            return 0;
        }
    }
    public function allBrandIndex()
    {
        return view('Pages.AllBrandTable');
    }
    public function getAllBrand()
    {
    	 $result = json_decode(BrandModel::orderBy('id','desc')->get());
        return $result;
    }
    public function brandActiveInactive(Request $request)
    {
    	$id = $request->input('id');
    	$row = BrandModel::where('id', '=', $id)->first();
    	$statusdata = $row->status;
    	if ($statusdata == 1) {
    		BrandModel::where('id', '=', $id)->update(['status'=>'0']);
    		return 1;
    	}else if ($statusdata == 0) {
    		BrandModel::where('id', '=', $id)->update(['status'=>'1']);
    		return 1;
    	}else{
    		return 0;
    	}
    }
}
