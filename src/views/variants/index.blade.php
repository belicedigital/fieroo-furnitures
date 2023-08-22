@extends('layouts.app')
@section('title', trans('entities.variants').' '.$furnishing_description)
@section('title_header', trans('entities.variants').' '.$furnishing_description)
@section('buttons')
<a href="{{url('admin/furnishings')}}" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="{{trans('generals.back')}}"><i class="fas fa-chevron-left"></i></a>
<a href="{{url('admin/furnishings/'.$furnishing_id.'/variants/create')}}" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="{{trans('generals.add')}}"><i class="fas fa-plus"></i></a>
@endsection
@section('content')
<div class="container-fluid">
    @if (Session::has('success'))
    @include('admin.partials.success')
    @endif
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body p-3">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>{{trans('tables.color')}}</th>
                                <th>{{trans('tables.price')}}</th>
                                <th>{{trans('tables.image')}}</th>
                                <th class="no-sort">{{trans('tables.actions')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($list as $l)
                            <tr>
                                <td>{{$l->color}}</td>
                                <td>{{$l->price}}</td>
                                <td><img src="{{asset('img/furnishings/'.$l->file_path)}}" class="table-img"></td>
                                <td>
                                    <div class="btn-group btn-group" role="group">
                                        <a class="btn btn-default" href="{{ url('admin/furnishings/'.$l->variant_id.'/variants/'.$l->id.'/edit') }}"><i class="fa fa-edit"></i></a>
                                        <form action="{{ route('furnishings.destroy-variant', $l->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-default" type="submit"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function() {
        $('table').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": false,
            "autoWidth": false,
            "responsive": false,
            columnDefs: [{
                orderable: false,
                targets: "no-sort"
            }],
            "oLanguage": {
                "sSearch": "{{trans('generals.search')}}",
                "oPaginate": {
                    "sFirst": "{{trans('generals.start')}}", // This is the link to the first page
                    "sPrevious": "«", // This is the link to the previous page
                    "sNext": "»", // This is the link to the next page
                    "sLast": "{{trans('generals.end')}}" // This is the link to the last page
                }
            }
        });
    });
</script>
@endsection