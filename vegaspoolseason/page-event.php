<?php
/*
Template Name: Page - Upcoming Events
*/

/*********************************
* Turn Off Error Reporting/Notices
*********************************/
error_reporting(0);
/*****************************
* Database Connection
*****************************/
include('upcoming-events/dbconnect.inc');
/*****************************
* Include Model
*****************************/
include('upcoming-events/model.inc');
/*****************************
* Pagination
*****************************/
include_once("upcoming-events/pagination.class.php");
$pagination	=	new pagination();
/*************************
* First Fetch Venus
**************************/
$eventsArray = fetchEvents($pagination);?>
<?php get_header(); ?>

<div class="container clearfix titlecontainer">

    <!-- Page Title
    ================================================== -->
    <div class="pagetitlewrap">
        <h1 class="pagetitle">
            <?php wp_title("",true);
            if(!wp_title("",false)) { echo bloginfo( 'title');} ?>
        </h1>
        <div class="mobileclear"></div>
    </div>
    <div class="clear"></div>
    <!-- Page Content
      ================================================== -->
    <div class="maincontent page">
                <?php if($eventsArray){ ?>
                <center><?php echo $pagination->displayPaging();?></center><br>
                <?php
                foreach($eventsArray as $event){
                    if($event['venue_image']){
                        $image = $event['venue_image'];
                    }elseif($event['default_image']){
                        $image = $event['default_image'];
                    }else{
                        $image = 'http://vegaspoolseason.com/img/upcoming-events.jpg';
                    } ?>
          <div itemscope itemtype="http://schema.org/event">
            <div class="one_third">
                <span itemprop="image"><img src="<?php echo $image?>" width="200" /></span>
            </div>
            <div class="two_third" style="padding:10px;margin:0;">
                <h3 itemprop="name"><?php echo $event['event_name']?></h3>
                <strong>Date: </strong><span itemprop="startDate"><?php echo date('M d, Y @H:i:A', strtotime($event['event_date']))?><br/></span>
                <strong>Location: </strong><span itemprop="location"><?php echo $event['venue']?><br/></span></div>
                <div itemscope itemtype="http://schema.org/thing/"><span itemprop="potentialAction "><a rel="nofollow" class="button large" href="http://vegaspoolseason.com/bottle-service-las-vegas/">Request Bottle Service</a></span>
                <span itemprop="potentialAction"><a class="button large blue" href="<?php echo $event['ticketing_link']?>">Tickets</a></span>
            </div>
              </div>
                <hr>
            <?php } ?>
            <div class="clear"></div>
        <center><?php echo $pagination->displayPaging();?></center>
                <?php }else{ ?>
                <p>No events yet to list!</p>
                <?php }?>
    </div>
    <!-- Sidebar
      ================================================== -->
    <div class="sidebar">
        <?php  /* Widget Area */ if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Page Sidebar') ) ?>
    </div>

    <div class="clear"></div>
</div>
<?php get_footer(); ?>
