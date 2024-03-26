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
