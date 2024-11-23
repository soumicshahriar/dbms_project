<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Document</title>
 <style>
  * {
   margin: 0;
   padding: 0;
   box-sizing: border-box;
   font-family: Arial, sans-serif;
  }

  body {
   display: flex;
   justify-content: center;
   /* Horizontally center the form */
   align-items: center;
   /* Vertically center the form */
   height: 100vh;
   /* Full height of the viewport */
   /* background: linear-gradient(270deg, #5ed1d7, #02f2ff, #00ffe5, #0dffeb, #00f8db); */
  }

  .form-container {
   display: flex;
   flex-direction: column;
   text-align: center;
   border-radius: 20%;
   height: 90vh;
   /* border: 5px solid gray;
   border-block-color: #03fbff;
   background: linear-gradient(270deg, #5ed1d7, #003ef8, #000000, #101011, #00f8db);
   background-size: 400% 400%; */
   width: 50%;
   /* padding: 1%;  */
   margin: auto;
   /* margin-top: 20%; */
   /* margin-bottom: 15%; */

  }

  .form-container:hover {
   transform: scale(1.02);
   box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);
  }

  #productForm select {
   border: 5px solid gray;
   
  }

  #productForm select:hover {
   border: 5px solid gray;
   border-block-color: #03fbff;
  
  }

  label {
   display: block;
   margin-bottom: 5px;
   color: white;
   background: linear-gradient(to bottom, rgb(196, 201, 214), rgb(0, 0, 0));
  }

  input {
   background: bisque;
   color: black;
   width: 100%;
   padding: 8px;
   border: 3px solid #000000;
   border-radius: 3px;
   margin-bottom: 5%;
   
  }

  input:hover {
   background: linear-gradient(270deg, #02f2ff, #02f2ff, #02f2ff, #02f2ff, #02f2ff);
   width: 100%;
   margin-bottom: 5%;
   padding: 8px;
   color: black;
   background-color: gray;
   border: 5px solid #03fbff;
   border-block-color: gray;
   border-radius: 50%;
   text-align: center;
  }

  #productForm select {
   background: bisque;
   color: black;
   width: 100%;
   margin-bottom: 5%;
   padding: 8px;
   border: 3px solid #000000;
   border-radius: 3px;
  }

  #productForm select:hover {
   background: linear-gradient(270deg, #02f2ff, #02f2ff, #02f2ff, #02f2ff, #02f2ff);
   width: 100%;
   margin-right: 5%;
   padding: 8px;
   color: black;
   background-color: gray;
   border: 5px solid #03fbff;
   border-block-color: gray;
   border-radius: 50%;
   text-align: center;
  }

  .addbutton {
   /* margin: 2%; */
   padding: 2%;
   width: 60%;
   border: 5px solid #03fbff;
   border-block-color: gray;
   border-radius: 20%;
   background-color: transparent;
   margin-bottom: 10%;
  }

  .addbutton:hover {
   /* margin: 2%; */
   /* margin-top: -2%; */
   padding: 1%;
   border: 5px solid gray;
   border-block-color: #03fbff;
   border-radius: 25%;
   background-color: gray;

  }
 </style>
</head>

<body>
 <div class="form-container">

  <?php include('message.php'); ?>

  <div>
   <h4 style="color: white;" class="product-management">Product Management Form</h4>
  </div><br><br>
  <form method="POST" id="productForm" action="product.php">

   <!-- <label for="id">Product ID</label>
     <input type="number" id="id" name="id"><br> -->

   <label for="productName">Product Name:</label>
   <select id="productName" name="productName" required>
    <option value="Rice">Rice</option>
    <option value="Wheat">Wheat</option>
    <option value="Apples">Apples</option>
    <option value="Bananas">Bananas</option>
    <option value="Potatoes">Potatoes</option>
    <option value="Carrots">Carrots</option>
    <option value="Milk">Milk</option>
    <option value="Cheese">Cheese</option>
    <option value="Chicken">Chicken</option>
    <option value="Beef">Beef</option>
    <option value="Salmon">Salmon</option>
    <option value="Shrimp">Shrimp</option>
    <option value="Almonds">Almonds</option>
    <option value="Sunflower Seeds">Sunflower Seeds</option>
    <option value="Basil">Basil</option>
    <option value="Turmeric">Turmeric</option>
    <option value="Orange Juice">Orange Juice</option>
    <option value="Coffee">Coffee</option>
    <option value="Olive Oil">Olive Oil</option>
    <option value="Coconut Oil">Coconut Oil</option>
   </select><br>

   <label for="category">Category:</label>
   <select id="category" name="category" required>
    <option value="">Select</option>
    <option value="Grains & Cereals">Grains & Cereals</option>
    <option value="Fruits">Fruits</option>
    <option value="Vegetables">Vegetables</option>
    <option value="Dairy Products">Dairy Products</option>
    <option value="Meat & Poultry"> Meat & Poultry</option>
    <option value="Seafood"> Seafood</option>
    <option value=" Herbs & Spices"> Herbs & Spices</option>
    <option value="Nuts & Seeds"> Nuts & Seeds</option>
    <option value=" Beverages"> Beverages</option>
    <option value="Oils & Fats"> Oils & Fats</option>
   </select><br>

   <label for="region">Region of Production</label>
   <select id="region" name="region" required>
    <option value="Dhaka">Dhaka</option>
    <option value="Chittagong">Chittagong</option>
    <option value="Rajshahi">Rajshahi</option>
    <option value="Khulna">Khulna</option>
    <option value="Barisal">Barisal</option>
    <option value="Sylhet">Sylhet</option>
    <option value="Rangpur">Rangpur</option>
    <option value="Mymensingh">Mymensingh</option>
    <option value="Comilla">Comilla</option>
    <option value="Gazipur">Gazipur</option>
    <option value="Narail">Narail</option>
    <option value="Bogra">Bogra</option>
    <option value="Jessore">Jessore</option>
    <option value="Pabna">Pabna</option>
    <option value="Dinajpur">Dinajpur</option>
    <option value="Faridpur">Faridpur</option>
    <option value="Tangail">Tangail</option>
    <option value="Narayanganj">Narayanganj</option>
    <option value="Jamalpur">Jamalpur</option>
    <option value="Kushtia">Kushtia</option>
   </select><br>

   <label for="season">Seasionality</label>
   <select id="season" name="season" required>
    <option value="Summer">Summer</option>
    <option value="Monsoon">Monsoon</option>
    <option value="Autumn">Autumn</option>
    <option value="Late Autumn">Late Autumn</option>
    <option value="Winter">Winter</option>
    <option value="Spring">Spring</option>
    <option value="All Year Round">All Year Round</option>

   </select><br>

   <label for="quantity">Quantity (kg):</label>
   <input type="number" id="quantity" name="quantity" min="1" value="1"><br>

   <label for="productionCost">Production Cost (per Kg):</label>
   <input type="number" id="productionCost" name="productionCost" step="0.01" required><br>

   <label for="productionDate">Production Date:</label>
   <input type="date" id="productionDate" name="productionDate" required><br>

   <label for="expirationDate">Expiration Date:</label>
   <input type="date" id="expirationDate" name="expirationDate" required><br>

   <a href="./s_product.php"><button class="addbutton" type="submit" name="add_product">Add Product</button></a>
  </form>
 </div>
</body>

</html>