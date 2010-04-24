/*
 * Inputmask version 1.0
 * (c) 2009 rrd@1108.cc
 *
 * Inputmask is a prototype plugin to easy to handle user input
 *
 *
 * use:
 * new Inputmask('date_iso', $('date'));
 * new Inputmask('amount_eu', $('amount'));
 *
 * Inputmask is under the GNU GENERAL PUBLIC LICENCE v3
 * http://people.csse.uwa.edu.au/jmd/gpl_en.txt
 * http://gnu.hu/gplv3.html
 */

Inputmask = function(type, field){
	this.field = field;

	if(Object.isFunction(type)){	//we got a regex expression in the first parameter
		this.mask = type;
		Event.observe(field, 'input', this.regexp.changer.bindAsEventListener(this));
		}
	else{
		switch(type){
			case 'amount_eu':
				this.mask = '### ### ### ###';	//decimals with ,
				Event.observe(field, 'input', this.amount_eu.changer.bindAsEventListener(this));
				break;
			case 'amount_us':
				this.mask = '###,###,###,###';	//decimals with .
				Event.observe(field, 'input', this.amount_us.changer.bindAsEventListener(this));
				break;
			case 'date_iso':
				this.mask = '####-##-##';	//yyyy-mm-dd
				Event.observe(field, 'input', this.date_iso.changer.bindAsEventListener(this));
				Event.observe(field, 'blur', this.date_iso.changeAfterBlur.bindAsEventListener(this));
				break;
			case 'phone_hu':
				this.mask = '##/##-##-###';
				Event.observe(field, 'input', this.phone_hu.changer.bindAsEventListener(this));
				break;
			default:
				this.mask = '';	//unhandled type, prohibit all input
			}
		
		field.maxLength = this.mask.length;
		//fixChars array contains separator characters
		this.fixChars = new Array();
		for(var i=0; i<this.mask.length; i++)
			if(this.mask.charAt(i) != '#')
				this.fixChars.push(i);
		}
	}//Inputmask

Inputmask.prototype.shortCuts = function(character){
	switch(character){
		case 'h': case 's':	//h: hundred, s: száz
			character = '00';
			break;
		case 't': case 'e':	//t: thousand, e: ezer
			character = '000';
			break;
		case 'm':	//m: million
			character = '000000';
			break;
		default:
			character = '';
		}
	return(character);
	}//shortCuts


Inputmask.prototype.amount_eu = {

	changer : function(){
		var removeRegex = /[^\d,]/;	//everything what is not a number or comma
		var theValue = '';
		var pos = 0;
		var o = this;
	
		//filter out everything what not maches the regex and handle shortcuts
		this.field.value.toArray().each(function(character){
			theValue += o.shortCuts(character);
			if(character.search(removeRegex) == -1)
				theValue += character.replace(removeRegex, '');
			});

		theValue = theValue.split(',');
		var decimals = theValue[1];
		theValue = theValue[0];

		//change the number
		this.fixChars.each(function(i, index){
			if(i < theValue.length){
				pos = theValue.length-i;
				theValue = theValue.substr(0,pos) + o.mask[i] + theValue.substr(pos,theValue.length);
				}
			});
	
		//change decimals
		decimals = (decimals != undefined) ? decimals.substr(0,2) : undefined;
	
		this.field.value = (decimals != undefined) ? theValue + ',' + decimals : theValue;	
	}//amount_eu.changer
}

Inputmask.prototype.date_iso = {}

Inputmask.prototype.date_iso.changer = function(){
	//amikor változtatjuk a bevitt értéket akkor frissíteni kell az input mező tartalmát
	var theValue = '';
	var pos = 0;
	var maskolni = true;
	//todo: gyorsbillenytűk átalakítás, és a többi nem szám character kiszűrése
	this.field.value.toArray().each(function(character){
		if(character == '+'){		//+ jel van benne, a changeAfterBlur elvégzi a szükséges átalakítást
			theValue = '+';
			maskolni = false;
			}
		else if(character.search(/-/) != -1){		//kötőjel van benne, a changeAfterBlur elvégzi a szükséges átalakítást
			theValue += character;
			maskolni = false;
			}
		else if(character.search(/\D/) == -1){
			theValue += character.replace(/\D/, '');
			}
		});
	if(maskolni){
		var o = this;
		//a megszűrt ertek stringbe beszúrjuk a mask elválasztókat
		this.fixChars.each(function(i, index){
			if(i < theValue.length){
				theValue = theValue.substr(0,i) + o.mask[i] + theValue.substr(i,theValue.length);
				}
			});
		}
	this.field.value = theValue;
	}//date_iso.changer

