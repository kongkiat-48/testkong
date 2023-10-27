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

    <div class="modal fade" id="addStatus" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel3">เพิ่มรายการสถานะการทำงาน</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formAddStatus" class="form-block-add-status">
                    {{-- {!! csrf_field() !!} --}}
                    @csrf
                    <div class="modal-body">

                        <div class="row g-2">
                            <div class="col-md-6">
                                <label class="form-label" for="statusName">รายการสถานะ</label>
                                <input type="text" id="statusName" class="form-control" name="statusName"
                                    autocomplete="off" />
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="statusUse">รูปแบบการใช้งาน</label>
                                <select id="statusUse" name="statusUse" class="form-select select2" data-allow-clear="true">
                                    <option value="">Select</option>
                                    <option value="1">ใช้งานฝ่าย IT</option>
                                    <option value="2">ใช้งานฝ่ายอาคาร</option>
                                    <option value="3">ใช้งานทุกระบบ</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="status">สถานะการใช้งาน</label>
                                <select id="status" name="status" class="form-select select2" data-allow-clear="true">
                                    <option value="">Select</option>
                                    <option value="1">กำลังใช้งาน</option>
                                    <option value="0">ปิดการใช้งาน</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="flagType">FlagType</label>
                                <select id="flagType" name="flagType" class="form-select select2" data-allow-clear="true">
                                    <option value="">Select</option>
                                    <option value="Complete">ดำเนินงานเสร็จสิ้น</option>
                                    <option value="Waiting">อยู่ระหว่างดำเนินงาน</option>
                                    <option value="Close">ยกเลิกงาน / การแจ้ง</option>
                                    <option value="Other">อื่น ๆ</option>
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal"> ปิด</button>

                        <button type="submit" name="saveStatus" id="saveStatus"
                            class="btn btn-primary btn-form-block-overlay-add-status">บันทึกข้อมูล</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div class="modal fade" id="editStatusModel" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel3">เพิ่มรายการสถานะการทำงาน</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formEditStatus" class="form-block-add-status">
                    {!! csrf_field() !!}
                    <div class="modal-body">
                        <div class="row g-2">
                            <div class="col-md-6">
                                <label class="form-label" for="edit_statusName">รายการสถานะ</label>
                                <input type="text" id="edit_statusName" class="form-control" name="edit_statusName"
                                    autocomplete="off" />
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="edit_statusUse">รูปแบบการใช้งาน</label>
                                <select id="edit_statusUse" name="edit_statusUse" class="form-select select2"
                                    data-allow-clear="true">
                                    <option value="">Select</option>
                                    <option value="1">ใช้งานฝ่าย IT</option>
                                    <option value="2">ใช้งานฝ่ายอาคาร</option>
                                    <option value="3">ใช้งานทุกระบบ</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="status">สถานะการใช้งาน</label>
                                <select id="edit_status" name="edit_status" class="form-select select2"
                                    data-allow-clear="true">
                                    <option value="">Select</option>
                                    <option value="1">กำลังใช้งาน</option>
                                    <option value="0">ปิดการใช้งาน</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="edit_flagType">FlagType</label>
                                <select id="edit_flagType" name="edit_flagType" class="form-select select2"
                                    data-allow-clear="true">
                                    <option value="">Select</option>
                                    <option value="Complete">ดำเนินงานเสร็จสิ้น</option>
                                    <option value="Waiting">อยู่ระหว่างดำเนินงาน</option>
                                    <option value="Close">ยกเลิกงาน / การแจ้ง</option>
                                    <option value="Other">อื่น ๆ</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal"> ปิด</button>

                        <button type="submit" name="save_edit" id="save_edit"
                            class="btn btn-primary btn-form-block-overlay-add-status">บันทึกข้อมูล</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addFlagType" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel3">เพิ่มรายการสถานะการทำงาน</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formAddFlagType" class="form-block-add-status">
                    {!! csrf_field() !!}
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label" for="T">รายการสถานะ</label>
                                <input type="text" id="T" class="form-control" name="T"
                                    autocomplete="off" />
                            </div>

                            <div class="col-md-4">
                                <label class="form-label" for="G">รูปแบบการใช้งาน</label>
                                <select id="G" name="G" class="form-select select2"
                                    data-allow-clear="true">
                                    <option value="">Select</option>
                                    <option value="1">ใช้งานฝ่าย IT</option>
                                    <option value="2">ใช้งานฝ่ายอาคาร</option>
                                    <option value="3">ใช้งานทุกระบบ</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label" for="F">สถานะการใช้งาน</label>
                                <select id="F" name="F" class="form-select select2"
                                    data-allow-clear="true">
                                    <option value="">Select</option>
                                    <option value="1">กำลังใช้งาน</option>
                                    <option value="0">ปิดการใช้งาน</option>
                                </select>
                            </div>
                        </div>



                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal"> ปิด</button>

                        <button type="submit" name="saveStatusT" id="saveStatusT"
                            class="btn btn-primary btn-form-block-overlay-add-status">บันทึกข้อมูล</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="nav-align-top mb-4">
                <ul class="nav nav-pills mb-3" role="tablist">
                    <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                            data-bs-target="#set-status" aria-controls="set-status" aria-selected="true">
                            รายการสถานะงาน
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                            data-bs-target="#flag-type" aria-controls="flag-type" aria-selected="false">
                            รายการ Flag Type
                        </button>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="set-status" role="tabpanel">
                        <div class="demo-inline-spacing text-end">
                            <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                data-bs-target="#addStatus">
                                <i class='menu-icon tf-icons bx bxs-purchase-tag'></i> เพิ่มสถานะการทำงาน
                            </button>
                        </div>
                        <div class="text-nowrap">
                            <table class="dt-settingStatus table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th>รายการสถานะ</th>
                                        <th>รูปแบบการใช้งาน</th>
                                        <th>การใช้งานระบบ</th>
                                        <th>FlagType</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="flag-type" role="tabpanel">
                        <div class="demo-inline-spacing text-end">
                            <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                data-bs-target="#addFlagType">
                                <i class='menu-icon tf-icons bx bxs-purchase-tag'></i> เพิ่มรายการ Flag Type
                            </button>
                        </div>
                        <div class="text-nowrap">
                            <table class="dt-settingFlagType table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th>รายการสถานะ</th>
                                        {{-- <th>รูปแบบการใช้งาน</th>
                                        <th>การใช้งานระบบ</th>
                                        <th>FlagType</th> --}}
                                        <th>Action</th>
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
        src="{{ asset('/assets/custom/settings/status/status.js?v=') }}@php echo date("H:i:s") @endphp"></script>
@endsection
