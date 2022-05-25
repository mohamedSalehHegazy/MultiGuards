@extends('layouts.app')
@section('content')
@php
$flag = 0;
if(isset($record))
$flag=1;
@endphp
{{--@include('layouts.success')
@include('layouts.error')--}}
<!-- Content Header (Page header) -->
<div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Categories</li>
            </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form method="post" class="w-75 mx-auto mt-5 pb-3"
                action="{{$flag ? url('admin/categories/'.$record->id) : route('admin.categories.store')}}"
                enctype="multipart/form-data">
                {{csrf_field()}}
                @if($flag)
                @method('PUT')
                @endif
                <div class="form-group">
                    <label for="name_en"> Name EN</label>
                    <input type="text" class="form-control" id="name_en"  placeholder="Enter EN Name" name = "name_en" value="{{$flag ? $record->name_en : old('name_en')}}" required>
                </div>
                <div class="form-group">
                    <label for="name_ar"> Name AR</label>
                    <input type="text" class="form-control" id="name_ar"  placeholder="Enter AR Name" name = "name_ar" value="{{$flag ? $record->name_ar : old('name_ar')}}" required>
                </div>

                <div class="form-group">
                <label for="exampleFormControlSelect1"> Sub Category </label>
                <select class="form-control" name="parent_id">
                    <option value="{{$flag ? $record->parent_id : ''}}">{{$flag ? $record->parentCategory->name_en ?? '' : ''}} </option>
                    @foreach($categories as $category)
                    @if($flag)
                    @if($record->parent_id == $category->id)
                    @else
                    <option value="{{ $category->id }}">{{ $category["name_".app()->getLocale()]  }}</option>
                    @endif
                    @else
                    <option value="{{ $category->id }}">{{ $category["name_".app()->getLocale()]  }}</option>
                    @endif
                    @endforeach
                </select>
                </div>

                @if ($flag)
                    <input type="hidden" value="{{$record->id}}" name="id">
                @endif
                <div class="form-group row mt-md-5">
                    <div class="col-12 col-lg-10 ml-0 ml-lg-5">
                        <button type="submit" class="btn btn-primary btn-block">{{$flag ? 'Update' : 'Add'}}</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection