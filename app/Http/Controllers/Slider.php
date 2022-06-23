<?php

namespace App\Http\Controllers;
use App\Models\SliderModel;
use Illuminate\Http\Request;

class Slider extends Controller
{
    public function all_slider(){
        $all_slider = SliderModel::all();
        return view('admin.slider.all_slider')->with('all_slider', $all_slider);
    }

    public function add_slider(){
        // $all_category = CategoryModel::all();
        
        return view('admin.slider.add_slider');
    }

    public function save_slider(Request $request){
        if($get_img = $request->slider_img){
            $get_name_img = md5(rand(100, 10000));
            $new_img = $get_name_img . '.' . $get_img->getClientOriginalExtension();
            $get_img->move('upload/sliders', $new_img);

            SliderModel::create([
                'img' => $new_img,
            ]);
        }
        return redirect('/admin/slider/all')->with('message', 'Thêm ảnh slider thành công');
    }

    public function edit_slider($slider_id){
        $result = SliderModel::where('id', $slider_id)->get();
        return view('admin.slider.edit_slider')->with('result', $result);
    }

    public function update_slider(Request $request, $slider_id){
        $slider = SliderModel::where('id', $slider_id)->first();
        $new_img = $slider->img;
        if($get_img = $request->slider_img_edit){
            $get_name_img = md5(rand(100, 10000));
            $new_img = $get_name_img . '.' . $get_img->getClientOriginalExtension();
            $get_img->move('upload/sliders', $new_img);
        }
        SliderModel::where('id', $slider_id)->update([
            'img' => $new_img,
        ]);
        return redirect('/admin/slider/all')->with('message', 'Cập nhật hình ảnh Slider thành công');
    }

    public function delete_slider($slider_id){
        SliderModel::where('id', $slider_id)->delete();
        // return dd($result);
        return redirect()->back()->with('message', 'Xóa ảnh slider thành công');
    }
}
