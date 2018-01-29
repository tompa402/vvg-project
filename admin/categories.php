<?php include "includes/admin_header.php" ?>
  <!-- Navigation-->
  <?php include "includes/admin_navigation.php" ?>



        <li class="breadcrumb-item active"> / Kategorije</li>
      </ol>



      <div class="row">
          <div class="col">


              <?php insertCategories(); ?>


            <form action="categories.php" method="post">
                <div class="form-group">
                    <label for="cat_title">Dodaj kategoriju</label>
                    <input class="form-control" type="text" name="cat_title" value="" required>
                </div>
                <div class="form-group">
                    <input class="btn btn-primary" type="submit" name="submit" value="Dodaj kategoriju">
                </div>
          </form>

          <hr>
          <?php // UPDATE AND INCLUDE QUERY
          if (isset($_GET['edit'])) {
              $cat_id = $_GET['edit'];
              include "includes/update_categories.php";
          } ?>

          </div>

          <div class="col">
              <table class="table table-bordered table-hover">
                  <thead class="thead-dark">
                      <tr>
                          <th>ID</th>
                          <th>Nativ kategorije</th>
                          <th colspan="2" style="text-align:center;">Akcija</th>
                      </tr>
                  </thead>
                  <tbody>
                      <?php findAllCategories(); ?>
                      <?php deleteCategory(); ?>
                  </tbody>
              </table>
            </div>


         </div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © TN NEWS BAR 2018</small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="login.html">Logout</a>
          </div>
        </div>
      </div>
    </div>


<?php include "includes/admin_footer.php" ?>
