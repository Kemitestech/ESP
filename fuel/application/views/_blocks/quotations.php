<?php

	$description = "Jesus replied: Love the Lord your God with all your heart and with all your soul and with all your mind.";
	$bible_verse = "St. Matthew 22: 37";

	$quotation = fuel_model('quotations',array('find'=>'one', 'order'=> 'date_added DESC'));
	if(!empty($quotation)):

		if($quotation->description):
			$description = $quotation->description;
		endif;

		if($quotation->bible_verse):
			$bible_verse = $quotation->bible_verse;
		endif;

	endif;

?>
<div class="jumbotron" style="background-color: #00a1c6; background-image: url('/~mclaren/esp/assets/images/bedge-grunge.png'); background-size: 100% 100%;">
	<div class="container" style="text-align: center; margin-top: 50px;">
		<div style="color: white;">
			<p><?=$description;?></p>
			<p><?=ucfirst($bible_verse);?></p>
		</div>
	</div>
</div>
