$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


const showConfirmationDialog = (title, text, icon, confirmButtonText, callback) => {
    Swal.fire({
        title,
        text,
        icon,
        showCancelButton: true,
        buttonsStyling: false,
        confirmButtonText,
        cancelButtonText: "No, cancel",
        customClass: {
            confirmButton: "btn fw-bold btn-danger",
            cancelButton: "btn fw-bold btn-active-light-primary",
        },
    }).then(callback);
};

const showSuccessDialog = (title, text, icon, confirmButtonText, callback) => {
    Swal.fire({
        title,
        text,
        icon,
        showCancelButton: false,
        buttonsStyling: false,
        confirmButtonText,
        customClass: {
            confirmButton: "btn fw-bold btn-primary",
        },
    }).then(callback);
};

const showErrorDialog = (title, text, icon, confirmButtonText, callback) => {
    Swal.fire({
        title,
        text,
        icon,
        showCancelButton: false,
        buttonsStyling: false,
        confirmButtonText,
        customClass: {
            confirmButton: "btn fw-bold btn-danger",
        },
    }).then(callback);
};

const ajaxRequest = (url, method, successCallback, errorCallback, data = {}, btn = null) => {
    $.ajax({
        url,
        method,
        data,
        beforeSend: () => {
            if (btn) {
                btn.attr("data-kt-indicator", "on");
                btn.prop("disabled", true);
            }
        },
        success: successCallback,
        error: errorCallback,
    }).always(() => {
        if (btn) {
            btn.attr("data-kt-indicator", "off");
            btn.prop("disabled", false);
        }
    });
};

const handleAction = (url, method, successMessage, errorMessage, data = {}, btn = null, callback = null) => {
    ajaxRequest(url, method,
        (response) => {
            if (response.status === "success") {
                showSuccessDialog('Success!', successMessage, 'success', 'Ok', (result) => {
                    if (result.isConfirmed) {
                        if (response.redirect) {
                            window.location.href = response.redirect;
                        } else {
                            if (callback) {
                                callback();
                            }
                        }
                    }
                });
            } else {
                showErrorDialog('Error!', response.message, 'error', 'Ok');
            }
        },
        (xhr) => {
            const res = xhr.responseJSON;
            if (!$.isEmptyObject(res)) {
                $.each(res.errors, (key, value) => {
                    showErrorDialog('Error!', value, 'error', 'Ok');
                });
            } else {
                showErrorDialog('Error!', errorMessage, 'error', 'Ok');
            }
        },
        data,
        btn
    );
};

const handleDelete = (url, successMessage, errorMessage, data = {}, btn = null, callback = null) => {
    showConfirmationDialog('Are you sure?', 'You won\'t be able to revert this!', 'warning', 'Yes, delete it!', (result) => {
        if (result.isConfirmed) {
            handleAction(url, 'DELETE', successMessage, errorMessage, data, btn, callback);
        }
    });
}

const openModal = (url, modal, method = 'GET') => {
    $.ajax({
        url,
        method,
        success: (response) => {
            $(modal).html(response);
            $(modal).modal('show');
        },
        error: (xhr) => {
            const res = xhr.responseJSON;
            if (!$.isEmptyObject(res)) {
                $.each(res.errors, (key, value) => {
                    showErrorDialog('Error!', value, 'error', 'Ok');
                });
            } else {
                showErrorDialog('Error!', 'Something went wrong!', 'error', 'Ok');
            }
        },
    });
}
