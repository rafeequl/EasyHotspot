<?php $this->load->view('admin/header') ?>

<h1><?=$h1?></h1>


<table class="stripe">
<tbody>
	<tr>
		<th>id</th>
		<th>Name</th>
		<th>Type</th>
		<th>Amount</th>
		<th>Valid for</th>
		<th>Price</th>
		<th>DL rate</th>
		<th>Up rate</th>
		<th>Created by</th>
		<th></th>
	</tr>

<?php foreach ($query->result() as $row): ?>
	<tr>
		<td><?=$row->id?></td>
		<td><?=$row->name?></td>
		<td><?=$row->type?></td>
		<td><?=$row->amount?></td>
		<td><?=$row->valid_for?></td>
		<td><?=$this->config->item('currency_symbol')?><?=number_format($row->price,2)?></td>
		<td><?=$row->bw_download?></td>
		<td><?=$row->bw_upload?></td>
		<td><?=$row->created_by?></td>
		<td><?=anchor('admin/billingplan/delete/'.$row->id.'/'.$row->name,'del','class="delete" onClick="return confirm(\'Delete Billing Plan'.' '.$row->name.'? CAUTION IT WILL DELETE ALL '.$row->name.' VOUCHERS\')"')?></td>
	</tr>
<?php endforeach;?>
</tbody>
</table>

<?=$this->easyhotspot_validation->error_string;?>

<?=form_open('admin/billingplan')?>
<ul>
	
	<li><label>Name</label>
	<?= form_input('name')?> <acronym title="The name of billing plan">?</acronym></li>
	<li><label>Type</label>
	<?= form_dropdown('type',array('time'=>'Time Based','packet'=>'Packet Based'))?> <acronym title="Type of the hotspot billing">?</acronym></li>
	<li><label>Amount</label>
	<?= form_input(array('size'=>'5','name'=>'amount'))?><acronym title="Time : in Minutes, Packet : in MegaByte">?</acronym></li>
	<li><label>Valid for</label></li>
	<?= form_input(array('size'=>'5','name'=>'valid_for'))?><acronym title="Voucher's active time since voucher created for X days">?</acronym></li>
	<li><label>Price</label>
	<?= form_input(array('size'=>'5','name'=>'price'))?> <acronym title="The price of billing plan">?</acronym></li>
	<li><label>Download Rate</label>
	<?= form_dropdown('bw_download',array(''=>'default','16000' => '16 kbps','32000'=>'32 kbps','48000'=>'48 kbps','64000'=>'64 kbps', '96000' => '96 kbps', '128000' => '128 kbps',  '192000' => '192 kbps','256000'=>'256 kbps', '512000'=>'512 kbps','1024000'=>'1 MBps','2048000'=>'2 MBps'))?> <acronym title="The maximum of download rate">?</acronym></li>
	<li><label>Upload Rate</label>
	<?= form_dropdown('bw_upload',array(''=>'default','16000' => '16 kbps','32000'=>'32 kbps','48000'=>'48 kbps','64000'=>'64 kbps', '96000' => '96 kbps', '128000' => '128 kbps',  '192000' => '192 kbps','256000'=>'256 kbps', '512000'=>'512 kbps','1024000'=>'1 MBps','2048000'=>'2 MBps'))?> <acronym title="The maximum of upload rate">?</acronym></li>
	<li><label>Idle Timeout</label>
	<?= form_input(array('size'=>'5','name'=>'IdleTimeout'))?><acronym title="Disconnect user when there is no activity within the given minute">?</acronym></li>
</ul>
	<?=form_hidden('created_by',$this->db_session->userdata('user_name'))?>
<input type="submit" value="Add Billing Plan" class="submit"  />
<?=form_close()?>
<? $this->load->view('footer'); ?>
