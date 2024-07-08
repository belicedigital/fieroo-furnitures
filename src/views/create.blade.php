{{-- @extends('layouts.app')
@section('title', trans('crud.new', ['obj' => trans('entities.furnishing')]))
@section('title_header', trans('crud.new', ['obj' => trans('entities.furnishing')]))
@section('buttons')
    <a href="{{ url('admin/furnishings') }}" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom"
        title="{{ trans('generals.back') }}"><i class="fas fa-chevron-left"></i></a>
@endsection
@section('content')
    <div class="container">
        @if ($errors->any())
            @include('admin.partials.errors', ['errors' => $errors])
        @endif
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-tabs">
                    <div class="card-header p-0">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="it-tab" data-toggle="pill" href="#it-furnishings-tab"
                                    role="tab" aria-controls="it-furnishings-tabe" aria-selected="true">IT</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="en-tab" data-toggle="pill" href="#en-furnishings-tab"
                                    role="tab" aria-controls="en-furnishings-tab" aria-selected="false">EN</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('furnishings.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="tab-content" id="custom-tabs-one-tabContent">
                                <div class="tab-pane fade show active" id="it-furnishings-tab" role="tabpanel"
                                    aria-labelledby="it-tab">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <strong>{{ trans('tables.stand') }}</strong>
                                                <select id="stand_type_id" name="stand_type_id[]" class="form-control"
                                                    multiple>
                                                    <option value="" disabled>{{ trans('forms.select_choice') }}
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="card d-none col-md-12" data-stand-placeholder>
                                            <div class="card-header">
                                                <h5></h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                    <div class="form-group mb-2">
                                                        <div class="icheck-primary d-inline">
                                                            <input type="checkbox" id="is_supplied" name="is_supplied"
                                                                class="form-check-input">
                                                            <label for="is_supplied"
                                                                class="form-check-label">{{ trans('tables.supplied') }}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                    <div class="form-group">
                                                        <strong>{{ trans('forms.min') }}</strong>
                                                        <input type="number" id="min" name="min" min="0"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                    <div class="form-group">
                                                        <strong>{{ trans('forms.max') }}</strong>
                                                        <input type="number" id="max" name="max" min="0"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <strong>{{ trans('tables.size') }}</strong>
                                                <input type="text" name="size" class="form-control"
                                                    value="{{ old('size') }}">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <strong>{{ trans('tables.price') }}
                                                    ({{ trans('generals.tax_excl') }})</strong>
                                                <input type="text" name="price" class="form-control"
                                                    value="{{ old('price') }}">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <strong>{{ trans('tables.color') }}</strong>
                                                <input type="text" name="color" class="form-control"
                                                    value="{{ old('color') }}">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <strong>{{ trans('tables.description') }}</strong>
                                                <input type="text" name="description" class="form-control"
                                                    value="{{ old('description') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <strong>{{ trans('tables.image') }}</strong>
                                                <input type="file" name="file" class="form-control"
                                                    value="{{ old('file') }}"
                                                    accept="image/png, image/gif, image/jpeg, image/bmp" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="en-furnishings-tab" role="tabpanel"
                                    aria-labelledby="en-tab">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <strong>{{ trans('tables.stand') }}</strong>
                                                <select id="stand_type_id_en" name="stand_type_id_en"
                                                    class="form-control" readonly disabled>
                                                    <option value="">{{ trans('forms.select_choice') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <strong>{{ trans('tables.size') }}</strong>
                                                <input type="text" name="size_en" class="form-control"
                                                    value="{{ old('size_en') }}" readonly disabled>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <strong>{{ trans('tables.price') }}
                                                    ({{ trans('generals.tax_excl') }})</strong>
                                                <input type="text" name="price_en" class="form-control"
                                                    value="{{ old('price_en') }}" readonly disabled>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <strong>{{ trans('tables.color') }}</strong>
                                                <input type="text" name="color_en" class="form-control"
                                                    value="{{ old('color_en') }}" readonly disabled>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <strong>{{ trans('tables.description') }}</strong>
                                                <input type="text" name="description_en" class="form-control"
                                                    value="{{ old('description_en') }}">
                                            </div>
                                        </div>
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
@section('scripts')
    <script>
        const createCardStand = (data) => {
            console.log(data)
            let clone = $('[data-stand-placeholder]').clone().insertAfter('[data-stand-placeholder]');
            clone.removeClass('d-none');
            clone.removeAttr('data-stand-placeholder')
            clone.attr('data-stand', data.id);
            clone.find('h5').text(data.text);

            clone.find('input[name="is_supplied"]').attr({
                'name': 'is_supplied_' + data.id,
                'id': 'is_supplied_' + data.id
            })
            clone.find('label[for="is_supplied"]').attr('for', 'is_supplied_' + data.id)

            clone.find('input[name="min"]').attr({
                'name': 'min_' + data.id,
                'id': 'min_' + data.id,
            })

            clone.find('input[name="max"]').attr({
                'name': 'max_' + data.id,
                'id': 'max_' + data.id,
            })

        }
        const destroyCardStand = (data) => {
            $('[data-stand="' + data.id + '"]').remove()
        }
        const initStands = () => {
            common_request.post('/admin/furnishings/stands')
                .then(response => {
                    let data = response.data
                    if (data.status) {
                        $.each(data.data, function(index, value) {
                            let opt = document.createElement('option')
                            opt.text = value.name + ' (' + value.size + ' {{ trans('generals.mq') }})';
                            opt.value = value.stand_type_id;
                            $('#stand_type_id, #stand_type_id_en').append(opt)
                        })
                        $('#stand_type_id, #stand_type_id_en').select2();
                        $('#stand_type_id').on('select2:select', function(e) {
                            createCardStand(e.params.data)
                        });
                        $('#stand_type_id').on('select2:unselect', function(e) {
                            destroyCardStand(e.params.data)
                        });
                    } else {
                        toastr.error(data.message)
                    }
                })
                .catch(error => {
                    toastr.error(error)
                    console.log(error)
                })
        }
        $(document).ready(function() {
            initStands()

            $('input[type="text"]').on('keyup change', function(e) {
                let name = $(this).attr('name');
                $('input[name="' + name + '_en"]').val($(this).val() + '_EN');
            });

            $('input[type="checkbox"]').on('change', function() {
                let name = $(this).attr('name');
                if ($(this).is(':checked')) {
                    $('input[name="' + name + '_en"]').attr('checked', true);
                } else {
                    $('input[name="' + name + '_en"]').removeAttr('checked');
                }
            });
        });
    </script>
@endsection
 --}}
@extends('layouts/layoutMaster')

@section('title', trans('crud.new', ['obj' => trans('entities.furnishing')]))
@section('title_header', trans('crud.new', ['obj' => trans('entities.furnishing')]))

@section('buttons')
    <a href="{{ url('admin/furnishings') }}" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom"
        title="{{ trans('generals.back') }}"><i class="fas fa-chevron-left"></i></a>
@endsection

@section('path', trans('entities.furnishings'))
@section('current', trans('crud.new', ['obj' => trans('entities.furnishing')]))

@section('content')
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-pills card-header-tabs mb-2" role="tablist">
                        <li class="nav-item">
                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#it-furnishings-tab"
                                role="tab" aria-selected="true">IT</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link " data-bs-toggle="tab" data-bs-target="#en-furnishings-tab"
                                role="tab" aria-selected="false">EN</button>
                        </li>
                    </ul>
                    <form action="{{ route('furnishings.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="tab-content" id="custom-tabs-one-tabContent">
                            <div class="tab-pane fade show active" id="it-furnishings-tab" role="tabpanel"
                                aria-labelledby="it-tab">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group mb-3">
                                            <label class="form-label fs-6 fw-bolder">{{ trans('tables.stand') }}</label>
                                            <select id="stand_type_id" name="stand_type_id[]" class="form-control" multiple>
                                                <option value="" disabled>{{ trans('forms.select_choice') }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="card d-none col-md-12 mb-3" data-stand-placeholder>
                                        <div class="card-header">
                                            <h5></h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group mb-2">
                                                    <label class="switch switch-primary switch-sm me-0">
                                                        <input id="is_supplied" name="is_supplied" class='switch-input'
                                                            type="checkbox" data-toggle="toggle"
                                                            data-on="{{ trans('generals.yes') }}"
                                                            data-off="{{ trans('generals.no') }}" data-onstyle="success"
                                                            data-offstyle="danger" data-size="sm">
                                                        <span class="switch-toggle-slider">
                                                            <span class="switch-on"></span>
                                                            <span class="switch-off"></span>
                                                        </span>
                                                        <span
                                                            class="switch-label fs-6 fw-bolder">{{ trans('tables.supplied') }}</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <label
                                                        class="form-label fs-6 fw-bolder">{{ trans('forms.min') }}</label>
                                                    <input type="number" id="min" name="min" min="0"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <label
                                                        class="form-label fs-6 fw-bolder">{{ trans('forms.max') }}</label>
                                                    <input type="number" id="max" name="max" min="0"
                                                        class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group mb-3">
                                            <label class="form-label fs-6 fw-bolder">{{ trans('tables.size') }}</label>
                                            <input type="text" name="size" class="form-control"
                                                value="{{ old('size') }}">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group mb-3">
                                            <label class="form-label fs-6 fw-bolder">{{ trans('tables.price') }}
                                                ({{ trans('generals.tax_excl') }})</label>
                                            <input type="text" name="price" class="form-control"
                                                value="{{ old('price') }}">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group mb-3">
                                            <label class="form-label fs-6 fw-bolder">{{ trans('tables.color') }}</label>
                                            <input type="text" name="color" class="form-control"
                                                value="{{ old('color') }}">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group mb-3">
                                            <label
                                                class="form-label fs-6 fw-bolder">{{ trans('tables.description') }}</label>
                                            <input type="text" name="description" class="form-control"
                                                value="{{ old('description') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group mb-3">
                                            <label class="form-label fs-6 fw-bolder">{{ trans('tables.image') }}</label>
                                            <input type="file" name="file" class="form-control"
                                                value="{{ old('file') }}"
                                                accept="image/png, image/gif, image/jpeg, image/bmp" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="en-furnishings-tab" role="tabpanel" aria-labelledby="en-tab">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group mb-3">
                                            <label class="form-label fs-6 fw-bolder">{{ trans('tables.stand') }}</label>
                                            <select id="stand_type_id_en" name="stand_type_id_en" class="form-control"
                                                readonly disabled>
                                                <option value="">{{ trans('forms.select_choice') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group mb-3"><label
                                                class="form-label fs-6 fw-bolder">{{ trans('tables.size') }}</label>
                                            <input type="text" name="size_en" class="form-control"
                                                value="{{ old('size_en') }}" readonly disabled>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group mb-3">
                                            <label class="form-label fs-6 fw-bolder">{{ trans('tables.price') }}
                                                ({{ trans('generals.tax_excl') }})</label>
                                            <input type="text" name="price_en" class="form-control"
                                                value="{{ old('price_en') }}" readonly disabled>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group mb-3">
                                            <label class="form-label fs-6 fw-bolder">{{ trans('tables.color') }}</label>
                                            <input type="text" name="color_en" class="form-control"
                                                value="{{ old('color_en') }}" readonly disabled>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group mb-3">
                                            <label
                                                class="form-label fs-6 fw-bolder">{{ trans('tables.description') }}</label>
                                            <input type="text" name="description_en" class="form-control"
                                                value="{{ old('description_en') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-end">
                            <button type="submit" class="btn btn-primary">{{ trans('generals.save') }}</button>
                            <a href="{{ url('admin/furnishings') }}"
                                class="btn btn-label-secondary">{{ trans('generals.cancel') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/toastr/toastr.css') }}" />
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/toastr/toastr.js') }}"></script>
@endsection

@section('page-script')
    <script>
        const createCardStand = (data) => {
            console.log(data)
            let clone = $('[data-stand-placeholder]').clone().insertAfter('[data-stand-placeholder]');
            clone.removeClass('d-none');
            clone.removeAttr('data-stand-placeholder')
            clone.attr('data-stand', data.id);
            clone.find('h5').text(data.text);

            clone.find('input[name="is_supplied"]').attr({
                'name': 'is_supplied_' + data.id,
                'id': 'is_supplied_' + data.id
            })
            clone.find('label[for="is_supplied"]').attr('for', 'is_supplied_' + data.id)

            clone.find('input[name="min"]').attr({
                'name': 'min_' + data.id,
                'id': 'min_' + data.id,
            })

            clone.find('input[name="max"]').attr({
                'name': 'max_' + data.id,
                'id': 'max_' + data.id,
            })

        }
        const destroyCardStand = (data) => {
            $('[data-stand="' + data.id + '"]').remove()
        }
        const initStands = () => {
            common_request.post('/admin/furnishings/stands')
                .then(response => {
                    let data = response.data
                    if (data.status) {
                        $.each(data.data, function(index, value) {
                            let opt = document.createElement('option')
                            opt.text = value.name + ' (' + value.size + ' {{ trans('generals.mq') }})';
                            opt.value = value.stand_type_id;
                            $('#stand_type_id, #stand_type_id_en').append(opt)
                        })
                        $('#stand_type_id, #stand_type_id_en').select2();
                        $('#stand_type_id').on('select2:select', function(e) {
                            createCardStand(e.params.data)
                        });
                        $('#stand_type_id').on('select2:unselect', function(e) {
                            destroyCardStand(e.params.data)
                        });
                    } else {
                        toastr.error(data.message)
                    }
                })
                .catch(error => {
                    toastr.error(error)
                    console.log(error)
                })
        }
        $(document).ready(function() {
            initStands()

            $('input[type="text"]').on('keyup change', function(e) {
                let name = $(this).attr('name');
                $('input[name="' + name + '_en"]').val($(this).val() + '_EN');
            });

            $('input[type="checkbox"]').on('change', function() {
                let name = $(this).attr('name');
                if ($(this).is(':checked')) {
                    $('input[name="' + name + '_en"]').attr('checked', true);
                } else {
                    $('input[name="' + name + '_en"]').removeAttr('checked');
                }
            });
        });
    </script>
@endsection
