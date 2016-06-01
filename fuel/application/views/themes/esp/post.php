<div class="row">
	<div class="col-md-8">
		<div class="post">
			<?=fuel_edit($post)?>
			
			<?=blog_block('post_unpublished', array('post' => $post))?>
			
			<h1><?=$post->title?> </h1>
			<div class="post_author_date" style="margin-top: 20px;">
				<strong>BY <a href="#" class="header-title"><?=strtoupper($post->author_name)?></a></strong>
				<span class="sep" style="padding: 0px 10px;">|</span>
				<p style="display: inline;"><?=date_formatter($post->date_added, 'M d, Y')?></p>
			</div>
			<ul class="soc-news">
				<li><a class="soc-news-twitter" href="#"></a></li>
				<li><a class="soc-news-google" href="#"></a></li>
				<li><a class="soc-news-facebook" href="#"></a></li>
				<li><a class="soc-news-email1 soc-icon-last" href="#"></a></li>
			</ul>
			<figure>
				<img src="https://placeimg.com/600/525/arch" class="img-responsive" alt="Image" >
				<figcaption>A picture of something thats really interesting</figcaption>
			</figure>
			
			<div class="post_content">
				<p class="news-p"><?=$post->content_filtered?></p>
			</div>
			
		</div>
	</div>
	
	<div class="col-md-3">
	  <div id="returnto-news"class="panel panel-default no-radius" style="margin-top:20px;">
		<a href="<?=base_url('blog')?>" class="panel-heading text-center btn-block" role="button" style="text-color: black;">Back to blog posts</a>
	  </div>
	  <div class="panel panel-default no-radius" style="margin-top:20px;">
		<div class="panel-heading text-center" style="padding-top:15px; padding-bottom:15px;"><strong>Recent posts</strong></div>
		  <div class="panel-body">
				<?php $recent_posts = $this->fuel->blog->get_recent_posts(); ?>
				<?php foreach($recent_posts as $recent_post) : ?>
				<figure>
					<a href="<?=$recent_post->url?>"><img src="https://placeimg.com/225/200/nature" class="img-responsive" alt="Image" ></a>
					<figcaption><?=$recent_post->title?></figcaption>
				</figure>
				<?php endforeach; ?>
		  </div>
	  </div>
	</div>	
</div>


<?php if ($post->comments_count > 0) : ?>
	<h3><?=lang('blog_comment_heading')?></h3>
	<div class="comments" id="comments">

		<?=$post->comments_formatted?>
		<?=js('comment_reply', BLOG_FOLDER)?>
		
		<?php /* Another example without the nesting... ?>
		<?php foreach($post->comments as $comment) : ?>

			<div class="<?=($comment->is_child()) ? 'comment child' : 'comment'?>">

				<div class="comment_content" id="comment<?=$comment->id?>">
					<?=$comment->content_formatted?>
				</div>

				<div class="comment_meta">
					<cite><?=$comment->author_and_link?>, <?=$comment->get_date_formatted('h:iA / M d, Y')?></cite>
				</div>
			</div>
		<?php endforeach; ?>

		<?php */ ?>

	</div>
<?php endif; ?>

<?php if ($post->allow_comments) : ?>
	<div class="comment_form" id="comments_form">

	<?php if ($post->is_within_comment_time_limit()) : ?>
		<?php if (empty($thanks)) : ?>
		<h3><?=lang('blog_leave_comment_heading')?></h3>
		<?php else: ?>
		<?=$thanks?>
		<?php endif;
		 ?>
		<?=$comment_form?>
	<?php else: ?>
		<p><?=lang('blog_comments_off')?></p>
	<?php endif; ?>
	</div>

<?php else: ?>
	<p><?=lang('blog_comments_off')?></p>
<?php endif; ?>
