var kert = {
	
	init : function(){
		
	},
	
	setNum : function(szoveg){
		//number_formattal formázott szám tényleges számmá való visszaalakítása
		//ezres elválasztó szóköz vagy pont eltávolítása
		szoveg = szoveg.replace(/ /g, '');
		szoveg = szoveg.replace(/\./g, '');
		//tizedesvesszőből tizedespont
		szoveg = szoveg.replace(/,/, '.');
		return(parseFloat(szoveg));
	}
	
}

document.observe('dom:loaded', function(){
	kert.init();
	});

function number_format( number, decimals, dec_point, thousands_sep ) {
	var n = number, c = isNaN(decimals = Math.abs(decimals)) ? 2 : decimals;
	var d = dec_point == undefined ? "," : dec_point;
	var t = thousands_sep == undefined ? "." : thousands_sep, s = n < 0 ? "-" : "";
	var i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", j = (j = i.length) > 3 ? j % 3 : 0;
	return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
}