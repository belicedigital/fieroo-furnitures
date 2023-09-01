@extends('layouts.app')
@section('title', trans('crud.edit', ['item' => trans('entities.variant')]).' '.$description)
@section('title_header', trans('crud.edit', ['item' => trans('entities.variant')]).' '.$description)
@section('buttons')
<a href="{{url('admin/furnishings/'.$parent_id.'/variants')}}" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="{{trans('generals.back')}}"><i class="fas fa-chevron-left"></i></a>
@endsection
@section('content')
<div class="container">
    @if ($errors->any())
    @include('admin.partials.errors', ['errors' => $errors])
    @endif
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <img src="{{asset('img/furnishings/'.$variant_data->file_path)}}" class="w-25">
                    {{-- <img src="{{asset('upload/furnishings/'.$variant_data->file_path)}}" class="w-25"> --}}
                </div>
                <div class="card-body">
                    <form action="{{route('furnishings.update-variant', $variant_data->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="furnishing_id" value="{{ $variant_data->id }}">
                        <input type="hidden" name="parent_id" value="{{ $parent_id }}">
                        <input type="hidden" name="size" value="{{ $variant_data->size }}">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <div class="icheck-primary d-inline">
                                        <input type="checkbox" name="extra_price" id="extra_price" {{$variant_data->extra_price ? 'checked' : ''}}>
                                        <label for="extra_price">{{trans('tables.extra_price')}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>{{trans('tables.price')}}</strong>
                                    <input type="text" name="price" class="form-control" value="{{ $variant_data->price }}" required>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>{{trans('tables.color')}}</strong>
                                    <input type="text" name="color" class="form-control" value="{{ $variant_data->color }}" required>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>{{trans('tables.image')}} {{trans('forms.left_empty_not_change')}}</strong>
                                    <input type="file" name="file" class="form-control" value="{{ old('file') }}" accept="image/png, image/gif, image/jpeg, image/bmp">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                <button type="submit" class="btn btn-primary">{{trans('generals.save')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
</script>
@endsection