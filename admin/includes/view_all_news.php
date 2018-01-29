<div class="row">
    <div class="col">

        <?php
        if (isset($_POST['checkBoxArray'])) {
            foreach ($_POST['checkBoxArray'] as $newsValueId) {

                $bulk_options = $_POST['bulk_options'];

                switch ($bulk_options) {
                    case 'Objavi':
                        $query = "UPDATE news SET news_status = '{$bulk_options}' WHERE news_id = $newsValueId";
                        $update_to_objavi_status = mysqli_query($conn, $query);
                        confirmQuery($update_to_objavi_status);
                        break;

                    case 'Draft':
                        $query = "UPDATE news SET news_status = '{$bulk_options}' WHERE news_id = $newsValueId";
                        $update_to_draft_status = mysqli_query($conn, $query);
                        confirmQuery($update_to_draft_status);
                        break;

                    case 'Onemoguci':
                        $query = "UPDATE news SET news_status = '{$bulk_options}' WHERE news_id = $newsValueId";
                        $update_to_onemoguci_status = mysqli_query($conn, $query);
                        confirmQuery($update_to_onemoguci_status);
                        break;

                    case 'clone':
                        $query = "SELECT * FROM news WHERE news_id = '{$newsValueId}'";
                        $select_news_query = mysqli_query($conn, $query);

                        confirmQuery($select_news_query);

                        while ($row = mysqli_fetch_array($select_news_query)) {
                            $news_title = $row['news_title'];
                            $news_author = $row['news_author'];
                            $news_date = $row['news_date'];
                            $news_image = $row['news_image'];
                            $news_content = substr($row['news_content'], 0, 79) . "...";
                            $news_tag = $row['news_tag'];
                            $news_comment_count = $row['news_comment_count'];
                            $news_status = $row['news_status'];
                            $news_cat_id = $row['news_cat_id'];
                        }

                            $query = "INSERT INTO news(news_cat_id, news_title, news_author, news_date,
                                news_image, news_content, news_tag, news_comment_count, news_status) ";
                            $query .= "VALUES({$news_cat_id}, '{$news_title}', '{$news_author}', now(),
                            '{$news_image}', '{$news_content}', '{$news_tag}', $news_comment_count, '{$news_status}' ) ";

                            $create_news_query = mysqli_query($conn, $query);

                            confirmQuery($create_news_query);

                        break;

                    default:
                        # code...
                        break;
                }

            }
        }


         ?>
        <form class="" action="" method="post">
            <div class="row">
                <div class="col-4" id="bulkOptionsContainer">
                    <select class="form-control" name="bulk_options">
                        <option value="">Odaberi</option>
                        <option value="Objavi">Objavi označene</option>
                        <option value="Draft">Spremi kao nedovršene</option>
                        <option value="Onemoguci">Onemogući označene</option>
                        <option value="clone">Kloniraj --> SAMO ZA TESTIRANJE</option>
                    </select>
                </div>
                <div class="col-4">
                    <input type="submit" name="submit" value="Primjeni" class="btn btn-success">
                    <a class="btn btn-primary" href="news.php?source=add_news.php">Dodaj novu vijest</a>
                </div>
                <br>
                <br>
            </div>

        <table class="table table-bordered table-hover">

            <thead class="thead-dark">
                <tr>
                    <th><input id="selectAllBoxes" type="checkbox"></th>
                    <th>Id</th>
                    <th>Autor</th>
                    <th>Kategorija</th>
                    <th>Naslov</th>
                    <th>Broj pregleda</th>
                    <th>Datum</th>
                    <th>Slika</th>
                    <th>Tag</th>
                    <th>Komentar</th>
                    <th>Status</th>
                    <th colspan="2" style="text-align:center;">Akcija</th>
                </tr>
            </thead>
            <tbody>

                <?php

                $query = "SELECT news.news_id, news.news_author, news.news_title, news.news_cat_id, news.news_status, news.news_image, ";
                $query .= "news.news_tag, news.news_comment_count, news.news_date, news.news_views_count, news.news_content, categories.cat_id, categories.cat_title ";
                $query .= "FROM news ";
                $query .= "LEFT JOIN categories ON news.news_cat_id = categories.cat_id ORDER BY news.news_id DESC";

                $select_news = mysqli_query($conn, $query);


                confirmQuery($select_news);

                while ($row = mysqli_fetch_assoc($select_news)) {
                    $news_id = $row['news_id'];
                    $news_title = $row['news_title'];
                    $news_author = $row['news_author'];
                    $news_date = $row['news_date'];
                    $news_image = $row['news_image'];
                    $news_tag = $row['news_tag'];
                    $news_comment_count = $row['news_comment_count'];
                    $news_status = $row['news_status'];
                    $news_cat_id = $row['news_cat_id'];
                    $news_views_count = $row['news_views_count'];
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];
                ?>

                <tr>
                    <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $news_id; ?>'></td>
            <?php
            echo     "<td>{$news_id}</td>
                      <td>{$news_author}</td>
                      <td>{$cat_title}</td>
                      <td><a href='../post.php?p_id={$news_id}'>{$news_title}<a/></td>
                      <td><a onClick=\"javascript: return confirm('Jeste li sigurni da želite resetirati brojač pregleda vijesti?'); \" href='news.php?reset={$news_id}'>{$news_views_count}</a</td>
                      <td>{$news_date}</td>
                      <td><img width=100 src='../images/$news_image' alt='image'</td>
                      <td>{$news_tag}</td>
                      <td>{$news_comment_count}</td>
                      <td>{$news_status}</td>
                      <td align='center'><a onClick=\"javascript: return confirm('Jeste li sigurni da želite obrisati'); \" href='news.php?delete={$news_id}'>
                      <i class='fa fa-trash' aria-hidden='true'></i>
                      </a></td>
                      <td align='center'><a href='news.php?source=edit_news&p_id={$news_id}'>
                      <i class='fa fa-pencil' aria-hidden='true'></i>
                      </a></td>
                  </tr>";
              } ?>
            </tbody>
        </table>
    </form>

        <?php
        if (isset($_GET['delete'])) {
            $news_id = $_GET['delete'];

            $query = "DELETE FROM news WHERE news_id = {$news_id} ";
            $del_query = mysqli_query($conn, $query);

            header("Location: news.php");
        }

        if (isset($_GET['reset'])) {
            $news_id = $_GET['reset'];

            $query = "UPDATE news SET news_views_count = 0 WHERE news_id = {$news_id} ";
            $reset_query = mysqli_query($conn, $query);

            header("Location: news.php");
        }


         ?>
