$(document).ready(function(){
	$('.main-categories-content .mc-list li .fa').click(function(e){
		$(this).parents('li').toggleClass('active');
	})
	
	$('.xemthem').click(function(e){	
		
		$(this).parent().parent().find('.fix-show').addClass('show');
		$(this).hide();
		$('.thugon').show();
	})
	$('.thugon').click(function(e){		
		$(this).parent().parent().find('.fix-show').removeClass('show');
		$(this).hide();
		$('.xemthem').show();
	})

	// RELATED PRODUCTS
	var owl_related_products = $(".owl_related_products");
	owl_related_products.owlCarousel({
		autoPlay: false,
		pagination: false,
		navigation: false,
		navigationText: false,
		itemsCustom : [
			[0, 1],
			[450, 1],
			[600, 1],
			[700, 1],
			[1000, 1],
			[1200, 1],
			[1400, 1],
			[1600, 1]
		],
	});


	// HOT SALE PRODUCT
	var owl_hot_sale = $("#owl-hot-sale");
	owl_hot_sale.owlCarousel({
		autoPlay: false,
		pagination: false,
		navigation: false,
		navigationText: false,
		itemsCustom : [
			[0, 1],
			[450, 1],
			[600, 1],
			[700, 1],
			[1000, 1],
			[1200, 1],
			[1400, 1],
			[1600, 1]
		],
	});
	$(".hot_sale_navigator .next").click(function(){
		owl_hot_sale.trigger('owl.next');
	})
	$(".hot_sale_navigator .prev").click(function(){
		owl_hot_sale.trigger('owl.prev');
	})


	var owl_news_blog = $("#owl-news-blog");
	owl_news_blog.owlCarousel({
		autoPlay: false,
		pagination: false,
		navigation: false,
		navigationText: false,
		itemsCustom : [
			[0, 1],
			[450, 1],
			[600, 1],
			[700, 1],
			[1000, 1],
			[1200, 1],
			[1400, 1],
			[1600, 1]
		],
	});
	$(".blog-navigator .next").click(function(){
		owl_news_blog.trigger('owl.next');
	})
	$(".blog-navigator .prev").click(function(){
		owl_news_blog.trigger('owl.prev');
	});

	$(".main-slider-content").owlCarousel({
		autoPlay: 3000, //Set AutoPlay to 3 seconds
		pagination: false,
		navigation: false,
		navigationText: false,
		singleItem: true
	});

	$(".product-list-carousel").owlCarousel({
		autoPlay: 4000, //Set AutoPlay to 3 seconds
		pagination: false,
		navigation: true,
		navigationText: false,
		items: 4
	});

	$("#news-slider").owlCarousel({
		autoPlay: 4000, //Set AutoPlay to 3 seconds
		pagination: false,
		navigation: true,
		navigationText: false,
		items: 4
	});
	$(".partner-list-carousel").owlCarousel({
		autoPlay: 4000, //Set AutoPlay to 3 seconds
		pagination: false,
		navigation: true,
		navigationText: false,
		items: 6
	});
	$(".brand-carousel").owlCarousel({
		autoPlay: 3000, //Set AutoPlay to 3 seconds
		pagination: false,
		navigation: true,
		navigationText: false,
		items: 6
	});
	/** click to expand main 
    $(".mc-list li a").on("click", function(){
        var mcsp = $(this);
        var mcl = $(this).parent().find(".mc-list-child");
        mcl.toggle();
        if(mcl.is(":visible")) {
            mcsp.find(".fa").removeClass("fa-angle-right").addClass("fa-angle-down");
        } else {
            mcsp.find(".fa").removeClass("fa-angle-down").addClass("fa-angle-right");
        }
    });
	**/
	$(".cc-list li a").on("click", function(){
		var ccsp = $(this);
		var ccl = $(this).parent().find(".cc-list-child");
		ccl.toggle();
		if(ccl.is(":visible")) {
			ccsp.find(".fa").removeClass("fa-caret-right").addClass("fa-caret-down");
		} else {
			ccsp.find(".fa").removeClass("fa-caret-down").addClass("fa-caret-right");
		}
	});

	$(".header-menu-btn span").on("click",function(){
		$(".header-nav-mobile").css("left","0px");
	});
	$(".header-menu-btn-hidden").on("click", function(){
		$(".header-nav-mobile").css("left","-300px");
	});

	$(".product-list-list").hide();

	$(".btn-view-grid").on("click", function(){
		$(".product-list-grid").show();
		$(".product-list-list").hide();
	});
	$(".btn-view-list").on("click", function(){
		$(".product-list-grid").hide();
		$(".product-list-list").show();
	});


	if ($(window).width() <= 768){
		$('.mc-list li a span').click(function(){
			$(this).parent('a').next().slideToggle('slow');
		})

		$('.cc-list li a span').click(function (){
			$(this).parent('a').next().slideToggle('slow');
		});
	};

	var elements = $("input, select, textarea");
	for (var i = 0; i < elements.length; i++) {
		elements[i].oninvalid = function(e) {
			e.target.setCustomValidity("");
			if (!e.target.validity.valid) {
				e.target.setCustomValidity(e.target.getAttribute("requiredmsg"));
			}
		};
		elements[i].oninput = function(e) {
			e.target.setCustomValidity("");
		};
	}
	
});