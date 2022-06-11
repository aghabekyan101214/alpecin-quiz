@extends('layouts.admin')

@section('content')

    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

        <br>

        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head" style="align-items: center;">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">Products</h3>
                    </div>
                    <a href="{{ route('admin.products.create') }}" class="btn btn-outline-primary">
                        <i class="la la-plus"></i>
                        Add Product
                    </a>
                </div>
                <div class="kt-portlet__body">
                    @if(session('create-message'))
                        <div class="alert alert-success fade show" role="alert">
                            <div class="alert-text">{{session('create-message')}}</div>
                            <div class="alert-close">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true"><i class="la la-close"></i></span>
                                </button>
                            </div>
                        </div>
                    @elseif(session('update-message'))
                        <div class="alert alert-brand fade show" role="alert">
                            <div class="alert-text">{{session('update-message')}}</div>
                            <div class="alert-close">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true"><i class="la la-close"></i></span>
                                </button>
                            </div>
                        </div>
                    @elseif(session('delete-message'))
                        <div class="alert alert-danger fade show" role="alert">
                            <div class="alert-text">{{session('delete-message')}}</div>
                            <div class="alert-close">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true"><i class="la la-close"></i></span>
                                </button>
                            </div>
                        </div>
                    @endif
                <!--begin: Datatable -->
                    <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                        <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody id="sortlist">
                            @foreach($data as $d)
                                <tr class="ui-state-default sorting-tr">
                                    <td width="150"><img style="width: 100%" class="img-fluid" src="{{ asset('uploads/'.$d->image) }}" alt=""></td>
                                    <td>
                                        <ul>
                                        @foreach($d->translations as $q)
                                            <li>({{ $q->language->language_code }}) {{ $q->name }}</li>
                                        @endforeach
                                        </ul>
                                    </td>
                                    <td>
                                        <ul>
                                            @foreach($d->translations as $t)
                                                <li>({{ $t->language->language_code }}) {{ $t->description }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td nowrap>
                                        <span class="dropdown">
                                            <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md btn-req-change" data-toggle="dropdown" aria-expanded="true">
                                              <i class="la la-ellipsis-h"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="{{ route('admin.products.edit', $d->id) }}">Edit</a>
                                                <form method="post" action="{{ route('admin.products.destroy', $d->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="dropdown-item" style="padding: 0.7rem 1.2rem;">Delete</button>
                                                </form>
                                            </div>
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!--end: Datatable -->

                </div>
            </div>
        </div>

    </div>

@endsection

