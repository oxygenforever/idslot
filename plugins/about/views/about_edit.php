<?php
$data = $this->form_validation->_field_data;
?>
<?php echo form_open_multipart('idslot/edit/about', array('id'=>'mainform')); ?>	    
  <div class="form <?php echo $this->system->is_required($data, 'about[title]'); ?>" title="<?php echo lang('About Title Description');?>">
    <label><?php echo lang('Title');?>:</label><input type="text" class="inp-form" name="about[title]" value="<?php echo $title; ?>"/>
  </div>	    
  <div class="form <?php echo $this->system->is_required($data, 'about_file'); ?>" title="<?php echo lang('About Image Description');?>">
    <label><?php echo lang('Image');?>:</label><input type="file" name="about_file" class="file_1"/>
  </div>
	  

<?php
$this->load->helper('url');
$username = $this->session->userdata('username');

$web = base_url();
$web = "{$web}views/idslot";
$web = "{$web}/files/about/thumb_{$uid}.png?" . rand(10, 99);

$dir = dirname($_SERVER['SCRIPT_FILENAME']);
$dir = "{$dir}/views/idslot/";
$dir = "{$dir}/files/about/thumb_{$uid}.png";

if(is_file($dir)) { ?>
<div class="form">
	<label><?php echo lang('Preview');?>:</label><img src="<?php echo $web; ?>"/><div class="desc"><small><a href="<?php echo base_url(); ?>index.php/idslot/remove_img/about" onclick="return confirm('<?php echo lang('Are you sure to remove this image?'); ?>');"><?php echo lang('remove');?></a></small></div>
</div>	    

<?php } ?>
<div class="form <?php echo $this->system->is_required($data, 'about[content]'); ?>" title="<?php echo lang('About Content Description');?>">
	<label><?php echo lang('About');?>:</label><textarea name="about[content]" cols="50" class="form-textarea editor"><?php echo $content; ?></textarea>
</div>	
<div class="form <?php echo $this->system->is_required($data, 'about[visible]'); ?>" title="<?php echo lang('Visible Description');?>">
  <label><?php echo lang('Visibility');?>:</label>
  <select name="about[visible]">
    <option value="1"<?php echo $visible==1?' selected':''; ?>><?php echo lang('Show'); ?></option>
    <option value="0"<?php echo $visible==0?' selected':''; ?>><?php echo lang('Hide'); ?></option>
  </select>
</div>
<div class="submit">
		<label></label><input type="submit" value="<?php echo lang('Submit');?>" class="form-submit" />
</div>
</form>
