
$("#btnAddPartRock").on("click", function () {
    appendPart("inputTableBodyRock");

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
    sendDataAndShow(getAllInputs());
});

$("#inputTableBodyRock").on("click", ".deletePart", function () {
    if ($(this).closest("tr").attr("id") === undefined) {
        $(this).closest("tr").remove();
        sendDataAndShow(getAllInputs());
    } else {
        alert("Es kann nur gelöscht werden, wenn mehr als eine Zeile vorhanden ist.");
    }

});

$("#inputTableBodyShip").on("click", ".deletePart", function () {
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

$("#inputSwitch").on("change",function() {
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


        returnArray.type = "rock";
        returnArray.oreTypes = [];

        oreTypes.each(function () {
            returnArray.oreTypes.push($(this).val());
        });

        returnArray.oreInput = [];
        massInput.each(function () {
            returnArray.oreInput.push($(this).val());
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
            returnArray.oreInput.push($(this).val());
        });
    }

    returnArray.refineryMethod = $("#refineryMethod").val();
    returnArray.station = $("#station").val();

    return returnArray;

}

function sendDataAndShow(dataObject) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
    });

    if(dataObject.massStone === ""){
        dataObject.massStone = 0;
    }

    $.ajax({
        type: "POST",
        url: $('#calculateRoute').val(), // Hier stimmt der Name der Route überein
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