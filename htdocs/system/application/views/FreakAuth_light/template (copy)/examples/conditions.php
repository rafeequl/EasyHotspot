Here is a list of links. People with different roles will see different links:
<ul>
    <li><?=anchor('', 'home')?></li>
    <?php if (isAdmin()) { ?>
        <li><?=anchor('admin', 'admin page')?></li>
    <?php } ?>
    <?php if (isValidUser()) { ?>
        <li><?=anchor($this->config->item('FAL_changePassword_uri'), 'change password')?></li>
    <?php } else { ?>
        <li><?=anchor($this->config->item('FAL_register_uri'), 'please register')?></li>
    <?php } ?>
</ul>
<br /><br />

<b>example code:</b>
<code>
&lt;ul&gt;<br />
    &lt;li&gt;&lt;?=anchor('', 'home')?&gt;&lt;/li&gt;<br />
    &lt;?php if (isAdmin()) { ?&gt;<br />
        &lt;li&gt;&lt;?=anchor('admin', 'admin page')?&gt;&lt;/li&gt;<br />
    &lt;?php } ?&gt;<br />
    &lt;?php if (isValidUser()) { ?&gt;<br />
        &lt;li&gt;&lt;?=anchor($this->config->item('FAL_changePassword_uri'), 'change password')?&gt;&lt;/li&gt;<br />
    &lt;?php } else { ?&gt;<br />
        &lt;li&gt;&lt;?=anchor($this->config->item('FAL_register_uri'), 'please register')?&gt;&lt;/li&gt;<br />
    &lt;?php } ?&gt;<br />
&lt;/ul&gt;<br />
</code>

<br /><br /><?=anchor('example', 'back to the list')?>
