<!DOCTYPE html>
<html>
<head>
	
	<title><?php echo $title ?></title> 	

	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" charset="utf-8"> 

	<link href="<?php echo base_url('css/style.css') ?>" rel="stylesheet" type='text/css'>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
	<link href='https://fonts.googleapis.com/css?family=Ubuntu:400,300' rel='stylesheet' type='text/css'>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url('js/jquery.easing.min.js') ?>"></script>
  	<script src="<?php echo base_url('js/scrolling-nav.js') ?>"></script>
</head>
<body id="top">
	<div class="header_logo">
  		<div class="container-header">
    	 	<img src="<?php echo base_url('img/edward-logo.png') ?>" alt="ccc-logo" class="ccc-logo img-thumbnail">
    		<h1 class="header-title"><?php echo $title ?></h1>
  		</div>
	</div>
	<nav id="myAffix" class="navbar navbar-default">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
			        <span class="sr-only">Toggle navigation</span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
		    </button>
			</div>
		   <a class="navbar-brand" href="<?php echo base_url('home') ?>">
        <h3 class="header-title" style="color: white !important;">CCC Edward Street Parish</h3>
       </a>	
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
			    	<li class="<?php if(uri_string() == 'home'){echo $active;} ?>"><a href="<?php echo base_url('home') ?>" 
						class="nav-color">Home<span class="sr-only">(current)</span></a></li>
			    	<li class="dropdown">
	      			<a href="<?php echo base_url('about-us') ?>" class="dropdown-toggle nav-color" data-toggle="dropdown" role="button">  				    About Us</a>
			  		  <ul class="dropdown-menu" role="menu">
			            <li><a href="<?php echo base_url('about-us') ?>" class="nav-color">Who we are</a></li>
				    	<li><a href="<?php echo base_url('about-us/history') ?>" class="nav-color">History</a></li>
			            <li><a href="<?php echo base_url('about-us/days-of-worship') ?>" class="nav-color">Days of worship</a></li>
			            <li><a href="<?php echo base_url('about-us/tenets') ?>" class="nav-color">Tenets</a></li>
	              		<li><a href="#" class="nav-color">Constitution</a></li>
			            <li><a href="#" class="nav-color">Code of Conduct</a></li>
			  		  </ul>
	        	    </li>
	            <li class="dropdown">
				 <a href="#" class="dropdown-toggle nav-color" data-toggle="dropdown" role="button">News</a>
	             <ul class="dropdown-menu" role="menu"> 
	              <li><a href="newsletter.html" class="nav-color">Newsletters</a></li>
	              <li><a href="events.html" class="nav-color">Events</a></li>
	             </ul>  
	            </li>
				<li class="<?php if(uri_string() == 'contact-us'){echo $active;} ?>"><a href="<?php echo base_url('contact-us')?>" 
				class="nav-color">Contact Us</a></li>
				<li class="<?php if(uri_string() == 'prayer-request'){echo $active;} ?>"><a href="<?php echo base_url('prayer-request')?>" 
				class="nav-color">Prayer Request</a></li>
	            <li class="dropdown">
				 <a href="#" class="dropdown-toggle nav-color" data-toggle="dropdown" role="button">Ministries</a>
	              <ul class="dropdown-menu" role="menu">
	                <li><a href="ministries.html" class="nav-color">Charity</a></li>
	                <li><a href="ministries.html" class="nav-color">Elder</a></li>
	                <li><a href="ministries.html" class="nav-color">Youth</a></li>
	                <li><a href="ministries.html" class="nav-color">Warden</a></li>
	                <li><a href="ministries.html" class="nav-color">Clergy</a></li>
	                <li><a href="ministries.html" class="nav-color">Warden</a></li>
	                <li><a href="ministries.html" class="nav-color">Bible Class</a></li>
	                <li><a href="ministries.html" class="nav-color">Choir</a></li>
	                <li><a href="ministries.html" class="nav-color">Building commitee</a></li>
	              </ul>
	            </li>
	            <li><a href="#" class="nav-color">Youth</a></li>
				<li><a href="#" class="nav-color">Media</a></li>
			</ul>
		  </div>
		</div>
	</nav>
