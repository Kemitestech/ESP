<div class="row">
	<div class="col-md-10">
		<?=fuel_edit('create', 'Create Post', 'blog/posts')?>
		<?php if (!empty($posts)) : ?>
		<?php $count = 0; ?>
			<?php foreach($posts as $post) : ?>
			<?php $count = $count + 1; ?>
			<div class="row">
				<div class="post">
					<?=fuel_edit($post)?>
					<?php if($count == 1) : ?>
					<div class="col-md-4">
						<a href="<?=$post->url?>" class="thumbnail thumbnail-override">
							<img src="https://placeimg.com/225/200/arch" class="img-responsive" alt="Image" style="width: 100%;" alt="nature">
						</a>
					</div>
					<?php else : ?>
					<div class="col-md-3">
						<a href="<?=$post->url?>" class="thumbnail thumbnail-override">
							<img src="https://placeimg.com/225/200/arch" class="img-responsive" alt="Image" style="width: 100%;" alt="nature">
						</a>
					</div>
					<?php endif; ?>
					<div class="col-md-6">	
						<?=blog_block('post_unpublished', array('post' => $post))?>						
						<h2 class="post-title"><a href="<?=$post->url?>"><?=$post->title?></a></h2> 
						<div class="post-date">
							<strong>BY <span class="post-author-name"><?=strtoupper($post->author_name)?></span></strong>
							<span class="sep" style="padding: 0px 10px;">|</span><?=date_formatter($post->date_added, 'M d, Y')?>
							
						</div>
							
						<div class="post-content">
							<?=$post->excerpt_formatted?> 
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
				<div class="pagination"><?php if (!empty($pagination)) : ?><?=$pagination?>  &nbsp;<?php endif; ?></div>
			</div>
			
		<?php else: ?>
		<div class="no_posts">
			<p>There are no posts available.</p>
		</div>
		<?php endif; ?>
	</div>	
</div>