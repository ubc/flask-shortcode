var bubble_points = [	
{x:342.5,y:393},
{x:656.5,y:256},
{x:985.5,y:196},
{x:1065.5,y:64},
{x:117.5,y:227},
{x:157.5,y:57},
{x:613,y:55},
{x:249.5,y:110},
{x:238.5,y:405},
{x:179,y:229},
{x:293.5,y:349},
{x:343.5,y:147},
{x:309.5,y:52},
{x:399.5,y:234},
{x:379.5,y:330},
{x:395.5,y:383},
{x:472.5,y:367},
{x:454.5,y:287},
{x:263.5,y:195},
{x:562.5,y:80},
{x:804.5,y:331},
{x:578.5,y:198},
{x:724.5,y:318},
{x:539.5,y:397},
{x:490.5,y:190.5}, 
{x:753.5,y:281},
{x:743.5,y:346},
{x:1034.5,y:238},
{x:847.5,y:380},
{x:381.5,y:89},
{x:888.5,y:156},
{x:874.5,y:97},
{x:816.5,y:78},
{x:930.5,y:83},
{x:1075.5,y:64},
{x:1109.5,y:132},
{x:1110.5,y:203},
{x:1023.5,y:227},
{x:1088.5,y:257},
{x:1102.5,y:316},
{x:913.5,y:365}
];

var hero_stories_points = [
	{x:465.5,y:126, img:'right', size: 34, move_by: 23},
	{x:125.5,y:133,  img:'left', size: 34, move_by: 23},
	{x:145.5,y:340, img:'left', size:38, move_by: 18},
	{x:307.5,y:263, img:'right', size:38, move_by: 18},
	
	{x:712.5,y:137, img:'right', size: 43, move_by: 8.5},
	{x:595.5,y:318, img:'left', size:38, move_by: 18},
	{x:877.5,y:251, img:'left', size: 43, move_by: 8.5},
	{x:1007.5,y:125, img:'left', size: 34, move_by: 23},
	{x:994.5,y:348, img:'right', size:38, move_by: 18}
];

/*\
|*|
|*|  IE-specific polyfill which enables the passage of arbitrary arguments to the
|*|  callback functions of javascript timers (HTML5 standard syntax).
|*|
|*|  https://developer.mozilla.org/en-US/docs/DOM/window.setInterval
|*|
|*|  Syntax:
|*|  var timeoutID = window.setTimeout(func, delay, [param1, param2, ...]);
|*|  var timeoutID = window.setTimeout(code, delay);
|*|  var intervalID = window.setInterval(func, delay[, param1, param2, ...]);
|*|  var intervalID = window.setInterval(code, delay);
|*|
\*/
 
if (document.all && !window.setTimeout.isPolyfill) {
  var __nativeST__ = window.setTimeout;
  window.setTimeout = function (vCallback, nDelay /*, argumentToPass1, argumentToPass2, etc. */) {
    var aArgs = Array.prototype.slice.call(arguments, 2);
    return __nativeST__(vCallback instanceof Function ? function () {
      vCallback.apply(null, aArgs);
    } : vCallback, nDelay);
  };
  window.setTimeout.isPolyfill = true;
}
 
if (document.all && !window.setInterval.isPolyfill) {
  var __nativeSI__ = window.setInterval;
  window.setInterval = function (vCallback, nDelay /*, argumentToPass1, argumentToPass2, etc. */) {
    var aArgs = Array.prototype.slice.call(arguments, 2);
    return __nativeSI__(vCallback instanceof Function ? function () {
      vCallback.apply(null, aArgs);
    } : vCallback, nDelay);
  };
  window.setInterval.isPolyfill = true;
}

