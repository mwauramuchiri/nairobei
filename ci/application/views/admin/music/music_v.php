<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
$this->load->view('admin/headers/main_h_v');
$this->load->view('admin/headers/links_v');
$this->load->view('admin/music/template/song_v');
$this->load->view('admin/music/template/music_site_v');
echo "<body>";
music_admin($music,$sites,$list);
echo "</body>";
?>
<script type="text/javascript">
	var lim_music_sites = 5;
	var lim_latest_music = 3;
	var lim_music_picks = 5;
	$('input.music-sites').on('change',function (e) {
		if ($(this).siblings(':checked').length >= lim_music_sites) {
			this.checked = false;
		}
	});
	$('input.latest-music').on('change',function (e) {
		if ($(this).siblings(':checked').length >= lim_latest_music) {
			this.checked = false;
		}
	});
	$('input.music-picks').on('change',function (e) {
		if ($(this).siblings(':checked').length >= lim_music_picks) {
			this.checked = false;
		}
	});

	





</script>