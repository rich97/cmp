<p>
    You have been registered as a user on the <?php echo $this->Html->link($site, "http://{$host}"); ?> CMS.
</p>
<p>
    You can login <?php echo $this->Html->link('here', "http://{$host}/{$admin_url}/logins"); ?> using the following username and password:
</p>
<p>
    Username: <?php echo $username; ?><br>
    Password: <?php echo $password; ?>
</p>
Many thanks,<br>
<?php echo $site; ?>