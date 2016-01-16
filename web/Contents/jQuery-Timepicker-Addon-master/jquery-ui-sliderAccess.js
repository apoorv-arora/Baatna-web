/*
 * jQuery UI Slider Access
 * By: Trent Richardson [http://trentrichardson.com]
 * Version 0.3
 * Last Modified: 10/20/2012
 * 
 * Copyright 2011 Trent Richardson
 * Dual licensed under the MIT and GPL licenses.
 * http://trentrichardson.com/Impromptu/GPL-LICENSE.txt
 * http://trentrichardson.com/Impromptu/MIT-LICENSE.txt
 * 
 */


$(document).ready(function(){

  // Hide div 2 by default
  $('#div_2').hide();

  $('#link_2').click(function(){ 
      $('#div_1').hide();
      $('#div_2').show();
  });

  $('#link_1').click(function(){ 
      $('#div_2').hide();
      $('#div_1').show();
  }); 
});