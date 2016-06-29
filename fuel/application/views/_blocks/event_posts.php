<div class="row">
<?=fuel_edit('create', 'Create event', 'events')?>
  <div class="col-md-10">
<?php if(!empty($events)) : ?>

<?php   foreach($events as $event) : ?>
  <div class="row">
    <div class="event">
      <div class="col-md-3">
        <a href="<?=$event->url?>" class="thumbnail thumbnail-override">
          <img src="https://placeimg.com/225/200/arch" class="img-responsive" alt="Image" alt="nature">
        </a>
      </div>
      <div class="col-md-6">
        <h2 class="thumbnail-title"><a href="<?=$event->url?>"><?=$event->title?></a></h2>
        <p class="thumnail-p"><strong><?=date_formatter($event->event_startdate, 'F jS Y')?><?=' at '.date_formatter($event->event_startdate, 'H:i')?></strong></p>
        <p class="thumnail-p">HOSTED BY <strong class="thumnail-by-name"><?=strtoupper($event->host->name)?></strong></p>
        <a href="<?=$event->url?>"><button type="submit" class="btn btn-info no-radius">View Event Details</button></a>
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
