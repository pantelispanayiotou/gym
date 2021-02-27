<?php require_once('../connect.php'); 
session_start();
?>
    <div class="container">
        <br>
      <br>
           <?php
        $sql = "SELECT * FROM prices";
        $result = $DBcon->query($sql);
       
        
            ?>
       <div class="accordion" id="accordionExample">
            <?php 
        while($row = $result->fetch(PDO::FETCH_ASSOC)){ ?>
           
    

                    
                         
                         
                         
           
           
           <div class="card">
    <div class="card-header" id="heading<?php echo $row["id"];?>">
       <?php  if($_SESSION['customer_id']>=1){
     if ($_SESSION['role']=='Admin') { ?>
        <div class="admin-panel-prices">
            <a class="edit-link" data-toggle="modal" data-target="#modal<?php echo $row["id"]; ?>">
                             <i class="fas fa-pencil-alt"> </i>
                         </a>
                         <a class="edit-link" id="delete-product" data-id="<?php echo $row["id"];?>" href="javascript:void(0)"> <i class="fa fa-trash"> </i></a>
                </div>
        <?php  }
     } ?>
      <h5 class="mb-0 ">
        <button class="btn btn-link prices-titles" type="button" data-toggle="collapse" data-target="#collapse<?php echo $row["id"];?>" aria-expanded="true" aria-controls="collapse<?php echo $row["id"];?>">
            <h5> <i class="fas fa-plus"></i> <?php echo $row["title"]; ?></h5>
            
        </button>
      </h5>
    </div>

    <div id="collapse<?php echo $row["id"];?>" class="collapse" aria-labelledby="heading<?php echo $row["id"];?>" data-parent="#accordionExample">
      <div class="card-body">
          <h4>Price: €<?php echo $row["price"]; ?> </h4>
          <p>Description: <?php echo $row["description"]; ?></p>
      </div>
    </div>
  </div>
           
          

   

 <div class="modal fade" id="modal<?php echo $row["id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
         
        <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
           
          
      </div>
        
                
                  
      
      <div class="modal-body">
         <div class="error-info-update<?php echo $row["id"]; ?>">
          </div>
        <!-- Form register -->
                            <div class="row center-div">
      <div class="container">
          
          <form class="form" id="edit-product<?php echo $row["id"]; ?>" method="POST">
              <div class="form-group">
              <input type="hidden" name="id" id="product-id" value="<?php echo $row["id"]; ?>">
              </div>
              <div class="form-group">
                  <label class="form-label" for="title">Title</label>
                  <input type="text" class="form-control" id="title" name="ptitle"  tabindex="1" value="<?php echo $row["title"]; ?>" required>
              </div>              
               <div class="form-group">
                  <label class="form-label" for="message">Item Description</label>
                  <input type="text" class="form-control" id="desc" name="description" value="<?php echo $row["description"]; ?>" tabindex="2" required>                               
              </div>
              <div class="form-group">
                  <label class="form-label" for="email">Item Price</label>
                  <input type="text" class="form-control" id="price" name="price" tabindex="2" value="<?php echo $row["price"]; ?>" required>
              </div>                                                        
             
              <div class="text-center">
                  <button type="submit" value="<?php echo $row["id"]; ?>" onclick="update(this.value,event)" id="edited-product" name="submit" class="btn btn-start-order">SAVE</button>
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
            
           
            
            </div>
         <br>
    
      