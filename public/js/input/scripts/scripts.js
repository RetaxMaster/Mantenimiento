$(document).ready(function() {
    
    // Modal

    $(document).on("click", ".modal", function (e) {
        console.log(e);
        if (($(e.target).hasClass("modal-main") || $(e.target).hasClass("close-modal")) && $("#loading").css("display") == "none") {
            closeModal();
        }
    });

    // -> Modal
    
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

function validatePicture(input) {
    return validateFile(input, ["image/jpeg", "image/png", "image/gif"]);
}

function validateFile(input, supportedTypes = ["application/pdf", "application/msword", "application/vnd.openxmlformats-officedocument.wordprocessingml.document"]) {
    let flag = true;

    for (let i = 0; i < input.files.length; i++)
        if (supportedTypes.indexOf(input.files[i].type) == -1)
            flag = false;

    return flag;
}