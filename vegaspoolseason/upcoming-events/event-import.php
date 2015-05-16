<?php 
/*****************************
* Database Connection
*****************************/
include('dbconnect.inc');
/*****************************
* Include Model
*****************************/
include('model.inc');
/*****************************
* Xml2Array
*****************************/
include('xml2array.inc');

error_reporting(0);


/*************************
* First Fetch Venus
**************************/
$venuesArray = fetchVenues();

if($venuesArray){
	foreach($venuesArray as $venue){
		if($venue['venue_id']){
			/***************************
			* Then Download the XML File
			****************************/
			$url = 'http://www.wantickets.com/xml/events.aspx?city=las+vegas&pagesize=5&pagenum=1&affCode=866b2427436f493d9232&venueID='.$venue['venue_id'];
			$path = 'xml/events.aspx.xml';
			
			$headers = getHeaders($url);
			
			if ($headers['http_code'] === 200 and $headers['download_content_length'] < 1024*1024) {
			  if (!download($url, $path)){
				echo 'XML Download failed!'; 
			  }
			}
			$strContents = file_get_contents($path);
			$data = Xml2Array($strContents);
			
			//Insert arrays 
			$events_array = array();
			$price_array = array();
			$artist_array = array();
			
			//check if array is not empty 
			if(is_array($data['EventList']['Event']) and count($data['EventList']['Event']>0)){
			
				foreach($data['EventList']['Event'] as $row){
						if(!is_array($row)){
							$row = $data['EventList']['Event'];
						}
			
						//apply database check for existing entries 
						if(clean_input($row['Id'])!=''){
							//Venues
							if($row['FlyerFrontImage']) {
								$venue_array['image'] = clean_input($row['FlyerFrontImage']); // venue image 
							}else{
								$venue_array['image'] = ""; // venue image 
							}
							$venue_array['date_updated'] = 'Now()'; // venue updated date 
							
							//Events
							$events_insert  = ' (';
							$events_insert .= '"'.clean_input($row['Id']).'",'; // event id
							$events_insert .= '"'.clean_input($row['Name']).'",'; // event name 
							$events_insert .= '"'.clean_input($row['EventType']).'",'; // event type 
							$events_insert .= '"'.clean_input(date('Y-m-d h:i:s', strtotime($row['Date'] . ' '. $row['StartTime']))).'",'; // event Date  
							$events_insert .= '"'.clean_input($row['VenueID']).'",'; // event venue_id 
							$events_insert .= '"'.clean_input($row['Address']).'",'; // event Address 
							$events_insert .= '"'.clean_input($row['City']).'",'; // event City 
							$events_insert .= '"'.clean_input($row['State']).'",'; // event State 
							$events_insert .= '"'.clean_input($row['ZipCode']).'",'; // event ZipCode 
							$events_insert .= '"'.clean_input($row['Country']).'",'; // event Country 
							$events_insert .= '"'.clean_input($row['GMTOffset']).'",'; // event GMTOffset 
							$events_insert .= '"'.clean_input($row['StartTime']).'",'; // event StartTime 
							$events_insert .= '"'.clean_input($row['EndTime']).'",'; // event EndTime  
							$events_insert .= '"'.clean_input($row['URL']).'",'; // event ticketing URL 
							$events_insert .= '"'.clean_input($row['ThumbnailImage']).'",'; // event ThumbnailImage 
							$events_insert .= '"'.clean_input($row['DetailImage']).'",'; // event DetailImage 
							$events_insert .= '"'.clean_input($row['FlyerFrontImage']).'",'; // event FlyerFrontImage 
							$events_insert .= '"'.clean_input($row['Promoter']).'",'; // event Promoter 
							$events_insert .= '"'.clean_input($row['Promoter_attr']['ID']).'",'; // event promoter id 
							$events_insert .= '"'.clean_input($row['Info']).'",'; // event information
							$events_insert .= '"1",'; // event status self defined  
							$events_insert .= 'Now(),'; // event FlyerFrontImage 
							$events_insert .= 'Now()'; // event FlyerFrontImage 
							$events_insert .= ')';
							$events_array[] = $events_insert;
							
							//add ticket prices if exist 
							if(is_array($row['Price'])){
								$total_price_options = count($row['Price']);
								
								for($ip = 0; $ip < $total_price_options; $ip++ ){
									
									$sub_index_var = $ip.'_attr';
									if(isset($row['Price'][$ip]) && $row['Price'][$ip]!=""){
										$price_insert  = ' (';
										$price_insert .= '"'.clean_input($row['Id']).'",';
										$price_insert .= '"'.clean_input($row['Price'][$ip]).'",';
										$price_insert .= '"'.clean_input($row['Price'][$sub_index_var]['Name']).'",';
										$price_insert .= '"'.clean_input($row['Price'][$sub_index_var]['ProductMessage']).'",';
										$price_insert .= '"'.clean_input($row['Price'][$sub_index_var]['ServiceCharge']).'",';
										$price_insert .= 'NOW(),';
										$price_insert .= 'NOW()';
										$price_insert .= ') ';
										
										$price_array[] = $price_insert;
										
									}
									
									
									
								}
							//add artist information     
							//check if artist information exist 
							if(isset($row['Artists']) && is_array($row['Artists']['Artist_attr'])){
								
								$artist_insert = ' (';
								$artist_insert.= '"'.clean_input($row['Id']).'",';
								$artist_insert.= '"'.clean_input($row['Artists']['Artist_attr']['Name']).'",';
								$artist_insert.= '"'.clean_input($row['Artists']['Artist_attr']['artistID']).'",';
								$artist_insert.= 'NOW(),';
								$artist_insert.= 'NOW()';
								$artist_insert.= ') ';
								
								$artist_array[] = $artist_insert; 
								
							}
						
								
								
							}
						}
					}
				
			}		
			/**************
			* Insert Data
			***************/
			updateVenues($venue_array, $venue['venue_id']);
			insertEvents($events_array);
			insertPrices($price_array);
			insertArtists($artist_array);
			//done 
			unlink($path);
		}
	}
}
?>