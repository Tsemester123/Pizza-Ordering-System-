  <?php include('Partials-Front/menu.php'); ?>

      <section class="res-search text_center">
        <div class="container">
        <?php

          $search=$_POST['search'];

        ?>
            
            <h2>Foods on Your Search <a href="#" class="text-white">"<?php echo $search; ?>"</a></h2>

        </div>
    </section>

  

  
    

    </section>

      <section class="pizza-menu">
            <div class="container ">
                <h2 class="text_center">Explore Pizza Menu</h2>
                <?php 

              

                
            $sql2= "SELECT * FROM tbl_category WHERE title LIKE '%$search%' OR description LIKE '%$search%'  ";

            $res2=mysqli_query($conn,  $sql2 );

            $count2=mysqli_num_rows($res2);

            if($count2>0 )
            {

              while($row2=mysqli_fetch_assoc($res2))
              {
             $id=$row2['id'];
             $description=$row2['description'];
             $price=$row2['price'];
             $title=$row2['title'];
              $image_name=$row2['image_name'];
              ?>

            <div class="pizza_menu_box">
                    <div class= "pizza-menu-img">
                        <?php 
                          if($image_name=="")
                          {

                   
                             echo  "<div class='error'> Image Not Available .</div> ";
                          }

                          else{
                               ?>
                                 
                                 <img src="<?php echo SITEURL ; ?>admin/stuffimages/<?php echo $image_name ;?>"  alt="" class="img-responsive  img-curve">
                               <?php 


                          }

                        ?>
                       
                    </div>
                    <div class="food-menu-des">
                        <h4><?php echo $title ?> </h4>
                        <p class="pizza-price">P <?php echo $price; ?></p>
                        <p class="pizza-detail"><?php  echo $description?></p>
                        <br>
                      <a href="<?php echo SITEURL;?>orders.php?item_id=<?php echo $id; ?>" class="btn-primary">Order Now</a>
                    </div>
                    
                </div>


            


              <?php 

              }

            }

            else{
            

                  echo  "<div class='error'> Category Not Available .</div> ";

            }

                ?>
               
                <div class="clear-fix"></div>


               

              

              

          
            </div>

      </section>



   

  <?php include('Partials-Front/footer.php'); ?>
</body>
</html>