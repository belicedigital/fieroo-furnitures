{{-- @extends('layouts.app')
@section('title', trans('crud.edit', ['item' => trans('entities.variant')]) . ' ' . $description)
@section('title_header', trans('crud.edit', ['item' => trans('entities.variant')]) . ' ' . $description)
@section('buttons')
    <a href="{{ url('admin/furnishings/' . $parent_id . '/variants') }}" class="btn btn-primary" data-toggle="tooltip"
        data-placement="bottom" title="{{ trans('generals.back') }}"><i class="fas fa-chevron-left"></i></a>
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
                        <img src="{{ asset('img/furnishings/' . $variant_data->file_path) }}" class="w-25">
                    </div>
                    <div class="card-body">
                        <form action="{{ route('furnishings.update-variant', $variant_data->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="furnishing_id" value="{{ $variant_data->id }}">
                            <input type="hidden" name="parent_id" value="{{ $parent_id }}">
                            <input type="hidden" name="size" value="{{ $variant_data->size }}">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <div class="icheck-primary d-inline">
                                            <input type="checkbox" name="extra_price" id="extra_price"
                                                {{ $variant_data->extra_price ? 'checked' : '' }}>
                                            <label for="extra_price">{{ trans('tables.extra_price') }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>{{ trans('tables.price') }}</strong>
                                        <input type="text" name="price" class="form-control"
                                            value="{{ $variant_data->price }}" required>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>{{ trans('tables.color') }}</strong>
                                        <input type="text" name="color" class="form-control"
                                            value="{{ $variant_data->color }}" required>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>{{ trans('tables.image') }}
                                            {{ trans('forms.left_empty_not_change') }}</strong>
                                        <input type="file" name="file" class="form-control"
                                            value="{{ old('file') }}"
                                            accept="image/png, image/gif, image/jpeg, image/bmp">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary">{{ trans('generals.save') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
 --}}

@extends('layouts/layoutMaster')

@section('title', trans('crud.edit', ['item' => trans('entities.variant')]) . ' ' . $description)
@section('title_header', trans('crud.edit', ['item' => trans('entities.variant')]) . ' ' . $description)

@section('button')
    <a href="{{ url('admin/furnishings/' . $parent_id . '/variants') }}" class="btn btn-primary" data-bs-toggle="tooltip"
        data-bs-placement="bottom" data-bs-original-title="{{ trans('generals.back') }}"><i
            class="fas fa-chevron-left"></i></a>
    {{-- <a href="{{ url('admin/furnishings/' . $parent_id . '/variants') }}" class="btn btn-primary" data-toggle="tooltip"
        data-placement="bottom" title="{{ trans('generals.back') }}"><i class="fas fa-chevron-left"></i></a> --}}
@endsection


@section('path', trans('entities.variants'))
@section('current', trans('crud.edit', ['item' => trans('entities.variant')]) . ' ' . $description)


@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <img src="{{ asset('img/furnishings/' . $variant_data->file_path) }}" class="mw-100 h-px-150">
                </div>
                <div class="card-body">
                    <form action="{{ route('furnishings.update-variant', $variant_data->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="furnishing_id" value="{{ $variant_data->id }}">
                        <input type="hidden" name="parent_id" value="{{ $parent_id }}">
                        <input type="hidden" name="size" value="{{ $variant_data->size }}">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group mb-3">
                                    <label class="form-label fs-6 fw-bolder">{{ trans('tables.price') }}</label>
                                    <input type="text" name="price" class="form-control"
                                        value="{{ $variant_data->price }}" required>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group mb-3">
                                    <label class="switch switch-primary switch-sm me-0">
                                        <input class='switch-input'type="checkbox" name="extra_price" id="extra_price"
                                            {{ $variant_data->extra_price ? 'checked' : '' }} data-toggle="toggle"
                                            data-on="{{ trans('generals.yes') }}" data-off="{{ trans('generals.no') }}"
                                            data-onstyle="success" data-offstyle="danger" data-size="sm">
                                        <span class="switch-toggle-slider">
                                            <span class="switch-on"></span>
                                            <span class="switch-off"></span>
                                        </span>
                                        <span class="switch-label fs-6 fw-bolder">{{ trans('tables.extra_price') }}</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group mb-3">
                                    <label class="form-label fs-6 fw-bolder">{{ trans('tables.color') }}</label>
                                    <input type="text" name="color" class="form-control"
                                        value="{{ $variant_data->color }}" required>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group mb-3">
                                    <label class="form-label fs-6 fw-bolder">{{ trans('tables.image') }}
                                        {{ trans('forms.left_empty_not_change') }}</label>
                                    <input type="file" name="file" class="form-control" value="{{ old('file') }}"
                                        accept="image/png, image/gif, image/jpeg, image/bmp">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 text-end">
                                <button type="submit" class="btn btn-primary">{{ trans('generals.save') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
