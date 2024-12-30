<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LazaPee - E-commerce</title>

    <!-- Link to Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Include Font Awesome for cart icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

    <style>
        /* Make the navbar a flex container */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* Image background applied to the body */
        body {
            background-image: url('{{ asset('images/background1.jpg') }}');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: white;
        }

        /* Optional: Adjust the size of the logo image */
        .navbar .navbar-brand img {
            width: 50px;
            height: auto;
        }

        /* Footer styled to be at the bottom */
        footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            background-color: #f8f9fa;
            text-align: center;
            padding: 15px 0;
        }

        .content {
            padding-bottom: 70px; /* Ensures content doesn't overlap the footer */
        }

        /* Custom styles for the Welcome section */
        .welcome-section {
            text-align: center;
            color: white;
            padding: 100px 0;
            background-color: rgba(0, 0, 0, 0.5); /* Transparent background to enhance readability */
        }

        .welcome-section h1 {
            font-size: 3rem;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .welcome-section p {
            font-size: 1.25rem;
        }

        .welcome-image {
            margin-top: 30px;
            width: 100%;
            max-width: 800px;
            height: auto;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">
          <!--  <img src="{{ asset('images/lazapee.jpg') }}" alt="Ecommerce Logo"> LazaPee -->
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Products</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Category
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Electronics</a>
                        <a class="dropdown-item" href="#">Gadgets</a>
                    </div>
                </li>
            </ul>

            <form class="form-inline ml-auto my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>

        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fas fa-shopping-cart"></i> Cart</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('auth.login') }}">Account</a>
            </li>
        </ul>
    </nav>

    <!-- Welcome Section -->
    <div class="welcome-section">
        <h1>Welcome to LazaPee</h1>
       <!-- <img src="{{ asset('images/tao.jpg') }}"  class="welcome-image"> -->
    </div>


    <!-- Include Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>