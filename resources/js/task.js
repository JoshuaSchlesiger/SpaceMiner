import {delegate} from 'tippy.js';
import 'tippy.js/dist/tippy.css';
import 'tippy.js/animations/shift-toward-subtle.css';
// Default configuration for Tippy with event delegation (https://atomiks.github.io/tippyjs/v6/addons/#event-delegation
delegate('body', {
    interactive: true,
    allowHTML: true,
    animation: 'shift-toward-subtle',
    target: '[data-tippy-content]',
});

const selectMiner = $('#selectMiner');
const selectScouts = $('#selectScouts');

const selectMinerHidden = $('#selectMinerHidden');
const selectScoutsHidden = $('#selectScoutsHidden');

let refineryStaion = $('#refineryStaion');
let method = $('#method');
const costs = $('#costs');
const duration = $('#duration');
const oreTableEntry = $('#oreTableEntry');
let oreTypes = $('.oreType');
let oreUnits = $('.oreUnit');

const btnSave = $('#btnSave');
const btnSaveToDashboard = $('#btnSaveToDashboard');
const btnReset = $('#btnReset');

const language = $('.language');

let minerCount = 0;
let scoutCount = 0;


$(document).on("load", function () {
    $('#selectMiner option').prop('selected', false);
    $('#selectScout option').prop('selected', false);
});

$(function ($) {
    $("#successMessage").delay(2000).fadeOut(800);
    calculateRatioRaw();
});

//#region Refinery

$("#refineryStaion").on("change", function () {
    getProceeds();
});

$("#method").on("change", function () {
    getProceeds();
});

//#endregion

//#region Mitspieler


$("#miner").on("keypress", function (event) {
    if (event.which === 13) {
        $("#addMiner").trigger("click");
    }
});

$('#addMiner').on("click", function () {
    const miner = $('#miner');
    const minerValue = miner.val();

    if (minerValue == "") {
        if (language.text().trim() === 'DE') {
            showBootstrapAlert('danger', 'Miner feld darf nicht leer sein!');
        }
        else {
            showBootstrapAlert('danger', 'Miner field must not be empty!');
        }
        return;
    }

    if (!selectMiner.find(`option[value='${minerValue}']`).length) {
        // Wert zum Dropdown hinzufügen
        selectMiner.prepend(createOption(minerValue));
        selectMiner.find('option:first').prop('selected', true);
        selectMinerHidden.prepend(createOption(minerValue));

        minerCount += 1;
        calculateRatio();

    } else {
        if (language.text().trim() === 'DE') {
            showBootstrapAlert('danger', 'Miner bereits vorhanden!');
        }
        else {
            showBootstrapAlert('danger', 'Miner already available!');
        }
    }

    miner.val("");
});

$('#delMiner').on('click', function () {
    const selectedOption = selectMiner.find('option:selected');
    selectedOption.remove();

    const selectedOption2 = selectMinerHidden.find(`option[value="${selectedOption.val()}"]`);
    selectedOption2.remove();

    if (minerCount > 0) {
        minerCount -= 1;
        calculateRatio();
    }

});

$("#scouts").on("keypress", function (event) {
    if (event.which === 13) {
        $("#addScouts").trigger("click");
    }
});

$('#addScouts').on("click", function () {
    const scouts = $('#scouts');
    const scoutsValue = scouts.val();

    if (scoutsValue == "") {
        if (language.text().trim() === 'DE') {
            showBootstrapAlert('danger', 'Scout feld darf nicht leer sein!');
        }
        else {
            showBootstrapAlert('danger', 'Scout field must not be empty!');
        }
        return;
    }

    if (!selectScouts.find(`option[value='${scoutsValue}']`).length) {
        selectScouts.prepend(createOption(scoutsValue));
        selectScouts.find('option:first').prop('selected', true);
        selectScoutsHidden.prepend(createOption(scoutsValue));

        scoutCount += 1;
        calculateRatio();

    } else {
        if (language.text().trim() === 'DE') {
            showBootstrapAlert('danger', 'Scout bereits vorhanden!');
        }
        else {
            showBootstrapAlert('danger', 'Scout already available!');
        }
    }

    scouts.val("");
});

