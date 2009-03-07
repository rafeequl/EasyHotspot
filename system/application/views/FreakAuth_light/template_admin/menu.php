<?php $ci_uri = trim($this->uri->uri_string(), '/'); $att = ' id="active"';?>
    <div id="navlist">
		<ul id="navlist">
			<li<?= (preg_match('|^admin$|', $ci_uri) > 0)? $att: ''?>><?=anchor('admin/', 'home')?></li>	
			<li<?= (preg_match('|^admin/admins|', $ci_uri) > 0)? $att: ''?>><?=anchor('admin/admins', 'administrators')?></li>
			<li<?= (preg_match('|^admin/users|', $ci_uri) > 0)? $att: ''?>><?=anchor('admin/users', 'users')?></li>
			<li<?= (preg_match('|^admin/example|', $ci_uri) > 0)? $att: ''?>><?=anchor('admin/example', 'example')?></li>
		</ul>
</div>
