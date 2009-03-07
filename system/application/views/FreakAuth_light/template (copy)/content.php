	<div id="browse_crag">
		<div class="login">
			<?=loginAnchor();?>
		</div>
	</div>

<div id="mainContent">
<!--STAR FLASH MESSAGE-->
<?php 
$flash=$this->db_session->flashdata('flashMessage');
if (isset($flash) AND $flash!='')
{?>
	<div id="flashMessage" style="display:none;">
		<?=$flash?>
	</div>
<?php }?>
<!--END FLASH-->
<?php 
if (isset($message) AND $message!='')
{
	echo $message;
}?>
<!--INSTALLER-->
<?php if (isset($installer) AND $installer!='')
{
	echo $installer;
}?>
<!--END INSTALLER-->
<!--START INCLUDED CONTENT-->
<?= isset($fal) ? $fal : null;?>
<?php isset($page) ? $this->load->view($page) : null;?>
<!--END INCLUDED CONTENT-->