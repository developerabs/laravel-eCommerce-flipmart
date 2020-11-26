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
        $slug =Str::slug($name, '-');
        $slug =strtolower($slug);
        $result = BrandModel::insert([
        	'brand_name'=>$name,
        	'brand_slug'=>$slug,
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
    public function deleteBrand(Request $request)
    {
    	$id = $request->input('id');
    	$result = BrandModel::where('id', '=', $id)->delete();
    	 if ($result == true) {
            return 1;
        } else {
            return 0;
        }
    }
    public function brandUpdateDetails(Request $request)
    {
    	$id = $request->input('id');
    	$result = BrandModel::where('id', '=', $id)->get();
        return $result;
    }
    public function brandUpdateConfirm(Request $req)
    {
        $id = $req->input('id');
        $brandName = $req->input('brandName');
        $slug = $req->input('brandName');
        $slug =Str::slug($slug, '-');
        $slug =strtolower($slug);
        $result = BrandModel::where('id', '=', $id)->update([
        	'brand_name'=>$brandName,
        	'brand_slug'=>$slug
        ]);
        if ($result == true) {
            return 1;
        } else {
            return 0;
        }
    }
}
