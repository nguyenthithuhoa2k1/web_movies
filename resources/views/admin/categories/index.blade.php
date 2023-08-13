@extends('admin.layout.Master')
@section('content')
<x-success/>
<table class="table table-hover">
    <h1>Category</h1>
    <thead>
        <th>ID</th>
        <th>Category</th>
        <th>Active</th>
    </thead>
    <tbody>
    <?php
        $dataCategory = \App\Helpers\MyHelper::getAllCategories();
    ?>
        @foreach($dataCategory as $category)
        <tr>
            <td>{{$category->id}}</td>
            <td>
                {{$category->category}}
                <a href="{{url('admin/category/detail/'.$category->id)}}">detail</a>
            </td>
            <td class="btn-group">
                <form method="get" action="{{url('admin/categories/'.$category->id.'/edit')}}">
                    @csrf
                    <button class="btn btn-warning me-2" type="submit">edit</button>
                </form>
                <form method="post" action="{{url('admin/categories/'.$category->id)}}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit"> Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
    <tr colspan = 2 class="add-country">
        <td><a class="btn btn-success" href="{{url('admin/categories/create')}}">Add Category</a></td>
    </tr>
</table>

{{ $dataCategory->links("pagination::bootstrap-4") }}
@endsection
