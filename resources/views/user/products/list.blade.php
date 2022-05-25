@extends('layouts.user')
@section('content')
                    <div class="row">
                        <div class="form-group">
                            <div class="row">
                                <label for="demo_overview">Filter By Category</label>
                            </div>
                            <div class="row">
                                <form class="form-inline ml-0" method="post" 
                                    action="{{url('user/products')}}"
                                    enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    @method('get')
                                    <div class="col-6">
                                        <select class="form-control" name="category_filter">
                                            <option> </option>
                                            @foreach($categories as $category)
                                                <option  value="{{$category->id }}">{{ $category["name_".app()->getLocale()]  }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="offset-3 col-3">
                                        <button class="btn btn-success" type="submit">
                                        <i class="fas fa-filter"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @if($records->count() == 0)
                        <div class="col-12">
                            <p class="alert alert-warning text-dark"> No Data Available</p>
                        </div>
                    @else
                    <table class="table table-hover table-responsive-sm">
                    <thead>
                        <tr>
                        <th scope="col"># </th>
                        <th scope="col">Name En</th>
                        <th scope="col">Name Ar</th>
                        <th scope="col">Category</th>
                        </tr>
                    </thead>
                    <tbody id="myTable">
                        <tr>
                        @php $name = "name_".app()->getLocale();@endphp
                        @foreach($records as $record)
                        <td>{{$record->id}}</td>
                        <td>{{$record->name_en}}</td>
                        <td>{{$record->name_ar}}</td>
                        <td>{{$record->category->$name}}</td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>
        @endif
@endsection