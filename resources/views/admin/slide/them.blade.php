@extends('admin.layout.index')
@section('content')
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Slide
                            <small>Thêm</small>
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
                        <form action="{{ route('addSlide_post') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Tên Slide</label>
                                <input class="form-control" name="Ten" value="{{ old('Ten') }}" placeholder="Nhập tên slide..." />
                            </div>
                            <div class="form-group">
                                <label>Nội dung</label>
                                <textarea id="demo" name="NoiDung" class="form-control ckeditor">{{ old('NoiDung') }}</textarea>
                            </div>
                            <div class="form-group">
                                    <label>Link</label>
                                    <input class="form-control" name="link" value="{{ old('link') }}" placeholder="Nhập link..." />
                            </div>
                            <div class="form-group">
                                    <label>Hình ảnh</label>
                                    <input class="form-control" type="file" name="Hinh"/>
                            </div>
    
                            <button type="submit" class="btn btn-default">Thêm</button>
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