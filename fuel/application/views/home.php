<?php fuel_set_var('layout', ''); ?>
<?php // declaring $page_title variable for the Home Page using fuel_set_var ?>
<?php fuel_set_var('page_title', 'Welcome | CCC Edward Street Parish Church'); ?>
<?php $this->load->view('_blocks/header'); ?>
<div id ="home-hero" class="slider1 jumbotron jumbo-slider-override hero-hover">
  <div style="background: url('https://placeimg.com/1000/400/tech') no-repeat center center; background-size: cover; height: 350px;">
    <div style="padding: 30px; color: white;">
      <h1>EDWARD YOUTH MINISTRY</h1>
      <h2>WE ARE A "CHOSEN GENERATION"</h2>
      <a class="btn btn-lg hero-button" href="youth.html" role="button">FIND OUT MORE</a>
    </div>
  </div>
  <div style="background: url('https://placeimg.com/1000/400/arch') no-repeat center center; background-size: cover; height: 350px;">
  </div>
</div>
<div class="jumbotron contact-background reset-jumb-pos">
  <div class="container">
    <h1 class="header-title" style="text-align: center;">Edward Street Parish <br><small>Who we are</small></h1>
    <div class="row">
      <div class="col-md-6">
        <p>Celestial Church of Christ is a spiritual, world-wide, united, indivisible Holy Church which came into the world from heaven by DIVINE ORDER on the 29th of September 1947 in Porto Novo, Republic of Benin through the founder of the Church, the Reverend, Pastor, Prophet, Founder Samuel Bilehou Joseph Oshoffa (1909 - 1985).</p>
      </div>
      <div class="col-md-6">
        <p>
          The Church is well known with Parishes, Dioceses all over the world with its International Headquarters in Nigeria.  See Celestial History for Brief History of the Church.
          The Church is well known with Parishes, Dioceses all over the world with its International Headquarters in Nigeria.  See Celestial History for Brief History of the Church.
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
    <div class="col-md-13 col-md-offset-1">
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
                    <img src="<?=$post->list_image_path?>" class="img-responsive" alt="Image">
             <?php else: ?>
                    <img src="<?=img_path('place_holders/ESP Placeholder.svg', null, null)?>" class="img-responsive" alt="Image">
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
               <img src="https://placeimg.com/225/200/arch" class="img-responsive" alt="Image" style="width: 100%;">
               <div class="caption">
                <h3 class="header-title"><?=$event->title?></h3>
                <p>Hosted by <strong class="thumnail-by-name"><?=strtoupper($event->host->name)?></strong></p>
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
