<ul>
<?php
foreach($searchMunkas as $s){
	print '<li id="'.$s['Munkas']['id'].'_'.$s['Munkas']['oradij'].'">';
	print $s['Munkas']['munkas'];
	print '</li>';
}
?>
</ul>
