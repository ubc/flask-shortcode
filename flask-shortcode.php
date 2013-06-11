<?php 
/*
Plugin Name: Flask Shortcode
Plugin URI: http://ctlt.ubc.ca
Description: Lets you display you posts using bubbles
Author: Enej UBC CTLT
Version: 1
*/


add_action('before_css','flask_load_modernizer');

function flask_load_modernizer(){

	if( is_front_page() ): ?>
<script type="text/javascript" src="<?php echo plugins_url( 'js/modernizer.js', __FILE__ ); ?>?v=1" ></script>
<?php 
	endif;
}

add_shortcode( 'flask', 'flask_shortcode_handler' );

/**
 * flask_shortcode_handler function.
 * 
 * @access public
 * @param mixed $atts
 * @return void
 */
function flask_shortcode_handler( $atts ) {
	
	// Attributes
	extract( shortcode_atts(
		array(
			'query' => '',
			'taxonomy'   => '',
			'taxonomy_is'=> '',
			'filter_1'   => '',		
			'filter_2_1'   => '',			
			'filter_2_2'   => '',
			'num'		 => 30,
		), $atts )
	);
	
	
	wp_enqueue_script( 'loader' , plugins_url( 'js/loader.js', __FILE__ ), array(), '1.1', true );

	ob_start();
	
	$json = flask_shortcode_json_output( $query, $num, $taxonomy, $taxonomy_is, $filter_1, $filter_2_1, $filter_2_2 );
	/* echo '<pre>';
	var_dump($json['hero']);
	echo '</pre>';
	*/
   	//var_dump( $json['hero'][0]['meta']['wpcf-lead-story-image'][0] );
  ?>
  <script type="text/javascript" >
  var flask_plugin_url = '<?php echo plugins_url( 'js',__FILE__); ?>';
  
  var loop_json = <?php echo json_encode($json); ?>

</script>

<div id="bubbles">
	<ul id="commitments" class="strategic-plan-actions">
		<li class="bubble-commitment-1"><a  id="aboriginal-engagement" href="/aboriginal-engagement-2" alt="bubble-1" ><strong>Aboriginal</strong> <br /> Engagement</a></li>
		<li class="bubble-commitment-2"><a id="alumni-engagement" href="/alumni-engagement-2" alt="bubble-2"><strong>Alumni</strong> <br />Engagement</a></li>
		<li class="bubble-commitment-3"><a id="intercultural-understanding" href="/intercultural-understanding-2" alt="bubble-3"><strong>Intercultural</strong> Understanding</a></li>
		<li class="bubble-commitment-4"><a class="main-commitment" id="research-excellence" href="/research-excellence-2" alt="bubble-5"><strong>Research</strong> <br />Excellence</a></li>
		<li class="bubble-commitment-5"><a class="main-commitment" id="student-learning-2"  href="/student-learning-3" alt="bubble-4"><strong>Student</strong> <br />Learning</a></li>
		<li class="bubble-commitment-6"><a class="main-commitment" id="community-engagement-2"  href="/community-engagement" alt="bubble-6"><strong>Community</strong> Engagement</a></li>
		<li class="bubble-commitment-7"><a id="international-engagement" href="/international-engagement-2" alt="bubble-7"><strong>International</strong> Engagement</a></li>
		<li class="bubble-commitment-8"><a id="outstanding-work-environment" href="/outstanding-work-environment-2" alt="bubble-8"><strong>Outstanding Work</strong> Environment</a></li>
		<li class="bubble-commitment-9"><a id="sustainability" href="/sustainability-2" alt="bubble-9"><br /><strong>Sustainability</strong></a></li>
	</ul>
	
	<div id="canvas-wrap" <?php if(isset($_GET['show-bg'])){?> class="show-bg" <?php } ?>>
	 <canvas id="canvas" height="450px" ></canvas>
	</div>
	<!-- images -->
	<img src="<?php echo plugins_url('flask-shortcode'); ?>/img/icon-story-small.png" id="icon-story" class="icon-hide" width="56" height="56"  />
	
	<?php 
	
	flask_hero_img($json['hero'][0], 0, 'right', 'small' ); 
	flask_hero_img($json['hero'][1], 1, 'left', 'small' ); 
	flask_hero_img($json['hero'][2], 2, 'left' , 'medium'); 
	flask_hero_img($json['hero'][3], 3, 'right', 'medium' ); 
	flask_hero_img($json['hero'][4], 4, 'right' , 'large'); 
	flask_hero_img($json['hero'][5], 5, 'left' , 'medium'); 
	flask_hero_img($json['hero'][6], 6, 'left', 'large'); 
	flask_hero_img($json['hero'][7], 7,'left' , 'small' ); 
	flask_hero_img($json['hero'][8], 8, 'right' , 'medium'); 
	
	
	/*
	flask_hero_img('/img/new/small-l2.png', 0, 'right', 'small' ); 
	flask_hero_img('/img/new/small-r2.png', 1, 'left', 'small' ); 
	flask_hero_img('/img/new/medium-r2.png', 2, 'left' , 'medium'); 
	flask_hero_img('/img/new/medium-l2.png', 3, 'right', 'medium' ); 
	flask_hero_img('/img/new/large-l2.png', 4, 'right' , 'large'); 
	flask_hero_img('/img/new/medium-r2.png', 5, 'left' , 'medium'); 
	flask_hero_img('/img/new/large-r2.png', 6, 'left', 'large'); 
	flask_hero_img('/img/new/small-r2.png', 7,'left' , 'small' ); 
	flask_hero_img('/img/new/medium-l2.png', 8, 'right' , 'medium'); 
	*/
	?>
</div><!-- end of bubbles --> 

	<div id="bubble-filter" class="filter-wrap container" >
	
		<label>Filter By</label>
		<?php if( $filter_1 ): ?>
			<div id="filter-1" class="btn-group dropup">
				<button data-toggle="dropdown" class="btn btn-small dropdown-toggle"><?php echo $filter_1; ?> <span class="caret"></span></button>
				<ul class="dropdown-menu">
				  <li><a href="#<?php echo $filter_1;?>-all">All</a></li>
				  <?php flask_shortcode_taxonomy_filter( $filter_1 ); ?>
				</ul>
			</div>
		<?php endif; ?>

		<a href="/timeline" class="button action">Timeline View <i class="icon-angle-right"></i></a>
	</div>
 

<style >

#bubbles{
	position: relative;
	height: 550px;
	width: 100%;
}
.filter-wrap{
	margin: 0 auto;
}
/* commitmets nav on the home page */
#commitments{
	margin: 40px 0 0;
	list-style: none;
	position: relative;
	z-index: 2;
}
#commitments li{
	float: left;
	width: 11%;
	text-align: center;
	vertical-align: bottom;
	padding: 0;
	margin: 0;
	line-height: 18px;
}
#commitments li .hide-away:hover,
#commitments li a{
	text-decoration: none;
	font-size: 10px;
	line-height: 1.4em;
	display: block;
	margin: 0;
	text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.6);
	padding-bottom: 40px;
	background:  url( <?php echo plugins_url('flask-shortcode'); ?>/img/commitment-nav.png) no-repeat 50% 40px;
	height:38px;
}
#commitments .hide-away{
	cursor: default;
	transition: opacity 200ms;
	-moz-transition: opacity 200ms; /* Firefox 4 */
	-webkit-transition: opacity 200ms; /* Safari and Chrome */
	-o-transition: opacity 200ms; /* Opera */
	opacity: 0.6;
}
#commitments .still-show{
	opacity: 1;
	background-position: 50% -260px;
	cursor: pointer;
}

