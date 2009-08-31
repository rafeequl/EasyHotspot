<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view('header') ?>
<?php $account=$account->row(); ?>
<?php $i=1; ?>
<h1><?=$action?></h1>

<div id="billing">
	<div id="hotspot_info">
		<h3><?=$this->config->item('company_name')?></h3>
		<p class="info"><?=$this->config->item('company_address_line1')?></p>
		<p class="info"><?=$this->config->item('company_address_line2')?></p>
		<p class="info"><?=$this->config->item('company_address_line3')?></p>
		<p class="info"><?=$this->config->item('company_phone')?></p>
		<p class="info"><?=$this->config->item('company_tax_code')?></p>
	</div>
	<div id="personal_info">
		<p><label><?=$this->lang->line('date')?></label><span><?=date("M d Y")?></span></p>
		<p><label><?=$this->lang->line('to')?></label><span><?=$account->realname;?></span></p>
		<p><label><?=$this->lang->line('username')?></label><span><?=$account->username?></span></p>
		<p><label><?=$this->lang->line('billing_type')?></label><span><?=$account->bill_by?></span></p>
	</div>
	
	<div id="billing_detail_container">
	<table class="billing_detail">
	<tbody>
		<tr>
			<th><?=$this->lang->line('no')?></th>
			<th><?=$this->lang->line('access_start')?></th>
			<th><?=$this->lang->line('access_stop')?></th>
			<th><?=$this->lang->line('duration_amount')?></th>
			<th><?=$this->lang->line('total')?></th>
		</tr>
		
		<?php foreach($usage->result() as $row): ?>
		<tr>
			<td><?=$i?></td>
			<td><?=$row->start?></td>
			<td><?=$row->stop?></td>
			<td><?=($row->bill_by == 'time') ? $row->time_used : $row->packet_used ?></td>
			<td class="total_qty"><?=($row->bill_by == 'time') ? number_format($row->time_price,$this->config->item('decimal_places'),$this->config->item('decimal_separator'),$this->config->item('thousands_separator')) : number_format($row->packet_price,$this->config->item('decimal_places'),$this->config->item('decimal_separator'),$this->config->item('thousands_separator')) ?></td>
			<?php $i++ ?>
		</tr>
		<?php endforeach; ?>
		
		<tr>
			<td colspan="4" class="subtotal">Subtotal</td>
			<td class="total"><?=$this->config->item('currency_symbol')?><?=($account->bill_by == 'time') ? number_format($account->time_price,$this->config->item('decimal_places'),$this->config->item('decimal_separator'),$this->config->item('thousands_separator')) : number_format($account->packet_price,$this->config->item('decimal_places'),$this->config->item('decimal_separator'),$this->config->item('thousands_separator'))?></td>
		</tr>
	</tbody>
	</table>
	</div>
	<div id='billing_action'>
		<?=form_open('postpaid/print')?>
		<?=form_close();?>
	</div>
	
	<p><?=anchor('invoice/create/'.$row->username,$this->lang->line('close_and_print_invoice'),' onClick="return confirm(\''.$this->lang->line('close_and_print_invoice_for').' '.$row->username.'?\')"')?></p>
</div>

<? $this->load->view('footer'); ?>
