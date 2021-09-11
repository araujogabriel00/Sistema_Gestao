<!DOCTYPE html>
<html lang="en">

<head>
    <title>Fan Club List</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>

    <?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "sistema";

    $limit = 3;

    $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    
    $s = $db->prepare("SELECT dia, hora FROM marcacao_ponto where id_user = 171");
    $s->execute();
    $allResp = $s->fetchAll(PDO::FETCH_ASSOC);
  
    var_dump($allResp);
    $total_results = $s->rowCount();
    $total_pages = ceil($total_results / $limit);

    if (!isset($_GET['page'])) {
        $page = 1;
    } else {
        $page = $_GET['page'];
    }


    $start = ($page - 1) * $limit;


    $stmt = $db->prepare("SELECT id, dia, hora FROM marcacao_ponto where id_user = 171 ORDER BY id DESC LIMIT $start, $limit");
    $stmt->execute();

    // set the resulting array to associative
    $stmt->setFetchMode(PDO::FETCH_OBJ);

    $results = $stmt->fetchAll();

    /* var_dump($results); */

    $conn = null;

    $no = $page > 1 ? $start + 1 : 1;


    ?>

    <div class="container">
        <h2 class="">Marcações Realizadas <span class="badge">Total: <?= $total_results; ?></span></h2>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Dia</th>
                    <th>Hora</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($results as $result) { ?>
                    <tr>
                        <td><?= $result->dia; ?></td>
                        <td><?= $result->hora; ?></td>
                        <?php
                        $refPerson = $db->prepare("SELECT nome_completo FROM users where id=$result->id");
                        $refPerson->execute();
                        $refPerson = $refPerson->fetch(PDO::FETCH_OBJ);
                        ?>
                    </tr>
                <?php $no++;
                } ?>
            </tbody>
        </table>
        <ul class="pagination">
            <li><a href="?page=1">Primeira</a></li>

            <?php for ($p = 1; $p <= $total_pages; $p++) { ?>

                <li class="<?= $page == $p ? 'active' : ''; ?>">
                    <a href="<?= '?page=' . $p; ?>"><?= $p; ?></a>
                </li>
            <?php } ?>
            <li>
                <a href="?page=<?= $total_pages; ?>">Última</a>
            </li>
        </ul>
    </div>

</body>

</html>