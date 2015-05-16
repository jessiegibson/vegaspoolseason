<?php
/*****************************
* Fetch Event via Event ID
*****************************/
function fetchEvent($event_id) {
	if(!$event_id){
		return;
	}
	global $conn;
	$sql = mysqli_query($conn, 'SELECT e.event_name, 
				   e.event_date, 
				   e.ticketing_link, 
				   e.address,
				   e.city,
				   e.state,
				   e.start_time,
				   e.end_time,
				   e.thumbnailimage,
				   e.detailimage,
				   e.flyerfrontimage as venue_image,
				   e.information,
				   e.promoter,
				   a.artist_name,
				   v.venue, 
				   v.image as default_image 
				FROM events e 
			LEFT JOIN event_artist a
				ON a.event_id = e.event_id
			JOIN venues v 
				ON v.venue_id = e.venue_id
			WHERE e.event_id = '.mysqli_escape_string($conn, $event_id).'
			GROUP BY e.event_id
			');
	$row = mysqli_fetch_array($sql, MYSQLI_ASSOC);
	$prices = fetchEventPrices($event_id);
	if($prices){
		$returnArray = array_merge($row, $prices);
	}else{
		$returnArray = $row;
	}
	return $returnArray;	
}
/*****************************
* Fetch Event Prices
*****************************/
function fetchEventPrices($event_id) {
	global $conn;
	$sql = mysqli_query($conn, 'SELECT tp.ticket_price, tp.price_name, tp.message, tp.service_charges FROM ticket_prices tp WHERE tp.event_id='.mysqli_escape_string($conn, $event_id));
	while($row = mysqli_fetch_array($sql, MYSQLI_ASSOC))
	{
		$rows['prices'][] = $row;
	}
	return $rows;	
}
/*****************************
* Fetch Events
*****************************/
function fetchEvents($pagination) {
	global $conn;
	$sql = 'SELECT e.event_id, e.event_name, e.event_date, e.ticketing_link, e.flyerfrontimage as venue_image, v.venue, v.image as default_image FROM events e JOIN venues v ON v.venue_id = e.venue_id ORDER BY e.event_date ASC';
	$pagination->createPaging($sql,$conn,10);
	while($row = mysqli_fetch_array($pagination->resultpage, MYSQLI_ASSOC))
	{
		$rows[] = $row;
	}
	return $rows;	
}
/*****************************
* Fetch Venues
*****************************/
function fetchVenues() {
	global $conn;
	$sql = mysqli_query($conn, 'SELECT venue_id FROM venues');
	while($row = mysqli_fetch_array($sql, MYSQLI_ASSOC))
	{
		$rows[] = $row;
	}
	return $rows;	
}
/*****************************
* Update Venues - Image
*****************************/
function updateVenues($venue_array, $venue_id) {
	global $conn;
	$update_venue = 'UPDATE venues SET `image` = "'.$venue_array['image'].'", `date_updated` = NOW() WHERE venue_id = '.$venue_id;
	//final query 
	if(!mysqli_query($conn, $update_venue)){
		echo "<br>Error in updating venues: ".mysql_error();
	}else{
		echo "<br>Successfully imported venues!";	
	}
}
/*****************************
* Add Venues
*****************************/
function insertEvents($event_array) {
	global $conn;
	$multi_insert_events = 'INSERT IGNORE INTO  events (`event_id`,`event_name`,`event_type`,`event_date`,`venue_id`,`address`,`city`,`state`,`zip`,`country`,`gmtoffset`,`start_time`,`end_time`,`ticketing_link`,`thumbnailimage`,`detailimage`,`flyerfrontimage`,`promoter`,`promoter_id`,`information`,`status`,`date_created`,`date_updated`) VALUES';
	$count_total_events =  count($event_array);
	
	for($index_event_insert = 0; $index_event_insert < $count_total_events;$index_event_insert++){
		if(is_array($event_array[$index_event_insert])){
			$event_array[$index_event_insert] = "";	
		}
		$multi_insert_events.= $event_array[$index_event_insert];
		
		if($index_event_insert == ($count_total_events-1)){
			$multi_insert_events.= ';';
		}else{
			$multi_insert_events.= ',';
		}
	}
	//final query 
	if(!mysqli_query($conn, $multi_insert_events)){
		echo "<br>Error in inserting events: ".mysql_error();
	}else{
		echo "<br>Successfully imported events!";	
	}
}
/*****************************
* Add Venues
*****************************/
function insertPrices($price_array) {
	global $conn;
	$multi_insert_prices = 'INSERT IGNORE INTO  ticket_prices (`event_id`,`ticket_price`,`price_name`,`message`,`service_charges`,`date_created`,`date_updated`) VALUES';
	$count_total_prices =  count($price_array);
	
	for($index_price_insert = 0; $index_price_insert < $count_total_prices;$index_price_insert++){
		$multi_insert_prices.= $price_array[$index_price_insert];
		
		if($index_price_insert == ($count_total_prices-1)){
			$multi_insert_prices.= ';';
		}else{
			$multi_insert_prices.= ',';
		}
	}
	if($count_total_prices > 0){
		//final query 
		if(!mysqli_query($conn, $multi_insert_prices)){
			echo "<br>Error in inserting prices: ".mysql_error();
		}else{
			echo "<br>Successfully imported prices!";	
		}
	}
}
/*****************************
* Add Venues
*****************************/
function insertArtists($artist_array) {
	global $conn;
	$multi_insert_artist = 'INSERT IGNORE INTO  event_artist (`event_id`,`artist_name`,`artist_id`,`date_created`,`date_updated`) VALUES';
	$count_total_artist =  count($artist_array);
	
	for($index_artist_insert = 0; $index_artist_insert < $count_total_artist;$index_artist_insert++){
		$multi_insert_artist.= $artist_array[$index_artist_insert];
		
		if($index_artist_insert == ($count_total_artist-1)){
			$multi_insert_artist.= ';';
		}else{
			$multi_insert_artist.= ',';
		}
	}
	if($count_total_artist > 0){
		//final query 
		if(!mysqli_query($conn, $multi_insert_artist)){
			echo "<br>Error in inserting artists: ".mysql_error();
		}else{
			echo "<br>Successfully imported artists!";	
		}
	}
}
?>