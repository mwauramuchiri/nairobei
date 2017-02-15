<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Dump helper. Functions to dump variables to the screen, in a nicley formatted manner.
 * @author Joost van Veen
 * @version 1.0
 */

if (!function_exists('dump')) {
    function dump ($var, $label = 'Dump', $echo = TRUE)
    {
        // Store dump in variable 
        ob_start();
        var_dump($var);
        $output = ob_get_clean();
        
        // Add formatting
        $output = preg_replace("/\]\=\>\n(\s+)/m", "] => ", $output);
        $output = '<pre style="background: #FFFEEF; color: #000; border: 1px dotted #000; padding: 10px; margin: 10px 0; text-align: left;">' . $label . ' => ' . $output . '</pre>';
        
        // Output
        if ($echo == TRUE) {
            echo $output;
        }
        else {
            return $output;
        }
    }
}


if (!function_exists('dump_exit')) {
    function dump_exit($var, $label = 'Dump', $echo = TRUE) {
        dump ($var, $label, $echo);
        exit;
    }
}

function objarr_to_arrarr($arr)
{
    $ret_val = array();
    $axx = count($arr);
    $bxx = 0;
    while ($bxx < $axx) {
        $ret_val[] = (array)$arr[$bxx];
        $bxx++;
    }
    return $ret_val;
}

function article_link($history){
    return 'article/' . intval($history->id) . '/' . e($history->slug);
}

function e($string){
    return htmlentities($string);
}

function some_other_function($history){

    $string = '';
    $url = article_link($history);
    $string .= '<div class="container group">';
    $string .= '<h1>' . anchor($url, e($history->title)) .  '</h1>';
    $string .= '<p>' . e($history->created) . '</p>';
    $string .= '<p><img src="'.base_url().$history->main_image.'" width="200"></p>';
    $string .= '<p>' . anchor($url, 'Read more ›', array('title' => e($history->title))) . '</p>';
    $string .= '</div>';
    return $string;
}

function edit_link($t,$id)
{
    if ($t == 'site') {
        return '<a href="'.site_url('admin/music/3').'/'.$id.'">Edit</a>';
    } elseif ($t == 'song') {
        return '<a href="'.site_url('admin/music/2').'/'.$id.'">Edit</a>';
    } else {
        return NULL;
    }
}

function delete_link($t,$id)
{
    if ($t == 'site') {
        return '<a href="'.site_url('admin/music/3').'/'.$id.'">Edit</a>';
    } elseif ($t == 'song') {
        return '<a href="'.site_url('admin/music/2').'/'.$id.'">Edit</a>';
    } else {
        return NULL;
    }
}
function music_admin($music,$sites,$list)
{
    echo form_open('admin/music/1');
   
    $i = 0;
    $j = count($list);
    while ($i < 3) {
        if (!count($list[$i])) {
            $list[$i] = array();
        }
        $i++;
    }
    $i = 0;
    
    while ($i < $j) {
        switch ($i) {
            case 0:
                // top music sites
                ?>
                <div class="music_sites">
                <p><strong>Top Music Sites: select 5</strong></p>
                <?php foreach ($sites as $item) { 
                    $item = (array)$item;
                    if (in_array($item['id'], $list[0])) { ?>
                    <input class="music-sites" type="checkbox" name="music_sites[]" value="<?php echo (int)$item['id']; ?>" checked><?php echo ' '.$item['name']; ?><br>
                    <?php } else { ?>
                   <input class="music-sites" type="checkbox" name="music_sites[]" value="<?php echo (int)$item['id']; ?>"><?php echo ' '.$item['name']; ?><br>
                <?php } } ?>
                </div>
                <?php
                break;
            case 1:
                // latest music
                ?>
                <div class="latest_music">
                <p><strong>Latest music: select 3</strong></p>
                <?php 
                foreach ($music as $item) {
                    $item = (array)$item;
                    //dump($item);
                    if (in_array($item['id'], $list[1])) { ?>
                    <input class="latest-music" type="checkbox" name="latest_music[]" value="<?php echo (int)$item['id']; ?>" checked><?php echo ' '.$item['title'].' - by - '.$item['artist'].' '.edit_link('song',$item['id']); ?><br>
                    <?php } else { ?>
                    <input class="latest-music" type="checkbox" name="latest_music[]" value="<?php echo (int)$item['id']; ?>"><?php echo ' '.$item['title'].' - by - '.$item['artist'].' '.edit_link('song',$item['id']); ?><br>
                    <?php }
                }
                ?>
                </div>
                <?php
                break;
            case 2:
                // music picks
                ?>
                <div class="music_picks">
                <p><strong>Music picks: select 5</strong></p>
                <?php
                foreach ($music as $item) {
                    $item = (array)$item;
                    if (in_array($item['id'], $list[2])) { ?>
                    <input class="music-picks" type="checkbox" name="music_picks[]" value="<?php echo (int)$item['id']; ?>" checked><?php echo ' '.$item['title'].' - by - '.$item['artist']; ?><br>
                    <?php } else { ?>
                    <input class="music-picks" type="checkbox" name="music_picks[]" value="<?php echo (int)$item['id']; ?>"><?php echo ' '.$item['title'].' - by - '.$item['artist']; ?><br>
                    <?php }
                }
                ?> 
                </div>
                <?php
                break;
        }
        $i++;
    }
    echo form_submit('mysubmit', 'Submit!');
    echo form_close();
}

function some_function($all_background, $curr_background)
{
   foreach ($all_background as $saved_image) {
    if ($saved_image['id'] == $curr_background['id']) {
        ?>
        <p>
        <a onclick="change_background(<?php echo (int)$saved_image['id'] ?>)">
        <img class="back_image" id="<?php echo (int)$saved_image['id'] ?>" width="200" src="<?php echo base_url().$saved_image['image_url'] ?>">
        </p>
        <br>
        <br>
        <?php

    } else {
        /**
        * TODO:
        *      include a delete link
        */
        ?>
        <p>
        <a onclick="change_background(<?php echo (int)$saved_image['id'] ?>)">
        <img class="back_image" id="<?php echo (int)$saved_image['id'] ?>" width="150" src="<?php echo base_url().$saved_image['image_url'] ?>"><a href="<?php echo site_url('admin/site/delete_img').'/'.(int)$saved_image['id']; ?>">delete</a><br/>
        <a onclick="">
        </p>
        <br>
        <br>
        <?php
    }
}
}

?>