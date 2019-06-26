<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
//use App\Models\User;
use App\User;
class UserController extends Controller
{
    //Đang nhập admin
    public function getDangnhapAdmin(){
        return view('admin.login');
    }

    public function postDangnhapAdmin(Request $request){
        $this->validate($request,
        [
            'email'=>'required',
            'password'=>'required|min:3|max:32'
        ],
        [
            'email.required'=>'Bạn chưa nhập email',
            'password.required'=>'Bạn chưa nhập mật khẩu',
            'password.min'=>'Mật khẩu ít nhật 3 ký tự, tối đa 32 ký tự',
            'password.max'=>'Mật khẩu ít nhật 3 ký tự, tối đa 32 ký tự',
        ]);

            if(Auth::attempt(['email' =>$request->email, 'password' =>$request->password]))
            {
                
                return redirect(route('getDanhSach'));
            }else
            {
                return redirect(route('getDangnhapAdmin'))->with('thongbao','Đăng nhập không thành công.');
            }
       
    }


    // -------
    public function getDanhSach(){
        $user=User::all();
        return view('admin.user.danhsach',['user'=>$user]);
    }
    public function getSua($id){
        $user=User::find($id);
        return view('admin.user.sua',['user'=>$user]);
    }

    public function postSua(Request $request,$id){
        $this->validate($request,
        [
            'name'=>'required|min:3',
            // 'password'=>'required|min:3|max:32',
            // 'passwordAgain'=>'required|same:password'
        ],
        [
            'name.required'=>'Bạn chưa nhập họ tên',
            'name.min'=>'Họ tên ít nhất 3 ký tự',
            // 'email.required'=>'Bạn chưa nhập họ tên',
            // 'email.email'=>'Email không đúng định dạng',
            // 'email.unique'=>'Email đã tồn tại',
            // 'password.required'=>'Bạn chưa nhập mật khẩu',
            // 'password.min'=>'Mật khẩu ít nhật 3 ký tự, tối đa 32 ký tự',
            // 'password.max'=>'Mật khẩu ít nhật 3 ký tự, tối đa 32 ký tự',
            // 'passwordAgain.required'=>'Bạn chưa nhập nhập lại mật khẩu',
            // 'passwordAgain.same'=>'Mật khẩu nhập lại chưa khớp'
        ]);
        $user=User::find($id);
        $user->name=$request->name;
        $user->quyen=$request->quyen;

            if ($request->chaangePass=='on') {
                $this->validate($request,
                [
                    'password'=>'required|min:3|max:32',
                    'passwordAgain'=>'required|same:password'
                ],
                [
                    'password.required'=>'Bạn chưa nhập mật khẩu',
                    'password.min'=>'Mật khẩu ít nhật 3 ký tự, tối đa 32 ký tự',
                    'password.max'=>'Mật khẩu ít nhật 3 ký tự, tối đa 32 ký tự',
                    'passwordAgain.required'=>'Bạn chưa nhập nhập lại mật khẩu',
                    'passwordAgain.same'=>'Mật khẩu nhập lại chưa khớp'
                ]);
                $user->password=bcrypt($request->password);
            }
        
        $user->save();
        return redirect(route('editUser_get',['id'=>$id]))->with('thongbao','Cập nhật user thành công.');
    }

    public function getXoa($id){
        $user=User::find($id);
        $user->delete();
        return redirect(route('listUser'))->with('thongbao','Xóa thành công.');
    }


    public function getThem(){
        return view('admin.user.them');
    }

    public function postThem(Request $request){
        $this->validate($request,
        [
            'name'=>'required|min:3',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:3|max:32',
            'passwordAgain'=>'required|same:password'
        ],
        [
            'name.required'=>'Bạn chưa nhập họ tên',
            'name.min'=>'Họ tên ít nhất 3 ký tự',
            'email.required'=>'Bạn chưa nhập họ tên',
            'email.email'=>'Email không đúng định dạng',
            'email.unique'=>'Email đã tồn tại',
            'password.required'=>'Bạn chưa nhập mật khẩu',
            'password.min'=>'Mật khẩu ít nhật 3 ký tự, tối đa 32 ký tự',
            'password.max'=>'Mật khẩu ít nhật 3 ký tự, tối đa 32 ký tự',
            'passwordAgain.required'=>'Bạn chưa nhập nhập lại mật khẩu',
            'passwordAgain.same'=>'Mật khẩu nhập lại chưa khớp'
        ]);
        $user=new User;
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=bcrypt($request->password);
        $user->quyen=$request->quyen;
        $user->save();
        return redirect(route('addUser'))->with('thongbao','Thêm user thành công.');
    }
}
