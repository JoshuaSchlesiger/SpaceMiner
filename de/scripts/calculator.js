window.addEventListener("load", (event) => {

  document.getElementById("weightPureSmall").value = "10";
  
      const selectElem1 = document.getElementById("select1");
      selectElem1.addEventListener("change", () => {
        callPHP();
      });

      const selectElem2 = document.getElementById("select2");
      selectElem2.addEventListener("change", () => {
        callPHP();
      });

      const selectElem3 = document.getElementById("select3");
      selectElem3.addEventListener("change", () => {
        callPHP();
      });

      const selectMass = document.getElementById("massStone");
      selectMass.addEventListener("input", () => {
        callPHP();
      });

      const selectproportion1 = document.getElementById("proportion1");
      selectproportion1.addEventListener("input", () => {
        callPHP();
      });

      const selectproportion2 = document.getElementById("proportion2");
      selectproportion2.addEventListener("input", () => {
        callPHP();
      });

      const selectproportion3 = document.getElementById("proportion3");
      selectproportion3.addEventListener("input", () => {
        callPHP();
      });
      


      function setValues(json){
        
        $("#priceRaw1").val(json.priceRaw1);
        $("#priceRefined1").val(json.priceRefined1);           
        $("#priceRaw2").val(json.priceRaw2);
        $("#priceRefined2").val(json.priceRefined2);
        $("#priceRaw3").val(json.priceRaw3);
        $("#priceRefined3").val(json.priceRefined3);
        $("#mass1").val(json.mass1);
        $("#mass2").val(json.mass2);
        $("#mass3").val(json.mass3);

      }

      function callPHP(){
        index1 = document.getElementById("select1").selectedIndex;
        index2 = document.getElementById("select2").selectedIndex;
        index3 = document.getElementById("select3").selectedIndex;
    
        massStone = document.getElementById("massStone").value;
        proportion1 = document.getElementById("proportion1").value;
        proportion2 = document.getElementById("proportion2").value;
        proportion3 = document.getElementById("proportion3").value;

        if(massStone > 10000){
          alert("Masse des Steins darf nicht höher als 10000 sein");
          document.getElementById("massStone").value = 0;
        }

        if(proportion1 > 100){
          alert("Mehr als 100% sind nicht möglich");
          document.getElementById("proportion1").value = 0;
        }
        else if(proportion2 > 100){
          alert("Mehr als 100% sind nicht möglich");
          document.getElementById("proportion2").value = 0;
        }
        else if(proportion3 > 100){
          alert("Mehr als 100% sind nicht möglich");
          document.getElementById("proportion3").value = 0;
        }
        else if((parseFloat(proportion1) + parseFloat(proportion2) + parseFloat(proportion3)) > 100){
          alert("Mehr als 100% sind nicht möglich");
          document.getElementById("proportion1").value = 0;
          document.getElementById("proportion2").value = 0;
          document.getElementById("proportion3").value = 0;
        }
        else{
          $.ajax({
            url:'functions/calculator.php',
            method: "POST",
            data: {
              index1: index1,
              index2: index2,
              index3: index3,
              massStone: massStone,
              proportion1: proportion1,
              proportion2: proportion2,
              proportion3: proportion3,
            }
          })
              .done(function(data) {
                
                var json = JSON.parse(data);
                setValues(json);
                calculate();
  
            });
  
  
        }

      }

      function calculate(){
        document.getElementById("weightPure").value = "10";  //$("#mass1").val(json.mass1) + $("#mass2").val(json.mass2) + $("#mass3").val(json.mass3);
      }


  });


