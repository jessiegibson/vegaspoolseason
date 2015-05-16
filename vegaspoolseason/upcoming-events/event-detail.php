<?php
/*********************************
* Turn Off Error Reporting/Notices
*********************************/ 
error_reporting(0);
/*****************************
* Database Connection
*****************************/
include('dbconnect.inc');
/*****************************
* Include Model
*****************************/
include('model.inc');

/*************************
* First Fetch Venus
**************************/
if(!isset($_GET['id'])){
	die('No direct access!');
}
$eventArray = fetchEvent($_GET['id']);
if(!$eventArray){
	die('No event found, contact administrator!');
}
//Image Handle
if($eventArray['venue_image']){
	$image = $eventArray['venue_image'];
}elseif($eventArray['default_image']){
	$image = $eventArray['default_image'];
}else{
	$image = 'images/no_img.png';
}
//Back URL
$goback = @$_SERVER['HTTP_REFERER'];
if(!$goback){
	$goback = 'events-list.php';
}
?>
<!DOCTYPE html>
<!-- saved from url=(0052)http://vegaspoolseason.com/bottle-service-las-vegas/ -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>Vegas Pool Parties - Event Detail</title>
    <link rel="shortcut icon" href="http://www.vegaspoolseason.com/wp-content/uploads/2013/02/favicon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Vegas pool events.">
    <meta name="author" content="Jessie Gibson, Jessie@umbrellagrouplv.com">
    <link href="http://vegaspoolseason.com/css/style.css" rel="stylesheet">
</head>
<body>
<div class="container-fluid header">
        <div class="row">
            <div class="col-xs-8">
            <a href="http://vegaspoolseason.com/"><img name="bottle_Service" src="images/logo.png" alt="Vegas Pool Party Bottle Service"></a>
            </div>
            <div class="col-xs-4">
            </div>
        </div>
    </div>
    <div class="container" id="main-content">
        <h1><strong><?php echo $eventArray['event_name']?></strong></h1>
        <div>
        		<div class="clearfix">
                	<div class="col-md-3">
                    	<img src="<?php echo $image?>" width="200" />
                    </div>
                    <div>
                    	<div class="col-md-1"><strong>Date: </strong></div>
						<div class="col-md-8"><i><?php echo date('M d, Y @H:i:A', strtotime($eventArray['event_date']))?></i></div>
                    </div>
                    <div>
                    	<div class="col-md-1"><strong>Location: </strong></div>
						<div class="col-md-8"><?php echo $eventArray['venue']?></div>
                    </div>
                    <?php
					if($eventArray['address']){
					?>
                    <div>
                    	<div class="col-md-1"><strong>Address: </strong></div>
						<div class="col-md-8"><?php echo $eventArray['address']?></div>
                    </div>
                    <?php
					}
					if($eventArray['promoter']){
					?>
                    <div>
                    	<div class="col-md-1"><strong>Promoter: </strong></div>
						<div class="col-md-8"><?php echo $eventArray['promoter']?></div>
                    </div>
                    <?php
					}
					if($eventArray['artist_name']){
					?>
                    <div>
                    	<div class="col-md-1"><strong>Artist: </strong></div>
						<div class="col-md-8"><?php echo $eventArray['artist_name']?></div>
                    </div>
                    <?php
					}
					if($eventArray['information']){
					?>
                    <div>
                    	<div class="col-md-1"><strong>Description: </strong></div>
						<div class="col-md-8"><?php echo $eventArray['information']?></div>
                    </div>
                    <?php
					}
					if($eventArray['prices']){
					?>
                    <div class="col-md-12">
                    <div class="col-md-3">&nbsp;</div>
                    	<div class="col-md-1"><strong>Prices: </strong></div>
                        <table border="1" style="margin-left:10px; float:left; margin-top:5px;">
                           <tr>
                                <th>Entry For</th>
                                <th>Price</th>
                                <th>Service</th>
                            </tr>
                            <?php
                                foreach($eventArray['prices'] as $price){
                            ?>
                                <!--<div>
                                    <div class="col-md-1"><b><?php echo $eventArray['price_name']?></b> </div>
                                </div>-->
                                <tr>
                                    <td><?php echo $price['price_name']?></td>
                                    <td><?php echo $price['ticket_price']?>$</td>
                                    <td><?php echo $price['service_charges']?>$</td>
                                </tr>
                            <?php
                                }
                            ?>
                        </table>
                    </div>
                    <?php
					}
					?>
                    <div class="col-md-12" style="padding-top: 15px; padding-left: 34%;">
                    	<div class="col-md-4 small" style="padding-left:0">
                    		<a href="http://vegaspoolseason.com/bottle-service-las-vegas/" style="text-decoration:none"><input class="" type="button" name="BottleService" value="Request Bottle Service"></a>
                        </div>
                        <div class="col-md-3 small" style="padding-left:0">
                    		<a href="http://vegaspoolseason.com/hosted-entry/" style="text-decoration:none"><input class="" type="button" name="BottleService" value="Hosted Link"></a>
                        </div>
                        <div class="col-md-2 small" style="padding-left:0">
                    		<a href="<?php echo $eventArray['ticketing_link']?>" style="text-decoration:none"><input class="" type="button" name="BottleService" value="Tickets"></a>
                        </div>
                        <div class="col-md-2 small" style="padding-left:0">
                    		<a href="<?php echo $goback?>" style="text-decoration:none"><input class="" type="button" name="GoBack" value="Go Back"></a>
                        </div>
                    </div>
                </div>
                <hr>
                
        </div><!-- CLOSES OUT  --></div>
    <div class="container-fluid">
        <hr>
        <center><p>© 2014 Vegas Pool Season</p></center>
    </div>
    <div class="container-fluid footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <h3>About Vegas Pool Season</h3>
                    <p>We can set up bottle service at any of the afterhours, dayclubs, gentleman's clubs, nightclubs and pool parties in Las Vegas. If Whether you are coming to Las Vegas for a bachelor / stag party, bachelorette party / hen party, birthday party, business trip, just for fun or you are entertaining clients we can help.</p>
                    <p>We have been in Las Vegas nightlife for the past 10 years and we know nightlife in Las Vegas. We have work with many of these nightclubs since the day that they opened and we know the booking process very well. Not only can we book your reservation we can offer recommendations for you and your party to ensure that you and your party has the best possible time while you are in Las Vegas.</p>
                    <h4>We look forward to speaking with you! </h4>
                    <p>If you are NOT interested in bottle service then you can purchase <a href="http://umbrellagroupvip.wantickets.com/">nightclub tickets</a> here.</p>
                </div>
              <div class="col-sm-4">
                <h3>Las Vegas Nightclubs</h3>
                  <ul>
                    <li>1 Oak Nightclub</li>
                    <li>Bank Nightclub</li>
                    <li>Chateau Nightclub</li>
                    <li>Drais Beach Club</li>
                    <li>Drais Nightclub</li>
                    <li>Hyde Bellagio</li>
                    <li>Light Nightclub</li>
                    <li>Marquee Nightclub</li>
                    <li>Surrender Nightclub</li>
                    <li>Tao Nightclub</li>
                    <li>Tryst Nightclub</li>
                    <li>XS Nightclub</li>
                </ul>
              </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <h4>Check out our other Sites</h4>
                    <ul>
                        <li><p>Check out our other <a href="http://vegaspoolseason.com/" alt="Vegas Pool Parties">Vegas Pool Parties</a> site for more information.</p></li>
                        <li><p>If you live in NYC find the best <a href="http://thirstynyc.com/places-to-drink/">places to drink</a> at Thirsty NYC.</p></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
  

</body></html>