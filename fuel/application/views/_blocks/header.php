<!DOCTYPE html>
<html>
<head>
	<?php if(!empty($is_blog)) : ?>
	<title><?=$CI->fuel_blog->page_title($page_title, ' | ', 'right'); ?></title>
  <?php elseif (is_home()) : ?>
	<title><?=fuel_var('page_title', '')?></title>
	<?php else : ?>
	<title><?=fuel_var('page_title', '') . ' | CCC Edward Street Parish'?></title>
  <?php endif;  ?>
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" charset="utf-8">
	<meta name="keywords" content="<?=fuel_var('meta_keywords'); ?>" />
  <meta name="description" content="<?=fuel_var('meta_description'); ?>" />
	<meta property="og:title" content="<?=fuel_var('open_graph_title', '')?>" />
	<meta property="og:description" content="<?=fuel_var('open_graph_description', '')?>" />
	<meta property="og:image" content="<?=fuel_var('open_graph_image', '')?>" />
	<link rel="canonical" href="<?=fuel_var('canonical', '')?>" />

  <?php echo css('bootstrap.min.css'); ?>
  <?php echo css('bootstrap-theme.min.css'); ?>
  <?php echo css('style.css'); ?>
  <?php echo css('slick-theme.css'); ?>
  <?php echo css('fv/formValidation.min.css'); ?>
	<?php echo css('social-share-kit.css'); ?>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/jquery.slick/1.5.0/slick.css"/>
	<link href='https://fonts.googleapis.com/css?family=Ubuntu:400,300' rel='stylesheet' type='text/css'>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.slick/1.5.0/slick.min.js"></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/latest/TweenMax.min.js"></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/latest/plugins/ScrollToPlugin.min.js"></script>
	<?php echo js('fv/formValidation.popular.min.js'); ?>
	<?php echo js('fv/framework/bootstrap.min.js'); ?>
	<?php echo js('jquery.easing.min.js'); ?>
  <?php echo js('scrolling-nav.js'); ?>
  <?php echo js('parallax.min.js'); ?>
	<?php echo js('social-share-kit.min.js'); ?>
