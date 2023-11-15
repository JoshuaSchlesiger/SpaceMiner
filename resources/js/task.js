//#region Mitspieler

const selectMiner = $('#selectMiner');
const selectScouts = $('#selectScouts');

$('#addMiner').on("click", function () {
    const miner = $('#miner');
    selectMiner.append(createOption(miner.val()));
    miner.val("");
});

$('#delMiner').on('click', function () {
    const selectedOption = selectMiner.find('option:selected');
    selectedOption.remove();
});

$('#addScouts').on("click", function () {
    const scouts = $('#scouts');
    selectScouts.append(createOption(scouts.val()));
    scouts.val("");
});

$('#delScouts').on('click', function () {
    const selectedOption = selectScouts.find('option:selected');
    selectedOption.remove();
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


