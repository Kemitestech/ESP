<?php fuel_set_var('layout', ''); ?>
<?php // declaring $page_title variable for the Home Page using fuel_set_var ?>
<?php fuel_set_var('page_title', 'Welcome | CCC Edward Street Parish Church'); ?>
<?php $this->load->view('_blocks/header'); ?>
<?php $this->load->view('_blocks/home_banner'); ?>
<div class="jumbotron contact-background reset-jumb-pos">
  <div class="container">
    <h1 class="header-title" style="text-align: center;">Edward Street Parish <br><small>Who we are</small></h1>
    <div class="row">
      <div class="col-md-12">
        <p style="text-align: center">
          The celestial church of Christ, Edward Street Parish is a Christian religious and spiritual church, established in February 1990 and located at Edward Street Parish, New Cross, SE14 6DX.
          It is a registered charity under the charity’s Act of England and Wales 2011 and part of a worldwide church movement with branches all over the world, including America, North America, Europe, Asia and Africa.
        </p>
        <p style="text-align: center">
          The church itself was founded by Rev. Pastor Samuel Bilewu Oshoffa on the 29th day of September 1949 in the Republic of Benin after receiving a divine injunction.
        </p>
      </div>
    </div>
  </div>
</div>
<?php //$this->load->view('_blocks/paralax_testimonials')?>
<?=$this->load->view('_blocks/quotations')?>
<div id="home-news-container" class="container-fluid jumbotron">
  <!--start of container-->
  <div class="container ">
    <div class="page-header page-header-nounderline">
        <h1 class="header-title" style="text-align: center;">Posts and Events</h1>
    </div>
    <div class="col-md-12">
      <!-- Start of slider -->
      <div class="slider">
        <?php
          $posts = $this->fuel->blog->get_recent_posts($limit = 3, $where = null);

          $date = new DateTime();
          $events_date_range = $date->sub(new DateInterval('P5M'))->format('Y-m-d H:i:s') ?: $date->format('Y-m-d H:i:s');
          $events = fuel_model('events', array('limit' => 3, 'order' => 'event_startdate', 'where' => array('event_startdate >=' => $events_date_range)));

          if (!empty($posts)) :
            foreach($posts as $post): ?>
        <div>
          <div class="col-md-11">
            <div class="thumbnail thumbnail-override">
             <?php if($post->has_list_image()): ?>
                    <img src="<?=$post->list_image_path?>" class="img-responsive" alt="<?=$post->title?>">
             <?php else: ?>
                    <img src="<?=img_path('place_holders/events_ph@2x.png', null, null)?>" class="img-responsive" alt="logo">
             <?php endif; ?>
             <div class="caption">
              <h3><?=$post->title?></h3>
              <?=$post->get_excerpt_formatted(50, '')?>
              <p><a class="btn btn-news" href="<?=$post->url?>" role="button">Read More</a></p>
             </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
  <?php endif; ?>

  <?php if (!empty($events)) :
          foreach($events as $event) : ?>
          <div>
            <div class="col-md-11">
              <div class="thumbnail thumbnail-override">
                <?php if($event->has_list_image()): ?>
                       <img src="<?=$event->list_image_path?>" class="img-responsive" alt="Image">
                <?php else: ?>
                       <img src="<?=img_path('place_holders/events_ph@2x.png', null, null)?>" class="img-responsive" alt="Image of church logo">
                <?php endif; ?>
               <div class="caption">
                <h3><?=$event->title?></h3>
                <p>Hosted by <?=strtoupper($event->host->name)?></p>
                <p><a class="btn btn-news" href="<?=$event->url?>" role="button">View Event</a></p>
               </div>
              </div>
            </div>
          </div>
    <?php endforeach; ?>
  <?php endif;?>
      </div>
      <!-- end of slider -->
    </div>
    <!-- end of col-md -->
  </div>
  <!-- end of container -->

</div>

<?php $this->load->view('_blocks/newsletter_section')?>
<?php $this->load->view('_blocks/footer'); ?>
