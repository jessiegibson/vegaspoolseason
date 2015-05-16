<?php
/*********************************
* Turn Off Error Reporting/Notices
*********************************/ 
if($_GET['dev']==1){
error_reporting(-1);
}else{
error_reporting(0);
}
/*****************************
* Database Connection
*****************************/
include('dbconnect.inc');
/*****************************
* Include Model
*****************************/
include('model.inc');
/*****************************
* Pagination
*****************************/
include_once("pagination.class.php");
$pagination	=	new pagination();
/*************************
* First Fetch Venus
**************************/
$eventsArray = fetchEvents($pagination);
?>
<!DOCTYPE html>
<!-- saved from url=(0052)http://vegaspoolseason.com/bottle-service-las-vegas/ -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>Vegas Pool Parties Events</title>
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
        <h1>New Events</h1>
        <div>
        	<?php 
			if($eventsArray){
				?>
                <center><b><?php echo $pagination->displayPaging();?></b></center>
                <br>
                <?php
				foreach($eventsArray as $event){
					if($event['venue_image']){
						$image = $event['venue_image'];
					}elseif($event['default_image']){
						$image = $event['default_image'];
					}else{
						$image = 'images/no_img.png';
					}
			?>
            	<div class="clearfix">
                	<div class="col-md-3"><img src="<?php echo $image?>" width="200" /></div>
                	<div><b><?php echo $event['event_name']?></b></div>
                    <div><i><?php echo date('m/d/y - l - h:i A', strtotime($event['event_date']))?></i></div>
                    <div>Location: <?php echo $event['venue']?></div>
                    <div class="col-md-7" style="padding-left:0; padding-top:10px;">
                    	<div class="col-md-4 small" class="btn btn-bottleservice" style="padding-left:0">
                    		<a href="http://vegaspoolseason.com/bottle-service-las-vegas/" style="text-decoration:none"><input class="" type="button" name="BottleService" value="Request Bottle Service"></a>
                        </div>
                        <div class="col-md-3 small" style="padding-left:0">
                    		<a href="http://vegaspoolseason.com/hosted-entry/" style="text-decoration:none"><input class="" type="button" name="BottleService" value="Hosted Entry"></a>
                        </div>
                        <div class="col-md-2 small" style="padding-left:0">
                    		<a href="<?php echo $event['ticketing_link']?>" style="text-decoration:none"><input class="" type="button" name="BottleService" value="Tickets"></a>
                        </div>
                    </div>
                </div>
                <hr>
            <?php
				}
			?>
            <center><b><?php echo $pagination->displayPaging();?></b></center>
            <?php
			}else{
			?>
            <p><b>No events yet to list!</b></p>
            <?php
			}
			?>
                
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