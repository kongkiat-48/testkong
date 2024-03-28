<div class="modal fade" id="editFlagTypeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">แก้ไขรายการรูปแบบสถานะงาน</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <hr>
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
                    <button type="button" class="btn btn-label-danger" data-bs-dismiss="modal"><i class='menu-icon tf-icons bx bx-window-close'></i> ปิด</button>

                    <button type="submit" name="editFlagType" id="editFlagType"
                        class="btn btn-warning btn-form-block-overlay-add-status"><i class='menu-icon tf-icons bx bxs-save'></i> บันทึกข้อมูล</button>
                </div>
            </form>
        </div>
    </div>
</div>
