<?php
if ($_POST['viewEvents']) {
	?>
        <script>
        	document.getElementById("magement_panel").innerHTML="";
        </script>
        <?php
        $sql="SELECT event_id,event_name,event_type,event_venue,event_date FROM events";
                  $result=mysqli_query($con,$sql) or die(mysql_error());
                  ?>
                  <h3>List of Events/Seminars</h3>
                  <form action="" method="POST" name="st_details" >
       <div class="form-group" style="margin-top:10px;">
       <div class="input-group ">
    <span class="input-group-addon glyphicon glyphicon-search"></span>
        <input type="text" onkeyup="myFunction()" id="myInput" class="form-control" placeholder="Enter event to search"  style="width:60%; height:30px; float: center; ">
      </div>
      </div>
       </form>
                  <div id="table-wrapper">
                  <div id="table-scroll">
                 <table  id="table_athlete" class="table table-bordered table-striped table-hover table-responsive">
             <thead>    
       <tr style="background-color:#286090; color:white;">
       <th>Event Name</th>
       <th>Event Type</th>
       <th>Venue</th>
       <th>Date</th>
       <th>Apply</th>
       </tr>
       </thead>
                  <?php
                
                  while($row=mysqli_fetch_array($result))
                   {    $name=$row['event_name'];
			            $type=$row['event_type'];
						$venue=$row['event_venue'];
	                    $date=$row['event_date'];
						$eid=$row['event_id'];
						
						
                    ?>
                    <tbody>
						<tr id="tr">
         <td style=" background-color:white;" ><?php echo $name;?></td>
         <td style=" background-color:lightgreen;"><?php echo $type; ?></td>
         <td style="background-color:lightyellow;"><?php echo $venue;?></td>
         <td style="background-color:lightgrey;"><?php echo $date;?></td>
         
         <td style="background-color:lightgreen;" ><a href="#?c=<?php echo $eid;?>"><button type='submit' class='btn btn-primary' name='viewPhone'><span class='glyphicon glyphicon-check'></span> Update/Remove</button></a></td>
         </tr>
         </tbody>
         
    <?php 


						
			}
			?>
           </table>
           </div>
           </div>
           <a href="all_event_pdf.php"><button class="btn" style="width:20%;background-color:maroon;color:white;float:right;margin-top:10px;"><span class="glyphicon glyphicon-file"></span> Export to pdf?</button></a>
           <?php
}
?>