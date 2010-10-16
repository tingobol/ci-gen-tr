/*
 * jQuery formtoolip
 * form alanlarına odaklanıldığında yardım metini görüntülenmesini sağlar
 *
 * Kullanım: $('#form_id').formtooltip();
 * Copyright (c) 2008 Yılmaz Uğurlu, <yilugurlu@gmail.com>, http://www.2nci.com
 * Licensed under the MIT License:
 * http://www.opensource.org/licenses/mit-license.php
 * 
 * $Version: 2008.05.02 rev. 17
 */
 
(function($) {
	$.fn.formtooltip = function(){
		$("input,textarea,select", this).each(function(){
			// sıradaki elemanın title niteliğini alalım
		  var base_title = $(this).attr('title');
		  // eğer boş değilse
		  if(undefined!=base_title && ''!= base_title)
		  {
		  	// uzun yardım metinlerini | karakterinden itibaren bir satır alta geçirmek için
		  	// küçük bir düzenli ifade çalıştıralım
		    var title = base_title.replace(/\|/g, "<br />");
		    // yardım metni için ekleyeceğimiz elemanın adını
		    // sıradaki elemanın name niteliğinden türetelim
		    var new_elem = $(this).attr('name')+'_hint';
	
		    // form alanına odaklanıldığında
		    //$(this).mouseover(function(){
			$(this).focus(function(){
		    	// sıradaki elemanın title niteliğini kaldıralım
		    	// böylece yardım metnimiz göründüğünde, ikinci defa elemanın title niteliği görünmemiş olur
		    	$(this).attr('title', '');
		    	// yeni bir span etiketi ile yardım metnimizi oluşturalım ve gösterelim
		      $(this).after('<span class="hint" id="'+new_elem+'">'+title+'<span class="hint-pointer">&nbsp;<\/span><\/span>');
		      $('#'+new_elem).show();
		      
		    //}).mouseout(function() { // odak form alanından çıktığında
			}).blur(function() { // odak form alanından çıktığında
		      // yardım metni için oluşturduğumuz elemanı silelim
		      $('#'+new_elem).remove();
		      // içeriğin title niteliğini tekar kullanmak için tekrar oluşturalım
		      $(this).attr('title', base_title);
		    });
		  }     
		});
	}
	$.fn.ikontooltip = function(){
		$("a", this).each(function(){
			var base_title = $(this).attr('title');
			if(undefined!=base_title && ''!= base_title)
			{
				var title = base_title.replace(/\|/g, "<br />");
				var new_elem = $(this).attr('name')+'_hint';
				$(this).mouseover(function(){
					$(this).attr('title', '');
					$(this).after('<span class="hint" id="'+new_elem+'">'+title+'<span class="hint-pointer">&nbsp;<\/span><\/span>');
					$('#'+new_elem).show();
			}).mouseout(function() { // odak form alanından çıktığında
		      // yardım metni için oluşturduğumuz elemanı silelim
		      $('#'+new_elem).remove();
		      // içeriğin title niteliğini tekar kullanmak için tekrar oluşturalım
		      $(this).attr('title', base_title);
		    });
			}
		})
	}
})(jQuery);