Modernizr.load({
  test: Modernizr.canvas,
  yep : [ flask_plugin_url+'js/paper.js',flask_plugin_url+'js/points.js', flask_plugin_url+'js/flask.js', flask_plugin_url+'css/flask.css' ],
  nope: 'geo-polyfill.js'
});