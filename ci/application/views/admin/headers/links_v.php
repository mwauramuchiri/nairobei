<?php defined('BASEPATH') OR exit('No direct script access allowed');
?>
<ul>
	<li><a href="<?php echo site_url('admin'); ?>">Home</a></li>
	<li><a href="<?php echo site_url('admin/user'); ?>">Profile</a></li>
<?php
switch ($active_user['group']) {
	case 3:
		# super...
	?>
	<li><a href="<?php echo site_url('admin/music'); ?>">Music</a></li>
	<li><a href="<?php echo site_url('admin/article/edit'); ?>">Create Article</a></li>
	<?php
		break;
	case 4:
		# histo...
	?>
	<li><a href="<?php echo site_url('admin/article/edit'); ?>">Create Article</a></li>
	<?php
		break;
	case 5:
		# gava...
	?>
	<li><a href="<?php echo site_url('admin/article/edit'); ?>">Create Article</a></li>
	<?php
		break;
	case 6:
		# music...
	?>
	<li><a href="<?php echo site_url('admin/music'); ?>">Music</a></li>
	<?php
		break;
}
?>
</ul>