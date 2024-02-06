
 <?php 
 $session=$this->request->getSession();
 ?>
<h1>Welcome to Your Website</h1>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    
    <script>
        $(document).ready(function () 
        {
          
            $(".dashboard").show();
            $("table").hide();

            $(".dashboard").click(function () 
            {
                $(".welcome").show();
                $("table").hide();
              
            });
 
 
            // Click event for Users
            $(".user-details").click(function () 
            {
                $(".welcome").hide();
                $("table").show();
              
            });
        });
    </script>

 <style>
     body {
    margin: 0;
    font-family: 'Arial', sans-serif;
}

header {
    background-color: #4CAF50; /* Green color, you can change it */
    color: #fff;
    padding: 15px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

header img {
    height: 40px;
}

.links-container {
    display: flex;
    height: calc(100vh - 60px); 
}

.sidebar {
    width: 20%;
    background-color: #333;
    padding: 10px;
    color: #fff;
}

.sidebar a {
    color: #fff;
    text-decoration: none;
    display: block;
    padding: 10px;
    margin-bottom: 5px;
    transition: background-color 0.3s;
}

.sidebar a:hover {
    background-color: #555; 
}

.main-content {
    width: 80%;
    padding: 20px;
    text-align: center;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

table, th, td {
    border: 1px solid #ddd;
}

th, td {
    padding: 12px;
    text-align: left;
}

th {
    background-color: #4CAF50; 
    color: #fff;
}

a {
    text-decoration: none;
    color: #4CAF50; 
}

a:hover {
    color: #45a049; 
}

.back-btn {
    display: inline-block;
    padding: 10px 15px;
    background-color: #333;
    color: #fff;
    text-decoration: none;
    margin-bottom: 20px;
    border-radius: 5px;
    transition: background-color 0.3s;
}

.back-btn:hover {
    background-color: #555; 
}


    </style>
    </head>
    <body>
        <header>
            <img src="evervent.jpeg" alt="">

            <a href="logout" style="color: black; text-decoration: none;">Logout</a> 
        </header>
        <div class="links-container">
            <div class="sidebar">
                <a class="dashboard" href="#">Dashboard</a>
                <a class="user-details" href="#">User Details</a>
            </div>
            <div class="main-content">
            <h1 id="welcome" class="welcome text-center">Welcome</h1>
            <table border="1">
            <tr>
                <th>S/no</th>
                <th>Name</th>
                <th>Email</th>
                <th>address</th>
                <th>phoneNumber</th>
            </tr>
           
            <?php $j=1; foreach ($users as $user):?>
                <tr id="userRow<?= $user->id ?>">

                    <td><?= $j; ?></td>
                    <td><?= $user->name ?></td>
                    <td><?= h($user->Email) ?></td>
                    <td><?= h($user->address) ?></td>
                    <td><?= ($user->phoneNumber) ?></td>
                        <?php $j++; endforeach; ?>
                    </table>
            <?= $this->fetch('postLink'); ?>
    </div>
    </div>
    </body>
    </html>