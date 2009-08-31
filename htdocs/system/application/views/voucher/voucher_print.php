<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $i=1 ?>
<?php $voucher = $voucher->row(); ?>

<html>
<head>
</head>
<body>
<table width=220px>
	<tr><td align='center'>
	<?=$this->config->item('company_name')?><br />
	<?=$this->config->item('company_address_line1')?><br />
	<?=$this->config->item('company_address_line2')?><br />
	<?=$this->config->item('company_address_line3')?><br />
	<?=$this->config->item('company_phone')?><br />
	<?=$this->config->item('company_tax_code')?>
	<hr />
	</td></tr>
	<tr>
		<td>
			<table width=100%>
			<tr><td width=60%><?=$this->lang->line('username')?></td><td>: <?=$voucher->username?></td></tr>
			<tr><td><?=$this->lang->line('password')?></td><td>: <?=$voucher->password?></td></tr>	
			<tr><td><?=$this->lang->line('billing_plan')?></td><td>: <?=$voucher->billingplan?></td></tr>
			<tr><td><?=$this->lang->line('valid')?></td><td>: <?=$voucher->amount?> <?=($voucher->type == 'time') ? 'Minutes' : 'MB';?></td></tr>
			<tr><td><?=$this->lang->line('valid_until')?></td><td>: <?=preg_replace('/24:00:00/', '', $voucher->valid_until)?> </td></tr>
			<tr><td><?=$this->lang->line('price')?></td><td>: <?=$this->config->item('currency_symbol_pdf')?><?=number_format($voucher->price,$this->config->item('decimal_places'),$this->config->item('decimal_separator'),$this->config->item('thousands_separator'))?></td></tr>
			</table>
		</td>
	</tr>
	<tr>
		<td ><hr /><?=$this->config->item('access_instructions')?></td>
	</tr>
	<tr>
		<td align='center'><hr /><?=unix_to_human(time())?></td>
	</tr>
	<tr>
		<td align='center'><?=$this->lang->line('thanks')?></td>
	</tr>
</table>
</body>
</html>
		
