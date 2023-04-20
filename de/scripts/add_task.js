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
        text = oretype.value + " - " + weight.value; 
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
    typeWeightList = document.getElementById("typeWeightList");
    miningStation = document.getElementById("miningStation");

    if(timeHours.value == 0 && timeMinutes.value == 0){
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

        $.ajax({
            url:'functions/new_task.php',
            method: "POST",
            data: {
                timeHours: timeHours.value,
                timeMinutes: timeMinutes.value,
                costs: costs.value,
                typeWeightList: typeWeightList.value,
                miningStation: miningStation.value
            },  
            success: function (data) {
                alert(data);
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