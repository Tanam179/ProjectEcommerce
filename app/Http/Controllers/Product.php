<?php

namespace App\Http\Controllers;

use App\Models\BrandModel;
use App\Models\CategoryModel;
use App\Models\ProductModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
class Product extends Controller
{
    public function all_product() {
        $all_product = ProductModel::all();
        $all_category = CategoryModel::all();
        return view('admin.product.all_product', ['hasProduct' => ProductModel::exists()])->with('all_product', $all_product)->with('all_category', $all_category);
    }

    public function add_product() {
        $product_category = CategoryModel::all();
        // $product_brand = BrandModel::all();
        // return dd($product_category);
        return view('admin.product.add_product')->with('product_category', $product_category);
    }
    
    public function save_product(Request $request) {
        $validator = Validator::make($request->all(), [
            "product_name" => "required",
            "product_price" => "required",
            "product_desc" => "required",
            "product_img" => "required|image",
            "product_img_relate" => "required",
            "product_size" => "required",
            "product_category" => "required",
        ], [
            "product_name.required" => "(* Vui lòng nhập tên sản phẩm)",
            "product_price.required" => "(* Vui lòng nhập giá sản phẩm)",
            "product_desc.required" => "(* Vui lòng nhập mô tả sản phẩm)",
            "product_img.required" => "(* Vui lòng thêm hình ảnh sản phẩm)",
            "product_img.image" => "(* Xin lỗi, định dạng này không được hỗ trợ)",
            "product_img_relate.required" => "(* Vui lòng thêm hình ảnh sản phẩm liên quan)",
            "product_size.required" => "(* Vui lòng thêm kích thước sản phẩm)",
            "product_category.required" => "(* Vui lòng chọn loại sản phẩm)",
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator->getMessageBag())->withInput()->with('error_message', 'Có lỗi khi thêm sản phẩm, vui lòng thêm lại');/*->status(400)*/;
        }

        $new_img = '';
        if($get_img = $request->product_img){
            $get_name_img = md5(rand(100, 10000));
            $new_img = $get_name_img . '.' . $get_img->getClientOriginalExtension();
            $get_img->move('upload/products', $new_img);
        }
        
        $image_relate = array();
        if($files = $request->file('product_img_relate')){
            foreach($files as $file){
                
                $image_name = $file->getClientOriginalName();
                $get_name = current(explode('.', $image_name));
                $ext = $file->getClientOriginalExtension();
                $image_full_name = $get_name.'.'.$ext;
                $file->move('upload/products', $image_full_name);
                if(!in_array($image_full_name, $image_relate)){
                    $image_relate[] = $image_full_name;
                }
            }
        }

        $product_size = array();
        if($sizes = $request->product_size){
            foreach($sizes as $size){
                $product_size[] = $size;
            }
        }

        $product = new ProductModel;
        $product->name = $request->product_name;
        $product->price = $request->product_price;
        $product->description = $request->product_desc;
        $product->img = $new_img;
        $product->img_relate = implode('|', $image_relate);
        $product->size = implode('|', $product_size);
        $product->sale = $request->product_sale;
        $product->sale_percent = $request->product_sale_percent;
        if($product->sale == 1){
            $product->sale_price = $product->price -  ($product->price * $product->sale_percent / 100);
        }
        else{
            $product->sale_price = $product->price;
        }
        $product->status = $request->product_status;
        $product->cate_id = $request->product_category;
        $product->save();
        // ProductModel::create([
        //     'name' => $request->product_name,
        //     'price' => $request->product_price,
        //     'description' => $request->product_desc,
        //     'img' => $new_img,
        //     'img_relate' => implode('|', $image_relate),
        //     'size' => implode('|', $product_size),
        //     'sale' => $request->product_sale,
        //     'sale_percent' => $request->product_sale_percent,
        //     'status' => $request->product_status,
        //     'cate_id' => $request->product_category,
        // ]);
        // return dd($product_size);    
        return redirect('/admin/product/all')->with('message', 'Thêm sản phẩm thành công');

    }

