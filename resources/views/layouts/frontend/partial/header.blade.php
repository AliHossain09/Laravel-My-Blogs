  <!-- Header -->
  <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom ">
    <div class="container">
      <a class="navbar-brand fw-bold" href="#">Bôna</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navMenu">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Categories</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Features</a></li>
        </ul>
        <form class="d-flex">
          <input class="form-control" type="search" placeholder="Type of search">
        </form>
      </div>
    </div>
  </nav>