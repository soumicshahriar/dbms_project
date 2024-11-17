<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
 <link rel="stylesheet" href="/dashboard/s_government_office.css">
 <title>Market Manager</title>
 <style>
  * {
   margin: 0;
   padding: 0;
   box-sizing: border-box;

  }

  /*navbar */

  /* nav style */
  .navbar-p {
   color: #fff;
   font-size: 1em;
  }

  .container-fluid {
   background: linear-gradient(270deg, #5ed1d7, #003ef8, #000000, #ebebef, #00f8db);
   background-size: 400% 400%;
   color: #fff;
   padding: 1em;
   border: 5px solid gray;
   border-block-color: #03fbff;
   border-radius: 10%;
   font-size: 1.5em;
  }

  .nav-item a {
   color: white;
   width: fit-content;
   padding: 1%;
   margin: 1%;
   border: 5px solid #03fbff;
   border-block-color: gray;
   border-radius: 5%;
  }

  .nav-item a:hover {
   background: linear-gradient(270deg, #02f2ff, #02f2ff, #02f2ff, #02f2ff, #02f2ff);
   color: white;
   width: fit-content;
   padding: 1%;
   border: 5px solid #03fbff;
   border-block-color: gray;
   border-radius: 50%;
  }

  .dropdown-menu {
   background: linear-gradient(270deg, #02f2ff, #02f2ff, #02f2ff, #02f2ff, #02f2ff);
   color: #fff;
   padding: 1em;
   border: 1px solid black;
   border-radius: 5%;

  }

  .dropdown-menu:hover {
   color: linear-gradient(to bottom, rgb(234, 235, 243), rgb(0, 0, 0));
   width: fit-content;
   padding: 1%;
   border: 1px solid black;
   border-radius: 5%;
  }



  /*navbar end */

  body {
   width: 90%;
   margin: auto;
   background: linear-gradient(270deg, #5ed1d7, #02f2ff, #00ffe5, #0dffeb, #00f8db);
  }

  form {
   flex-direction: column;
   align-items: center;
   border-radius: 20%;
   border: 5px solid gray;
   border-block-color: #03fbff;
   background: linear-gradient(270deg, #5ed1d7, #003ef8, #000000, #101011, #00f8db);
   background-size: 400% 400%;
   text-align: center;
   color: white;
   width: 90%;
   padding: 4%;
   margin: auto;
  }

  form:hover {
   transform: scale(1.02);
   box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);
   /* Slightly stronger shadow on hover */
  }

  /* Hover effect for buttons */
  form button:hover {
   background-color: #007bff;
   color: #fff;
   transform: scale(1.05);
   box-shadow: 0 4px 8px rgba(236, 4, 4, 0.2);
  }

  form {
   transform: scale(1.00);
   box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);
   margin-bottom: 5%;
  }

  form:hover {
   transform: scale(1.02);
   box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);
   margin-bottom: 5%;
  }

  label {
   display: block;
   margin-bottom: 5px;
   background: linear-gradient(to bottom, rgb(196, 201, 214), rgb(0, 0, 0));
  }

  input {
   background: linear-gradient(to bottom, rgb(128, 129, 135), rgb(0, 0, 0));
   color: rgb(255, 255, 255);
   width: 100%;
   padding: 8px;
   border: 1px solid #ccc;
   border-radius: 3px;
   margin-bottom: 5%;
  }

  input:hover {
   background: linear-gradient(270deg, #02f2ff, #02f2ff, #02f2ff, #02f2ff, #02f2ff);
   padding: 2%;
   width: 100%;
   margin-bottom: 5%;
   margin-right: 5%;
   padding: 5px;
   color: black;
   background-color: gray;
   border: 5px solid #03fbff;
   border-block-color: gray;
   border-radius: 50%;
   text-align: center;

  }

  #productForm select {
   background: linear-gradient(to bottom, rgb(128, 129, 135), rgb(0, 0, 0));
   color: rgb(255, 255, 255);
   width: 100%;
   margin-bottom: 5%;
   padding: 8px;
   border: 1px solid #ccc;
   border-radius: 3px;
  }

  #productForm select:hover {
   background: linear-gradient(270deg, #02f2ff, #02f2ff, #02f2ff, #02f2ff, #02f2ff);
   padding: 2%;
   width: 100%;
   margin-bottom: 10px;
   margin-right: 5%;
   padding: 5px;
   color: black;
   background-color: gray;
   border: 5px solid #03fbff;
   border-block-color: gray;
   border-radius: 50%;
   text-align: center;

  }



 </style>
</head>

<body>

 <!-- navbar -->

 <div>
  <div class="navbar-p">
   <nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
     <a class="navbar-brand" href="#"><i class="fa-solid fa-wheat-awn"></i> AGRIVI</a>
     <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
      aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
     </button>
     <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
       <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="/index.html">Home</a>
       </li>
       <li class="nav-item">
        <a class="nav-link" href="/dashboard_navbaritems/s_team.html">Team</a>
       </li>
       <li class="nav-item">
        <a class="nav-link" href="#">Pricing</a>
       </li>
       <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
         aria-expanded="false">
         Solutions
        </a>
        <ul class="dropdown-menu">
         <li><a class="dropdown-item" href="/dashboard_navbaritems/s_farmersolution.html">For Farmers</a></li>
         <li><a class="dropdown-item" href="/dashboard_navbaritems/s_fundersolution.html">For Fnders</a></li>
         <li><a class="dropdown-item" href="/dashboard_navbaritems/s_iotsolution.html">IOT & Precision
           Farming</a></li>
         <li><a class="dropdown-item" href="/dashboard_navbaritems/s_supplychainsolution.html">Supply Chain</a>
         </li>
        </ul>
       </li>
       <li class="nav-item">
        <a class="nav-link"  href="">My Cart(0)</a>
       </li>
      </ul>
     </div>
    </div>
   </nav>
  </div>
 </div>

</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</html>