    public function edit_product($product_id) {
        $category = CategoryModel::all();
        $result = ProductModel::where('id', $product_id)->first();
        // $brand = BrandModel::all();
    
        // $not_in_cate = CategoryModel::whereNotIn('id', $result->cate_id)->get();
        // return dd($not_in_cate);

        $imgs = explode('|', $result->img_relate);
        $sizes = explode("|", $result->size);
        // return dd($sizes);
        return view('admin.product.edit_product')->with('result', $result)->with('imgs', $imgs)->with('category', $category)->with('sizes', $sizes);
    }

    public function update_product(Request $request, $product_id){
        $result = ProductModel::where('id', $product_id)->first();
        $new_img = $result->img;
        if($get_img = $request->product_img){
            $get_name_img = md5(rand(100, 10000));
            $new_img = $get_name_img . '.' . $get_img->getClientOriginalExtension();
            $get_img->move('upload/products', $new_img);
        }

        $abc = explode('|', $result->img_relate);
        // array_values($abc); 
        $images_relate = $abc;
        if($files = $request->file('product_img_relate')){
            foreach($files as $file){
                $image_name = $file->getClientOriginalName();
                $get_name = current(explode('.', $image_name));
                $ext = $file->getClientOriginalExtension();
                $image_full_name = $get_name.'.'.$ext;
                $file->move('upload/products', $image_full_name);
                if(!in_array($image_full_name, $images_relate)){
                    $images_relate[] = $image_full_name;
                }
                // $upload_path = 'upload/products/';
                // $image_url = $upload_path.$image_full_name;
                
                // $file->move($upload_path, $image_full_name);
                // print_r($images_relate);
                // echo '<br/>';
                // print_r($image_url);
                
                
                // return dd($image_url);
                
            }
            
            // return dd($images_relate);   
            
        }

        $sizes = array();
        if($checks = $request->product_size){
            foreach($checks as $check){
                $sizes[] = $check;
            }
        }
        
        ProductModel::where('id', $product_id)->update([
            'name' => $request->product_name,
            'price' => $request->product_price,
            'description' => $request->product_desc,
            'img' => $new_img,
            'img_relate' => implode('|', $images_relate),
            'size' => implode("|", ($sizes)),
            'sale' => $request->product_sale,
            'sale_percent' => $request->product_sale_percent,
            'status' => $request->product_status,
            'cate_id' => $request->product_category,
        ]);
        return redirect('/admin/product/all')->with('message', 'Cập nhật sản phẩm thành công');
    }


    public function delete_img_relate($product_id, $index){
        $prod = ProductModel::where('id', $product_id)->first();
        $imgs_relate = $prod->img_relate;
        $img = explode('|', $imgs_relate);
        if (($key = array_search($index, $img)) !== false) {
            unset($img[$key]);
        }

        // $img_relate_path = public_path("\upload\products\\").$img['$index'];
        // File::delete($img_relate_path);
        ProductModel::where('id', $product_id)->update([
            'img_relate' => implode('|', $img),
        ]);
        // return redirect()->back()->with('message', 'Xóa hình ảnh thành công');
        
        
    }

    public function delete_product($product_id){
        $prod = ProductModel::where('id', $product_id)->first();
        $img_path = public_path("\upload\products\\").$prod->img;
        $imgs_relate = explode("|", $prod->img_relate);
        foreach($imgs_relate as $img_relate){
            $img_relate_path = public_path("\upload\products\\").$img_relate;
            File::delete($img_relate_path);
        }
        File::delete($img_path);
        ProductModel::where('id', $product_id)->delete();
        return redirect()->back()->with('message', 'Xóa sản phẩm thành công');
    }

    public function product_by_cate_ajax($cate_id){
        $result = ProductModel::where('cate_id', $cate_id)->get();
        return response()->json($result);
    }

    public function product_all_ajax(){
        $result = ProductModel::all();
        return response()->json($result);
    }
}
