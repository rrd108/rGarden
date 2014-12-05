<div class="naplok view">
<h2><?php echo __('Naplo');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Munkas'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($naplo['Munkas']['munkas'], array('controller' => 'munkasok', 'action' => 'view', $naplo['Munkas']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Hely'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($naplo['Hely']['hely'], array('controller' => 'helyek', 'action' => 'view', $naplo['Hely']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Szolgtipus'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($naplo['Szolgtipus']['szolgalattipus'], array('controller' => 'szolgtipusok', 'action' => 'view', $naplo['Szolgtipus']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Datum'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $naplo['Naplo']['datum']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Szolgalat'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $naplo['Naplo']['szolgalat']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Ora'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $naplo['Naplo']['ora']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Termeny'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($naplo['Termeny']['termeny'], array('controller' => 'termenyek', 'action' => 'view', $naplo['Termeny']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Mennyiseg'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $naplo['Naplo']['mennyiseg']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Mennyiségi egység'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($naplo['Mennyisegiegyseg']['mennyisegiegyseg'], array('controller' => 'mennyisegiegysegek', 'action' => 'view', $naplo['Mennyisegiegyseg']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Felhasznalt'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $naplo['Naplo']['felhasznalt']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Koltseg'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $naplo['Naplo']['koltseg']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Vevo'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($naplo['Vevo']['vevo'], array('controller' => 'vevok', 'action' => 'view', $naplo['Vevo']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Megjegyzes'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $naplo['Naplo']['megjegyzes']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Új naplóbejegyzés'), array('action' => 'add'));?></li>
		<li><?php echo $this->Html->link(__('Naplóbejegyzések'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('Munkások'), array('controller' => 'munkasok', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Helyek'), array('controller' => 'helyek', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Termények'), array('controller' => 'termenyek', 'action' => 'index')); ?> </li>
	</ul>
</div>