#commitments li .still-show:hover,
#commitments li .locked{
	font-size:11px;
	line-height: 19px;
	
}
#commitments li .still-show:hover{
	background-position: 50% -412px;

}
#commitments li .locked,
#commitments li .locked:hover{
	background-position: 50% -110px;
}

#commitments li .main-commitment.hide-away,
#commitments li .main-commitment{
	font-size: 14px;
}
#commitments li .main-commitment.still-show,
#commitments li .main-commitment.locked{
	font-size:16px;
}
@media (max-width: 979px) { 
	#commitments li{
		margin:0 -3%;
    	width: 17%;
	}
	#commitments li:nth-child(odd){
		margin-top: -38px;
	}
	
}
/* Landscape phone to portrait tablet */
@media (max-width: 767px) { 
	/* we not have this layout any more… 
	Mobile layout now in effect
	*/
	
	
}
/* from home */
#canvas-wrap{
	position: relative;
}
#canvas{
	z-index: 1;

}
.icon-hero-story{
	position: absolute;
	float: left;
	z-index: 90;
	margin-left: 0;
}
.icon-hero-story img{
	width: 100%;	
}
.big-circle,
.small-circle{
	border-radius: 50%;
	display: block;
	position: absolute;
	bottom: 0;
	background: rgba(255,255,255,0);
	margin-left: 0;
	text-decoration: none;
}
/* small circle */
.icon-hero-size-small .small-circle{
	width:68px;
	height:68px;
}
.icon-hero-size-medium .small-circle{
	width:75.2px;
	height:75.2px;
}
.icon-hero-size-large .small-circle{
	width:86.4px;
	height:86.4px;
}
.circle-position-right .small-circle{
	left: 0;
}
.circle-position-left .small-circle{
	right:0;
}
/* big circle */
.big-circle{
	top:0;
}
.circle-position-right .big-circle{
	right: 0;
}
.circle-position-left .big-circle{
	left:0;
}

