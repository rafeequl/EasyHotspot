<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?=$heading.' &raquo; '.$this->config->item('FAL_website_name')?></title>
<link href="<?=base_url().$this->config->item('FAL_assets_front').'/'.$this->config->item('FAL_css');?>/fal_style.css" rel="stylesheet" type="text/css" />
<script src="<?=base_url().$this->config->item('FAL_assets_shared').'/'.$this->config->item('FAL_js');?>/jquery.js" type="text/javascript"></script>
<script src="<?=base_url().$this->config->item('FAL_assets_shared').'/'.$this->config->item('FAL_js');?>/flash.js" type="text/javascript"></script>
</head>
<body>
<div id="wrapper">
    <div id="header">
    	<h1>FreakAuth_light&reg;</h1>
    	<?=$this->load->view($this->config->item('FAL_template_dir').'template/menu');?>  
	</div>