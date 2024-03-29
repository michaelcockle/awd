/* ============================================================
 * bootstrap-dropdown.js v2.1.0 - http://twitter.github.com/bootstrap/javascript.html#dropdowns - Copyright 2012 Twitter, Inc.
 * ============================================================ */


!function ($) {

  "use strict"; // jshint ;_;


 /* DROPDOWN CLASS DEFINITION
  * ========================= */

  var toggle = '[data-toggle=dropdown]'
    , Dropdown = function (element) {
        var $el = $(element).on('click.dropdown.data-api', this.toggle)
        $('html').on('click.dropdown.data-api', function () {
          $el.parent().removeClass('open')
        })
      }

  Dropdown.prototype = {

    constructor: Dropdown

  , toggle: function (e) {
      var $this = $(this)
        , $parent
        , isActive

      if ($this.is('.disabled, :disabled')) return

      $parent = getParent($this)

      isActive = $parent.hasClass('open')

      clearMenus()

      if (!isActive) {
        $parent.toggleClass('open')
        $this.focus()
      }

      return false
    }

  , keydown: function (e) {
      var $this
        , $items
        , $active
        , $parent
        , isActive
        , index

      if (!/(38|40|27)/.test(e.keyCode)) return

      $this = $(this)

      e.preventDefault()
      e.stopPropagation()

      if ($this.is('.disabled, :disabled')) return

      $parent = getParent($this)

      isActive = $parent.hasClass('open')

      if (!isActive || (isActive && e.keyCode == 27)) return $this.click()

      $items = $('[role=menu] li:not(.divider) a', $parent)

      if (!$items.length) return

      index = $items.index($items.filter(':focus'))

      if (e.keyCode == 38 && index > 0) index--                                        // up
      if (e.keyCode == 40 && index < $items.length - 1) index++                        // down
      if (!~index) index = 0

      $items
        .eq(index)
        .focus()
    }

  }

  function clearMenus() {
    getParent($(toggle))
      .removeClass('open')
  }

  function getParent($this) {
    var selector = $this.attr('data-target')
      , $parent

    if (!selector) {
      selector = $this.attr('href')
      selector = selector && selector.replace(/.*(?=#[^\s]*$)/, '') //strip for ie7
    }

    $parent = $(selector)
    $parent.length || ($parent = $this.parent())

    return $parent
  }


  /* DROPDOWN PLUGIN DEFINITION
   * ========================== */

  $.fn.dropdown = function (option) {
    return this.each(function () {
      var $this = $(this)
        , data = $this.data('dropdown')
      if (!data) $this.data('dropdown', (data = new Dropdown(this)))
      if (typeof option == 'string') data[option].call($this)
    })
  }

  $.fn.dropdown.Constructor = Dropdown


  /* APPLY TO STANDARD DROPDOWN ELEMENTS
   * =================================== */

  $(function () {
    $('html')
      .on('click.dropdown.data-api touchstart.dropdown.data-api', clearMenus)
    $('body')
      .on('click.dropdown touchstart.dropdown.data-api', '.dropdown', function (e) { e.stopPropagation() })
      .on('click.dropdown.data-api touchstart.dropdown.data-api'  , toggle, Dropdown.prototype.toggle)
      .on('keydown.dropdown.data-api touchstart.dropdown.data-api', toggle + ', [role=menu]' , Dropdown.prototype.keydown)
  })

}(window.jQuery);


/* =============================================================
 * bootstrap-collapse.js v2.1.0 - http://twitter.github.com/bootstrap/javascript.html#collapse - Copyright 2012 Twitter, Inc.
 * =============================================================*/


!function ($) {

  "use strict"; // jshint ;_;


 /* COLLAPSE PUBLIC CLASS DEFINITION
  * ================================ */

  var Collapse = function (element, options) {
    this.$element = $(element)
    this.options = $.extend({}, $.fn.collapse.defaults, options)

    if (this.options.parent) {
      this.$parent = $(this.options.parent)
    }

    this.options.toggle && this.toggle()
  }

  Collapse.prototype = {

    constructor: Collapse

  , dimension: function () {
      var hasWidth = this.$element.hasClass('width')
      return hasWidth ? 'width' : 'height'
    }

  , show: function () {
      var dimension
        , scroll
        , actives
        , hasData

      if (this.transitioning) return

      dimension = this.dimension()
      scroll = $.camelCase(['scroll', dimension].join('-'))
      actives = this.$parent && this.$parent.find('> .accordion-group > .in')

      if (actives && actives.length) {
        hasData = actives.data('collapse')
        if (hasData && hasData.transitioning) return
        actives.collapse('hide')
        hasData || actives.data('collapse', null)
      }

      this.$element[dimension](0)
      this.transition('addClass', $.Event('show'), 'shown')
      $.support.transition && this.$element[dimension](this.$element[0][scroll])
    }

  , hide: function () {
      var dimension
      if (this.transitioning) return
      dimension = this.dimension()
      this.reset(this.$element[dimension]())
      this.transition('removeClass', $.Event('hide'), 'hidden')
      this.$element[dimension](0)
    }

  , reset: function (size) {
      var dimension = this.dimension()

      this.$element
        .removeClass('collapse')
        [dimension](size || 'auto')
        [0].offsetWidth

      this.$element[size !== null ? 'addClass' : 'removeClass']('collapse')

      return this
    }

  , transition: function (method, startEvent, completeEvent) {
      var that = this
        , complete = function () {
            if (startEvent.type == 'show') that.reset()
            that.transitioning = 0
            that.$element.trigger(completeEvent)
          }

      this.$element.trigger(startEvent)

      if (startEvent.isDefaultPrevented()) return

      this.transitioning = 1

      this.$element[method]('in')

      $.support.transition && this.$element.hasClass('collapse') ?
        this.$element.one($.support.transition.end, complete) :
        complete()
    }

  , toggle: function () {
      this[this.$element.hasClass('in') ? 'hide' : 'show']()
    }

  }


 /* COLLAPSIBLE PLUGIN DEFINITION
  * ============================== */

  $.fn.collapse = function (option) {
    return this.each(function () {
      var $this = $(this)
        , data = $this.data('collapse')
        , options = typeof option == 'object' && option
      if (!data) $this.data('collapse', (data = new Collapse(this, options)))
      if (typeof option == 'string') data[option]()
    })
  }

  $.fn.collapse.defaults = {
    toggle: true
  }

  $.fn.collapse.Constructor = Collapse


 /* COLLAPSIBLE DATA-API
  * ==================== */

  $(function () {
    $('body').on('click.collapse.data-api', '[data-toggle=collapse]', function (e) {
      var $this = $(this), href
        , target = $this.attr('data-target')
          || e.preventDefault()
          || (href = $this.attr('href')) && href.replace(/.*(?=#[^\s]+$)/, '') //strip for ie7
        , option = $(target).data('collapse') ? 'toggle' : $this.data()
      $this[$(target).hasClass('in') ? 'addClass' : 'removeClass']('collapsed')
      $(target).collapse(option)
    })
  })

}(window.jQuery);

/*
* Placeholder plugin for jQuery
* ---
* Copyright 2010, Daniel Stocks (http://webcloud.se)
* Released under the MIT, BSD, and GPL Licenses.
*/
(function($) {
    function Placeholder(input) {
        this.input = input;
        if (input.attr('type') == 'password') {
            this.handlePassword();
        }
        // Prevent placeholder values from submitting
        $(input[0].form).submit(function() {
            if (input.hasClass('placeholder') && input[0].value == input.attr('placeholder')) {
                input[0].value = '';
            }
        });
    }
    Placeholder.prototype = {
        show : function(loading) {
            // FF and IE saves values when you refresh the page. If the user refreshes the page with
            // the placeholders showing they will be the default values and the input fields won't be empty.
            if (this.input[0].value === '' || (loading && this.valueIsPlaceholder())) {
                if (this.isPassword) {
                    try {
                        this.input[0].setAttribute('type', 'text');
                    } catch (e) {
                        this.input.before(this.fakePassword.show()).hide();
                    }
                }
                this.input.addClass('placeholder');
                this.input[0].value = this.input.attr('placeholder');
            }
        },
        hide : function() {
            if (this.valueIsPlaceholder() && this.input.hasClass('placeholder')) {
                this.input.removeClass('placeholder');
                this.input[0].value = '';
                if (this.isPassword) {
                    try {
                        this.input[0].setAttribute('type', 'password');
                    } catch (e) { }
                    // Restore focus for Opera and IE
                    this.input.show();
                    this.input[0].focus();
                }
            }
        },
        valueIsPlaceholder : function() {
            return this.input[0].value == this.input.attr('placeholder');
        },
        handlePassword: function() {
            var input = this.input;
            input.attr('realType', 'password');
            this.isPassword = true;
            // IE < 9 doesn't allow changing the type of password inputs
            if ($.browser.msie && input[0].outerHTML) {
                var fakeHTML = $(input[0].outerHTML.replace(/type=(['"])?password\1/gi, 'type=$1text$1'));
                this.fakePassword = fakeHTML.val(input.attr('placeholder')).addClass('placeholder').focus(function() {
                    input.trigger('focus');
                    $(this).hide();
                });
                $(input[0].form).submit(function() {
                    fakeHTML.remove();
                    input.show()
                });
            }
        }
    };
    var NATIVE_SUPPORT = !!("placeholder" in document.createElement( "input" ));
    $.fn.placeholder = function() {
        return NATIVE_SUPPORT ? this : this.each(function() {
            var input = $(this);
            var placeholder = new Placeholder(input);
            placeholder.show(true);
            input.focus(function() {
                placeholder.hide();
            });
            input.blur(function() {
                placeholder.show(false);
            });

            // On page refresh, IE doesn't re-populate user input
            // until the window.onload event is fired.
            if ($.browser.msie) {
                $(window).load(function() {
                    if(input.val()) {
                        input.removeClass("placeholder");
                    }
                    placeholder.show(true);
                });
                // What's even worse, the text cursor disappears
                // when tabbing between text inputs, here's a fix
                input.focus(function() {
                    if(this.value == "") {
                        var range = this.createTextRange();
                        range.collapse(true);
                        range.moveStart('character', 0);
                        range.select();
                    }
                });
            }
        });
    }
})(jQuery);




//------------------------------

/*global jQuery */
/*jshint multistr:true browser:true */
/*!
* FitVids 1.0
*
* Copyright 2011, Chris Coyier - http://css-tricks.com + Dave Rupert - http://daverupert.com
* Credit to Thierry Koblentz - http://www.alistapart.com/articles/creating-intrinsic-ratios-for-video/
* Released under the WTFPL license - http://sam.zoy.org/wtfpl/
*
* Date: Thu Sept 01 18:00:00 2011 -0500
*/

(function( $ ){

  "use strict";

  $.fn.fitVids = function( options ) {
    var settings = {
      customSelector: null
    };

    var div = document.createElement('div'),
        ref = document.getElementsByTagName('base')[0] || document.getElementsByTagName('script')[0];

    div.className = 'fit-vids-style';
    div.innerHTML = '&shy;<style>         \
      .fluid-width-video-wrapper {        \
         width: 100%;                     \
         position: relative;              \
         padding: 0;                      \
      }                                   \
                                          \
      .fluid-width-video-wrapper iframe,  \
      .fluid-width-video-wrapper object,  \
      .fluid-width-video-wrapper embed {  \
         position: absolute;              \
         top: 0;                          \
         left: 0;                         \
         width: 100%;                     \
         height: 100%;                    \
      }                                   \
    </style>';

    ref.parentNode.insertBefore(div,ref);

    if ( options ) {
      $.extend( settings, options );
    }

    return this.each(function(){
      var selectors = [
        "iframe[src*='player.vimeo.com']",
        "iframe[src*='www.youtube.com']",
        "iframe[src*='www.youtube-nocookie.com']",
        "iframe[src*='www.kickstarter.com']",
        "object",
        "embed"
      ];

      if (settings.customSelector) {
        selectors.push(settings.customSelector);
      }

      var $allVideos = $(this).find(selectors.join(','));

      $allVideos.each(function(){
        var $this = $(this);
        if (this.tagName.toLowerCase() === 'embed' && $this.parent('object').length || $this.parent('.fluid-width-video-wrapper').length) { return; }
        var height = ( this.tagName.toLowerCase() === 'object' || ($this.attr('height') && !isNaN(parseInt($this.attr('height'), 10))) ) ? parseInt($this.attr('height'), 10) : $this.height(),
            width = !isNaN(parseInt($this.attr('width'), 10)) ? parseInt($this.attr('width'), 10) : $this.width(),
            aspectRatio = height / width;
        if(!$this.attr('id')){
          var videoID = 'fitvid' + Math.floor(Math.random()*999999);
          $this.attr('id', videoID);
        }
        $this.wrap('<div class="fluid-width-video-wrapper"></div>').parent('.fluid-width-video-wrapper').css('padding-top', (aspectRatio * 100)+"%");
        $this.removeAttr('height').removeAttr('width');
      });
    });
  };
})( jQuery );




/*
function getWindowHeight() {
	var windowHeight = 0;
	if (typeof(window.innerHeight) == 'number') {
		windowHeight = window.innerHeight;
	}
	else {
		if (document.documentElement && document.documentElement.clientHeight) {
			windowHeight = document.documentElement.clientHeight;
		}
		else {
			if (document.body && document.body.clientHeight) {
				windowHeight = document.body.clientHeight;
			}
		}
	}
	return windowHeight;
}
function setFooter() {
	if (document.getElementById) {
		var windowHeight = getWindowHeight();
		if (windowHeight > 0) {
			var contentHeight = document.getElementById('content').offsetHeight;
			var footerElement = document.getElementById('footer');
			var footerHeight  = footerElement.offsetHeight;
			if (windowHeight - (contentHeight + footerHeight) >= 0) {
				footerElement.style.top = (windowHeight - (contentHeight + footerHeight + 134)) + 'px';
				// + 134 for the body padding that puts the content underneath fixed header nav
			}
			else {
				footerElement.style.top = '0px';
			}
		}
	}
}
window.onload = function() {
	setFooter();
}
window.onresize = function() {
	setFooter();
}
*/


















/*
if (winWidth < 980) {
        //$("#msg").text('< 980');
        
        
        $('span#A').text('Axis');
        $('span#W').text('web');
        $('span#D').text(' Developments');
        $('span#A').css('color', 'blue');
        
    }
    if (winWidth > 980) {

        $("#msg").text('');
        $('span#A').text('A');
        $('span#W').text('W');
        $('span#D').text('D');
    }
*/










/*
  * Normalized hide address bar for iOS & Android  * (c) Scott Jehl, scottjehl.com  * MIT License
  http://24ways.org/2011/raising-the-bar-on-mobile
*/


(function( win ){
	var doc = win.document;

	// If there's a hash, or addEventListener is undefined, stop here
	if( !location.hash && win.addEventListener ){

		//scroll to 1
		window.scrollTo( 0, 1 );
		var scrollTop = 1,
			getScrollTop = function(){
				return win.pageYOffset || doc.compatMode === "CSS1Compat" && doc.documentElement.scrollTop || doc.body.scrollTop || 0;
			},

			//reset to 0 on bodyready, if needed
			bodycheck = setInterval(function(){
				if( doc.body ){
					clearInterval( bodycheck );
					scrollTop = getScrollTop();
					win.scrollTo( 0, scrollTop === 1 ? 0 : 1 );
				}	
			}, 15 );

		win.addEventListener( "load", function(){
			setTimeout(function(){
				//at load, if user hasn't scrolled more than 20 or so...
				if( getScrollTop() < 20 ){
					//reset to hide addr bar at onload
					win.scrollTo( 0, scrollTop === 1 ? 0 : 1 );
				}
			}, 0);
		} );
	}
})( this );





$(document).ready(function(){
    $(window).bind("load resize", function(){
        var winWidth =  $(this).width();
        var winHeight = $(this).height();
        //console.log(winWidth);
        //console.log(winHeight);
        $("#width").text(' ' + winWidth);
        $("#height").text(' | ' + winHeight);

        if (winWidth > 1 ) {
            
            $("#msg").text(' Portrait Phones');
        }

        if (winWidth > 481) {
            $("#msg").text(' Landscape Phones');
            
        }

        if (winWidth > 767) {
            $("#msg").text(' Landscape Phone - (Portrait Tablet) ');
        }

        if (winWidth > 980) {
            $("#msg").text(' | Desktop');
        }

        if (winWidth > 1200) {
            $("#msg").text('| Large Desktop');
        }
        $('#msg').css('color','#FF3C1E').css('font-weight','bold');

        // ------------------------------------------
        if (winWidth <= 979) {
            $('.awd-icons').css('display','block');
            $('.awd-icons').detach().appendTo($('#attach-icons1'));
        } else if (winWidth > 979) {
            $('.awd-icons').detach().appendTo($('#attach-icons2'));
        }

    });



/*$(window).sizeFunc*/


/*$(window).resize(function()  {
    sizeFunc();
}

$(window).load(function()  {
    sizeFunc();
}
*/








	/*	Image Slider Init --------------------------------------	 */ 

	$(window).load(function(){
	  $('.imgSlider').flexslider({
	  	namespace: "flex-", 
	  	selector: ".slides > li",
	    animation: "slide",
	    easing: "swing",
	    slideshow: false,
	    animationLoop: true,
	    slideshowSpeed: 7000,
	    animationSpeed: 600,
	    pauseOnAction: true,
		pauseOnHover: true,
		itemWidth: 0, 
		itemMargin: 0,
		minItems: 0,
		maxItems: 0,
	    controlNav: true, 
	    pausePlay: false,
	    prevText: "Previous",
	    nextText: "Next",
	    pauseText: 'Pause',
	    playText: 'Play',
	    start: function(slider){
	      $('body').removeClass('loading');
	    }
	  });
	});

	/* Film Slider Init --------------------------------------	 */ 

	$(window).load(function(){
	  $('.filmSlider').flexslider({
	  	namespace: "flex-", 
	  	selector: ".slides > li",
	    animation: "slide",
	    easing: "swing",
	    slideshow: false,
	    video: true,
	    animationLoop: true,
	    pauseOnAction: true,
		pauseOnHover: true,
	    controlNav: true,
	    pausePlay: false,
	    prevText: "Previous",
	    nextText: "Next",
	    pauseText: 'Pause',
	    playText: 'Play',
	    start: function(slider){
	      $('body').removeClass('loading');
	    }
	  });
	});

	/*	Film + Thumbnail Carousel Slider Init ----------------------------------------*/

	$(window).load(function(){
	  $('#carousel').flexslider({
	    animation: "slide",
	    controlNav: false,
	    animationLoop: false,
	    slideshow: false,
	    itemWidth: 210,
	    itemMargin: 5,
	    asNavFor: '#slider'
	  });
	  
	  $('#slider').flexslider({
	    animation: "slide",
	    video: true,
	    controlNav: false,
	    animationLoop: false,
	    slideshow: false,
	    sync: "#carousel",
	    start: function(slider){
	      $('body').removeClass('loading');
	    }
	  });
	});

	/*	Service Slider Init ----------------------------*/

// Set the slide number from the data attribute in services.php which gets it from the query string in the link in index
var slideQuery = $('#services').data('slidenumber');

	$(window).load(function(){
	  $('#serviceSlider').flexslider({
      namespace: "flex-", 
      selector: ".slides > li",
      animation: "slide",
      easing: "swing",
      slideshow: false,
      animationLoop: true,
      slideshowSpeed: 7000,
      animationSpeed: 600,
      pauseOnAction: true,
      pauseOnHover: true,
      smoothHeight: true,
      itemWidth: 0, 
      itemMargin: 0,
      minItems: 0,
      maxItems: 0,
      controlNav: false,              
      directionNav: false,
      pausePlay: false,
      startAt: slideQuery,
      start: function(slider){
      $('body').removeClass('loading');
	    }
	  });
	});

	/*Buttons for Services slider navigation*/

	/*Web*/
	$('#servBtn1').click(function (e) {
	    $('#serviceSlider').flexslider(0);
	    e.preventDefault();
	});
	/*strategy*/
	$('#servBtn2').click(function (e) {
	    $('#serviceSlider').flexslider(1);
	    e.preventDefault();
	});
	/*film*/
	$('#servBtn3').click(function (e) {
	    $('#serviceSlider').flexslider(2);
	    e.preventDefault();
	});
	/*training*/
	$('#servBtn4').click(function (e) {
	    $('#serviceSlider').flexslider(3);
	    e.preventDefault();
	});
	/*mobile*/
	$('#servBtn5').click(function (e) {
	    $('#serviceSlider').flexslider(4);
	    e.preventDefault();
	});
	/*interactive*/
	$('#servBtn6').click(function (e) {
	    $('#serviceSlider').flexslider(5);
	    e.preventDefault();
	});

//-------------------------------------------

	$('#home-slider').flexslider({
	    animation: "slide",
	    slideToStart: 0,
	    //controlNav: false,
	    directionNav: false,
	    slideshow: false,
	    animationSpeed: 1000,
	    start: function(slider) {
	        $('a.slide_thumb').click(function() {
	            $('.flexslider').show();
	            var slideTo = $(this).attr("rel")//Grab rel value from link;
	            var slideToInt = parseInt(slideTo)//Make sure that this value is an integer;
	            if (slider.currentSlide != slideToInt) {
	                slider.flexAnimate(slideToInt)//move the slider to the correct slide (Unless the slider is also already showing the slide we want);
	            }
	        });
	    }

	});

	$('#home-info-slider').flexslider({
	    animation: "fade",
	    slideToStart: 0,
	    controlNav: false,
	    directionNav: false, 
	    slideshow: false,
	    animationSpeed: 1500,
	    start: function(slider) {
	        $('a.slide_thumb').click(function() {
	            $('.flexslider').show();
	            var slideTo = $(this).attr("rel")//Grab rel value from link;
	            var slideToInt = parseInt(slideTo)//Make sure that this value is an integer;
	            if (slider.currentSlide != slideToInt) {
	                slider.flexAnimate(slideToInt)//move the slider to the correct slide (Unless the slider is also already showing the slide we want);
	            }
	        });
	    }
	});



/** 
* Create the children flexsliders. Must be array of jquery objects with the
* flexslider data. Easiest way is to place selector group in a var.
*/
var children_slides = $('.flexslider_children').flexslider({
  slideshow: false, 
  controlNav : false,
  directionNav: false,
  slideshow: false,
  animationSpeed: 750,
  smoothHeight: false,
  animation: "fade"
}); 

/** 
* Set up the main flexslider
*/
$('.mainflexslider').flexslider({
  pauseOnHover : true,
  animationSpeed: 1000,
  slideshowSpeed: 5000,
  slideshow: false,
  animation: "slide",
  // Call the update_children_slides which itterates through all children slides 
  'before' : function(slider){ // Hijack the flexslider
    update_children_slides(slider.animatingTo);
  }   
}); 

/** 
* Method that updates children slides
* fortunetly, since all the children are not animating,
* they will only update if the main flexslider updates. 
*/
var update_children_slides = function (slide_number){
  for (i=0;i<children_slides.length;i++) {
    // Run the animate method on the child slide
    $(children_slides[i]).data('flexslider').flexAnimate(slide_number);
  }   
}

		/* WidowFix ----------------------
		$('h1, h2, h3, h4').widowFix({
		    letterLimit: 10,
		    prevLimit: 5,
		    linkFix: true 
		})
		*/

		$('h1, h2, h3, h4').widowFix();
		$('.home-thumb-text p').widowFix();

		
		//$('.home-thumb-text2 p').fitText();

		/*$('.home-thumb-text2 p').widowFix({
			letterLimit: 4,
			prevLimit: 6
		});*/

		/*$('.home-thumb2').widowFix({
			letterLimit: 4,
			prevLimit: 6
		});*/

		// Adds highlight background to work related pages 
		if ($('#envelope').hasClass('projects')) {
			$('#work').addClass('active');
		}


		$('input[placeholder], textarea[placeholder]').placeholder();
		$('.page-contact label').hide();

    $('.container').fitVids();






}); // End Doc Ready 













