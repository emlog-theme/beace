jQuery.cookie = function(name, value, options) {
    if (typeof value != 'undefined') { // name and value given, set cookie
        options = options || {};
        if (value === null) {
            value = '';
            options.expires = -1;
        }
        var expires = '';
        if (options.expires && (typeof options.expires == 'number' || options.expires.toUTCString)) {
            var date;
            if (typeof options.expires == 'number') {
                date = new Date();
                date.setTime(date.getTime() + (options.expires * 24 * 60 * 60 * 1000));
            } else {
                date = options.expires;
            }
            expires = '; expires=' + date.toUTCString(); // use expires attribute, max-age is not supported by IE
        }
        var path = options.path ? '; path=' + options.path : '';
        var domain = options.domain ? '; domain=' + options.domain : '';
        var secure = options.secure ? '; secure' : '';
        document.cookie = [name, '=', encodeURIComponent(value), expires, path, domain, secure].join('');
    } else { // only name given, get cookie
        var cookieValue = null;
        if (document.cookie && document.cookie != '') {
            var cookies = document.cookie.split(';');
            for (var i = 0; i < cookies.length; i++) {
                var cookie = jQuery.trim(cookies[i]);
                // Does this cookie string begin with the name we want?
                if (cookie.substring(0, name.length + 1) == (name + '=')) {
                    cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
                    break;
                }
            }
        }
        return cookieValue;
    }
};

