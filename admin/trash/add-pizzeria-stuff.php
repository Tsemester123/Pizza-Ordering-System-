<?php include('partials/menu.php'); ?>

<div class = "main-content ">

<div class ="wrapper"> 

<h1> Add Pizzeria Stock  </h1>

<br> <br>

<?php



if(isset($_SESSION['upload']))
{

    echo $_SESSION['upload'];
    unset($_SESSION['upload']);

}














?>
<form action="" method="post" enctype="multipart/form-data">


<table class="tbladmin">

<tr> 

<td> Title :</td>

<td>
<input type="text" name="title" placeholder="Title Of The Item ">

</td>


</tr>



<tr>

<td>Description:</td>

<td>
<textarea name="description" cols="30" rows="5"  placeholder="Description Of The Item"></textarea>

</td>


</tr>


<tr> 

<td> Price :</td>

<td>
<input type="number" name="price" >

</td>


</tr>
<tr> 

<td> Picture:</td>

<td>
<input type="file" name="image" >

</td>


</tr>

<tr> 

<td> Category:  </td>

<td>
<select name="category" >

<?php

$sql2 = "SELECT * FROM tbl_category WHERE active='Yes'";

$res2=mysqli_query($conn,$sql2);

$count=mysqli_num_rows($res2);


if($count>0)
{


    while($row=mysqli_fetch_assoc($res2)){

        $id=$row['id'];
        $title=$row['title'];
        ?>


           <option value="<?php echo $id; ?> "><?php echo $title; ?>  </option>
        <?php

    }

}


else{


    ?>
     <option value="0">No Category Found </option>

    <?php
}
?>
 


</select>

</td>


</tr>

<tr> 

<td>Featured:</td>

<td>
<input type="radio" name="featured" value="Yes" >Yes 
<input type="radio" name="featured" value="No" >No

</td>
</tr>


<tr> 

<td>Active:</td>

<td>
<input type="radio" name="active" value="Yes" >Yes 
<input type="radio" name="active" value="No" >No

</td>


</tr>


<tr>


<td colspan="2">
    <input type="submit" name="submit" value="Add Stock" class="btn-secondary">
</td>
</tr>



</table>



</form>

<?php

if(isset($_POST['submit'])) {


    
$title=$_POST['title'];


if(isset($_POST['featured']))
{

$featured=$_POST['featured'];

}


else{

    $featured="No";
}


if(isset($_POST['active']))
{

$active=$_POST['active'];

}
else{

    $active="No";
}



if(isset($_FILES['image']['name']))
{


     $image_name=$_FILES['image']['name'];

     if($image_name!="")
     {

      $ext=end(explode('-',$image_name));

      $image_name="Pizzeria_Stock_".rand(000,999).'.'.$ext;
     
      
     $srce=$_FILES['image']['tmp_name'];

    $dest="stuffimages/".$image_name;

      $upload=move_uploaded_file($srce,$dest);


     if($upload==false)
     {

  $_SESSION['upload']="<div class='error'> Failed to add image try again.</div>";

  //redirect to main page 
    header("location:" . SITEURL . 'admin/add-pizzeria-stuff.php');
    die();
}

}

}

else{

    $image_name="";
}

$sql="INSERT INTO tbl_stock
 SET 
 title='$title', 
 descriptions='$description',
 price=$price,
 image_name='$image_name',
 category=$category,
 featured='$featured', 
 active='$active'
  "; 



$res = mysqli_query($conn, $sql);

if($res==true) {

         $_SESSION['add'] =  "<div class='success'> Items Added Succesfully.</div>";

  //redirect to main page 
    header("location:" . SITEURL . 'admin/manage-pizzeria-stuff.php');
}

 else {
       $_SESSION['add'] =  "<div class='error'> Failed To Add Items  . Try Again.</div>";

    //redirect to main page 
    header("location:" . SITEURL . 'admin/manage-pizzeria-stuff.php');
}

}

?>


</div>
</div>

<?php include('partials/footer.php'); ?>