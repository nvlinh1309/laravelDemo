<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TinTuc;
use App\Models\TheLoai;
use App\Models\LoaiTin;
use App\Models\Comment;


class TinTucController extends Controller
{
    //
    public function getDanhSach(){
        $tintuc=TinTuc::orderBy('id','desc')->get();
        return view('admin.tintuc.danhsach',['tintuc'=>$tintuc]);
    }
    public function getSua($id){
        $tintuc=TinTuc::find($id);
        $theloai=TheLoai::all();
        $loaitin=LoaiTin::all();
        return view('admin.tintuc.sua',['tintuc'=>$tintuc, 'theloai'=>$theloai, 'loaitin'=>$loaitin]);
    }

    //xóa

    public function getXoa($id){
        $tintuc=TinTuc::find($id);
        $tintuc->delete();
        return redirect('admin/tintuc/danhsach')->with('thongbao','Xóa thành công');
    }

    public function postSua(Request $request,$id)
    {
        $tintuc=TinTuc::find($id);
        $this->validate($request,[
            'idLoaiTin'=>'required',
            'TieuDe'=>'required|min:3|unique:TinTuc,TieuDe',
            'TomTat'=>'required',
            'NoiDung'=>'required',
        ],[
            'idLoaiTin.required'=>'Bạn chưa chọn loại tin',
            'TieuDe.required'=>'Bạn chưa nhập tiêu đề',
            'TieuDe.min'=>'Tiêu đề ít nhất 3 ký tự',
            'TieuDe.unique'=>'Tiêu đề đã tồn tại',
            'TomTat.required'=>'Tóm tắt nội dung không được rỗng',
            'NoiDung.required'=>'Nội dung không được rỗng',
        ]);

        // $tintuc= new TinTuc;
        $tintuc->idLoaiTin=$request->idLoaiTin;
        $tintuc->TieuDe=$request->TieuDe;
        $tintuc->TieuDeKhongDau=changeTitle($request->TieuDe);
        $tintuc->TomTat=$request->TomTat;
        $tintuc->NoiDung=$request->NoiDung;
        $tintuc->NoiBat=$request->NoiBat;
        
        if ($request->hasFile('Hinh')) 
        {
            $file=$request->file('Hinh');
            $duoi=$file->getClientOriginalExtension();
            if($duoi!='jpg' && $duoi!='png' && $duoi!='jpeg'){
                return redirect('admin/tintuc/sua/'.$id)->with('loi','Bạn chỉ được chọn file có đuôi .jpg, .png, .jpeg');
            }
            $name=$file->getClientOriginalName(); //Lấy tên hình
            $Hinh=str_random(4)."_".$name; //Tạo random tên hình
            //Vòng lập while bắt trùng random file_exists
            while (file_exists("upload/tintuc/".$Hinh)) {
                $Hinh=str_random(4)."_".$name;
            }
            //xoa file cũ
            unlink("upload/tintuc/".$tintuc->Hinh);
            //upload hình lên server
            $file->move("upload/tintuc",$Hinh);
            //Lưu hình vào database
            $tintuc->Hinh=$Hinh;
        }
        $tintuc->save();
        return redirect('admin/tintuc/sua/'.$id)->with('thongbao','Bạn đã thêm tin tức thành công.');
    }
    
    //Thêm
    public function getThem(){
        $theloai=TheLoai::all();
        $loaitin=LoaiTin::all();
        return view('admin.tintuc.them',['theloai'=>$theloai,'loaitin'=>$loaitin]);

    }
    public function postThem(Request $request){
        //echo $request->TieuDe;
        $this->validate($request,[
            'idLoaiTin'=>'required',
            'TieuDe'=>'required|min:3|unique:TinTuc,TieuDe',
            'TomTat'=>'required',
            'NoiDung'=>'required',
        ],[
            'idLoaiTin.required'=>'Bạn chưa chọn loại tin',
            'TieuDe.required'=>'Bạn chưa nhập tiêu đề',
            'TieuDe.min'=>'Tiêu đề ít nhất 3 ký tự',
            'TieuDe.unique'=>'Tiêu đề đã tồn tại',
            'TomTat.required'=>'Tóm tắt nội dung không được rỗng',
            'NoiDung.required'=>'Nội dung không được rỗng',
        ]);
        $tintuc= new TinTuc;
        $tintuc->idLoaiTin=$request->idLoaiTin;
        $tintuc->TieuDe=$request->TieuDe;
        $tintuc->TieuDeKhongDau=changeTitle($request->TieuDe);
        $tintuc->TomTat=$request->TomTat;
        $tintuc->NoiDung=$request->NoiDung;
        $tintuc->NoiBat=$request->NoiBat;
        $tintuc->SoLuotXem=0;
        
        if ($request->hasFile('Hinh')) 
        {
            $file=$request->file('Hinh');
            $duoi=$file->getClientOriginalExtension();
            if($duoi!='jpg' && $duoi!='png' && $duoi!='jpeg'){
                return redirect('admin/tintuc/them')->with('loi','Bạn chỉ được chọn file có đuôi .jpg, .png, .jpeg');
            }
            $name=$file->getClientOriginalName(); //Lấy tên hình
            $Hinh=str_random(4)."_".$name; //Tạo random tên hình
            //Vòng lập while bắt trùng random file_exists
            while (file_exists("upload/tintuc".$Hinh)) {
                $Hinh=str_random(4)."_".$name;
            }
            //upload hình lên server
            $file->move("upload/tintuc",$Hinh);
            //Lưu hình vào database
            $tintuc->Hinh=$Hinh;
        }else
        {
            $tintuc->Hinh="";
        }
        $tintuc->save();
        return redirect('admin/tintuc/them')->with('thongbao','Bạn đã thêm tin tức thành công.');
     }
}
