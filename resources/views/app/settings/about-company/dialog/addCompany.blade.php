<div class="modal fade" id="addCompanyModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">เพิ่มรายการชื่อบรัษัท</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <hr>
            <form id="formAddCompany" class="form-block">
                @csrf
                <div class="modal-body">

                    <div class="row g-2">
                        <div class="col-md-6">
                            <label class="form-label" for="companyNameTH">ชื่อบริษัท (ภาษาไทย)</label>
                            <input type="text" id="companyNameTH" class="form-control" name="companyNameTH"
                                autocomplete="off"/>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label" for="companyNameEN">ชื่อบริษัท (ภาษาอังกฤษ)</label>
                            <input type="text" id="companyNameEN" class="form-control" name="companyNameEN"
                                autocomplete="off"/>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label" for="status">สถานะการใช้งาน</label>
                            <select id="status" name="status" class="form-select select2" data-allow-clear="true">
                                <option value="">Select</option>
                                <option value="1">กำลังใช้งาน</option>
                                <option value="0">ปิดการใช้งาน</option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-label-danger" data-bs-dismiss="modal"> ปิด</button>

                    <button type="submit" name="saveCompany" id="saveCompany"
                        class="btn btn-success btn-form-block-overlay">บันทึกข้อมูล</button>
                </div>
            </form>

        </div>
    </div>
</div>

