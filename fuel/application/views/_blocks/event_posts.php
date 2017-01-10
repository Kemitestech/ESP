<div class="row">
<?=fuel_edit('create', 'Create event', 'events')?>
  <div class="col-md-10">

<?php $upcoming_event_id = null;  ?>
<?php if(!empty($upcoming_event)) :?>
<?php   foreach($upcoming_event as $event) ?>
<?php     $upcoming_event_id = $event->id; ?>
          <div class="row">
            <div class="event">
              <div class="col-md-4">
                <a href="<?=$event->url?>" class="thumbnail thumbnail-override">
                  <?php if($event->has_list_image()): ?>
                         <img src="<?=$event->list_image_path?>" class="img-responsive" alt="Image">
                  <?php else: ?>
                         <img src="<?=img_path('place_holders/ESP Placeholder.svg', null, null)?>" class="img-responsive" alt="Image">
                  <?php endif; ?>
                </a>
              </div>
              <div class="col-md-6">
                <h2 class="thumbnail-title"><a href="<?=$event->url?>"><?=$event->title?></a></h2>
                <p class="thumnail-p"><strong><?=date_formatter($event->event_startdate, 'F jS Y')?><?=' at '.date_formatter($event->event_startdate, 'H:i')?></strong></p>
                <p class="thumnail-p">HOSTED BY <strong class="thumnail-by-name"><?=strtoupper($event->host->name)?></strong></p>
                <p><a class="btn btn-news" href="<?=$event->url?>" role="button">View Event</a></p>
                <div class="post-meta">
                  <?php if(!empty($event->tags_linked)) : ?>
                  <span class="glyphicon glyphicon-tags"></span><?=$event->tags_linked?>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
          <hr>
<?php endif; ?>

<?php if(!empty($events)) : ?>

<?php   foreach($events as $event) : ?>
  <?php   if ($upcoming_event_id && $event->id == $upcoming_event_id) :
              continue;
          endif;
  ?>
  <div class="row">
    <div class="event">
      <div class="col-md-3">
        <a href="<?=$event->url?>" class="thumbnail thumbnail-override">
          <?php if($event->has_list_image()): ?>
                 <img src="<?=$event->list_image_path?>" class="img-responsive" alt="Image">
          <?php else: ?>
                 <img src="<?=img_path('place_holders/ESP Placeholder.svg', null, null)?>" class="img-responsive" alt="Image">
          <?php endif; ?>
        </a>
      </div>
      <div class="col-md-6">
        <h2 class="thumbnail-title"><a href="<?=$event->url?>"><?=$event->title?></a></h2>
        <p class="thumnail-p"><strong><?=date_formatter($event->event_startdate, 'F jS Y')?><?=' at '.date_formatter($event->event_startdate, 'H:i')?></strong></p>
        <p class="thumnail-p">HOSTED BY <strong class="thumnail-by-name"><?=strtoupper($event->host->name)?></strong></p>
        <p><a class="btn btn-news" href="<?=$event->url?>" role="button">View Event</a></p>
        <div class="post-meta">
          <?php if(!empty($event->tags_linked)) : ?>
          <span class="glyphicon glyphicon-tags"></span><?=$event->tags_linked?>
        <?php   endif; ?>
        </div>
      </div>
    </div>
  </div>
  <hr>
<?php   endforeach; ?>
  <div class="view_archives">
      <nav>
      <?php if (!empty($pagination)) : ?><?=$pagination?>  &nbsp;<?php endif; ?>
      </nav>
  </div>
<?php else : ?>
  <div class="no_events">
    <p>There are no events available.</p>
  </div>
<?php endif; ?>
