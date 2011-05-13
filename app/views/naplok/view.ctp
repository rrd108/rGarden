<div class="naplok view">
<h2><?php  __('Naplo');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Munkas'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($naplo['Munkas']['munkas'], array('controller' => 'munkasok', 'action' => 'view', $naplo['Munkas']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Hely'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($naplo['Hely']['hely'], array('controller' => 'helyek', 'action' => 'view', $naplo['Hely']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Szolgtipus'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($naplo['Szolgtipus']['szolgalattipus'], array('controller' => 'szolgtipusok', 'action' => 'view', $naplo['Szolgtipus']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Datum'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $naplo['Naplo']['datum']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Szolgalat'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $naplo['Naplo']['szolgalat']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Ora'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $naplo['Naplo']['ora']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Termeny'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($naplo['Termeny']['termeny'], array('controller' => 'termenyek', 'action' => 'view', $naplo['Termeny']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Mennyiseg'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $naplo['Naplo']['mennyiseg']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Mennyiségi egység'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($naplo['Mennyisegiegyseg']['mennyisegiegyseg'], array('controller' => 'mennyisegiegysegek', 'action' => 'view', $naplo['Mennyisegiegyseg']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Felhasznalt'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $naplo['Naplo']['felhasznalt']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Koltseg'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $naplo['Naplo']['koltseg']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Vevo'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($naplo['Vevo']['vevo'], array('controller' => 'vevok', 'action' => 'view', $naplo['Vevo']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Megjegyzes'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $naplo['Naplo']['megjegyzes']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Új naplóbejegyzés', true), array('action' => 'add'));?></li>
		<li><?php echo $html->link(__('Naplóbejegyzések', true), array('action' => 'index'));?></li>
		<li><?php echo $html->link(__('Munkások', true), array('controller' => 'munkasok', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('Helyek', true), array('controller' => 'helyek', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('Termények', true), array('controller' => 'termenyek', 'action' => 'index')); ?> </li>
	</ul>
</div>
