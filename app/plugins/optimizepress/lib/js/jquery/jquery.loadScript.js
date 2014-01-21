jQuery.loadScript = function (url, arg1, arg2) {
  var cache = false, callback = null;
  //arg1 and arg2 can be interchangable
  if (jQuery.isFunction(arg1)){
    callback = arg1;
    cache = arg2 || cache;
  } else {
    cache = arg1 || cache;
    callback = arg2 || callback;
  }
               
  var load = true;
  //check all existing script tags in the page for the url
  jQuery('script[type="text/javascript"]')
    .each(function () { 
      return load = (url != jQuery(this).attr('src')); 
    });
  if (load){
    //didn't find it in the page, so load it
    jQuery.ajax({
      type: 'GET',
      url: url,
      success: callback,
      dataType: 'script',
      cache: cache
    });
  } else {
    //already loaded so just call the callback
    if (jQuery.isFunction(callback)) {
      callback.call(this);
    };
  };
};