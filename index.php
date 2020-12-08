<html>
  <head>
    <title>Todo App</title>
    <link href='https://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/todoApp.css" type="text/css" media="screen" charset="utf-8">    
  </head>
  <body>
    <div class="container">
      <p>
      <label> <span> <h1> LIST </h1></span> </label>
        <form action="php/addTask.php" method="post" id="form">
          <label for="new_task"> Add Task </label>
          <input type="text" id="new_task" name="new_task" placeholder="Task here"></imput>
          <button type="submit">ADD</button>
        </form>
      </p>
      
      <h3>Todo</h3>
      <ul id="incomplete-tasks">
        <li>
          <input type="checkbox">
          <label>Uncompleted task 1</label>
          <input type="text"><button class="edit">Edit</button>
          <button class="delete">Delete</button>
        </li>
      </ul>
      
      <h3>Completed</h3>
      <ul id="completed-tasks">
        <li>
          <input type="checkbox" checked>
          <label>Completed task 1</label><input type="text">
          <button class="edit">Edit</button>
          <button class="delete">Delete</button>
      </li>
      </ul>
    </div>

    <script type="text/javascript" src="js/todoApp.js"></script>

  </body>
</html>