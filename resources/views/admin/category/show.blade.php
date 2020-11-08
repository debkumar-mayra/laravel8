@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Category Management</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{action('LoginController@getAdminDashboard')}}"><i class="fas fa-home"></i> Home</a></li>
                        <li class="breadcrumb-item active"><i class="fa fa-laptop"></i></i> Category Management</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-5">
                                    <h4 class="card-title mb-0">
                                        Sub-Category List
                                    </h4>
                                </div><!--col-->

                                <div class="col-sm-7">
                                    <div class="btn-toolbar float-right" role="toolbar" aria-label="@lang('labels.general.toolbar_btn_groups')">
                                        <a href="{{ action('BusinessCategoriesController@create').'/'.request()->segment(3) }}" class="btn btn-success ml-1" data-toggle="tooltip" title="@lang('labels.general.create_new')"><span>Add New</span> <i class="fas fa-plus-circle"></i></a>
                                    </div>
                                </div><!--col-->
                            </div><!--row-->


<div class="row mt-4">
<div class="col">
    <div class="table-responsive">
        <table class="table table-bordered table-striped data-table dt-select cms_table_width" id="business_categories">
            <thead>
            <tr>
                <!-- <th style="text-align:center;"><input type="checkbox" id="select-all"/></th> -->
                <th>Id</th>
                <th>Name</th>
                <th>Description</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
                @foreach($subCategory as $category)
                <tr>
                    <td>{{$category->id}}</td>
                    <td>{{$category->name}}</td>
                    <td>{{$category->description}}</td>
                    <td>{!!$category->active!!}</td>
                    <td>
<a href="{{action('BusinessCategoriesController@show', $category->id)}}" data-toggle="tooltip"
data-placement="top" title="View" class="btn btn-info">
<i class="fas fa-eye"></i></a>

<a href="{{action('BusinessCategoriesController@edit', $category->id)}}" data-toggle="tooltip" data-placement="top" title="Edit" class="btn btn-primary">
<i class="fas fa-edit"></i>
</a>

<form method="POST" action="{{action('BusinessCategoriesController@destroy', [$category->id])}}" accept-charset="UTF-8" style="display: inline-block;" onsubmit="return confirm(\'Are you sure want to delete this row?\');">
    {{method_field('DELETE')}}
     @csrf
<button class="btn btn-danger" type="submit" title="Delete" data-toggle="tooltip" data-placement="top"><i class="fas fa-trash"></i></button>
</form>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</div>
                            <div class="row">

                            </div><!--row-->
                        </div><!--card-body-->
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>

@endsection



