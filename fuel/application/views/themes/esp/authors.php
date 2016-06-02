<?php foreach($authors as $author) : ?>
<div class="row">
		<div class="col-md-12 col-sm-12 col-md-offset-2 col-sm-offset-2">	
			<a href="<?=$author->url?>" class="filter">			
					<?php if (!empty($author->avatar_image)) : ?>
					<?=$author->get_avatar_img_tag(array('class' => 'img_left', 'alt' => $author->name))?>
					<?php endif; ?>
					<h1 class="filter-item filter-name"><?=$author->name?></h1>
				<div class="filter-item filter-count"><span class="badge"><?=count($author->posts)?></span></div>
			</a>
		</div>	
</div>
<?php endforeach; ?>
