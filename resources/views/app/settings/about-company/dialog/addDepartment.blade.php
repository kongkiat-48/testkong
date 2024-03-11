<div class="modal fade" id="addDepartmentModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">เพิ่มรายการสังกัด / ฝ่าย</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <hr>
            <form id="formAddDepartment" class="form-block">
                @csrf
                <div class="modal-body">

                    <div class="row g-2">
                        <div class="col-md-6">
                            <label class="form-label" for="departmentName">ชื่อสังกัด / ฝ่าย</label>
                            <input type="text" id="departmentName" class="form-control" name="departmentName"
                                autocomplete="off"/>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label" for="company">ชื่อบริษัท</label>
                            <select id="company" name="company" class="form-select select2" data-allow-clear="true">
                                <option value="">Select</option>
                                @foreach ($getCompany as $key => $value)
                                    <option value="{{ $value->ID }}">
                                        {{ $value->company_name_th }}</option>
                                @endforeach
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
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-label-danger" data-bs-dismiss="modal"> ปิด</button>

                    <button type="submit" name="saveDepartment" id="saveDepartment"
                        class="btn btn-success btn-form-block-overlay">บันทึกข้อมูล</button>
                </div>
            </form>

        </div>
    </div>
</div>