.icon-hero-size-small .big-circle{
	width:94.4px;
	height:94.4px;
}

.icon-hero-size-medium .big-circle{
	width:104px;
	height:104px;
}

.icon-hero-size-large .big-circle{
	width:118.4px;
	height:118.4px;
}

.icon-hero-story img{
	width: 100%;
}
.bubble-wrap{
	position: absolute;
	background:transparent;
	width:52px;
	padding-left: 20px;
	padding-top: 20px;
	height: 30px;
	z-index: 100;
}
.bubble{
	z-index: 1;
	color: #AAA;
	width: 32px;
	height: 32px;
	position: absolute;
	opacity: 1;
	-moz-border-radius: 50%;
	-webkit-border-radius: 50%;
	border-radius: 50%; /* future proofing */
	-khtml-border-radius: 50%; /* for old Konqueror browsers */
	background: #743A80 url(<?php echo plugins_url('flask-shortcode'); ?>/img/icon-story-hover.png) no-repeat 0 0;
   cursor: pointer;
}
.bubble:hover{
	-webkit-transition: opacity 0.2s, top 0.2s;
	-webkit-transition-delay: 0;
	-moz-transition: opacity 0.2s, top 0.2s;
	-moz-transition-delay: 0;
	-o-transition: opacity 0.2s, top 0.2s;
	-o-transition-delay: 0;
	opacity: 1;
	background: #743A80 url(<?php echo plugins_url('flask-shortcode'); ?>/img/icon-story-hover.png) no-repeat 0 -45px;
}
.bubble-wrap:hover .bubble{
	background: #743A80 url(<?php echo plugins_url('flask-shortcode'); ?>/img/icon-story-hover.png) no-repeat 0 -45px;
}

.bubble-link{
	display: block;
	color:#FFF;
	margin:-40px 0  0 -210px;
	width: 400px;
	text-decoration: none;
	text-align: center;
	opacity: 1;
	text-transform: uppercase;
	font-weight: bold;
	font-family: Myriad, sans-serif;

}

.bubble-bright{
	 opacity: 1!important;
	 background: #743A80 url(<?php echo plugins_url('flask-shortcode'); ?>/img/icon-story-hover.png) no-repeat 0 0;
}
.bubble-bright .bubble-link{
	opacity:1;
}
.bubble:hover .bubble-link{
	opacity: 1;
}
.bubble-link.show{
	display: block;
	clear: both;
	position: relative;
}

