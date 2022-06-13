$(document).ready(function(){

    $(".fas").mouseover(function(){
        $(this).css("cursor","pointer");
    });

    $(".completarPedido").click(function(){
        let pedido = $(this).attr("data-pedido");
        let producto = $(this).attr("data-producto");
        $.ajax({
            url:"./completarPedido_AX.php",
            method:"post",
            data:{pedido:pedido,producto:producto},
            cache:false,
            success:function(respAX){
                console.log(respAX);
                let AX = JSON.parse(respAX);
                let tipo;
                if(AX.codigo == 1) 
                    window.location.href = "./pedidos.php";
                else{
                    tipo = "red";
                    $.alert({
                        title:"<h3>Helping Hands</h3>",
                        content:AX.msj,
                        type:tipo,
                        icon:"fas fa-info-circle fa-2x",
                        boxWidth: "50%",
                        useBootstrap: false,
                        onDestroy:function(){
                        }
                    });
                }
            }
        });
    });
});