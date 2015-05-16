<?php 
    if($eventsArray){
?>
<center>
    <strong>
        <?php echo $pagination->displayPaging();?>
    </stong>
</center>
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