.bubble-link-shell{
	background: rgb(44,65,124);
	background: rgba(44,65,124, 0.6);
	padding:5px 10px;
	margin-top: -11px;
    -moz-box-shadow:inset 0px -1px 14px rgba(0,0,0,0.2);
    -webkit-box-shadow:inset 0px -1px 14px rgba(0,0,0,0.2);
    box-shadow:inset 0px -1px 14px rgba(0,0,0,0.2);
}
.bubble-link-shell.show{
	margin-top: -94px;
}
.bubble-link,
.bubble-link:hover,
.bubble-link-shell:hover{
	color: #FFF;
}
/*
.bubble-link-shell:before { 
	content:""; 
	position: absolute; 
	right: 6px; 
	top: -15px; 
	width: 0; height: 0; 
	border-left: 10px solid transparent; 
	border-right: 10px solid transparent; 
	border-top: 12px solid  rgba(44,65,124, 0.4); 
}
*/
.bubble-link-excerpt{
	margin-top: 0;
	display: none;
	height: 0;
	background: rgba(44,65,124, 0.6);
	font-weight: normal;
	font-size: 14px;
	text-transform: none;
	padding: 0px 15px;
	text-align: left;
}

.bubble-link-excerpt.show{
	display: block;
}
.bubble-bright .bubble-link,
.bubble:hover .bubble-link{
	
}

.icon-hide{
	display: none!important;
}
</style>

  <?php
  $output_string = ob_get_contents();
  ob_end_clean();
  
  return $output_string;
	
}

/**
 * flask_hero_img function.
 * 
 * @access public
 * @param mixed $url
 * @param mixed $number
 * @param string $position (default: 'left')
 * @param string $size (default: 'small')
 * @return void
 */
function flask_hero_img($json_data, $number, $position = 'left', $size = 'small'){ 
	if(is_array($json_data ) ) {
	
		$url = $json_data['meta']['wpcf-lead-story-image'][0];
		$link = $json_data['permalink'];
	} else {
		$url = plugins_url('flask-shortcode') .$url;
		$link = '#';
	}
	?>
	<div class="icon-hide icon-hero-story icon-hero-size-<?php echo $size; ?> circle-position-<?php echo $position; ?>" id="hero-story<?php echo $number;?>-wrap">
	<img src="<?php echo $url;?>" id="hero-story<?php echo $number;?>" />
	<a href="<?php echo esc_url($link); ?>" class="small-circle">&nbsp</a>
	<a href="<?php echo esc_url($link); ?>" class="big-circle ">&nbsp</a>
	</div>
	<?php 
}

/**
 * flask_shortcode_json_output function.
 * 
 * @access public
 * @param mixed $query
 * @param mixed $num
 * @param mixed $taxonomy
 * @param mixed $taxonomy_is
 * @return void
 */
