<?php $this->load->view('header') ?>

<!-- Search Box -->
<div id="search_box">
<?=form_open('invoice/search')?>
<?=form_input('search','','class="search"')?>
<?=form_close()?>
</div>

<table class="stripe">
<tbody>
	<tr>
		<th><?=$this->lang->line('invoice_no')?> <?=anchor('invoice/search/id/asc','here')?></th>
		<th><?=$this->lang->line('name')?></th>
		<th><?=$this->lang->line('username')?></th>
		<th><?=$this->lang->line('used')?></th>
		<th><?=$this->lang->line('bill_by')?></th>
		<th><?=$this->lang->line('date')?></th>
		<th><?=$this->lang->line('current_total')?></th>
		<th><?=$this->lang->line('detail')?></th>
		<?php if(isAdmin()): ?>
		<th><?=$this->lang->line('delete')?></th>
		<?php endif; ?>
	</tr>
	<?php foreach ($invoice->result() as $row): ?>
	<tr>
		<td><?=$row->id;?></td>
		<td><?=$row->realname;?></td>
		<td><?=$row->username;?></td>
		<td><?=$row->used;?></td>
		<td><?=$row->bill_by;?></td>
		<td><?=$row->date;?></td>
		<td><?=number_format($row->current_total,$this->config->item('decimal_places'),$this->config->item('decimal_separator'),$this->config->item('thousands_separator'))?></td>
		<td class="action"><?=anchor('invoice/detail/'.$row->username,'detail','class="detail"')?></td>
		<?php if(isAdmin()): ?>
		<td class="action"><?=anchor('invoice/delete/'.$row->username,'detail','class="delete"')?></td>
		<?php endif; ?>
		

	</tr>
	<?php endforeach;?>
</tbody>
</table>
<?=$this->pagination->create_links();?>

<? $this->load->view('footer'); ?>
