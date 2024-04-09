<?php
$page = request()->page;

$list_config = [
    'default' => [
        'title' => 'Danh sách package',
        'btn_class' => 'btn-move-to-trash',
        'tooltip' => 'Xóa tạm thời',
    ],
    'trash' => [
        'title' => 'Danh sách package đã xóa',
        'btn_class' => 'btn-delete',
        'tooltip' => 'Xóa vĩnh viễn',
    ],
];

$list_type = isset($type) && strtolower($type) == 'trash' ? 'trash' : 'default';

$columns = [
    'name' => 'Họ package',
];

$title = $list_config[$list_type]['title'];
$btn_class = $list_config[$list_type]['btn_class'];
$btn_tooltip = $list_config[$list_type]['tooltip'];

?>
<div class="m-portlet">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                    {{ $title }}
                </h3>
            </div>
        </div>
    </div>

    <div class="m-portlet__body">

        <div class="m-section">
            <div class="m-section__sub">
                @include($_template.'list-filter',[
                    'sortable'=> array_merge($columns, [
                        'user_limited' => 'số lượng tài khoản',
                        'price' => 'Giá gói',
                        'created_at' => 'Thời gian'
                    ]),
                    'searchable' => $columns,
                ])
            </div>
        </div>
        @if (isset($results) && count($results))
            <!--begin::Section-->
            <div class="m-section">
                <div class="m-section__content crazy-list">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">
                                        <label class="m-checkbox m-checkbox--solid m-checkbox--success">
                                            <input type="checkbox" class="crazy-check-all">
                                            <span></span>
                                        </label>
                                    </th>
                                    <th>ID</th>
                                    <th>Tên package</th>
                                    <th class="max-200">Mô tả</th>
                                    <th class="text-right">Số user</th>
                                    <th class="text-right">Giá</th>
                                    <th class="text-center min-100 max-120">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($results as $result)

                                    <tr class="tr_user" id="crazy-item-{{ $result->id }}"
                                        data-name="{{ $result->name }}">
                                        <td class="text-center">
                                            <label class="m-checkbox m-checkbox--solid m-checkbox--success">
                                                <input type="checkbox" name="ids[]" value="{{ $result->id }}"
                                                    data-id="{{ $result->id }}" class="crazy-check-item">
                                                <span></span>
                                            </label>
                                        </td>
                                        <th>{{ $result->id }}</th>
                                        <td><a style="font-weight:500"
                                                href="{{ $editRoute = route('packages.update', ['id' => $result->id]) }}">{{ $result->name }}</a>
                                        </td>
                                        <th class="max-200">{{ $result->description }}</th>
                                        <th class="text-right">{{ $result->user_limited }}</th>
                                        <th class="text-right">{{ number_format($result->price, 0, ',', '.') }}
                                        </th>
                                        <td class="text-center max-120">
                                            <a href="{{ $editRoute }}" data-toggle="m-tooltip" data-placement="left"
                                                title data-original-title="Sửa"
                                                class="text-accent btn btn-outline-accent btn-sm m-btn m-btn--icon m-btn--icon-only m-btn--pill m-btn--air">
                                                <i class="flaticon-edit-1"></i>
                                            </a>

                                            @if ($list_type == 'trash')

                                                <a href="javascript:void(0);" data-id="{{ $result->id }}"
                                                    data-toggle="m-tooltip" data-placement="left"
                                                    data-original-title="Khôi phục"
                                                    class="btn-restore text-info btn btn-outline-info btn-sm m-btn m-btn--icon m-btn--icon-only m-btn--pill m-btn--air">
                                                    <i class="fa fa-undo"></i>
                                                </a>

                                            @endif

                                            <a href="javascript:void(0);" data-id="{{ $result->id }}"
                                                data-toggle="m-tooltip" data-placement="left"
                                                data-original-title="{{ $btn_tooltip }}"
                                                class="{{ $btn_class }} text-danger btn btn-outline-danger btn-sm m-btn m-btn--icon m-btn--icon-only m-btn--pill m-btn--air">
                                                <i class="flaticon-delete-1"></i>
                                            </a>
                                            {{-- <a href="{{route('user.add')}}" data-toggle="m-tooltip" data-placement="left" title data-original-title="Thêm người dùng" class="btn btn-outline-primary m-btn m-btn--icon btn-lg m-btn--icon-only m-btn--pill m-btn--air">
                                        <i class="flaticon-user-add"></i>
                                    </a> --}}
                                        </td>
                                    </tr>

                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{-- nút phân trang --}}
            <div class="list-toolbar">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-4">
                        <a href="javascript:void(0);" data-toggle="m-tooltip" data-placement="top"
                            data-original-title="Chọn tất cả"
                            class="crazy-btn-check-all text-success btn btn-outline-success btn-sm m-btn m-btn--icon m-btn--icon-only m-btn--pill m-btn--air">
                            <i class="fa fa-check"></i>
                        </a>

                        @if ($list_type == 'trash')

                            <a href="javascript:void(0);" data-toggle="m-tooltip" data-placement="top"
                                data-original-title="Khôi phục tất cả"
                                class="crazy-btn-restore-all text-info btn btn-outline-info btn-sm m-btn m-btn--icon m-btn--icon-only m-btn--pill m-btn--air">
                                <i class="fa fa-undo"></i>
                            </a>
                            <a href="javascript:void(0);" data-toggle="m-tooltip" data-placement="top"
                                data-original-title="Xóa tất cả"
                                class="crazy-btn-delete-all text-danger btn btn-outline-danger btn-sm m-btn m-btn--icon m-btn--icon-only m-btn--pill m-btn--air">
                                <i class="flaticon-delete-1"></i>
                            </a>
                        @else
                            <a href="javascript:void(0);" data-toggle="m-tooltip" data-placement="top"
                                data-original-title="Chuyển tất cả vào thùng rác"
                                class="crazy-btn-move-to-trash-all text-danger btn btn-outline-danger btn-sm m-btn m-btn--icon m-btn--icon-only m-btn--pill m-btn--air">
                                <i class="flaticon-delete-1"></i>
                            </a>

                        @endif


                    </div>
                    <div class="col-12 col-md-6 col-lg-8">
                        {{ $results->links($_pagination . 'default') }}
                    </div>
                </div>
            </div>
            <!--end::Section-->

        @else
            <div class="alert alert-warning">Danh sách trống</div>
        @endif

    </div>

    <!--end::Form-->
</div>
