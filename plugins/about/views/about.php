<div id="about" class="panel">
	<span class="ptitle block"><?php print($title); ?></span>
	<span class="content block">
          <?php if(file_exists("views/idslot/files/about/$uid.png")){ ?>
          <a title="<?php print($title); ?>" href="views/idslot/files/about/<?php echo $uid;?>.png" class="photo"><img alt="<?php print($title); ?>" src="views/idslot/files/about/thumb_<?php echo $uid;?>.png" style="float: left; margin: 7px;" /></a>
        <?php } print($content); ?></span>
</div>