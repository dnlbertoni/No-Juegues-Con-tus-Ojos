<h1>Subir Excel</h1>
<?php echo $error;?>
<?php echo form_open_multipart('admin/escuelas/fromExcel');?>
<input type="file" name="userfile" size="20" />
<br />
<br />
<input type="submit" name ="enviado" value="upload" />
<?php echo form_close()?>