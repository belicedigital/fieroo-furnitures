@extends('layouts.app')
@section('title', trans('crud.new', ['obj' => trans('entities.variant')]).' '.$furnishing->description)
@section('title_header', trans('crud.new', ['obj' => trans('entities.variant')]).' '.$furnishing->description)
@section('buttons')
<a href="{{url('admin/furnishings/'.$furnishing->id.'/variants')}}" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="{{trans('generals.back')}}"><i class="fas fa-chevron-left"></i></a>
@endsection
@section('content')
<div class="container">
    @if ($errors->any())
    @include('admin.partials.errors', ['errors' => $errors])
    @endif
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('furnishings.store-variant', $furnishing->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="furnishing_id" value="{{ $furnishing->id }}">
                        <input type="hidden" name="size" value="{{ $furnishing->size }}">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <div class="icheck-primary d-inline">
                                        <input type="checkbox" name="extra_price" id="extra_price">
                                        <label for="extra_price">{{trans('tables.extra_price')}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>{{trans('tables.price')}}</strong>
                                    <input type="text" name="price" class="form-control" value="{{ old('price') }}" required>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>{{trans('tables.color')}}</strong>
                                    <input type="text" name="color" class="form-control" value="{{ old('color') }}" required>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>{{trans('tables.image')}}</strong>
                                    <input type="file" name="file" class="form-control" value="{{ old('file') }}" accept="image/png, image/gif, image/jpeg, image/bmp" required>
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