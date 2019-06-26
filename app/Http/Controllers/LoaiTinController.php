<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoaiTin;
use App\Models\TheLoai;

class LoaiTinController extends Controller
{
    //
    public function getDanhSach()
    {
        $loaitin=LoaiTin::all();
        return view('admin.loaitin.danhsach',['loaitin'=>$loaitin]);
    }

    //Sửa
    public function getSua($id)
    {
        $loaitin=LoaiTin::find($id);
        $theloai=TheLoai::all();
        return view('admin.loaitin.sua',['loaitin'=>$loaitin,'theloai'=>$theloai]);
    }
    public function postSua(Request $request,$id)
    {
        // echo $request->Ten;
        $loaitin=LoaiTin::find($id);
        $this->validate($request,
        [
            //unique:loaitin,Ten -> Kiểm tra trùng tên trong Models thể lọai
            'Ten'=>'required|unique:loaitin,Ten|min:3|max:200'
        ],
        [
            'Ten.required'=>'Tên thể loại không được rỗng',
            'Ten.unique'=>'Tên thể loại đã tồn tại trong danh sách',
            'Ten.min'=>'Tên loại tin ít nhất 3 ký tự và không vượt quá 200 ký tự',
            'Ten.max'=>'Tên loại tin ít nhất 3 ký tự và không vượt quá 200 ký tự',
        ]);
        $loaitin->Ten=$request->Ten;
        $loaitin->idTheLoai=$request->idTheLoai;
        $loaitin->TenKhongDau =changeTitle($request->Ten); 
        $loaitin->save();
        return redirect('admin/loaitin/sua/'.$id)->with('thongbao','Sửa thành công!');

    }


    //Thêm
    public function getThem()
    {
        $theloai=TheLoai::all();
        return view('admin.loaitin.them',['theloai'=>$theloai]);
    }
    public function postThem(Request $request){
        // echo $request->Ten;
        $this->validate($request,[
            'Ten'=>'required|unique:loaitin,Ten|min:3|max:200',
        ],
        [
            'Ten.required'=>'Tên loại tin không được rỗng',
            'Ten.unique'=>'Tên loại tin đã tồn tại',
            'Ten.min'=>'Tên loại tin ít nhất 3 ký tự và không vượt quá 200 ký tự',
            'Ten.max'=>'Tên loại tin ít nhất 3 ký tự và không vượt quá 200 ký tự',
        ]);
        $loaitin=new LoaiTin;
        $loaitin->Ten=$request->Ten;
        $loaitin->TenKhongDau=changeTitle($loaitin->Ten);
        $loaitin->idTheLoai=$request->idTheLoai;
        $loaitin->save();
        return redirect('admin/loaitin/them')->with('thongbao','Thêm thành công');
    }

    //Xóa
    public function getXoa($id)
    {
        $loaitin=LoaiTin::find($id);
        $loaitin->delete();
        return redirect('admin/loaitin/danhsach')->with('thongbao','Xóa thành công');
    }
}
