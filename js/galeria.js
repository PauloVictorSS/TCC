$(function(){
    
    var curSlide = 0; //Número da primeira imagem a ser mostrada
    var delay = 7; //Tempo de espera para mduar a imagem sozinha (em seg) 
    var maxSlide = $('.banner-single').length - 1; //Retornando a quantidade de imagens do slide
    var interval;

    //changeSlide();
    initSlider();

    //Função que inicia os slides e cria os bullets(botões)
    //de acordo com a quantidade de imagens disponíveis
    function initSlider(){
        $('.banner-single').hide();
        $('.banner-single').eq(0).show();
        for(var i = 0; i <= maxSlide; i++){
            var content = $('.bullets').html();

            if(i == 0)
                content+="<span class='active-slider'></span>";
            else
                content+="<span></span>";

            $('.bullets').html(content);
        }
    }

    //Essa função faz os slides mudarem conforme o tempo
    function changeSlide() {

        //Função que se repete a cada determinado tempo
        interval = setInterval(function(){

            //Trocando as imagens
            $('.banner-single').eq(curSlide).stop().fadeOut(2000);
            curSlide++;
            if(curSlide > maxSlide)
                curSlide = 0;
            $('.banner-single').eq(curSlide).stop().fadeIn(2000);

            //Trocar a cor do bullets da imagem correspondente
            $('.bullets span').removeClass('active-slider');
            $('.bullets span').eq(curSlide).addClass('active-slider');

        },delay * 1000)
    }

    //Função para trocar a imagem ao clicar em um determinado bullet
    $('body').on('click', '.bullets span', function(){
        var currentBullet = $(this);

        //Trocando a imagem do bullet selecionado
        $('.banner-single').eq(curSlide).stop().fadeOut(1000);
        curSlide = currentBullet.index();
        $('.banner-single').eq(curSlide).stop().fadeIn(1000);

        //Trocar a cor do bullets da imagem correspondente
        $('.bullets span').removeClass('active-slider');
        currentBullet.addClass('active-slider');

        //clearInterval(interval);
        //changeSlide();

    })
})