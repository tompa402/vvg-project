<?php

function escape($string){
    global $conn;
    return mysqli_real_escape_string($conn, trim($string));
}

function confirmQuery($result){
    global $conn;
    if (!$result) {
        die("QUERY FAILED" . mysqli_error($conn));
    }
}
function insertCategories(){
    global $conn;
    if (isset($_POST['submit'])) {
        $cat_title = $_POST['cat_title'];

        if ($cat_title == "" || empty($cat_title)) {
            echo "<h3>Unos naziva kategorije je obavezan!</h3>";
        }else {
            $query = "INSERT INTO categories(cat_title) ";
            $query .= "VALUE ('{$cat_title}') ";

            $create_cat = mysqli_query($conn, $query);

            if (!$create_cat) {
                die('Query failed.' . mysqli_error($conn));
            }else {
                echo "<h3>Uspješan unos kategorije</h3><hr>";
            }
        }
    }
}

function findAllCategories(){
    global $conn;
    $query = "SELECT * FROM categories";
    $select_cat = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($select_cat)) {
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];

        echo "<tr>
                  <td>{$cat_id}</td>
                  <td>{$cat_title}</td>
                  <td align='center'><a onClick=\"javascript: return confirm('Jeste li sigurni da želite obrisati'); \" href='categories.php?delete={$cat_id}'>
                  <i class='fa fa-trash' aria-hidden='true'></i>
                  </a></td>
                  <td align='center'><a href='categories.php?edit={$cat_id}'>
                  <i class='fa fa-pencil' aria-hidden='true'></i>
                  </a></td>
              </tr>";
          }
}

function deleteCategory(){
    global $conn;
    if (isset($_GET ['delete'])) {
        $del_cat_id = $_GET ['delete'];

        $query = "DELETE FROM categories WHERE cat_id = {$del_cat_id}";
        $delete_query = mysqli_query($conn, $query);

        header("Location: categories.php");
    }
}

function findAllComments(){
    global $conn;
    $query = "SELECT * FROM comments";
    $select_comments = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($select_comments)) {
        $comment_id = $row['comment_id'];
        $comment_news_id = $row['comment_news_id'];
        $comment_author = $row['comment_author'];
        $comment_email = $row['comment_email'];
        $comment_content = $row['comment_content'];
        $comment_status = $row['comment_status'];
        $comment_date = $row['comment_date'];

        echo "<tr>
                  <td>{$comment_id}</td>
                  <td>{$comment_author}</td>
                  <td>{$comment_content}</td>";
        echo     "<td>{$comment_email}</td>
                  <td>{$comment_status}</td>";

                  $query = "SELECT * FROM news WHERE news_id = $comment_news_id ";
                  $select_news_id_query = mysqli_query($conn, $query);

                  while ($row = mysqli_fetch_assoc($select_news_id_query)){
                      $news_id = $row['news_id'];
                      $news_title = $row['news_title'];
                  }

        echo     "<td><a href='../post.php?p_id=$news_id'>$news_title</a></td>
                  <td>{$comment_date}</td>

                  <td align='center'><a href='comments.php?approve=$comment_id'>
                  <i class='fa fa-check' aria-hidden='true'></i>
                  </a></td>
                  <td align='center'><a href='comments.php?unapprove=$comment_id'>
                  <i class='fa fa-times' aria-hidden='true'></i>
                  </a></td>
                  <td align='center'><a href='news.php?source=edit_news&p_id='>
                  <i class='fa fa-pencil' aria-hidden='true'></i>
                  </a></td>
                  <td align='center'><a onClick=\"javascript: return confirm('Jesteli sigurni da želite obrisati'); \" href='comments.php?delete=$comment_id'>
                  <i class='fa fa-trash' aria-hidden='true'></i>
              </tr>";
          }
}

function findAllUsers(){
    global $conn;
    $query = "SELECT * FROM users ORDER BY user_id DESC ";
    $select_users= mysqli_query($conn, $query);

    confirmQuery($select_users);

    while ($row = mysqli_fetch_assoc($select_users)) {
        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_role = $row['user_role'];

        echo "<tr>
                  <td>{$user_id}</td>
                  <td>{$username}</td>
                  <td>{$user_firstname}</td>";
        echo     "<td>{$user_lastname}</td>
                  <td>{$user_email}</td>
                  <td>{$user_role}</td>";
        echo     "<td align='center'><a href='users.php?change_to_admin={$user_id}'>
                  <i class='fa fa-check' aria-hidden='true'></i>
                  </a></td>
                  <td align='center'><a href='users.php?change_to_sub={$user_id}'>
                  <i class='fa fa-times' aria-hidden='true'></i>
                  </a></td>
                  <td align='center'><a href='users.php?source=edit_user&edit_user={$user_id}'>
                  <i class='fa fa-pencil' aria-hidden='true'></i>
                  </a></td>
                  <td align='center'><a onClick=\"javascript: return confirm('Jesteli sigurni da želite obrisati'); \" href='users.php?delete={$user_id}'>
                  <i class='fa fa-trash' aria-hidden='true'></i>
              </tr>";
          }
}

//SELECT all from specific table
function recordCount($table){
    global $conn;
    $query = "SELECT * FROM " . $table;
    $select_all = mysqli_query($conn, $query);
    $result = mysqli_num_rows($select_all);

    confirmQuery($result);

    return $result;

}

//SELECT status(count) for Dashboar statistic
function checkStatus($table, $column, $status){
    global $conn;
    $query = "SELECT * FROM $table WHERE $column = '$status'";
    $result = mysqli_query($conn, $query);

    confirmQuery($result);

    return mysqli_num_rows($result);

}

 ?>
