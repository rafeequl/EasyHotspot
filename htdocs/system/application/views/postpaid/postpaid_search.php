<?php $this->load->view('header') ?>

<h1><?=$action?></h1>

<!-- Search Box -->
<div id="search_box">
<?=form_open('postpaid/search')?>
<?=form_input('search','','class="search"')?>
<?=form_close()?>
</div>

<table class="stripe">
<tbody>
	<tr>
		<th><?=$this->lang->line('realname')?></th>
		<th><?=$this->lang->line('username')?></th>
		<th><?=$this->lang->line('password')?></th>
		<th><?=$this->lang->line('used')?></th>
		<th><?=$this->lang->line('bill_by')?></th>
		<th><?=$this->lang->line('current_total')?></th>
		<th colspan="4" class="center">Action</th>
	</tr>
	
	<?php foreach ($account->result() as $row): ?>
	<tr>
		<td><?=$row->realname;?></td>
		<td><?=$row->username;?></td>
		<td><?=$row->password;?></td>
		<td><?=($row->bill_by=='time') ? number_format($row->time_used,$this->config->item('decimal_places'),$this->config->item('decimal_separator'),$this->config->item('thousands_separator')) : number_format($row->packet_used,$this->config->item('decimal_places'),$this->config->item('decimal_separator'),$this->config->item('thousands_separator'));?></td>
		<td><?=$row->bill_by;?></td>
		<td><?=($row->bill_by=='time') ? number_format($row->time_price,$this->config->item('decimal_places'),$this->config->item('decimal_separator'),$this->config->item('thousands_separator')):number_format($row->packet_price,$this->config->item('decimal_places'),$this->config->item('decimal_separator'),$this->config->item('thousands_separator'));?></td>
		<td class="action"><?=anchor('postpaid/delete/'.$row->username,'del','class="delete" onClick="return confirm(\'Delete User'.' '.$row->username.'?\')"')?></td>
		<td class="action"><?=anchor('postpaid/edit/'.$row->username,'edit','class="edit"')?></td>
		<td class="action"><?=anchor('postpaid/bill/'.$row->username,'bill','class="bill"')?></td>
		<td class="action"><?=anchor('postpaid/print_voucher/'.$row->username,'print','class="print"')?></td>

	</tr>
	<?php endforeach;?>
</tbody>
</table>
<?=$this->pagination->create_links();?>


<? $this->load->view('footer'); ?>
