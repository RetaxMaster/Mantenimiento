$(document).ready(function(){

    $.datepicker.setDefaults($.datepicker.regional["es"]);
    $.datepicker.setDefaults({
        dateFormat: 'dd-mm-yy',
        showOn: "both",
        changeMonth: true,
        changeYear: true,
        yearRange: "2019:2025",
        firstDay: 1,
        minDate: 0,
        monthNames: ['Enero', 'Febrero', 'Marzo',
        'Abril', 'Mayo', 'Junio',
        'Julio', 'Agosto', 'Septiembre',
        'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun',
        'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
        dayNamesMin: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
        closeText: 'Cerrar',
        prevText: 'Anterior',
        nextText: 'Siguiente',
        currentText: 'Hoy',
    });

    $("#mantainment-date").datepicker();

    $("#mantainment-date").on("focus", function() {
        this.blur();
    });

    function validateInputs(form) {
        let flag = true;
        form.querySelectorAll("input:not(.no-required), textarea:not(.no-required), .text-area-container .text-area").forEach(element => {
            if ((element.tagName == "INPUT" && element.value == "") || (element.tagName == "TEXTAREA" && element.value == "") || (element.tagName == "DIV" && element.textContent == "")) {
                flag = false;
                element.classList.add("is-invalid");
            } else {
                element.classList.remove("is-invalid");
            }
        });
        return flag;
    }

    // Agrega un artículo

    $("#addArticulo").on("submit", function (e) {
        e.preventDefault();

        if (validateInputs(this)) {
            if ($(".user-asigned:checked").length > 0) {
                loading(true, "Agregando...");
                var formData = new FormData(this);
                var thisForm = this;

                //Recojo los valores de los checkbox
                var users = $(".user-asigned:checked").map(function() {
                    return this.value;
                }).get();

                formData.append("users", JSON.stringify(users));
                formData.append("_token", $("meta[name='csrf-token']").attr("content"));
    
                $.ajax({
                    url: route("addArticulo").url(),
                    type: "post",
                    dataType: "json",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (res) {
                        loading(false);

                        if (res.status == "true") {
                            swal("¡Listo!", "¡Artículo agregado correctamente!", "success");
                            thisForm.reset();
                            var element = $('<li id="art-' + res.articulos.id + '"><span>' + res.articulos.name + '</span><div class="delete"><i class="fas fa-times"></i></div></li>');

                            $("#Articulos").append(element);
                            $("#Artiuclos .not-found").remove();
                        } else {
                            swal("Error", res.message, "error");
                        }
                    },
                    error: function (e) {
                        swal("Error", e.responseText, "error");
                    }
                });
            }
            else {
                swal("Error", "Debes elegir al menos un usuario para mantenimiento, si no ves ningún usuario debes crear uno.", "error");
            }
        } else {
            swal("Error", "Por favor rellena todos los campos", "error");
        }
    });

    // -> Agrega un artículo

    // Elimina una sucursal
    
    $("#Articulos").on("click", ".delete", function () {
        var id = $(this).parent().attr("id").split("-").pop();
        
        swal({
            title: "¿Seguro?",
            text: "¿Seguro que deseas eliminar este artículo? Si lo eliminas, todos los mantenimientos y cualquier información relacionada con el mismo será eliminado.",
            icon: "warning",
            buttons: ["Cancelar", "Eliminar"],
            dangerMode: true
        }).then((willDelete) => {
            if (willDelete) {
                loading(true, "Eliminando...");
                var data = { 
                    _token: $("meta[name='csrf-token']").attr("content"),
                    id: id 
                }

                $.post(route("deleteArticulo"), data, function(res) {
                    loading(false);
                    res = JSON.parse(res);
                    if(res.status == "true") {
                        swal("¡Listo!", "Este artículo ha sido eliminado exitosamente", "success");
                        $("#art-" + id).remove();
                    }
                    else {
                        swal("Error", res.responseText, "error");
                    }
                });
            }
        });
        
    });
    
    // -> Elimina una sucursal

    // Busca artículos
    var makeAnotherRequest = true;    
    $(document).on("keyup", "#search-by-articulo-name", function(e){

        if (makeAnotherRequest) {
            makeAnotherRequest = false;
            var query = this.value;
            var sucursal = $("#sort-by-sucursal-name").val();

            setTimeout(function() {
                var data = {
                    _token: $("meta[name='csrf-token']").attr("content"),
                    query: query,
                    sucursal: sucursal
                }

                $.post(route("getArticulos").url(), data, function (res) {
                    console.log(res);
                    
                    res = JSON.parse(res);
                    if (res.status == "true") {
                        $("#Articulos > li").remove();

                        Array.from(res.articulos).forEach(function (articulo) {
                            var element = $('<li id="art-' + articulo.id + '"><span>' + articulo.name + '</span><div class="delete"><i class="fas fa-times"></i></div></li>');

                            $("#Articulos").append(element);
                        });
                    } else {
                        swal("Error", res.responseText, "error");
                    }
                }).fail(function(msg) {
                    console.log(msg.responseText);
                    
                });
                makeAnotherRequest = true;
            }, 500);
        }
    
    });
    
    // -> Busca artículos

});