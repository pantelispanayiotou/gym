<?php require_once('../connect.php'); 
?>
    <div class="container">
        <br>
      <br>
           <?php
        $sql = "SELECT * FROM products";
        $result = $DBcon->query($sql);
        $numOfCols = 3;
        $rowCount = 0;
        
            ?>
        <div class="row padding-row">
            <?php 
        while($row = $result->fetch(PDO::FETCH_ASSOC)){ ?>
           
    

                     <div class="col-md-4 col-margin">
                         <a class="edit-link" href="edit-product.php?id=<?php echo $row["id"];?>"> <i class="fas fa-pencil-alt"></i> </a>
                         <a class="edit-link" id="delete-product" data-id="<?php echo $row["id"];?>" href="javascript:void(0)"> <i class="fa fa-trash"> </i></a>
            <div class="card card-width">
  <img class="card-img-top" src="../img/shop1.jpg" alt="">
  <div class="card-body">
    <h5 class="card-title"><?php echo $row["name"] ?></h5>
    <p class="card-text"><?php echo $row["description"] ?></p>
    <p class="card-text"><b>Price: </b> €<?php echo $row["price"] ?></p>
  </div>
            
            </div>
            </div>

    <?php
    $rowCount++;
    if($rowCount % $numOfCols == 0) echo '</div><div class="row padding-row">';
} ?>
           
            
            </div>
         <br>
        </div>
      