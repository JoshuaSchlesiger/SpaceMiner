function addTypeWeight(){

  
    oretype = document.getElementById("oretype");
    weight = document.getElementById("weight");

    if(weight.value <= 0){
        weight.style.borderColor = "Crimson";
        weight.classList.add('warningIcon');
    }else{
        weight.style.borderColor = "";
        weight.classList.remove('warningIcon');

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
    }
    else if(timeHours.value == 0 && timeMinutes.value == 0){
        timeHours.style.borderColor = "Crimson";
        timeHours.classList.add('warningIcon');
        timeMinutes.style.borderColor = "Crimson";
        timeMinutes.classList.add('warningIcon');
    }
    else if(typeWeightList.value == 0){
        typeWeightList.style.borderColor = "Crimson";
        typeWeightList.classList.add('warningIcon');
    }
    else{
        typeWeightList.style.borderColor = "";
        typeWeightList.classList.remove('warningIcon');
        timeHours.style.borderColor = "";
        timeHours.classList.remove('warningIcon');
        timeMinutes.style.borderColor = "";
        timeMinutes.classList.remove('warningIcon');

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

        for (const child of typeWeightList.children) {
            searchTerm = "-";
            indexOf = child.id.indexOf(searchTerm);
            childText = child.id;

            id = childText.substring(0, indexOf);
            mass = childText.substring(indexOf+1);

            i = 0;
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