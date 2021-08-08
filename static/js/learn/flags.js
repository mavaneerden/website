let currentNames = [];
let currentFullName;

$(document).ready(() => {
    /* Get new flag on skip click. */
    $("#flag-button-skip").click(() => {
        $("#flag-feedback").text("Skipped: " + currentFullName);
        get_flag();
    });

    /* Check if input is correct. */
    $("#flag-form").submit((event) => {
        event.preventDefault();

        const inputText = $("#flag-input-text").val();

        if (currentNames.includes(normalize_string(inputText))) {
            $("#flag-feedback").text("Correct: " + currentFullName);
            get_flag();
        }
        else {
            $("#flag-feedback").text("Incorrect");
        }

        $("#flag-input-text").val("");
    });

    /* Remove loading gif and use timeout for skip button. */
    $("#flag-image").on("load", () => {
        $("#loading").css("visibility", "hidden");

        setTimeout(() => {
            $("#flag-button-skip").prop("disabled", false);
        }, 1000);
    });

    /* Get the first flag on DOM load. */
    get_flag();
});

/**
 * AJAX call to server. Server returns a random flag with code and associated
 * name(s).
 */
function get_flag() {
    $("#flag-button-skip").prop("disabled", true);
    $("#loading").css("visibility", "visible");

    $.ajax({
        type: "GET",
        url: "/ajax/flags.php",
        success: (res) => {
            const jsonData = JSON.parse(res);

            $("#flag-image").attr("src", "https://flagcdn.com/w320/" + jsonData.code + ".png");

            currentFullName = jsonData.names[0];
            currentNames = jsonData.names.map(element => {
                return normalize_string(element);
            });
        }
    });
}

function normalize_string(string) {
    return string.toLowerCase().normalize("NFD").replace(/[\u0300-\u036f]/g, "").replace("ç", "c").trim();
}