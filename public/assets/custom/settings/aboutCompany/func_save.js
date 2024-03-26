$(document).ready(function () {
    $("#saveCompany").on("click", function (e) {
        e.preventDefault();
        removeValidationFeedback();
        const form = $("#formAddCompany")[0];
        const fv = setupFormValidationCompany(form);
        const formData = new FormData(form);

        fv.validate().then(function (status) {
            if (status === 'Valid') {
                postFormData("/settings-system/about-company/save-company", formData)
                    .done(onSaveCompanySuccess)
                    .fail(handleAjaxSaveError);
            }
        });
    });

    $("#saveDepartment").on("click", function (e) {
        e.preventDefault();
        removeValidationFeedback();
        const form = $("#formAddDepartment")[0];
        const fv = setupFormValidationDepartment(form);
        const formData = new FormData(form);

        fv.validate().then(function (status) {
            if (status === 'Valid') {
                postFormData("/settings-system/about-company/save-department", formData)
                    .done(onSaveDepartmentSuccess)
                    .fail(handleAjaxSaveError);
            }
        });
    });

    $("#saveGroup").on("click", function (e) {
        e.preventDefault();
        removeValidationFeedback();
        const form = $("#formAddGroup")[0];
        const fv = setupFormValidationGroup(form);
        const formData = new FormData(form);

        fv.validate().then(function (status) {
            if (status === 'Valid') {
                postFormData("/settings-system/about-company/save-group", formData)
                    .done(onSaveGroupSuccess)
                    .fail(handleAjaxSaveError);
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

function onSaveCompanySuccess(response) {
    handleAjaxSaveResponse(response);
    closeAndResetModal("#addCompanyModal", "#formAddCompany");
}
function onSaveDepartmentSuccess(response) {
    handleAjaxSaveResponse(response);
    closeAndResetModal("#addDepartmentModal", "#formAddDepartment");
}
function onSaveGroupSuccess(response) {
    handleAjaxSaveResponse(response);
    closeAndResetModal("#addGroupModal", "#formAddGroup");
}

function setupFormValidationCompany(formElement) {
    return FormValidation.formValidation(formElement, {
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
            autoFocus: new FormValidation.plugins.AutoFocus()
        },
    });
}

function setupFormValidationDepartment(formElement) {
    return FormValidation.formValidation(formElement, {
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
}

function setupFormValidationGroup(formElement) {
    return FormValidation.formValidation(formElement, {
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
}
