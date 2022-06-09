$(document).ready(function(){
    $("form#formRegistroOrganizacion").validetta({
        bubblePosition:"bottom",
        bubbleGapTop: 10,
        bubbleGapLeft: -5,
        onValid:function(e){
            e.preventDefault();
            var formData = new FormData($("form#formRegistroOrganizacion")[0]); //con jquery tengo acceso al elemento pero accedo al primer índice para realmente tener acceso a él
            $.ajax({
                url:"registroOrganizacion_AX.php",
                method:"post",
                data:formData, //con esto uso js puro
                cache:false,
                contentType:false, //Importante colocar siempre que se pretenda enviar un archivo al servidor
                processData:false, //Importante colocar siempre que se pretenda enviar un archivo al servidor
                success:function(respAX){
                    console.log(respAX);
                    let AX = JSON.parse(respAX);
                    console.log(respAX);
                    let tipo;
                    if(AX.codigo == 1) tipo = "green"; else tipo = "red";
                    $.alert({
                        title:"<h3>Helping Hands 2022</h3>",
                        content:AX.msj,
                        type:tipo,
                        icon:"fas fa-info-circle fa-2x",
                        boxWidth: "50%",
                        useBootstrap: false,
                        onDestroy:function(){
                        if(AX.codigo == 1)
                            window.location.href = "./login.html";
                        }
                    });
                }
            });
        }
    });
});