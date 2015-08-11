<!DOCTYPE html>
<html>
<head>
	
	<title><?php echo $title ?></title> 	

	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" charset="utf-8"> 

	<link href="<?php echo base_url('css/style.css') ?>" rel="stylesheet" type='text/css'>
	<link href="<?php echo base_url('css/bootstrap.min.css') ?>" rel="stylesheet" type='text/css'>
	<link href="<?php echo base_url('css/bootstrap-theme.min.css') ?>" rel="stylesheet" type='text/css'>
	<link href="<?php echo base_url('css/slick-theme.css') ?>" rel="stylesheet" type='text/css'>
	<link href="<?php echo base_url('css/formValidation.min.css') ?>" rel="stylesheet" type='text/css'>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/jquery.slick/1.5.0/slick.css"/>
	<link href='https://fonts.googleapis.com/css?family=Ubuntu:400,300' rel='stylesheet' type='text/css'>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.slick/1.5.0/slick.min.js"></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/latest/TweenMax.min.js"></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/latest/plugins/ScrollToPlugin.min.js"></script>
	<script src="<?php echo base_url('js/formValidation.popular.min.js') ?>"></script>
	<script src="<?php echo base_url('js/framework/bootstrap.min.js') ?>"></script>
	<script src="<?php echo base_url('js/jquery.easing.min.js') ?>"></script>
  	<script src="<?php echo base_url('js/scrolling-nav.js') ?>"></script>
  	<script src="<?php echo base_url('js/parallax.min.js') ?>"></script>
</head>
<body id="top">
	<nav id="myAffix" class="myaffix1 navbar navbar-default">
	 <div class="container-fluid">
		<div class="row">
			<div class="col-md-13">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="<?php echo base_url('home')?>">
					<img src="<?php echo base_url('img/est-logo.png') ?>" alt="Edward Street Parish Logo" class="hidden-xs ccc-logo">
					<h3 class="visible-xs-inline">CCC Edward Street Parish</h3>
					</a>	
				</div>
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav nav-font">
			    	<li class="dropdown collapse-underline <?php if(strpos(uri_string(),'about-us') !== false){echo $active;} ?>">
          			<a class="dropdown-toggle nav-color nav-hover" data-toggle="dropdown" role="button">About</a>
		  				<ul class="dropdown-menu" role="menu">
							<li class="<?php if(uri_string() == 'about-us/who-we-are'){echo $dropdownactive;} ?>"><a href="<?php echo base_url('about-us/who-we-are') ?>" class="nav-color ">Who we are</a></li>
							<li><a href="<?php echo base_url('about-us/history') ?>" class="nav-color">History</a></li>
							<li><a href="<?php echo base_url('about-us/testimonials') ?>" class="nav-color">Testimonials</a></li>
							<li><a href="<?php echo base_url('about-us/tenets') ?>" class="nav-color">Tenets</a></li>
							<li><a href="#" class="nav-color">Constitution</a></li>
							<li><a href="code-of-conduct.html" class="nav-color">Code of conduct</a></li>
							<li><a href="<?php echo base_url('about-us/days-of-worship') ?>" class="nav-color">Days of worship</a></li>
		  				</ul>
					</li>
            <li class="dropdown collapse-underline">
				<a href="#" class="dropdown-toggle nav-color nav-hover" data-toggle="dropdown" role="button">News</a>
             <ul class="dropdown-menu" role="menu">
			  <li><a href="latest-news.html" class="nav-color">Latest news</a></li>
              <li><a href="newsletter.html" class="nav-color">Newsletters</a></li>
              <li><a href="events.html" class="nav-color">Events</a></li>
             </ul>  
            </li>
			<li class="collapse-underline <?php if(uri_string() == 'contact-us'){echo $active;} ?>"><a href="<?php echo base_url('contact-us') ?>" class="nav-color nav-hover">Contact</a></li>
			<li class="collapse-underline <?php if(uri_string() == 'prayer-request'){echo $active;} ?>"><a href="<?php echo base_url('prayer-request') ?>" class="nav-color nav-hover">Prayer request</a></li>
            <li class="dropdown collapse-underline <?php if(strpos(uri_string(),'ministries') !== false){echo $active;} ?>">
			  <a href="#" class="dropdown-toggle nav-color nav-hover " data-toggle="dropdown" role="button">Ministries</a>
              <ul class="dropdown-menu list-scroll" role="menu">
				<li><a href="<?php echo base_url('ministries/our-ministries') ?>" class="nav-color">Our Ministries</a></li>	
                <li class="hidden-xs hidden-sm"><a href="ministries.html" class="nav-color">Parochial</a></li>
                <li class="hidden-xs hidden-sm"><a href="ministries.html" class="nav-color">Elder</a></li>
                <li class="hidden-xs hidden-sm"><a href="ministries.html" class="nav-color">Building commitee</a></li>
                <li class="hidden-xs hidden-sm"><a href="ministries.html" class="nav-color">Youth</a></li>
                <li class="hidden-xs hidden-sm"><a href="ministries.html" class="nav-color">Clergy</a></li>
                <li class="hidden-xs hidden-sm"><a href="ministries.html" class="nav-color">Bible class</a></li>
                <li class="hidden-xs hidden-sm"><a href="ministries.html" class="nav-color">Choir</a></li>
                <li class="hidden-xs hidden-sm"><a href="ministries.html" class="nav-color">Warden</a></li>
				<li class="hidden-xs hidden-sm"><a href="ministries.html" class="nav-color">Welfare</a></li>
				<li class="hidden-xs hidden-sm"><a href="ministries.html" class="nav-color">Health and safety</a></li>
              </ul>
            </li>
            <li class="collapse-underline <?php if(uri_string() == 'youth'){echo $active;} ?>"><a href="<?php echo base_url('youth') ?>" class="nav-color nav-hover">Youth</a></li>
			<li class="collapse-underline <?php if(uri_string() == 'gallery'){echo $active;} ?>"><a href="<?php echo base_url('gallery') ?>" class="nav-color nav-hover">Gallery</a></li>
			</ul>
			<ul id="secondnav" class="nav navbar-nav repos-top-right">
				<li class="hidden-xs hidden-sm"><a><img src="<?php echo base_url('img/search2.png') ?>" class="nav-img-display" alt="" role="button" data-target="#collapseExample"data-toggle="collapse" aria-expanded="false" aria-controls="collapseExample"></a></li>
				  <form class="navbar-form navbar-left navbar-form-override visible-xs-inline visible-sm-inline" role="search">
					<div class="form-group">
					 <div class="col-xs-7 col-sm-8 search-pos"> 
					  <input type="text" class="form-control" placeholder="Search">
					 </div>
					 <button type="submit"style="margin-left: 20px;" class="btn btn-default">Search</button>		
					</div>
					
				  </form>
				<li class="visible-lg-inline"><a href="#" class="nav-color"><img src="<?php echo base_url('img/user.png') ?>" style="" class="nav-img-display" alt=""></a></li>
			</ul>
			<div class="collapse" id="collapseExample">
				<form class="navbar-form navbar-left" role="search">
					<div class="form-group">
					<div class="input-group">
					  <input type="text" class="form-control border-style" placeholder="Search">
					  <span class="input-group-btn nav-inputsearch">
						<img src="<?php echo base_url('img/search2.png') ?>" class="nav-img-display" role="button">
					  </span>
					</div>
					</div>
				</form>
			</div>			
		</div>
		</div>
	  </div>
	 </div>
	</nav>