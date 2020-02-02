var url = "http://localhost/dashboard/php/blog/public";

window.addEventListener("load",function(){
    //Boton de like
    function like(){
        $('.btn-like').unbind('click').click(function(){
            console.log("like");
            $(this).addClass('btn-dislike').removeClass('btn-like');
            $(this).attr('src', url+'/img/heart-red.jpg' );

            $.ajax({
                url: url+'/like/'+$(this).data('id'),
                'type':'GET',
                success:function(response){
                    if(response.like){
                    console.log("Has dado like a la publicacón");
                    }else{
                        console.log("Error al dar like");
                    }
                }
            })

            dislike();
        });
    }

    like();
        //Boton de Dislike
    function dislike(){
        console.log("Dislike");
        $('.btn-dislike').unbind('click').click(function(){
            $(this).addClass('btn-like').removeClass('btn-dislike');
            $(this).attr('src', url+'/img/heart-black.jpg');
            $.ajax({
                url: url+'/dislike/'+$(this).data('id'),
                'type':'GET',
                success:function(response){
                    if(response.like){
                    console.log("Has dado dislike a la publicacón");
                    }else{
                        console.log("Error al dar dislike");
                    }
                }
            })
            like();
        });
    }
    dislike();


    $('#buscador').submit(function(){
        
        $(this).attr('action',url+'/gente/'+$('#buscador #search').val());
       
    })
})