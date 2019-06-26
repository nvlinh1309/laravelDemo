<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slide;

class SlideController extends Controller
{
    //
    public function getDanhSach(){
        $slide=Slide::all();
        return view('admin.slide.danhsach',['slide'=>$slide]);
    }
    public function getSua($id){
        $slide=Slide::find($id);
        return view('admin.slide.sua',['slide'=>$slide]);
    }

    public function postSua(Request $request, $id){
        $slide=Slide::find($id);
        $this->validate($request,[
            'Ten'=>'required',
            'NoiDung'=>'required',
        ],[
            'Ten.required'=>'Bạn chưa nhập tên slide',
            'NoiDung.required'=>'Bạn chưa nhập nội dung slide',
        ]);
        // $slide= new Slide;
        $slide->Ten=$request->Ten;
        $slide->NoiDung=$request->NoiDung;
        $slide->link=$request->link;
        
        if ($request->hasFile('Hinh')) 
        {
            $file=$request->file('Hinh');
            $duoi=$file->getClientOriginalExtension();//lấy định dạng file
            if($duoi!='jpg' && $duoi!='png' && $duoi!='jpeg'){
                return redirect(route('editSlide_get',['id'=>$id]))->with('loi','Bạn chỉ được chọn file có đuôi .jpg, .png, .jpeg');
            }
            $name=$file->getClientOriginalName(); //Lấy tên hình
            $Hinh=str_random(4)."_".$name; //Tạo random tên hình
            //Vòng lập while bắt trùng random file_exists
            while (file_exists("upload/slide".$Hinh)) {
                $Hinh=str_random(4)."_".$name;
            }
            //upload hình lên server
            $file->move("upload/slide",$Hinh);
            //Lưu hình vào database
            $slide->Hinh=$Hinh;
        }
        $slide->save();
        return redirect(route('editSlide_get',['id'=>$id]))->with('thongbao','Bạn đã cập nhật slide thành công.');
    }

    public function getXoa($id){
        $slide=Slide::find($id);
        $slide->delete();
        return redirect(route('listSlide'))->with('thongbao','Xóa thành công.');
    }

    public function getThem(){
        return view('admin.slide.them');

    }
    public function postThem(Request $request){
        //echo $request->TieuDe;
        $this->validate($request,[
            'Ten'=>'required',
            'NoiDung'=>'required',
        ],[
            'Ten.required'=>'Bạn chưa nhập tên slide',
            'NoiDung.required'=>'Bạn chưa nhập nội dung slide',
        ]);
        $slide= new Slide;
        $slide->Ten=$request->Ten;
        $slide->NoiDung=$request->NoiDung;
        $slide->link=$request->link;
        
        if ($request->hasFile('Hinh')) 
        {
            $file=$request->file('Hinh');
            $duoi=$file->getClientOriginalExtension();//lấy định dạng file
            if($duoi!='jpg' && $duoi!='png' && $duoi!='jpeg'){
                return redirect(route('addSlide_get'))->with('loi','Bạn chỉ được chọn file có đuôi .jpg, .png, .jpeg');
            }
            $name=$file->getClientOriginalName(); //Lấy tên hình
            $Hinh=str_random(4)."_".$name; //Tạo random tên hình
            //Vòng lập while bắt trùng random file_exists
            while (file_exists("upload/slide".$Hinh)) {
                $Hinh=str_random(4)."_".$name;
            }
            //upload hình lên server
            $file->move("upload/slide",$Hinh);
            //Lưu hình vào database
            $slide->Hinh=$Hinh;
        }else
        {
            $slide->Hinh="";
        }
        $slide->save();
        return redirect(route('addSlide_get'))->with('thongbao','Bạn đã thêm slide thành công.');
    }
}
