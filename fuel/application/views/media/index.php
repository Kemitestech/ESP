<div class="jumbotron contact-background reset-jumb-pos">
  <div class="container">
<?php if($video_data): ?>
        <div class="row"><!--Start of row-->
          <script charset="ISO-8859-1" src="//fast.wistia.com/assets/external/E-v1.js" async></script>
      <?php   foreach($video_data as $video):?>
          <div class="col-lg-7 col-md-12">
            <div class="wistia_responsive_padding" style="padding:56.25% 0 0 0;position:relative;">
              <div class="wistia_responsive_wrapper" style="height:100%;left:0;position:absolute;top:0;width:100%;">
                <span class="wistia_embed wistia_async_<?=$video->hashed_id?> popover=true popoverAnimateThumbnail=true videoFoam=true" style="display:inline-block;height:100%;width:100%">&nbsp;</span>
              </div>
            </div>
          </div>
          <div class="col-lg-5 col-md-12">
            <h2><?=$video->name?></h2>
            <hr>
            <?php
              $url = $video->thumbnail->url;
              $splitURL = explode("=",$url);
              $dimensions = "300x200";
              $newURL = $splitURL[0]."=".$dimensions."&image_play_button=true&image_play_button_color=00a1c6";
            ?>
            <a href="<?=base_url('media/watch/'.$video->hashed_id)?>"><img src="<?=$newURL?>" /></a>
          </div>
<?php   endforeach;  ?>
        </div><!-- End of row-->
<?php else:  ?>
        <h1>No data available!</h1>
<?php endif;  ?>
  </div>
</div>
