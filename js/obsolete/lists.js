$(document).ready(function(){ 
	//$('input#brand').quicksearch('div.brand_menu span.fltr-val__lbl');
	//$('input#brand').quicksearch('div.brand_menu label span.fltr-val__lbl');
	 $("img.lazy").lazyload({
		 effect : "fadeIn"
	 });
	 $(document).on("click","a.changea",function(e){ 
	// alert(1);
		// window.location = $(this).attr('href');
		// $(this).attr('href','#');
		//  e.preventDefault();
		window.location.reload();
		 // return false;
	 });
	 
	 
	  $('.dropdown').on( 'click', '.dropdown-menu li a', function() { 
		   var target = $(this).html();

		   //Adds active class to selected item
		   $(this).parents('.dropdown-menu').find('li').removeClass('active');
		   $(this).parent('li').addClass('active');

		   //Displays selected text on dropdown-toggle button
		   $(this).parents('.dropdown').find('.dropdown-toggle').html(target + ' <span class="caret"></span>');
		   $('input#group').val(target);
		});
		
		$('.searchbox').on('click','a.search-button', function(){
			$('form.searchbox').submit();
		});
		
		
	 
	 
	 
	 
	 
});