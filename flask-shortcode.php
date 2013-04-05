<?php 
/*
Plugin Name: Flask Shortcode
Plugin URI: http://ctlt.ubc.ca
Description: Lets you display you posts using bubbles
Author: Enej UBC CTLT
Version: 0.1
*/



add_shortcode( 'flask', 'flask_shortcode_handler');


/**
 * flask_shortcode_handler function.
 * 
 * @access public
 * @param mixed $atts
 * @return void
 */
function flask_shortcode_handler( $atts ) {
	
	wp_enqueue_script( 'flask-points' , plugins_url( 'js/points.js', __FILE__ ), array(), '1.0', true );
	wp_enqueue_script( 'paperjs' , plugins_url( 'js/paper.js', __FILE__ ), array(), '1.0', true );
	wp_enqueue_script( 'flask' , plugins_url( 'js/flask.js', __FILE__ ), array( 'jquery', 'paperjs', 'flask-points' ), '1.0', true );
	ob_start();
  ?> 
  <script type="text/javascript" >
  var flask_plugin_url = '<?php echo plugins_url( 'js'); ?>';
var loop_json = [{"title":"Layout Test","content":"This is a sticky post!!! Make sure it sticks!\n\nThis should then split into other pages with layout, images, HTML tags, and other things.","author":"enej","date":122056934000,"meta":{"_edit_lock":["1352943145:2"]},"tags":[{"name":"tag1","url":"http:\/\/local.dev\/theme\/tag\/tag1\/","slug":"tag1"},{"name":"tag2","url":"http:\/\/local.dev\/theme\/tag\/tag2\/","slug":"tag2"},{"name":"tag3","url":"http:\/\/local.dev\/theme\/tag\/tag3\/","slug":"tag3"}],"categories":[{"name":"aciform","url":"http:\/\/local.dev\/theme\/category\/aciform\/","slug":"aciform"},{"name":"Cat A","url":"http:\/\/local.dev\/theme\/category\/cat-a\/","slug":"cat-a"},{"name":"Cat B","url":"http:\/\/local.dev\/theme\/category\/cat-b\/","slug":"cat-b"},{"name":"Cat C","url":"http:\/\/local.dev\/theme\/category\/cat-c\/","slug":"cat-c"},{"name":"sub","url":"http:\/\/local.dev\/theme\/category\/aciform\/sub\/","slug":"sub"}]},{"title":"New slider for the slider with a really long title that goes here which is super fun!","content":"just the content This title is super long and This title is super long and This title is super long and This title is super long and This title is super long and This title is super long and This title is super long and This title is super long and This title is super long and This title is super long and This title is super long and This title is super long and This title is super long and This title is super long and This title is super long and This title is super long and This title is super long and This title is super long and This title is super long and This title is super long and This title is super long and","author":"enej","date":135881017800,"meta":{"_edit_last":["2"],"_edit_lock":["1358810834:2"],"_thumbnail_id":["977"],"_custom_css":[""],"_custom_js":[""],"_real_post_author":[""]},"tags":[],"categories":[{"name":"Slideshow test","url":"http:\/\/local.dev\/theme\/category\/slideshow-test\/","slug":"slideshow-test"}]},{"title":"Post 1","content":"Content Goes here this post doesn't have an excerpt","author":"enej","date":135829044600,"meta":{"_edit_last":["2"],"_edit_lock":["1358301238:2"],"_thumbnail_id":["938"],"_custom_css":[""],"_custom_js":[""],"_real_post_author":[""]},"tags":[],"categories":[{"name":"Slideshow test","url":"http:\/\/local.dev\/theme\/category\/slideshow-test\/","slug":"slideshow-test"}]},{"title":"new post that has an alert box","content":"testing custom js box javascript! ","author":"enej","date":135724199400,"meta":{"_edit_last":["2"],"_edit_lock":["1357368389:2"],"_custom_css":["\r\n\r\n"],"_custom_js":["\r\n\r\n"],"_real_post_author":[""]},"tags":[],"categories":[{"name":"Uncategorized","url":"http:\/\/local.dev\/theme\/category\/uncategorized\/","slug":"uncategorized"}]},{"title":"New post with red body","content":"red body...","author":"enej","date":135717207200,"meta":{"_edit_last":["2"],"_edit_lock":["1357172095:2"],"_real_post_author":[""],"_custom_css":["body {color:blue; }"]},"tags":[],"categories":[{"name":"Uncategorized","url":"http:\/\/local.dev\/theme\/category\/uncategorized\/","slug":"uncategorized"}]},{"title":"This post is by bob","content":"hey there I am bob","author":"enej","date":135716540800,"meta":{"_edit_last":["2"],"_edit_lock":["1357168612:2"],"_real_post_author":["bobz"]},"tags":[],"categories":[{"name":"Uncategorized","url":"http:\/\/local.dev\/theme\/category\/uncategorized\/","slug":"uncategorized"}]},{"title":"url=\"http:\/\/en.blog.wordpress.com\/feed\/\" show_date=true]","content":"url=\"http:\/\/en.blog.wordpress.com\/feed\/\" show_date=true]","author":"admin","date":135457997500,"meta":{"_edit_last":["1"]},"tags":[],"categories":[{"name":"Uncategorized","url":"http:\/\/local.dev\/theme\/category\/uncategorized\/","slug":"uncategorized"}]},{"title":"url=\"http:\/\/en.blog.wordpress.com\/feed\/\" show_date=true]","content":"url=\"http:\/\/en.blog.wordpress.com\/feed\/\" show_date=true]","author":"admin","date":135457909100,"meta":{"_edit_last":["1"]},"tags":[],"categories":[{"name":"Uncategorized","url":"http:\/\/local.dev\/theme\/category\/uncategorized\/","slug":"uncategorized"}]},{"title":"url=\"http:\/\/en.blog.wordpress.com\/feed\/\" num=3 show_author=true]","content":"url=\"http:\/\/en.blog.wordpress.com\/feed\/\" num=3 show_author=true]","author":"admin","date":135457881000,"meta":{"_edit_last":["1"]},"tags":[],"categories":[{"name":"Uncategorized","url":"http:\/\/local.dev\/theme\/category\/uncategorized\/","slug":"uncategorized"}]},{"title":"url=\"http:\/\/en.blog.wordpress.com\/feed\/\" show_date=updated]","content":"url=\"http:\/\/en.blog.wordpress.com\/feed\/\" show_date=updated]","author":"admin","date":135457245500,"meta":{"_edit_last":["1"]},"tags":[],"categories":[{"name":"Uncategorized","url":"http:\/\/local.dev\/theme\/category\/uncategorized\/","slug":"uncategorized"}]},{"title":"url=\"http:\/\/en.blog.wordpress.com\/feed\/\" show_author=true]","content":"url=\"http:\/\/en.blog.wordpress.com\/feed\/\" show_author=true]","author":"admin","date":135456902400,"meta":{"_edit_last":["1"]},"tags":[],"categories":[{"name":"Uncategorized","url":"http:\/\/local.dev\/theme\/category\/uncategorized\/","slug":"uncategorized"}]},{"title":"url=\"http:\/\/en.blog.wordpress.com\/feed\/\" view=flickr]","content":"url=\"http:\/\/api.flickr.com\/services\/feeds\/photos_public.gne?id=56325980@N00&amp;lang=en-us&amp;format=rss_200\" view=flickr]","author":"admin","date":135456859400,"meta":{"_edit_last":["2"],"_edit_lock":["1358379687:2"],"_custom_css":[""],"_custom_js":[""],"_real_post_author":[""]},"tags":[],"categories":[{"name":"Uncategorized","url":"http:\/\/local.dev\/theme\/category\/uncategorized\/","slug":"uncategorized"}]},{"title":"url=\"http:\/\/en.blog.wordpress.com\/feed\/\" view=calendar]","content":"url=\"http:\/\/en.blog.wordpress.com\/feed\/\" view=calendar]","author":"admin","date":135456856500,"meta":{"_edit_last":["1"]},"tags":[],"categories":[{"name":"Uncategorized","url":"http:\/\/local.dev\/theme\/category\/uncategorized\/","slug":"uncategorized"}]},{"title":"url=\"http:\/\/en.blog.wordpress.com\/feed\/\" view=timeline]","content":"url=\"http:\/\/en.blog.wordpress.com\/feed\/\" view=timeline] ","author":"admin","date":135456853400,"meta":{"_edit_last":["1"]},"tags":[],"categories":[{"name":"Uncategorized","url":"http:\/\/local.dev\/theme\/category\/uncategorized\/","slug":"uncategorized"}]},{"title":"url=\"http:\/\/en.blog.wordpress.com\/feed\/\" view=blog]","content":"url=\"http:\/\/en.blog.wordpress.com\/feed\/\" view=blog]\n","author":"admin","date":135456850200,"meta":{"_edit_last":["1"],"_edit_lock":["1358379832:2"]},"tags":[],"categories":[{"name":"Uncategorized","url":"http:\/\/local.dev\/theme\/category\/uncategorized\/","slug":"uncategorized"}]},{"title":"url=\"http:\/\/en.blog.wordpress.com\/feed\/\" view=archive]","content":"url=\"http:\/\/en.blog.wordpress.com\/feed\/\" view=archive]","author":"admin","date":135456846800,"meta":{"_edit_last":["1"]},"tags":[],"categories":[{"name":"Uncategorized","url":"http:\/\/local.dev\/theme\/category\/uncategorized\/","slug":"uncategorized"}]},{"title":"url=\"http:\/\/en.blog.wordpress.com\/feed\/\" view=upcoming]","content":"url=\"http:\/\/en.blog.wordpress.com\/feed\/\" view=upcoming]","author":"admin","date":135456843500,"meta":{"_edit_last":["1"]},"tags":[],"categories":[{"name":"Uncategorized","url":"http:\/\/local.dev\/theme\/category\/uncategorized\/","slug":"uncategorized"}]},{"title":"url=\"http:\/\/en.blog.wordpress.com\/feed\/\" view=listevents]","content":"url=\"http:\/\/en.blog.wordpress.com\/feed\/\" view=listevents]","author":"admin","date":135456837600,"meta":{"_edit_last":["1"],"_edit_lock":["1358380398:2"]},"tags":[],"categories":[{"name":"Uncategorized","url":"http:\/\/local.dev\/theme\/category\/uncategorized\/","slug":"uncategorized"}]},{"title":"url=\"http:\/\/en.blog.wordpress.com\/feed\/\" view=events]","content":"url=\"http:\/\/en.blog.wordpress.com\/feed\/\" view=events]","author":"admin","date":135456835200,"meta":{"_edit_last":["1"]},"tags":[],"categories":[{"name":"Uncategorized","url":"http:\/\/local.dev\/theme\/category\/uncategorized\/","slug":"uncategorized"}]},{"title":"url=\"http:\/\/en.blog.wordpress.com\/feed\/\" view=rsswidget]","content":"url=\"http:\/\/en.blog.wordpress.com\/feed\/\" view=rsswidget]","author":"admin","date":135456831100,"meta":{"_edit_last":["1"],"_edit_lock":["1358380485:2"]},"tags":[],"categories":[{"name":"Uncategorized","url":"http:\/\/local.dev\/theme\/category\/uncategorized\/","slug":"uncategorized"}]},{"title":"url=\"http:\/\/en.blog.wordpress.com\/feed\/\" view=list]","content":"Description: This feed shortcode returns a list of feed items.\n\nExpected Output:\n<ul>\n\t<li><a href=\"http:\/\/en.blog.wordpress.com\/2012\/12\/03\/oh-my-snow\/\" target=\"_self\">It\u2019s the Most Wonderful Time of the Year<\/a><\/li>\n\t<li><a href=\"http:\/\/en.blog.wordpress.com\/2012\/11\/30\/illustrators\/\" target=\"_self\">Illustrators on WordPress.com<\/a><\/li>\n\t<li><a href=\"http:\/\/en.blog.wordpress.com\/2012\/11\/29\/watson-simfo-publish\/\" target=\"_self\">New Themes: Watson, Simfo, and Publish<\/a><\/li>\n\t<li><a href=\"http:\/\/en.blog.wordpress.com\/2012\/11\/29\/seamless-media\/\" target=\"_self\">Upload and Edit Media Seamlessly on WordPress.com<\/a><\/li>\n\t<li><a href=\"http:\/\/en.blog.wordpress.com\/2012\/11\/28\/wine-and-dine-your-visitors-with-wordpress-com\/\" target=\"_self\">Wine and Dine Your Visitors with WordPress.com<\/a><\/li>\n\t<li><a href=\"http:\/\/en.blog.wordpress.com\/2012\/11\/27\/nablopomo-roundup\/\" target=\"_self\">NaBloPoMo: Keep Up The Good Work, Everyone!<\/a><\/li>\n\t<li><a href=\"http:\/\/en.blog.wordpress.com\/2012\/11\/23\/black-friday-sale\/\" target=\"_self\">Free Custom Design with a Premium Theme Purchase on Black Friday<\/a><\/li>\n\t<li><a href=\"http:\/\/en.blog.wordpress.com\/2012\/11\/21\/from-blog-to-book-moon-over-martinborough\/\" target=\"_self\">From Blog to Book: Moon over Martinborough<\/a><\/li>\n\t<li><a href=\"http:\/\/en.blog.wordpress.com\/2012\/11\/20\/new-theme-academica\/\" target=\"_self\">New Theme: Academica<\/a><\/li>\n\t<li><a href=\"http:\/\/en.blog.wordpress.com\/2012\/11\/16\/firefox-users-try-the-wordpress-com-extension\/\" target=\"_self\">Firefox Users: Try the WordPress.com Extension<\/a><\/li>\n<\/ul>\nActual Output:\n\nurl=\"http:\/\/en.blog.wordpress.com\/feed\/\" view=list]","author":"admin","date":135456826300,"meta":{"_edit_last":["1"]},"tags":[],"categories":[{"name":"Uncategorized","url":"http:\/\/local.dev\/theme\/category\/uncategorized\/","slug":"uncategorized"}]},{"title":"url=\"http:\/\/en.blog.wordpress.com\/feed\/\" target=_blank]","content":"Description: Opens links in a new window.\n\nExpected Output:\n<ul>\n\t<li><a href=\"http:\/\/en.blog.wordpress.com\/2012\/12\/03\/oh-my-snow\/\" target=\"_blank\">It\u2019s the Most Wonderful Time of the Year<\/a><\/li>\n\t<li><a href=\"http:\/\/en.blog.wordpress.com\/2012\/11\/30\/illustrators\/\" target=\"_blank\">Illustrators on WordPress.com<\/a><\/li>\n\t<li><a href=\"http:\/\/en.blog.wordpress.com\/2012\/11\/29\/watson-simfo-publish\/\" target=\"_blank\">New Themes: Watson, Simfo, and Publish<\/a><\/li>\n\t<li><a href=\"http:\/\/en.blog.wordpress.com\/2012\/11\/29\/seamless-media\/\" target=\"_blank\">Upload and Edit Media Seamlessly on WordPress.com<\/a><\/li>\n\t<li><a href=\"http:\/\/en.blog.wordpress.com\/2012\/11\/28\/wine-and-dine-your-visitors-with-wordpress-com\/\" target=\"_blank\">Wine and Dine Your Visitors with WordPress.com<\/a><\/li>\n\t<li><a href=\"http:\/\/en.blog.wordpress.com\/2012\/11\/27\/nablopomo-roundup\/\" target=\"_blank\">NaBloPoMo: Keep Up The Good Work, Everyone!<\/a><\/li>\n\t<li><a href=\"http:\/\/en.blog.wordpress.com\/2012\/11\/23\/black-friday-sale\/\" target=\"_blank\">Free Custom Design with a Premium Theme Purchase on Black Friday<\/a><\/li>\n\t<li><a href=\"http:\/\/en.blog.wordpress.com\/2012\/11\/21\/from-blog-to-book-moon-over-martinborough\/\" target=\"_blank\">From Blog to Book: Moon over Martinborough<\/a><\/li>\n\t<li><a href=\"http:\/\/en.blog.wordpress.com\/2012\/11\/20\/new-theme-academica\/\" target=\"_blank\">New Theme: Academica<\/a><\/li>\n\t<li><a href=\"http:\/\/en.blog.wordpress.com\/2012\/11\/16\/firefox-users-try-the-wordpress-com-extension\/\" target=\"_blank\">Firefox Users: Try the WordPress.com Extension<\/a><\/li>\n<\/ul>\nActual Output:\n\nurl=\"http:\/\/en.blog.wordpress.com\/feed\/\" target=_blank]\n\n&nbsp;","author":"admin","date":135456473000,"meta":{"_edit_last":["1"]},"tags":[],"categories":[{"name":"Uncategorized","url":"http:\/\/local.dev\/theme\/category\/uncategorized\/","slug":"uncategorized"}]},{"title":"url=\"http:\/\/en.blog.wordpress.com\/feed\/\" excerpt=true excerpt_length=200]","content":"Description: This shortcode should render a list of feed items including excerpt.\n\nExpected Output:\n<ul>\n\t<li><a href=\"http:\/\/en.blog.wordpress.com\/2012\/12\/03\/oh-my-snow\/\" target=\"_self\">It\u2019s the Most Wonderful Time of the Year<\/a>\n<div>You\u2019ve already been asking\u2026 where\u2019s the snow? For those new to the WordPress.com family, every year we allow our users to spread a little holiday cheer by having snow appear to fall on their sites, which especially looks cool on sites with darker color schemes. If you\u2019d like to make it snow (not like making [...]<img alt=\"\" src=\"http:\/\/stats.wordpress.com\/b.gif?host=en.blog.wordpress.com&amp;blog=3584907&amp;post=13431&amp;subd=en.blog&amp;ref=&amp;feed=1\" height=\"1\" width=\"1\" \/><\/div>\n<a href=\"http:\/\/en.blog.wordpress.com\/2012\/12\/03\/oh-my-snow\/\" target=\"_self\">Read More\u00a0\u00bb<\/a><\/li>\n\t<li><a href=\"http:\/\/en.blog.wordpress.com\/2012\/11\/30\/illustrators\/\" target=\"_self\">Illustrators on WordPress.com<\/a>\n<div>November was a busy month! Not only did bloggers and writers churn out pages for NaBloPoMo (National Blog Posting Month) and NaNoWriMo (National Novel Writing Month), but illustrators and artists also took part in NaNoDrawMo, which challenged participants to produce a minimum of 50 new works between November 1 and 30. In honor of NaNoDrawMo, [...]<img alt=\"\" src=\"http:\/\/stats.wordpress.com\/b.gif?host=en.blog.wordpress.com&amp;blog=3584907&amp;post=12882&amp;subd=en.blog&amp;ref=&amp;feed=1\" height=\"1\" width=\"1\" \/><\/div>\n<a href=\"http:\/\/en.blog.wordpress.com\/2012\/11\/30\/illustrators\/\" target=\"_self\">Read More\u00a0\u00bb<\/a><\/li>\n\t<li><a href=\"http:\/\/en.blog.wordpress.com\/2012\/11\/29\/watson-simfo-publish\/\" target=\"_self\">New Themes: Watson, Simfo, and Publish<\/a>\n<div>Brace yourselves, new themes are coming. Today I\u2019m pleased to announce the latest three additions to the ever-growing collection of themes here at WordPress.com. First up is Watson, by The Theme Foundry. Inspired by the clean lines and bold strokes of a classic newspaper, Watson boasts a neatly organized front page layout and a pleasurable [...]<img alt=\"\" src=\"http:\/\/stats.wordpress.com\/b.gif?host=en.blog.wordpress.com&amp;blog=3584907&amp;post=13201&amp;subd=en.blog&amp;ref=&amp;feed=1\" height=\"1\" width=\"1\" \/><\/div>\n<a href=\"http:\/\/en.blog.wordpress.com\/2012\/11\/29\/watson-simfo-publish\/\" target=\"_self\">Read More\u00a0\u00bb<\/a><\/li>\n\t<li><a href=\"http:\/\/en.blog.wordpress.com\/2012\/11\/29\/seamless-media\/\" target=\"_self\">Upload and Edit Media Seamlessly on WordPress.com<\/a>\n<div>Uploading and editing media just got a whole lot better on WordPress.com. Check out our new Media Manager, designed to make it easier to upload images, audio, and video files to your site and edit their attributes on the fly. Let\u2019s walk through how to add images to a new post on WordPress.com. Within a [...]<img alt=\"\" src=\"http:\/\/stats.wordpress.com\/b.gif?host=en.blog.wordpress.com&amp;blog=3584907&amp;post=13078&amp;subd=en.blog&amp;ref=&amp;feed=1\" height=\"1\" width=\"1\" \/><\/div>\n<a href=\"http:\/\/en.blog.wordpress.com\/2012\/11\/29\/seamless-media\/\" target=\"_self\">Read More\u00a0\u00bb<\/a><\/li>\n\t<li><a href=\"http:\/\/en.blog.wordpress.com\/2012\/11\/28\/wine-and-dine-your-visitors-with-wordpress-com\/\" target=\"_self\">Wine and Dine Your Visitors with WordPress.com<\/a>\n<div>New Tools for Restaurateurs Between starting the demi-glace and getting the case of chickens out of the walk-in for stock, the last thing we think you should be worrying about as a restaurateur is whether the guests showing up to your soft-open can actually find your phone number and location on your web site. Can [...]<img alt=\"\" src=\"http:\/\/stats.wordpress.com\/b.gif?host=en.blog.wordpress.com&amp;blog=3584907&amp;post=13228&amp;subd=en.blog&amp;ref=&amp;feed=1\" height=\"1\" width=\"1\" \/><\/div>\n<a href=\"http:\/\/en.blog.wordpress.com\/2012\/11\/28\/wine-and-dine-your-visitors-with-wordpress-com\/\" target=\"_self\">Read More\u00a0\u00bb<\/a><\/li>\n\t<li><a href=\"http:\/\/en.blog.wordpress.com\/2012\/11\/27\/nablopomo-roundup\/\" target=\"_self\">NaBloPoMo: Keep Up The Good Work, Everyone!<\/a>\n<div>As November wanes, we\u2019re nearing the end of the 13th National Blog Posting Month, better known as NaBloPoMo. Every single day, participants are firing up their blogs and writing on every topic under the sun in a marathon of self-expression. Are you one of them? If you are looking for more background or inspiration, this [...]<img alt=\"\" src=\"http:\/\/stats.wordpress.com\/b.gif?host=en.blog.wordpress.com&amp;blog=3584907&amp;post=13073&amp;subd=en.blog&amp;ref=&amp;feed=1\" height=\"1\" width=\"1\" \/><\/div>\n<a href=\"http:\/\/en.blog.wordpress.com\/2012\/11\/27\/nablopomo-roundup\/\" target=\"_self\">Read More\u00a0\u00bb<\/a><\/li>\n\t<li><a href=\"http:\/\/en.blog.wordpress.com\/2012\/11\/23\/black-friday-sale\/\" target=\"_self\">Free Custom Design with a Premium Theme Purchase on Black Friday<\/a>\n<div>This Thanksgiving, we\u2019re celebrating with a Black Friday Sale just like we did last year. On Friday, November 23rd, you\u2019ll receive a free one year subscription to our Custom Design Upgrade, a $30 value, when you purchase any Premium Theme. Sale starts Thursday night\u2014November 22, 2012 at 11:00 PM PST. Since last year, we\u2019ve more [...]<img alt=\"\" src=\"http:\/\/stats.wordpress.com\/b.gif?host=en.blog.wordpress.com&amp;blog=3584907&amp;post=13065&amp;subd=en.blog&amp;ref=&amp;feed=1\" height=\"1\" width=\"1\" \/><\/div>\n<a href=\"http:\/\/en.blog.wordpress.com\/2012\/11\/23\/black-friday-sale\/\" target=\"_self\">Read More\u00a0\u00bb<\/a><\/li>\n\t<li><a href=\"http:\/\/en.blog.wordpress.com\/2012\/11\/21\/from-blog-to-book-moon-over-martinborough\/\" target=\"_self\">From Blog to Book: Moon over Martinborough<\/a>\n<div>My name is Jared Gulian, and I\u2019m still not entirely sure how I ended up living in paradise. That\u2019s the first line on the About page of Jared Gulian\u2019s blog,\u00a0Moon over Martinborough. In Jared\u2019s case, \u201cparadise\u201d is a tiny olive farm in rural New Zealand, the location and inspiration for his upcoming book based on [...]<img alt=\"\" src=\"http:\/\/stats.wordpress.com\/b.gif?host=en.blog.wordpress.com&amp;blog=3584907&amp;post=12911&amp;subd=en.blog&amp;ref=&amp;feed=1\" height=\"1\" width=\"1\" \/><\/div>\n<a href=\"http:\/\/en.blog.wordpress.com\/2012\/11\/21\/from-blog-to-book-moon-over-martinborough\/\" target=\"_self\">Read More\u00a0\u00bb<\/a><\/li>\n\t<li><a href=\"http:\/\/en.blog.wordpress.com\/2012\/11\/20\/new-theme-academica\/\" target=\"_self\">New Theme: Academica<\/a>\n<div>Today, I\u2019m happy to announce that our collection of themes grows by one: Academica is a great choice for educational and school websites. Designed by WPZOOM, it sports a classy, modern design and comes with a one-, two-, or three-column layout, nine widget areas, three page templates, and a featured content slider. With all of [...]<img alt=\"\" src=\"http:\/\/stats.wordpress.com\/b.gif?host=en.blog.wordpress.com&amp;blog=3584907&amp;post=12804&amp;subd=en.blog&amp;ref=&amp;feed=1\" height=\"1\" width=\"1\" \/><\/div>\n<a href=\"http:\/\/en.blog.wordpress.com\/2012\/11\/20\/new-theme-academica\/\" target=\"_self\">Read More\u00a0\u00bb<\/a><\/li>\n\t<li><a href=\"http:\/\/en.blog.wordpress.com\/2012\/11\/16\/firefox-users-try-the-wordpress-com-extension\/\" target=\"_self\">Firefox Users: Try the WordPress.com Extension<\/a>\n<div>Want to receive WordPress.com notifications instantly, even when you\u2019re not on WordPress.com? Back in January, we announced the WordPress.com extension for Chrome, and today, the extension is available for Firefox too! Add the WordPress.com extension for Firefox and as soon as you get a new follower, comment, or a like on one of your posts, [...]<img alt=\"\" src=\"http:\/\/stats.wordpress.com\/b.gif?host=en.blog.wordpress.com&amp;blog=3584907&amp;post=12817&amp;subd=en.blog&amp;ref=&amp;feed=1\" height=\"1\" width=\"1\" \/><\/div>\n<a href=\"http:\/\/en.blog.wordpress.com\/2012\/11\/16\/firefox-users-try-the-wordpress-com-extension\/\" target=\"_self\">Read More\u00a0\u00bb<\/a><\/li>\n<\/ul>\nActual Output:\n\nurl=\"http:\/\/en.blog.wordpress.com\/feed\/\" excerpt=true excerpt_length=200]","author":"admin","date":135456415500,"meta":{"_edit_last":["1"]},"tags":[],"categories":[{"name":"Uncategorized","url":"http:\/\/local.dev\/theme\/category\/uncategorized\/","slug":"uncategorized"}]},{"title":"url=\"http:\/\/en.blog.wordpress.com\/feed\/\" num=3]","content":"Description: This is the basic example with the feed items limited to 3 items.\n\nExpected Output:\n<ul>\n\t<li><a href=\"http:\/\/en.blog.wordpress.com\/2012\/12\/03\/oh-my-snow\/\" target=\"_self\">It\u2019s the Most Wonderful Time of the Year<\/a><\/li>\n\t<li><a href=\"http:\/\/en.blog.wordpress.com\/2012\/11\/30\/illustrators\/\" target=\"_self\">Illustrators on WordPress.com<\/a><\/li>\n\t<li><a href=\"http:\/\/en.blog.wordpress.com\/2012\/11\/29\/watson-simfo-publish\/\" target=\"_self\">New Themes: Watson, Simfo, and Publish<\/a><\/li>\n<\/ul>\nActual Output:\n\nurl=\"http:\/\/en.blog.wordpress.com\/feed\/\" num=3]","author":"admin","date":135456144700,"meta":{"_edit_last":["1"]},"tags":[],"categories":[{"name":"Uncategorized","url":"http:\/\/local.dev\/theme\/category\/uncategorized\/","slug":"uncategorized"}]},{"title":"url=\"http:\/\/en.blog.wordpress.com\/feed\/\"]","content":"Description: This is the most basic example of the feed shortcode.\n\nExpected Output:\n<ul>\n\t<li><a href=\"http:\/\/en.blog.wordpress.com\/2012\/12\/03\/oh-my-snow\/\" target=\"_self\">It\u2019s the Most Wonderful Time of the Year<\/a><\/li>\n\t<li><a href=\"http:\/\/en.blog.wordpress.com\/2012\/11\/30\/illustrators\/\" target=\"_self\">Illustrators on WordPress.com<\/a><\/li>\n\t<li><a href=\"http:\/\/en.blog.wordpress.com\/2012\/11\/29\/watson-simfo-publish\/\" target=\"_self\">New Themes: Watson, Simfo, and Publish<\/a><\/li>\n\t<li><a href=\"http:\/\/en.blog.wordpress.com\/2012\/11\/29\/seamless-media\/\" target=\"_self\">Upload and Edit Media Seamlessly on WordPress.com<\/a><\/li>\n\t<li><a href=\"http:\/\/en.blog.wordpress.com\/2012\/11\/28\/wine-and-dine-your-visitors-with-wordpress-com\/\" target=\"_self\">Wine and Dine Your Visitors with WordPress.com<\/a><\/li>\n\t<li><a href=\"http:\/\/en.blog.wordpress.com\/2012\/11\/27\/nablopomo-roundup\/\" target=\"_self\">NaBloPoMo: Keep Up The Good Work, Everyone!<\/a><\/li>\n\t<li><a href=\"http:\/\/en.blog.wordpress.com\/2012\/11\/23\/black-friday-sale\/\" target=\"_self\">Free Custom Design with a Premium Theme Purchase on Black Friday<\/a><\/li>\n\t<li><a href=\"http:\/\/en.blog.wordpress.com\/2012\/11\/21\/from-blog-to-book-moon-over-martinborough\/\" target=\"_self\">From Blog to Book: Moon over Martinborough<\/a><\/li>\n\t<li><a href=\"http:\/\/en.blog.wordpress.com\/2012\/11\/20\/new-theme-academica\/\" target=\"_self\">New Theme: Academica<\/a><\/li>\n\t<li><a href=\"http:\/\/en.blog.wordpress.com\/2012\/11\/16\/firefox-users-try-the-wordpress-com-extension\/\" target=\"_self\">Firefox Users: Try the WordPress.com Extension<\/a><\/li>\n<\/ul>\nActual Output:\n\nurl=\"http:\/\/en.blog.wordpress.com\/feed\/\"]","author":"admin","date":135456087000,"meta":{"_edit_last":["1"]},"tags":[],"categories":[{"name":"Uncategorized","url":"http:\/\/local.dev\/theme\/category\/uncategorized\/","slug":"uncategorized"}]},{"title":"Hey there","content":"this should result in a notification","author":"enej","date":135397382100,"meta":{"_edit_last":["2"],"_edit_lock":["1354646043:2"],"_thumbnail_id":["822"]},"tags":[{"name":"cool","url":"http:\/\/local.dev\/theme\/tag\/cool\/","slug":"cool"},{"name":"some tags","url":"http:\/\/local.dev\/theme\/tag\/some-tags\/","slug":"some-tags"}],"categories":[{"name":"chastening","url":"http:\/\/local.dev\/theme\/category\/chastening\/","slug":"chastening"},{"name":"clerkship","url":"http:\/\/local.dev\/theme\/category\/clerkship\/","slug":"clerkship"},{"name":"Uncategorized","url":"http:\/\/local.dev\/theme\/category\/uncategorized\/","slug":"uncategorized"}]},{"title":"Hello world!","content":"Welcome to <a href=\"http:\/\/local.dev\/\">CMS Dev Sites<\/a>. This is your first post. Edit or delete it, then start blogging!","author":"admin","date":134643260600,"meta":[],"tags":[],"categories":[{"name":"Uncategorized","url":"http:\/\/local.dev\/theme\/category\/uncategorized\/","slug":"uncategorized"}]},{"title":"Readability Test","content":"All children, except one, grow up. They soon know that they will grow up, and the way Wendy knew was this. One day when she was two years old she was playing in a garden, and she plucked another flower and ran with it to her mother. I suppose she must have looked rather delightful, for Mrs. Darling put her hand to her heart and cried, \"Oh, why can't you remain like this for ever!\" This was all that passed between them on the subject, but henceforth Wendy knew that she must grow up. You always know after you are two. Two is the beginning of the end.\n\n<span id=\"more-358\"><\/span>\n\nMrs. Darling first heard of Peter when she was tidying up her children's minds. It is the nightly custom of every good mother after her children are asleep to rummage in their minds and put things straight for next morning, repacking into their proper places the many articles that have wandered during the day.\n\nIf you could keep awake (but of course you can't) you would see your own mother doing this, and you would find it very interesting to watch her. It is quite like tidying up drawers. You would see her on her knees, I expect, lingering humorously over some of your contents, wondering where on earth you had picked this thing up, making discoveries sweet and not so sweet, pressing this to her cheek as if it were as nice as a kitten, and hurriedly stowing that out of sight. When you wake in the morning, the naughtiness and evil passions with which you went to bed have been folded up small and placed at the bottom of your mind and on the top, beautifully aired, are spread out your prettier thoughts, ready for you to put on.\n\nI don't know whether you have ever seen a map of a person's mind. Doctors sometimes draw maps of other parts of you, and your own map can become intensely interesting, but catch them trying to draw a map of a child's mind, which is not only confused, but keeps going round all the time. There are zigzag lines on it, just like your temperature on a card, and these are probably roads in the island, for the Neverland is always more or less an island, with astonishing splashes of colour here and there, and coral reefs and rakish-looking craft in the offing, and savages and lonely lairs, and gnomes who are mostly tailors, and caves through which a river runs, and princes with six elder brothers, and a hut fast going to decay, and one very small old lady with a hooked nose. It would be an easy map if that were all, but there is also first day at school, religion, fathers, the round pond, needle-work, murders, hangings, verbs that take the dative, chocolate pudding day, getting into braces, say ninety-nine, three-pence for pulling out your tooth yourself, and so on, and either these are part of the island or they are another map showing through, and it is all rather confusing, especially as nothing will stand still.\n\nOf course the Neverlands vary a good deal. John's, for instance, had a lagoon with flamingoes flying over it at which John was shooting, while Michael, who was very small, had a flamingo with lagoons flying over it. John lived in a boat turned upside down on the sands, Michael in a wigwam, Wendy in a house of leaves deftly sewn together. John had no friends, Michael had friends at night, Wendy had a pet wolf forsaken by its parents, but on the whole the Neverlands have a family resemblance, and if they stood still in a row you could say of them that they have each other's nose, and so forth. On these magic shores children at play are for ever beaching their coracles [simple boat]. We too have been there; we can still hear the sound of the surf, though we shall land no more.\n\nOf all delectable islands the Neverland is the snuggest and most compact, not large and sprawly, you know, with tedious distances between one adventure and another, but nicely crammed. When you play at it by day with the chairs and table-cloth, it is not in the least alarming, but in the two minutes before you go to sleep it becomes very real. That is why there are night-lights.\n\nOccasionally in her travels through her children's minds Mrs. Darling found things she could not understand, and of these quite the most perplexing was the word Peter. She knew of no Peter, and yet he was here and there in John and Michael's minds, while Wendy's began to be scrawled all over with him. The name stood out in bolder letters than any of the other words, and as Mrs. Darling gazed she felt that it had an oddly cocky appearance.","author":"enej","date":122057444500,"meta":{"_wp_old_slug":[""]},"tags":[{"name":"chattels","url":"http:\/\/local.dev\/theme\/tag\/chattels\/","slug":"chattels"},{"name":"privation","url":"http:\/\/local.dev\/theme\/tag\/privation\/","slug":"privation"}],"categories":[{"name":"Cat A","url":"http:\/\/local.dev\/theme\/category\/cat-a\/","slug":"cat-a"}]},{"title":"Images Test","content":"<h2>Image Alignment Tests: Un-Captioned Images<\/h2>\n\n<h3 id=\"center-align-no-caption\">Center-align, no caption<\/h3>\nCenter-aligned image with no caption, and text before and after. <img src=\"http:\/\/local.dev\/theme\/files\/2010\/08\/test-image-landscape.jpg\" alt=\"\" width=\"300\" height=\"199\" class=\"aligncenter size-full wp-image-535\" \/> ALorem ipsum dolor sit amet, consectetuer adipiscing elit. Sed odio nibh, tincidunt adipiscing, pretium nec, tincidunt id, enim. Fusce scelerisque nunc vitae nisl. Quisque quis urna in velit dictum pellentesque. Vivamus a quam. Curabitur eu tortor id turpis tristique adipiscing. Morbi blandit. Maecenas vel est. Nunc aliquam, orci at accumsan commodo, libero nibh euismod augue, a ullamcorper velit dui et purus. Aenean volutpat, ipsum ac imperdiet fermentum, dui dui suscipit arcu, vitae dictum purus diam ac ligula.\n\n<h3 id=\"left-align-no-caption\">Left-align, no caption<\/h3>\nLeft-aligned image with no caption, and text before and after. <img src=\"http:\/\/local.dev\/theme\/files\/2010\/08\/test-image-landscape.jpg\" alt=\"\" width=\"300\" height=\"199\" class=\"alignleft size-full wp-image-535\" \/> Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Sed odio nibh, tincidunt adipiscing, pretium nec, tincidunt id, enim. Fusce scelerisque nunc vitae nisl. Quisque quis urna in velit dictum pellentesque. Vivamus a quam. Curabitur eu tortor id turpis tristique adipiscing. Morbi blandit. Maecenas vel est. Nunc aliquam, orci at accumsan commodo, libero nibh euismod augue, a ullamcorper velit dui et purus. Aenean volutpat, ipsum ac imperdiet fermentum, dui dui suscipit arcu, vitae dictum purus diam ac ligula.\n\n<h3 id=\"right-align-no-caption\">Right-align, no caption<\/h3>\nRight-aligned image with no caption, and text before and after. <img src=\"http:\/\/local.dev\/theme\/files\/2010\/08\/test-image-landscape.jpg\" alt=\"\" width=\"300\" height=\"199\" class=\"alignright size-full wp-image-535\" \/> Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Sed odio nibh, tincidunt adipiscing, pretium nec, tincidunt id, enim. Fusce scelerisque nunc vitae nisl. Quisque quis urna in velit dictum pellentesque. Vivamus a quam. Curabitur eu tortor id turpis tristique adipiscing. Morbi blandit. Maecenas vel est. Nunc aliquam, orci at accumsan commodo, libero nibh euismod augue, a ullamcorper velit dui et purus. Aenean volutpat, ipsum ac imperdiet fermentum, dui dui suscipit arcu, vitae dictum purus diam ac ligula.\n\n<h3 id=\"no-alignment-no-caption\">No alignment, no caption<\/h3>\nNone-aligned image with no caption, and text before and after. <img src=\"http:\/\/local.dev\/theme\/files\/2010\/08\/test-image-landscape.jpg\" alt=\"\" width=\"300\" height=\"199\" class=\"alignnone size-full wp-image-535\" \/> Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Sed odio nibh, tincidunt adipiscing, pretium nec, tincidunt id, enim. Fusce scelerisque nunc vitae nisl. Quisque quis urna in velit dictum pellentesque. Vivamus a quam. Curabitur eu tortor id turpis tristique adipiscing. Morbi blandit. Maecenas vel est. Nunc aliquam, orci at accumsan commodo, libero nibh euismod augue, a ullamcorper velit dui et purus. Aenean volutpat, ipsum ac imperdiet fermentum, dui dui suscipit arcu, vitae dictum purus diam ac ligula.","author":"enej","date":122043452300,"meta":[],"tags":[],"categories":[{"name":"Uncategorized","url":"http:\/\/local.dev\/theme\/category\/uncategorized\/","slug":"uncategorized"}]},{"title":"Post Format Test: Gallery","content":"[gallery] ","author":"enej","date":121308265400,"meta":[],"tags":[{"name":"Post Formats","url":"http:\/\/local.dev\/theme\/tag\/post-formats\/","slug":"post-formats"}],"categories":[{"name":"Uncategorized","url":"http:\/\/local.dev\/theme\/category\/uncategorized\/","slug":"uncategorized"}]},{"title":"Post Format Test: Aside","content":"\u00e2\u20ac\u0153I never tried to prove nothing, just wanted to give a good show. My life has always been my music, it's always come first, but the music ain't worth nothing if you can't lay it on the public. The main thing is to live for that audience, 'cause what you're there for is to please the people.\u00e2\u20ac\u009d","author":"enej","date":121299791400,"meta":[],"tags":[{"name":"Post Formats","url":"http:\/\/local.dev\/theme\/tag\/post-formats\/","slug":"post-formats"}],"categories":[{"name":"Uncategorized","url":"http:\/\/local.dev\/theme\/category\/uncategorized\/","slug":"uncategorized"}]},{"title":"Post Format Test: Chat","content":"John: foo\nMary: bar\nJohn: foo 2","author":"enej","date":121291197100,"meta":[],"tags":[{"name":"Post Formats","url":"http:\/\/local.dev\/theme\/tag\/post-formats\/","slug":"post-formats"}],"categories":[{"name":"Uncategorized","url":"http:\/\/local.dev\/theme\/category\/uncategorized\/","slug":"uncategorized"}]},{"title":"Post Format Test: Link","content":"<a href=\"http:\/\/make.wordpress.org\/themes\" title=\"The WordPress Theme Review Team Website\">The WordPress Theme Review Team Website<\/a>","author":"enej","date":121282601300,"meta":[],"tags":[{"name":"Post Formats","url":"http:\/\/local.dev\/theme\/tag\/post-formats\/","slug":"post-formats"}],"categories":[{"name":"Uncategorized","url":"http:\/\/local.dev\/theme\/category\/uncategorized\/","slug":"uncategorized"}]},{"title":"Post Format Test: Image (Attached)","content":"[caption id=\"attachment_675\" align=\"aligncenter\" width=\"435\" caption=\"A picture is worth a thousand words\"]<a href=\"http:\/\/wpthemetestdata.wordpress.com\/2008\/06\/06\/post-format-test-image-attached\/boat-2\/\" rel=\"attachment wp-att-675\"><img src=\"http:\/\/local.dev\/theme\/files\/2011\/01\/boat.jpg\" alt=\"boat\" width=\"435\" height=\"288\" class=\"size-full wp-image-675\" \/><\/a>[\/caption] ","author":"enej","date":121274533900,"meta":[],"tags":[{"name":"Post Formats","url":"http:\/\/local.dev\/theme\/tag\/post-formats\/","slug":"post-formats"}],"categories":[{"name":"Uncategorized","url":"http:\/\/local.dev\/theme\/category\/uncategorized\/","slug":"uncategorized"}]},{"title":"Post Format Test: Image (Linked)","content":"[caption id=\"attachment_612\" align=\"aligncenter\" width=\"640\" caption=\"Chunk of resinous blackboy husk, Clarkson, Western Australia. This burns like a spinifex log.\"]<a href=\"http:\/\/local.dev\/theme\/files\/2011\/01\/dsc20040724_152504_532.jpg\"><img src=\"http:\/\/local.dev\/theme\/files\/2011\/01\/dsc20040724_152504_532.jpg\" alt=\"chunk of resinous blackboy husk\" width=\"640\" height=\"480\" class=\"size-full wp-image-612\" \/><\/a>[\/caption]\n","author":"enej","date":121273977900,"meta":{"_wp_old_slug":["post-format-test-image"]},"tags":[{"name":"Post Formats","url":"http:\/\/local.dev\/theme\/tag\/post-formats\/","slug":"post-formats"}],"categories":[{"name":"Uncategorized","url":"http:\/\/local.dev\/theme\/category\/uncategorized\/","slug":"uncategorized"}]},{"title":"Post Format Test: Quote","content":"<blockquote>Only one thing is impossible for God: To find any sense in any copyright law on the planet.\n<cite><a href=\"http:\/\/www.brainyquote.com\/quotes\/quotes\/m\/marktwain163473.html\">Mark Twain<\/a><\/cite><\/blockquote>","author":"enej","date":121265359500,"meta":[],"tags":[{"name":"Post Formats","url":"http:\/\/local.dev\/theme\/tag\/post-formats\/","slug":"post-formats"}],"categories":[{"name":"Uncategorized","url":"http:\/\/local.dev\/theme\/category\/uncategorized\/","slug":"uncategorized"}]},{"title":"Post Format Test: Status","content":"WordPress, how do I love thee? Let me count the ways (in 140 characters or less).","author":"enej","date":121256768400,"meta":[],"tags":[{"name":"Post Formats","url":"http:\/\/local.dev\/theme\/tag\/post-formats\/","slug":"post-formats"}],"categories":[{"name":"Uncategorized","url":"http:\/\/local.dev\/theme\/category\/uncategorized\/","slug":"uncategorized"}]},{"title":"Post Format Test: Video","content":"http:\/\/wordpress.tv\/2009\/03\/16\/anatomy-of-a-wordpress-theme-exploring-the-files-behind-your-theme\/\n\nPosted as per the <a href=\"http:\/\/codex.wordpress.org\/Embeds\" target=\"_blank\">instructions in the Codex<\/a>.","author":"enej","date":121248155800,"meta":{"_oembed_5884b81ab22f735e67279fcd68ee01e2":["<embed src=\"http:\/\/v.wordpress.com\/hrPKeL5t\" type=\"application\/x-shockwave-flash\" width=\"500\" height=\"281\" allowscriptaccess=\"always\" allowfullscreen=\"true\" wmode=\"transparent\"><\/embed>"],"_oembed_ad4968969086c2df8c8c84404c7c222a":["<embed src=\"http:\/\/v.wordpress.com\/hrPKeL5t\" type=\"application\/x-shockwave-flash\" width=\"640\" height=\"360\" allowscriptaccess=\"always\" allowfullscreen=\"true\" wmode=\"transparent\"><\/embed>"],"_oembed_51ff5b3be82f94706b275b4f59aaeaf2":["<embed src=\"http:\/\/v.wordpress.com\/hrPKeL5t\" type=\"application\/x-shockwave-flash\" width=\"780\" height=\"438\" allowscriptaccess=\"always\" allowfullscreen=\"true\" wmode=\"transparent\"><\/embed>"],"_oembed_0fe22300ca2a6437214b02bde7bb6964":["<embed src=\"http:\/\/v.wordpress.com\/hrPKeL5t\" type=\"application\/x-shockwave-flash\" width=\"620\" height=\"348\" allowscriptaccess=\"always\" allowfullscreen=\"true\" wmode=\"transparent\"><\/embed>"]},"tags":[{"name":"Post Formats","url":"http:\/\/local.dev\/theme\/tag\/post-formats\/","slug":"post-formats"}],"categories":[{"name":"Uncategorized","url":"http:\/\/local.dev\/theme\/category\/uncategorized\/","slug":"uncategorized"}]},{"title":"Post Format Test: Audio","content":"<a href='http:\/\/wpthemetestdata.files.wordpress.com\/2008\/06\/hayseedrag-thedizzytrio_vbr1.mp3'>Hayseed Rag \u00e2\u20ac\u201c The Dizzy Trio<\/a>","author":"enej","date":121239580400,"meta":{"enclosure":["http:\/\/wpthemetestdata.files.wordpress.com\/2008\/06\/hayseedrag-thedizzytrio_vbr1.mp3\n2506202\naudio\/mpeg\n","http:\/\/wpthemetestdata.files.wordpress.com\/2008\/06\/hayseedrag-thedizzytrio_vbr1.mp3\n2506202\naudio\/mpeg\n"]},"tags":[{"name":"Post Formats","url":"http:\/\/local.dev\/theme\/tag\/post-formats\/","slug":"post-formats"}],"categories":[{"name":"Uncategorized","url":"http:\/\/local.dev\/theme\/category\/uncategorized\/","slug":"uncategorized"}]},{"title":"If you say it loud enough, you\u00e2\u20ac\u2122ll always sound precocious; Supercalifragilisticexpialidocious!","content":"A post with an exceptionally long title and single word (supercalifragilisticexpialidocious\u00e2\u20ac\u201dit's the biggest word you ever heard) useful for testing title line heights and potential overflow issues on posts with small title areas. :)","author":"admin","date":121007658000,"meta":[],"tags":[],"categories":[{"name":"Uncategorized","url":"http:\/\/local.dev\/theme\/category\/uncategorized\/","slug":"uncategorized"}]}]</script>

<div id="bubbles">
	<ul id="commitments" class="strategic-plan-actions">
		<li class="bubble-commitment-1"><a alt="bubble-1" id="aboriginal-engagement" href="/strategicplan/the-plan/aboriginal-engagement" ><strong>Aboriginal</strong> <br /> Engagement</a></li>
		<li class="bubble-commitment-2"><a id="alumni-engagement" href="/strategicplan/the-plan/alumni-engagement" alt="bubble-2"><strong>Alumni</strong> <br />Engagement</a></li>
		<li class="bubble-commitment-3"><a id="intercultural-understanding" href="/strategicplan/the-plan/intercultural-understanding" alt="bubble-3"><strong>Intercultural</strong> Understanding</a></li>
		<li class="bubble-commitment-4"><a class="main-commitment" id="research-excellence" href="/strategicplan/the-plan/research-excellence" alt="bubble-5"><strong>Research</strong> <br />Excellence</a></li>
		<li class="bubble-commitment-5"><a class="main-commitment" id="student-learning"  href="/strategicplan/the-plan/student-learning" alt="bubble-4"><strong>Student</strong> <br />Learning</a></li>
		<li class="bubble-commitment-6"><a class="main-commitment" id="community-engagement"  href="/strategicplan/the-plan/community-engagement" alt="bubble-6"><strong>Community</strong> Engagement</a></li>
		<li class="bubble-commitment-7"><a id="international-engagement" href="/strategicplan/the-plan/international-engagement" alt="bubble-7"><strong>International</strong> Engagement</a></li>
		<li class="bubble-commitment-8"><a id="outstanding-work-environment" href="/strategicplan/the-plan/outstanding-work-environment" alt="bubble-8"><strong>Outstanding Work</strong> Environment</a></li>
		<li class="bubble-commitment-9"><a id="sustainability" href="/strategicplan/the-plan/sustainability" alt="bubble-9"><br /><strong>Sustainability</strong></a></li>
	</ul>
	
	<div id="canvas-wrap" <?php if(isset($_GET['show-bg'])){?> class="show-bg" <?php } ?>>
	 <canvas id="canvas" height="450px" ></canvas>
	</div>
	<!-- images -->
	<img src="<?php echo plugins_url('flask-shortcode'); ?>/img/icon-story-small.png" id="icon-story" class="icon-hide" width="56" height="56"  />
	<?php flask_hero_img('/img/new/small-l2.png', 0, 'right', 'small' ); ?>
	<?php flask_hero_img('/img/new/small-r2.png', 1, 'left', 'small' ); ?>
	<?php flask_hero_img('/img/new/medium-r2.png', 2, 'left' , 'medium'); ?>
	<?php flask_hero_img('/img/new/medium-l2.png', 3, 'right', 'medium' ); ?>
	
	<?php flask_hero_img('/img/new/large-l2.png', 4, 'right' , 'large'); ?>
	<?php flask_hero_img('/img/new/medium-r2.png', 5, 'left' , 'medium'); ?>
	<?php flask_hero_img('/img/new/large-r2.png', 6, 'left', 'large'); ?>
	<?php flask_hero_img('/img/new/small-r2.png', 7,'left' , 'small' ); ?>
	<?php flask_hero_img('/img/new/medium-l2.png', 8, 'right' , 'medium'); ?>
	
</div><!-- end of bubbles --> 

	<div id="bubble-filter" class="filter-wrap class="container"" >
	
		<label>Filter By</label>
		
		<div class="btn-group dropup">
			<button data-toggle="dropdown" class="btn btn-small dropdown-toggle">Campus <span class="caret"></span></button>
			<ul class="dropdown-menu">
				<li><a href="#">Vancouver</a></li>
				<li><a href="#">Okanagan</a></li>
			</ul>
		</div>
		<div class="btn-group dropup">
			<button data-toggle="dropdown" class="btn btn-small dropdown-toggle">Unit <span class="caret"></span></button>
			<ul class="dropdown-menu">
				<li><a href="#all">All</a></li>
				<li><a href="#applied_science" >Faculty of Applied Science</a></li>
				<li><a href="#arts" >Faculty of Arts</a></li>
				<li><a href="#dentistry" >Faculty of Dentistry</a></li>
				<li><a href="#education" >Faculty of Education</a></li>
				<li><a href="#forestry" >Faculty of Forestry</a></li>
				<li><a href="#graduate" >Faculty of Graduate Studies</a></li>
				<li><a href="#land-food" >Faculty of Land and Food Systems</a></li>
				<li><a href="#law" >Faculty of Law</a></li>
				<li><a href="#medicine" >Faculty of Medicine</a></li>
				<li><a href="#pharmacy" >Faculty of Pharmaceutical Sciences</a></li>
				<li><a href="#science" >Faculty of Science</a></li>
				<li><a href="#sauder" >Sauder School of Business</a></li>
			</ul>
		</div>
		<a href="/timeline" class="button action">Timeline View <span class="arrow-right"></span></a>
	</div>
 

<style>

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
.show-bg{
	background: url(<?php echo plugins_url('flask-shortcode'); ?>/DDB/home.png) no-repeat 0 100px;
}
.icon-hero-story{
	position: absolute;
	float: left;
	z-index: 1000;
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
	background: transparent;
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
.bubble{
	z-index: 1;
	color: #AAA;
	width: 32px;
	height: 32px;
	position: absolute;
	opacity: 0.6;
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

.bubble-link{
	display: block;
	color:#FFF;
	margin:-40px 0  0 -210px;
	width: 460px;
	text-decoration: none;
	text-align: center;
	opacity: 0.2;
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
	display: none;
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
function flask_hero_img($url, $number, $position = 'left', $size = 'small'){ ?>
	<div class="icon-hide icon-hero-story icon-hero-size-<?php echo $size; ?> circle-position-<?php echo $position; ?>" id="hero-story<?php echo $number;?>-wrap">
	<img src="<?php echo plugins_url('flask-shortcode') . $url;?>" id="hero-story<?php echo $number;?>" />
	<a href="#" class="small-circle">&nbsp</a>
	<a href="#" class="big-circle ">&nbsp</a>
	</div>
	<?php 
}