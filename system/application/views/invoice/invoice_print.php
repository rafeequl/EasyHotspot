<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<html>
<head>
</head>
<body>
    <?php $i=1 ?>
    <?php $invoice=$invoice->row(); ?>
<table width=100%>
	<tr>
		<td align='left' width=50%>
			<table>
			<tr><td width=60%><?=$this->lang->line('date')?></td><td><?=date("M d Y")?></td></tr>
			<tr><td width=60%><?=$this->lang->line('to')?></td><td><?=$invoice->realname;?></td></tr>
			<tr><td><?=$this->lang->line('username')?></td><td><?=$invoice->username?></td></tr>	
			<tr><td><?=$this->lang->line('bill_by')?></td><td><?=$invoice->bill_by?></td></tr>
			</table>
		</td>
		<td align='right' width=50%>
			<table width=100%>
			<tr><td align="right"><?=$this->config->item('company_name')?></td></tr>
			<tr><td align="right"><?=$this->config->item('company_address_line1')?></td></tr>
			<tr><td align="right"><?=$this->config->item('company_address_line2')?></td></tr>
			<tr><td align="right"><?=$this->config->item('company_address_line3')?></td></tr>
			<tr><td align="right"><?=$this->config->item('company_phone')?></td></tr>
			<tr><td align="right"><?=$this->config->item('company_tax_code')?></td></tr>
			</table>
		</td>
	</tr>
</table>
<p>
<table width=100%>
		<tr>
			<td><?=$this->lang->line('no')?></td>
			<td><?=$this->lang->line('access_start')?></td>
			<td><?=$this->lang->line('access_stop')?></td>
			<td><?=$this->lang->line('duration_amount')?></td>
			<td><?=$this->lang->line('total')?></td>
		</tr>
		
		<?php foreach($invoice_detail->result() as $row): ?>
		<tr>
			<td><?=$i?></td>
			<td align="center"><?=$row->start?></td>
			<td align="center"><?=$row->stop?></td>
			<td align="center"><?=$row->used ?></td>
			<td align="right" class="total_qty"><?=number_format($row->total,$this->config->item('decimal_places'),$this->config->item('decimal_separator'),$this->config->item('thousands_separator'))?></td>
			<?php $i++ ?>
		</tr>
		<?php endforeach; ?>
		
		<tr>
			<td colspan="4" class="subtotal" align="right">Subtotal</td>
			<td class="total" align="right"><?=$this->config->item('currency_symbol_pdf')?><?=number_format($invoice->current_total,$this->config->item('decimal_places'),$this->config->item('decimal_separator'),$this->config->item('thousands_separator'))?></td>
		</tr>
</table>
</body>
</html>
		
