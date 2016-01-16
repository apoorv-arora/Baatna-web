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

  // Hide all div by default except div1
	$('#div2').hide();
	$('#div3').hide();
	$('#div4').hide();
	$('#div5').hide();
	$('#div6').hide();
	$('#div7').hide();
	$('#div8').hide();


  $('#link_1').click(function(){ 
      $('#div1').hide();
      $('#div2').show();
  });

  $('#link_2').click(function(){ 
      $('#div2').hide();
      $('#div3').show();
  });
  
   $('#link_3').click(function(){ 
      $('#div3').hide();
      $('#div4').show();
  });
  
   $('#link_4').click(function(){ 
      $('#div4').hide();
      $('#div5').show();
  });
  
   $('#link_5').click(function(){ 
      $('#div5').hide();
      $('#div6').show();
  });
  
   $('#link_6').click(function(){ 
      $('#div6').hide();
      $('#div7').show();
  });
  
   $('#link_7').click(function(){ 
      $('#div7').hide();
      $('#div8').show();
  });
  
   
});