</head>
<body id="top">
	<nav id="myAffix" class="myaffix1 navbar navbar-default"><!-- Start of Navigation -->
	 <div class="container-fluid"><!-- Start of container-fluid -->
		<div class="row"><!-- Start of row -->
			<div class="col-md-13"><!--Start of col-md-13 -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="<?php echo base_url(); ?>">
						<img src="<?php echo assets_path('images/est-logo.png'); ?>" alt="Edward Street Parish Logo" class="hidden-xs ccc-logo">
						<h3 class="visible-xs-inline">CCC Edward Street Parish</h3>
					</a>
				</div>
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1"><!-- Start of navbar-collapse -->
				<ul id="primary-nav" class="nav navbar-nav nav-font"><!-- Start of navbar-nav -->
			    	<li class="dropdown collapse-underline <?php if(strpos(uri_string(),'about-us') !== false) echo $active; ?>">
          		<a class="dropdown-toggle nav-color nav-hover" data-toggle="dropdown" role="button">About</a>
		  				<ul class="dropdown-menu" role="menu">
							<!--<li class="<?php //if(uri_string() == 'about-us/what-we-do') echo $dropdownactive; ?>"><a href="<?php //echo base_url('about-us/what-we-do') ?>" class="nav-color ">What we do</a></li>
							<li class="<?php //if(uri_string() == 'about-us/history') echo $dropdownactive; ?>"><a href="<?php //echo base_url('about-us/history') ?>" class="nav-color">History</a></li>-->
							<li class="<?php if(uri_string() == 'about-us/tenets') echo $dropdownactive; ?>"><a href="<?php echo base_url('about-us/tenets') ?>" class="nav-color">Tenets</a></li>
							<li class="<?php if(uri_string() == 'about-us/our-ministries') echo $dropdownactive; ?>"><a href="<?php echo base_url('about-us/our-ministries') ?>" class="nav-color">Ministries</a></li>
              <li class="<?php if (uri_string() == 'about-us/our-church-administration') echo $dropdownactive; ?>"><a href="<?php echo base_url('about-us/our-church-administration') ?>" class="nav-color">Church Administration</a></li>
							<li class="<?php if (uri_string() == 'about-us/spiritual-arms-of-church') echo $dropdownactive; ?>"><a href="<?php echo base_url('about-us/spiritual-arms-of-church') ?>" class="nav-color">Spiritual arms of church</a></li>
							<li class="<?php if(uri_string() == 'about-us/worship-with-us') echo $dropdownactive; ?>"><a href="<?php echo base_url('about-us/worship-with-us') ?>" class="nav-color">Worship with us</a></li>
		  				</ul>
						</li>
						<!-- Start of About us section dropdown navigation -->
						<!-- End of About us section dropdown navigation -->
						<li class="collapse-underline <?php if(uri_string() == 'blog') echo $active; ?>"><a href="<?php echo base_url('blog') ?>" class="nav-color nav-hover">Blog</a></li>
						<li class="collapse-underline <?php if(uri_string() == 'events') echo $active; ?>"><a href="<?php echo base_url('events') ?>" class="nav-color nav-hover">Events</a></li>
						<!--<li class="collapse-underline <?php //if(uri_string() == 'youth') echo $active; ?>"><a href="<?php //echo base_url('youth') ?>" class="nav-color nav-hover">Youth</a></li>-->
						<li class="collapse-underline <?php if(uri_string() == 'contact-us') echo $active; ?>"><a href="<?php echo base_url('contact-us') ?>" class="nav-color nav-hover">Contact Us</a></li>
						<li class="collapse-underline <?php if(uri_string() == 'prayer-request') echo $active; ?>"><a href="<?php echo base_url('prayer-request') ?>" class="nav-color nav-hover">Prayer request</a></li>
						<li class="collapse-underline <?php if(uri_string() == 'gallery') echo $active; ?>"><a href="<?php echo base_url('media');?>" class="nav-color nav-hover">Gallery</a></li>
					</ul><!-- End of navbar-nav -->
					<ul id="secondary-nav" class="nav navbar-nav repos-top-right"><!-- Start of second nav -->
					<!--<li class="hidden-xs hidden-sm">
							<a>
								<img src="<?php //echo assets_path('images/search2.png'); ?>" class="nav-img-display" alt="" role="button" data-target="#collapseExample"data-toggle="collapse" aria-expanded="false" aria-controls="collapseExample">
							</a>
						</li>-->
						<!--<form class="navbar-form navbar-left navbar-form-override visible-xs-inline visible-sm-inline" role="search">
							<div class="form-group">
							 <div class="col-xs-7 col-sm-8 search-pos">
							  <input type="text" class="form-control" placeholder="Search">
							 </div>
							 <button type="submit"style="margin-left: 20px;" class="btn btn-default">Search</button>
							</div>
						</form>-->
						<li class="visible-lg-inline">
						<?php if(!$CI->fuel->blog->is_logged_in()) :?>
							<a href="<?php echo base_url('fuel/login'); ?>" class="nav-color">
								<img src="<?php echo assets_path('images/user.png'); ?>" style="" class="nav-img-display" alt="">
							</a>
						<?php endif; ?>
						</li>
					</ul><!-- End of second nav -->
					<div class="collapse" id="collapseExample">
						<form class="navbar-form navbar-left" role="search">
							<div class="form-group">
								<div class="input-group">
								  <input type="text" class="form-control border-style" placeholder="Search">
								  <span class="input-group-btn nav-inputsearch">
										<img src="<?php echo assets_path('images/search2.png'); ?>" class="nav-img-display" role="button">
								  </span>
								</div>
							</div>
						</form>
					</div>
				</div><!-- End of navbar-collapse-->
			</div><!-- End of col-md-13 -->
	  </div><!-- End of row -->
	</div><!-- End of container-fluid -->
</nav><!-- End of Navigation -->
