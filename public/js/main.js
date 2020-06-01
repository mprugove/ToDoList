	$(document).ready(function() {
        $('html, body').animate({scrollTop : navbarHeight}, 500);
        	// place footer always on the bottom of window
	var windowHeight = $(window).outerHeight();
	var navbarHeight = $("#app nav.navbar").outerHeight();
	var mainHeight = $("main.main").outerHeight();
	var mainContent = $("div.main-content");
	
	var extraHeight = windowHeight - navbarHeight - mainHeight;
	var newHeight = mainContent.outerHeight() + extraHeight;

	mainContent.css("min-height", newHeight);
	
        $('table, #fade').css('display', 'none');
        $('table, #fade').fadeIn(1000);

        $('hr, #fadeSlow').css('display', 'none');
        $('hr, #fadeSlow').fadeIn(1500);
    
        /*  $('navbar').css('display','none');
        $('navbar').show(500);
        */
       
   
    });

    