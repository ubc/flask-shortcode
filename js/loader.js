Modernizr.load({
  test: Modernizr.canvas,
  yep : [ flask_plugin_url+'/paper.min.js',flask_plugin_url+'/flask.js' ],
  nope: flask_plugin_url+'/no-canvas.js'
});
