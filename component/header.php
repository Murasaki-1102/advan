<!-- headerをコンポネート化 -->
<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="/">
      <img  class="nav-logo" src="/imgs/logo.png">
    </a>

    <!-- ハンバーガー -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a class="nav-link" href="/main/about.php">About</a>
        </li>
        <li class="nav-item active">
          <?php if(!isset($_SESSION['login'])): ?>
          <a class="nav-link" href="/auth/registration.php">Sign Up</a>
          <?php endif; ?>
        </li>
        <li class="nav-item active">
          <?php if (isset($_SESSION['login'])): ?>
            <a class="nav-link" href="/auth/mypage.php">Mypage</a>
          <?php else : ?>
            <a class="nav-link" href="/auth/login.php">Login</a>
          <?php endif; ?>
        </li>
      </ul>
    </div>
  </div>
</nav>