function flask_shortcode_json_output( $query, $num, $taxonomy, $taxonomy_is, $taxonomy_1, $taxonomy_2_1, $taxonomy_2_2 ) {
		

	if(!empty($query) ):
		$query = $query.'&posts_per_page='.$num.'&orderby=menu_order&order=ASC';
	else:
		$query = $query.'&posts_per_page='.$num.'&orderby=menu_order&order=ASC';
	endif;
	
	$query = wp_parse_args( $query );
	
	if( !empty($taxonomy) && !empty($taxonomy_is)):
	$query['tax_query'] = array(
		array(
			'taxonomy' => $taxonomy,
			'field' => 'slug',
			'terms' => $taxonomy_is
		)
	);
	endif;

	$the_query = new WP_Query( $query );
	
	while ( $the_query->have_posts() ) :
		$the_query->the_post();
		
		$tags = array();
		$categories = array();
		$commitments = array();
		$taxonomy_1_post_terms  = array();
		$taxonomy_2_1_post_terms  = array();
		$taxonomy_2_2_post_terms  = array();
		
		
		// get the post tags
		$post_tags = get_the_tags( get_the_ID() );
		if ( $post_tags ) {
			foreach($post_tags as $tag) {
				$tags[]= array( 'name' => $tag->name, 'url' => get_tag_link($tag->term_id) , 'slug' => $tag->slug );
				}
			}
		// get the post categories
		$post_categories = get_the_category( get_the_ID() );
		
		if ($post_categories) {
			foreach( $post_categories as $categorie) {
				$categories[]= array( 'name' => $categorie->name, 'url' => get_category_link($categorie->term_id) , 'slug' => $categorie->slug );
			}
		}
		
		$meta = get_post_meta( get_the_ID() );
		if ( $meta['_thumbnail_id'] ) {
			$img = wp_get_attachment_image_src( $meta['_thumbnail_id'][0], 'full' );
		} else {
			$img = '';
		}
		
		if( isset($meta['wpcf-lead-story']) && $meta['wpcf-lead-story'] == array(1)) {
			$hero_output[] = array(
				'permalink' => get_permalink(),
				'title'	=> get_the_title(),
				'excerpt' => get_the_excerpt(),
				'date' => get_the_date('U')*1000, // milliseconds since Unix Epoch (January 1 1970 00:00:00 GMT)
				'meta' => $meta,
				'tags' => $tags,
				'categories' => $categories,
				'commitments' => flask_shortcode_get_terms( get_the_ID(), 'commitment' ),
				'filter_1'    => flask_shortcode_get_terms( get_the_ID(), $taxonomy_1 ),
				'image' => $img[0]
			);
		} else {
			
			$json_output[] = array(
				'permalink' => get_permalink(),
				'title'	=> get_the_title(),
				'excerpt' => get_the_excerpt(),
				'date' => get_the_date('U')*1000, // milliseconds since Unix Epoch (January 1 1970 00:00:00 GMT)
				'meta' => $meta,
				'tags' => $tags,
				'categories' => $categories,
				'commitments' => flask_shortcode_get_terms( get_the_ID(), 'commitment' ),
				'filter_1'    => flask_shortcode_get_terms( get_the_ID(), $taxonomy_1 ),
				
				'image' => $img[0]
				
			);
		}
	endwhile;

	/* Restore original Post Data 
	 * NB: Because we are using new WP_Query we aren't stomping on the 
	 * original $wp_query and it does not need to be reset.
	*/
	wp_reset_postdata();
	
	return array( 'story' => $json_output, 'hero' => $hero_output );

}


/**
 * flask_shortcode_get_terms function.
 * 
 * @access public
 * @param mixed $post_id
 * @param mixed $taxonomy
 * @return void
 */
function flask_shortcode_get_terms( $post_id, $taxonomy ){

	$taxonomy_terms = get_the_terms( $post_id, $taxonomy );
	
	$terms = array();
	
	if( $taxonomy_terms ) {
		foreach( $taxonomy_terms as $term ) {
			$terms[] = array( 'name' =>  $term->name, 'url' => get_category_link( $term->term_id) , 'slug' => $term->slug );
		}
	}
	
	return $terms;

}

/**
 * monthly_timeline_filter function.
 * 
 * @access public
 * @param mixed $taxonomy
 * @return void
 */
function flask_shortcode_taxonomy_filter( $taxonomy ) { 
	
	$taxonomies = array(  $taxonomy );

	$args = array(
	    'orderby'       => 'name', 
	    'order'         => 'ASC',
	    'hide_empty'    => true, 
	    'fields'        => 'all', 
	    'hierarchical'  => false, 
	);
	$terms = get_terms( $taxonomies, $args );
	if( is_array($terms)): 
	foreach( $terms as $term ):
		
		?><li><a href="#<?php echo $taxonomy.'-'.$term->slug; ?>" data-taxonomy="<?php echo esc_attr($taxonomy); ?>" data-slug="<?php echo esc_attr($term->slug); ?>"><?php echo $term->name; ?></a></li><?php
		
	endforeach;
	endif;
}
'hide_empty'    => true, 
	    'fields'        => 'all', 
	    'hierarchical'  => false, 
	);
	$terms = get_terms( $taxonomies, $args );
	if( is_array($terms)): 
	foreach( $terms as $term ):
		
		?><li><a href="#<?php echo $taxonomy.'-'.$term->slug; ?>" data-taxonomy="<?php echo esc_attr($taxonomy); ?>" data-slug="<?php echo esc_attr($term->slug); ?>"><?php echo $term->name; ?></a></li><?php
		
	endforeach;
	endif;
}
