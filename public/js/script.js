$(".menu > ul > li > a").click(function(e){
    // Remove active classes from all menu items and their submenus
    $(".menu > ul > li").removeClass("active");
    $(".menu ul li a").siblings().find("li").removeClass("active"); // Remove active from submenus
    $(".sub-menu li").removeClass("active");

    // Add active class to the clicked menu item
    $(this).parent().addClass("active");

    if($(this).siblings("ul").length > 0) {
        e.preventDefault(); // Prevent default action for items with submenus
    }

    $(this).siblings("ul").slideToggle();
    $(this).parent().siblings().find("ul").slideUp();
});
$(".menu-btn").click(function(){
    $(".sidebar").toggleClass("active");
});
// For submenu items
// For submenu items
$(".sub-menu li a").click(function(e){
    $(".sub-menu li").removeClass("active"); // Remove active class from all sub-menu items
    $(this).parent().addClass("active"); // Add active class to clicked sub-menu item
    $(this).closest("li").addClass("active"); // Keep the main menu active
});

