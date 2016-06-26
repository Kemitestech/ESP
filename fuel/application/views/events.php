<?php
$slug = uri_segment(2);

if ($slug) :

  $event = fuel_model('events', array('find' => 'one', 'where' => array('slug' => $slug)));

  if (empty($event)) :
    redirect_404();
  endif;

else:
  $CI =& get_instance();
  $CI->load->library('pagination');
  $CI->load->model('events_model');
  $limit = 2;
  $offset = $CI->input->get('per_page');
  $total = $CI->events_model->record_count();

  $config['base_url'] = base_url('events');
  $config['total_rows'] = $total;
  $config['uri_segment'] = 2;
  $config['per_page'] = $limit;
  $config['page_query_string'] = TRUE;
  $config['display_pages'] = FALSE;
  $config['next_link'] = 'Next <span aria-hidden="true">&rarr;</span>';
  $config['prev_link'] = '<span aria-hidden="true">&larr;</span> Prev';
  $config['full_tag_open'] = '<ul class="pager">';
  $config['full_tag_close'] = '</ul>';
  $config['next_tag_open'] = '<li class="next">';
  $config['next_tag_close'] = '</li>';
  $config['prev_tag_open'] = '<li class="previous">';
  $config['prev_tag_close'] = '</li>';

  $CI->pagination->initialize($config);
  $pagination = $CI->pagination->create_links();
  $tags = fuel_model('tags');
	$events = fuel_model('events', array('limit' => $limit, 'offset' => $offset, 'order' => 'event_startdate', 'where' => array('event_startdate >=' => datetime_now())));

endif;

if (!empty($event)) : ?>
<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="event-details">
        <div class="event-detail">
          <img src="<?=$event->main_image_path?>" alt="<?=$event->title_entities?>" class="event-image" />
          <hr>
        </div>
        <div class="event-detail">
          <h1 class="event-title"><?=fuel_edit($event)?><?=$event->title?></h1>
        </div>
        <h3>Hosted By <?=$event->host->name?></h3>
        <div class="event-detail">
          <?=$event->description?>
          <p><strong>When</strong></p>
          <?php if ($event->event_enddate && $event->event_enddate != '0000-00-00 00:00:00') :?>
          <p>
            <?=date_formatter($event->event_startdate, 'l, jS F Y').' at '.date_formatter($event->event_startdate, 'H:i')?>
            <?=' to '.date_formatter($event->event_enddate, 'l, jS F Y').' at '. date_formatter($event->event_enddate, 'H:i')?>
            <?='('.date_formatter($event->event_startdate, 'T').')'?>
          </p>
          <?php else : ?>
          <p>
            <?=date_formatter($event->event_startdate, 'l, jS F Y')?><?=' '.date_formatter($event->event_startdate, 'H:i') . ' - ' . date_formatter($event->event_endtime, 'H:i')?>
            <?='('.date_formatter($event->event_startdate, 'T').')'?>
          </p>
          <?php endif ?>
          <p><strong>Where</strong></p>
          <p><?=$event->location?></p>
        </div>
      </div>
    </div>
  </div>
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
						<img src="https://placeimg.com/225/200/arch" class="img-responsive" alt="Image" alt="nature">
					</a>
				</div>
				<div class="col-md-6">
					<h2 class="thumbnail-title"><a href="<?=$event->url?>"><?=$event->title?></a></h2>
					<p class="thumnail-p"><strong><?=date_formatter($event->event_startdate, 'F jS Y')?><?=' at '.date_formatter($event->event_startdate, 'H:i')?></strong></p>
					<p class="thumnail-p">HOSTED BY <strong class="thumnail-by-name"><?=strtoupper($event->host->name)?></strong></p>
					<a href="<?=$event->url?>"><button type="submit" class="btn btn-info no-radius">View Event Details</button></a>
				</div>
			</div>
		</div>
		<hr>
  <?php endforeach; ?>
  <div class="view_archives">

      <nav>
      <?php if (!empty($pagination)) : ?><?=$pagination?>  &nbsp;<?php endif; ?>
      </nav>

  </div>
  </div>
	</div>

</div>
<?php endif; ?>
