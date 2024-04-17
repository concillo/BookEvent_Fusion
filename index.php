<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Restaurant Event Management System</title>
  <link rel="website icon" type="jpg" href="images/logo.jpg">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="styles.css">
</head>

<body>
  <header>
    <nav class="navbar navbar-custom" id="navbar">
      <b class="navbar-brand">Event Planning Book MS</b>

      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="login.php">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="registration.php">SignUp</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="about.php">About Us</a>
        </li>
      </ul>
    </nav>
  </header>


  <div class="container">
    <section id="event-details">
      <h2>Welcome To Special Event</h2>
      <p>Welcome to BookEvent Fusion, your go-to destination for finding the perfect venues to host unforgettable
        celebrations. Whether you're planning a milestone birthday bash, an elegant wedding reception, or a corporate
        gala, we're here to make your event planning journey seamless and stress-free. With a curated selection of
        top-notch venues, each offering its own unique charm and amenities, we ensure that every celebration is nothing
        short of spectacular. Alongside our venue recommendations, we proudly present five handpicked restaurants
        renowned for their exceptional cuisine and inviting ambiance, adding a delectable touch to your festivities. Let
        us guide you through the process of finding the ideal setting for your special occasion, and together, let's
        create memories that will be cherished for years to come.</p>
    </section>
  </div>

  <footer>
    <h3>For inquiries or assistance, please contact us at:</h3>
    <p><i class="fas fa-envelope"></i> gardeniacon876@gmail.com</p>
    <p><i class="fas fa-phone"></i> +69465575762</p>
    <p>&copy; @Event Planner and Booking Management System by Concillo & Rabutin FDS A.Y. 2024 All Rights Reserved.</p>
  </footer>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <script>
    var images = ['images/front.jpg', 'images/open.jpg', 'images/opening.jpg'];
    var currentIndex = 0;
    var navbar = document.getElementById('navbar');

    function changeBackground() {
      navbar.style.backgroundImage = "url('" + images[currentIndex] + "')";
      currentIndex = (currentIndex + 1) % images.length;
    }

    changeBackground();

    setInterval(changeBackground, 5000); 
  </script>

</body>

</html>



<style>
  body {
    font-family: 'Libre Baskerville', serif;
    background-color: white;
    padding-bottom: 100px;
  }

  .navbar-custom {
    background-color: white;
    color: red;
    font-size: 20px;
    margin-bottom: 20px;
    padding: 10px 20px;
    transition: background-image 0.3s ease;

  }

  p {
    margin-top: 55px;
    margin-bottom: 3rem;
  }

  .navbar-nav.ml-auto {
    margin-left: 20px;
  }

  .navbar {
    margin: 0;
    padding: 70px;
    background-image: url('images/open.jpg');
    background-size: cover;
    color: black;
    font-size: 20px;
    margin-bottom: 20px;
  }

  .navbar-nav .nav-link {
    color: white;
    margin-left: 20px;
  }

  .navbar-nav .nav-link:hover {
    color: red;
  }

  .container {
    max-width: 1000px;
    margin-top: 5px;
    padding: 10px;
  }

  .navbar-brand {
    font-size: 50px;
    color: white;
  }

  h2 {
    text-align: center;
    color: Orange;
    font-size: 50px;
    font-family: 'Georgia', sans-serif;
  }

  footer {
    background-color: black;
    color: white;
    padding: 1rem;
    text-align: center;
    margin-top: 550px;
  }
</style>