/*
 *
 *                                     
 * ooooo o          .oo .oPYo.  o   o 
 * 8     8         .P 8 8       8  .P 
 *o8oo   8        .P  8 `Yooo. o8ob'  
 * 8     8       oPooo8     `8  8  `b 
 * 8     8      .P    8      8  8   8 
 * 8     8oooo .P     8 `YooP'  8   8 
 *:..::::........:::::..:.....::..::..
 *::::::::::::::::::::::::::::::::::::
 *::::::::::::::::::::::::::::::::::::
 *
 *
 */
 (function (document, window, $ ){
 	'use strict';
  	var isMSIE = /*@cc_on!@*/0; // check for IE
    // Function-level strict mode syntax
   
    var Flask = {
        canvas: $("#canvas"),
        canvas_wrap       : $('#canvas-wrap'),
        commitments       : $('#commitments a'),
        hero_stories_divs : $('.icon-hero-story'),
        win               : $(window),
        bubbles           : {}, // all of our bubbles will be stored here
        hero_stories      : {},
        hero_stories_hitarea: {},
        walk_paths        : {}, // all of our paths that the bubbles can walk will be stored here
        num_of_walk_paths : 0,
        num_of_bubbles    : 0,
        story_icon        : {},
        move_over         : 0,
        walk_path_segments: 0,
        walk_path_points  : 0,
        walk_path_hero    : 0,
        radius_max        : 40,
        opacity_min       : 0,
        opacity_max       : 1,
        increment_opacity : 0,
        draw_path         : false,
        tool              : {},
        link_added        : false,
        lines             : null,
        opacity_group     : {},
        fade_bubbles_incoment: 0,
        lines_group       : {},
        all_lines         : {},
        draw_line_points  : 0,
        draw_line_segments: 0,
        draw_lines        : false,
        draw_line_segment : 0,
        fade_animation_state: false,
        lock_links        : false,
        watch_moving	  : true,
        small_circle_vs_big_circle: 1.377,
        locations: {},
        delay: false,
        hero_hover_off_timer: [],
        debug: false,
        commitment_cache: {},
        hover_check: false,
        hover_check_parent: {},
       
    init: function() {
    
    	$('#full-report').hover(function() {
    		Flask.watch_moving = false;
    	}, function(){
    		Flask.watch_moving = true;
    	})
        Flask.debug = false;
        Flask.num_of_bubbles     = 30;
        Flask.num_of_walk_paths  = 10;
        Flask.walk_path_points   = 2000;
        Flask.walk_path_hero    = 2000;
        Flask.draw_line_points   = 30;
        Flask.increment_opacity  = 0.0025;
        Flask.opacity_min        = 0.3;
        Flask.opacity_max        = 1;
        Flask.fade_bubbles_incoment = 0.055;
        // paint 
        Flask.paint(); // start the paper 
        Flask.bindUIEvents(); // this is what happends when you are filtering stuff

        Flask.add_elements( bubble_points, 'bubble' ); // lets make some bubbles
        Flask.add_elements( hero_stories_points, 'hero-story' );
        Flask.add_events();

        Flask.opacity_group = new paper.Group(Flask.bubbles);
        Flask.opacity_group.addChild( Flask.hero_stories );
        
        // lets make the bubbles dance
        paper.view.onFrame = Flask.runAnimateFrame;
        paper.view.onResize = Flask.runResize;
        paper.view.draw();
        paper.view.viewSize = [ Flask.canvas_wrap.width(),450];
       
    },
    bindUIEvents: function() {
    
        Flask.commitments.hover( function() { Flask.on_commitment_over(this); }, 
                                 function() { Flask.off_commitment_over(this); } );
        Flask.commitments.click( function(e) { e.preventDefault(); Flask.on_commitment_click(this); } );
        
        $('#filter-1').on('click', 'a', function(event) {
        	
        	var el = $(this);
        	var item = el.data('slug');
        	var filter = el.data('taxonomy');
        	
        	if( filter ){
        		switch( item ) {
        			case 'okanagan-campus':
        				
        				$('#filter-1 > .btn').html('Okanagan Campus <span class="caret"></span>');
        				filter = 'filter_1';
        				
        			break;
        			
        			case 'vancouver-campus':
        				$('#filter-1 > .btn').html('Vancouver Campus <span class="caret"></span>');
        				filter = 'filter_1';
        			break;
        		
        		}
        		
        		Flask.filter_bubbles( filter, item );
        	} else {
        		$('#filter-1 > .btn').html('Campus <span class="caret"></span>');
        		Flask.show_all_bubbles();
        	}
        	
        	event.preventDefault();
        	
        });
    },
    paint: function() {

        var canvas_el = $('#canvas');
        canvas_el.attr('width', Flask.canvas_wrap.width());
       
        
        // Setup directly from canvas id:
        paper.setup( 'canvas' );

        // lets have a place to store some bubbles
        Flask.bubbles = new paper.Group();
        Flask.hero_stories = new paper.Group();
        Flask.hero_stories_hitarea = new paper.Group();

        Flask.story_icon = new paper.Raster( 'icon-story' ); // the story icon

        Flask.story_icon.visible = false;
        Flask.walk_paths = Flask.create_walk_paths( Flask.num_of_walk_paths);
		Flask.bubbles.moving = true;
        Flask.tool = new Tool();
        Flask.tool.onMouseMove = Flask.onMouseMove;
        Flask.tool.onMouseDown = Flask.onClick;
        
        Flask.lines_group = new paper.Group();
        Flask.all_lines   = new paper.Group();
        
        // Flask.draw_corners();
        
    },
    runAnimateFrame: function( event ){
    
         Flask.bubble_dance( event );
         Flask.hero_stories_dance( event );
         
         if( Flask.fade_animation_state != 'finished' ) {
            Flask.animate_canvas( event ); // bubbles fade in and out base on the hover states. 
         }
         
         if( Flask.draw_lines ) {
            Flask.animate_dawing_lines( event );
         }
    },
    runResize: function (event) {
        paper.view.size.width = Flask.canvas_wrap.width();
        // view.viewSize = [ Flask.canvas_wrap.width(),450];
    },
    onClick: function (event) {
        Flask.remove_links();  
    },
    onMouseMove: function( event ){
       
       if( Flask.watch_moving ) {
       
	        Flask.bubbles.moving = true;
	        Flask.remove_links();
	        Flask.hit_test( event, 'bubble');      
	        Flask.hit_test( event, 'hero');
       }
    },
    draw_corners: function(){
    	
    	var dot = new paper.Path.Circle(new paper.Point(60, 0), 2);
    	dot.fillColor = 'red';
    },
    hit_test: function( event, what ) {
    	
        var hitResult = {};
        switch( what ) {
            case 'hero':
                hitResult = Flask.hero_stories.hitTest( event.point );
            break;
            case 'bubble':
            	/*
            	if( isMSIE ){
            	var add_point = new paper.Point(0, 27);
            	event.point = event.point.add(add_point);
            	Flask.draw_dot( event.point );
                }*/
                hitResult = Flask.bubbles.hitTest( event.point );
            break;
        }
        
        if ( hitResult &&  hitResult.item && ( 'Path' == hitResult.item.type  || 'hero' != what ) ) {            
        	
        	if( hitResult.item.parent.kind == 'hero-story' ) {
                hitResult.item = hitResult.item.parent;
            }
            
            hitResult.item.opacity = 0.99;
            
            // Flask.resize_circle( hitResult.item.parent,  Flask.radius_max );
            
            if(!Flask.link_added && hitResult.item.visible)
                Flask.add_link(  hitResult.item,  hitResult.item.num);
            // stop the bubbles from moving 
            Flask.bubbles.moving = false;
        }
    },
    
    create_walk_paths: function(count){
        var path_lenght = 10;

        var figure8 = new paper.Path();
            figure8.strokeColor = 'black';
            figure8.add(new paper.Point( 0, 0 ) ); 
            figure8.add(new paper.Point( -path_lenght, path_lenght ) ); 
            figure8.add(new paper.Point( 0, 2*path_lenght ) );
            figure8.add(new paper.Point( path_lenght, path_lenght ) );
            figure8.add(new paper.Point( 0, 0 ) ); 
            figure8.add(new paper.Point( -path_lenght, -path_lenght ) ); 
            figure8.add(new paper.Point( 0, -2*path_lenght));
            figure8.add(new paper.Point( path_lenght, -path_lenght ) );
            
            figure8.closed = true;
            figure8.visible = false;
            figure8.smooth();
            Flask.walk_path_segments = figure8.length;
        var walk_paths = [];
            for (var i = 0; i < count; i++) {
                var copy = figure8.clone();
                copy.fullySelected = false;
                copy.rotate((180/count)*i);
                copy.visible = false;
                walk_paths.push(copy);
            }
        return walk_paths;
    },
    adjusted_x: function(x) {
    	
        return x * (paper.view.size.width/1170);
    },
    add_elements: function( points, what ){
        var count = 0;
        if( 'bubble' == what ) {
            count = loop_json.story.length;
        } else {
            count = points.length;
        }
        
        for (var i = 0; i < count; i++) {
            
            var center = new paper.Point( Flask.adjusted_x( points[i].x) , points[i].y);
            var element = {};
            switch( what ){
                case 'hero-story':
                    element = Flask.create_elements_item( center, i ,  what );
                    Flask.hero_stories.addChild( element );
                
                break;
                case 'bubble':
                    element = Flask.create_elements_item( center, i,  what );
                    Flask.bubbles.addChild( element );
                
                break;
            }
        }
    },
    create_elements_item :function( position, num, what ){
        var icon = {};
        switch( what ) {
            case 'bubble':
                icon = Flask.story_icon.clone();
                var random = Flask.random( Flask.radius_max * Flask.opacity_min, Flask.radius_max );
                icon.opacity = random / Flask.radius_max;
                
            break;
            
            case 'hero-story':
                icon = new paper.Group();
                
                var img  = new paper.Raster( 'hero-story'+num );
                    img.scale(0.8);
                    img.position =  position;
                    // img.selected = true;

                var circle_position = Flask.get_circle_position( position , hero_stories_points[num], img, 'bottom', 0.8 );
               
                var circle =  new paper.Path.Circle( circle_position, hero_stories_points[num].size );
                    circle.fillColor = 'white';
                    circle.opacity = 0;
                
                var circle_position_big = Flask.get_circle_position( position , hero_stories_points[num], img, 'top', 0.8 );
                
                var bigger_circle = new paper.Path.Circle( circle_position_big , hero_stories_points[num].size*Flask.small_circle_vs_big_circle );
                
                    bigger_circle.fillColor = 'white';
                    bigger_circle.opacity = 0;
                
                //img.selected = true;
                icon.addChild( img );
                icon.addChild( circle );
                icon.addChild( bigger_circle );

            break;
        }
        // icon.selected = true;
        icon.kind = what;
        icon.visible = true;
        icon.increase_opacity = true;
        icon.num = num;
        icon.walk_path = Flask.walk_paths[ Math.floor( Math.random()* Flask.num_of_walk_paths ) ]; 
        
        icon.position =  position;
            
        return icon;
    },
    filter_bubbles: function( filter, item ){
 		Flask.show_all_bubbles( false );
 	
    	if( 'filter_1' == filter ){
    	
     		// loop though the stories
     		var loop_size = loop_json.story.length;
			for( var i=0; i < loop_size; i++ ) {
				
				if( loop_json.story[i].filter_1 ){
					for( var j = 0; j <loop_json.story[i].filter_1.length; j++ ) {
						
						if(  typeof loop_json.story[i].filter_1[j] != "undefined" && loop_json.story[i].filter_1[j].slug == item ) {
							Flask.bubbles.children[i].visible = true;
						}
					} // end of for loop
				}
			} // end of for loop
			
			// loop though the hero stories
			var hero_size = loop_json.hero.length;
			for( var k=0; k < hero_size; k++ ) {
				if( loop_json.hero[k].filter_1 ){
					for( var l = 0; l <loop_json.hero[k].filter_1.length; l++ ) {
						if(  typeof loop_json.hero[k].filter_1[l] != "undefined" && loop_json.hero[k].filter_1[l].slug == item ) {
							Flask.hero_stories.children[k].visible = true;
						}
					
					} // end for loop l	
				}
			} // end for look k	
 		}    
    },
    show_all_bubbles: function( show ) {
    
    	show = typeof show !== 'undefined' ? show : true;
    	var count = loop_json.story.length;
    	
    	for( var i=0; i < count; i++ ) {
    		Flask.bubbles.children[i].visible = show;
    	}
    	count = loop_json.hero.length;
    	for( var i=0; i < count; i++ ) {
    		Flask.hero_stories.children[i].visible = show;
    	}    
    },
    add_events: function( ) {
        
        Flask.hero_stories_divs.find('.small-circle').each( function( i ) {
            Flask.add_hover_over_event(i, this );
        });
        
        Flask.hero_stories_divs.find('.big-circle').each( function( i ) {
            Flask.add_hover_over_event( i, this );
        });
    },
    add_hover_over_event: function( i ,el) {

        $(el).on({
			mouseenter: function() 
			{
			    //stuff to do on mouseover
			    if( Flask.hero_hover_off_timer[i] ){
			        clearTimeout( Flask.hero_hover_off_timer[i] );
			        Flask.hero_hover_off_timer[i] = null;
			    } else {
			        Flask.hover_over_hero_story( Flask.hero_stories.children[i], i, this ); 
			    }
			
			},
			mouseleave: function()
			{
			    //stuff to do on mouseleave
			   // console.log('mouse leave fire : hover_off_here_story');
			    Flask.hero_hover_off_timer[i] = setTimeout( Flask.hover_off_hero_story, 60, Flask.hero_stories.children[i], i, this);
			}
			});        
    },
    resize_circle: function( item,  width, height ) {
        if(!height)
            height = width;
        var size = new paper.Size( width,  height);
        var path = new paper.Path.Rectangle( new paper.Point( item.position.x - ( width/2), item.position.y - (height/2)), size );
        item.fitBounds( path.bounds );
        path.remove();
    },
    random: function(from,to)
    {
        return Math.floor(Math.random()*(to-from+1)+from);
    },
    bubble_dance: function( event ) {
        
        if( Flask.link_added ) {
            return;
        }
        
        if( Flask.bubbles.moving ) {
                Flask.move_over++;
        }

        if( Flask.move_over > Flask.walk_path_points ) {
            Flask.move_over = 0;
        }
        
        var number_of_circles = Flask.bubbles.children.length;
    
        for (var i = 0; i < number_of_circles; i++) {
            Flask.update_opacity( Flask.bubbles.children[i] );
            Flask.update_movement( Flask.bubbles.children[i] );
        }
        
    },
    hero_stories_dance: function( event ){

        if( Flask.link_added ) {
            return; 
        }
    
        var number_of_circles = Flask.hero_stories.children.length;
    
        for (var i = 0; i < number_of_circles; i++) {
            Flask.update_movement( Flask.hero_stories.children[i] );
        }
    },
    update_opacity: function( item ){
        if( item.increase_opacity ) {
            if( item.opacity > Flask.opacity_max ) {
                item.increase_opacity = false;
            }
            
            item.opacity = item.opacity + Flask.increment_opacity;
                
        } else {
            if( item.opacity < Flask.opacity_min ) {
                item.increase_opacity = true;
            }
            
            item.opacity = item.opacity - Flask.increment_opacity;
        }
    },
    update_movement: function( item ) {
    
        if( ! Flask.bubbles.moving ) {
                return;
        }
            
        var offset = Flask.move_over / Flask.walk_path_points * Flask.walk_path_segments;
        
        var delta = item.walk_path.getPointAt( offset );
        
        if( !item.fixed_x ) {
            item.fixed_x = item.position.x;
            item.fixed_y = item.position.y;
        }
        
        var location = new paper.Point( item.fixed_x, item.fixed_y );
        var new_location = location.add( delta );

        item.position.x = new_location.x;
        item.position.y = new_location.y;
        
        if( Flask.debug ){ // todo remove me in the final version
            Flask.draw_dot( new_location );
        }   
    },
    animate_canvas: function( event ){
        
        if( 'animating' == Flask.fade_animation_state ) {
            // lets fade out the bubbles to almost nothing
          
            Flask.opacity_group
            if( Flask.opacity_group.opacity > Flask.opacity_min ){
                Flask.opacity_group.opacity = Flask.opacity_group.opacity - Flask.fade_bubbles_incoment;
            } else{
                Flask.fade_animation_state = 'finished';
            }
            
        } else {
            // lets fade in the bubbles again
            if( Flask.opacity_group.opacity <= Flask.opacity_max ){
                Flask.opacity_group.opacity = Flask.opacity_group.opacity + Flask.fade_bubbles_incoment;
            } else {
                Flask.fade_animation_state = 'finished';
            }
            
        }
    },
    fade_canvas: function( el ) {
        //Flask.opacity_group.selected = true;
       	// console.log('fade in canvas');
        Flask.fade_animation_state = 'animating';        
        
        Flask.commitments.addClass('hide-away');
        el.addClass('still-show');
        
    },
    show_canvas: function(){
        //Flask.opacity_group.selected = false;
        
        Flask.commitments.removeClass('hide-away').removeClass('still-show');
        Flask.fade_animation_state = 'show';
        
    },
    /* LINKS */
    add_link: function( item, num ) {
        
        var bubles = $('#bubbles');
		
        if( 'bubble' == item.kind ) {
        
        	if( isMSIE ){ 
        		$( Flask.bubble_link_template( loop_json.story[num], num ,'' ) ).appendTo(Flask.canvas_wrap)
   				.css({'left' : (item.position.x-37), 'top' : (item.position.y+41)})
   				.on({
   					mouseleave: function() { Flask.hover_off_bubble( item, this, true ); },
					click: function(event) { Flask.click_bubble( loop_json.story[num] ); }
   				});
   				 Flask.hover_over_bubble( item, loop_json.story[num], '#bubble-wrap-'+num, true )
   				
           	} else {
        	
            $( Flask.bubble_link_template( loop_json.story[num], num ,'' ) )
            .appendTo(Flask.canvas_wrap)
            .css({'left' : (item.position.x-37), 'top' : (item.position.y+41)})
            .on({
				mouseenter: function() { Flask.hover_over_bubble( item, loop_json.story[num], this, true ); },
				mouseleave: function() { Flask.hover_off_bubble( item, this, true ); },
				click: function(event) { Flask.click_bubble( loop_json.story[num] ); }
			}); 
            
            
            	
            }
            
        } else {
            // item.selected = true;
            Flask.hero_stories_divs.eq(num).removeClass('icon-hide')
            .css( { 'left': item.position.x -( item.children[0].width*0.8/2 ) , 'width': item.children[0].width*0.8, 'top': item.position.y + hero_stories_points[num].move_by } );

        }
    },
    click_bubble: function( item ) {
    	if( typeof item != undefined ){
    		window.location.href=item.permalink;
    	}
                
    },
    hover_over_bubble: function( item, data, el, single ) {
    	
    	// console.log('hover_over_bubble fired');
        if(single) {
	        Flask.link_added = true;
	        
	        var size = data.commitments.length;
	        
	        var to      = new paper.Point(item.position.x,item.position.y);
	        item.visible = true;
	        
	        for( var i=0;i < size;i++) {
	        	var destination = $( '#'+data.commitments[i].slug );
	        	
	        	Flask.fade_canvas(destination);
	        	var position = destination.position();
	        	var width = destination.width(); 
	        
	        	var from    = new paper.Point( position.left + width/2 , position.top);
	        	Flask.draw_curve_line( from, to );
	
	        }   
        }
        var elm = $(el);
        elm.find('.bubble-link-excerpt').addClass('show').animate({'height':100},100);
        elm.css({'z-index':101});
    },
    hover_off_bubble: function( item, el, single ){
    	
    	
        // remove lines 
        if( single ){
	        Flask.link_added = false;
	        item.visible = true;
	        Flask.lines_group.removeChildren();
	        Flask.all_lines.removeChildren();
	        
	        
	        
	        $(this).on( 'mousemove', Flask.mouse_move_off_bubble);
	        Flask.show_canvas();
        }
        var elm = $(el);
        elm.find('.bubble-link-excerpt').removeClass('show').css({'height': 0});
        elm.css({'z-index':100});
       
    },
    hover_over_hero_story: function( item, num, el){
		
		
        if( Flask.lock_links )
            return;
		
        var new_width = item.children[0].width;
        var new_height = item.children[0].height;
        var move_by_top =  new_height - item.children[0].height;
        var move_by_left = new_width - item.children[0].width;
        
        Flask.scale_up_hero_story(item, num, el);
        
        Flask.link_added = true;
        
        var destination = $( '#'+loop_json.hero[num].commitments[0].slug );
        Flask.fade_canvas(destination);
        var position = destination.position();
        var width = destination.width(); 
        
        var from    = new paper.Point( position.left + width/2 , position.top);
        var to      = new paper.Point( item.children[1].position.x +( move_by_left / 2),item.children[1].position.y - ( move_by_top / 2 ) );
        Flask.draw_curve_line( from, to );

        Flask.delay = true;
        
        setTimeout( function(){
            Flask.delay = false;
        }, 200);
        Flask.hover_check_parent = $(el).parent();
        Flask.hover_check = setInterval(function() {
        	
        	// check weather we are in or out again. 
        	// console.log('Hover check fire : hover_off_here_story', Flask.hover_check_parent.is(":hover") );
        	// sometimes the mouse moves fast
        	if( !Flask.hover_check_parent.is(":hover") ){
        			
        			clearInterval( Flask.hover_check );
        			
             		Flask.hover_off_hero_story( item, num, el );
        	}
        }, 201 );
        
       // console.log('hover_over_here_story finished');
        
    },
    hover_off_hero_story: function( item, num, el ){
    	// for good measure
    	//clearInterval( Flask.hover_check );
       // console.log('hover_off_hero_story fired');
        if( Flask.lock_links || Flask.delay )
            return;
            
        if( Flask.hero_hover_off_timer[num] )
            Flask.hero_hover_off_timer[num] = null;

        Flask.scale_down_hero_story( item, num, el );
        
        
        Flask.show_canvas();
        Flask.link_added = false;
        
        item.visible = true;
        
        // remove lines 
        Flask.lines_group.removeChildren();
        Flask.all_lines.removeChildren();
        
        clearInterval( Flask.hover_check );
        
        Flask.hero_stories_divs.addClass('icon-hide');
       // console.log('hover_off_hero_story finished');

    },
    scale_up_hero_story: function(item, num, el ){

        var elm = $(el);
        item.visible = false;

        var new_width = item.children[0].width;
        var new_height = item.children[0].height;
        var move_by_top =  new_height - item.children[0].height;
        var move_by_left = new_width - item.children[0].width;
        var new_elm_width = hero_stories_points[num].size * 2.5; // 2 * 100 / 80 

        var animate_option = {};
        if( hero_stories_points[num].img == 'left'){
            animate_option = { width: new_width, marginTop: -move_by_top  , marginLeft: -move_by_left};
            move_by_left = 0;
        } else {
            animate_option = { width: new_width, marginTop: -move_by_top };
        }
        
        elm.parent().animate( animate_option, 100);
       
        if( elm.hasClass('small-circle') ) {
            // elm.animate({ width: new_elm_width, height: new_elm_width});
            // elm.siblings('a').animate({ width: new_elm_width * Flask.small_circle_vs_big_circle , height: new_elm_width * Flask.small_circle_vs_big_circle });
            elm.siblings('a').width( new_elm_width * Flask.small_circle_vs_big_circle).height( new_elm_width * Flask.small_circle_vs_big_circle );
            elm.width( new_elm_width).height(new_elm_width);
        } else {
            elm.width( new_elm_width * Flask.small_circle_vs_big_circle).height( new_elm_width * Flask.small_circle_vs_big_circle );
            elm.siblings('a').width( new_elm_width).height(new_elm_width);
        }

    },
    scale_down_hero_story: function( item, num, el ){
        var elm = $(el);
        var new_width = item.children[0].width;
        var new_elm_width = hero_stories_points[num].size * 2;

        elm.parent().width(new_width);
        elm.parent().css({ margin: 0});

         if( elm.hasClass('small-circle') ) {
            
            elm.width( new_elm_width ).height( new_elm_width );
            elm.siblings('a').width( new_elm_width*Flask.small_circle_vs_big_circle).height( new_elm_width *Flask.small_circle_vs_big_circle);

        } else {
            
            elm.width( new_elm_width*Flask.small_circle_vs_big_circle).height( new_elm_width *Flask.small_circle_vs_big_circle);
            elm.siblings('a').width( new_elm_width ).height( new_elm_width );
        }
    },
    bubble_link_template: function ( data ,num , class_name) {
        
        var html  = '<div class="bubble-wrap" id="bubble-wrap-'+num+'"><div class="bubble-paper bubble '+class_name+'"><a href="'+data.permalink+'" class="bubble-link">';
            html += '<span class="bubble-link-shell"> '+ data.title +'</span><span class="bubble-link-excerpt">'+data.excerpt+' <span class="bubble-readmore">read more</span> </span>';
            html += '</a></div></div>';
            

        return html;
    },
    mouse_move_off_bubble: function( event ){
        
    },
    add_bright_link: function( item, data, num ){
    
    
    	$( Flask.bubble_link_template( data, num, 'bubble-bright' ) )
            .appendTo(Flask.canvas_wrap)
            .css({'left' : (item.position.x-37), 'top' : (item.position.y+41)})
            .hover( function() { Flask.hover_over_bubble( item, loop_json.story[num], this , false ); } ,function() { Flask.hover_off_bubble( item, this , false ); } )
            .on('click', function( event ) { Flask.click_bubble( loop_json.story[num] ); }); 
    
    },
    remove_links : function() {
        
        if( !Flask.link_added ){
            Flask.canvas_wrap.find('.bubble-wrap').remove();
            Flask.hero_stories_divs.addClass('icon-hide');
        }
    },
    animate_dawing_lines: function( event ) {
        
        var numbler_of_lines = Flask.lines_group.children.length;
        if( ! numbler_of_lines ){
            return ;
        }
        
        // line gets drown till its done drawing. 
        if( Flask.draw_line_segment  > Flask.walk_path_points +2 ) {
            Flask.draw_lines = false;
            return;
        }
        
        for (var i = 0; i < numbler_of_lines; i++) {
   
            Flask.draw_animated_line( Flask.lines_group.children[i] );
    
        }
        Flask.draw_line_segment++;       
    },
    get_circle_position: function ( position, data, image, vertically, scale ){
        var size = data.size;
        var y,x;
        if( 'bottom' == vertically ){
            y = (image.height*scale/2) - (size);
            // todo move the position left or right and to the bottom depending on the size of the cirlce
            if( 'right' == data.img ) {
                x = -(image.width*scale/2) + (size);
            } else {
                x = (image.width*scale/2) - (size);
            }
        } else {
            size = size * Flask.small_circle_vs_big_circle;
            
            y = -(image.height*scale/2) + (size);
            // todo move the position left or right and to the bottom depending on the size of the cirlce
            if( 'right' == data.img ) {
                x = (image.width*scale/2) - (size);
            } else {
                x = -(image.width*scale/2) + (size);
                
            }

        }
        
        var point = new paper.Point( x, y );
        
        return position.add(point);
        
        
    },
    draw_dot: function( point , color) {
         color = typeof color !== 'undefined' ? color :'red';
        var circle = new Path.Circle(point, 1);
            circle.fillColor = color;
    },
    draw_animated_line: function( line ){
        
        var offset = ( line.length /  Flask.draw_line_points ) * Flask.draw_line_segment ;
        
        var next_point = line.getPointAt( offset );
        
        if( next_point ) {
            line.animated_line.add( next_point ); 
            line.animated_line.smooth();
        }
        
        if( Flask.debug) {
            Flask.draw_dot(next_point);
        }
    },
    draw_curve_line: function( from, to ) {
        var bump_handel = 0;
        if( ( from.x) <  to.x ){
            bump_handel = -200;
        } else {
            bump_handel = 200;
        }
        
        var line = new paper.Path();
            
        var handel1 = new paper.Point( from.x ,40 );
        var handel2 = new paper.Point( to.x +  bump_handel,to.y+20 );
        
        line.moveTo( from );
        line.cubicCurveTo( handel1, handel2, to );
        line.strokeColor = 'white';
        line.opacity = 0;
        
        
        line.animated_line = new paper.Path();
        
        line.animated_line.strokeColor = 'white';
        line.animated_line.opacity = 0.4;
        line.animated_line.add( from );
        
        Flask.lines_group.addChild( line );
        Flask.all_lines.addChild(line.animated_line);
        
        Flask.draw_lines = true;
        Flask.draw_line_segment = 0;
    
    },
    /* EVENTS */
    on_commitment_over: function( el ) {
        // draw lines to the stories
        if( Flask.lock_links )
            return;
        
        Flask.link_added = true;
        
        var destination = $(el);
        var id = destination.attr('id'); 
       
        Flask.fade_canvas(destination);
        var position = destination.position();
        var width = destination.width(); 
            
        var from    = new paper.Point( position.left + width/2 , position.top);
        if( typeof Flask.commitment_cache[id] === 'undefined' || Flask.commitment_cache[id].lenght == 0 ){
        	
        	Flask.commitment_cache[id] = [];
        	 
        	var number_of_circles = Flask.bubbles.children.length;
     		
	        for (var i = 0; i < number_of_circles; i++) {
	             var data = loop_json.story[i];
	             var size = data.commitments.length;
	        	
	        	for( var j=0;j < size;j++) {
	        		
	        		if( id == data.commitments[j].slug && Flask.bubbles.children[i].visible ) {
	        		
	        		var to      = new paper.Point( Flask.bubbles.children[i].position.x, Flask.bubbles.children[i].position.y );
	                
	                Flask.add_bright_link(Flask.bubbles.children[i], loop_json.story[i], i );
	                Flask.draw_curve_line(from, to);
	                
	                Flask.commitment_cache[id].push(i);
	        		
	        		}
	        	}      
	        }
		} else {
			var commitment_cache_size = Flask.commitment_cache[id].length; 
			for (var j = 0; j < commitment_cache_size; j++) {
				
				var i = Flask.commitment_cache[id][j];
				
				
				if( Flask.bubbles.children[i].visible ) {
					var to      = new paper.Point( Flask.bubbles.children[i].position.x, Flask.bubbles.children[i].position.y );
	                
	            	Flask.add_bright_link(Flask.bubbles.children[i], loop_json.story[i], i);
	            	Flask.draw_curve_line(from, to);
	            }
				
			}
		}
       
       /* HERO STORY */
       // go to random hero story 
       // go though all 9 hero stories and find the right
       for (var i = 0; i < 9; i++) {
       		  
	           if( id == loop_json.hero[i].commitments[0].slug ) {
	        		var random_num = i;     	
	        }      
	    }
        
        // add a link to 
        to      = new paper.Point( Flask.hero_stories.children[random_num].children[1].position.x, Flask.hero_stories.children[random_num].children[1].position.y );
        
        
        Flask.add_link(Flask.hero_stories.children[random_num], random_num);
		
        Flask.draw_curve_line(from, to);
    
    },
    off_commitment_over: function(){
        // remove the lines back to normal
        
        if( !Flask.lock_links ){
            
            Flask.link_added = false;
            
            Flask.draw_lines = false;
            Flask.lines_group.removeChildren();
            Flask.all_lines.removeChildren();
            
            Flask.remove_links();
            Flask.show_canvas();
        }
    },
    on_commitment_click: function(el){
        if( Flask.lock_links ){
            Flask.lock_links = false;
            Flask.commitments.removeClass('locked');
            // we also need to fade
        // 
        } else {
            Flask.lock_links = true;
            // we also need to change the icon to a lock
            // disable all the other commitments
            $(el).addClass('locked');
        }
    }
};
    paper.install( window );
    
    $( document ).ready( Flask.init );
    
})(document, window, jQuery );