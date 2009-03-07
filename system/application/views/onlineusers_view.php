<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view('header') ?>

<h1><?=$action?></h1>


<table class="stripe">
<tbody>
	<tr>
		<th><?=$this->lang->line('username')?></th>
		<th>Start</th>
		<th>Duration</th>
		<th>Packet</th>

		<th>Force Disconnect</th>
	</tr>
	
	
	<?php foreach ($onlineusers->result() as $row): ?>
	<tr>
		<td><?=$row->username;?></td>
		<td><?=$row->start;?></td>
		<td><?=$row->time;?></td>
		<td><?=$row->packet;?></td>
		<td><?=anchor('onlineuser/disconnect/'.$row->username,'disconnect','class="disconnect" ')?></td>
	</tr>
	<?php endforeach;?>
</tbody>
</table>




<? $this->load->view('footer'); ?>
