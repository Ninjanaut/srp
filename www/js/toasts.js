function toastError(message, options) {
    Swal.mixin({
        toast: true,
        position: 'top-end',
        showCloseButton: true,
        showConfirmButton: false,
        icon: 'error',
        title: message,
        ...options
    }).fire();
}

function toastSuccess(message, options) {
    Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
        icon: 'success',
        title: message,
        ...options
    }).fire();
}