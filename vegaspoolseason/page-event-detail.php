<?php
/*
Template Name: Page - Upcoming Events - backup
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
    <div class="col-xs-8">
    <div class="maincontent page">
        <div class="row">
            <div class="col-xs-12">
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
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <img src="<?php echo $image?>" width="200px" alt="<?php echo $event['event_name']?>"/>
            </div>
            <div class="col-md-8">
                <h3><?php echo $event['event_name']?></h3>
                <strong>Date: </strong><?php echo $event['event_date']?><br/>
                <strong>Location: </strong> <?php echo $event['venue']?><br/>
                <a href="http://vegaspoolseason.com/bottle-service-las-vegas/">Request Bottle Service</a>
                <a href="<?php echo $event['ticketing_link']?>">Tickets</a>          
            </div>
                <hr>
            <?php } ?>
                
            <div class="clear"></div>
            </div>
        <center><?php echo $pagination->displayPaging();?></center>
                <?php }else{ ?>
                <p>No events yet to list!</p>
                <?php }?>
    </div>
    <!-- Sidebar
      ================================================== -->      
    <div class="col-xs-4">
    <div class="sidebar">
        <?php  /* Widget Area */ if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Page Sidebar') ) ?>
    </div>

    <div class="clear"></div>
</div>
</div>
<?php get_footer(); ?>


        




 