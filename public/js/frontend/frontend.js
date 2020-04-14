$(document).ready(function(){
        $("#nav > li > a").on("click", function(e){
            if($(this).parent().has("ul")) {
                e.preventDefault();
            }
            if (!$(this).hasClass("open")) {
                // hide any open menus and remove all other classes
                $("#nav li ul").slideUp(350);
                $("#nav li a").removeClass("open");

                // open our new menu and add the open class
                $(this).next("ul").slideDown(350);
                $(this).addClass("open");
                $('.caret-icon').toggleClass('fa-caret-up fa-caret-down');
            }

            else if ($(this).hasClass("open")) {
                $(this).removeClass("open");
                $(this).next("ul").slideUp(350);
                $('.caret-icon').toggleClass('fa-caret-up fa-caret-down');
            }
        });
        $('header.page-header').hover(
            function() { $('.burger-text').addClass('hover-text') },
            function(){ $('.burger-text').removeClass('hover-text') }
        )
    $('header.page-header').hover(
        function() { $('div.x').addClass('hover-bg') },
        function(){ $('div.x').removeClass('hover-bg') }
    )
    $('header.page-header').hover(
        function() { $('div.y').addClass('hover-bg') },
        function(){ $('div.y').removeClass('hover-bg') }
    )
    $('header.page-header').hover(
        function() { $('div.z').addClass('hover-bg') },
        function(){ $('div.z').removeClass('hover-bg') }
    )



$('input:checkbox').change(function(){
    if($(this).is(":checked")) {
        $(this).next('label').addClass('cbSelected');
        console.log("Checked");
    } else {
        $(this).next('label').removeClass('cbSelected');
        console.log("Not Checked");
    }
});
});
