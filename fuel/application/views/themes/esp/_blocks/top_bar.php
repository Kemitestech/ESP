<div class="top-bar">
  <ul class="top-bar-list">
    <li class="top-bar-list-item">
      <a href="<?=base_url("blog")?>" class="<?php if(uri_string() == 'blog') echo $active ?>">
        <h3>Posts<span class="badge"><?=$this->fuel->blog->get_posts_count()?></span></h3>
      </a>
    </li>
    <li class="top-bar-list-item">
      <a href="<?=base_url("blog/categories")?>" class="<?php if(uri_string() == 'blog/categories') echo $active ?>">
        <h3>Categories<span class="badge"><?=count($this->fuel->blog->get_published_categories())?></span></h3>
      </a>
    </li>
    <li class="top-bar-list-item">
      <a href="<?=base_url("blog/authors")?>" class="<?php if(uri_string() == 'blog/authors') echo $active ?>">
        <h3>Authors<span class="badge"><?=count($this->fuel->blog->get_users())?></span></h3>
      </a>
    </li>
  </ul>
</div>
