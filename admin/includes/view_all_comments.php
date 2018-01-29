<div class="row">
    <div class="col">
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>Id</th>
                    <th>Autor</th>
                    <th>Komentar</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Odgovor na</th>
                    <th>Date</th>
                    <th colspan="2" style="text-align:center;">Odobri</th>
                    <th colspan="2" style="text-align:center;">Akcija</th>
                </tr>
            </thead>
            <tbody>
                <?php findAllComments(); ?>
            </tbody>
        </table>

        <?php
        if (isset($_GET['unapprove'])) {
            $the_comment_id = $_GET['unapprove'];

            $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = $the_comment_id ";
            $unapprove_query = mysqli_query($conn, $query);

            header("Location: comments.php");
        }

        if (isset($_GET['approve'])) {
            $the_comment_id = $_GET['approve'];

            $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = $the_comment_id ";
            $approve_query = mysqli_query($conn, $query);

            header("Location: comments.php");
        }





        if (isset($_GET['delete'])) {
            $the_comment_id = $_GET['delete'];

            $query = "DELETE FROM comments WHERE comment_id = {$the_comment_id} ";
            $del_query = mysqli_query($conn, $query);

            header("Location: comments.php");
        }


         ?>
