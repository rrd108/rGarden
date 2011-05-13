<ul>
<?php
foreach($searchTermeny as $s){
	print '<li id="'.$s['Termeny']['id'].'">';
	print $s['Termeny']['termeny'];
	print '</li>';
}
?>
</ul>
