import events from "../functions/events";
import FJ from "../functions/FamilyJewels";
import swal from 'sweetalert';
import m from "../functions/modal";

const { eventAll, eventOne } = events;

export const generalScripts = () => {

    // Ventana modal
    
    //Cerrar la ventana al hacer click afuera
    document.addEventListener("click", e => {
        let _this = e.target;
        if (_this.classList.contains('close-modal') || _this.classList.contains('modal-main')) m.closeModal();
    });
    
    // -> Ventana modal

    
    // Visor

    eventAll("click", document, "img.visor-allowed", img => {
        const src = img.src;
        document.querySelector("#Visor img").src = src;
        document.querySelector("#Visor").classList.add("show");
    });

    eventAll("click", document, "#Visor", img => {
        document.querySelector("#Visor").classList.remove("show");
    });

    // -> Visor

    // Detecta a los inputs personalizados

    const customizedInputs = document.querySelectorAll(".input-alternative .input-container input");
    customizedInputs.forEach(element => {
        element.addEventListener("blur", () => {
            let span = element.parentNode.children[1];

            if (element.value != ""){
                span.classList.add("active");
                element.classList.remove("is-invalid");
            }
            else {
                span.classList.remove("active");
            }
        });
    });


    // -> Detecta a los inputs personalizados

    // Detecta los textareas personalizados

    const customizedTextAreas = document.querySelectorAll(".input-alternative.multi-line .text-area-container .text-area");
    customizedTextAreas.forEach(element => {
        element.addEventListener("blur", () => {
            let span = element.parentNode.children[1];

            if (element.textContent != "") {
                span.classList.add("active");
                element.classList.remove("is-invalid");
            } else {
                span.classList.remove("active");
            }
        });
    });

    // ->Detecta los textareas personalizados

    // Detecta los inputs file personalizados

    const customizedInputsFile = document.querySelectorAll(".customized-input-file input");
    customizedInputsFile.forEach(element => {
        element.addEventListener("change", () => {
            const iconContainer = element.parentNode.children[1];
            
            if(element.value == "") {
                iconContainer.classList.remove("file-charged");
            }
            else {
                iconContainer.classList.add("file-charged");
            }
        });
    });
    
    // -> Detecta los inputs file personalizados

    // Simula el efecto de un label para los textareas personalziados

    const customizedTextAreasLabels = document.querySelectorAll(".input-alternative.multi-line .text-area-container .text-area-placeholder");

    customizedTextAreasLabels.forEach(element => {
        element.addEventListener("click", () => {
            let forElement = element.dataset.for;

            if (typeof forElement !== "undefined") {
                document.querySelector(`#${forElement}`).focus();
            }

        });
    });

    // -> Simula el efecto de un label para los textareas personalziados

}