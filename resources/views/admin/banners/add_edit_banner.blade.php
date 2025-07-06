@extends('layouts.admin_layout.admin_layout');
@section('content')

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Catalogues</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Banner</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      	@if ($errors->any())
		          <div class="alert alert-danger" style="margin-top: 10px;">
		              <ul>
		                  @foreach ($errors->all() as $error)
		                      <li>{{ $error }}</li>
		                  @endforeach
		              </ul>
		          </div>
		          @endif
		          @if(Session::has('success_message'))
              <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top:10px;">
                {{ Session::get('success_message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              @endif
      	<form name="bannerForm" id="bannerForm" @if(empty($bannerdata['id'])) action="{{ url('admin/add-edit-banner') }}" @else action="{{ url('admin/add-edit-banner/'.$bannerdata['id']) }}" @endif method="post" enctype="multipart/form-data">@csrf
	        <div class="card card-default">
	          <div class="card-header">
	            <h3 class="card-title">{{ $title }}</h3>

	            <div class="card-tools">
	              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
	              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
	            </div>
	          </div>
	          <!-- /.card-header -->
	          <div class="card-body">

	            <div class="row">
	              <div class="col-12 col-sm-6">
	              	<div class="form-group">
	                    <label for="image">Banner Image</label>
	                    <div class="input-group">
	                      <div class="custom-file">
	                        <input type="file" class="custom-file-input" id="image" name="image">
	                        <label class="custom-file-label" for="image">Choose file</label>
	                      </div>
	                      <div class="input-group-append">
	                        <span class="input-group-text" id="">Upload</span>
	                      </div>
	                    </div>
	                    @if(!empty($bannerdata['image']))
	                    	<div>
	                      		<img style="width:80px; margin-top:5px;" src="{{ asset('images/banner_images/'.$bannerdata['image']) }}">
	                      	</div>
	                    @endif

	                </div>
	                <div class="form-group">
	                    <label for="banner_discount">Banner Link</label>
	                    <input type="text" class="form-control" id="link" name="link" placeholder="Enter Banner Link" @if(!empty($bannerdata['link'])) value="{{ $bannerdata['link'] }}" @else value="{{ old('link') }}" @endif>
	                </div>
	                
	              </div>
	              <div class="col-12 col-sm-6">
	              	<div class="form-group">
	                    <label for="banner_discount">Banner Title</label>
	                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter Banner Weight" @if(!empty($bannerdata['title'])) value="{{ $bannerdata['title'] }}" @else value="{{ old('title') }}" @endif>
	                </div>

	                <div class="form-group">
	                    <label for="banner_discount">Banner Alternate Text</label>
	                    <input type="text" class="form-control" id="alt" name="alt" placeholder="Enter Banner Weight" @if(!empty($bannerdata['alt'])) value="{{ $bannerdata['alt'] }}" @else value="{{ old('alt') }}" @endif>
	                </div>
	            	</div>
	            </div>
	          </div>
	          <div class="card-footer">
	            <button type="submit" class="btn btn-primary">Submit</button>
	          </div>
	        </div>
        </form>
      </div>
    </section>
    <!-- /.content -->
  </div>

@endsection