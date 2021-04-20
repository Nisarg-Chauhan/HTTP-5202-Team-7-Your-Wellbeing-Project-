<?php 
    session_start();
    include '../header.php';

    require_once '../Models/Database.php';
    require_once '../Models/users.php'; 
    require_once '../Models/Coaches.php';
     
     $dbcon=Database::getDb();
            
     $sql = "SELECT * from users where email = '".$_SESSION["login"]."'";
     $statement = $dbcon->prepare($sql);
     $statement->execute();
     $personal = $statement->fetchAll(PDO::FETCH_OBJ);


    // Getting coaches
    $new_coach = new Coach();
    $coaches =  $new_coach->getAllCoaches($dbcon);

    if (isset($_POST['add_coach'])) {
        
        foreach ($coaches as $coach){
        
    $check_coach = $coach->id;
    $n_coach=new User();
	$c=$n_coach->addCoach($check_coach, $dbcon);
    
} 
    
     
   } else {
            echo 'ups';
        }


      
    ?>
       
    

     
    
<link rel="stylesheet" type="text/css" href="../css/personal.css">
<main class="container-personal">
    <div class="column-left">
         <ul>
            <li><a href="plan.php">Diet planner</a> </li>
            <li><a href="exercise-list.php">My Exercises</a> </li>
            <li><a href="planner.php">My Planner</a> </li>
        </ul>
    </div>
       
    
	<div class="row">

 <?php	
		foreach($personal as $personal_data){
            
            echo '
      <div class="workout general table-responsive col-lg-12">
      <h1>Welcome Back ' .$personal_data->first_name.  '</h1>
       
       <table class="table table-striped">
  <tr>
    <th>Firstname</th>
    <th>Lastname</th>
    <th>Email</th>
    <th>Age</th>
    <th>Coach</th>
    <th></th>
  </tr>
  <tr>
    <td>' .$personal_data->first_name. '</td>
    <td>' .$personal_data->last_name. '</td>
    <td>' .$personal_data->email. '</td>
    <td>' .$personal_data->age. '</td>';
    
    } ?>
    
      <td> <select name="choose_coach"> <?php foreach ($coaches as $coach){
            
        echo '<option value="'.$coach->id.'">'.$coach->first_name.' '.$coach->last_name."</option>";
        
    } ?>
         </select></td> 
        <td> <button type="button" class="button" name="add_coach" value="Add Coach">Add Coach </button>
         </td>
  </tr>
  
</table>
      <h2 style="float:right;" ><a href = "../login/logout.php">Sign Out</a></h2>
      </div>
            
      <div> 
          <?php if(!isset($_SESSION['your_bmi'])){
    
            echo '<h4 style="float:left;"><a href="../bmi/bmi.php">Check your BMI</a></h4>';
} else {
    
            echo '<h4 style="float:left;">Your BMI '  .$_SESSION['your_bmi']; }'</h4>'

     ?>     

         
</div>
</main>
    
 <?php include '../footer.php';

?>