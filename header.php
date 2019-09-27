<!-- headerをコンポネート化 -->

<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark create-user">
  <div class="container">
    <a class="navbar-brand" href="top.php">
      <img  class="logo" src="img/advan.png">
    </a>

    <!-- ハンバーガー -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav4" aria-controls="navbarNav4" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarNav4">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="Registration.php">新規登録</a>
        </li>
        <li class="nav-item dropdown active">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            機材一覧
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="#">卓</a>
            <a class="dropdown-item" href="#">舞台</a>
            <a class="dropdown-item" href="#">照明</a>
          </div>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="login.php">ログイン</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
