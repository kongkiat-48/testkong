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
                        return '<button type="button" class="btn btn-icon btn-label-warning btn-outline-warning" onclick="funcEditCompany(' + row.ID + ')"><span class="tf-icons bx bx-edit-alt"></span></button> '+
                        '<button type="button" class="btn btn-icon btn-label-danger btn-outline-danger" onclick="funcDeleteCompany(' + row.ID + ')"><span class="tf-icons bx bx-trash"></span></button>';
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
                [3, "desc"]
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
                        return '<button type="button" class="btn btn-icon btn-label-warning btn-outline-warning" onclick="fcGetEdit(' + row.ID + ')"><span class="tf-icons bx bx-edit-alt"></span></button>';
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
                        return '<button type="button" class="btn btn-icon btn-label-warning btn-outline-warning" onclick="fcGetEdit(' + row.ID + ')"><span class="tf-icons bx bx-edit-alt"></span></button>';
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
});


function reTable() {
    $('.dt-settingCompany').DataTable().ajax.reload();
    $('.dt-settingDepartment').DataTable().ajax.reload();
    $('.dt-settingGroup').DataTable().ajax.reload();
}

