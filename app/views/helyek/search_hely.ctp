<ul>
<?php
foreach($searchHely as $s){
	print '<li id="'.$s['Hely']['id'].'">';
	print $s['Hely']['hely'];
	print '</li>';
}
?>
</ul>
