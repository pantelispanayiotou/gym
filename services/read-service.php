<?php require_once('../connect.php'); 
session_start();
?>
    <div class="container">
        <br>
      <br>
           <?php
        $sql = "SELECT * FROM services";
        $result = $DBcon->query($sql);
        $numOfCols = 3;
        $rowCount = 0;
        
            ?>
        <div class="row padding-row">
            <?php 
        while($row = $result->fetch(PDO::FETCH_ASSOC)){ ?>
           
    

                     <div class="col-md-4 col-margin">
                         
     <?php  if($_SESSION['customer_id']>=1){
     if ($_SESSION['role']=='Admin') { ?>
                         <a class="edit-link" data-toggle="modal" data-target="#modal<?php echo $row["service_id"]; ?>">
                             <i class="fas fa-pencil-alt"> </i>
                         </a>
                 
                         
                         <a class="edit-link" id="delete-product" data-id="<?php echo $row["service_id"];?>" href="javascript:void(0)"> <i class="fa fa-trash"> </i></a>
                         
            <?php  }
     } ?>
            <div class="card">
  <img class="card-img-top" src="../uploads/<?php echo $row["image"];?>" alt="">
  <div class="card-body">
    <h5 class="card-title"><?php echo $row["title"] ?></h5>
    <p class="card-text"><?php echo $row["description"] ?></p>
    <p class="card-text"><b>Capacity: </b> <?php echo $row["capacity"] ?></p>
  </div>
            
            </div>
            </div>

    <?php
    $rowCount++;
    if($rowCount % $numOfCols == 0) echo '</div><div class="row padding-row">'; ?>

 <div class="modal fade" id="modal<?php echo $row["service_id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
         
        <h5 class="modal-title" id="exampleModalLabel">Edit Service</h5>
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
           
          
      </div>
        
                
                  
      
      <div class="modal-body">
          <div class="error-info-update<?php echo $row["service_id"]; ?>">
          </div>
        <!-- Form register -->
                            <div class="row center-div">
      <div class="container">
          
          <form class="form" id="edit-product<?php echo $row["service_id"]; ?>" method="POST">
              <div class="form-group">
              <input type="hidden" name="id" id="product-id" value="<?php echo $row["service_id"]; ?>">
              </div>
              <div class="form-group">
                  <label class="form-label" for="title">Service Title</label>
                  <input type="text" class="form-control" id="title" name="title"  tabindex="1" value="<?php echo $row["title"]; ?>" required>
              </div>              
               <div class="form-group">
                  <label class="form-label" for="message">Service Description</label>
                  <input type="text" class="form-control" id="desc" name="description" value="<?php echo $row["description"]; ?>" tabindex="2" required>                               
              </div>
              <div class="form-group">
                  <label class="form-label" for="email"> Capacity</label>
                  <input type="text" class="form-control" id="capacity" name="capacity" tabindex="2" value="<?php echo $row["capacity"]; ?>" required>
              </div>                            
              <div class="form-group">
                  <label class="form-label" for="subject">Picture of Service</label>
                  <input type="file" class="form-control" name="file" id="file" >
              </div>                             
             
              <div class="text-center">
                  <button type="submit" value="<?php echo $row["service_id"]; ?>" onclick="update(this.value,event)" id="edited-product" name="submit" class="btn btn-start-order">SAVE</button>
              </div>
          </form>
      </div>
  </div>
      </div>
      
    </div>
  </div>
</div>                                     
                                                 
                                                      
                                                     <?php } ?>
            
            
           
            
            </div>
         <br>
        </div>
      