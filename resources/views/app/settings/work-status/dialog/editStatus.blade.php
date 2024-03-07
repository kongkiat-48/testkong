<div class="modal fade" id="editStatusModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">แก้ไขรายการสถานะการทำงาน</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <hr>
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
                            <label class="form-label" for="edit_flagType">รูปแบบสถานะงาน</label>
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
