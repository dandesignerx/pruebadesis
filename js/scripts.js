  // CARGA DE REGIONES
     $(function () {

              $.ajax({
                type: "POST",
                url: "paginas/CargaCandidatos.php",
                  success: function(data) {
                          $("candidatos[value='0']").remove();
                          $("#candidatos").empty();
                          $("#candidatos").append(data);
                  },
                  error:function(data){
                  alert("Error en la captura de datos !!")
                  }
              });

        })

       // CARGA DE CANDIDATOS
       $(function () {

              $.ajax({
                type: "POST",
                url: "paginas/CargaRegiones.php",
                  success: function(data) {
                          $("regiones[value='0']").remove();
                          $("#regiones").empty();
                          $("#regiones").append(data);
                  },
                  error:function(data){
                  alert("Error en la captura de datos !!")
                  }
              });

        })

        // FUNCIONA CARGA DE COMUNAS
        function seleccion_comuna(){
                    
                    var idregion = document.getElementById("regiones").value;
                    $.ajax({
                      type: "POST",
                      data: {"idregion":idregion},
                      url: "paginas/CargaComunas.php",
                        success: function(data) {
                                $("comunas[value='0']").remove();
                                $("#comunas").empty();
                                $("#comunas").append(data);
                                document.all['comunas'].removeAttribute('disabled');
                        },
                        error:function(data){
                        alert("Error en la captura de datos !!")
                        }
                    });
        }

              
        // FUNCION PARA VALIDAD ALIAS
        function validarAlias() {
        var cadena = document.getElementById("alias").value; 
        // Verificar que contenga al menos una letra y un número
        const contieneLetra = /[a-zA-Z]/.test(cadena); // Verifica si hay letras
        const contieneNumero = /\d/.test(cadena); // Verifica si hay números

        // Si cumple con ambas condiciones, la cadena es válida
        if ( cadena.length > 5 && contieneLetra && contieneNumero) {
            return true; // Cumple con la condición de tener letras y números
          } else {
            alert("Alias no cumple condicion de alfanumerica");
            $("#alias").val('');
            document.getElementById("alias").focus();
            return false; // No cumple con la condición de tener letras y números
          }
        }



        // FUNCION SUBMIT PARA ALMACENAR DATOS DE VOTACIÓN  
        $( "#form1" ).submit(function( event ) {
        // captura grupo de checkbox  
        var checkboxes = document.querySelectorAll('.grupo'); 
        var contador = 0;
        // verifica y contabiliza la cantidad de checkbox de dicho grupo
        checkboxes.forEach(function(checkbox) {
            if (checkbox.checked) {
                contador++;
            }
        });

        if (contador < 2) { // minimo de ingreso 2 checkbox del grupo
            alert('Por favor, selecciona al menos dos opciones como se entero de nosotros.');
            return false;
        } else {
           // Captura datos del formularioa para almacenar la votacion 
           var parametros = new FormData(this);
           $.ajax({
              type: "POST",
              url: "paginas/GuardarVotacion.php",
              data: parametros,
              processData: false, 
              contentType: false,
              success: function(datos){
                //console.log(datos)
                if(datos=='OK'){ 
                  swal(
                  {   
                  title: "VOTACIÓN REALIZADA \n MUCHAS GRACIAS", 
                  type: "success",
                  confirmButtonText: "Aceptar",
                  showConfirmButton: true 
                  },
                  function()
                  {
                     window.location.href = "index.html";
                  });

                }else if(datos=="ERROR"){

                  swal(
                  {   
                  title: "ERROR EN COMPLETAR VOTACION, VUELTA A INTENTAR MAS TARDE", 
                  type: "warning",
                  confirmButtonText: "Aceptar",
                  showConfirmButton: true 
                  },
                  function()
                  {
                    window.location.href = "index.html";
                  });

                 }else if(datos=="DUPLICADO"){

                  swal(
                  {   
                  title: "RUT INGRESADO, VOTACION YA FUE REALIZADA.", 
                  type: "warning",
                  confirmButtonText: "Aceptar",
                  showConfirmButton: true 
                  },
                  function()
                  {
                    window.location.href = "index.html";
                  });

                 }

              }
          });
          event.preventDefault();
        }

         });
