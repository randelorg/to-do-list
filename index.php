<!--index.php-->

<?php
    include('php/ConnectToDB/Connect.php');

    $query = " SELECT * FROM task_list ORDER BY task_list_id DESC";

    $statement = $connect->prepare($query);

    $statement->execute();

    $result = $statement->fetchAll();
?>

<!DOCTYPE html>
<html>
  <head>
      <title>To-Do List</title>

      <link rel="icon" href="img/icon.png"/>
      <link rel="stylesheet" href="css/bootstrap.min.css" />
      <link rel="stylesheet" href="css/font.css" />

      <script src="js/googleapis.js"></script>
      <script src="js/bootstrap.min.js"></script>
  </head>
  <body>
    
      <br/>
      <br/>
      <div class="container">
      <h1 alignment="center">To-Do List</h1>
      <br/>

      <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-9">
                  <h3 class="panel-title">My To-Do List</h3>
                </div>
            <div class="col-md-3">  
            </div>
          </div>
        </div>
          <div class="panel-body">
          <form method="post" id="to_do_form">
            <span id="message"></span>
            <div class="input-group">
            <input type="text" name="task_name" id="task_name" class="form-control input-lg" autocomplete="off" placeholder="Name" />
            <div class="input-group-btn">
              <button type="submit" name="submit" id="submit" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-plus"></span></button>
            </div>
            </div>
          </form>
          <br />
          <div class="list-group">
            <?php
              //this will display the rows from the table
              foreach($result as $row)
              {
                $style = '';
                //if the status are considered yes
                //change the text-decoration to strike through
                if($row["task_status"] == 'yes')
                {
                  $style = 'text-decoration: line-through';
                }
                echo '<a href="#" style="'.$style.'" class="list-group-item" id="list-group-item-'.$row["task_list_id"].'" data-id="'.$row["task_list_id"].'">'.$row["task_details"].' <span class="badge" data-id="'.$row["task_list_id"].'">X</span></a>';
              }
              ?>
          </div>
          </div>
        </div>
      </div>
  </body>
</html>

<script>
 
 $(document).ready(function(){
  
  $(document).on('submit', '#to_do_form', function(event){
   event.preventDefault();

   if($('#task_name').val() == '')
   {
    $('#message').html('<div class="alert alert-danger">Enter Task Details</div>');
    return false;
   }
   else
   {
    $('#submit').attr('disabled', 'disabled');
    $.ajax({
     url:"php/NewTask.php",
     method:"POST",
     data:$(this).serialize(),
     success:function(data)
     {
      $('#submit').attr('disabled', false);
      $('#to_do_form')[0].reset();
      $('.list-group').prepend(data);
     }
    })
   }
  });

  $(document).on('click', '.list-group-item', function(){
   var task_list_id = $(this).data('id');
   $.ajax({
    url:"php/UpdateTask.php",
    method:"POST",
    data:{task_list_id:task_list_id},
    success:function(data)
    {
      $('#list-group-item-'+task_list_id).css('text-decoration', 'line-through');
    }
   })
  });

  $(document).on('click', '.badge', function(){
   var task_list_id = $(this).data('id');
   $.ajax({
    url:"php/DeleteTask.php",
    method:"POST",
    data:{task_list_id:task_list_id},
    success:function(data)
    {
      $('#list-group-item-'+task_list_id).fadeOut('slow');
    }
   })
  });

 });
</script>