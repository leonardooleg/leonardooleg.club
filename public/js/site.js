$(document).ready(function(){
    $("body").on("click","#menu1 .dropdown-toggle", function( event ) {
        if ($(document).width() > 768) {
            e.preventDefault();
            var url = $(this).attr('href');
            if (url !== '#') {
                window.location.href = url;
            }
        }
    });
    $("body").on("click", ".filter__cancel", function() {
        $('input:checked').attr('checked',false);
        console.log('clear');
    });

/*Мобильное боковое меню*/
    $( ".menu_Mob.menu_1 select" )
        .change(function () {
            var str;
            str =$(this).find('option:selected').attr("class");
            str = $.trim(str);
            $( '.menu_2 select').css("display","none");
            $( '.menu_3 select').css("display","none");
            $( '.menu_2 .'+str ).css("display","block");
        });
    $( ".menu_Mob.menu_2 select" )
        .change(function () {
            var str;
            str =$(this).find('option:selected').attr("class");
            str = $.trim(str);
            $( '.menu_3 select').css("display","none");
            if(str){
                $( '.menu_3 .'+str ).css("display","block");
            }
        })
        .change();
    $( ".menu_go" ).click(function() {
        var link;
        console.log('click');
        link = $( '.menu_Mob select[style*="display: block"] option:selected').last().attr("link");
        window.location = link;
        console.log(link);
    });
    function menu_function(){
        var str;
        str =$('.menu_1').find('option:selected').attr("class");
        str = $.trim(str);
        var str2;
        str2 =$('.'+str).find('option:selected').attr("class");
        str2 = $.trim(str2);
        $( '.menu_2 select').css("display","none");
        $( '.menu_3 select').css("display","none");
        $( '.menu_2 .'+str ).css("display","block");
        if(str2){
            $( '.menu_3 .'+str2 ).css("display","block");
        }
    }
    menu_function();
/*Мобильное боковое меню*/

});
/*Стрелка вверх*/
// ===== Scroll to Top ====
$(window).scroll(function() {
    if ($(this).scrollTop() >= 50) {        // If page is scrolled more than 50px
        $('#return-to-top').fadeIn(200);    // Fade in the arrow
    } else {
        $('#return-to-top').fadeOut(200);   // Else fade out the arrow
    }
});
$('#return-to-top').click(function() {      // When arrow is clicked
    $('body,html').animate({
        scrollTop : 0                       // Scroll to top of body
    }, 500);
});
/*Стрелка вверх*/

function search_line(line) {
    var sea = $( line);
    var li = $( '#search_mob');
    sea.show();
    li.hide();
    $( ".search-line" ).show();
}
