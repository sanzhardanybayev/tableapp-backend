<?php

require_once('./modules/db.php');


header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    switch($_POST['type']){
        case "saveUser":

            if($preparedStatement = $conn->prepare("INSERT INTO users (name, surname, patronymic, email, password, username, id_number) VALUES (?, ?, ?,?, ?, ?, ?)")) {

                $preparedStatement->bind_param("sssssss", $name, $surname, $patronymic, $email, $password, $username, $id_number);

                $name = $_POST['name'];
                $surname= $_POST['surname'];
                $patronymic= $_POST['patronymic'];
                $email= $_POST['email'];
                $password= $_POST['password'];
                $username= $_POST['username'];
                $id_number= $_POST['id_number'];

                $preparedStatement->execute();

                // set the actual code
                http_response_code("200");
                // set the header to make sure cache is forced
                header("Cache-Control: no-transform,public,max-age=300,s-maxage=900");
                // treat this as json
                header('Content-Type: application/json');
                header('Status: 200');
                echo json_encode(array('user_id' =>  $conn->insert_id));

                $preparedStatement->close();

            } else {
                header_remove();
                // set the actual code
                http_response_code("400");
                // set the header to make sure cache is forced
                header("Cache-Control: no-transform,public,max-age=300,s-maxage=900");
                header('Access-Control-Allow-Origin: *');
                // treat this as json
                header('Content-Type: application/json');
                header('Status: 400');
                echo json_encode(array('status' => mysqli_stmt_error($preparedStatement)));

            }
            return "Good!";
            break;
    }
}elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    switch ($_GET['type']) {
        case 'users':
            $query = "SELECT id,name,surname,patronymic,email,username,id_number FROM users";
            if ($result = $conn->query($query)) {

                if ($result->num_rows > 0) {
                    // output data of each row

                    $users = array();
                    while ($row = $result->fetch_assoc()) {
                        $user = ['id' => $row['id'], 'name' => $row['name'], 'surname' => $row['surname'],
                            'patronymic' => $row['patronymic'], 'email' => $row['email'], 'username' => $row['username'],
                            'id_number' => $row['id_number']];
                        array_push($users, $user);
                    }

                    header_remove();
                    // set the actual code
                    http_response_code("200");
                    // set the header to make sure cache is forced
                    header("Cache-Control: no-transform,public,max-age=300,s-maxage=900");
                    header('Access-Control-Allow-Origin: *');
                    // treat this as json
                    header('Content-Type: application/json');
                    header('Status: 200');

                    echo json_encode(array('users' => $users));
                } else {
                    echo "0 results";
                }


                /* очищаем результирующий набор */
                $result->close();

            }
            break;
        case 'tasks':

            $conn->set_charset("utf8");

            $query = "SELECT tasks.id,tasks.name,tasks.description,tasks.date,
                      users.name as username, users2.name as username2
                      FROM tasks as tasks 
                      INNER JOIN users as users ON tasks.`from` = users.id 
                      INNER JOIN users as users2 ON tasks.`to` = users2.id";
            if ($result = $conn->query($query)) {

                if ($result->num_rows > 0) {
                    // output data of each row

                    $tasks = array();
                    while ($row = $result->fetch_assoc()) {
                        $task = ['id' => $row['id'], 'name' => $row['name'],'username' => $row['username'],
                            'description' => $row['description'],'username2' => $row['username2'],
                            'date' => $row['date']];
                        array_push($tasks, $task);
                    }

                    header_remove();
                    // set the actual code
                    http_response_code("200");
                    // set the header to make sure cache is forced
                    header("Cache-Control: no-transform,public,max-age=300,s-maxage=900");
                    header('Access-Control-Allow-Origin: *');
                    // treat this as json
                    header('Content-Type: application/json');
                    header('Status: 200');

                    echo json_encode(array('tasks' => $tasks));
                } else {
                    echo "0 results";
                }


                /* очищаем результирующий набор */
                $result->close();
                break;
            }
    }
}
$conn->close();