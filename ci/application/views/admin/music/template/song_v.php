<div class="upload-song">
<p><strong>Enter the details of the song: </strong></p>
<?php echo form_open('admin/music/2');
echo form_hidden('id',  set_value('id', $song->id));

?>
<table>
	<tr>
		<td>Title</td>
		<td><?php
		$dl = array(
			'name' => 'title',
			'value' => $song->title,
			'required' => null
			);
		echo form_input($dl); 
		?></td>
	</tr>
	<tr>
		<td>Artiste</td>
		<td><?php
		$dl = array(
			'name' => 'artist',
			'value' => $song->artist,
			'required' => null
			);
		echo form_input($dl); 
		?></td>
	</tr>
	<tr>
		<td>Embed link</td>
		<td><textarea name="embed_link" id="embed_link" required=""><?php echo $song->embed_link; ?></textarea></td>
	</tr>
	<tr>
		<td>Buy link</td>
		<td><?php
		$dl = array(
			'name' => 'buy_link',
			'value' => $song->buy_link,
			'required' => null
			);
		echo form_input($dl); 
		?></td>
	</tr>
	<tr>
		<td>Coment</td>
		<td><?php
		$dl = array(
			'name' => 'coment',
			'value' => $song->coment,
			'required' => null
			);
		echo form_textarea($dl); 
		?></td>
	</tr>
</table>
<?php
echo form_submit('submit','Upload song details');
echo form_close();?>
</div>