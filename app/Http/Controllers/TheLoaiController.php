<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TheLoai;

class TheLoaiController extends Controller
{
    //
    public function getDanhSach()
    {
        $theloai=TheLoai::all();
        return view('admin.theloai.danhsach',['theloai'=>$theloai]);
    }

    //Sửa
    public function getSua($id)
    {
        $theloai=TheLoai::find($id);

        return view('admin.theloai.sua',['theloai'=>$theloai]);
    }
    public function postSua(Request $request,$id)
    {
        $theloai=TheLoai::find($id);
        $this->validate($request,
        [
            //unique:TheLoai,Ten  Kiểm tra trùng tên trong Models thể lọai
            'Ten'=>'required|unique:TheLoai,Ten|min:3|max:100'
        ],
        [
            'Ten.required'=>'Tên thể loại không được rỗng',
            'Ten.unique'=>'Tên thể loại đã tồn tại trong danh sách',
            'Ten.min'=>'Tên thể loại phải có ít nhất 3 ký tự',
            'Ten.max'=>'Tên thể loại không quá 100 ký tự',
        ]);
        $theloai->Ten=$request->Ten;
        $theloai->TenKhongDau =changeTitle($request->Ten); 
        $theloai->save();
        return redirect('admin/theloai/sua/'.$id)->with('thongbao','Sửa thành công!');

    }


    //Thêm
    public function getThem()
    {
        return view('admin.theloai.them');
    }
    public function postThem(Request $request)
    {
        // echo $request->Ten;
        $this->validate($request,
        [
            'Ten'=>'required|unique:TheLoai,Ten|min:3|max:100'
        ],
        [
            'Ten.required'=>'Bạn chưa nhập tên thể loại',
            'Ten.unique'=>'Tên thể loại đã tồn tại trong danh sách',
            'Ten.min'=>'Tên thể loại phải có ít nhất 3 ký tự',
            'Ten.max'=>'Tên thể loại không quá 100 ký tự',
        ]
        );
        $theloai=new TheLoai;
        $theloai->Ten=$request->Ten;
        $theloai->TenKhongDau =changeTitle($request->Ten); 
        // echo changeTitle($request->Ten);
        $theloai->save();
        return redirect('admin/theloai/them')->with('thongbao','Thêm thành công');
    }

    //Xóa
    public function getXoa($id)
    {
        $theloai=TheLoai::find($id);
        $theloai->delete();
        return redirect('admin/theloai/danhsach')->with('thongbao','Xóa thành công');
    }

}
