$(document).ready(function () {

    function removeSpaces(string) {
        return string.split(" ").join("");
    }

    //El siguiente código NO pertenece a OpenPay, este código es únicamente para validación y saneameniento de los datos ingresados en los inputs

    //Verificar inputs

    $("#card-form input").on("focus", function () {
        $(this).removeClass("is-invalid");
        $(this).attr("placeholder", "");
    });

    $("#card-form input").on("blur", function () {
        if ($(this).val() == "") {
            $("span.card-errors").text("");
        }
    });

    //->Verificar inputs

    $("#card-form input").on("focus", function () {
        $(this).removeClass("is-invalid");
    });

    // Input del nombre

    $("#HolderName").on("keydown", function (e) {
        if (!isNaN(e.key) && e.keyCode != 32) e.preventDefault();
    });
    

    // ->Input del nombre

    //Input de la tarjeta
    $("#CreditCardNumber").on("keydown", function (e) {
        if ((this.value.length == 22 && e.keyCode != 8 && e.keyCode != 37 && e.keyCode != 39 && e.keyCode != 13) || e.keyCode == 32 || e.keyCode == 17 || (isNaN(e.key) && e.keyCode != 8 && e.keyCode != 39 && e.keyCode != 13)) e.preventDefault();
    });

    $("#CreditCardNumber").on("keyup", function (e) {
        if (this.value.length == 4 || this.value.length == 10 || this.value.length == 16) this.value = this.value + "  ";
        if (e.keyCode == 8) {
            var text = this.value.split("");
            if (text[text.length - 1] == " ") {
                text = text.join("").trim();
                this.value = text;
            }
        }
    });

    $("#CreditCardNumber").on("keypress", function () {
        if (this.value.length == 4 || this.value.length == 10 || this.value.length == 16) this.value = this.value + "  ";
    });

    $("#CreditCardNumber").on("paste", function (e) {
        setTimeout(function () {
            var string = e.currentTarget.value;
            var numbers = string.replace(/\D/igm, "");
            numbers = numbers.substr(0, 16);
            serie1 = numbers.substr(0, 4);
            serie2 = numbers.substr(4, 4);
            serie3 = numbers.substr(8, 4);
            serie4 = numbers.substr(12, 4);
            document.getElementById("CreditCardNumber").value = serie1 + "  " + serie2 + "  " + serie3 + "  " + serie4;
        }, 0);
    });

    $("#expirationDate").on("keydown", function (e) {
        if ((this.value.length == 7 && e.keyCode != 8 && e.keyCode != 37 && e.keyCode != 39 && e.keyCode != 13) || e.keyCode == 32 || (isNaN(e.key) && e.keyCode != 8 && e.keyCode != 37 && e.keyCode != 39 && e.keyCode != 13)) e.preventDefault();
    });

    $("#expirationDate").on("keyup", function (e) {
        if (this.value.length == 2) this.value = this.value + " / ";
        if (e.keyCode == 8) {
            var text = this.value.split("");
            if (text[text.length - 1] == " " || text[text.length - 1] == "/") {
                text = text.join("");
                text = (text[text.length - 1] == " ") ? text.split(" / ")[0] : text.split(" /")[0];
                this.value = text;
            }
        }
    });

    $("#expirationDate").on("keypress", function () {
        if (this.value.length == 2) this.value = this.value + " / ";
    });

    $("#cvcInput").on("keydown", function (e) {
        if ((this.value.length == 4 && e.keyCode != 8 && e.keyCode != 37 && e.keyCode != 39 && e.keyCode != 13) || e.keyCode == 32 || (isNaN(e.key) && e.keyCode != 8 && e.keyCode != 37 && e.keyCode != 39 && e.keyCode != 13)) e.preventDefault();
    });

    // -> Finaliza la parte que no es de OpenPay

    //Esta variable sirve para saber si los datos ingresados dentro del formulario de pago son válidos y están saneados y listos para ser procesados por OpenPay

    var canPayWithCard = false;

    //Pongo las Keys y preconfiguro OpenPay para el deviceSessionId

    OpenPay.setId('mpznhxcc4hwefqmlx1kv');
    OpenPay.setApiKey('pk_781ac8a728df4d7195cd3b717122feea');
    OpenPay.setSandboxMode(true); //<-- Modo SandBox
    var deviceSessionId = OpenPay.deviceData.setup("card-form", "deviceIdHiddenFieldName"); //<-- Creo el deviceSessionId para el sistema anti-fraudes

    // Esta parte son más validaciones, pero esta vez usando la librería de validaciones de OpenPay para poder sanear los datos correctamente

    function updateCanPayWithCardValue() {
        var month = parseInt($("#expirationDate").val().split(" / ")[0]);
        var year = parseInt($("#expirationDate").val().split(" / ")[1]);
        var cvc = $("#CreditCardNumber").val() != "" ? OpenPay.card.validateCVC($("#cvcInput").val(), $("#CreditCardNumber").val()) : OpenPay.card.validateCVC($("#cvcInput").val());
        if (OpenPay.card.validateCardNumber($("#CreditCardNumber").val()) && OpenPay.card.validateExpiry(month, (year + 2000)) && cvc)
            canPayWithCard = true;
        else
            canPayWithCard = false;
    }

    $("#CreditCardNumber").on("blur", function () {
        if (!OpenPay.card.validateCardNumber(this.value) && this.value != "") {
            $(this).addClass("is-invalid");
        } else {
            $(this).removeClass("is-invalid");
        }

        if ($("#cvcInput").val() != "" && OpenPay.card.validateCardNumber(this.value) && !OpenPay.card.validateCVC($("#cvcInput").val(), this.value)) {
            $("#cvcInput").addClass("is-invalid");
        } else {
            $("#cvcInput").removeClass("is-invalid");
        }

        updateCanPayWithCardValue();
    });

    // ->Input de la tarjeta

    // Input de la fecha

    $("#expirationDate").on("blur", function () {
        var month = parseInt(this.value.split(" / ")[0]);
        var year = parseInt(this.value.split(" / ")[1]);
        if (!OpenPay.card.validateExpiry(month, (year + 2000)) && this.value != "") {
            $(this).addClass("is-invalid");
        } else {
            $(this).removeClass("is-invalid");
        }

        updateCanPayWithCardValue();
    });

    //-> Input de la fecha

    // Input del CVC

    $("#cvcInput").on("blur", function () {
        var cvc = $("#CreditCardNumber").val() != "" ? OpenPay.card.validateCVC(this.value, $("#CreditCardNumber").val()) : OpenPay.card.validateCVC(this.value);
        if (!cvc && this.value != "") {
            $(this).addClass("is-invalid");
        } else {
            $(this).removeClass("is-invalid");
        }

        updateCanPayWithCardValue();
    });

    // Aquí finalizan las validaciones para que OpenPay pueda procesar los datos


    //Ahora si empezamos a tokenizar la tarjeta

    //Función callback que será llamada si sale todo bien
    var success_callbak = function (response) {
        var token_id = response.data.id; //Nos responderá con el token

        var data = {
            "token_id": token_id,
            "deviceIdHiddenFieldName": deviceSessionId,
            "project_id": $("#project_id").val(),
            "pay_complete_tax": $("#pay-complete-tax").is(':checked')
        }

        $("#pay-button").prop("disabled", false); //Reactivo el botón
        $("#pay-button").on("click", function (e) {
            e.preventDefault();
            getToken();
        }); //Reactivo el evento del botón
        
        $.ajax({
            url: "/payment",
            data: data,
            type: "post",
            dataType: "json",
            headers: {
              'X-CSRF-TOKEN': document.querySelector("meta[name='csrf-token']").content
            },
            success: function (res) {
                console.log(res);
                //loading(false);
                //$("#takeAMoment").hide();

                if (res.status == "true")
                    console.log("El pago fue procesado con éxito.");
                else
                    console.log(res.error);
            },
            error: function (e) {
                console.log(e.responseText);
            }
        });
    };

    //Función callback que será llamada si algo fue mal
    var error_callbak = function (response) {
        var desc = response.data.description != undefined ? response.data.description : response.message;
        var errorMessage = "ERROR [" + response.status + "] " + desc;
        console.log(errorMessage);
        
        $("#pay-button").prop("disabled", false); //Reactivo el botón
        $("#pay-button").on("click", function (e) {
            e.preventDefault();
            getToken();
        }); //Reactivo el botón
    };

    //Atrapo el evento submit del formulario
    $('#pay-button').on('click', function (e) {
        e.preventDefault(); //Evito el submit, esto para poder crear el token
        getToken();
    });

    function getToken() {
        console.log("Pagando");
        console.log(canPayWithCard);
        if (canPayWithCard) { //Si todos los datos de la tarjeta están bien
            //Inserto los datos en el formulario
            //loading(true);
            //motivationalText();
            var month = parseInt($("#expirationDate").val().split(" / ")[0]);
            var year = parseInt($("#expirationDate").val().split(" / ")[1]);
            $('input[data-openpay-card="card_number"]').val(removeSpaces($("#CreditCardNumber").val()));
            $('input[data-openpay-card="expiration_month"]').val(month);
            $('input[data-openpay-card="expiration_year"]').val(year);
            //->Inserto los datos en el formulario
            $("#pay-button").prop("disabled", true); //Deshabilito el botón
            $("#pay-button").off(); //Por seguridad le quito el event listener
            var a = OpenPay.token.extractFormAndCreate($("#card-form"), success_callbak, error_callbak); //Creamos el token, si todo sale bien, llamamos a la función success_callbak(), de lo contrario llamamos a la función error_callbak()
        } else {
            alert("Por favor revisa bien tus datos de pago.");
        }
    }

});
