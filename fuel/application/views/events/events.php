<?php
$slug = uri_segment(2);

if ($slug) :

  $event = fuel_model('events', array('find' => 'one', 'where' => array('slug' => $slug)));

  if (empty($event)) :
    redirect_404();
  endif;

  if ($event->has_page_title()) :
    fuel_set_var('page_title', $event->page_title);
  else :
    fuel_set_var('page_title', $event->title);
  endif;

  if ($event->has_meta_description()) :
    fuel_set_var('meta_description', $event->meta_description);
  endif;
  if ($event->has_meta_keywords()) :
    fuel_set_var('meta_keywords', $event->meta_keywords);
  endif;

  if ($event->has_og_title()) :
    fuel_set_var('open_graph_title', $event->og_title);
  endif;

  if ($event->has_og_description()) :
    fuel_set_var('open_graph_description', $event->og_description);
  endif;

  if ($event->has_og_image()) :
    fuel_set_var('open_graph_image', $event->og_image);
  endif;

  if ($event->has_canonical()) :
    fuel_set_var('canonical', $event->canonical);
  endif;

else:
  $CI->load->library('pagination');
  $CI->load->model('events_model');
  $CI->load->config('paginations', TRUE);

  $current_date = new DateTime();
  $event_interval = $current_date->sub(new DateInterval('P12M'));
  $limit = $CI->config->item('per_page', 'paginations');

  $offset = (((int)$CI->input->get('per_page') - 1) * $limit);
  $offset = ($offset < 0 ? 0 : $offset);
  $base_url = base_url('events');
  $uri_segment = 2;
  $total = $CI->events_model->record_count(array('event_startdate >=' => $event_interval->format('Y-m-d')));

  $config = $CI->config->config;
  $config = $config['paginations'];
  $config['base_url'] = $base_url;
  $config['num_links'] = 2;
  $config['use_page_numbers'] = TRUE;
  $config['total_rows'] = $total;
  $config['uri_segment'] = $uri_segment;
  $config['page_query_string'] = TRUE;

  $CI->pagination->initialize($config);
  $pagination = $CI->pagination->create_links();

  $events = fuel_model('events', array('limit' => $limit, 'offset' => $offset, 'order' => 'event_startdate desc', 'where' => array('event_startdate >=' => $event_interval->format('Y-m-d'))));
	$upcoming_event = fuel_model('events', array('limit' => 1, 'offset' => null, 'order' => 'abs(now() - event_startdate) asc', 'where' => 'event_startdate >= now()'));
  $vars['events'] = $events;
  $vars['pagination'] = $pagination;
  $vars['upcoming_event'] = $upcoming_event;
endif;

if (!empty($event)) : ?>
<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="event-details">
        <div class="event-detail">
          <?php if($event->has_main_image()): ?>
            <img class="event-image" src="<?=$event->main_image_path?>" class="img-responsive" alt="<?=$event->title_entities?>">
            <hr>
          <?php else:  ?>
            <img src="<?=img_path('place_holders/events_ph@2x.png', null, null)?>" class="img-responsive" alt="Image">
            <hr>
          <?php endif; ?>

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

<?php
else: ?>
<div class="container">
  <h1>Upcoming and Latest Events</h1>
  <?=$this->load->view('_blocks/event_posts', $vars)?>
</div>
<?php
endif; ?>