Inputmask.prototype.date_iso.changeAfterBlur = function(){
	var v = this.field.value;
	if(v.search(/\+/) != -1 || v == '')			//+ jellel kezdődik, azaz ma + x nap vagy üres
		this.field.value = this.date_iso.changePlus(v);
	else if(0 < v && v <= 31)						//a hónap x.edik napja
		this.field.value = this.date_iso.changeNum(v);
	else if(v.search(/-/) != -1)		//kötőjel van benne
		this.field.value = this.date_iso.changeMinus(v);
	}//date_iso.changeAfterBlur

Inputmask.prototype.date_iso.changePlus = function(ertek){
	//a dátum +-szal kezdődik azaz ma +x napra kell módosítani
	ertek = parseInt(ertek.replace(/\+/, ''));
	return(this.getdate_iso(ertek));
	}//date_iso.changePlus

Inputmask.prototype.date_iso.changeNum = function(ertek){
	//a dátum egy 31-nél kisebb szám, azaz adott hónap x-edik napjává kell alakítani
	//február 31-ét március 2-vé alakítja
	ertek = this.changePlus((ertek-new Date().getDate()).toString());
	return(ertek);
	}//date_iso.changeNum
	
Inputmask.prototype.date_iso.changeMinus = function(ertek){
	//a dátumban vannak kötőjel(ek)
	if(ertek.length != 10){				//nem teljes dátummal van dolgunk
		if(ertek.match(/-/g).length == 1){	//egy kötőjel van benne, hónap nap adatot kaptunk
			var ev = new Date().getFullYear();
			var ho = this.getHo(ertek.split('-')[0]);
			var nap = this.getNap(ertek.split('-')[1]);
			ertek = ev + '-' + ho + '-' + nap;
			}
		else if(ertek.match(/-/g).length == 2){	//két kötőjelünk van, év, hó nap
			var ev = (ertek.split('-')[0].length == 2) ? '20' + ertek.split('-')[0] : '200' + ertek.split('-')[0];
			var ho = this.getHo(ertek.split('-')[1]);
			var nap = this.getNap(ertek.split('-')[2]);
			ertek = ev + '-' + ho + '-' + nap;
			}
		else										//több mint két kötőjel van benne
			ertek = this.getdate_iso();
		}
	return(ertek);
	}//date_iso.changeMinus
	
Inputmask.prototype.date_iso.getdate_iso = function(napelteres){
	//a dátum eeee-hh-nn formában
	napelteres = napelteres ? napelteres : 0;
	var ma = new Date();
	ma = new Date(ma.getFullYear() + ',' + parseInt(ma.getMonth()+1) + ',' + parseInt(ma.getDate()+napelteres));
	var ho = this.getHo(parseInt(ma.getMonth()+1));
	var nap = this.getNap(ma.getDate());
	return(ma.getFullYear() + '-' + ho + '-' + nap);
	}//date_iso.getdate_iso
	
Inputmask.prototype.date_iso.getHo = function(ho){
	//hónap két characteren
	return(ho < 10 ? '0' + ho : (ho < 13 ? ho : 12));
	}//date_iso.getHo

Inputmask.prototype.date_iso.getNap = function(nap){
	//ap két characteren
	return(nap < 10 ? '0' + nap : (nap < 32 ? nap : 30));
	}//date_iso.getHo
	
Inputmask.prototype.phone_hu = {}

Inputmask.prototype.phone_hu.changer = function(){
	var theValue = '';
	this.field.value.toArray().each(function(character){
		if(character.search(/\D/) == -1)
			theValue += character.replace(/\D/, '');
		});
	var o = this;
	//a megszűrt ertek stringbe beszúrjuk a mask elválasztókat
	this.fixChars.each(function(i, index){
		if(i < theValue.length){
			theValue = theValue.substr(0,i) + o.mask[i] + theValue.substr(i,theValue.length);
			}
		});
	this.field.value = theValue;
	}//phone_hu.changer

Inputmask.prototype.regexp = {}

Inputmask.prototype.regexp.changer = function(){
	var theValue = '';
	var o = this;
	this.field.value.toArray().each(function(character){
		if(character.search(o.mask) != -1)
			theValue += character.replace(o.mask, '');
		});
	this.field.value = theValue;
	}//regexp.changer
