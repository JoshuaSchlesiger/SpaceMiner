
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

    getAllInputs()
});

$("#btnAddPartShip").on("click", function () {
    appendPart("inputTableBodyShip");
    getAllInputs()
});

$("#inputTableBodyRock").on("click", ".deletePart", function () {
    if ($(this).closest("tr").attr("id") === undefined) {
        $(this).closest("tr").remove();
        getAllInputs();
    } else {
        alert("Es kann nur gelöscht werden, wenn mehr als eine Zeile vorhanden ist.");
    }

});

$("#inputTableBodyShip").on("click", ".deletePart", function () {
    $(this).closest("tr").remove();
    getAllInputs();
});

$(document).on('change', 'select', function () {
    getAllInputs();
});

$('input').on('input', function () {
    if ($(this).attr('id') !== "inputSwitch") {
        getAllInputs();
    }

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

    console.log(returnArray);

    return returnArray;

}

