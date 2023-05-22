<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Cerita Kita</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('img/favicon.png') }}"  rel="icon">
 
  <link href="{{ asset('img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Lato:400,300,700,900" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Amoeba
  * Updated: Mar 10 2023 with Bootstrap v5.2.3
  * Template URL: https://bootstrapmade.com/free-one-page-bootstrap-template-amoeba/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>



<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center">

      <div class="logo me-auto">
        <h1><a href="index.html" style="color:black;">Cerita Kita</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>

      {{-- <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
          <li><a class="nav-link scrollto" href="#portfolio">Menu</a></li>
          <li><a class="nav-link scrollto" href="#contact">Contact Us</a></li>
          <li class="dropdown">
            <a href="#">
              <i class="bi bi-chevron-down"></i>
          </a>
            <ul>
              <li><a href="profile">Edit Profile</a></li>
              <li><a href="{{ url('/password') }}">Ganti Password</a></li>
              <li><a href="{{ url('/logout') }}">Log Out</a></li>
            </ul>
          </li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav> --}}
      <!-- .navbar -->

    </div>
  </header><!-- End #header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" style="background: url({{asset('img/boba/utama.jpg')}}) top center;">
    <div class="hero-container">
      {{-- <h1><b>Cerita Kita</b></h1> --}}
      {{-- <h2><b>Minuman</b></h2> --}}
      <!-- <a href="#about" class="btn-get-started scrollto">Get Started</a> -->
    </div>
  </section><!-- #hero -->

  <main id="main">

    

    <!-- ======= Our Portfolio Section ======= -->
    <section id="portfolio" class="portfolio">
      <div class="container">

        <div class="section-title">
          <h3><b>Our Menu</b></h3>
        </div>

        <div class="row">
          <div class="col-lg-12">
            <ul id="portfolio-flters">
              <li data-filter="*" class="filter-active">Menu</li>
              
            </ul>
          </div>
        </div>
        <div class="row portfolio-container">

          <div class="col-lg-4 col-md-6 portfolio-item filter-app">
            <div class="portfolio-wrap">
              <img src="{{ asset('img/boba/1.jpg') }}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h3><a href="{{ asset('img/boba/1.jpg') }}" data-gallery="portfolioGallery" class="portfolio-lightbox" title="Toping Cheese">Toping Cheese</a></h3>
                <div>
                
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-app">
            <div class="portfolio-wrap">
              <img src="{{ asset('img/boba/2.jpg') }}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h3><a href="{{ asset('img/boba/2.jpg') }}" data-gallery="portfolioGallery" class="portfolio-lightbox" title="Spesial">Spesial</a></h3>
                <div>
                
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-app">
            <div class="portfolio-wrap">
              <img src="{{ asset('img/boba/3.jpg') }}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h3><a href="{{ asset('img/boba/3.jpg') }}" data-gallery="portfolioGallery" class="portfolio-lightbox" title="Toping Dalgona">Toping Dalgona</a></h3>
                <div>
                
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-app">
            <div class="portfolio-wrap">
              <img src="{{ asset('img/boba/4.jpg') }}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h3><a href="{{ asset('img/boba/4.jpg') }}" data-gallery="portfolioGallery" class="portfolio-lightbox" title="Toping Coklat">Toping Coklat</a></h3>
                <div>
                
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-app">
            <div class="portfolio-wrap">
              <img src="{{ asset('img/boba/5.jpg') }}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h3><a href="{{ asset('img/boba/5.jpg') }}" data-gallery="portfolioGallery" class="portfolio-lightbox" title="Mix">Mix</a></h3>
                <div>
                
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-app">
            <div class="portfolio-wrap">
              <img src="{{ asset('img/boba/6.jpg') }}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h3><a href="{{ asset('img/boba/6.jpg') }}" data-gallery="portfolioGallery" class="portfolio-lightbox" title="Boba">Boba</a></h3>
                <div>
                
                </div>
              </div>
            </div>
          </div>

              

      </div>
    </section><!-- End Our Portfolio Section -->

    

    <!-- ======= Contact Us Section ======= -->
    {{-- <section id="contact" class="contact section-bg">
      <div class="container">

        <div class="section-title">
          <h2>Contact Us</h2>
          <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
        </div>

        <div class="row">

          <div class="col-lg-4 col-md-6">
            <div class="contact-about">
              <h3>Amoeba</h3>
              <p>Cras fermentum odio eu feugiat. Justo eget magna fermentum iaculis eu non diam phasellus. Scelerisque felis imperdiet proin fermentum leo. Amet volutpat consequat mauris nunc congue.</p>
              <div class="social-links">
                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="info">
              <div>
                <i class="bi bi-geo-alt"></i>
                <p>A108 Adam Street<br>New York, NY 535022</p>
              </div>

              <div>
                <i class="bi bi-envelope"></i>
                <p>info@example.com</p>
              </div>

              <div>
                <i class="bi bi-phone"></i>
                <p>+1 5589 55488 55s</p>
              </div>

            </div>
          </div>

          <div class="col-lg-5 col-md-12">
            @if ($errors->has('message_success'))
  
              <div class="p-4 bg-success border border-success-subtle rounded-3" style="color:white">
            
                  <strong>{{ $errors->first('message_success') }}</strong>
                
            
              </div>
            @endif
          
            @if ($errors->has('message'))
          
              <div class="p-4 bg-danger border border-danger-subtle rounded-3">
            
                  <strong>{{ $errors->first('message') }}</strong>
                
            
              </div>
            @endif

            <br>

            <form action="{{ url('/kirim_pesan') }}" method="post" role="form">
              @csrf
              <div class="form-group">
                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
              </div>
              <div class="form-group mt-3">
                <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
              </div>
              <div class="form-group mt-3">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
              </div>
              <div class="form-group mt-3">
                <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
              </div>
              <br>
              <div class="text-center"><button type="submit">Send Message</button></div>
            </form>
          </div>

        </div>

      </div>
    </section> --}}
    <!-- End Contact Us Section -->

    <!-- ======= Map Section ======= -->
    {{-- <section class="map">
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3024.2219901290355!2d-74.00369368400567!3d40.71312937933185!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25a23e28c1191%3A0x49f75d3281df052a!2s150%20Park%20Row%2C%20New%20York%2C%20NY%2010007%2C%20USA!5e0!3m2!1sen!2sbg!4v1579767901424!5m2!1sen!2sbg" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
    </section> --}}
    <!-- End Map Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container">
      
    </div>
  </footer><!-- End #footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('vendor/php-email-form/validate.js') }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('js/main.js') }}"></script>

</body>

</html>