<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Management System</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Libre Baskerville', serif;
            margin: 0;
            padding: 0;
            background-image: url('../images/open.jpg');
            background-size: cover;
        }

        header {
            background-color: saddlebrown;
            color: white;
            padding: 10px 20px;
            z-index: 1000;
            /* Ensure the header appears above the sidebar */
        }

        .sidebar {
            position: fixed;
            top: 60px;
            /* Adjusted top position to match header height */
            left: 0;
            width: 250px;
            height: 100%;
            background-color: #333;
            /* Dark background color */
            color: white;
            /* Text color */
            padding-top: 20px;
            /* Adjusted padding */
            overflow-y: auto;
            z-index: 100;
            display: none;
            margin-left: 1200px;
        }

        .sidebar.active {
            display: block;
            /* Display the sidebar when it has the active class */
        }

        .sidebar a {
            display: block;
            padding: 10px 20px;
            /* Adjusted padding */
            color: white;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .sidebar a:hover {
            background-color: #555;
            /* Hover background color */
        }

        .container {
            margin-left: 250px;
            /* Adjusted to accommodate sidebar width */
            padding: 20px;
        }

        footer {
            background-color: #f9f9f9;
            padding: 20px 0;
            text-align: center;
            margin-top: 800px;
            border-radius: 0 0 8px 8px;
        }

        footer p {
            margin: 0;
            font-size: 14px;
            color: #777;
        }

        /* Style for the navbar brand */
        .navbar-brand {
            font-size: 1.5rem;
            margin-left: 20px;
        }

        /* Style for sidebar icons */
        .sidebar i {
            margin-right: 10px;
        }

        /* Style for active sidebar link */
        .sidebar a.active {
            background-color: #555 !important;
        }

        .navbar .sub-links.active {
            display: block;
            margin-left: 1100px;
        }

        .navbar-nav .nav-link {
            padding-right: 0;
            padding-left: 0;
            color: white;
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
    </style>
</head>

<body>
    <header class="header">
        <nav class="navbar navbar-expand-lg">
            <span class="navbar-brand">Booking Venue Management</span>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="javascript:void(0)" onclick="toggleSidebar()"><i
                            class="fas fa-home"></i>Home</a>
                    <div class="sidebar" id="sidebar">
                        <a href="index.php"><i class="fas fa-home"></i>Home</a>
                        <a href="venues.php"><i class="fas fa-map-marker-alt"></i>Find Venue</a>
                        <a href="planning.php"><i class="fas fa-calendar-plus"></i>Create Venue</a>
                        <a href="profile.php"><i class="fas fa-user"></i>Profile</a>
                        <a href="lists.php"><i class="fas fa-bookmark"></i>My Bookings</a>
                        <a href="requests.php"><i class="fas fa-envelope"></i>Requests</a>
                        <a href="abouts.php"><i class="fas fa-info-circle"></i>About</a>
                        <a href="activity_logs.php"><i class="fas fa-history"></i>Activity Logs</a>
                        <a href="../index.php"><i class="fas fa-sign-out-alt"></i>Log Out</a>
                    </div>
                </li>
            </ul>
        </nav>
    </header>

    <section id="event-planner">
        <h2>About Restaurant Event Planner and Booking</h2>
        <p>Welcome to Restaurant Event Planner and Booking, the brainchild of Concillo&Rabutin, where creativity meets
            organization, and dreams become reality. As a passionate project, we're dedicated to exploring the exciting
            world of event planning while honing our skills and creativity. Our mission is to deliver exceptional event
            experiences tailored to your vision, whether you're envisioning a dazzling school fundraiser, an
            unforgettable prom night, or a memorable graduation celebration.</p>
        <ul>
            <li><strong>What Sets Us Apart:</strong> What sets us apart is our youthful energy, fresh perspective, and
                unwavering dedication to learning and growth. As a student-led initiative, we bring a unique blend of
                creativity, innovation, and enthusiasm to every project we undertake. We thrive on challenges and are
                committed to delivering results that exceed expectations, all while gaining invaluable hands-on
                experience in event coordination and management.</li>
            <li><strong>Our Approach:</strong> At Restaurant Event Planner and Booking, we believe in collaboration,
                communication, and attention to detail. We work closely with clients to understand their vision,
                preferences, and budget, ensuring that every aspect of their event reflects their unique style and
                personality. From brainstorming creative themes to coordinating logistics and executing flawless
                execution, we are with you every step of the way, offering guidance, support, and expertise.</li>
            <li><strong>Get Involved:</strong> Whether you're a fellow student looking to collaborate on a project, a
                faculty member seeking event planning assistance, or a community member interested in our services, we
                invite you to get involved. Together, let's turn your event ideas into unforgettable experiences and
                create lasting memories that will be cherished for years to come.</li>
            <li><strong>Contact Concillo:</strong> Ready to bring your event vision to life? Reach out to Concillo today
                to discuss your project, ask questions, or schedule a consultation. I can't wait to embark on this
                exciting journey with you!</li>
        </ul>
        <em>Thank you for considering Restaurant Event Planner and Booking, led by Concillo&Rabutin, for your event
            planning needs. Let's make magic happen together!</em>
    </section>

    <footer class="footer">
        <div class="container">
            <p>@Event Planner and Booking Management System by Concillo & Rabutin FDS A.Y. 2024 All Rights Reserved.</p>
        </div>
    </footer>

    <script>
        function toggleSidebar() {
            var sidebar = document.getElementById("sidebar");
            sidebar.classList.toggle("active");
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>