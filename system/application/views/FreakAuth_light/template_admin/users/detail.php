<h2><?=$action?></h2>

<p>&nbsp;</p>

<!--USERPROFILE DATA-->

<!-- START DETAILS DATA-->
<div class="details">
<fieldset>
<legend>User profile details</legend>

<?php if ($this->config->item('FAL_create_user_profile') AND !empty($user_profile))
{?>
	<ul>
	<?php 
		foreach ($user_profile as $field=>$profile)
		{?>
			<li><?=$label[$field]?>: <?=$profile?></li>
		
		<?php 
		}?>
	</ul>
<?php 
}
elseif($this->config->item('FAL_create_user_profile') AND empty($user_profile)) 
{?>
	 <p class="error"><?=$this->lang->line('FAL_no_DB_data');?></p>
<?php 
} else {?><p class="error">userprofile disabled in config</p><?php }?>

</fieldset>
</div>

<!-- END USERPROFILE DATA-->

<?php if (isset($user))
{?>
	<table>
	  <tr>
	    <th scope="col">id</th>
	    <th scope="col">user name</th>
	    <th scope="col">e-mail</th>
	    <th scope="col">role</th>
	    <th scope="col">banned</th>
	    <?php 
	    if ($this->config->item('FAL_use_country') && isset($user['country']))
	    {?>
		    <th scope="col">country</th>
		    <?php 
	    }?>
        
        <?php
            if ($can_edit_user OR $can_delete_user)
            {?>
                <th scope="col">&nbsp;</th>
        <?php
            }?>
	  </tr>
	  <tr class="center">
	    <td><?=$user['id'];?></td>
	    <td><?=$user['user_name'];?></td>
	    <td><?=$user['email'];?></td>
	    <td ><?=$user['role'];?></td>
	    <td ><?=($user['banned']) ? "Y" :  "N";?></td>
	    <?php
            if ($this->config->item('FAL_use_country') && isset($user['country']))
            {?>
                <td><?=$user['country'];?></td>
        <?php
            }?>
            
        <?php if ($can_edit_user OR $can_delete_user):?>
                <td>
        <?php endif;?>
            <?php if ($can_edit_user):?>
                    <?=anchor('admin/'.$controller.'/edit/'.$user['id'], '<img src="'.base_url().$this->config->item('FAL_assets_admin').'/'.$this->config->item('FAL_images').'/pencil.png" alt="edit" title="edit">', array('title' => 'edit'));?>
            <?php endif;?>
            <?php if ($can_delete_user):?>
                    <?=anchor('admin/'.$controller.'/del/'.$user['id'], '<img src="'.base_url().$this->config->item('FAL_assets_admin').'/'.$this->config->item('FAL_images').'/cross.png" alt="delete" title="delete">', array('onCLick' => "return confirm('".$this->lang->line('FAL_confirm_delete')."')", 'title'=>'delete'));?>
            <?php endif;?>
        <?php if ($can_edit_user OR $can_delete_user):?>
                </td>
        <?php endif;?>
        </tr>
	</table>
<?php
}
else 
{
	echo $error_message;
}
?>
<?=form_open('admin/'.$controller)?>
<?=form_submit(array('class'=>'submit',
					 'name'=>'back', 
					 'id'=>'submit',
	                 'value'=>'Back'))?>

<?=form_close()?>