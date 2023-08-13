@extends('admin.layout.Master')
@section('content')
<x-success/>
<table class="table table-hover">
    <thead>
        <th>ID</th>
        <th>Country</th>
        <th>Active</th>
    </thead>
    <tbody>
    <?php
        $dataCountry = \App\Helpers\MyHelper::getAllCountries();
    ?>
        @foreach($dataCountry as $country)
        <tr>
            <td>{{$country->id}}</td>
            <td>{{$country->country}}</td>
            <td class="btn-group">
                <form method="get" action="{{url('admin/countries/'.$country->id.'/edit')}}">
                    @csrf
                    <button class="btn btn-warning me-2" type="submit">edit</button>
                </form>
                <form method="post" action="{{url('admin/countries/'.$country->id)}}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit"> Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
    <tr colspan = 2 class="add-country">
        <td><a class="btn btn-success" href="{{url('admin/countries/create')}}">Add Country</a></td>
    </tr>
</table>

{{ $dataCountry->links("pagination::bootstrap-4") }}
@endsection
