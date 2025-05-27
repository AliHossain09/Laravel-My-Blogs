<!-- Footer -->
<footer class="border-top">
    <div class="container">
      <div class="row text-center text-md-start">
        <div class="col-md-4 mb-3">
          <h5 class="fw-bold">Bôna</h5>
          <p>© 2017. All rights reserved.<br>Designed by Colorlib</p>
          <!-- Social Icons -->
          <div class="d-flex justify-content-center justify-content-md-start gap-3">
            <i class="bi bi-facebook"></i>
            <i class="bi bi-twitter"></i>
            <i class="bi bi-instagram"></i>
          </div>
        </div>
        <div class="col-md-4 mb-3">
          <h6 class="fw-bold">CATEGORIES</h6>
          <p>BEAUTY · HEALTH · MUSIC · SPORT · DESIGN · TRAVEL</p>
        </div>
        {{-- <div class="col-md-4 mb-3">
          <h6 class="fw-bold">SUBSCRIBE</h6>
          <input type="email" class="form-control" placeholder="Enter your email">
        </div> --}}
        <!-- Subscriber Input -->
        <div class="col-md-4 mb-3">
          <h6 class="title"><strong>SUBSCRIBE</strong></h6>
          <form action="{{ route('subscriber.store') }}" method="POST" class="input-group">
          @csrf
            <div class="input-group">
            <input type="email" class="form-control" name="email" placeholder="Enter your email"  aria-label="Email">
            <button type="submit" class="btn btn-primary"><i class="material-symbols-outlined">mail</i></button>
            </div>
          </form>
          
      </div>
    </div>
  </footer>
  