<?php

$slug = uri_segment(3);

if ($slug) :
  $tag = $CI->fuel->tags->find_by_tag($slug);
  if (empty($tag)) :
    redirect_404();
  endif;

  $events_model = $tag->get_events(TRUE);

  $CI->load->library('pagination');
  $CI->load->config('paginations', TRUE);

  $limit = $CI->config->item('per_page', 'paginations');

  $offset = (((int)$CI->input->get('per_page') - 1) * $limit);
  $offset = ($offset < 0 ? 0 : $offset);

  $base_url = base_url('events/tags/' . $slug);

  $uri_segment = 4;

  $total = $events_model->record_count(array('event_startdate >=' => datetime_now()));

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

  $events = $events_model->find_all(array('event_startdate >=' => datetime_now()), 'event_startdate', $limit, $offset, NULL, NULL);
  $vars['events'] = $events;
  $vars['pagination'] = $pagination;

endif;
?>

<div class="container">
  <h1><?=ucfirst($slug)?> Events</h1>
  <?=$this->load->view('_blocks/event_posts', $vars)?>
</div>
