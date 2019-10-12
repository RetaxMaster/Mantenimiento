$(document).ready(function(){

    $("#register").on("submit", function(e) {
        
        e.preventDefault();

        if (validateInputs(this)) {
            
            var name = $("#Name").val();
            var username = $("#Username").val();
            var email = $("#Email").val();
            var password = $("#Password").val();
            var confirmPassword = $("#password-confirm").val();
            var rol = $("#rol").val();

            var form = this;

            if (password == confirmPassword) {

                loading(true, "Registrando...");
                
                var data = {
                    _token: $("meta[name='csrf-token']").attr("content"),
                    name: name,
                    username: username,
                    email: email,
                    password: password,
                    password_confirmation: confirmPassword,
                    rol: rol
                }

                $.post(route("registerPost").url(), data, function(res) {
                    loading(false);
                    res = JSON.parse(res);
                    if (res.status == "true") {
                        swal("¡Registrado!", "Usuarior egistrado con éxito", "success");
                        form.reset();
                    }
                    else {
                        swal("Error", "Ha surgido un error al insertar el usuario", "error");
                        console.log(res.responseText);
                    }
                }).fail(function(e) {
                    console.log(e.responseText);
                });

            }
            else {
                swal("Error", "La contraseña no coincide", "error");
            }

        }

    });

});