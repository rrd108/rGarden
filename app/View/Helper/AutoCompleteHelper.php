<?php

App::uses('AppHelper', 'View/Helper');

class AutoCompleteHelper extends AppHelper {

	var $helpers = array('Form', 'Html');

/*
* a prototype.js alap Ajax.Autocempleter kiegészítője
*
* @param string $field a html input id-je amibe belepötyögünk
* @param string $url a szerveren meghívandó url
* @param array $options a lehetséges opciók
* 						div_id					az autocompleter találatait megjelenítő div id-je
* 						id							az autocompleter találatait megjelenítő div id képzéséhez kell, ha nincs az előző (divid)
* 						autocompleterOptions	az autocompleterhez használható JS változók mint token, afterUpdateElement, stb JS ojjektum formában
* 						???						minden egyéb átadható html opció
*/
	function create($field, $url = "", $options = array()){
		
		//ha nem adtunk meg az options tömbben id-t, akkor a $filed-ben cseréljük ki a pontokat aláhúzásra és nagybetűsítsünk
		if (!isset($options['id'])) {
			$htmlOptions['id'] = $options['id'] = Inflector::camelize(str_replace(".", "_", $field));
		}
		else{
			$htmlOptions['id'] = $options['id'];
		}

		//adjunk hozzá a majdani auto_complete megjelenítő divünkhöz egy id-t ami a $filedből jön, és adjunk neki css class-t
		$divOptions = array(
			'id' => $options['id'] . "_autoComplete",
			'class' => isset($options['class']) ? $options['class'] : 'auto_complete',
			'style' => 'display:none;'
		);

		//persze ha megadtuk a div_id-t akkor inkávbb használjuk azt
		if (isset($options['div_id'])) {
			$divOptions['id'] = $options['div_id'];
			unset($options['div_id']);
		}

		//a böngésző autocompleterét kikapcsoljuk
		$htmlOptions['autocomplete'] = "off";
		
		//required falsera
		$htmlOptions['required'] = false;
		
		//value
		$htmlOptions['value'] = isset($options['value']) ? $options['value'] : null;
		
		//autocompleterOptions
		if(isset($options['autocompleterOptions'])) {
			$acOptions = $options['autocompleterOptions'];
		}
		else
			$acOptions = '{}';
		

/*
new Ajax.Autocompleter('BizonylatOsztalytol',
								'Osztalytol_autoComplete',
								laksmi.baseUrl + '/osztalyok/search',
								{afterUpdateElement:laksmi.bizonylat.bizonylat.getOsztalyId}
								);
*/
		$text = $this->Form->text($field, $htmlOptions);
		$div = $this->Html->div(null, '', $divOptions);
		$script = "new Ajax.Autocompleter('{$options['id']}','{$divOptions['id']}','";
		$script .= $this->Html->url($url) . "', " . $acOptions . ");";

		return  "{$text}\n{$div}\n" . $this->Html->scriptBlock($script);
	}
}

?>