<?php $this->load->view('header') ?>

<h1><?=$h1?></h1>

<div id='voucher_info'>
	<div id='graph'>
		<?=$this->graph->render()?>
	</div>
<h3><?=$this->lang->line('voucher_info')?></h3>
<ul>
	<li><label><?=$this->lang->line('voucher_created')?></label><?=$voucher['created']?></li>
	<li><label><?=$this->lang->line('used')?></label><?=$voucher['used']?></li>
	<li><label><?=$this->lang->line('expired')?></label><?=$voucher['expired']?></li>
</ul>
<h3><?=$this->lang->line('billing_plans')?></h3>
<ul>
	<?php foreach($billingplans->result() as $row):?>
	<li><label><?=$row->billingplan?></label><?=$row->qty?></li>
	<?php endforeach; ?>
</ul>
		
</div>


<div id='postpaid_info'>
<h3><?=$this->lang->line('postpaid_account_info')?></h3>
<ul>
	<li><label><?=$this->lang->line('account_created')?></label><?=$postpaid['created']?></li>
	<li><label><?=$this->lang->line('used')?></label><?=$postpaid['used']?></li>
</ul>
</div>


<? $this->load->view('footer'); ?>
