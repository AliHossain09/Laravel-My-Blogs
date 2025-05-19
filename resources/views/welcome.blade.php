@extends('layouts.frontend.app')

@section('title', 'Login')


@section('content')
  <!-- Banner -->
  <div class="container-fluid my-4 px-0">
    <img  src="https://graphicsfamily.com/wp-content/uploads/edd/2024/12/Business-Web-Banner-Design-01-1180x664.jpg" class="img-fluid max-width: 100%  mx-auto d-block" alt="Banner">
  </div>
  
  <!-- Blog Grid -->
  <div class="container">
    <div class="row g-4">
  
      <!-- Repeating blog card -->
      <!-- Use Bootstrap 5 card inside col-md-4 -->
      <!-- Repeat for each post -->
      <!-- Example Post Card -->
      <div class="col-md-4">
        <div class="card h-100 shadow-sm">
          <img src="https://via.placeholder.com/400x250" class="card-img-top" alt="...">
          <div class="card-body">
            <h6 class="card-title">How Did Van Gogh’s Turbulent Mind Depict One of the Most Complex Concepts in Physics?</h6>
          </div>
          <div class="card-footer d-flex justify-content-between text-muted">
            <div><i class="bi bi-heart"></i> 57</div>
            <div><i class="bi bi-chat"></i> 6</div>
            <div><i class="bi bi-eye"></i> 138</div>
          </div>
        </div>
      </div>
  
      <!-- Duplicate the above col-md-4 block 11 more times to match layout -->
      <div class="col-md-4 col-sm-1">
        <div class="card h-100 shadow-sm">
          <img src="https://via.placeholder.com/400x250" class="card-img-top" alt="...">
          <div class="card-body">
            <h6 class="card-title">How Did Van Gogh’s Turbulent Mind Depict One of the Most Complex Concepts in Physics?</h6>
          </div>
          <div class="card-footer d-flex justify-content-between text-muted">
            <div><i class="bi bi-heart"></i> 57</div>
            <div><i class="bi bi-chat"></i> 6</div>
            <div><i class="bi bi-eye"></i> 138</div>
          </div>
        </div>
      </div>

       <!-- Duplicate the above col-md-4 block 11 more times to match layout -->
       <div class="col-md-4">
        <div class="card h-100 shadow-sm">
          <img src="https://via.placeholder.com/400x250" class="card-img-top" alt="...">
          <div class="card-body">
            <h6 class="card-title">How Did Van Gogh’s Turbulent Mind Depict One of the Most Complex Concepts in Physics?</h6>
          </div>
          <div class="card-footer d-flex justify-content-between text-muted">
            <div><i class="bi bi-heart"></i> 57</div>
            <div><i class="bi bi-chat"></i> 6</div>
            <div><i class="bi bi-eye"></i> 138</div>
          </div>
        </div>
      </div>

       <!-- Duplicate the above col-md-4 block 11 more times to match layout -->
       <div class="col-md-4">
        <div class="card h-100 shadow-sm">
          <img src="https://via.placeholder.com/400x250" class="card-img-top" alt="...">
          <div class="card-body">
            <h6 class="card-title">How Did Van Gogh’s Turbulent Mind Depict One of the Most Complex Concepts in Physics?</h6>
          </div>
          <div class="card-footer d-flex justify-content-between text-muted">
            <div><i class="bi bi-heart"></i> 57</div>
            <div><i class="bi bi-chat"></i> 6</div>
            <div><i class="bi bi-eye"></i> 138</div>
          </div>
        </div>
      </div>

       <!-- Duplicate the above col-md-4 block 11 more times to match layout -->
       <div class="col-md-4">
        <div class="card h-100 shadow-sm">
          <img src="https://via.placeholder.com/400x250" class="card-img-top" alt="...">
          <div class="card-body">
            <h6 class="card-title">How Did Van Gogh’s Turbulent Mind Depict One of the Most Complex Concepts in Physics?</h6>
          </div>
          <div class="card-footer d-flex justify-content-between text-muted">
            <div><i class="bi bi-heart"></i> 57</div>
            <div><i class="bi bi-chat"></i> 6</div>
            <div><i class="bi bi-eye"></i> 138</div>
          </div>
        </div>
      </div>

       <!-- Duplicate the above col-md-4 block 11 more times to match layout -->
       <div class="col-md-6 col-lg-4">
        <div class="card h-100 shadow-sm">
          <img src="https://via.placeholder.com/400x250" class="card-img-top" alt="...">
          <div class="card-body">
            <h6 class="card-title">How Did Van Gogh’s Turbulent Mind Depict One of the Most Complex Concepts in Physics?</h6>
          </div>
          <div class="card-footer d-flex justify-content-between text-muted">
            <div><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314"/>
</svg></i> 57</div>
            <div><i class="bi bi-chat"></i> 6</div>
            <div><i class="bi bi-eye"></i> 138</div>
          </div>
        </div>
      </div>
  
    </div>

    {{-- .......... --}}
  <section class="text-center bg-light py-5">
    <div class="container">

        <div class="row mb-5">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 shadow-sm border">
                    <div class=" overflow-hidden" style="max-height: 200px;">
                        <img src="https://images.pexels.com/photos/14653174/pexels-photo-14653174.jpeg" class="img-fluid" alt="blog">
                    </div>

                    <a href="#" class="avatar mt- position-relative rounded-circle border border-white shadow" style="margin: 0 auto; margin-top: -40px; width: 70px; height: 70px; overflow: hidden; z-index: 10; border-width: 7px; box-shadow: 0 0 10px rgba(0,0,0,.2);">
                        <img src="https://png.pngtree.com/png-clipart/20240709/original/pngtree-casual-man-flat-design-avatar-profile-picture-vector-png-image_15526568.png" class="w-100" alt="Profile Image">
                    </a>

                    <div class="p-4">
                        <h4 class="mb-4"><a href="#" class="text-dark"><strong>Hello My Dear Coders</strong></a></h4>
                    </div>

                    <ul class="list-unstyled d-flex justify-content-center position-absolute bottom-0 start-0 end-0 mb-0 bg-light border-top">
                        <li class="text-center flex-fill border-end" style="background: #EDF3F3;">
                            <a href="#" class="d-block" style="line-height: 45px;">
                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart-fill " viewBox="0 0 16 16">
                              <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314"/>
                              </svg>
                              57</a>
                        </li>
                        
                        <li class="text-center flex-fill border-end" style="background: #EDF3F3;">
                            <a href="#" class="d-block" style="line-height: 45px;">
                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-fill " viewBox="0 0 16 16">
                              <path d="M8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6-.097 1.016-.417 2.13-.771 2.966-.079.186.074.394.273.362 2.256-.37 3.597-.938 4.18-1.234A9 9 0 0 0 8 15"/>
                              </svg>
                              6</a>
                        </li>
                        <li class="text-center flex-fill" style="background: #EDF3F3;">
                            <a href="#" class="d-block" style="line-height: 45px;">
                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                              <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                              <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                              </svg>
                              138</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-12 col-md-12">
                <div class="card h-100 p-4 text-center">
                    <strong>No Post Found :(</strong>
                </div>
            </div>
        </div>

        <a href="#" class="btn text-black px-4 py-3" style="background: #C3D8F5; box-shadow: 0 0 2px rgba(0,0,0,.4); transition: all 0.3s;">
            <strong>LOAD MORE</strong>
        </a>
    </div>
</section>

<style>
    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 5px 10px 20px rgba(0,0,0,.3);
    }
</style>

   

    
@endsection






