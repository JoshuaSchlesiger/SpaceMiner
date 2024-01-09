$("#btnAddPartRock").on("click", function () {
    appendPart("inputTableBodyRock");

    let inputTableBodyRock = $("#inputTableBodyRock");
    let childCount = inputTableBodyRock.children().length;
    if(childCount > 4){
        $('#btnAddPartRock').prop("disabled", true);
        return;
    }

    const oreTypes = [];
    const typeElements = $('.oreType');
    typeElements.each(function () {
        oreTypes.push($(this).val());
    });

    const orePercentage = [];
    const percentageElements = $('.orePercentage');
    percentageElements.each(function () {
        orePercentage.push($(this).val());
    });


    sendDataAndShow(getAllInputs());
});

$("#btnAddPartShip").on("click", function () {
    appendPart("inputTableBodyShip");
    let inputTableBodyRock = $("#inputTableBodyShip");
    let childCount = inputTableBodyRock.children().length;
    if(childCount > 4){
        $('#btnAddPartShip').prop("disabled", true);
        return;
    }
    sendDataAndShow(getAllInputs());
});

$("#inputTableBodyRock").on("click", ".deletePart", function () {
    let inputTableBodyRock = $("#inputTableBodyRock");
    let childCount = inputTableBodyRock.children().length;
    if(childCount <= 5){
        $('#btnAddPartRock').prop("disabled", false);
    }

    if ($(this).closest("tr").attr("id") === undefined) {
        $(this).closest("tr").remove();
        sendDataAndShow(getAllInputs());
    } else {

        let select = $(this).closest("tr");
        select.find("select:first option:disabled").prop("selected", true);

        let input = $(this).closest("tr");
        input.find("input:first").val("");


        $("#costs").text(formatNumber(0));
        $("#refinedProfit").text(formatNumber(0));
        $("#duration").text(formatMinToMinAndHorus(0));
        $("#unitCount").text(formatNumber(0));
        $("#valuableMass").text(formatNumber(0));
        $("#rawProfit").text(formatNumber(0));
    }

});

$("#inputTableBodyShip").on("click", ".deletePart", function () {
    let inputTableBodyRock = $("#inputTableBodyShip");
    let childCount = inputTableBodyRock.children().length;
    if(childCount <= 5){
        $('#btnAddPartShip').prop("disabled", false);
    }
    $(this).closest("tr").remove();
    sendDataAndShow(getAllInputs());
});

$(document).on('change', 'select', function () {
    sendDataAndShow(getAllInputs());
});

$(document).on('input', function (e) {

    if ($(e.target).attr('id') !== "inputSwitch") {
        sendDataAndShow(getAllInputs());
    }
});

$("#inputSwitch").on("change", function () {
    if ($(this).is(":checked")) {
        //Ship
        $("#inputsShip").removeAttr("hidden");
        $("#inputsRock").attr("hidden", true);
    } else {
        //Rock
        $("#inputsRock").removeAttr("hidden");
        $("#inputsShip").attr("hidden", true);
    }

    sendDataAndShow(getAllInputs());
});

function appendPart(tablename) {
    const sourceElement = $("#oreTableEntry");
    const copy = sourceElement.clone();
    copy.find('input').val("");
    copy.removeAttr("id");

    $("#" + tablename).append(copy);

}

function getAllInputs() {

    const inputsShipDiv = $("#inputsShip");
    const inputsRockDiv = $('#inputsRock');

    let returnArray = {};

    if (inputsShipDiv.is("[hidden]")) {
        let oreTypes = inputsRockDiv.find(".oreTypeRock");
        let massInput = inputsRockDiv.find(".inputMass");
        returnArray.massStone = $('#massStone').val();

        if (returnArray.massStone === "") {
            returnArray.massStone = 0;
        }

        if (returnArray.massStone > 99999) {
            returnArray.massStone = 99999;
            $("#massStone").val(99999);
        } else if (returnArray.massStone < 0) {
            returnArray.massStone = 0;
            $("#massStone").val(0);
        }


        returnArray.type = "rock";
        returnArray.oreTypes = [];

        oreTypes.each(function () {
            returnArray.oreTypes.push($(this).val());
        });

        returnArray.oreInput = [];
        massInput.each(function () {
            if ($(this).val() > 100) {
                $(this).val(100);
                returnArray.oreInput.push(100);
            } else if ($(this).val() < 0) {
                $(this).val(0);
                returnArray.oreInput.push(0);
            } else {
                returnArray.oreInput.push($(this).val());
            }

        });

    } else if (inputsRockDiv.is("[hidden]")) {
        let oreTypes = inputsShipDiv.find(".oreTypeRock");
        let massInput = inputsShipDiv.find(".inputMass");
        returnArray.massStone = 0;

        returnArray.type = "ship";
        returnArray.oreTypes = [];

        oreTypes.each(function () {
            returnArray.oreTypes.push($(this).val());
        });

        returnArray.oreInput = [];
        massInput.each(function () {
            if ($(this).val() > 100) {
                $(this).val(100);
                returnArray.oreInput.push(100);
            } else if ($(this).val() < 0) {
                $(this).val(0);
                returnArray.oreInput.push(0);
            } else {
                returnArray.oreInput.push($(this).val());
            }
        });
    }

    returnArray.refineryMethod = $("#refineryMethod").val();
    returnArray.station = $("#station").val();

    return returnArray;

}

function sendDataAndShow(dataObject) {
    if(dataObject.oreTypes.length > 5){
        return;
    }

    if(dataObject.type == "rock" && dataObject.massStone == ""){
        return;
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
    });



    $.ajax({
        type: "POST",
        url: $('#route').val(), // Hier stimmt der Name der Route überein
        data: {
            "type": dataObject.type,
            "massStone": parseInt(dataObject.massStone),
            "oreTypes": dataObject.oreTypes,
            "oreInput": dataObject.oreInput,
            "refineryMethod": parseInt(dataObject.refineryMethod),
            "station": parseInt(dataObject.station)
        },
        success: function (data) {
            data = data.success;

            $("#costs").text(formatNumber(Math.round(data.costs)));
            $("#refinedProfit").text(formatNumber(Math.round(data.refinedProfit)));
            $("#duration").text(formatMinToMinAndHorus(Math.round(data.duration)));
            $("#unitCount").text(formatNumber(Math.round(data.unitCount)));
            $("#valuableMass").text(formatNumber(Math.round(data.valuableMass)));
            $("#rawProfit").text(formatNumber(Math.round(data.rawProfit)));

        },
        error: function (data) {
            const errors = data.responseJSON.errors;
            console.log(errors);
        }
    });
}

function formatNumber(zahl) {

    return new Intl.NumberFormat().format(zahl);
}

function formatMinToMinAndHorus(minuten) {
    const hours = Math.floor(minuten / 60);
    const minutesLeft = minuten % 60;

    const stundenString = hours < 10 ? `0${hours}` : hours.toString();
    const minutenString = minutesLeft < 10 ? `0${minutesLeft}` : minutesLeft.toString();

    return `${stundenString}:${minutenString}`;
}
