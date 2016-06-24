<?php
$slug = uri_segment(2);

if ($slug) :

  $event = fuel_model('events', array('find' => 'one', 'where' => array('slug' => $slug)));

  if (empty($event)) :
    redirect_404();
  endif;

else:

  $tags = fuel_model('tags');
	$events = fuel_model('events', array('find' => 'upcoming', 'where' => array('slug' => $slug)));
endif;

if (!empty($event)) : ?>
<div class="container">
  <h1><?=fuel_edit($event)?><?=$event->title?></h1>
  <div class="author"><?=$event->host->name?></div>
  <img src="<?=$event->main_image_path?>" alt="<?=$event->title_entities?>" class="img_right" />
  <event><?=$event->description_formatted?></event>
</div>

<?php else: ?>
<div class="container">
  <h1>Upcoming and Latest Events</h1>
	<div class="row">


  <?=fuel_edit('create', 'Create event', 'events')?>
		<div class="col-md-10">


  <?php foreach($events as $event) : ?>
		<div class="row">
			<div class="event">
				<div class="col-md-3">
					<a href="<?=$event->url?>" class="thumbnail thumbnail-override">
						<img src="https://placeimg.com/225/200/arch" class="img-responsive" alt="Image" style="width: 100%;" alt="nature">
					</a>
				</div>
				<div class="col-md-6">
					<h2><?=$event->title?></h2>
					<p><strong><?=strtoupper(date_formatter($event->event_date, 'M d, Y'))?><?=' AT '.date_formatter($event->event_starttime, 'H:i')?></strong></p>
					<p>HOSTED BY <strong><?=strtoupper($event->host->name)?></strong></p>
					<a href="<?=$event->url?>"><button type="submit" class="btn btn-info no-radius">View Event Details</button></a>
				</div>
			</div>
		</div>
		<hr>
  <?php endforeach; ?>

		</div>
	</div>
</div>
<?php endif; ?>
