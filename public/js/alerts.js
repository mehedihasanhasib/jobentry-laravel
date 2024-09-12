function sweetAlert(){
    Swal.fire({
        title: 'Success!',
        text: 'Your action was successful!',
        icon: 'success',
        confirmButtonText: 'Okay',
        customClass: {
            container: 'sweet-alert-container',
            popup: 'sweet-alert-popup',
            header: 'sweet-alert-header',
            title: 'sweet-alert-title',
            close: 'sweet-alert-close',
            icon: 'sweet-alert-icon',
            image: 'sweet-alert-image',
            content: 'sweet-alert-content',
            input: 'sweet-alert-input',
            actions: 'sweet-alert-actions',
            confirmButton: 'sweet-alert-confirm-button',
            cancelButton: 'sweet-alert-cancel-button',
            footer: 'sweet-alert-footer'
        },
        showClass: {
            popup: 'animate__animated animate__fadeInDown'
        },
        hideClass: {
            popup: 'animate__animated animate__fadeOutUp'
        }
    })
}

function notification(){
    Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: 'Your action was successful!',
        toast: true,
        position: 'top-end',
        timer: 5000,
        timerProgressBar: true,
        showConfirmButton: false,
        showCloseButton: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        },
        customClass: {
            toast: 'sweet-alert-popup',
        },
        showClass: {
            popup: 'animate__animated animate__fadeInDown'
        },
        hideClass: {
            popup: 'animate__animated animate__fadeOutUp'
        }
    })
}