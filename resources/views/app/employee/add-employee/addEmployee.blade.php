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
    <div class="row g-2">
        <div class="col-md-3 col-sm-12">
            <div class="card mt-2">
                <div class="card-body">
                    <form action="/upload" class="dropzone needsclick" id="pic-employee">
                        <div class="dz-message needsclick">
                            อัพโหลดรูปพนักงาน
                            <span class="note needsclick">(กรณีต้องการเพิ่มรูปภาพพนักงาน)</span>
                        </div>
                        <div class="fallback">
                            <input name="file" type="file" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-9 col-sm-12">
            <div class="bs-stepper wizard-vertical vertical wizard-vertical-icons-example mt-2">
                <div class="bs-stepper-header">
                    <div class="step" data-target="#account-details-vertical">
                        <button type="button" class="step-trigger">
                            <span class="bs-stepper-circle">
                                <i class="bx bx-detail"></i>
                            </span>
                            <span class="bs-stepper-label mt-1">
                                <span class="bs-stepper-title">ข้อมูลพนักงาน</span>
                                <span class="bs-stepper-subtitle">เพิ่มข้อมูลพนักงานภายในระบบ</span>
                            </span>
                        </button>
                    </div>
                    <div class="line"></div>
                    <div class="step" data-target="#personal-info-vertical">
                        <button type="button" class="step-trigger">
                            <span class="bs-stepper-circle">
                                <i class="bx bx-user"></i>
                            </span>
                            <span class="bs-stepper-label mt-1">
                                <span class="bs-stepper-title">ข้อมูลส่วนบุคคล (เบื้องต้น)</span>
                                <span class="bs-stepper-subtitle">เพิ่มข้อมูลส่วนบุคคล <strong>(เบื้องต้น)</strong></span>
                            </span>
                        </button>
                    </div>
                    <div class="line"></div>
                </div>
                <div class="bs-stepper-content">
                    <form onSubmit="return false">
                        <!-- Account Details -->
                        <div id="account-details-vertical" class="content">
                            <div class="content-header mb-3">
                                <h6 class="mb-0">ข้อมูลพนักงาน</h6>
                                <small>กรอกข้อมูลพนักงานภายในระบบ</small>
                            </div>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label" for="emp_code">รหัสพนักงาน</label>
                                    <input type="text" name="emp_code" id="emp_code" class="form-control" autocomplete="off"
                                       >
                                </div>


                                <div class="col-md-4">
                                    <label class="form-label" for="company">บริษัท</label>
                                    <select id="company" name="company" class="form-select select2" autocomplete="off"
                                        data-allow-clear="true">
                                        <option value="">Select</option>
                                        @foreach ($dataCompany as $key => $value)
                                            <option value="{{ $value->ID }}">
                                                {{ $value->company_name_th }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="department">สังกัด / ฝ่าย</label>
                                    <select id="department" name="department" class="form-select select2" autocomplete="off"
                                        data-allow-clear="true">
                                        <option value="">Select</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="groupOfDepartment">แผนก</label>
                                    <select id="groupOfDepartment" name="groupOfDepartment" class="form-select select2" autocomplete="off"
                                        data-allow-clear="true">
                                        <option value="">Select</option>
                                    </select>
                                </div>
                                <input type="text" name="mapIDGroup" id="mapIDGroup" autocomplete="off" hidden>
                                <div class="col-md-4">
                                    <label class="form-label" for="classList">ระดับ</label>
                                    <select id="classList" name="classList" class="form-select select2" autocomplete="off"
                                        data-allow-clear="true">
                                        <option value="">Select</option>
                                        @foreach ($dataClassList as $key => $value)
                                            <option value="{{ $value->ID }}">
                                                {{ $value->class_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="emp_code">ตำแหน่ง</label>
                                    <input type="text" name="emp_code" id="emp_code" class="form-control" autocomplete="off"
                                       >
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="emp_code">วันที่เริ่มทำงาน</label>

                                    <input type="text" class="form-control" autocomplete="off"  placeholder="YYYY-MM-DD" id="flatpickrDate1"
                                        />
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="emp_code">วันที่สิ้นสุดการทำงาน</label>

                                    <input type="text" class="form-control" autocomplete="off"  placeholder="YYYY-MM-DD"
                                        id="flatpickrDate2" />
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="language1">การเข้าสู่ระบบ</label>

                                    <select id="statusLogin" name="statusLogin" class="form-select select2" autocomplete="off"
                                        data-allow-clear="true">
                                        <option label=" "></option>
                                        <option>เปิดใช้งาน</option>
                                        <option>ปิดใช้งาน</option>
                                    </select>
                                </div>
                                <div class="col-12 d-flex justify-content-between">
                                    <button class="btn btn-label-secondary btn-prev" disabled>
                                        <i class="bx bx-chevron-left bx-sm ms-sm-n2"></i>
                                        <span class="align-middle d-sm-inline-block d-none">ก่อนหน้า</span>
                                    </button>
                                    <button class="btn btn-primary btn-next">
                                        <span class="align-middle d-sm-inline-block d-none me-sm-1">ถัดไป</span>
                                        <i class="bx bx-chevron-right bx-sm me-sm-n2"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- Personal Info -->
                        <div id="personal-info-vertical" class="content">
                            <div class="content-header mb-3">
                                <h6 class="mb-0">ข้อมูลส่วนบุคคล (เบื้องต้น)</h6>
                                <small>กรอกข้อมูลส่วนบุคคล (เบื้องต้น)</small>
                            </div>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label" for="prefixName">คำนำหน้าชื่อ</label>

                                    <select id="prefixName" name="prefixName" class="form-select select2" autocomplete="off"
                                        data-allow-clear="true">
                                        <option value="">Select</option>
                                        @foreach ($dataPrefixName as $key => $value)
                                            <option value="{{ $value->ID }}">
                                                {{ $value->prefix_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label" for="first-name1">ชื่อ</label>
                                    <input type="text" id="first-name1" class="form-control" autocomplete="off" />
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="last-name1">นามสกุล</label>
                                    <input type="text" id="last-name1" class="form-control" autocomplete="off"  />
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="birthday">วัน/เดือน/ปีเกิด</label>
                                    <input type="text" name="birthday" id="birthday" class="form-control" autocomplete="off"
                                        placeholder="YYYY-MM-DD" />
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="age">อายุ (ปี)</label>
                                    <input type="text" id="age" name="age" class="form-control" autocomplete="off"  disabled/>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="last-name1">อีเมล</label>
                                    <input type="text" id="last-name1" class="form-control" autocomplete="off"  />
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="last-name1">เบอร์โทรศัพท์</label>
                                    <input type="text" id="last-name1" class="form-control" autocomplete="off"  />
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="last-name1">ที่อยู่ปัจจุบัน</label>
                                    <input type="text" id="last-name1" class="form-control" autocomplete="off"  />
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label" for="province">จังหวัด</label>
                                    <select id="province" name="province" class="form-select select2" autocomplete="off"
                                        data-allow-clear="true">
                                        <option value="">Select</option>
                                        @foreach ($provinceName as $key => $value)
                                            <option value="{{ $value->province_code }}">
                                                {{ $value->province }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="amphoe">อำเภอ</label>
                                    <select id="amphoe" name="amphoe" class="form-select select2" autocomplete="off"
                                        data-allow-clear="true">
                                        <option value="">Select</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="tambon">ตำบล</label>
                                    <select id="tambon" name="tambon" class="form-select select2" autocomplete="off"
                                        data-allow-clear="true">
                                        <option value="">Select</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="zipcode">หมายเลขไปรษณีย์</label>
                                    <input type="text" id="zipcode" name="zipcode" class="form-control" autocomplete="off"  readonly
                                        />
                                    <input type="text" id="mapIDProvince" name="mapIDProvince" autocomplete="off" hidden readonly
                                        />
                                </div>

                                <input type="text" name="baseimg" id="baseimg">
                                <div class="col-12 d-flex justify-content-between">
                                    <button class="btn btn-primary btn-prev">
                                        <i class="bx bx-chevron-left bx-sm ms-sm-n2"></i>
                                        <span class="align-middle d-sm-inline-block d-none">ก่อนหน้า</span>
                                    </button>
                                    <button class="btn btn-success btn-submit">บันทึกข้อมูล</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript"
        src="{{ asset('/assets/custom/employee/employee_add_page.js?v=') }}@php echo date("H:i:s") @endphp"></script>
    <script>
        mapSelectedProvince('#amphoe', '#province', true)
        mapSelectedAumphoe('#tambon', '#amphoe', true)
        mapSelectedCompanyDepartment('#department','#company',true)
        mapSelectedDepartmentGroup('#groupOfDepartment','#department',true)

        function calculateAge(birthday) {
            var today = new Date();
            var birthDate = new Date(birthday);
            var age = today.getFullYear() - birthDate.getFullYear();
            var m = today.getMonth() - birthDate.getMonth();
            if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }
            return age;
        }

        // เพิ่ม event listener เมื่อมีการเปลี่ยนแปลงของ input ของวันเดือนปีเกิด
        document.getElementById("birthday").addEventListener("change", function() {
            var birthday = this.value;
            var age = calculateAge(birthday);
            document.getElementById("age").value = age;
        });
    </script>
@endsection