<?php include "includes/admin_header.php" ?>
  <!-- Navigation-->
  <?php include "includes/admin_navigation.php" ?>


        <li class="breadcrumb-item active"> / Dashboard</li>
      </ol>
      <!-- Icon Cards-->
      <div class="row">
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-primary o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-file-text"></i>
              </div>

              <div class="mr-5"> <?php echo $news_count = recordCount('news'); ?> Novih objava!</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="news.php">
              <span class="float-left">Više detalja</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-warning o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-comments"></i>
              </div>

              <div class="mr-5"> <?php echo $comments_count = recordCount('comments'); ?> Novih komentara! </div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="comments.php">
              <span class="float-left">Više detalja</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-success o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-user"></i>
              </div>

              <div class="mr-5"> <?php echo $users_count = recordCount('users'); ?> Nova korisnika!</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="users.php">
              <span class="float-left">Više detalja</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-danger o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-list"></i>
              </div>

              <div class="mr-5"> <?php echo $categories_count = recordCount('categories'); ?> Novih kategorije!</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="categories.php">
              <span class="float-left">Više detalja</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
      </div>

      <?php

      $news_draft_count = checkStatus('news', 'news_status', 'Draft');

      $news_onemoguci_count = checkStatus('news', 'news_status', 'Onemoguci');

      $news_objavi_count = checkStatus('news', 'news_status', 'Objavi');

      $comments_unapproved_count = checkStatus('comments', 'comment_status', 'unapproved');

      $subscribers_count = checkStatus('users', 'user_role', 'subscriber');

      ?>

      <!-- Area Chart Example-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-area-chart"></i> Statistika</div>
           <script type="text/javascript">
               google.charts.load('current', {'packages':['bar']});
               google.charts.setOnLoadCallback(drawChart);

               function drawChart() {
                   var data = google.visualization.arrayToDataTable([
                     ['Data', 'Count'],

                     <?php
                     $elemet_text = ['Sve vijesti', 'Objavljene vijesti', 'Spremljene(draft) vijesti', 'Neobjavljene vijesti', 'Komentari', 'Neobjavljeni komentari', 'Korisnici', 'Subscribers', 'Kategorije'];
                     $element_count = [$news_count, $news_objavi_count, $news_draft_count, $news_onemoguci_count, $comments_count, $comments_unapproved_count, $users_count, $subscribers_count, $categories_count];

                     for ($i=0; $i < 9; $i++) {
                         echo "['{$elemet_text[$i]}'" . "," . "{$element_count[$i]}],";
                     }

                      ?>

                   ]);

                   var options = {
                     chart: {
                       title: '',
                       subtitle: '',
                     }
                   };

                   var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                   chart.draw(data, google.charts.Bar.convertOptions(options));
                   }
               </script>
        <div class="card-body">
          <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
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
