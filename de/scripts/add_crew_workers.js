crew = "";
crewnames = new Array();

// #region miner


function loadMiners(crewName){

    document.getElementById("selectMiner").textContent = "\xa0";
    const myNode = document.getElementById("minerList");
    while (myNode.firstChild) {
      myNode.removeChild(myNode.lastChild);
    }


    crew = getCrew(crewName);

    for(i = 0; i<crew.MinerNames.length; i++){
        add_miner(crew.MinerNames[i]);
    }

}


function add_miner(minername = null){
    
    if(minername == null){
        minername =  document.getElementById("minername").value;
        crewHeader = document.getElementById("crewHeader").textContent;
     
         if(crewHeader  == "Alpha"){
             alert("Bitte wähle eine Crew");
         }
         else if(minername == ""){
             alert("Bitte Name für deine Miner setzen");
         }
         else if(minername.length < 4){
             alert("Der Name ist zu kurz");
             document.getElementById("minername").value = "";
         }
         else if(minername.length > 20){
             alert("Der Name ist zu lang");
             document.getElementById("minername").value = "";
         }
         else if(containsWhitespace(minername)){
             alert("Leerzeichen sind nicht erlaubt");
             document.getElementById("minername").value = "";
         }
         else{
             element = document.createElement("button");
             element.classList.add("list-group-item");
             element.classList.add("list-group-item-action");
             element.classList.add("text-center");
             element.setAttribute("id", minername);
             element.setAttribute("onclick", "select_miner(this)");
             element.textContent= minername;
          
             
             document.getElementById("minername").value = "";
             document.getElementById("minerList").appendChild(element);
     
             numberOfChildren = document.getElementById('minerList').childElementCount;
     
             if(numberOfChildren == 1){
     
                 document.getElementById("selectMiner").textContent = minername;
     
             }
     
             crew = getCrew(crewHeader);
             crew.setMiners(minername);
         }
    }else{
        element = document.createElement("button");
        element.classList.add("list-group-item");
        element.classList.add("list-group-item-action");
        element.classList.add("text-center");
        element.setAttribute("id", minername);
        element.setAttribute("onclick", "select_miner(this)");
        element.textContent= minername;
     
        
        document.getElementById("minername").value = "";
        document.getElementById("minerList").appendChild(element);

        numberOfChildren = document.getElementById('minerList').childElementCount;

        if(numberOfChildren == 1){

            document.getElementById("selectMiner").textContent = minername;

        }
    }
   
}

function del_miner(){
    crewHeader = document.getElementById("crewHeader").textContent;

    if(crewHeader  == "Alpha"){
        alert("Bitte wähle eine Crew");
    }
    else{
        select = document.getElementById("selectMiner").textContent;
    
        
        crew = getCrew(crewHeader);
        crew.delMiners(select);

        document.getElementById(select).remove();
    
        numberOfChildren = document.getElementById('minerList').childElementCount;
    
        if(numberOfChildren == 0){
            document.getElementById("selectMiner").textContent = "\xa0";
        }
        else{

            mainDiv = document.getElementById('minerList');
            x = mainDiv.children[0];
    
            document.getElementById("selectMiner").textContent = x.textContent;
    
        }
    }
  
}

function select_miner(ele){


    var id = ele.id;
    document.getElementById("selectMiner").textContent = id;
    $('#collapseMiner').collapse("toggle");

}

// #endregion

//#region scout

function loadScouts(crewName){

    document.getElementById("selectScout").textContent = "\xa0";
    const myNode = document.getElementById("scoutList");
    while (myNode.firstChild) {
      myNode.removeChild(myNode.lastChild);
    }


    crew = getCrew(crewName);

    for(i = 0; i<crew.ScoutNames.length; i++){
        add_scout(crew.ScoutNames[i]);
    }

}


function add_scout(scoutname = null){

    if(scoutname == null){
        scoutname =  document.getElementById("scoutname").value;
        crewHeader = document.getElementById("crewHeader").textContent;
        
    
         if(scoutname == ""){
             alert("Bitte Name für deine Scout setzen");
         }
         else if(scoutname.length < 4){
             alert("Der Name ist zu kurz");
             document.getElementById("scoutname").value = "";
         }
         else if(scoutname.length > 20){
             alert("Der Name ist zu lang");
             document.getElementById("scoutname").value = "";
         }
         else if(containsWhitespace(scoutname)){
             alert("Leerzeichen sind nicht erlaubt");
             document.getElementById("scoutname").value = "";
         }
         
         else{
             element = document.createElement("button");
             element.classList.add("list-group-item");
             element.classList.add("list-group-item-action");
             element.classList.add("text-center");
             element.setAttribute("id", scoutname);
             element.setAttribute("onclick", "select_scout(this)");
             element.textContent= scoutname;
          
             
             document.getElementById("scoutname").value = "";
             document.getElementById("scoutList").appendChild(element);
     
             numberOfChildren = document.getElementById('scoutList').childElementCount;
     
             if(numberOfChildren == 1){
     
                 document.getElementById("selectScout").textContent = scoutname;
     
             }
    
             crew = getCrew(crewHeader);
             crew.setScouts(scoutname);
         }

    } else{
        element = document.createElement("button");
        element.classList.add("list-group-item");
        element.classList.add("list-group-item-action");
        element.classList.add("text-center");
        element.setAttribute("id", scoutname);
        element.setAttribute("onclick", "select_scout(this)");
        element.textContent= scoutname;
     
        
        document.getElementById("scoutname").value = "";
        document.getElementById("scoutList").appendChild(element);

        numberOfChildren = document.getElementById('scoutList').childElementCount;

        if(numberOfChildren == 1){

            document.getElementById("selectScout").textContent = scoutname;

        }
    }
    
   
 }

 function select_scout(ele){

    var id = ele.id;
    document.getElementById("selectScout").textContent = id;
    $('#collapseScout').collapse("toggle");
}

function del_scout(){

    crewHeader = document.getElementById("crewHeader").textContent;

    if(crewHeader  == "Alpha"){
        alert("Bitte wähle eine Crew");
    }
    else{

        select = document.getElementById("selectScout").textContent;

        crew = getCrew(crewHeader);
        crew.delScouts(select);
    
        document.getElementById(select).remove();
    
        numberOfChildren = document.getElementById('scoutList').childElementCount;
    
        if(numberOfChildren == 0){
            document.getElementById("selectScout").textContent = "\xa0";
        }
        else{
    
            mainDiv = document.getElementById('scoutList');
            x = mainDiv.children[0];
    
            document.getElementById("selectScout").textContent = x.textContent;

        }
    }

}


// #endregion


function containsWhitespace(str) {
    return str.indexOf(" ") >= 0;
}

function getCrew(crewHeader){
    
    crews = getCrews();

    for(i = 0; i<crews.length; i++){
        if(crews[i].CrewName == crewHeader){
            crew = crews[i];
        }
    }
    return crew;
}


function save(){

    if(crews.length <= 0){
        alert("Es sind keine Crews gesetzt");
    }
    else{
    
        $.ajax({
            url:'functions/new_job.php',
            method: "POST",
            data: {
                crews: JSON.stringify(crews),
            }
        }).done(function() {
            location.reload();
          });
    }

    
}

function reset(){
    crews = [];
    location.reload();
}