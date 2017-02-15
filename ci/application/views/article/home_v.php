<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Nairobei</title>
</head>
<body background="<?php echo base_url().$back_image ?>">

<?php
            /*
            *     $latest_history is an object containg the following fields
            *
            *        object(stdClass)[24]
            *          public 'id' => string 
            *          public 'title' => string 
            *          public 'body' => string 
            *          public 'slug' => string 
            *          public 'category' => string 
            *          public 'main_image' => string 
            *          public 'author' => 
            *            array (size=5)
            *              'username' => string 
            *              'email' => string 
            *              'first_name' => string 
            *              'last_name' => string 
            *              'photo' => string 
            *          public 'type' => string 
            *          public 'created' => string 
            *          public 'modified' => string 
            *
            */
            
            if (isset($my_likes)) {
                //a list of all articles the ip address likes
                /**
                *
                * use this to default the like button to either liked if the article id is in this list
                * or not liked if it is not
                *
                */
                echo "articles the user ip address has liked";
                dump($my_likes);
            }

            if (isset($top_music_sites)) {
                echo "a list 5 of top_music_sites";
                dump($top_music_sites);
            }

            if (isset($latest_music)) {
                echo "a list 3 of latest_music";
                dump($latest_music);
            }

            if (isset($music_picks)) {
                echo "a list 5 of music_picks";
                dump($music_picks);
            }

            if (isset($latest_history)) {
              // result limited to 1 latest article
                echo "The latest article in history category";
            	dump($latest_history);
            }

            if (isset($gava_ad)) {
                echo "government advert";
                foreach ($gava_ad as $ad) {
                    dump($ad);
                }
            }
            if (isset($latest_gava_kilo_nusu)) {
              // result limited to five latest articles 
                echo "a list of at most 5 articles in gava_kilo_nusu category";
              foreach ($latest_gava_kilo_nusu as $gava) {
                dump($gava);
              }
            }


 ?>
</body>
</html>