
function flask_on_resize(){
	var canvas_width = jQuery("#bubbles").width();
	
	jQuery('.icon-hero-story').each(function(i, el){
	
		var Ratio = canvas_width/1200;
		var width_ratio = 220*Ratio 
		if(  width_ratio > 170 ){
			width_ratio = 170;
		}
		var pos_left = hero_stories_points[i].x*Ratio;
		var pos_top  = hero_stories_points[i].y;
		
		var elm = jQuery(el).removeClass('icon-hide').css({left: pos_left-50, top: pos_top, width: width_ratio+'px' });
	});

};

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

jQuery('#bubble-filter').find('label').hide();
jQuery('#filter-1').hide();



jQuery(function(){
	
	jQuery(window).resize(function(){
		flask_on_resize();
	});
	
	
	flask_on_resize();
});

window.addEventListener("orientationchange", function() {
	flask_on_resize();
}, false);
