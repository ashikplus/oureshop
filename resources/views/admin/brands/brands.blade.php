@extends('layouts.admin_layout.admin_layout');
@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Catelogues</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Brands</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <!-- /.card -->
          @if(Session::has('success_message'))
              <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top:10px;">
                {{ Session::get('success_message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              @endif

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Brands</h3>
              <a href="{{ url('admin/add-edit-brand') }}" class="btn btn-success" style="float:right;">+Add Brand</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="brands" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($brands as $brand)
                <tr>
                  <td>{{ $brand->id }}</td>
                  <td>{{ $brand->name }}</td>
                  <td>
                    <a title="Edit Brand" href="{{ url('admin/add-edit-brand/'.$brand->id) }}"><i class="fa fa-edit" aria-hidden="true"></i></a>
                    &nbsp;&nbsp;
                    <a title="Delete Brand" href="javascript:void(0)" class="confirmDelete" record="brand" recordid="{{ $brand->id }}" <?php /* href="{{ url('admin/delete-category/'.$category->id) }}" */ ?>><i class="fa fa-trash" aria-hidden="true"></i></a>
                    &nbsp;&nbsp;
                  	@if($brand->status==1)
                  	<a class="updateBrandStatus" id="brand-{{ $brand->id }}" brand_id="{{ $brand->id }}" href="javascript:void(0)" ><i class="fas fa-toggle-on" status="Active"></i></a>
                  	@else
                  	<a class="updateBrandStatus" id="brand-{{ $brand->id }}" brand_id="{{ $brand->id }}" href="javascript:void(0)" ><i class="fas fa-toggle-off" status="Inactive"></i></a>
                  	@endif
                  </td>
                </tr> 
                @endforeach               
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
@endsection