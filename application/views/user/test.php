<html>
<head>
    <title>File Upload In Codeigniter</title>
</head>
<body>
<?php echo form_open_multipart('user/test/do_upload');?>
<?php echo "<input type='file' name='userfile' size='20' />"; ?>
<?php echo "<input type='submit' name='submit' value='upload' /> ";?>
<?php echo "</form>"?>
</body>
</html>
