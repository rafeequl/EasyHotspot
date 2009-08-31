<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $i=1 ?>
<?php $account=$account->row(); ?>
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
	<?=$this->config->item('company_tax_code')?><br />
	<hr />
	</td></tr>
	<tr>
		<td>
			<table width=100%>
			<tr><td width=40%><?=$this->lang->line('name')?></td><td>: <?=$account->realname;?></td></tr>
			<tr><td><?=$this->lang->line('username')?></td><td>: <?=$account->username?></td></tr>
			<tr><td><?=$this->lang->line('password')?></td><td>: <?=$account->password?></td></tr>	
			<tr><td><?=$this->lang->line('billing_type')?></td><td>: <?=$account->bill_by?></td></tr>
			</table>
		</td>
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
		
