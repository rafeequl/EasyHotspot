<html>
    <head>
    </head>
    <body>
        <h1 style="text-align:center;">ACCESS DENIED</h1>
    <?php
        if ($role == '') echo $this->lang->line('FAL_no_credentials_guest');
        else echo $this->lang->line('FAL_no_credentials_user');
    ?>
    <br />
    <?=anchor('', 'back')?>
    </body>
</html>
