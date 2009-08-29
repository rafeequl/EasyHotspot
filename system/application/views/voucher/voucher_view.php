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
		<th><?=$this->lang->line('username')?></th>
		<th><?=$this->lang->line('password')?></th>
		<th><?=$this->lang->line('billing_plan')?></th>
		<th><?=$this->lang->line('valid_until')?></th>
		<th><?=$this->lang->line('time_used')?></th>
		<th><?=$this->lang->line('time_remain')?></th>
		<th><?=$this->lang->line('packet_used')?></th>
		<th><?=$this->lang->line('packet_remain')?></th>
		<th><?=$this->lang->line('printed')?></th>
		<th colspan='3'></th>
	</tr>
	
	<?php foreach ($vouchers->result() as $row): ?>
	<tr>
		<td><?=$row->username;?></td>
		<td><?=$row->password;?></td>
		<td><?=$row->billingplan;?></td>
		<td><?=preg_replace('/24:00:00/', '', $row->valid_until);?></td>
		<td><?=($row->time_used == '' || $row->time_used == 'null') ? '---' : intval($row->time_used) ;?></td>
		<td><?=($row->time_remain == '' || $row->time_remain == 'null') ? '---' : intval($row->time_remain) ;?></td>
		<td><?=($row->packet_used == '' || $row->packet_used == 'null') ? '---' : intval($row->packet_used) ;?></td>
		<td><?=($row->packet_remain == '' || $row->packet_remain == 'null') ? '---' : intval($row->packet_remain) ;?></td>
		<td><?= ($row->isprinted == false ) ? 'no' : 'yes';?></td>
		<td><?=anchor('voucher/delete/'.$row->username,'del','class="delete" onClick="return confirm(\''.$this->lang->line('delete').' User'.' '.$row->username.'?\')"')?></td>
		<td><?=anchor('voucher/edit/'.$row->username,'edit','class="edit" ')?></td>
		<td><?=anchor('voucher/print_voucher/'.$row->username,'print','class="print" ')?></td>
	</tr>
	<?php endforeach;?>
</tbody>
</table>
<?=$this->pagination->create_links();?>
<?=$this->validation->error_string;?>
<?=form_open('voucher')?>
<ul>
	<li>
		<label><?=$this->lang->line('number_of_voucher')?></label>
		<?=form_input(array('name'=>'numberofvoucher','maxlength'=>'4','size'=>'4'))?>
	</li>
<li>&nbsp;</li>
	<li>
		<label><?=$this->lang->line('billing_plan')?></label>
		<select name="billingplan">
		<?php foreach($billingplans->result_array() as $option):?>
		<option value="<?=$option['name']?>"><?=$option['name']?></option>
		<?php endforeach;?>
		</select>
	</li>
</ul>
<?=form_hidden('created_by',$this->db_session->userdata('user_name'))?>
<input type="submit" value="Generate Voucher" class="submit"  />
<?=form_close()?>



<? $this->load->view('footer'); ?>
