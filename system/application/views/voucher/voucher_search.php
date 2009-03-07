<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view('header') ?>

<h1><?=$action?></h1>

<!-- Search Box -->
<div id="search_box">
<?=form_open('voucher/search')?>
<?=form_input('search','','class="search"')?>
<?=form_close()?>
</div>

<table class="stripe">
<tbody>
	<tr>
		<th>Username</th>
		<th>Password</th>
		<th>Billing Plan</th>
		
		<th>Time Used</th>
		<th>Time Remain</th>
		<th>Packet Used</th>
		<th>Packet Remain</th>
		<th>Printed</th>
		<th colspan='3'></th>
	</tr>
	
	<?php foreach ($vouchers->result() as $row): ?>
	<tr>
		<td><?=$row->username;?></td>
		<td><?=$row->password;?></td>
		<td><?=$row->billingplan;?></td>
		
		<td><?=($row->time_used == '' || $row->time_used == 'null') ? '---' : $row->time_used ;?></td>
		<td><?=($row->time_remain == '' || $row->time_remain == 'null') ? '---' : $row->time_remain ;?></td>
		<td><?=($row->packet_used == '' || $row->packet_used == 'null') ? '---' : $row->packet_used ;?></td>
		<td><?=($row->packet_remain == '' || $row->packet_remain == 'null') ? '---' : $row->packet_remain ;?></td>
		<td><?= ($row->isprinted == false ) ? 'no' : 'yes';?></td>
		<td><?=anchor('voucher/delete/'.$row->username,'del','class="delete" onClick="return confirm(\'Delete User'.' '.$row->username.'?\')"')?></td>
		<td><?=anchor('voucher/edit/'.$row->username,'edit','class="edit" ')?></td>
		<td><?=anchor('voucher/print_voucher/'.$row->username,'print','class="print" ')?></td>
	</tr>
	<?php endforeach;?>
</tbody>
</table>
<?=$this->pagination->create_links();?>


<? $this->load->view('footer'); ?>
