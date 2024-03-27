<div class="modal fade" id="editCompanyModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">แก้ไขรายการบริษัท</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <hr>
            <form id="formEditCompany" class="form-block">
                <div class="modal-body">
                    <div class="row g-2">
                        <div class="col-md-6">
                            <label class="form-label" for="edit_companyNameTH">ชื่อบริษัท (ภาษาไทย)</label>
                            <input type="text" id="edit_companyNameTH" class="form-control" name="edit_companyNameTH"
                                autocomplete="off" />
                        </div>

                        <div class="col-md-6">
                            <label class="form-label" for="edit_companyNameEN">ชื่อบริษัท (ภาษาอังกฤษ)</label>
                            <input type="text" id="edit_companyNameEN" class="form-control" name="edit_companyNameEN"
                                autocomplete="off" />
                        </div>

                        <div class="col-md-6">
                            <label class="form-label" for="edit_status">สถานะการใช้งาน</label>
                            <select id="edit_status" name="edit_status" class="form-select select2" data-allow-clear="true">
                                <option value="">Select</option>
                                <option value="1">กำลังใช้งาน</option>
                                <option value="0">ปิดการใช้งาน</option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-label-danger" data-bs-dismiss="modal"> ปิด</button>
                    <input type="text" name="comID" id="comID">
                    <button type="submit" name="saveEditCompany" id="saveEditCompany"
                        class="btn btn-warning btn-form-block-overlay">บันทึกข้อมูล</button>
                </div>
            </form>
        </div>
    </div>
</div>
