@extends('admin.layout.index')
@section('content')
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Slide
                            <small>{{ $slide->Ten }}</small>
                        </h1>
                    </div>

                    @if (count($errors)>0)
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $err)
                            {{ $err }}<br>
                        @endforeach
                    </div>                            
                    @endif
                    @if (session('thongbao'))
                                <div class="alert alert-success">
                                    {{ session('thongbao') }}
                                </div>
                    @endif
                    @if (session('loi'))
                                <div class="alert alert-danger">
                                    {{ session('loi') }}
                                </div>
                    @endif            
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        <form action="{{ route('editSlide_post',['id'=>$slide->id]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Tên Slide</label>
                                <input class="form-control" name="Ten" value="{{ $slide->Ten }}" placeholder="Nhập tên slide..." />
                            </div>
                            <div class="form-group">
                                <label>Nội dung</label>
                                <textarea id="demo" name="NoiDung" class="form-control ckeditor">{{ $slide->NoiDung }}</textarea>
                            </div>
                            <div class="form-group">
                                    <label>Link</label>
                                    <input class="form-control" name="link" value="{{ $slide->link }}" placeholder="Nhập link..." />
                            </div>
                            <div class="form-group">
                                    <label>Hình ảnh</label>
                                    <p><img src="upload/slide/{{ $slide->Hinh }}" width="400px"></p>
                                    <input class="form-control" type="file" name="Hinh"/>
                            </div>
    
                            <button type="submit" class="btn btn-default">Lưu lại</button>
                            <button type="reset" class="btn btn-default">Làm mới</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
@endsection