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
  var isMSIE = /*@cc_on!@*/0; // check for IE
    // Function-level strict mode syntax
  'use strict';
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
        Flask.increment_opacity  = 0.0015;
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
        
    },
    paint: function() {

        var canvas_el = jQuery('#canvas');
        canvas_el.attr('width', Flask.canvas_wrap.width());
       
        
        // Setup directly from canvas id:
        paper.setup( 'canvas' );

       
        // make sure that the canvas is the full width of the content
        
        //console.log(view.viewSize);
        // lets have a place to store some bubbles
        Flask.bubbles = new paper.Group();
        Flask.hero_stories = new paper.Group();
        Flask.hero_stories_hitarea = new paper.Group();
        // lets add the story icon to our flask 
        Flask.story_icon = new paper.Raster( 'icon-story' ); // the story icon
        // Flask.story_icon.visible = false;
        // Flask.story_icon.width = 27;
        // Flask.story_icon.height = 27;
        Flask.story_icon.visible = false;
        Flask.walk_paths = Flask.create_walk_paths( Flask.num_of_walk_paths);

        Flask.tool = new Tool();
        Flask.tool.onMouseMove = Flask.onMouseMove;
        Flask.tool.onMouseDown = Flask.onClick;
        
        Flask.lines_group = new paper.Group();
        Flask.all_lines   = new paper.Group();
        
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
        /*
        
         console.log(  );
        console.log(Flask.canvas_wrap.width());
        
        
        
        Flask.bubbles.remove();
        Flask.hero_stories.remove();
        Flask.hero_stories_hitarea.remove();
        // lets have a place to store some bubbles
        Flask.bubbles = new paper.Group();
        Flask.hero_stories = new paper.Group();
        Flask.hero_stories_hitarea = new paper.Group();
        
        Flask.lines_group.remove();
        Flask.all_lines.remove();

        Flask.lines_group = new paper.Group();
        Flask.all_lines   = new paper.Group();

        Flask.add_elements( bubble_points, 'bubble' ); // lets make some bubbles
        Flask.add_elements( hero_stories_points, 'hero-story' );
        Flask.add_events();

        Flask.opacity_group = new paper.Group(Flask.bubbles);
        Flask.opacity_group.addChild( Flask.hero_stories );
        */
    },
    onClick: function (event) {
        Flask.remove_links();
        if(Flask.debug){
            console.log( '{x:'+event.point.x+',y:'+event.point.y+'},' );
        }
        
    },
    onMouseMove: function( event ){
        
       if( Flask.watch_moving ) {
       
        Flask.bubbles.moving = true;
        Flask.remove_links();        
        Flask.hit_test( event, 'hero');
        Flask.hit_test( event, 'bubble');
        
       }
    },
    hit_test: function( event, what ) {
    	
        var hitResult = {};
        switch( what ) {
            case 'hero':
                hitResult = Flask.hero_stories.hitTest( event.point );
            break;
            case 'bubble':
            	
            	if( isMSIE ){
            	var add_point = new paper.Point(0, 27);
            	event.point = event.point.add(add_point);
                }
                hitResult = Flask.bubbles.hitTest( event.point );
            break;
        }
        
        if ( hitResult &&  hitResult.item && ( 'Path' == hitResult.item.type  || 'hero' != what ) ) {            
        	
        	if( hitResult.item.parent.kind == 'hero-story' ) {
                hitResult.item = hitResult.item.parent;
            }
            
            hitResult.item.opacity = 1;
            
            // Flask.resize_circle( hitResult.item.parent,  Flask.radius_max );
            
            if(!Flask.link_added)
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
    add_elements: function( points, what){
        var count = 0;
        if( 'bubble' == what ) {
            count = loop_json.length;
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
    add_events: function( ) {
        
        Flask.hero_stories_divs.find('.small-circle').each( function( i ) {
            Flask.add_hover_over_event(i, this );
        });
        
        Flask.hero_stories_divs.find('.big-circle').each( function( i ) {
            Flask.add_hover_over_event( i, this );
        });
    },
    add_hover_over_event: function( i ,el) {

        jQuery(el).on({
        				mouseenter: function() 
						{
						    //stuff to do on mouseover
						    if( Flask.hero_hover_off_timer[i] ){
						        clearTimeout( Flask.hero_hover_off_timer[i] );
						        Flask.hero_hover_off_timer[i] = null;
						    } else {
						        Flask.hover_over_hero_story(    Flask.hero_stories.children[i], i, this ); 
						    }
						
						},
						mouseleave: function()
						{
						    //stuff to do on mouseleave
						    Flask.hero_hover_off_timer[i] = setTimeout( Flask.hover_off_hero_story, 100, Flask.hero_stories.children[i], i, this);
						}
						});
/*
            function() { 
                if( Flask.hero_hover_off_timer[i] ){
                    clearTimeout( Flask.hero_hover_off_timer[i] );
                    Flask.hero_hover_off_timer[i] = null;
                } else {
                    Flask.hover_over_hero_story(    Flask.hero_stories.children[i], i, this ); 
                }
            }, 
            function() { 
               var el = this;
               Flask.hero_hover_off_timer[i] = setTimeout( Flask.hover_off_hero_story, 100, Flask.hero_stories.children[i], i, this);
            }
        );
        */
        
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
        
        if( 'animating' == Flask.fade_animation_state ){
            // lets fade out the bubbles to almost nothing
            
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
        
        
        Flask.fade_animation_state = 'animating';        
        
        Flask.commitments.addClass('hide-away');
        el.addClass('still-show');
        
    },
    show_canvas: function(){
        
        Flask.commitments.removeClass('hide-away').removeClass('still-show');
        Flask.fade_animation_state = 'show';
        
    },
    /* LINKS */
    add_link: function( item, num ) {
        
        var bubles = jQuery('#bubbles');
        

        if( 'bubble' == item.kind ) {
            jQuery( Flask.bubble_link_template( loop_json[num] ) )
            .appendTo(Flask.canvas_wrap)
            .css({'left' : (item.position.x-17), 'top' : (item.position.y+61)})
            .on('click', function() { Flask.click_bubble( item , this ); })
            .hover( function() { Flask.hover_over_bubble( item ); } ,function() { Flask.hover_off_bubble( item ); } );
            
        } else {
            // item.selected = true;
            Flask.hero_stories_divs.eq(num).removeClass('icon-hide')
            .css( { 'left': item.position.x -( item.children[0].width*0.8/2 ) , 'width': item.children[0].width*0.8, 'top': item.position.y + hero_stories_points[num].move_by } );

        }
    },
    click_bubble: function( item, el ) {
        var elm = jQuery(el);
        
        elm.find('.bubble-link-shell').addClass('show');
        elm.find('.bubble-link-excerpt').addClass('show').animate({'height':47},100);
    },
    hover_over_bubble: function( item ) {
        Flask.link_added = true;
        
        var destination = $( '#aboriginal-engagement' );
        Flask.fade_canvas(destination);
        var position = destination.position();
        var width = destination.width(); 
        item.visible = false;
        var from    = new paper.Point( position.left + width/2 , position.top);
        var to      = new paper.Point(item.position.x,item.position.y);
        
        Flask.draw_curve_line( from, to );
    
    },
    hover_off_bubble: function( item ){
        // remove lines 
        item.visible = true;
        Flask.lines_group.removeChildren();
        Flask.all_lines.removeChildren();
        
        Flask.link_added = false;
        
        $(this).on( 'mousemove', Flask.mouse_move_off_bubble);
        Flask.show_canvas();
    },
    hover_over_hero_story: function( item, num, el){
        console.log( 'hover over hero story' );
        if( Flask.lock_links )
            return;


        var new_width = item.children[0].width;
        var new_height = item.children[0].height;
        var move_by_top =  new_height - item.children[0].height;
        var move_by_left = new_width - item.children[0].width;
        Flask.scale_up_hero_story(item, num, el);
        
        Flask.link_added = true;
        
        var destination = $( '#international-engagement' );
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

        
    },
    hover_off_hero_story: function( item, num, el ){
        console.log( 'hover off hero story' );

        if( Flask.lock_links || Flask.delay )
            return;
        if( Flask.hero_hover_off_timer[num] )
            Flask.hero_hover_off_timer[num] = null;

        Flask.scale_down_hero_story( item, num, el );
        
        Flask.hero_stories_divs.addClass('icon-hide');
        Flask.show_canvas();
        Flask.link_added = false;
        
        item.visible = true;
        
        // remove lines 
        Flask.lines_group.removeChildren();
        Flask.all_lines.removeChildren();

    },
    scale_up_hero_story: function(item, num, el ){

        var elm = jQuery(el);
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
        var elm = jQuery(el);
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
    bubble_link_template: function ( data ) {
        
        var html  = '<div class="bubble-paper bubble"><a href="#" class="bubble-link">';
            html += '<span class="bubble-link-shell">'+ data.title +'</span><span class="bubble-link-excerpt">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</span>';
            html += '</a></div>';
            

        return html;
    },
    mouse_move_off_bubble: function( event ){
        
    },
    add_bright_link: function( item ){
        jQuery( '<div class="bubble-paper bubble bubble-bright"><a href="#" class="bubble-link"><span class="bubble-link-shell">Goals that are not written down</span></a></div>' ).appendTo( Flask.canvas_wrap ).css( { 'left' : (item.position.x-17), 'top' : (item.position.y+61) } );
    
    },
    remove_links : function() {
        
        if( !Flask.link_added ){
            Flask.canvas_wrap.find('.bubble-paper').remove();
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
        Flask.fade_canvas(destination);
        var position = destination.position();
        var width = destination.width(); 
            
        var from    = new paper.Point( position.left + width/2 , position.top);
        
        var number_of_circles = Flask.bubbles.children.length;
        
        // this part needs to get doen better
        
        var random  = Math.floor((Math.random()*number_of_circles) + 1 );
        var random2 = Math.floor((Math.random()*number_of_circles) + 1 );
        var random3 = Math.floor((Math.random()*number_of_circles) + 1 );
        var random4 = Math.floor((Math.random()*number_of_circles) + 1 );
        var to = {};
        for (var i = 0; i < number_of_circles; i++) {
            
            if( i == random ) {
                
                to      = new paper.Point( Flask.bubbles.children[i].position.x, Flask.bubbles.children[i].position.y );
                
                Flask.add_bright_link(Flask.bubbles.children[i]);
                Flask.draw_curve_line(from, to);
                
            } else if( i == random2 ){
                
                to      = new paper.Point( Flask.bubbles.children[i].position.x, Flask.bubbles.children[i].position.y );
                
                Flask.add_bright_link(Flask.bubbles.children[i]);
                Flask.draw_curve_line(from, to);
                

            } else if( i == random3 ){
                
                to      = new paper.Point( Flask.bubbles.children[i].position.x, Flask.bubbles.children[i].position.y );
                
                Flask.add_bright_link(Flask.bubbles.children[i]);
                Flask.draw_curve_line(from, to);

            } else if( i == random4 ){
                
                to      = new paper.Point( Flask.bubbles.children[i].position.x, Flask.bubbles.children[i].position.y );
                
                Flask.add_bright_link(Flask.bubbles.children[i]);
                Flask.draw_curve_line(from, to);
        
            }        
        }
        var random_num = Flask.random( 0, 8 );
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
            jQuery(el).addClass('locked');
        }
    }
};
    paper.install( window );
    
    $( document ).ready( Flask.init );
    
})(document, window, jQuery );