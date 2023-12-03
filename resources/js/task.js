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
    const minerValue = miner.val();

    if (!selectMiner.find(`option[value='${minerValue}']`).length) {
        // Wert zum Dropdown hinzufügen
        selectMiner.append(createOption(minerValue));
        selectMinerHidden.append(createOption(minerValue));
    } else {
        showBootstrapAlert('danger', 'Miner bereits vorhanden!');
    }

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
    const scoutsValue = scouts.val();

    if (!selectScouts.find(`option[value='${scoutsValue}']`).length) {
        selectScouts.append(createOption(scoutsValue));
        selectScoutsHidden.append(createOption(scoutsValue));
    } else {
        showBootstrapAlert('danger', 'Scout bereits vorhanden!');
    }

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
            if ($.isEmptyObject(response.error)) {
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
            }
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

function showBootstrapAlert(type, message) {
    const alertContainer = $('.alert-container');
    const alert = $('<div>', { class: `alert alert-${type} alert-dismissible fade show`, role: 'alert' })
        .text(message);

    // Alten Alert entfernen, falls vorhanden
    alertContainer.empty();

    // Alert dem Container hinzufügen
    alertContainer.append(alert);

    alertContainer.show();

    setTimeout(function () {
        alertContainer.hide();
    }, 1500);
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
    $('#selectMinerHidden option').prop('selected', true);
    $('#selectScoutsHidden option').prop('selected', true);

    $('#form').append('<input type="hidden" name="action" value="saveToDashboard">');
    $('#form').trigger("submit");
});

//#endregion
