<?php

namespace App\Http\Controllers;

use App\Http\Controllers;
use App\Http\Middleware\CheckLoginAdmin;
use App\Models\CategoryModel;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

class Category extends Controller
{
    public function all_category() {
        // if(Auth::guest()) {
        //     return redirect('/admin/login');
        // }
        $all_category = CategoryModel::all();
        return view('admin.category.all_category', ['hasCategory' => CategoryModel::exists()])->with('all_category', $all_category);
    }

    public function add_category() {
        return view('admin.category.add_category');
    }

    public function save_category(Request $request) {
        $validator = Validator::make($request->all(), [
            "category_product_name" => "required",
            "category_product_img" => "required|image",
        ], [
            "category_product_name.required" => "(* Vui lòng nhập tên danh mục)",
            "category_product_img.required" => "(* Vui lòng thêm hình ảnh danh mục)",
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator->getMessageBag())->withInput()->with('error_message', 'Có lỗi khi thêm danh mục sản phẩm, vui lòng thêm lại');/*->status(400)*/;
        }

        $new_img= '';
        if($get_img = $request->category_product_img){
            $get_name_img = md5(rand(100, 10000));
            $new_img = $get_name_img . '.' . $get_img->getClientOriginalExtension();
            $get_img->move('upload/products', $new_img);
        }
        CategoryModel::create([
            'name' => $request->category_product_name,
            'image' => $new_img,
        ]);
        return redirect('/admin/category/all')->with('message', 'Thêm danh mục sản phẩm thành công');
    }


    public function edit_category($category_id) {
        $result = CategoryModel::where('id', $category_id)->get();
        // return dd($result);
        return view('admin.category.edit_category')->with('result', $result);
    }


    public function update_category(Request $request, $category_id) {
        $validator = Validator::make($request->all(), [
            "category_product_name" => "required",
            "category_product_img_edit" => "required",
        ], [
            "category_product_name.required" => "(* Vui lòng nhập tên danh mục)",
            "category_product_img_edit.required" => "(* Vui lòng nhập mô tả danh mục)",
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator->getMessageBag())->withInput()->with('error_message', 'Có lỗi khi cập nhật danh mục sản phẩm, vui lòng cập nhật lại');/*->status(400)*/;
        }
        $result = CategoryModel::where('id', $category_id)->first();
        $new_img= $result->image;

        // print_r($new_img);
        if($get_img = $request->category_product_img_edit){
            $get_name_img = md5(rand(100, 10000));
            $new_img = $get_name_img . '.' . $get_img->getClientOriginalExtension();
            $get_img->move('upload/products', $new_img);
        }

        // dd($new_img);
        CategoryModel::where('id', $category_id)->update([
            'name' => $request->category_product_name,
            'image' => $new_img
        ]);
        // return dd($result);
        return redirect('/admin/category/all')->with('message', 'Cập nhật danh mục thành công');

    }


    public function delete_category($category_id) {
        CategoryModel::where('id', $category_id)->delete();
        // return dd($result);
        return redirect()->back()->with('message', 'Xóa danh mục sản phẩm thành công');
    } 
}
