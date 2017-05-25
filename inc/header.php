<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>CRUD - Eagle ID</title>
    <meta name="description" content="">
    </head>
<body>

    <nav>
      <div>
        <div>
          <a href="<?php echo BASEURL; ?>index.php" >CRUD: <?php echo NOME_DO_CANDIDATO; ?></a>
        </div>
        <div id="navbar">
          <ul>          
            <li>
                <a href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                    Clientes <span></span>
                </a>
                <ul>
                    <li><a href="<?php echo BASEURL; ?>customers">Gerenciar Clientes</a></li>
                    <li><a href="<?php echo BASEURL; ?>customers/add.php">Novo Cliente</a></li>
                </ul>
            </li>
          </ul>
        </div><!--/.navbar-collapse -->
      </div>
    </nav>

<main>
