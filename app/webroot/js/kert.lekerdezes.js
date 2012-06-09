kert.lekerdezes = {
	
	init : function(){
		kert.lekerdezes.termenyId = $('NaploTermenyId');
		kert.lekerdezes.termeny = $('NaploTermeny');
		//Event.observe(kert.lekerdezes.termeny, 'change', kert.lekerdezes.termenyhandler);
	},//kert.naplo.init
	
	termenyhandler : function(azInput, aLi){
		kert.lekerdezes.termenyId.value = aLi.id;
	}//kert.lekerdezes.helyhandler
}


document.observe('dom:loaded', function(){
	kert.lekerdezes.init();
	});