<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php $this->load->view('admin/headers/site_h_v') ?>
<style type="text/css">
	.col-left{
		float: left;
		width: 20%;
	}
	.col-right{
		float: right;
		width: 80%;
	}
</style>
<script type="text/javascript">
	function some_function() {
		alert();
	}
//	$('input.adverts[]').on('change',function (e) {
//		$('input.adverts[]').not(this).prop('checked',false);
//	});
</script>
<div class="col-left">
<input type="button" onclick="show_img_dialog()" value="Upload a new Image">
		<?php //gava_add() 
		some_function($all_background, $curr_background);
		?>	
</div>
<div class="col-right">
	<?php
	echo form_open('admin/site/gava_ad');
	foreach ($gava_ads as $advert) {
		/*dump($advert);*/
		if ((int)$advert->active == 1) {
			// text link
			echo form_radio('advertise', $advert->id, TRUE).' '.$advert->text.' '.$advert->link.' <a href="'.site_url('admin/site/gava_ad/'.$advert->id).'">Edit</a><br>';
		} else {
			echo form_radio('advertise', $advert->id, FALSE).' '.$advert->text.' '.$advert->link.' <a href="'.site_url('admin/site/gava_ad/'.$advert->id).'">Edit</a> <a href="'.site_url('admin/site/gava_ad/delete/'.$advert->id).'">Delete</a><br>';
		}
		//echo form_radio('advertise', $advert->id, FALSE).'<br>';
	}
	echo form_submit('mysubmit', 'Submit!');
	echo form_close();
	echo "<br><br><p><strong>Government advert goes here</strong></p>";
	if (strlen($advert_edit->image_link) > 0) {
		echo '<img src ="'.base_url().$advert_edit->image_link.'" width="150">';
	}
	$hide = null;
	if (isset($advert_edit->id)) {
		$hide['id'] = $advert_edit->id;
	}
	echo form_open_multipart('admin/site/gava_ad','',$hide);
		$d = array(
		'name' => 'text',
		'value' => $advert_edit->text,
		'required' => null
		);
	echo form_label('Short description', 'text');
	echo form_input($d).'<br>';
	$d = array(
		'name' => 'link',
		'value' => $advert_edit->link,
		'required' => null
		);

	echo form_label('Link to government site', 'link');
	echo form_input($d).'<br>';
	$d = array(
		'name' => 'image',
		'type' => 'file',
		'accept' => 'image/*',
		);
	echo form_input($d).'<br>';
	echo form_submit('mysubmit', 'Submit!');
	echo form_close();
	?>
</div>
</body>