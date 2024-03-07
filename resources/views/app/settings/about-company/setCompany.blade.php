@extends('layouts.app')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('/home') }}">หน้าแรก</a>
            </li>
            <li class="breadcrumb-item active">{{ $urlName }}</li>
        </ol>
    </nav>
    <hr>
    @include('app.settings.about-company.dialog.addCompany')
    <div class="row">
        <div class="col-12">
            <div class="nav-align-top mb-4">
                <ul class="nav nav-pills mb-3" role="tablist">
                    <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                            data-bs-target="#list-company" aria-controls="list-company" aria-selected="true">
                            รายการชื่อบริษัท
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                            data-bs-target="#list-department" aria-controls="list-department" aria-selected="false">
                            รายการชื่อสังกัด / ฝ่าย
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                            data-bs-target="#list-group" aria-controls="list-group" aria-selected="false">
                            รายการชื่อแผนก
                        </button>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="list-company" role="tabpanel">
                        <div class="demo-inline-spacing text-end">
                            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#addCompanyModal">
                                <i class='menu-icon tf-icons bx bxs-purchase-tag'></i> เพิ่มรายการชื่อบริษัท
                            </button>
                        </div>
                        <div class="text-nowrap">
                            <table class="dt-settingCompany table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th class="text-center">ชื่อบริษัท ภาษาไทย</th>
                                        <th class="text-center">ชื่อบริษัท ภาษาอังกฤษ</th>
                                        <th class="text-center">การใช้งานระบบ</th>
                                        <th>จัดการ</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="list-department" role="tabpanel">
                        <div class="demo-inline-spacing text-end">
                            <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                data-bs-target="#addDepartment">
                                <i class='menu-icon tf-icons bx bxs-purchase-tag'></i> เพิ่มรายการชื่อแผนกสังกัด / ฝ่าย
                            </button>
                        </div>
                        <div class="text-nowrap">
                            <table class="dt-settingDepartment table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th class="text-center">ชื่อสังกัด / ฝ่าย</th>
                                        <th class="text-center">ชื่อบริษัท</th>
                                        <th class="text-center">การใช้งานระบบ</th>
                                        <th>จัดการ</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="list-group" role="tabpanel">
                        <div class="demo-inline-spacing text-end">
                            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#addGroup">
                                <i class='menu-icon tf-icons bx bxs-purchase-tag'></i> เพิ่มรายการชื่อแผนก
                            </button>
                        </div>
                        <div class="text-nowrap">
                            <table class="dt-settingGroup table table-bordered">
                                <thead>
                                    <tr>

                                        <th>ลำดับ</th>
                                        <th class="text-center">ชื่อแผนก</th>
                                        <th class="text-center">ชื่อสังกัด / ฝ่าย</th>
                                        <th class="text-center">ชื่อบริษัท</th>
                                        <th class="text-center">การใช้งานระบบ</th>
                                        <th>จัดการ</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript"
        src="{{ asset('/assets/custom/settings/aboutCompany/company.js?v=') }}@php echo date("H:i:s") @endphp"></script>
@endsection
