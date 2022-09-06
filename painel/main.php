<?php
if (isset($_GET['logout'])) {
    Painel::logout();
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de controle</title>
    <!-- External instance -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script> -->
    <!-- End External instance -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css"> -->
    <!-- END bootstrap icons -->
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="../fontawesome/css/all.css">
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="./css/newform.css">
    <link rel="stylesheet" href="./css/aside.css">
    <style>
        @media screen and (max-width: 500px) {
            aside.menu {
                display: none;
                flex-grow: 10;
            }

            main.dash section table tbody tr :nth-child(1) {
                /* background: black;
                word-break: break-all; */
                max-width: 100px;
                overflow-x: clip;
                overflow-x: -ms-hidden-unscrollable;
            }
        }
    </style>
</head>

<body>
    <!-- <div class="red-box"><i class="fa-solid fa-circle-exclamation"> </i> User or password mismatched</div> -->
    <aside class="menu f-left">
        <header class="center">
            <div class="avatar center" <?php if ($_SESSION['avatar'] != null) {
                                            echo 'style="background-image: url(./uploads/' . $_SESSION['avatar'] . ');">'
                                        ?> <?php
                                        } else {
                                            ?>><i class="fa-solid fa-user-large"></i>
            <?php } ?>
            <!-- <img src="../img/default_profile.webp" alt="profile_picture"> -->
            </div>

            <div class="info">
                <p><?php echo $_SESSION['name'] ?></p>
                <p><?php echo UsersMod::nameRole($_SESSION['role']) ?></p>
            </div>
        </header>
        <nav>
            <a href="./">
                <i class="fa-solid fa-house-user"></i>
                Home</a>
            <?php
            $navItems = (array(
                ['permission' => '1', 'type' => 'title', 'content' => 'Edit Page'],
                ['permission' => '2', 'type' => 'link', 'link' => './editHomePage', 'content' => 'Edit Home Page'],
                ['permission' => '1', 'type' => 'link', 'link' => './editSlide', 'content' => 'Edit Slides'],
                ['permission' => '1', 'type' => 'link', 'link' => './editDepo', 'content' => 'Edit Depoimentos'],
                ['permission' => '1', 'type' => 'link', 'link' => './editService', 'content' => 'Edit Serviços'],


                ['permission' => '1', 'type' => 'title', 'content' => 'Internal'],
                ['permission' => '1', 'type' => 'link', 'link' => './clientes', 'content' => 'Cadastro Cliente'],
                // ['permission' => '1', 'type' => 'link', 'link' => '?url=addService', 'content' => 'Cadastro Serviços'],
                // ['permission' => '1', 'type' => 'link', 'link' => '?url=addSlide', 'content' => 'Cadastro Slides'],

                // ['permission' => '0', 'type' => 'title', 'content' => 'Gestão'],
                // ['permission' => '0', 'type' => 'link', 'link' => '?url=listDepo', 'content' => 'Listar Depoimento'],
                // ['permission' => '0', 'type' => 'link', 'link' => '?url=listService', 'content' => 'Listar Serviços'],
                // ['permission' => '0', 'type' => 'link', 'link' => '?url=listSlide', 'content' => 'Listar Slides'],

                ['permission' => '1', 'type' => 'title', 'content' => 'Administração do painel'],
                ['permission' => '2', 'type' => 'link', 'link' => './editUsers', 'content' => 'Editar Usuarios'],
                // ['permission' => '1', 'type' => 'link', 'link' => '?url=userAdd', 'content' => 'Adicionar Usuario'],

                ['permission' => '2', 'type' => 'title', 'content' => 'Configuração Geral'],
                ['permission' => '0', 'type' => 'link', 'link' => './userEdit', 'content' => 'Editar Usuario'],

                ['permission' => '2', 'type' => 'title', 'content' => 'Eventos '],
                ['permission' => '2', 'type' => 'link', 'link' => '', 'content' => 'Plataforma de eventos'],
                ['permission' => '2', 'type' => 'link', 'link' => '', 'content' => 'Assinaturas mensal'],
                ['permission' => '2', 'type' => 'link', 'link' => '', 'content' => 'Add/edit events'],
                ['permission' => '2', 'type' => 'link', 'link' => '', 'content' => 'admin panel'],
                ['permission' => '2', 'type' => 'link', 'link' => '', 'content' => 'Member area'],
                ['permission' => '2', 'type' => 'link', 'link' => '', 'content' => 'finance area'],
                ['permission' => '2', 'type' => 'link', 'link' => '', 'content' => ''],



            ));

            foreach ($navItems as $key => $value) {
                if ($value['permission'] <= $_SESSION['role']) {
                    // print_r($value);
                    switch ($value['type']) {
                        case 'title':
                            echo "<h3>" . $value['content'] . "</h3>";
                            break;
                        case 'link':
                            echo '<a href="' . $value['link'] . '">' . $value['content'] . "</a>";
                            break;
                        default:
                            # code...
                            break;
                    }
                }
            }
            ?>
            <!-- <h3>Cadastro</h3>
            <a href="">Cadastro Depoimento</a>
            <a href="">Cadastro Serviço</a>
            <a href="">Cadastro Slides</a>

            <h3>Gestão</h3>
            <a href="">Listar Depoimentos</a>
            <a href="">Listar Serviços</a>
            <a href="">Listar Slides</a>

            <h3>Administração do painel</h3>
            <a href="?url=userEdit">Editar Usuario</a>
            <a href="?url=userAdd">Adicionar Usuario</a>

            <h3>Configuração Geral</h3>
            <a href="">Editar</a> -->
        </nav>

    </aside>

    <main class="dash">
        <header>
            <nav>
                <div class="center">
                    <div class="menu-btn">
                        <i class="fa-solid fa-bars"></i>
                    </div>
                    <div class="logout f-right">
                        <a href="./?logout"> <i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a>
                    </div>
                </div>
            </nav>

        </header>
        <section id="views" class="center">
            <h2>
                <i class="fa-solid fa-house"></i>
                Painel de Controle - Dashboard
            </h2>
            <?php
            $usersOnline = Painel::listOnlineUsers();
            ?>
            <div class="usersOnline">
                <p>Users online</p>
                <span id="usersOnline">
                    <?php echo count($usersOnline);
                    //   echo $usersOnline -> rowCount(); 
                    ?>
                </span>
            </div>
            <div class="totalVisits">
                <p>Total visits</p>
                <span id="totalVisits">
                    <?php echo Painel::totalVisits(); ?>
                </span>
            </div>
            <div class="todaysVisits">
                <p>Todays visits</p>
                <span id="todaysVisits">
                    <?php echo Painel::todaysVisits(); ?>
                </span>
            </div>
        </section>


        <?php
        if (isset($_GET["url"])) {
            if (!ctype_alpha($_GET['url'])) {
                die('Alpha only; Incidend will be reported!!');
            }
            if (file_exists("./pages/" . $_GET["url"] . ".html")) {
                include("./pages/" . $_GET["url"] . ".html");
            } elseif (file_exists("./pages/" . $_GET["url"] . ".php")) {
                include("./pages/" . $_GET["url"] . ".php");
            } else {
                include("../pages/404.html");
            }
        } else {
            include('./pages/section-viewMetrics.php');
            include('./pages/section-users.php');
        }
        print_r($_GET)
        ?>



    </main>

    <script src="../js/jquery-3.6.0.min.js"></script>
    <script src="../js/dashboardMain.js"></script>

    <!-- <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script> -->
    <script src="https://cdn.tiny.cloud/1/<?php echo TINYMCE_API_KEY ?>/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <!-- <script src="../js/tinymce_6.1.2-8.js"></script> -->
    <!-- <script src="../js/tinymce/tinymce.min.js"></script> -->
    <!-- <script src="https://malsup.github.io/jquery.form.js"></script> -->
    <!-- <script src="../js/jquery.mask.js"></script>
    <script src="./js/helperMask.js"></script>
    <script src="./js/ajax.js"></script> -->

    <?php
    // Loading page specific js scripts
    Painel::loadJS(['jquery.mask.js', 'helperMask.js', 'jquery.form.js', 'ajax.js', 'cliente.js'], 'clientes', true);
    // Painel::loadJS(['jquery.mask.js', 'helperMask.js', 'jquery.form.js', 'ajax.js', 'cliente.js'], 'clients/add', true);

    ?>

    <script>
        tinymce.init({
            selector: 'textarea.tiny',
            plugin: 'image link insertdatetime code',
            toolbar: 'image link insertdatetime code',
            link_default_target: '_blank',
            insertdatetime_dateformat: '%d-%m-%Y'
        });
    </script>
</body>

</html>