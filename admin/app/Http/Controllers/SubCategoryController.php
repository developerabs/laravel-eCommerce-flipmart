<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\CategorysModel;
use App\Models\SubCategoryModel;

class SubCategoryController extends Controller
{
    public function subCategorysIndex()
    {
        $cat_data=CategorysModel::all();
        return view('Pages.SubCategory',[
            'cat_data'=>$cat_data
        ]);
    }
    public function subCategorysAddNew(Request $req)
    {
        $parentCatId = $req->input('parentCatId');
        $subCat = $req->input('subCat');
        $slug =Str::slug($subCat, '-');
        $slug =strtolower($slug);
        $result = SubCategoryModel::insert([
            'cat_id'=>$parentCatId,
            'subcat_name'=>$subCat,
        	'subcat_slug'=>$slug,
        ]);
        if ($result == true) {
            return 1;
        } else {
            return 0;
        }
    }
}
