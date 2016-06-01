<?php foreach($categories as $category) :
		$posts = $category->posts;
		if (!empty($posts)) :
	 ?>
	
	<div class="row">
		<div class="col-md-12 col-sm-12 col-md-offset-2 col-sm-offset-2">	
			<a href="<?=$category->url?>" class="filter">
			<?=fuel_edit($category->id, 'Edit Category', 'blog/categories')?>
				<h1 class="filter-item filter-name"><?=$category->name?></h1>
				<div class="filter-item filter-count"><span class="badge"><?=count($posts)?></span></div>
			</a>
		</div>	
	</div>
<?php endif; ?>
<?php endforeach; ?>