function commentReply(pid,c){
	var response = document.getElementById('comment-post');
	document.getElementById('comment-pid').value = pid;
	document.getElementById('cancel-reply').style.display = '';
	c.parentNode.parentNode.appendChild(response);
}	
function cancelReply(){
	var commentPlace = document.getElementById('comment-place'),response = document.getElementById('comment-post');
	document.getElementById('comment-pid').value = 0;
	document.getElementById('cancel-reply').style.display = 'none';
	commentPlace.appendChild(response);
}
var $ = jQuery.noConflict();
$(function($) {
	'use strict';
	if( !window.console ){
		window.console = {
			log: function(){}
		}
	}
	
	jsui.bd = $('body')
	jsui.is_signin = jsui.bd.hasClass('logged-in') ? true : false;
	
	var LS={
        get:function(dataKey){          
            if(window.localStorage){
                return localStorage.getItem(dataKey);
            }else{
                return $.cookie(dataKey);  
            }
        },
        set:function(key,value){            
            if(window.localStorage){
                localStorage[key]=value;
            }else{
                $.cookie(key,value);
            }
        },
        remove:function(key){
            if(window.localStorage){
                localStorage.removeItem(key);
            }else{
                $.cookie(key,undefined);
            }
        }
    }
	$('pre').each(function(){
		if( !$(this).attr('style') ) $(this).addClass('prettyprint')
	})

	if( $('.prettyprint').length ){
		prettyPrint()
	}
	// toggle top Search
	$(document).ready(function(){
		$(".fa-search").on("click",function(){
			$("#search_toggle_top").toggle();
		});
	});

	// SET BACKGROUND IMAGE
	jQuery('.img-section').each( function() {
		var section = jQuery(this);
		var bg = jQuery(this).attr("data-bg-img");
		section.css('background-image', 'url('+ bg +')');
	});
	jQuery('.progress-section').each( function() {
		var section = jQuery(this);
		var progress = jQuery(this).attr("data-progress");
		section.css('width', ''+ progress +'');
	});

	// Back To Top
	jQuery(window).scroll(function(){
		if (jQuery(this).scrollTop() > 1) {
			jQuery('.hmztop').css({bottom:"14px"});
		}else{
			jQuery('.hmztop').css({bottom:"-100px"});
		}
	});
	jQuery('.hmztop').on("click",function(){
		jQuery('html, body').animate({scrollTop: '0px'}, 800);
		return false;
	});

	// Share Toggle
	$(document).ready(function(){
		$('.share_toggle').on("click",function(){
			$(this).next().toggleClass('share_active');
		});
	});

	// featured post
	$(document).ready(function() {
		$("#featured_post").owlCarousel({
			autoPlay: 3000,
			items : 4,
			navigation : true,
			itemsDesktop : [1199,3],
			itemsDesktopSmall : [979,3]
		});
	});



	// featured cat post
	$(document).ready(function() {
		$("#featured_cat_post").owlCarousel({
			autoPlay: 3000,
			items : 3,
			navigation : true,
			itemsDesktop : [1199,3],
			itemsDesktopSmall : [979,3]
		});
	});

	// post-slid-post
	$(window).load(function () {
		$("#post-slid-post").show();
	});
	$(document).ready(function() {
		$("#post-slid-post").owlCarousel({
			autoPlay: true,
			navigation : true,
			slideSpeed : 1000,
			paginationSpeed : 1000,
			singleItem:true
		});
	});

	// big-slid-post For New page
	$(window).load(function () {
		$("#big-slid-post").show();
	});

	$(document).ready(function() {
		$("#big-slid-post").owlCarousel({
			autoPlay: true,
			navigation : true,
			slideSpeed : 1000,
			paginationSpeed : 1000,
			stopOnHover : true,
			singleItem:true,
			responsive:true
		});
	});

	$(window).load(function () {
		$("#post_related_block").show();
	});

	$(document).ready(function() {
		$("#post_related_block").owlCarousel({
			autoPlay: 3000,
			navigation : true,
			items : 3,
			itemsDesktop : [1199,3],
			itemsDesktopSmall : [979,3]
		});
	});
	
	$(document).on('click', function(e){
		e = e || window.event;
		var target = e.target || e.srcElement
		var etag = $(target)

		if( etag.parent().attr('evt') ){
			etag = $(etag.parent()[0])
		}else if( etag.parent().parent().attr('evt') ){
			etag = $(etag.parent().parent()[0])
		}

		var type = etag.attr('evt')

		if( !type || etag.hasClass('disabled') ) return 

		switch( type ){
			case 'likes':
				var pid = etag.attr('data-pid')
				if ( !pid || !/^\d{1,}$/.test(pid) ) return;
				
				if( !jsui.is_signin ){
					var lslike = LS.get('_likes') || ''
					if( lslike.indexOf(','+pid+',')!==-1 ) return alert('你已赞！')

					if( !lslike ){
						LS.set('_likes', ','+pid+',')
					}else{
						if( lslike.length >= 160 ){
							lslike = lslike.substring(0,lslike.length-1)
							lslike = lslike.substr(1).split(',')
							lslike.splice(0,1)
							lslike.push(pid)
							lslike = lslike.join(',')
							LS.set('_likes', ','+lslike+',')
						}else{
							LS.set('_likes', lslike+pid+',')
						}
					}
				}

				$.ajax({
					url: jsui.uri + 'action/index.php',
					type: 'POST',
					dataType: 'json',
					data: {
						action: 'like',
						pid: pid
					},
					success: function(data, textStatus, xhr) {
						//called when successful
						// console.log(data)
						if (data.error) return false;
						// console.log( data.response )
						// if( data.type === 1 ){
						etag.toggleClass('actived')
						etag.find('span').html(data.response)
						// }
					},
					error: function(xhr, textStatus, errorThrown) {
						//called when there is an error
						console.log(xhr)
					}
				});
			break;
		}
	});
	
	$('.plinks a').each(function(){
		var imgSrc = $(this).attr('href')+'/favicon.ico'
		$(this).prepend( '<img src="'+imgSrc+'">' )
	});
	
	jQuery(document).ready(function() {
		$('body img').waypoint(function() {
			$(this.element).addClass('lf_appear');
		},{
			offset: '90%'
		});
	});
	
	$(document).on('click', '#pagenavi a',function(e) {
        e.preventDefault();
        $.ajax({
            type: "GET",
            url: $(this).attr('href'),
            beforeSend: function() {
                $('#pagenavi').remove();
                $('.commentlist').remove();
                $('#loading-comments').slideDown()
            },
            dataType: "html",
            success: function(out) {
                var result = $(out).find('.commentlist');
				var nextlink = $(out).find('#pagenavi');
                $('#loading-comments').slideUp(550);
                $('#loading-comments').after(result.fadeIn(800));
                $('.commentlist').after(nextlink);
                $('body img').waypoint(function() {
			$(this.element).addClass('lf_appear');
		},{
			offset: '90%'
		});
            }
        })
    });
	$('.showShare').click(function(){
		$('.bdsharebuttonbox').fadeToggle();
		$('.bdsharebuttonbox a').siblings(".external").removeClass("external");

		$('.bdsharebuttonbox a').parents(".hide-external").removeClass("hide-external")
		setTimeout(function(){
		$('.bdsharebuttonbox').focus();
		}, 300);
	});
});
+(function($) {
    window._bd_share_config = {
        common: {
            "bdText": "",
            "bdMini": "2",
            "bdMiniList": false,
            "bdPic": "",
            "bdStyle": "0"
        },
        share: [{
            // "bdSize": "24",
            bdCustomStyle: jsui.uri + 'css/share.css'
        }]
    }
    with(document) 0[(getElementsByTagName('head')[0] || body).appendChild(createElement('script')).src = 'http://bdimg.share.baidu.com/static/api/js/share.js?cdnversion=' + ~(-new Date() / 36e5)];   
})(jQuery)