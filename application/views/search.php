<!DOCTYPE html>
<html>
<head>
   	<title>HomeFinder</title>
   	<meta name="viewport" content="width=device-width, initial-scale=1.0">
   	<link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" media="screen">
	<link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet" media="screen">
</head>
<body>
	<div id="search-form-wrapper">
		<div id="search-form">
			<?php echo form_open('main/preSearch'); ?>
			<p>I'm looking for my dream <?php echo form_dropdown('propertyType', $hf_property_types, $propertyType, 'class="form-control"'); ?> in <?php echo form_dropdown('area', $hf_city_options, $area, 'class="form-control"'); ?>. Ideally, it has <?php echo form_dropdown('bed', $hf_bed_bath_options, $bed, 'class="form-control"'); ?> bedrooms and <?php echo form_dropdown('bath', $hf_bed_bath_options, $bath, 'class="form-control"'); ?> bathrooms. Most importantly, this place will <?php echo form_dropdown('extra', $hf_extra_options, $extra, 'class="form-control"'); ?>.</p>
			<div id="search-controls">
				<div id="search-controls-left">
					<button class="btn btn-primary btn-lg">Find it now!</button>
				</div>
				<div id="search-controls-right">
					<?php if (isset($pagination)) { echo "Page: ".$pagination; } ?>
				</div>
				<div class="clear"></div>
			</div>
			<?php echo form_close(); ?>
		</div>
	</div>
	<div id="results-wrapper">
		<?php if ((isset($error) && $error!="") || (isset($listings) && $listings!="")) { ?>
		<div id="results">
		<?php 
			if (isset($error) && $error!="") { 
		?>
		<div class="alert alert-danger"><?php echo $error; ?></div>
		<?php
			} else if (isset($listings) && $listings!="") {
				for ($a=0; $a<count($listings); $a++) {
					$listing = $listings[$a];
					if (isset($listing->primaryPhoto->url)) {
		?>
			<div class="listing">
				<div class="listing-left">
					<img src="<?php echo $listing->primaryPhoto->url; ?>" class="img-thumbnail">
				</div>
				<div class="listing-right">
					<ul>
						<li><label>Price:</label> $<?php echo number_format($listing->price, 0, '', ','); ?></li>
						<li><label>Bedrooms:</label> <?php echo $listing->bed; ?></li>
						<li><label>Baths:</label> <?php echo $listing->bath->total; ?></li>
						<?php if (isset($listing->squareFootage)) { ?>
						<li><label>Square Footage:</label> <?php echo number_format($listing->squareFootage, 0, '', ','); ?></li>
						<?php } ?>
						<?php if (isset($listing->yearBuilt)) { ?>
						<li><label>Built in:</label> <?php echo $listing->yearBuilt; ?></li>
						<?php } ?>
						<?php if (isset($listing->url)) { ?>
						<li><a href="<?php echo $listing->url; ?>" target="_blank">Learn more about this property.</a></li>
						<?php } ?>
					</ul>
				</div>
				<div class="clear"></div>
			</div>
		<?php 
					}
				}
			}
		?>
		</div>
		<?php } ?>
	</div>
</body>
</html>