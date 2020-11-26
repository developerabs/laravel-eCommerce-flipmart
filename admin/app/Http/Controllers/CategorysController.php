<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\CategorysModel;

class CategorysController extends Controller
{
    public function categorysIndex()
    {
    	 return view('Pages.Categorys');
    }
    public function categorysAddNew(Request $req)
    {
    	$name = $req->input('catName');
        $slug = $req->input('catSlug');
        $slug =Str::slug($slug, '-');
        $slug =strtolower($slug);
        $result = CategorysModel::insert([
        	'category_name'=>$name,
        	'category_slug'=>$slug,
        ]);
        if ($result == true) {
            return 1;
        } else {
            return 0;
        }
    }
}
