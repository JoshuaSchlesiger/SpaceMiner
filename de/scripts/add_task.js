function addTypeWeight(){

  
    oretype = document.getElementById("oretype");
    weight = document.getElementById("weight");

    check = false;
    i = 0;

    for (const child of typeWeightList.children) {
        searchTerm = "-";
        indexOf = child.id.indexOf(searchTerm);
        childText = child.id;

        id = childText.substring(0, indexOf);
        mass = childText.substring(indexOf+1);

        if(mass == weight.value && id == oretype.value ){
            check = true;
        }

    }

    if(weight.value <= 0){
        weight.style.borderColor = "Crimson";
        weight.classList.add('warningIcon');
        weight.title = "Kleiner als null geht nicht";
    }
    else if(weight.value > 99999){
        weight.style.borderColor = "Crimson";
        weight.classList.add('warningIcon');
        weight.title = "Das Gewicht ist etwas zu hoch";
    }
    else if(check){
        weight.style.borderColor = "Crimson";
        weight.classList.add('warningIcon');
        weight.title = "Der gleicher Wert und Typ ist nicht erlaubt";
    }
    else{
        weight.style.borderColor = "";
        weight.classList.remove('warningIcon');
        weight.title = "";
        typeWeightList.style.borderColor = "";
        typeWeightList.classList.remove('warningIcon');

        element = document.createElement("option");
        text = oretype.value + "-" + weight.value; 
        element.setAttribute("id", text);
        element.textContent= text;
        document.getElementById("typeWeightList").appendChild(element);
        weight.value = "";


        numberOfChildren = document.getElementById('typeWeightList').childElementCount;
        document.getElementById("typeWeightList").selectedIndex = numberOfChildren-1;
    }
}

function deleteTypeWeight(){

    select = document.getElementById("typeWeightList").value;
    document.getElementById(select).remove();

}

function saveTask(){
    timeHours = document.getElementById("hours");
    timeMinutes = document.getElementById("minutes");
    costs = document.getElementById("costs");
    miningStation = document.getElementById("miningStation");
    typeWeightList = document.getElementById("typeWeightList");
    
    if (timeHours.value == 0 && timeMinutes.value == 0 && typeWeightList.value == 0){
        timeHours.style.borderColor = "Crimson";
        timeHours.classList.add('warningIcon');
        timeMinutes.style.borderColor = "Crimson";
        timeMinutes.classList.add('warningIcon');
        typeWeightList.style.borderColor = "Crimson";
        typeWeightList.classList.add('warningIcon');

        timeHours.title = "Es fehlt eine Zeit";
        timeMinutes.title = "Es fehlt eine Zeit";
        typeWeightList.title = "Es fehlt eine Einlagerung";
    }
    else if(timeHours.value == 0 && timeMinutes.value == 0){
        timeHours.style.borderColor = "Crimson";
        timeHours.classList.add('warningIcon');
        timeMinutes.style.borderColor = "Crimson";
        timeMinutes.classList.add('warningIcon');

        timeHours.title = "Es fehlt eine Zeit";
        timeMinutes.title = "Es fehlt eine Zeit";
    }
    else if(typeWeightList.value == 0){
        typeWeightList.style.borderColor = "Crimson";
        typeWeightList.classList.add('warningIcon');

        typeWeightList.title = "Es fehlt eine Einlagerung";
    }
    else{
        typeWeightList.style.borderColor = "";
        typeWeightList.classList.remove('warningIcon');
        timeHours.style.borderColor = "";
        timeHours.classList.remove('warningIcon');
        timeMinutes.style.borderColor = "";
        timeMinutes.classList.remove('warningIcon');

        timeHours.title = "";
        timeMinutes.title = "";
        typeWeightList.title = "";

        if(costs.value == 0){
            costs.value = 0;
        }
        if(timeHours.value == 0){
            timeHours.value = 0;
        }
        if(timeMinutes.value == 0){
            timeMinutes.value = 0;
        }

        varTypeWeightList = new Array();
        i = 0;

        for (const child of typeWeightList.children) {
            searchTerm = "-";
            indexOf = child.id.indexOf(searchTerm);
            childText = child.id;

            id = childText.substring(0, indexOf);
            mass = childText.substring(indexOf+1);

            varTypeWeightList[i] = new Array(2);
            varTypeWeightList[i][0] = id;
            varTypeWeightList[i][1] = mass;
            i++;
        }

        const values = {
            timeHours: timeHours.value,
            timeMinutes: timeMinutes.value,
            costs: costs.value,
            typeWeightList: varTypeWeightList,
            miningStation: miningStation.value
        }

        $.ajax({
            url:'functions/new_task.php',
            method: "POST",
            data: {
                values: JSON.stringify(values)
            },  
            success: function (data) {

                informations = JSON.parse(data);
                if(informations["Error"] != undefined){
                    alert(informations["Error"]);
                    resetTask();
                }
                else{
                    informations["Error"];
                    resetTask();
                }

            }
    
        })
    }


}

function resetTask(){
    oretype = document.getElementById("oretype");
    weight = document.getElementById("weight");
    timeHours = document.getElementById("hours");
    timeMinutes = document.getElementById("minutes");
    costs = document.getElementById("costs");
    typeWeightList = document.getElementById("typeWeightList");
    miningStation = document.getElementById("miningStation");

    oretype.value = 1;
    weight.value = "";
    timeHours.value = "";
    timeMinutes.value = "";
    costs.value = "";
    typeWeightList.value = "";
    miningStation.value = 1;

    while (typeWeightList.firstChild) {
        typeWeightList.removeChild(typeWeightList.lastChild);
      }
}