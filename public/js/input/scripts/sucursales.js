$(document).ready(function() {
    
    // Agrega un sector
    
    $("#addSector").on("submit", function(e) {
        e.preventDefault();

        if ($("#sector-name").val() != "") {
            loading(true, "Agregando...");
            var data = {
                _token: $("meta[name='csrf-token']").attr("content"),
                sectorName: $("#sector-name").val()
            }
    
            $.post(route("addSector").url(), data, function(res) {
                loading(false);
                
                res = JSON.parse(res);

                var option = $('<option value="' + res.sector.id + '">' + res.sector.name + '</option>');
                var element = $('<li id="sec-' + res.sector.id + '"><span>' + res.sector.name + '</span><div class="delete"><i class="fas fa-times"></i></div></li>');

                $("#sector-sucursal-name").append(option);
                $("#allSectors").append(element);
                $("#allSectors .not-found").remove();
                $("#sector-name").val("");
                
            });
        }
        else {
            swal("Error", "Por favor escribe un nombre para el sector", "error");
        }
    });
    
    // -> Agrega un sector

    // Agrega una sucursal
    
    $("#addSucursal").on("submit", function(e) {
        e.preventDefault();

        if ($("#sucursal-name").val() != "") {
            loading(true, "Agregando...");
            var data = {
                _token: $("meta[name='csrf-token']").attr("content"),
                sucursalName: $("#sucursal-name").val(),
                sectorId: $("#sector-sucursal-name").val()
            }
    
            $.post(route("addSucursal").url(), data, function(res) {
                loading(false);
                
                res = JSON.parse(res);

                var element = $('<li id="sec-' + res.sucursal.id + '"><span>' + res.sucursal.name + '</span><div class="delete"><i class="fas fa-times"></i></div></li>');

                $("#allSucursal").append(element);
                $("#allSucursal .not-found").remove();
                $("#sucursal-name").val("");
                
            });
        }
        else {
            swal("Error", "Por favor escribe un nombre para la sucursal", "error");
        }
    });
    
    // -> Agrega una sucursal

    // Elimina una sucursal
    
    $("#allSucursal").on("click", ".delete", function() {
        var id = $(this).parent().attr("id").split("-").pop();
        
        swal({
            title: "¿Seguro?",
            text: "¿Seguro que deseas eliminar esta sucursal? Si la eliminas, todos los artículos, mantenimientos y cualquier información relacionada con la misma será eliminada.",
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

                $.post(route("deleteSucursal"), data, function(res) {
                    loading(false);
                    res = JSON.parse(res);
                    if(res.status == "true") {
                        swal("¡Listo!", "Esta sucursal ha sido eliminada exitosamente", "success");
                        $("#suc-" + id).remove();
                    }
                    else {
                        swal("Error", res.responseText, "error");
                    }
                });
            }
        });
        
    });
    
    // -> Elimina una sucursal

    // Elimina una sucursal
    
    $("#allSectors").on("click", ".delete", function () {
        var id = $(this).parent().attr("id").split("-").pop();
        
        swal({
            title: "¿Seguro?",
            text: "¿Seguro que deseas eliminar este sector? Si lo eliminas, todas las sucursales, artículos, mantenimientos y cualquier información relacionada con el mismo será eliminado.",
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

                $.post(route("deleteSector"), data, function(res) {
                    loading(false);
                    res = JSON.parse(res);
                    if(res.status == "true") {
                        swal("¡Listo!", "Este sector ha sido eliminado exitosamente", "success");
                        $("#sec-" + id).remove();
                    }
                    else {
                        swal("Error", res.responseText, "error");
                    }
                });
            }
        });
        
    });
    
    // -> Elimina una sucursal

});