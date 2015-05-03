        var clicked = 0;
        var navWidth = $('#left').width();
        $('#toggleNav').click(function(){
            if (clicked == 0){
                clicked = 1;
                console.log("OPEN");
                $('#left').animate({marginLeft: "0px"}, 400);
                $('#right').animate({marginLeft: '260px'}, 400);
                $('#right-wrap').animate({marginLeft: '0px'}, 400);
                $("#toggleNav i").css({
                 transform: 'rotateZ(180deg)',
                 MozTransform: 'rotateZ(180deg)',
                 WebkitTransform: 'rotateZ(180deg)',
                 msTransform: 'rotateZ(180deg)',
                 transition: '0.5s'
                })
                $( "#toggleNav span" ).empty();
                $( "#toggleNav span" ).append('Verberg navigatie');
            }
            
            else
            {
                console.log("CLOSED");
                clicked = 0;
                $('#left').animate({marginLeft: '-'+navWidth+'px'}, 400);
                $('#right').animate({marginLeft: '0px'}, 400);
                $('#right-wrap').animate({marginLeft: '20px'}, 400);
                $("#toggleNav i").css({
                 transform: 'rotateZ(0deg)',
                 MozTransform: 'rotateZ(0deg)',
                 WebkitTransform: 'rotateZ(0deg)',
                 msTransform: 'rotateZ(0deg)',
                 transition: '0.5s'
                })
                $( "#toggleNav span" ).empty();
                $( "#toggleNav span" ).append('Toon navigatie');
            }
        });