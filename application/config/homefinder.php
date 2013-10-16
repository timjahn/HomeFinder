<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['hf_api_base_url'] = "http://services.homefinder.com/listingServices/search"; // Base API URL
$config['hf_api_key'] = "ys2zub7whyrtarz5kuqqjnwj"; // API Key
$config['hf_per_page'] = 10; // Number of results to show per results page
$config['hf_property_types'] = array(
								'condo' => 'Condo',
								'carm'	=> 'Farm',
								'houseboat' => 'Houseboat',
								'mobileHome' => 'Mobile Home',
								'singleFamilyHome' => 'Single Family Home',
								'townhouse'	=> 'Townhouse'
								);
$config['hf_extra_options'] = array(
								"isGatedCommunity" => "be gated",
								"isGolfCommunity" => "have a killer golf course",
								"isHorseProperty" => "have facilities for my horse Mr. Ed",
								"isWaterfrontProperty" => "be on the water front",
								"hasBasement" => "have a basement",
								"hasGarage" => "have a garage for at least a few of my Hummers"
								);
$config['hf_bed_bath_options'] = array(
								'1 TO' => '1+',
								'2 TO' => '2+',
								'3 TO' => '3+',
								'4 TO' => '4+',
								'5 TO' => '5+'
								);
$config['hf_city_options'] = array(
								"Chicago IL" => "Chicago, IL",
								"Des Moines IA" => "Des Moines, IA",
								"Miami FL" => "Miami, FL",
								"Omaha NE" => "Omaha, NE",
								"San Francisco CA" => "San Francisco, CA"
								);

/* End of file homefinder.php */
/* Location: ./application/config/homefinder.php */