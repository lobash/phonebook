$(document).ready(function () {

    $(document).on('click', '.js-add_new', function () {
        showForm();
    });

    $(document).on('click', '.js-logout', function (e) {
        e.preventDefault();
        logout();
    });

    $(document).on('submit', '#form_add', function (e) {
        e.preventDefault();
        addNewPhone.call(this);
    });

    $(document).on('click', '.js-remove', function () {
        removePhone.call(this);
    });

    $(document).on('click', '.js-view', function () {
        showView.call(this);
    });


    function showView() {
        let id = $(this).data('id'),
            csrf = $(this).data('csrf');

        $.ajax({
            method: 'POST',
            url: '/phone/view',
            data: {
                'id': id,
                'csrf': csrf
            },
            dataType: 'JSON',
            success: function (response) {
                $.fancybox.open(response);
            },
            error: function () {
                alert('вся информация есть на списке, данная кнопка просто фича)');
            }
        });
    }


    function removePhone() {
        let needDelete = confirm('Удалить элемент?'),
            $this = $(this),
            id = $this.data('id'),
            csrf = $this.data('csrf');


        if (needDelete === true) {
            $.ajax({
                method: 'POST',
                url: '/phone/delete',
                data: {
                    'id': id,
                    'csrf': csrf
                },
                dataType: 'JSON',
                success: function () {
                    $this.parents('.js-item').hide('slow');
                },
                error: function () {
                    alert('произошла ошибка, попробуйте в другой раз');
                }
            });
        }
    }


    function addNewPhone() {
        let form = $(this),
            formData = new FormData(form[0]),
            imageInput = form.find('#image');

        formData.delete('image');
        if (typeof imageInput[0].files !== 'undefined') {
            formData.append('image', imageInput[0].files[0]);
        }

        $.ajax({
            type: 'POST',
            url: 'phone/add',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                $.fancybox.close(500);
                $('.js-list').prepend(response);
            },
            error: function () {
                alert("произошла ошибка, попробуйте позже");
            }
        });
    }

    function showForm() {
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: 'phone/showForm',
            success: function (response) {
                $.fancybox.open(response, {
                    afterShow: function () {
                        validateFormPhone();
                    },
                });
            },
            error: function () {
                alert("произошла ошибка, попробуйте позже");
            }
        });
    }

    function logout() {
        $.ajax({
            method: 'POST',
            url: '/auth/logout',
            dataType: 'JSON',
            success: function (response) {
                if (response === 'success') {
                    window.location.reload();
                }
            },
            error: function () {
                alert('Ошибка, попробуй  ещё раз');
            }
        });
    }
});