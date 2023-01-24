$(document).ready(function() {

    var v = $(".sendForm").validate({
        rules: {
            name: {
                required: true,
            },
            lastName: {
                required: true,
            },
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 5
            },
            confirmPassword: {
                required: true,
                minlength: 5,
                equalTo: "#password"
            }
        },
        messages: {
            name: {
                required: "Заполните поле Имя"
            },
            lastName: {
                required: "Заполните поле Фамилия"
            },
            email: {
                required: "Заполните поле email",
                email: "Email не валидный"
            },
            password: {
                required: "Заполните поле Пароль",
                minlength: "Минимальная длина 5 символов"
            },
            confirmPassword: {
                required: "Заполните поле Повторения пароля",
                minlength: "Минимальная длина 5 символов",
                equalTo: "Пароли не совпадают"
            }
        },
        submitHandler: function(form, event) {
            event.preventDefault();

            $(".sendForm").click(function(){
               $('.errors2').text("");
            });

            $.ajax({
                url: "/",
                type: "POST",
                data: $(".sendForm").serialize(),
                cache: false,
                processData: false,
                dataType: 'json',
                success: function(data) {
                    if(data.message) {
                        $(".message").text(data.message);
                    }
                },
            }).fail(function(data) {

                if($.type(data.responseJSON.errors) != 'object')
                    return false;

                $.each(data.responseJSON.errors, (function(index, value) {
                    $('.errors2').append($('<label>').addClass('error').text(value));
                }));
            });
            return false;

        },
        errorLabelContainer: '.errors',
    });

});
