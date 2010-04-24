kert.naplo = {
	
	inputok : {
		datum : null,
		koltseg : null,
		ora : null,
		munkas : null
		},
	
	osszktg : null,
	oradij : null,
	
	init : function(){
		kert.naplo.inputok.datum = $('NaploDatum');
		kert.naplo.inputok.koltseg = $('NaploKoltseg');
		kert.naplo.inputok.ora = $('NaploOra');
		kert.naplo.inputok.munkas = $('NaploMunkasId');
		
		kert.naplo.osszktg = $('osszktg');
		kert.naplo.oradij = $('oradij');
		
		new Inputmask('date_iso', kert.naplo.inputok.datum);
		new Inputmask('amount_eu', kert.naplo.inputok.koltseg);
		
		Event.observe(kert.naplo.inputok.koltseg, 'change', kert.naplo.osszegFrissit);
		Event.observe(kert.naplo.inputok.ora, 'change', kert.naplo.osszegFrissit);
		Event.observe(kert.naplo.inputok.munkas, 'change', kert.naplo.getOradij);
	},//kert.naplo.init
	
	osszegFrissit : function(e){
		//az összeg átszámítása
		var ktg = kert.naplo.inputok.koltseg.value ? parseInt(kert.naplo.inputok.koltseg.value.replace(/ /,'')) : 0;
		var osszeg = new String(ktg + parseInt(kert.naplo.inputok.ora.value * kert.naplo.oradij.value));
		osszeg = kert.setNum(osszeg);
		kert.naplo.osszktg.update(number_format(osszeg, 0, ',', ' '));
	},//kert.naplo.osszegFrissit

	getOradij : function(e){
		var selected = kert.naplo.inputok.munkas.selectedIndex;
		kert.naplo.oradij.value = kert.naplo.inputok.munkas.options[selected].parentNode.label;
	},//kert.naplo.getOradij
}


document.observe('dom:loaded', function(){
	kert.naplo.init();
	});