$('#delScouts').on('click', function () {
    const selectedOption = selectScouts.find('option:selected');
    selectedOption.remove();

    const selectedOption2 = selectScoutsHidden.find(`option[value="${selectedOption.val()}"]`);
    selectedOption2.remove();

    if (scoutCount > 0) {
        scoutCount -= 1;
        calculateRatio();
    }
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

                selectMiner.empty();
                selectMinerHidden.empty();
                selectScouts.empty();
                selectScoutsHidden.empty();

                miner.forEach(element => {
                    selectMiner.append(createOption(element));
                    selectMinerHidden.append(createOption(element));
                });

                scouts.forEach(element => {
                    selectScouts.append(createOption(element));
                    selectScoutsHidden.append(createOption(element));
                });
            }
            else {
                $("#messageOldGroup").text(response.error);
            }
        },
        error: function (error) {
            console.error("Error at the AJAX-Call:", error);
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

function getProceeds() {

    oreTypes = $('.oreType');
    oreUnits = $('.oreUnit');
    refineryStaion = $('#refineryStaion');
    method = $('#method');

    const oreTypeValues = [];

    oreTypes.each(function () {
        oreTypeValues.push($(this).val());
    });

    const oreUnitsValues = [];

    oreUnits.each(function () {
        oreUnitsValues.push($(this).val());
    });

    if(($('#oreTableEntries').children().length === 1 && (oreTypeValues[0] === "null" || oreUnitsValues[0] === "")) || !refineryStaion.val() || !method.val()){
        return;
    }

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: $('#route').val() + "Proceeds",
        data: {
            "refineryStation": refineryStaion.val(),
            "method": method.val(),
            "oreTypes": oreTypeValues,
            "units": oreUnitsValues,
        },
        success: function (response) {
            $('#expectedProceeds').text(response.success);
        },
        error: function (error) {
        }
    });
}

$("#oreTableEntries").on("click", ".deletePart", function () {
    let rowCount = $('#oreTableEntries .deletePart').length;
    if (rowCount > 1) {
        $(this).closest("tr").remove();
    } else {
        let select = $(this).closest("tr");
        select.find("option:selected").prop("selected", false);

        let input = $(this).closest("tr");
        input.find("input:first").val("");
    }

    getProceeds();
});

$("#oreTableEntries").on("change", ".oreType", function () {
    getProceeds();
});

$("#oreTableEntries").on("input", ".oreUnit", function () {
    getProceeds();
});

$('#btnAddOrePart').on('click', function () {
    const sourceElement = $("#oreTableEntries").find('tr:first');
    const copy = sourceElement.clone();
    copy.find('input').val("");
    copy.removeAttr("id");

    $("#oreTableEntries").append(copy);

    getProceeds();
});

function checkEmptyRows() {
    // Iteriere über alle Select-Elemente in den Zellen der Klasse 'oreType' (starte bei 1, um das erste Element zu überspringen)
    $('.oreType:gt(0)').each(function (index) {
        // Überprüfe, ob das Dropdown-Element selected und disabled ist und das zugehörige Element in der zweiten Spalte leer ist
        if ($(this).val() === "null" && $(this).closest('tr').find('.oreUnit').val() === '') {
            // Lösche die gesamte Zeile
            $(this).closest('tr').remove();
        }
    });
}

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

function calculateRatio() {
    // Berechne die Gesamtanzahl der Einheiten
    const totalUnits = minerCount + scoutCount;

    if (totalUnits === 0) {
        $("#payoutRatio").val(50);
        updateRatioValues(50, 50);
        return;
    }

    // Berechne die Prozentsätze für Miner und Scout
    const minerPercentage = Math.round((minerCount / totalUnits) * 100);
    const scoutPercentage = Math.round((scoutCount / totalUnits) * 100);

    // Rufe die Funktion auf, um die Anzeige zu aktualisieren
    updateRatioValues(scoutPercentage, minerPercentage);

    $("#payoutRatio").val(minerPercentage);
}

function calculateRatioRaw() {
    // Berechne die Gesamtanzahl der Einheiten
    const minerCountRaw = $("#selectMinerHidden option").length;
    minerCount = minerCountRaw;
    const scoutCountRaw = $("#selectScoutsHidden option").length;
    scoutCount = scoutCountRaw;
    const totalUnits = minerCountRaw + scoutCountRaw;


    if (totalUnits === 0) {
        $("#payoutRatio").val(50);
        updateRatioValues(50, 50);
        return;
    }

    // Berechne die Prozentsätze für Miner und Scout
    const minerPercentage = Math.round((minerCountRaw / totalUnits) * 100);
    const scoutPercentage = Math.round((scoutCountRaw / totalUnits) * 100);

    // Rufe die Funktion auf, um die Anzeige zu aktualisieren
    updateRatioValues(scoutPercentage, minerPercentage);

    $("#payoutRatio").val(minerPercentage);
}


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
    location.reload();
}

btnSave.on("click", function () {
    $('#selectMinerHidden option').prop('selected', true);
    $('#selectScoutsHidden option').prop('selected', true);
    checkEmptyRows();
    $('#form').trigger("submit");
});

btnSaveToDashboard.on("click", function () {
    $('#selectMinerHidden option').prop('selected', true);
    $('#selectScoutsHidden option').prop('selected', true);

    $('#form').append('<input type="hidden" name="action" value="saveToDashboard">');
    checkEmptyRows()
    $('#form').trigger("submit");
});

//#endregion
