<div class="row">
	<div class="col-md-10">
		<?=fuel_edit('create', 'Create Post', 'blog/posts')?>
		<?php if (!empty($posts)) : ?>
			<?php foreach($posts as $post) : ?>
			<div class="row">
				<div class="post">
					<?=fuel_edit($post)?>
					<div class="col-md-3">
						<a href="<?=$post->url?>" class="thumbnail thumbnail-override">
							<?php if($post->has_list_image()): ?>
										 <p><a href="<?=$post->url?>"><img src="<?=$post->list_image_path?>" alt="<?=$post->title_entities?>" /></a></p>
							<?php else: ?>
										 <img src="<?=img_path('place_holders/ESP Placeholder.svg', null, null)?>" class="img-responsive" alt="Image">
							<?php endif; ?>
						</a>
					</div>
					<div class="col-md-6">
						<?=blog_block('post_unpublished', array('post' => $post))?>
						<h2 class="thumbnail-title"><a href="<?=$post->url?>"><?=$post->title?></a></h2>
						<div class="post-date">
							<strong>BY <span class="thumnail-by-name"><?=strtoupper($post->author_name)?></span></strong>
							<span class="sep" style="padding: 0px 10px;">|</span><?=date_formatter($post->publish_date, 'M d, Y')?>
						</div>

						<div class="post-content">
							<p class="thumnail-p"><?=$post->excerpt?></p>
						</div>
						<a href="<?=$post->url?>"><button type="submit" class="btn btn-info no-radius">Read more</button></a>
						<div class="post-meta">
							<span class="glyphicon glyphicon-tags"></span><?=$post->tags_linked ?>
						</div>

					</div>
				</div>
			</div>
			<hr>
			<div class="clear"></div>
			<?php endforeach; ?>
			<div class="view_archives">
				<nav><?php if (!empty($pagination)) : ?><?=$pagination?>  &nbsp;<?php endif; ?></nav>
			</div>

		<?php else: ?>
		<div class="no_posts">
			<p>There are no posts available.</p>
		</div>
		<?php endif; ?>
	</div>
</div>
