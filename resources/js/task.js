const selectMiner = $('#selectMiner');
const selectScouts = $('#selectScouts');

const selectMinerHidden = $('#selectMinerHidden');
const selectScoutsHidden = $('#selectScoutsHidden');

const refineryStaion = $('#refineryStaion');
const method = $('#method');
const costs = $('#costs');
const duration = $('#duration');
const oreTableEntry = $('#oreTableEntry');
const oreTypes = $('.oreType');
const oreUnits = $('.oreUnit');

const btnSave = $('#btnSave');
const btnSaveToDashboard = $('#btnSaveToDashboard');
const btnReset = $('#btnReset');


$(document).on("load", function () {
    $('#selectMiner option').prop('selected', false);
    $('#selectScout option').prop('selected', false);
});

$(function ($) {
    $("#successMessage").delay(2000).fadeOut(800);
});


//#region Mitspieler

$('#addMiner').on("click", function () {
    const miner = $('#miner');
    selectMiner.append(createOption(miner.val()));
    selectMinerHidden.append(createOption(miner.val()));
    miner.val("");
});

$('#delMiner').on('click', function () {
    const selectedOption = selectMiner.find('option:selected');
    selectedOption.remove();

    const selectedOption2 = selectMinerHidden.find(`option[value="${selectedOption.val()}"]`);
    selectedOption2.remove();
});

$('#addScouts').on("click", function () {
    const scouts = $('#scouts');
    selectScouts.append(createOption(scouts.val()));
    selectScoutsHidden.append(createOption(scouts.val()));
    scouts.val("");
});

$('#delScouts').on('click', function () {
    const selectedOption = selectScouts.find('option:selected');
    selectedOption.remove();

    const selectedOption2 = selectScoutsHidden.find(`option[value="${selectedOption.val()}"]`);
    selectedOption2.remove();
});

$('#btnOnldGroup').on('click', function () {

    const ajaxUrl = $(this).data('ajax-url');

    $.ajax({
        url: ajaxUrl,
        type: "GET",
        dataType: "json",
        success: function (response) {
            const miner = response.miner;
            const scouts = response.scouts;

            miner.forEach(element => {
                selectMiner.append(createOption(element));
                selectMinerHidden.append(createOption(element));
            });

            scouts.forEach(element => {
                selectScouts.append(createOption(element));
                selectScoutsHidden.append(createOption(element));
            });
        },
        error: function (error) {
            console.error("Fehler beim AJAX-Aufruf:", error);
        }
    });
});


function createOption(name) {
    const neueOption = $('<option>', {
        value: name,
        text: name
    });

    return neueOption;
}

//#endregion

//#region Erze

$("#oreTableEntries").on("click", ".deletePart", function () {
    if ($(this).closest("tr").attr("id") === undefined) {
        $(this).closest("tr").remove();
    } else {
        alert("Es muss mindestens ein Erz geben");
    }
});

$('#btnAddOrePart').on('click', function () {

    const sourceElement = $("#oreTableEntry");
    const copy = sourceElement.clone();
    copy.find('input').val("");
    copy.removeAttr("id");

    $("#oreTableEntries").append(copy);


});

//#endregion

//#region Auszahlungsverhältnis

$("#payoutRatio").on("input", function () {
    // Aktualisiere die Werte basierend auf dem Range-Wert
    const rangeValue = $(this).val();
    const scoutValue = 100 - rangeValue;
    const minerValue = rangeValue;

    // Rufe die Funktion auf, um die Anzeige zu aktualisieren
    updateRatioValues(scoutValue, minerValue);
});

// Funktion zum Aktualisieren der Anzeige
function updateRatioValues(scoutValue, minerValue) {
    $("#ratioScouts").text(scoutValue + "%");
    $("#ratioMiner").text(minerValue + "%");
}

//#endregion

//#region Abschlussbuttons

btnReset.on("click", function () {
    resetForm();
});

function resetForm() {
    refineryStaion.prop("selectedIndex", 0);
    method.prop("selectedIndex", 0);
    costs.val("");
    duration.val("");
}

btnSave.on("click", function () {
    $('#selectMinerHidden option').prop('selected', true);
    $('#selectScoutsHidden option').prop('selected', true);
    $('#form').trigger("submit");
});

btnSaveToDashboard.on("click", function () {
    $('#form').trigger("submit");
});

//#endregion
