function add_miner(){
    
   minername =  document.getElementById("minername").value;

    if(minername == ""){
        alert("Bitte Name für deine Miner setzen");
    }
    else if(minername.length < 5){
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
    /*
        $.ajax({
            url:'functions/add_crew.php',
            method: "POST",
            data: {
                crewname: crewname,
            }
        })

        */
        
    }
}

function del_miner(){
    select = document.getElementById("selectMiner").textContent;
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

function containsWhitespace(str) {
    return str.indexOf(" ") >= 0;
  }


function select_miner(ele){

    var id = ele.id;
    document.getElementById("selectMiner").textContent = id;
    $('#collapseMiner').collapse("toggle");
}