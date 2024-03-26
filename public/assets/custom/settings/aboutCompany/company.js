'use strict';
$(function () {
    var dt_Company_table = $('.dt-settingCompany')
    var dt_Department_table = $('.dt-settingDepartment')
    var dt_Group_table = $('.dt-settingGroup')

    if (dt_Company_table.length) {
        dt_Company_table.DataTable({
            serverSide: true, // เปิด server-side processing
            searching: true,
            processing: true,
            ajax: {
                url: '/settings-system/about-company/table-company'
            },

            columns: [
                { data: null, orderable: false, searchable: false, width: "1%", class: "text-nowrap" },
                { data: "company_name_th", class: "text-nowrap" },
                { data: "company_name_en", class: "text-nowrap" },
                {
                    render: function (data, type, full, row) {
                        var $status_number = full['status'];
                        var $status = {
                            1: { title: 'กำลังใช้งาน', class: 'bg-label-success' },
                            0: { title: 'ปิดการใช้งาน', class: ' bg-label-danger' },
                        };
                        if (typeof $status[$status_number] === 'undefined') {
                            return '<span class="badge bg-label-secondary">Undefined</span>'
                        }
                        return (
                            '<span class="badge ' + $status[$status_number].class + '">' + $status[$status_number].title + '</span>'
                        );

                    }
                },
                {
                    data: 'id', orderable: false, searchable: false, width: "1%", class: "text-nowrap",
                    render: function (data, type, row) {
                        return '<button type="button" class="btn btn-icon btn- btn-label-warning btn-outline-warning" onclick="fcGetEdit(' + row.ID + ')"><span class="tf-icons bx bx-edit-alt"></span></button>';
                    }
                },
            ],
            // สร้างเลขลำดับในคอลัมน์แรก
            fnCreatedRow: function (nRow, aData, iDisplayIndex) {
                $('td:eq(0)', nRow).html(iDisplayIndex + 1);
            },
            pagingType: 'full_numbers', // เพิ่มค่านี้เพื่อแสดงหมายเลขหน้าแบบ full_numbers
            drawCallback: function (settings) {
                var api = this.api();
                var startIndex = api.context[0]._iDisplayStart; // รับหน้าเริ่มต้น
                api.column(0).nodes().each(function (cell, i) {
                    cell.innerHTML = startIndex + i + 1;
                });
            },
            order: [
                [2, "asc"]
            ],
            dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>><"table-responsive"t><"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            displayLength: 20,
            lengthMenu: [20, 25, 50, 75, 100]
        });
    }

    if (dt_Department_table.length) {
        dt_Department_table.DataTable({
            serverSide: true, // เปิด server-side processing
            searching: true,
            processing: true,
            ajax: {
                url: '/settings-system/about-company/table-department'
            },

            columns: [
                { data: null, orderable: false, searchable: false, width: "1%", class: "text-nowrap" },
                { data: "department_name", class: "text-nowrap" },
                { data: "company_name_th", class: "text-nowrap" },
                {
                    render: function (data, type, full, row) {
                        var $status_number = full['status'];
                        var $status = {
                            1: { title: 'กำลังใช้งาน', class: 'bg-label-success' },
                            0: { title: 'ปิดการใช้งาน', class: ' bg-label-danger' },
                        };
                        if (typeof $status[$status_number] === 'undefined') {
                            return '<span class="badge bg-label-secondary">Undefined</span>'
                        }
                        return (
                            '<span class="badge ' + $status[$status_number].class + '">' + $status[$status_number].title + '</span>'
                        );

                    }
                },
                {
                    data: 'id', orderable: false, searchable: false, width: "1%", class: "text-nowrap",
                    render: function (data, type, row) {
                        return '<button type="button" class="btn btn-icon btn- btn-label-warning btn-outline-warning" onclick="fcGetEdit(' + row.ID + ')"><span class="tf-icons bx bx-edit-alt"></span></button>';
                    }
                },
            ],
            // สร้างเลขลำดับในคอลัมน์แรก
            fnCreatedRow: function (nRow, aData, iDisplayIndex) {
                $('td:eq(0)', nRow).html(iDisplayIndex + 1);
            },
            pagingType: 'full_numbers', // เพิ่มค่านี้เพื่อแสดงหมายเลขหน้าแบบ full_numbers
            drawCallback: function (settings) {
                var api = this.api();
                var startIndex = api.context[0]._iDisplayStart; // รับหน้าเริ่มต้น
                api.column(0).nodes().each(function (cell, i) {
                    cell.innerHTML = startIndex + i + 1;
                });
            },
            order: [
                [2, "asc"]
            ],
            dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>><"table-responsive"t><"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            displayLength: 20,
            lengthMenu: [20, 25, 50, 75, 100]
        });
    }

    if (dt_Group_table.length) {
        dt_Group_table.DataTable({
            serverSide: true, // เปิด server-side processing
            searching: true,
            processing: true,
            ajax: {
                url: '/settings-system/about-company/table-group'
            },

            columns: [
                { data: null, orderable: false, searchable: false, width: "1%", class: "text-nowrap" },
                { data: "group_name", class: "text-nowrap" },
                { data: "department_name", class: "text-nowrap" },
                { data: "company_name_th", class: "text-nowrap" },
                {
                    render: function (data, type, full, row) {
                        var $status_number = full['status'];
                        var $status = {
                            1: { title: 'กำลังใช้งาน', class: 'bg-label-success' },
                            0: { title: 'ปิดการใช้งาน', class: ' bg-label-danger' },
                        };
                        if (typeof $status[$status_number] === 'undefined') {
                            return '<span class="badge bg-label-secondary">Undefined</span>'
                        }
                        return (
                            '<span class="badge ' + $status[$status_number].class + '">' + $status[$status_number].title + '</span>'
                        );

                    }
                },
                {
                    data: 'id', orderable: false, searchable: false, width: "1%", class: "text-nowrap",
                    render: function (data, type, row) {
                        return '<button type="button" class="btn btn-icon btn- btn-label-warning btn-outline-warning" onclick="fcGetEdit(' + row.ID + ')"><span class="tf-icons bx bx-edit-alt"></span></button>';
                    }
                },
            ],
            // สร้างเลขลำดับในคอลัมน์แรก
            fnCreatedRow: function (nRow, aData, iDisplayIndex) {
                $('td:eq(0)', nRow).html(iDisplayIndex + 1);
            },
            pagingType: 'full_numbers', // เพิ่มค่านี้เพื่อแสดงหมายเลขหน้าแบบ full_numbers
            drawCallback: function (settings) {
                var api = this.api();
                var startIndex = api.context[0]._iDisplayStart; // รับหน้าเริ่มต้น
                api.column(0).nodes().each(function (cell, i) {
                    cell.innerHTML = startIndex + i + 1;
                });
            },
            order: [
                [2, "asc"]
            ],
            dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>><"table-responsive"t><"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            displayLength: 20,
            lengthMenu: [20, 25, 50, 75, 100]
        });
    }

    var formSection = $('.form-block'),
        formBlockOverlay = $('.btn-form-block-overlay')

    // Overlay Color
    if (formBlockOverlay.length && formSection.length) {
        formBlockOverlay.on('click', function () {
            formSection.block({
                message: '<div class="spinner-border text-primary" role="status"></div>',
                timeout: 1000,
                css: {
                    backgroundColor: 'transparent',
                    border: '0'
                },
                overlayCSS: {
                    backgroundColor: '#fff',
                    opacity: 0.8
                }
            });
        });
    }
});

