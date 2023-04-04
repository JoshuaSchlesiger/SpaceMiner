function add_crew(){
    crewname = document.getElementById("crewname").value;

    if(crewname == ""){
        alert("Bitte Name für deine Crew setzen");
    }
    else if(crewname.length < 5){
        alert("Der Name ist zu kurz");
        document.getElementById("crewname").value = "";
    }
    else if(crewname.length > 20){
        alert("Der Name ist zu lang");
        document.getElementById("crewname").value = "";
    }
    else if(containsWhitespace(crewname)){
        alert("Leerzeichen sind nicht erlaubt");
        document.getElementById("crewname").value = "";
    }
    else{
        element = document.createElement("button");
        element.classList.add("list-group-item");
        element.classList.add("list-group-item-action");
        element.classList.add("text-center");
        element.setAttribute("id", crewname);
        element.setAttribute("onclick", "select_Crew(this)");
        element.textContent= crewname;
     
        document.getElementById("crewname").value = "";
        document.getElementById("crewList").appendChild(element);

        numberOfChildren = document.getElementById('crewList').childElementCount;

        if(numberOfChildren == 1){

            document.getElementById("selectCrew").textContent = crewname;
        }

        $.ajax({
            url:'functions/add_crew.php',
            method: "POST",
            data: {
                crewname: crewname,
            }
        })
    }
}

function select_Crew(ele){

        var id = ele.id;
        document.getElementById("selectCrew").textContent = id;
        $('#collapseExample').collapse("toggle");

        document.getElementById("crewHeader").textContent = id;

}

function containsWhitespace(str) {
    return str.indexOf(" ") >= 0;
  }