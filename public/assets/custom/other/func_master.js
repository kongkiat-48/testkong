function handleAjaxSaveResponse(response) {
    const isSuccess = response.status === 200;
    Swal.fire({
        icon: isSuccess ? 'success' : 'error',
        text: isSuccess ? 'บันทึกข้อมูลสำเร็จ' : 'เกิดข้อผิดพลาดในการบันทึกข้อมูล',
        showConfirmButton: false,
        timer: isSuccess ? 2500 : undefined
    });
    if (isSuccess) {
        reTable();
    }
}

function handleAjaxEditResponse(response) {
    const isSuccess = response.status === 200;
    Swal.fire({
        icon: isSuccess ? 'success' : 'error',
        text: isSuccess ? 'แก้ไขข้อมูลสำเร็จ' : 'เกิดข้อผิดพลาดในการแก้ไขข้อมูล',
        showConfirmButton: false,
        timer: isSuccess ? 2500 : undefined
    });
    if (isSuccess) {
        reTable();
    }
}

function handleAjaxDeleteResponse(itemId, deleteUrl) {
    Swal.fire({
        text: "ยืนยันการลบข้อมูล",
        icon: "question",
        showCancelButton: true,
        cancelButtonText: "ยกเลิก",
        confirmButtonText: "ยืนยัน",
        showLoaderOnConfirm: true,
        preConfirm: () => {
            return postFormData(deleteUrl, itemId)
                .then(response => {
                    if (response.status === 200) {
                        Swal.fire({
                            text: "ลบข้อมูลสำเร็จ",
                            icon: "success",
                            confirmButtonText: "ตกลง",
                        });
                        reTable();
                    } else {
                        throw new Error(response.message);
                    }
                })
                .catch(() => {
                    handleAjaxSaveError();
                });
        },
    });
}

function handleAjaxSaveError(xhr, textStatus, errorThrown) {
    Swal.fire({
        icon: 'error',
        title: 'เกิดข้อผิดพลาดในการบันทึกข้อมูล',
        text: 'โปรดลองอีกครั้งหรือติดต่อผู้ดูแลระบบ',
    });
}

function closeAndResetModal(modalSelector, formSelector) {
    setTimeout(function () {
        $(modalSelector).modal('hide');
        $(formSelector).find('input, select').val('').trigger('change');
    }, 3000);
}

function applyBlockUI(selector, options) {
    $(selector).block(options);
}

$(document).on('click', '.btn-form-block-overlay', function () {
    var defaultOptions = {
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
    };

    var formSection = $('.form-block');
    if (formSection.length) {
        applyBlockUI(formSection, defaultOptions);
    }
});

function removeValidationFeedback() {
    $('.fv-plugins-message-container.invalid-feedback').remove();
    $('.is-invalid').removeClass('is-invalid');
}

function postFormData(url, formData) {
    return $.ajax({
        url: url,
        method: "POST",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: formData,
        contentType: false,
        processData: false
    });
}

function showModalWithAjax(modalId, url, select2Selectors) {
    $.ajax({
        url: url,
        method: 'GET',
        success: function (response) {
            $(modalId + ' .modal-dialog').html(response);
            initializeSelect2(select2Selectors, modalId);
            $(modalId).modal('show');
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}

function initializeSelect2(selectors, modalId) {
    if (!Array.isArray(selectors)) {
        console.error('initializeSelect2 expects the first argument to be an array of selectors.');
        return;
    }
    if (!modalId || !$(modalId).length) {
        console.error('initializeSelect2 expects a valid modalId as the second argument.');
        return;
    }

    selectors.forEach(function (selector) {
        var $selectElement = $(selector, modalId);
        if ($selectElement.length) {
            $selectElement.select2({
                dropdownParent: $(modalId),
                allowClear: true,
                placeholder: "เลือกข้อมูล"
            });
        } else {
            console.warn('Selector not found:', selector);
        }
    });
}
function renderStatusBadge(data, type, full, row) {
    const statusMap = {
        1: { title: 'กำลังใช้งาน', className: 'bg-label-success' },
        0: { title: 'ปิดการใช้งาน', className: 'bg-label-danger' }
    };
    const status = statusMap[data] || { title: 'Undefined', className: 'bg-label-secondary' };
    return `<span class="badge ${status.className}">${status.title}</span>`;
}

function renderGroupActionButtons(data, type, row, useFunc) {
    // console.log(useFunc)
    const editFunction =  `funcEdit${useFunc}`;
    const deleteFunction =  `funcDelete${useFunc}`;
    return `
    <button type="button" class="btn btn-icon btn-label-warning btn-outline-warning" onclick="${editFunction}(${row.ID})">
        <span class="tf-icons bx bx-edit-alt"></span>
    </button>
    <button type="button" class="btn btn-icon btn-label-danger btn-outline-danger" onclick="${deleteFunction}(${row.ID})">
        <span class="tf-icons bx bx-trash"></span>
    </button>
`;
}

function mapSelectedCompanyDepartment(disabledElement, selectElement, disableStatus) {
    var originalContent = $(disabledElement).html();
    $(disabledElement).prop('disabled', disableStatus);
    $(selectElement).on('change', function () {
        var companyID = $(this).val();
        var $departmentSelect = $(disabledElement);
        $departmentSelect.prop('disabled', !companyID);

        if (companyID) {
            $.ajax({
                url: '/getMaster/get-department/' + companyID,
                type: 'GET',
                dataType: 'json',
                success: function (departmentsData) {
                    $departmentSelect.empty().append('<option value="">Select</option>');
                    departmentsData.forEach(function (department) {
                        var optionElement = $('<option>').val(department.ID).text(department.departmentName);
                        $departmentSelect.append(optionElement);
                    });
                },
                error: function () {
                    $departmentSelect.html(originalContent);
                }
            });
        } else {
            $departmentSelect.html(originalContent);
            $departmentSelect.empty().append('<option value="">Select</option>');
        }
    });
}
