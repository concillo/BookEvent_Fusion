<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Restaurant Event Planner and Booking</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Libre Baskerville', serif;
            background-color: #f2f2f2;
            padding-bottom: 100px;
            padding:80px;
        }

        header {     
            background-color: #333;
            color: white;
            padding: 80px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        footer {
            background-color: black;
            color: white;
            padding: 1rem;
            text-align: center;
            margin-top: 20px;
            border-radius: 8px;
        }

        #event-planner {
            background-color: white;
            padding: 20px;
            margin: 20px auto;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        #event-planner h2 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        #event-planner p {
            color: #666;
            margin-bottom: 20px;
            line-height: 1.6;
        }

        #event-planner ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        #event-planner li {
            margin-bottom: 10px;
        }

        #event-planner em {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #777;
        }

        .navbar-custom {
            background-color: #333;
            color: white;
            padding: 10px 20px;
        }

        .navbar-custom b {
            font-size: 1.5rem;
        }

        .navbar-custom .navbar-nav .nav-link {
            color: white;
        }

        .navbar-custom .navbar-nav .nav-link:hover {
            color: yellow;
        }
    </style>
</head>

<body>
    <header>
        <b>Event Planning Book MS</b>
        <nav class="navbar-custom">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
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

    <section id="event-planner">
        <h2>About Restaurant Event Planner and Booking</h2>
        <p>Welcome to Restaurant Event Planner and Booking, the brainchild of Concillo&Rabutin, where creativity meets organization, and dreams become reality. As a passionate project, we're dedicated to exploring the exciting world of event planning while honing our skills and creativity. Our mission is to deliver exceptional event experiences tailored to your vision, whether you're envisioning a dazzling school fundraiser, an unforgettable prom night, or a memorable graduation celebration.</p>
        <ul>
            <li><strong>What Sets Us Apart:</strong> What sets us apart is our youthful energy, fresh perspective, and unwavering dedication to learning and growth. As a student-led initiative, we bring a unique blend of creativity, innovation, and enthusiasm to every project we undertake. We thrive on challenges and are committed to delivering results that exceed expectations, all while gaining invaluable hands-on experience in event coordination and management.</li>
            <li><strong>Our Approach:</strong> At Restaurant Event Planner and Booking, we believe in collaboration, communication, and attention to detail. We work closely with clients to understand their vision, preferences, and budget, ensuring that every aspect of their event reflects their unique style and personality. From brainstorming creative themes to coordinating logistics and executing flawless execution, we are with you every step of the way, offering guidance, support, and expertise.</li>
            <li><strong>Get Involved:</strong> Whether you're a fellow student looking to collaborate on a project, a faculty member seeking event planning assistance, or a community member interested in our services, we invite you to get involved. Together, let's turn your event ideas into unforgettable experiences and create lasting memories that will be cherished for years to come.</li>
            <li><strong>Contact Concillo:</strong> Ready to bring your event vision to life? Reach out to Concillo today to discuss your project, ask questions, or schedule a consultation. I can't wait to embark on this exciting journey with you!</li>
        </ul>
        <em>Thank you for considering Restaurant Event Planner and Booking, led by Concillo&Rabutin, for your event planning needs. Let's make magic happen together!</em>
    </section>

    <footer>
        <h3>For inquiries or assistance, please contact us at:</h3>
        <p><i class="fas fa-envelope"></i> Concillo@example.com</p>
        <p><i class="fas fa-phone"></i> +69465575762</p>
        <p>&copy; 2024 Event Planner. All rights reserved.</p>
    </footer>

    <script>
        var images = ['images/front.jpg', 'images/open.jpg', 'images/opening.jpg']; 
        var currentIndex = 0;
        var header = document.querySelector('header');

        function changeBackground() {
            header.style.backgroundImage = "url('" + images[currentIndex] + "')";
            currentIndex = (currentIndex + 1) % images.length;
        }

        changeBackground();

        setInterval(changeBackground, 5000); 
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
