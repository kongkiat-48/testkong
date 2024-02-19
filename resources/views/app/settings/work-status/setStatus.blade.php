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
    <div class="modal fade" id="addStatusModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">เพิ่มรายการสถานะการทำงาน</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formAddStatus" class="form-block-add-status">
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
                                    <option value="it">ใช้งานฝ่าย IT</option>
                                    <option value="building">ใช้งานฝ่ายอาคาร</option>
                                    <option value="all">ใช้งานทุกระบบ</option>
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

                            <div class="col-md-6">
                                <label class="form-label" for="statusWS">สถานะการใช้งาน</label>
                                <select id="statusWS" name="statusWS" class="form-select select2" data-allow-clear="true">
                                    <option value="">Select</option>
                                    <option value="1">กำลังใช้งาน</option>
                                    <option value="0">ปิดการใช้งาน</option>
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-label-danger" data-bs-dismiss="modal"> ปิด</button>

                        <button type="submit" name="saveStatus" id="saveStatus"
                            class="btn btn-success btn-form-block-overlay-add-status">บันทึกข้อมูล</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div class="modal fade" id="editStatusModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">แก้ไขรายการสถานะการทำงาน</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formEditStatus" class="form-block-add-status">
                    @csrf
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
                                    <option value="it">ใช้งานฝ่าย IT</option>
                                    <option value="building">ใช้งานฝ่ายอาคาร</option>
                                    <option value="all">ใช้งานทุกระบบ</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="edit_statusWS">สถานะการใช้งาน</label>
                                <select id="edit_statusWS" name="edit_statusWS" class="form-select select2"
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
                        <button type="button" class="btn btn-label-danger" data-bs-dismiss="modal"> ปิด</button>

                        <button type="submit" name="save_edit" id="save_edit"
                            class="btn btn-warning btn-form-block-overlay-add-status">บันทึกข้อมูล</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addFlagType" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">เพิ่มรายการรูปแบบสถานะงาน</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formAddFlagType" class="form-block-add-status">
                    @csrf
                    <div class="modal-body">
                        <div class="row g-2">
                            <div class="col-6">
                                <label class="form-label" for="flagName">ชื่อรายการรูปแบบสถานะงาน</label>
                                <input type="text" id="flagName" class="form-control" name="flagName"
                                    autocomplete="off" />
                            </div>

                            <div class="col-6">
                                <label class="form-label" for="typeWork">รูปแบบของสถานะ</label>
                                <select id="typeWork" name="typeWork" class="form-select select2"
                                    data-allow-clear="true">
                                    <option value="">Select</option>
                                    <option value="Complete">Complete</option>
                                    <option value="Hold">Hold</option>
                                    <option value="Doing">Doing</option>
                                    <option value="Wating">Wating</option>
                                    <option value="Cancel">Canncel</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>

                        </div>



                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-label-danger" data-bs-dismiss="modal"> ปิด</button>

                        <button type="submit" name="saveFlagType" id="saveFlagType"
                            class="btn btn-success btn-form-block-overlay-add-status">บันทึกข้อมูล</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editFlagTypeModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">แก้ไขรายการรูปแบบสถานะงาน</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formEditFlagType" class="form-block-add-status">
                    @csrf
                    <div class="modal-body">
                        <div class="row g-2">
                            <div class="row g-2">
                                <div class="col-md-6">
                                    <label class="form-label" for="edit_flagName">ชื่อรายการรูปแบบสถานะงาน</label>
                                    <input type="text" id="edit_flagName" class="form-control" name="edit_flagName"
                                        autocomplete="off" />
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label" for="edit_typeWork">รูปแบบของสถานะ</label>
                                    <select id="edit_typeWork" name="edit_typeWork" class="form-select select2"
                                        data-allow-clear="true">
                                        <option value="">Select</option>
                                        <option value="Complete">Complete</option>
                                        <option value="Hold">Hold</option>
                                        <option value="Doing">Doing</option>
                                        <option value="Wating">Wating</option>
                                        <option value="Cancel">Canncel</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-label-danger" data-bs-dismiss="modal"> ปิด</button>

                        <button type="submit" name="editFlagType" id="editFlagType"
                            class="btn btn-warning btn-form-block-overlay-add-status">บันทึกข้อมูล</button>
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
                            รายการรูปแบบสถานะงาน
                        </button>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="set-status" role="tabpanel">
                        <div class="demo-inline-spacing text-end">
                            <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                data-bs-target="#addStatusModal">
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
                                <i class='menu-icon tf-icons bx bxs-purchase-tag'></i> เพิ่มรายการรูปแบบสถานะงาน
                            </button>
                        </div>
                        <div class="text-nowrap">
                            <table class="dt-settingFlagType table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th>รายการสถานะ</th>
                                        <th>รูปแบบของสถานะ</th>
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
