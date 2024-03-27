function funcEditCompany(companyID) {
    $.ajax({
        url: '/settings-system/about-company/show-edit-company/' + companyID,
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            $('#edit_companyNameTH').val(data[0].company_name_th);
            $('#edit_companyNameEN').val(data[0].company_name_en);
            $('#comID').val(data[0].ID);
            $('#edit_status').val(data[0].status).trigger('change');
            $('#editCompanyModal').modal('show');
        },
        error: function (xhr, status, error) {
            console.error('เกิดข้อผิดพลาดในการดึงข้อมูล:', error);
        }
    });
}

function funcDeleteCompany(companyID) {
    handleAjaxDeleteResponse(companyID, "/settings-system/about-company/delete-company/" + companyID);
}

$(document).ready(function () {
    $("#saveEditCompany").on("click", function (e) {
        e.preventDefault();
        removeValidationFeedback();
        const form = $("#formEditCompany")[0];
        const companyID = $('#comID').val();
        const fv = setupFormValidationEditCompany(form);
        const formData = new FormData(form);

        fv.validate().then(function (status) {
            if (status === 'Valid') {
                postFormData("/settings-system/about-company/edit-company/" + companyID, formData)
                    .done(onSaveEditCompanySuccess)
                    .fail(handleAjaxSaveError);
            }
        });
    });
});

function setupFormValidationEditCompany(formElement) {
    return FormValidation.formValidation(formElement, {
        fields: {
            edit_companyNameTH: {
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
            edit_companyNameEN: {
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
            edit_status: {
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
}

function onSaveEditCompanySuccess(response) {
    handleAjaxEditResponse(response);
    closeAndResetModal("#editCompanyModal", "#formEditCompany");
}
