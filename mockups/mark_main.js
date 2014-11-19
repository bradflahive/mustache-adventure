$(function(){

    $('body').on('click','a', function(){
        $(this).parents().toggleClass('.signup');
    });


})