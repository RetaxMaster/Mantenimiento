$(document).ready(function(){

    // Agrega un artículo maestro

    $("#addMaster").on("submit", function (e) {
        e.preventDefault();

        if ($("#articulo-name").val() != "") {
            loading(true, "Agregando...");
            var data = {
                _token: $("meta[name='csrf-token']").attr("content"),
                articuloName: $("#articulo-name").val()
            }

            $.post(route("addMaster").url(), data, function (res) {
                loading(false);

                res = JSON.parse(res);

                var element = $('<li id="sec-' + res.master.id + '"><span>' + res.master.name + '</span><div class="delete"><i class="fas fa-times"></i></div></li>');

                $("#allMasters").append(element);
                $("#allMasters .not-found").remove();
                $("#articulo-name").val("");

            });
        }
        else {
            swal("Error", "Por favor escribe un nombre para el artículo masestro", "error");
        }
    });

    // -> Agrega un artículo maestro

    // Elimina un artículo maestro
    
    $("#allMasters").on("click", ".delete", function () {
        var id = $(this).parent().attr("id").split("-").pop();
        
        swal({
            title: "¿Seguro?",
            text: "¿Seguro que deseas eliminar este artículo maestro? Si la eliminas, todos los artículos de este maestro, mantenimientos y cualquier información relacionada con el mismo será eliminada.",
            icon: "warning",
            buttons: ["Cancelar", "Eliminar"],
            dangerMode: true
        }).then(function(willDelete){
            if (willDelete) {
                loading(true, "Eliminando...");
                var data = { 
                    _token: $("meta[name='csrf-token']").attr("content"),
                    id: id 
                }

                $.post(route("deleteMaster"), data, function(res) {
                    loading(false);
                    res = JSON.parse(res);
                    if(res.status == "true") {
                        swal("¡Listo!", "Este artículo maestro ha sido eliminado exitosamente", "success");
                        $("#mas-" + id).remove();
                    }
                    else {
                        swal("Error", res.responseText, "error");
                    }
                });
            }
        });
        
    });
    
    // -> Elimina un artículo maestro

});