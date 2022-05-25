@extends('layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
                        <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Categories</h1>
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
        <div class="container-fluid ">
            <p><a href="{{route('admin.categories.create')}}" class="btn btn-primary"><i class = "fa fa-plus"></i> Add New </a>
            {{--<div class="col-6">
                                <!-- Actual search box -->
                                <div class="form-group has-search">
                                        <span class="fa fa-search form-control-feedback"></span>
                                        <input type="text" id="tableSearch" class="form-control" placeholder="Search">
                                </div>
            </div>--}}
            <div class="table-responsive">
                @if($records->count() == 0)
                    <div class="col-12">
                        <p class="alert alert-warning text-dark"> No Data Available</p>
                    </div>
                @else
                    <table class="table table-hover table-responsive-sm">
                                    <thead>
                                        <tr>
                                        <th scope="col"># </th>
                                        <th scope="col">Name EN</th>
                                        <th scope="col">Name AR</th>
                                        <th scope="col">Category Name</th>
                                        <th scope="col">Actions</th>
                                        </tr>
                                    </thead>   
                                    <tbody id="myTable">
                                        <tr>
                                        @foreach($records as $record)
                                        <td>{{$record->id}}</td>
                                        <td>{{$record->name_en}}</td>
                                        <td>{{$record->name_ar}}</td>
                                        <td>{{$record->parentCategory->name_en ?? '-'}}</td>
                                        <td>
                                        <div class="row">
                                            <div class="col-10 col-md-3">
                                                <!-- Delete Button -->
                                                <form method="post" action="{{url('admin/categories/'.$record->id)}}"
                                                    enctype="multipart/form-data">
                                                    {{csrf_field()}}
                                                    @method('delete')
                                                    <input type="hidden" value="{{$record->id}}" name="id">
                                                    <button type="submit" class="btn btn-danger mt-1"><i class="far fa-trash-alt"></i></button>
                                                </form>
                                            </div>
                                            <div class="col-10 col-md-3">
                                                <!-- Edit Button -->
                                                <form method="post"
                                                    action= "{{url('admin/categories/edit')}}"
                                                    enctype="multipart/form-data">
                                                        {{csrf_field()}}
                                                        @method('get')
                                                        <input type="hidden" value="{{$record->id}}" name="id">
                                                        <button type="submit" class="btn btn-secondary mt-1"><i class="far fa-edit"></i></button>
                                                </form>
                                            </div>
                                        </div>
                                        </td>
                                        </tr>
                                    </tbody>
                                    @endforeach
                    </table>
                    {{ $records->links() }}
                @endif
            </div>
        </div>
    </section>
@endsection