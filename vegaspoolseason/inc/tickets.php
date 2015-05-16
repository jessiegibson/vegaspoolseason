<?php

//$key="mykey"; 
//echo get_post_meta($post->ID, $key, true);

$myevents = simplexml_load_file('http://wantickets.com/xml/events.aspx?VenueID=2768&pagesize=10&pagenum=1&affCode=866b2427436f493d9232');
?>

		<div class="event_section">

			<div class="wrapper">

				<h2>Upcoming Events</h2>
				<?php 

				echo '<ul class="eventList">';

				foreach ($myevents->Event as $eventInfo):
					$date=$eventInfo->Date;
					$name=$eventInfo->Name;
					$url=$eventInfo->URL;
                    $artist = $eventInfo->Artist;
                    
					    
					echo '<li class="eventLink">' . $date . "<br />" . $name . " <br /> " .  '<br /><span class="btn btn-eventtickets"><a href ="' . $url . '">Tickets</a></span><span class="btn btn-eventbottle"><a href="http://vegaspoolsesaon.com/bottle-service-las-vegas/">Bottle Service</a></span>' . '</li>' ;

				endforeach;
				
				echo "</ul>";

				?>

			</div>
		</div>