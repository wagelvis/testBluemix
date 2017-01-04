<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Bluemix Test - Firebase Chat</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link href="css/chat.css" rel="stylesheet">
        <link rel="stylesheet" href="css/sweetalert.css">
        <!-- Firebase Chat Conexion -->
        <script src="https://www.gstatic.com/firebasejs/3.6.4/firebase.js"></script>
        <script>
        // Initialize Firebase
        var config = {
            apiKey: "AIzaSyDxKmcrA4IH0WPekrWBpW5PZ56W_zxnNQ0",
            authDomain: "chatfirebase-adb15.firebaseapp.com",
            databaseURL: "https://chatfirebase-adb15.firebaseio.com",
            storageBucket: "",
            messagingSenderId: "1064920733964"
        };
        firebase.initializeApp(config);

        // Access Data

        var TablaDeBaseDatos = firebase.database().ref('chat');

        TablaDeBaseDatos.on('value', function(snapshot){

            $(".chat").html(""); // Limpiamos todo el contenido del chat
        
            // Leer todos los mensajes en firebase
            snapshot.forEach(function(e){
                var objeto=e.val(); // Asignar todos los valores a un objeto
                
                // Validar datos nulos y agregar contenido en forma de lista etiqueta <li>
                if((objeto.Mensaje!=null)&&(objeto.Nombre!=null)){
                    
                    // Copia el contenido al template y luego lo inserta en el chat
                    $( "#plantilla" ).clone().appendTo( ".chat" );
                    $('.chat #plantilla').show(10);
                    $('.chat #plantilla .Nombre').html(objeto.Nombre);
                    $('.chat #plantilla .Mensaje').html(objeto.Mensaje);
                    $('.chat #plantilla .Tiempo').html(objeto.Fecha);
                    $('.chat #plantilla').attr("id","");
                }
                
            });

        });

        </script>
    </head>
    <body>
    
        <div class="container">
            <div class="row">
                <!-- inicio de la caja de chat con bootstrap -->
                <div class="col-md-6 col-md-offset-3">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <span class="glyphicon glyphicon-comment"></span> Chat Firebase
                        </div>
                        <div class="panel-body">
                            <ul class="chat"> </ul>
                        </div>
                        <div class="panel-footer">
                            <div class="input-group">
                                <input id="Mensaje" type="text" class="form-control input-sm" placeholder="Escribe un mensaje..." />
                                <span class="input-group-btn">
                                    <button class="btn btn-warning btn-sm" id="btnEnviar" >Send!</button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <!--  Fin de la caja de chat con bootstrap -->
            </div>
        </div>
  <!-- template del item del chat (Oculto: para agarrar un clon y llenarlo e insertar en el chat)-->
       <li style="display:none" id="plantilla" class="left clearfix">
           <span class="chat-img pull-left">
             <img src="http://placehold.it/50/55C1E7/fff&text=U"class="img-circle" />
           </span>
            <div class="chat-body clearfix">
                    <div class="header">
                      <strong class="primary-font Nombre" >Jack Sparrow</strong> 
                        <small class="pull-right text-muted">
                        <span class="glyphicon glyphicon-asterisk Tiempo">
                        </span> </small>
                    </div>
                        <p class="Mensaje">
                               Message
                        </p>
                </div>
        </li>
    
    <!-- Latest compiled and minified JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="js/chat.js"></script>
    <script src="js/sweetalert.min.js"></script>
    <script>

        var Nombre = prompt("Indique su Nombre:");

        /*var Nombre = swal({
            title: "Identificación de Usuario!",
            text: "Escriba su Nombre de Usuario",
            type: "input",
            showCancelButton: true,
            closeOnConfirm: false,
            animation: "slide-from-top",
            inputPlaceholder: "Username"
            },
            
            function(inputValue){
            if (inputValue === false) return false;
            
            if (inputValue === "") {
                swal.showInputError("Debes escribir un nombre de usuario!");
                return false
            }
            
            swal("Correcto", "Haz escrito: " + inputValue, "success");
        });*/

        $('#btnEnviar').click(function(){

            var formatofecha = new Date();
            var d = formatofecha.getUTCDate();
            var m = formatofecha.getMonth()+1;
            var y = formatofecha.getFullYear();
            var h = formatofecha.getHours();
            var min = formatofecha.getMinutes();

            Fecha = d+"/"+m+"/"+y+" "+h+":"+min;

            TablaDeBaseDatos.push({
                Nombre: Nombre,
                Mensaje: $("#Mensaje").val(),
                Fecha: Fecha
            });

            $("#Mensaje").val("");

        });

    </script>
    </body>
</html>