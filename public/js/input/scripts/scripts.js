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