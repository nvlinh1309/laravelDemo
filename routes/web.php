<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use\App\Models\TheLoai;
Route::get('/', function () {
    return view('welcome');
});



Route::group(['prefix' => 'admin'], function () {
    //dang nhap
    Route::get('dangnhap','UserController@getDangnhapAdmin')->name('getDangnhapAdmin');
    Route::post('dangnhap','UserController@postDangnhapAdmin')->name('postDangnhapAdmin');



    Route::group(['prefix' => 'loaitin'], function () {
        Route::get('danhsach', 'LoaiTinController@getDanhSach');
        //Sửa 
        Route::get('sua/{id}', 'LoaiTinController@getSua');
        Route::post('sua/{id}','LoaiTinController@postSua');
        //thêm
        Route::get('them', 'LoaiTinController@getThem');
        Route::post('them', 'LoaiTinController@postThem');
        //Xóa
        Route::get('xoa/{id}', 'LoaiTinController@getXoa');

        //
    });  


    Route::group(['prefix' => 'slide'], function () {
        Route::get('danhsach', 'SlideController@getDanhSach')->name('listSlide');
        Route::get('sua/{id}', 'SlideController@getSua')->name('editSlide_get');
        Route::post('sua/{id}', 'SlideController@postSua')->name('editSlide_post');
        Route::get('them', 'SlideController@getThem')->name('addSlide_get');
        Route::post('them', 'SlideController@postThem')->name('addSlide_post');
        Route::get('xoa/{id}', 'SlideController@getXoa')->name('deleteSlide');

    }); 
    
    

    Route::group(['prefix' => 'theloai'], function () {
        Route::get('danhsach', 'TheLoaiController@getDanhSach')->name('getDanhSach');
        //Sửa thể loại
        Route::get('sua/{id}', 'TheLoaiController@getSua');
        Route::post('sua/{id}','TheLoaiController@postSua');
        //thêm thể loại
        Route::get('them', 'TheLoaiController@getThem');
        Route::post('them', 'TheLoaiController@postThem');
        //Xóa thể loại
        Route::get('xoa/{id}', 'TheLoaiController@getXoa');
    });  
    Route::group(['prefix' => 'tintuc'], function () {
        Route::get('danhsach', 'TinTucController@getDanhSach');

        //sửa
        Route::get('sua/{id}', 'TinTucController@getSua');
        Route::post('sua/{id}', 'TinTucController@postSua');

        //Thêm
        Route::get('them', 'TinTucController@getThem');
        Route::post('them', 'TinTucController@postThem');
        Route::get('xoa/{id}', 'TinTucController@getXoa');

    });  

    Route::group(['prefix' => 'comment'], function () {
        Route::get('xoa/{id}/{idTinTuc}', 'CommentController@getXoa');

    });  

    Route::group(['prefix' => 'user'], function () {
        Route::get('danhsach', 'UserController@getDanhSach')->name('listUser');
        Route::get('sua/{id}', 'UserController@getSua')->name('editUser_get');
        Route::post('sua/{id}', 'UserController@postSua')->name('editUser_post');
        Route::get('them', 'UserController@getThem')->name('addUser');
        Route::post('them', 'UserController@postThem')->name('addUser_post');
        Route::get('xoa/{d}', 'UserController@getXoa')->name('deleteUser');
    }); 
    

    Route::group(['prefix' => 'ajax'], function () {
        Route::get('loaitin/{idTheLoai}', 'AjaxController@getLoaiTin');
    });
});
