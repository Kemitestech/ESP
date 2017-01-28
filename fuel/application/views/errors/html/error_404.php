<?php defined('BASEPATH') OR exit('No direct script access allowed');
fuel_set_var('page_title', '404 Error | Page cannot be found');
$CI =& get_instance(); ?>

<?php echo fuel_block('header', array('active' => 'active'))?>
<div class="container" style="min-height: 200px;">
	<h1 class="header-title"><?php echo $heading; ?></h1>
	<?php echo $message; ?>
	<a href="<?=base_url()?>">Return to the Home Page</a>
</div>
<?php echo fuel_block('newsletter_section')?>
<?php echo fuel_block('footer')?>
