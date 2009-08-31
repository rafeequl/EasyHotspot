You are <b><?=getUserName()?></b> (role:<b><?=getUserProperty('role')?></b>),
your id is <b><?=getUserProperty('id')?></b>.<br />

Your first superadmin is <b><?=getUserPropertyFromId(1,'user_name')?></b>.
<br /><br />

<b>example code:</b>
<code>
You are &lt;b&gt;&lt;?=getUserName()?&gt;&lt;/b&gt; (role:&lt;b&gt;&lt;?=getUserProperty('role')?&gt;&lt;/b&gt;),
your id is &lt;b&gt;&lt;?=getUserProperty('id')?&gt;&lt;/b&gt;.&lt;br /&gt;<br />
<br />
Your first superadmin is &lt;b&gt;&lt;?=getUserPropertyFromId(1,'user_name')?&gt;&lt;/b&gt;.<br />
</code>
<br /><br /><?=anchor('example', 'back to the list')?>
