
$("#btnAddPartRock").on("click", function () { 
    appendPart("inputTableBodyRock"); 

    const oreTypes = [];
    const typeElements = $('.oreType');
    typeElements.each(function() {
        oreTypes.push($(this).val());
    });
    
    const orePercentage = [];
    const percentageElements = $('.orePercentage');
    percentageElements.each(function() {
        orePercentage.push($(this).val());
    });
    
    calResults( $("#massStone").val() , oreTypes, orePercentage);
});
$("#btnAddPartShip").on("click", function () {
    appendPart("inputTableBodyShip"); 
});

$("#inputTableBodyRock").on("click", ".deletePart", function() {
    if ($(this).closest("tr").attr("id") === undefined) {
        $(this).closest("tr").remove();
    } else {
        alert("Es kann nur gelöscht werden, wenn mehr als eine Zeile vorhanden ist.");
    }
    
});

$("#inputTableBodyShip").on("click", ".deletePart", function() {
     $(this).closest("tr").remove();
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
});

function appendPart(tablename, select) {
    const newTR = $("<tr>");
    const sourceElement = $("#oreTableEntry");
    const copy = sourceElement.clone();
    copy.removeAttr("id");

    $("#" + tablename).append(copy);

}

function calResults(mass = null, oreType, orePercentage = null, oreParts = null){
    //console.log(oreType);
    //console.log(orePercentage);
}

