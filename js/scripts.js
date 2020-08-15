$(function(){

    //Verificando se uma das âncoras do menu foi clicada
    if($('target').length > 0){
        var elemento = '#'+$('target').attr('target'); //Verificando qual âncora foi selecionada
        var divScroll = $(elemento).offset().top; //Retornando a 'distância' da âncora selecionada

        //Verificando qual a distância para aplicar uma velocidade de animação diferente
        if(divScroll > 1000){
            //Indo até um elemento selecionado de forma mais rápida
            $('html,body').animate({scrollTop:divScroll}, 1800); 
        }
        else{
            //Indo até um elemento selecionado de forma mais lenta
            $('html,body').animate({scrollTop:divScroll}, 1000);
        }
        
    }


})