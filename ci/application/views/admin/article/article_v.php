<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* hint: I do many things!
* 	 q:	who am I?
* 	 a:	dump($active_user);
*		- shows user details
*
*/
$this->load->view('admin/tiny_mce/tiny');
$this->load->view('admin/headers/links_v');
?><h3><?php echo empty($article->id) ? 'Add a new article' : 'Edit article: ' . $article->title; ?></h3>
<h4>if you try to upload a big image all data will be lost!</h4>
<h4>to be safe: save article content as draft then choose edit in your content list to upload the main image</h4>
<?php 
echo validation_errors(); ?>
<?php echo form_open_multipart(); ?>
<table class="table">
	<tr>
		<td>Title</td>
		<td><?php echo form_input('title', set_value('title', $article->title)); ?></td>
	</tr>
	<tr>
		<td>Slug</td>
		<td><?php echo form_input('slug', set_value('slug', $article->slug)); ?></td>
	</tr>
	<tr>
		<td>Category</td>
		<td>
		<?php
		if (strlen($article->category) == 0) {
			$options = array(
			//'jibber-jabber' => 'never-publish',
			'history' => 'History',
			'gava_kilo_nusu' => 'Gava-kilo-nusu'
			);
		} else {
			$options = array(
				$article->category => $article->category
				);
		}
		echo form_dropdown('category',$options);
		?>
		</td>
	</tr>
	<tr>
		<td>Main image</td>
		<td>
		<div id="image_holder">
			<!-- write a script to change the image src when the user selects a new image -->
			<img width="500" src="<?php echo base_url().$article->main_image ?>">
			<div style='visibility:hidden' id='image-upload'>
			<input id="fileUpload" type="file" name="main_image" accept="image/*" /><br/>
			</div>
			<input type="button" onclick="show_img_dialog()" value="Change">
		</div>
		
		</td>
	</tr>
	<tr>
		<td>Body</td>
		<td>
		<textarea name="body" id="editor_txtarea"><?php echo $article->body; ?></textarea>
		</td>
	</tr>
	<tr>
		<td></td>
		<td><?php echo form_submit('draft', 'Save as draft', 'class="btn btn-primary"'); ?></td>
		<td><?php echo form_submit('publish', 'Publish', 'class="btn btn-primary"'); ?></td>
	</tr>
</table>
<?php echo form_close();?>

<script>
$(function() {
	$('.datepicker').datepicker({ format : 'yyyy-mm-dd' });
});
</script>