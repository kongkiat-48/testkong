function handleAjaxSaveResponse(response) {
    const isSuccess = response.status === 200;
    Swal.fire({
        icon: isSuccess ? 'success' : 'error',
        title: isSuccess ? 'บันทึกข้อมูลสำเร็จ' : 'เกิดข้อผิดพลาดในการบันทึกข้อมูล',
        text: isSuccess ? null : 'โปรดลองอีกครั้ง',
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
        title: isSuccess ? 'แก้ไขข้อมูลสำเร็จ' : 'เกิดข้อผิดพลาดในการแก้ไขข้อมูล',
        text: isSuccess ? null : 'โปรดลองอีกครั้ง',
        showConfirmButton: false,
        timer: isSuccess ? 2500 : undefined
    });
    if (isSuccess) {
        reTable();
    }
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
