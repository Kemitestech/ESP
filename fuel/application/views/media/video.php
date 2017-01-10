<div class="jumbotron contact-background reset-jumb-pos">
  <div class="container">
<?php if($video_data): ?>
        <?php fuel_set_var('page_title', $video_data->name);?>
        <?php fuel_set_var('open_graph_title', $video_data->name);?>
        <?php fuel_set_var('open_graph_description', $video_data->description);?>
        <?php fuel_set_var('open_graph_image', $video_data->thumbnail->url);?>
        <div class="row"><!--Start of row-->
          <script charset="ISO-8859-1" src="//fast.wistia.com/assets/external/E-v1.js" async></script>

          <div class="col-lg-7 col-md-12">
            <div class="wistia_responsive_padding" style="padding:56.25% 0 0 0;position:relative;">
              <div class="wistia_responsive_wrapper" style="height:100%;left:0;position:absolute;top:0;width:100%;">
                <span class="wistia_embed wistia_async_<?=$video_data->hashed_id?> popover=true popoverAnimateThumbnail=true popoverPreventScroll=true videoFoam=true" style="display:inline-block;height:100%;width:100%">&nbsp;</span>
              </div>
            </div>
          </div>
          <div class="col-lg-5 col-md-12">
            <h2><?=$video_data->name?></h2>
            <hr>
            <p><?=$video_data->description?></p>
          </div>

        </div><!-- End of row-->
<?php else:  ?>
        <h1>No data available!</h1>
<?php endif;  ?>
  </div>
</div>
