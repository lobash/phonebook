$(document).ready(function () {

    function sendRegisterForm() {
        let form = $(this),
            formData = new FormData(form[0]);

        $.ajax({
            method: 'POST',
            url: '/register/add',
            data: formData,
            dataType: 'JSON',
            processData: false,
            contentType: false,
            success: function (response) {
                if (response.error === '') {
                    window.location.href = '/';
                } else {
                    alert(response.error)
                }
            },
            error: function () {
                alert('Ошибка, попробуйте ещё раз');
            }
        });
    }

    function sendAuthForm() {
        let form = $(this),
            formData = new FormData(form[0]);

        $.ajax({
            method: 'POST',
            url: '/auth/login',
            data: formData,
            dataType: 'JSON',
            processData: false,
            contentType: false,
            success: function (response) {
                if (typeof response.error !== 'undefined' && response.error !== '') {
                    alert(response.error)
                } else {
                    window.location.reload();
                }
            },
            error: function () {
                alert('Ошибка, попробуйте ещё раз');
            }
        });
    }

    $(document).on('submit', '#register_form', function (e) {
        e.preventDefault();
        sendRegisterForm.call(this);
    });

    $(document).on('submit', '#auth_form', function (e) {
        e.preventDefault();
        sendAuthForm.call(this);
    });

});