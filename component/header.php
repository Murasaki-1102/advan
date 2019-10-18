<!-- headerをコンポネート化 -->

<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark create-user">
  <div class="container">
    <a class="navbar-brand" href="http://advancedcreators.undo.jp/site/list/index.php">
      <img  class="logo" src="http://advancedcreators.undo.jp/site/list/img/advan.png">
    </a>

    <!-- ハンバーガー -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav4" aria-controls="navbarNav4" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarNav4">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="http://advancedcreators.undo.jp/site/list/auth/Registration.php">新規登録</a>
        </li>
        <li class="nav-item dropdown active">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            機材一覧
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="http://advancedcreators.undo.jp/site/list/main/list.php?genre=Sound">卓</a>
            <a class="dropdown-item" href="http://advancedcreators.undo.jp/site/list/main/list.php?genre=Stage">舞台</a>
            <a class="dropdown-item" href="http://advancedcreators.undo.jp/site/list/main/list.php?genre=Light">照明</a>
          </div>
        </li>
        <li class="nav-item active">
          <?php if (isset($_SESSION['login'])): ?>
            <a class="nav-link" href="http://advancedcreators.undo.jp/site/list/auth/mypage.php">マイページ</a>
          <?php else : ?>
            <a class="nav-link" href="http://advancedcreators.undo.jp/site/list/auth/login.php">ログイン</a>
          <?php endif; ?>
        </li>
      </ul>
    </div>
  </div>
</nav>
