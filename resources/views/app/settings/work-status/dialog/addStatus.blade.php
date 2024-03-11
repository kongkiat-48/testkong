<div class="modal fade" id="addStatusModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">เพิ่มรายการสถานะการทำงาน</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <hr>
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
                        {{-- {{ dd($flagType) }} --}}
                        <div class="col-md-6">
                            <label class="form-label" for="flagType">รูปแบบสถานะงาน</label>
                            <select id="flagType" name="flagType" class="form-select select2" data-allow-clear="true">
                                <option value="">Select</option>
                                    @foreach ($flagType as $key => $value)
                                        <option value="{{ $value->type_work }}">
                                            {{ $value->flag_name }} / {{ $value->type_work }}</option>
                                    @endforeach


                                {{-- <option value="">Select</option>
                                <option value="Complete">ดำเนินงานเสร็จสิ้น</option>
                                <option value="Waiting">อยู่ระหว่างดำเนินงาน</option>
                                <option value="Close">ยกเลิกงาน / การแจ้ง</option>
                                <option value="Other">อื่น ๆ</option> --}}
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

