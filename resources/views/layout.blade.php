<!DOCTYPE HTML>
<html>
<head>
    <title>Apartment System</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
       body {
            /* Set the background image */
            background-image: url('/storage/Waves.gif');
            background-size: cover;
            background-repeat: no-repeat;
            margin-top: 80px; /* Add margin top to body to accommodate header */
            position: relative; /* Ensure relative positioning for pseudo-element */
        }

        body::before {
            /* Create a gradient overlay using pseudo-element */
            content: "";
            position: fixed;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background-image: linear-gradient(#F4F3EF, #E5E3D9);
            z-index: -1; /* Ensure the overlay stays behind the content */
            opacity: 0.5; /* Adjust overlay opacity as needed */
        }

        .custom-header {
            background-color: #C1D0B5; /* Header background color */
            border: 1px solid #000; /* Add black border */
            border-radius: 10px; /* Add border radius */
            padding: 10px; /* Reduce padding */
            font-family: 'Montserrat', sans-serif; /* Set font family */
            width: 100%; /* Make header width 100% */
            height: 13%; /* Set height to auto to accommodate content */
            position: fixed; /* Fix header position */
            top: 0; /* Place header at the top */
            left: 0; /* Align header to the left */
            z-index: 999; /* Set z-index to ensure header appears above other content */
        }

        .header-content {
            display: flex; /* Use flexbox */
            justify-content: center; /* Center items horizontally */
            align-items: center; /* Center items vertically */
            height: 100%; /* Set height to 100% to occupy full height of the header */
        }

        .header-content img {
            width: 100px; /* Set the width of the logo image */
            height: auto; /* Maintain aspect ratio */
            content-align: center; /* Align image to center */
        }
        .container {
            margin-top: 180px; /* Add margin top to container to create space below the header */
        }
        .card {
            background-color: #F4F3EF; /* Card background color changed */
            border: none;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color:  #C1D0B5; /* Header background color changed */
            border: 1px solid #000; /* Add black border to card */
            border-radius: 10px;
            font-family: 'Monsterrat', sans-serif; /* Set font family for header text */
        }
        .card-body {
            padding: 40px;
            font-family: 'Simplifica', sans-serif; /* Set font family for body text */
            border: 1px solid #000; /* Add black border to card body */
        }
        input[type="text"], input[type="email"], input[type="password"] {
            border: 1px solid #000; /* Add black border to input boxes */
            border-radius: 10px; /* Add border radius to input boxes */
            padding: 10px; /* Add padding to input boxes */
            margin-bottom: 20px; /* Add margin bottom to create space between input boxes */
        }
        .btn-primary {
            background-color: #C1D0B5; /* Button background color changed */
            color: #000; /* Button text color changed */
            border: 1px solid #000; /* Add black border to input boxes */
            border-radius: 10px; /* Add border radius to input boxes */
            padding: 10px 20px;
        }
        .btn-primary:hover {
            background-color: #99A98F; /* Button hover background color changed */
            color: #000; /* Button hover text color changed */
        }
    </style>
</head>
<body>

    <!-- Reusable header component -->
    <header class="custom-header">
        <!-- Header content goes here -->
        <div class="header-content">
            <h1 class="header-title">Header Title</h1>
            <p>Header description or navigation links can go here</p>
        </div>
    </header>

    <div class="container">
        <!-- Content of the page goes here -->
        @yield('content')
    </div>

    <!-- Bootstrap JavaScript -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
</body>
</html>
