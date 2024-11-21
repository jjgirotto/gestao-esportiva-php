<?php
  session_start();
  if (!isset($_SESSION['acesso'])) {
      header('Location: login.php');
  }
?>

<nav class="navbar navbar-expand-lg bg-lightgreen">
  <div class="container-fluid">
    <a class="navbar-brand text-dark" href="dashboard.php">Sistema de Gestão Esportiva</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <?php
          if ($_SESSION['nivel'] == 'adm'):
        ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Usuários
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item bg-lightgreen text-dark" href="usuarios.php">Gerenciar</a></li>
            </ul>
          </li>
        <?php
          endif;
        ?>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Equipes
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item bg-lightgreen text-dark" href="equipes.php">Gerenciar</a></li>
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Jogadores
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item bg-lightgreen text-dark" href="jogadores.php">Gerenciar</a></li>
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Competições
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item bg-lightgreen text-dark" href="competicoes.php">Gerenciar</a></li>
            <li><a class="dropdown-item bg-lightgreen text-dark" href="equipe_competicao.php">Equipes</a></li>
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Partidas
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item bg-lightgreen text-dark" style="color: #000;" href="partidas.php">Gerenciar</a></li>
            <li><a class="dropdown-item bg-lightgreen text-dark" style="color: #000;" href="relatorio_partidas.php">Relatórios</a></li>
          </ul>
        </li>
      </ul>

      <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Seja bem vindo(a)
                    <?php
                      if (isset($_SESSION['usuario'])) {
                        echo $_SESSION['usuario'];
                      }
                    ?>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item bg-lightgreen text-dark" href="editar_usuario.php">Editar dados</a></li>
                    <li><a class="dropdown-item bg-lightgreen text-dark" href="logout.php">Sair</a></li>
                </ul>
            </li>
        </ul>
    </div>
  </div>
</nav>
