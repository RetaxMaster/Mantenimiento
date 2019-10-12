$(document).ready(function(){

    // Desaparezco las notificaciones
    
    setTimeout(() => {
        $(".notifications .alert .close").click();
    }, 5000);
    
    // -> Desaparezco las notificaciones

    // Marca un mantenimiento como hecho
    
    $(document).on("click", "input[type='checkbox']", function(e){
    
        e.preventDefault();
        var checkbox = this;

        swal({
            title: "¿Seguro?",
            text: "Si realmente el mantenimiento de todos los artículos fue realizado, presiona \"Mantenimiento completo\", ten en cuenta que al hacer esto, el artículo será borrado de tu lista de mantenimientos y no podrás deshacerlo.",
            icon: "warning",
            buttons: ["Cancelar", "Mantenimiento completo"],
            dangerMode: true
        }).then(function(willClick) {
            if (willClick) {
                loading(true);
                var id = $(checkbox).attr("id").split("-").pop();
                
                var data = {
                    _token: $("meta[name='csrf-token']").attr("content"),
                    id: id
                }

                $.post(route("completeMantainment").url(), data, function(res) {
                    console.log(res);
                    res = JSON.parse(res);
                    loading(false);
                    if (res.status == "true") {
                        swal("¡Listo!", "Se ha hecho el mantenimiento correctamente", "success");
                        $("#articulo-" + id).parent().parent().parent().remove();
                    }
                    else {
                        swal("Error", res.responseText, "error");
                    }
                }).fail(function(e) {
                    swal("Error", "Ha surgido un erro interno", "error");
                    console.log(e.responseText);
                    loading(false);
                });
                
            }
        });
    
    });
    
    // -> Marca un mantenimiento como hecho

});