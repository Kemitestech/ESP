<div class="jumbotron contact-background reset-jumb-pos">
  <div class="container">
    <h1 class="header-title title-margin">Videos</h1>
<?php if($video_data):
      $item_count = 0;
      $nth_sequence = array();
      $max_count = count($video_data);
      //loops through value of video_data key in the var array within the media controller that has the JSON response returned from the getMediaList();
      ?>
      <?php foreach($video_data as $video):?>
      <?php
        //Upon each loop $nextTerm will increase by $item_count *3 + 1
        $nextTerm = ($item_count*3) + 1;
        //Upon each loop $item_count + 1
        $item_count = $item_count + 1;
        //pushes the nexTerm to the end of the sequence
        array_push($nth_sequence, $nextTerm);
        //Access URL for each video
        $url = $video->thumbnail->url;
        //split url string based on equal character within URL.
        $splitURL = explode("=",$url);//explode() will return an array with split URL in different elements.  URL that is returned cantains question mark which denotes query parameters
        $dimensions = "400x250";//Dimensions the thumbnail
        $newURL = $splitURL[0]."=".$dimensions."&image_play_button=true&image_play_button_color=00a1c6"; //Appending 1st index dimensions, query parameters from the URL?>

      <?php if(in_array($item_count, $nth_sequence)): //add a <div class="row"> for every sequence.  Needle in an hay stack?>
          <div class="row"><!-- Start of row-->
      <?php endif;  ?>
            <div class="col-md-4">
              <div class="thumbnail thumbnail-override">
                <a title="<?=$video->name?>" href="<?=base_url('media/videos/watch/'.$video->hashed_id)?>"><img src="<?=$newURL?>"/></a>
               <div class="caption" style="padding:0px;margin-top:10px;">
                 <a title="<?=$video->name?>" href="<?=base_url('media/watch/'.$video->hashed_id)?>"><p style="margin:0px 0px 5px 0px;"><small><?=word_limiter($video->name, 11, '&#8230;');?></small></p></a>
                 <div>
                   <?=$video->section?>
                   <span class="sep" style="padding: 0px 5px;">|</span>
                   <?=date_formatter($video->created, 'M d, Y')?>
                 </div>
               </div>
              </div>
            </div>
      <?php if($item_count%3 == 0 || $item_count == $max_count): // for every 3rd item or the last item we add a </div>?>
          </div><!-- End of row-->
      <?php endif;  ?>
<?php   endforeach;  ?>

<?php else:  ?>
        <h4>We currently have no videos to show. In the mean time enjoy the rest of the site and check back later!</h4>
<?php endif;  ?>
  </div>
</div>
