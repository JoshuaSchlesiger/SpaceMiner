//#region Mitspieler

const selectMiner = $('#selectMiner');
const selectScouts = $('#selectScouts');

$('#addMiner').on("click", function () {
    const miner = $('#miner');
    selectMiner.append(createOption(miner.val()));
    miner.val("");
});

$('#delMiner').on('click', function(){
    const selectedOption = selectMiner.find('option:selected');
    selectedOption.remove();
});

$('#addScouts').on("click", function () {
    const scouts = $('#scouts');
    selectScouts.append(createOption(scouts.val()));
    scouts.val("");
});

$('#delScouts').on('click', function(){
    const selectedOption = selectScouts.find('option:selected');
    selectedOption.remove();
});


function createOption(name){
    const neueOption = $('<option>', {
        value: name,
        text: name
    });

    return neueOption;
}

//#endregion
