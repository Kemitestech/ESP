<?php

	$description = "Jesus replied: Love the Lord your God with all your heart and with all your soul and with all your mind.";
	$bible_verse = "St. Matthew 22: 37";

	$quotation = fuel_model('quotations',array('find'=>'one', 'order'=> 'RAND()'));
	if(!empty($quotation)):

		if($quotation->description):
			$description = $quotation->description;
		endif;

		if($quotation->bible_verse):
			$bible_verse = $quotation->bible_verse;
		endif;

	endif;

?>
<div class="quotes">
	<div class="container">
		<div>
			<p class="quotes-bible_description"><?=$description;?></p>
			<i><p>- <?=ucfirst($bible_verse);?></p></i>
		</div>
	</div>
</div>
