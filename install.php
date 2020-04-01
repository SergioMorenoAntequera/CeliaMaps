<?php

// incluir un comentario sobre el archivo

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Archivo de instalación de Celiamaps</title>
</head>

<body>

  <?php
   // PARA QUE LOS ERRORES NO SE IMPRIMAN EN PANTALLA
    ini_set("display_errors", 0);


    if (isset($_REQUEST["host"])) {
      // Procesar el formulario
      $host = $_REQUEST["host"];
      $appUrl = $_REQUEST["appUrl"];
      $dbConnection = $REQUEST["dbConnection"];
      $dbPort = $REQUEST["dbPort"];
      $namedb = $_REQUEST["namedb"];
      $userdb = $_REQUEST["userdb"];
      $passdb = $_REQUEST["passdb"];

      $username = $_REQUEST["name"];
      $password = $_REQUEST["password"];
      $password2 = $_REQUEST["password2"];
      $email = $_REQUEST["email"];
      //Comprobamos que las dos contraseñas sean iguales
        if (strcmp($password, $password2) !== 0) {
          echo 'Los campos de contraseña deben coincidir.';
        }else{

          $db = new mysqli($host, $userdb, $passdb, $namedb);

            $db->query ("CREATE TABLE `backup_databases` (
              `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
              `created_at` timestamp NULL DEFAULT NULL,
              `updated_at` timestamp NULL DEFAULT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;");


            $db->query (" CREATE TABLE `backups` (
              `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
              `created_at` timestamp NULL DEFAULT NULL,
              `updated_at` timestamp NULL DEFAULT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;");


            $db->query ("CREATE TABLE `hotspots` (
                          `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                          `title` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
                          `description` varchar(1600) COLLATE utf8_unicode_ci NOT NULL,
                          `lat` decimal(10,8) NOT NULL,
                          `lng` decimal(11,8) NOT NULL,
                          `created_at` timestamp NULL DEFAULT NULL,
                          `updated_at` timestamp NULL DEFAULT NULL,
                          PRIMARY KEY (`id`)
                        ) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;");

            $db->query ("CREATE TABLE `images` (
              `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
              `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
              `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
              `file_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
              `file_path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
              `hotspot_id` int(11) NOT NULL,
              `map_id` int(11) NOT NULL DEFAULT '-1',
              `created_at` timestamp NULL DEFAULT NULL,
              `updated_at` timestamp NULL DEFAULT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;");

            $db->query ("CREATE TABLE `maps` (
              `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
              `title` varchar(75) COLLATE utf8_unicode_ci NOT NULL,
              `description` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
              `city` varchar(75) COLLATE utf8_unicode_ci DEFAULT NULL,
              `date` int(11) DEFAULT NULL,
              `image` varchar(75) COLLATE utf8_unicode_ci NOT NULL,
              `miniature` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
              `level` int(11) NOT NULL,
              `tlCornerLatitude` double(18,16) DEFAULT NULL,
              `tlCornerLongitude` double(18,16) DEFAULT NULL,
              `trCornerLatitude` double(18,16) DEFAULT NULL,
              `trCornerLongitude` double(18,16) DEFAULT NULL,
              `blCornerLatitude` double(18,16) DEFAULT NULL,
              `blCornerLongitude` double(18,16) DEFAULT NULL,
              `brCornerLatitude` double(18,16) DEFAULT NULL,
              `brCornerLongitude` double(18,16) DEFAULT NULL,
              `created_at` timestamp NULL DEFAULT NULL,
              `updated_at` timestamp NULL DEFAULT NULL,
              PRIMARY KEY (`id`),
              UNIQUE KEY `maps_title_unique` (`title`),
              UNIQUE KEY `maps_level_unique` (`level`)
            ) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;");

            $db->query ("CREATE TABLE `maps_streets` (
              `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
              `street_id` int(10) unsigned NOT NULL,
              `map_id` int(10) unsigned NOT NULL,
              `alternative_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
              `created_at` timestamp NULL DEFAULT NULL,
              `updated_at` timestamp NULL DEFAULT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;");

            $db->query ("CREATE TABLE `marker_point` (
              `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
              `marker_id` int(10) unsigned NOT NULL,
              `point_id` int(10) unsigned NOT NULL,
              `created_at` timestamp NULL DEFAULT NULL,
              `updated_at` timestamp NULL DEFAULT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;");


            $db->query ("CREATE TABLE `markers` (
              `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
              `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
              `type` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
              `radius` int(11) DEFAULT NULL,
              `created_at` timestamp NULL DEFAULT NULL,
              `updated_at` timestamp NULL DEFAULT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;");


            $db->query ("CREATE TABLE `migrations` (
              `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
              `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
              `batch` int(11) NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;");


            $db->query ("CREATE TABLE `password_resets` (
              `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
              `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
              `created_at` timestamp NULL DEFAULT NULL,
              KEY `password_resets_email_index` (`email`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;");


            $db->query ("CREATE TABLE `points` (
              `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
              `lat` decimal(10,8) NOT NULL,
              `lng` decimal(11,8) NOT NULL,
              `created_at` timestamp NULL DEFAULT NULL,
              `updated_at` timestamp NULL DEFAULT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;");


            $db->query ("CREATE TABLE `points_streets` (
              `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
              `street_id` int(10) unsigned NOT NULL,
              `point_id` int(10) unsigned NOT NULL,
              `created_at` timestamp NULL DEFAULT NULL,
              `updated_at` timestamp NULL DEFAULT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;");


            $db->query ("CREATE TABLE `settings` (
              `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
              `name` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
              `value` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
              `created_at` timestamp NULL DEFAULT NULL,
              `updated_at` timestamp NULL DEFAULT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;");


            $db->query ("CREATE TABLE `street_types` (
              `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
              `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
              `abbreviation` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
              `created_at` timestamp NULL DEFAULT NULL,
              `updated_at` timestamp NULL DEFAULT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;");


            $db->query ("CREATE TABLE `streets` (
              `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
              `type_id` int(11) NOT NULL,
              `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
              `created_at` timestamp NULL DEFAULT NULL,
              `updated_at` timestamp NULL DEFAULT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;");


            $db->query ("CREATE TABLE `users` (
              `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
              `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
              `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
              `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
              `level` int(11) NOT NULL,
              `email_verified_at` timestamp NULL DEFAULT NULL,
              `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
              `created_at` timestamp NULL DEFAULT NULL,
              `updated_at` timestamp NULL DEFAULT NULL,
              PRIMARY KEY (`id`),
              UNIQUE KEY `users_email_unique` (`email`)
            ) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;");

            $db->query ("INSERT INTO `users` ('name','password','email','level') VALUES ('$username','$password','$email',1);");


            // SE CREA EL ARCHIVO DE CONFIGURACIÓN

            $nombre_archivo = ".env";

            if (file_exists($nombre_archivo)) {
                $mensaje = "El Archivo " . $nombre_archivo . " se ha modificado.";
            } else {
                $mensaje = "El Archivo " . $nombre_archivo . " se ha creado.";
            }

            // SE ABRE EL ARCHIVO PARA ESCRITURA
            if ($archivo = fopen($nombre_archivo, "w")) {
              // SE ESCRIBE EL SIGUIENTE CONTENIDO EN EL ARCHIVO
                fwrite($archivo, "APP_URL='" . $appUrl . "'\n
                        DB_CONNECTION='" . $dbConnection . "'\n
                        DB_HOST='" . $host . "'\n
                        DB_PORT='" . $dbPort . "'\n
                        DB_DATABASE='" . $namedb . "'\n
                        DB_USERNAME='" . $userdb . "'\n
                        DB_PASSWORD='" . $passdb . "'\n");
            } else {
                echo "El programa de instalación no ha podido crear el archivo de configuración. Debe crearlo usted manualmente en el directorio raíz de su aplicación.<br>"
                . "El archivo debe ser de texto plano y tener el nombre .env, su contenido debe ser el siguiente (cópielo y péguelo para evitar errores):<br><br>"
                . "'APP_URL='" . $appUrl . "'<br>
                        DB_CONNECTION='" . $dbConnection . "'<br>
                        DB_HOST='" . $host . "'<br>
                        DB_PORT='" . $dbPort . "'<br>
                        DB_DATABASE='" . $namedb . "'<br>
                        DB_USERNAME='" . $userdb . "'<br>
                        DB_PASSWORD='" . $passdb . "'<br>
                        <br><br>

                Cuando haya creado el archivo puede visitar <a href='$appUrl/user'>$appUrl/user</a> para comenzar a trabajar con la aplicación. Pida ayuda a su administrador de sistemas si no sabe cómo hacer todo esto.";
            }
            //SE CIERRA EL ARCHIVO
            fclose($archivo);



			// CREACIÓN DE DIRECTORIOS, SI LOS HAY



            echo "<br><br><span class='text-white'>La instalación ha finalizado. <strong>IMPORTANTE: elimine ahora el archivo de instalación (install.php) del servidor para evitar posibles ataques a su base de datos.</strong>.<br>"
            . "Visite <a href='$appUrl/user'>$appUrl/user</a> para comenzar a trabajar con la aplicación.</span><br>";
         }
     }
         // fin del if
        else {
            // Mostramos formulario
            ?>

<div class="container">
    <div class="wholePanel">
        <div class="leftPanel widht:40%">

            <div class="content">
              <div class="titulo">
                Rellene este fomulario para configurar su apliación.
              </div>
              <img src="{{url('/img/icons/userWhite.png')}}" width="50%" alt="" class="img-fluid">
              </div>
        </div>
        <div class="rightPanel">

                <form action="install.php" method="POST">
                  <!-- LA BASE DE DATOS  -->
                  <div id="filacero" class="row">
                      <div class="col">
                          <div class="form-group">
                          <label for="host">HOST</label>
                              <input type="text" class="form-control"  name="host" id="host" required>
                          </div>
                      </div>
                  </div>
            <div id="primerafila" class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="appUrl">APP_URL</label>
                        <input type="text" class="form-control"  name="appUrl" id="appUrl" required>
                    </div>
                </div>
            </div>
            <div id="segundafila" class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="dbConnection">DB_CONNECTION</label>
                        <input type="text" class="form-control" name="dbConnection" id="dbConnection" required>
                    </div>
                </div>
            </div>
            <div id="tercerafila" class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="dbPort">DB_PORT</label>
                        <input type="text" class="form-control" name="dbPort" id="dbPort" required>
                    </div>
                </div>
            </div>
            <div id="cuartafila" class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="namedb">DB_NAME</label>
                        <input type="text" class="form-control" name="namedb" id="namedb" required>
                    </div>
                </div>
            </div>
            <div id="quintafila" class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="userdb">DB_USER</label>
                        <input type="text" class="form-control" name="userdb" id="userdb" required>
                    </div>
                </div>
            </div>
            <div id="sextafila" class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="passdb">DB_PASSWORD</label>
                        <input type="text" class="form-control" name="passdb" id="passdb" required>
                    </div>
                </div>
            </div>
            <!-- EL USUARIO  -->
            <div id="septimafila" class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="name">NOMBRE USUARIO ADMINISTRADOR</label>
                        <input type="text" class="form-control" name="name" id="name" required>
                    </div>
                </div>
            </div>
            <div id="octavafila" class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="password">CONTRASEÑA USUARIO</label>
                        <input type="password" class="form-control" name="password" id="password" required>
                    </div>
                </div>
            </div>
            <div id="novenafila" class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="password2">CONFIRMAR CONTRASEÑA</label>
                        <input type="password" class="form-control" name="password2" id="password2" required>
                    </div>
                </div>
            </div>
            <div id="decimafila" class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="email">EMAIL USUARIO</label>
                        <input type="email" class="form-control" name="email" id="email" required>
                    </div>
                </div>
            </div>
            <input type='submit' value='Aceptar' class="btn-success">

          </form>

            <?php
        }
         // AUTOBORRADO DE ARCHIVO
         //$autoborrado = 'install.php';
         //unlink($autoborrado);
        ?>
      </div>
    </div>
</div>

</body>

</html>
