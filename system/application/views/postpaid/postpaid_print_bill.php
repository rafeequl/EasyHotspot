<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $i=1 ?>
<?php $account=$account->row(); ?>
<html>
<head>
</head>
<body>
<table width=100%>
	<tr>
		<td align='left' width=50%>
			<table>
			<tr><td width=60%>To</td><td><?=$account->realname;?></td></tr>
			<tr><td><?=$this->lang->line('username')?></td><td><?=$account->username?></td></tr>	
			<tr><td><?=$this->lang->line('billing_type')?></td><td><?=$account->bill_by?></td></tr>
			</table>
		</td>
		<td align='right' width=50%>
			<table>
			<tr><td><?=$this->config->item('company_name')?></td></tr>
			<tr><td><?=$this->config->item('company_address_line1')?></td></tr>
			<tr><td><?=$this->config->item('company_address_line2')?></td></tr>
			<tr><td><?=$this->config->item('company_address_line3')?></td></tr>
			<tr><td><?=$this->config->item('company_phone')?></td></tr>
			<tr><td><?=$this->config->item('company_tax_code')?></td></tr>
			</table>
		</td>
	</tr>
</table>
<p>
<table width=100%>
	<tbody>
		<tr>
			<th><?=$this->lang->line('no')?></th>
			<th><?=$this->lang->line('access_time')?></th>
			<th><?=$this->lang->line('duration_amount')?></th>
			<th><?=$this->lang->line('total')?></th>
		</tr>
		
		<?php foreach($usage->result() as $row): ?>
		<tr>
			<td><?=$i?></td>
			<td><?=$row->start?></td>
			<td><?=($row->bill_by == 'time') ? number_format($row->time_used,$this->config->item('decimal_places'),$this->config->item('decimal_separator'),$this->config->item('thousands_separator')) : number_format($row->packet_used,$this->config->item('decimal_places'),$this->config->item('decimal_separator'),$this->config->item('thousands_separator')) ?></td>
			<td class="total_qty"><?=($row->bill_by == 'time') ? number_format($row->time_price,$this->config->item('decimal_places'),$this->config->item('decimal_separator'),$this->config->item('thousands_separator')) : number_format($row->packet_price,$this->config->item('decimal_places'),$this->config->item('decimal_separator'),$this->config->item('thousands_separator')) ?></td>
			<?php $i++ ?>
		</tr>
		<?php endforeach; ?>
		
		<tr>
			<td colspan="3" class="subtotal" align='right'><strong><?=$this->lang->line('subtotal')?> </strong></td>
			<td class="total"><strong><?=($account->bill_by == 'time') ? number_format($account->time_price,$this->config->item('decimal_places'),$this->config->item('decimal_separator'),$this->config->item('thousands_separator')) : number_format($account->packet_price,$this->config->item('decimal_places'),$this->config->item('decimal_separator'),$this->config->item('thousands_separator'))?></strong></td>
		</tr>
	</tbody>
	</table>
</body>
</html>
		
