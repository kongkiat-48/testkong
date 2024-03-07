'use strict';
// datatable (jquery)
$(function () {
    var dt_status_table = $('.dt-settingStatus')
    var dt_flagtype_table = $('.dt-settingFlagType')
    // DataTable
    // --------------------------------------------------------------------
    if (dt_status_table.length) {
        dt_status_table.DataTable({
            serverSide: true, // เปิด server-side processing
            searching: true,
            processing: true,
            ajax: {
                url: '/settings-system/work-status/table-work-status'
            },

            columns: [
                { data: null, orderable: false, searchable: false, width: "1%", class: "text-nowrap" },
                { data: "status_name", class: "text-nowrap" },
                {
                    render: function (data, type, full, row) {
                        var $status_number = full['status_use'];
                        var $status = {
                            it: { title: 'ใช้งานฝ่าย IT', class: 'bg-label-info' },
                            building: { title: 'ใช้งานฝ่ายอาคาร', class: ' bg-label-warning' },
                            all: { title: 'ใช้งานทุกระบบ', class: ' bg-label-success' },
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
                    render: function (data, type, full, row) {
                        var $status_number = full['flag_type'];
                        var $status = {
                            Complete: { title: 'ดำเนินงานเสร็จสิ้น', class: 'bg-label-success' },
                            Waiting: { title: 'อยู่ระหว่างดำเนินงาน', class: 'bg-label-warning' },
                            Cancel: { title: 'ยกเลิกงาน / การแจ้ง', class: 'bg-label-danger' },
                            Other: { title: 'อื่น ๆ', class: 'bg-label-info' },
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

    if (dt_flagtype_table.length) {
        dt_flagtype_table.DataTable({
            serverSide: true, // เปิด server-side processing
            searching: true,
            processing: true,
            ajax: {
                url: '/settings-system/work-status/table-flag-type'
            },

            columns: [
                { data: null, orderable: false, searchable: false, width: "1%", class: "text-nowrap" },
                { data: "flag_name", class: "text-nowrap" },
                // { data: "type_work", class: "text-nowrap" },
                {
                    render: function (data, type, full, row) {
                        var $type_work = full['type_work'];
                        var $type = {
                            Complete: { title: 'Complete', class: 'bg-label-success' },
                            Hold: { title: 'Hold', class: 'bg-label-warning' },
                            Doing: { title: 'Doing', class: 'bg-label-primary' },
                            Wating: { title: 'Wating', class: 'bg-label-warning' },
                            Cancel: { title: 'Cancel', class: 'bg-label-danger' },
                            Other: { title: 'Other', class: 'bg-label-info' },
                        };
                        if (typeof $type[$type_work] === 'undefined') {
                            return '<span class="badge bg-label-secondary">Undefined</span>'
                        }
                        return (
                            '<span class="badge ' + $type[$type_work].class + '">' + $type[$type_work].title + '</span>'
                        );

                    }
                },

                {
                    data: 'ID', orderable: false, searchable: false, width: "1%", class: "text-nowrap",
                    render: function (data, type, row) {
                        return '<button type="button" class="btn btn-icon btn- btn-label-warning btn-outline-warning" onclick="fcGetEditFT(' + row.ID + ')"><span class="tf-icons bx bx-edit-alt"></span></button>';
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

    var formSection = $('.form-block-add-status'),
        formBlockOverlay = $('.btn-form-block-overlay-add-status')

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
    $("#saveStatus").on("click", function (e) {
        $('.fv-plugins-message-container.invalid-feedback').remove();
        $('.is-invalid').removeClass('is-invalid');
        var form = $("#formAddStatus")[0];
        var fv = FormValidation.formValidation(form, {
            fields: {
                statusName: {
                    validators: {
                        notEmpty: {
                            message: 'ระบุชื่อ รายการสถานะ'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z0-9ก-๏\s]+$/,
                            message: 'ข้อมูลไม่ถูกต้อง'
                        }
                    }
                },
                statusUse: {
                    validators: {
                        notEmpty: {
                            message: 'เลือกข้อมูล รูปแบบการใช้งาน'
                        }
                    }
                },
                statusWS: {
                    validators: {
                        notEmpty: {
                            message: 'เลือกข้อมูล สถานะการใช้งาน'
                        }
                    }
                },
                flagType: {
                    validators: {
                        notEmpty: {
                            message: 'เลือกข้อมูล FlagType'
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
                    url: "/settings-system/work-status/save-work-status",
                    method: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        if (response.status === 200) {
                            Swal.fire({
                                icon: 'success',
                                title: 'บันทึกข้อมูลสำเร็จ',
                                showConfirmButton: false,
                                timer: 2500,
                                willClose: function () {
                                    location.reload();
                                }
                            });
                            // $('#addStatus').modal('hidde');
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'เกิดข้อผิดพลาดในการบันทึกข้อมูล',
                                text: 'โปรดลองอีกครั้ง',
                            });
                        }
                    },
                    error: function (xhr, status, error) {
                        console.log(xhr);
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
});

$(document).ready(function () {
    $("#saveFlagType").on("click", function (e) {
        $('.fv-plugins-message-container.invalid-feedback').remove();
        $('.is-invalid').removeClass('is-invalid');
        var form = $("#formAddFlagType")[0];
        var fv = FormValidation.formValidation(form, {
            fields: {
                flagName: {
                    validators: {
                        notEmpty: {
                            message: 'ระบุชื่อ ชื่อรายการรูปแบบสถานะงาน'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z0-9ก-๏\s]+$/,
                            message: 'ข้อมูลไม่ถูกต้อง'
                        }
                    }
                },
                typeWork: {
                    validators: {
                        notEmpty: {
                            message: 'เลือกข้อมูล รูปแบบของสถานะ'
                        }
                    }
                },
            },
            plugins: {
                trigger: new FormValidation.plugins.Trigger(),
                bootstrap5: new FormValidation.plugins.Bootstrap5({
                    eleValidClass: '',
                    rowSelector: '.col-6'
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
                    url: "/settings-system/work-status/save-flag-type",
                    method: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        if (response.status === 200) {
                            Swal.fire({
                                icon: 'success',
                                title: 'บันทึกข้อมูลสำเร็จ',
                                showConfirmButton: false,
                                timer: 2500,
                                willClose: function () {
                                    location.reload();
                                }
                            });
                            // $('#addStatus').modal('hidde');
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'เกิดข้อผิดพลาดในการบันทึกข้อมูล',
                                text: 'โปรดลองอีกครั้ง',
                            });
                        }
                    },
                    error: function (xhr, status, error) {
                        console.log(xhr);
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
});

function fcGetEdit(statusID) {
    $('.fv-plugins-message-container.invalid-feedback').remove();
    $('.is-invalid').removeClass('is-invalid');

    var form = $("#formEditStatus")[0];
    var fvEdit = new FormValidation.formValidation(form, {
        fields: {
            edit_statusName: {
                validators: {
                    notEmpty: {
                        message: 'ระบุชื่อ รายการสถานะ'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9ก-๏\s]+$/,
                        message: 'ข้อมูลไม่ถูกต้อง'
                    }
                }
            },
            edit_statusUse: {
                validators: {
                    notEmpty: {
                        message: 'เลือกข้อมูล รูปแบบการใช้งาน'
                    }
                }
            },
            edit_statusWS: {
                validators: {
                    notEmpty: {
                        message: 'เลือกข้อมูล สถานะการใช้งาน'
                    }
                }
            },
            edit_flagType: {
                validators: {
                    notEmpty: {
                        message: 'เลือกข้อมูล FlagType'
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
        },
        autoFocus: new FormValidation.plugins.AutoFocus()
    });

    $.ajax({
        url: '/settings-system/work-status/show-edit-status/' + statusID,
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            $('#edit_statusName').val(data[0].status_name);
            $('#edit_statusUse').val(data[0].status_use).trigger('change');
            $('#edit_status').val(data[0].status).trigger('change');
            $('#edit_flagType').val(data[0].flag_type).trigger('change');

            $('#editStatusModal').modal('show');
        },
        error: function (xhr, status, error) {
            console.error('เกิดข้อผิดพลาดในการดึงข้อมูล:', error);
        }
    });

    $("#save_edit").on("click", function (e) {
        var formData = new FormData(form);
        e.preventDefault();
        fvEdit.validate().then(function (status) {
            if (status === 'Valid') {
                $.ajax({
                    url: '/settings-system/work-status/edit-work-status/' + statusID,
                    method: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        if (response.status === 200) {
                            Swal.fire({
                                icon: 'success',
                                title: 'บันทึกข้อมูลสำเร็จ',
                                showConfirmButton: false,
                                timer: 2500,
                                willClose: function () {
                                    location.reload();
                                }
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'เกิดข้อผิดพลาดในการบันทึกข้อมูล',
                                text: 'โปรดลองอีกครั้ง',
                            });
                        }
                    },
                    error: function (xhr, status, error) {
                        console.log(xhr);
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
}

function fcGetEditFT(flagID) {
    // alert(flagID)
    $('.fv-plugins-message-container.invalid-feedback').remove();
    $('.is-invalid').removeClass('is-invalid');

    var form = $("#formEditFlagType")[0];
    var fvEdit = new FormValidation.formValidation(form, {
        fields: {
            edit_flagName: {
                validators: {
                    notEmpty: {
                        message: 'ระบุชื่อ ชื่อรายการรูปแบบสถานะงาน'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9ก-๏\s]+$/,
                        message: 'ข้อมูลไม่ถูกต้อง'
                    }
                }
            },
            edit_typeWork: {
                validators: {
                    notEmpty: {
                        message: 'เลือกข้อมูล รูปแบบของสถานะ'
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
        },
        autoFocus: new FormValidation.plugins.AutoFocus()
    });
    $.ajax({
        url: '/settings-system/work-status/show-edit-flag-type/' + flagID,
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            $('#edit_flagName').val(data[0].flag_name);
            $('#edit_typeWork').val(data[0].type_work).trigger('change');

            $('#editFlagTypeModal').modal('show');
        },
        error: function (xhr, status, error) {
            console.error('เกิดข้อผิดพลาดในการดึงข้อมูล:', error);
        }
    });

    $("#editFlagType").on("click", function (e) {
        var formData = new FormData(form);
        e.preventDefault();
        fvEdit.validate().then(function (status) {
            if (status === 'Valid') {
                $.ajax({
                    url: '/settings-system/work-status/edit-flag-type/' + flagID,
                    method: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        if (response.status === 200) {
                            Swal.fire({
                                icon: 'success',
                                title: 'บันทึกข้อมูลสำเร็จ',
                                showConfirmButton: false,
                                timer: 2500,
                                willClose: function () {
                                    location.reload();
                                }
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'เกิดข้อผิดพลาดในการบันทึกข้อมูล',
                                text: 'โปรดลองอีกครั้ง',
                            });
                        }
                    },
                    error: function (xhr, status, error) {
                        console.log(xhr);
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
}
