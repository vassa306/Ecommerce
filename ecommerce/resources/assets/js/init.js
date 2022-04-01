(function(){
'use strict'
$(document).foundation();
		
		$(document).ready(function(){
		//Switch Pages
		switch($("body").data("page-id")){
		case 'home':
		ACMESTORE.homeslider.initCarousel();
			break;
		case 'adminProducts':
			ACMESTORE.admin.changeEvent();
			ACMESTORE.admin.delete();
		break;
		case 'adminCategories':
			ACMESTORE.admin.update();
			ACMESTORE.admin.delete();
			ACMESTORE.admin.create();
			break;
		default:
		//do nothing
		}
		})
		
		
		})();