$(document).ready(function () {
    $("#saveCompany").on("click", function (e) {
        $('.fv-plugins-message-container.invalid-feedback').remove();
        $('.is-invalid').removeClass('is-invalid');
        var form = $("#formAddCompany")[0];
        var fv = FormValidation.formValidation(form, {
            fields: {
                companyNameTH: {
                    validators: {
                        notEmpty: {
                            message: 'ระบุชื่อ บริษัท (ภาษาไทย)'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z0-9ก-๏\s]+$/u,
                            message: 'ข้อมูลไม่ถูกต้อง'
                        }
                    }
                },
                companyNameEN: {
                    validators: {
                        notEmpty: {
                            message: 'ระบุชื่อ บริษัท (ภาษาอังกฤษ)'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z0-9ก-๏\s]+$/u,
                            message: 'ข้อมูลไม่ถูกต้อง'
                        }
                    }
                },
                status: {
                    validators: {
                        notEmpty: {
                            message: 'เลือกข้อมูล สถานะการใช้งาน'
                        }
                    }
                },
            },
            plugins: {
                trigger: new FormValidation.plugins.Trigger(),
                bootstrap5: new FormValidation.plugins.Bootstrap5({
                    eleValidClass: '',
                    rowSelector: '.col-md-6'
                }),
                submitButton: new FormValidation.plugins.SubmitButton(),
                // defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
                autoFocus: new FormValidation.plugins.AutoFocus()
            },
        });
        var formData = new FormData(form);
        e.preventDefault();
        fv.validate().then(function (status) {
            if (status === 'Valid') {
                $.ajax({
                    url: "/settings-system/about-company/save-company",
                    method: "POST",
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        const isSuccessful = response.status === 200;
                        const swalConfig = {
                            icon: isSuccessful ? 'success' : 'error',
                            title: isSuccessful ? 'บันทึกข้อมูลสำเร็จ' : 'เกิดข้อผิดพลาดในการบันทึกข้อมูล',
                            text: isSuccessful ? null : 'โปรดลองอีกครั้ง',
                            showConfirmButton: false,
                            timer: isSuccessful ? 2500 : undefined,
                            willClose: isSuccessful ? () => location.reload() : undefined
                        };

                        Swal.fire(swalConfig);
                    },
                    error: function (xhr, textStatus, errorThrown) {
                        Swal.fire({
                            icon: 'error',
                            title: 'เกิดข้อผิดพลาดในการบันทึกข้อมูล',
                            text: 'โปรดลองอีกครั้งหรือติดต่อผู้ดูแลระบบ',
                        });
                    }
                });
            }
        });
    });

    $("#saveDepartment").on("click", function (e) {
        $('.fv-plugins-message-container.invalid-feedback').remove();
        $('.is-invalid').removeClass('is-invalid');
        var form = $("#formAddDepartment")[0];
        var fv = FormValidation.formValidation(form, {
            fields: {
                departmentName: {
                    validators: {
                        notEmpty: {
                            message: 'ระบุชื่อสังกัด / ฝ่าย'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z0-9ก-๏\s]+$/u,
                            message: 'ข้อมูลไม่ถูกต้อง'
                        }
                    }
                },
                company: {
                    validators: {
                        notEmpty: {
                            message: 'เลือกข้อมูล บริษัท'
                        }
                    }
                },
                statusForDep: {
                    validators: {
                        notEmpty: {
                            message: 'เลือกข้อมูล สถานะการใช้งาน'
                        }
                    }
                },
            },
            plugins: {
                trigger: new FormValidation.plugins.Trigger(),
                bootstrap5: new FormValidation.plugins.Bootstrap5({
                    eleValidClass: '',
                    rowSelector: '.col-md-6'
                }),
                submitButton: new FormValidation.plugins.SubmitButton(),
                autoFocus: new FormValidation.plugins.AutoFocus()
            },
        });
        var formData = new FormData(form);
        e.preventDefault();
        fv.validate().then(function (status) {
            if (status === 'Valid') {
                $.ajax({
                    url: "/settings-system/about-company/save-department",
                    method: "POST",
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    contentType: false,
                    processData: false
                }).done(function (response) {
                    handleAjaxSaveResponse(response);
                    closeAndResetModal("#addDepartmentModal", "#formAddDepartment");
                }).fail(handleAjaxSaveError);
            }
        });
    });

    $("#saveGroup").on("click", function (e) {
        e.preventDefault();
        $('.fv-plugins-message-container.invalid-feedback').remove();
        $('.is-invalid').removeClass('is-invalid');
        var form = $("#formAddGroup")[0];
        var fv = FormValidation.formValidation(form, {
            fields: {
                groupName: {
                    validators: {
                        notEmpty: {
                            message: 'ระบุชื่อแผนก'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z0-9ก-๏\s]+$/u,
                            message: 'ข้อมูลไม่ถูกต้อง'
                        }
                    }
                },
                companyForGroup: {
                    validators: {
                        notEmpty: {
                            message: 'เลือกข้อมูล บริษัท'
                        }
                    }
                },
                department: {
                    validators: {
                        notEmpty: {
                            message: 'เลือกข้อมูล สังกัด / ฝ่าย'
                        }
                    }
                },
                statusForGroup: {
                    validators: {
                        notEmpty: {
                            message: 'เลือกข้อมูล สถานะการใช้งาน'
                        }
                    }
                },
            },
            plugins: {
                trigger: new FormValidation.plugins.Trigger(),
                bootstrap5: new FormValidation.plugins.Bootstrap5({
                    eleValidClass: '',
                    rowSelector: '.col-md-6'
                }),
                submitButton: new FormValidation.plugins.SubmitButton(),
                autoFocus: new FormValidation.plugins.AutoFocus()
            },
        });
        var formData = new FormData(form);
        fv.validate().then(function (status) {
            if (status === 'Valid') {
                $.ajax({
                    url: "/settings-system/about-company/save-group",
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formData,
                    contentType: false,
                    processData: false
                }).done(function (response) {
                    handleAjaxSaveResponse(response);
                    closeAndResetModal("#addGroupModal", "#formAddGroup");
                }).fail(handleAjaxSaveError);
            }
        });
    });

    var originalCompany = $('#department').html();
    $('#department').prop('disabled', true);
    $('#companyForGroup').change(function () {
        var companyID = $(this).val();
        if (companyID) {
            $.ajax({
                url: '/getMaster/get-department/' + companyID,
                type: 'GET',
                dataType: 'json',
                success: function (departmentsData) {
                    var $departmentSelect = $('#department');
                    $departmentSelect.empty().append('<option value="">Select</option>');

                    $.each(departmentsData, function (index, department) {
                        $departmentSelect.append($('<option>', {
                            value: department.ID,
                            text: department.departmentName
                        }));
                    });

                    $departmentSelect.prop('disabled', false);
                }
            });
        } else {
            $('#department').html(originalCompany);
            $('#department').prop('disabled', true);
            $('#department').html('<option value="">Select</option>');
        }
    });
});

function reTable() {
    $('.dt-settingCompany').DataTable().ajax.reload();
    $('.dt-settingDepartment').DataTable().ajax.reload();
    $('.dt-settingGroup').DataTable().ajax.reload();
}

