<div class="col-md-4">
    <!-- News Search Well -->
    <div class="well">
        <h4>News pretraga</h4>
        <form action="search.php" method="post">
            <div class="input-group">
                <input name="search" type="text" class="form-control">
                <span class="input-group-btn">
                    <button name="submit" class="btn btn-default" type="submit">
                        <span class="fa fa-search fa-lg"></span>
                </button>
                </span>
            </div>
        </form>
        <!-- /.input-group -->
    </div>

    <br>

    <!-- News login Well -->
    <div class="well">



                <?php
                if (isset($_SESSION['user_role'])) { ?>
                    <h4>Dobro došli, <?php  echo $_SESSION['username']; ?></h4>
                    <a href="includes/logout.php">Odjava</a>
                <?php }else { ?>
                    <h4>Prijava korisnika</h4>
                    <form action="includes/login.php" method="post">
                    <div class="form-group">
                        <input name="username" type="text" class="form-control" placeholder="Username">
                    </div>
                    <div class="input-group">
                        <input name="password" type="password" class="form-control" placeholder="Lozinka">
                        <span class="input-group-bzn">
                            <button class="btn btn-primary" type="submit" name="login">Prijava</button>
                        </span>
                    </div>

                        <a href="registration.php">Registracija novih korisnika</a>
                        </form>
                <?php } ?>


        <!-- /.input-group -->
    </div>

    <br>

    <!-- News Categories Well -->
    <div class="well">
        <?php
        $query = "SELECT * FROM categories";
        $select_cat_sidebar = mysqli_query($conn, $query);
         ?>

        <h4>News kategorije</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">
                    <?php
                    while ($row = mysqli_fetch_assoc($select_cat_sidebar)) {
                        $cat_title = $row['cat_title'];
                        $cat_id = $row['cat_id'];

                        echo "<li>
                                <a href='category.php?category=$cat_id'>{$cat_title}</a>
                              </li>";
                        }
                     ?>
                </ul>
            </div>
            <!-- /.col-lg-6 -->
            <!-- <div class="col-lg-6">
                <ul class="list-unstyled">
                    <li><a href="#">Category Name</a>
                    </li>
                    <li><a href="#">Category Name</a>
                    </li>
                    <li><a href="#">Category Name</a>
                    </li>
                    <li><a href="#">Category Name</a>
                    </li>
                </ul>
            </div> -->
            <!-- /.col-lg-6 -->
        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
    <?php include "includes/widget.php" ?>

</div>
