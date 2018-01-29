<div class="row">
    <div class="col">
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>Id</th>
                    <th>Username</th>
                    <th>Ime</th>
                    <th>Prezime</th>
                    <th>Email</th>
                    <th>Role(Uloga)</th>
                    <th colspan="2" style="text-align:center;">Admin </th>
                    <th colspan="2" style="text-align:center;">Akcija</th>
                </tr>
            </thead>
            <tbody>
                <?php findAllUsers(); ?>
            </tbody>
        </table>

        <?php
        if (isset($_GET['change_to_admin'])) {
            $the_user_id = $_GET['change_to_admin'];

            $query = "UPDATE users SET user_role = 'admin' WHERE user_id = $the_user_id ";
            $admin_query = mysqli_query($conn, $query);

            header("Location: users.php");
        }

        if (isset($_GET['change_to_sub'])) {
            $the_user_id = $_GET['change_to_sub'];

            $query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = $the_user_id ";
            $subscriber_query = mysqli_query($conn, $query);

            header("Location: users.php");
        }





        if (isset($_GET['delete'])) {

            if(isset($_SESSION['user_role'])){
                if ($_SESSION['user_role'] == 'admin') {
                    $the_user_id = mysqli_real_escape_string($conn,$_GET['delete']);

                    $query = "DELETE FROM users WHERE user_id = {$the_user_id} ";
                    $del_query = mysqli_query($conn, $query);

                    header("Location: users.php");
                }
            }

        }


         ?>
