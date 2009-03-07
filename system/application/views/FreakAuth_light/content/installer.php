
<ul>
<li><b>DB tables: </b><?=$installer['tables']?>
	<ul>
	<?php foreach ($installer['missing_tb'] as $key=>$tb)
	{?>
	
		<li>table <?=$key?>: <?=$tb?></li>
		<?php } ?>
	</ul>
</li> 
<hr/><li><b>DB_session ON?</b><?=$installer['DB_session']?></li>
	<hr/><li><b>Freakauth_light ON?</b><?=$installer['system_on']?></li>
<hr/><li><b>encryption_key: </b><?=$installer['enc_key']?> </li>
<hr/><li><b>website name: </b> <?=$installer['w_name']?></li>
<hr/><li><b>website contact: </b> <?=$installer['email']?></li>
<hr/><li><b>superadmin: </b> <?php if ($ins_superadmin==FALSE)
{?> <?=$superadmin_msg?><?php }?></li>
<?php if ($superadmin==FALSE AND $ins_superadmin==TRUE)
{?><p><?=$superadmin_msg?></p>
<?=form_open('installer')?>
  <table width="400" border="0">
    <tr>
      <td>admin name</td>
      <td>
       <?=form_hidden('id', 0);?>
       <?=form_input(array('name'=>'user_name', 
	                       'id'=>'user_name',
	                       'maxlength'=>'45', 
	                       'size'=>'35',
	                       'value'=>(isset($this->fal_validation) ? $this->fal_validation->{'user_name'} : '')))?>
	  <span><?=(isset($this->fal_validation) ? $this->fal_validation->{'user_name'.'_error'} : '')?></span>
	  </td>
    </tr>
    <tr>
      <td>e-mail</td>
      <td>
      <?=form_input(array('name'=>'email', 
	                       'id'=>'email',
	                       'maxlength'=>'120', 
	                       'size'=>'35',
	                       'value'=>(isset($this->fal_validation) ? $this->fal_validation->{'email'} : '')))?>
    	<span><?=(isset($this->fal_validation) ? $this->fal_validation->{'email'.'_error'} : '')?></span>
      </td>
    </tr>
    <tr>
      <td>password</td>
      <td>
      <?=form_password(array('name'=>'password', 
	                       'id'=>'password',
	                       'maxlength'=>'16', 
	                       'size'=>'16',
	                       'value'=>(isset($this->fal_validation) ? $this->fal_validation->{'password'} : '')))?>
    	<span><?=(isset($this->fal_validation) ? $this->fal_validation->{'password'.'_error'} : '')?></span>
      </td>
    </tr>
    <tr>
      <td>retype password</td>
      <td>
      <?=form_password(array('name'=>'password_confirm', 
	                       'id'=>'password_confirm',
	                       'maxlength'=>'16', 
	                       'size'=>'16',
	                       'value'=>(isset($this->fal_validation) ? $this->fal_validation->{'password_confirm'} : '')))?>
    <span><?=(isset($this->fal_validation) ? $this->fal_validation->{'password_confirm'.'_error'} : '')?></span>
      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="Submit" value="Add" />
          <input type="reset" name="Reset" value="reset" /></td>
    </tr>
  </table>
</form>
<?php } ?>
</ul>
