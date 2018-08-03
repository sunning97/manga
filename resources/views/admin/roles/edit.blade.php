@extends('admin.layouts.app')

@section('title','Cập nhật '.$role->name)

@section('plugin_css')
    <link href="{{ asset('assets/admin/plugin/custom-select/custom-select.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/plugin/switchery/dist/switchery.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/plugin/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/plugin/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/plugin/multiselect/css/multi-select.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title" data-name="{{ old('name') ?? $role->name }}" data-id="{{ $role->id }}">{{ $role->name }}</h4></div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}">Bảng điều khiển</a></li>
                <li><a href="{{ route('roles.index') }}">Roles</a></li>
                <li class="active">Cập nhật: {{ $role->name }}</li>
            </ol>
        </div>
    </div>
    <div class="row" id="app">
        <div class="col-md-12">
            <div class="white-box">
                <ul class="nav customtab nav-tabs" role="tablist">
                    <li role="presentation" class="nav-item"><a href="#info" class="nav-link active" aria-controls="info" role="tab" data-toggle="tab" aria-expanded="true"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs"> Thông tin</span></a></li>
                    <li role="presentation" class="nav-item"><a href="#permission" class="nav-link" aria-controls="permission" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-user"></i></span> <span class="hidden-xs"> Permission</span></a></li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade active in" id="info">
                        <form class="form-horizontal" method="post" action="{{ route('roles.update',$role->id) }}">
                            @csrf
                            @method('put')
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="col-md-12">Tên Role</label>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" name="name" v-model="name">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="col-md-12">Tên Slug</label>
                                        <div class="col-md-12">
                                            <input readonly type="text" class="form-control" name="slug_name" :value="getSlug(name)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">Mô tả</label>
                                        <div class="col-md-12">
                                            <textarea class="form-control" rows="5" name="description">{{ old('description') ?? $role->description }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-6">
                                    <label class="form-group">Cập nhật level</label>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <select class="custom-select col-12" id="level" name="level">
                                                <option v-for="(level,index) in levels" :value="level" :selected="index === 0">Level @{{ level }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label class="form-group">Các vai trò đang có</label>
                                    <p class="text-muted m-b-30 font-13">
                                        <b>*Note:</b> Level càng thấp thì quyền hạn của vai trò càng cao<br>
                                        <b>Super Administrator</b> là vai trò có quyền cao nhất trong hệ thống
                                    </p>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>Tên</th>
                                                <th class="text-center">Level</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr v-for="role in roles">
                                                <td><b>@{{ role.name }}</b></td>
                                                <td class="text-center">@{{ role.level }}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="text-right">
                                        <button type="submit" class="btn btn-inverse waves-effect waves-light">Cập
                                            nhật
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="permission">
                        <h5 class="text-left"><b>Quyền đang có</b></h5>
                        <div class="row mt-5">
                            @forelse($rp as $permission)
                                <div class="col-4">
                                    <div class="checkbox checkbox-inverse">
                                        <input id="checkbox6c" type="checkbox" value="{{ $permission->id }}" checked disabled>
                                        <label for="checkbox6c"> {{ $permission->name }} </label>
                                    </div>
                                </div>
                            @empty
                                <h5 class="text-center">Chưa được cấp quyền nào!</h5>
                            @endforelse
                        </div>
                        <h5 class="text-left mt-5"><b>Thay đổi quyền</b></h5>
                        <form class="form-horizontal mt-5" method="post" action="{{ route('admin.update.role.permission',$role->id) }}">
                            @csrf
                            @method('post')
                            <div class="row">
                                <h4 class="m-t-20"><b></b></h4>
                                <select class="select2 m-b-10 select2-multiple" multiple="multiple" data-placeholder="Chọn quyền..." name="permissions[]">
                                    @if( $rp->count() == 0)
                                        @foreach($permissions as $permission)
                                            <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                                        @endforeach
                                    @else
                                        @foreach($rp as $permission)
                                            <option value="{{ $permission->id }}" selected>{{ $permission->name }}</option>
                                        @endforeach
                                        @foreach($others as $other)
                                            <option value="{{ $other->id }}">{{ $other->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="text-right">
                                        <button type="submit" class="btn btn-inverse waves-effect waves-light">Cập
                                            nhật
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('plugin_js')
    <script src="{{ asset('assets/admin/plugin/switchery/dist/switchery.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugin/custom-select/custom-select.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/admin/plugin/bootstrap-select/bootstrap-select.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/admin/plugin/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugin/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/admin/plugin/multiselect/js/jquery.multi-select.js') }}"></script>
@endsection

@section('custom_js')
    <script src="{{ asset('js/role-edit.js') }}"></script>
@endsection