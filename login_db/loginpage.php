<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login and Signup Page</title>
  <link rel="stylesheet" href="loginpage.css">
  <script>
    // Prevent the back navigation after login/logout
    if (window.history && window.history.pushState) {
      window.history.pushState(null, null, window.location.href);
      window.history.back();
      window.history.forward();
    }

    // Optional: Prevent back button press using the onpopstate event
    window.onpopstate = function() {
      window.history.go(1);
    };
  </script>
</head>

<body>
  <div class="container">
    <!-- Signup Form -->
    <div class="form-container">
      <h2>Signup</h2>
      <div class="rope"></div>
      <form method="post" action="register.php" id="signup-form">
        <label for="name">Name</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>

        <label for="phone">Phone Number</label>
        <input type="phone" id="phone" name="phone" required>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>

        <label for="role">Employee Role</label>
        <select id="role" name="role" required>
          <option value="AGRICULTURE_OFFICER">AGRICULTURE_OFFICER</option>
          <option value="FARMER">FARMAR</option>
          <option value="MARKET_MANAGER">MARKET_MANAGER</option>
          <option value="WARHOUSE_MANAGER">WARHOUSE_MANAGER</option>
          <option value="FOODQUALITY_OFFICER">FOODQUALITY_OFFICER</option>
          <option value="GOVERNMENT_OFFICER">GOVERNMENT_OFFICER</option>
          <option value="CUSTOMER">CUSTOMER</option>
        </select>

        <button type="submit" name="signUp">Signup</button>
      </form>
    </div>

    <!-- Login Form -->
    <div class="form-container">
      <h2>Login</h2>
      <div class="rope"></div>
      <form method="post" action="register.php" id="login-form">
        <!-- <label for="name-login">Name</label>
        <input type="text" id="name-login" name="name" required> -->

        <label for="email-login">Email</label>
        <input type="email" id="email-login" name="email" required>

        <label for="password-login">Password</label>
        <input type="password" id="password-login" name="password" required>

        <label for="role">Employee Role</label>
        <select id="role" name="role" required>
          <option value="AGRICULTURE_OFFICER">AGRICULTURE_OFFICER</option>
          <option value="FARMER">FARMER</option>
          <option value="MARKET_MANAGER">MARKET_MANAGER</option>
          <option value="WARHOUSE_MANAGER">WARHOUSE_MANAGER</option>
          <option value="FOODQUALITY_OFFICER">FOODQUALITY_OFFICER</option>
          <option value="GOVERNMENT_OFFICER">GOVERNMENT_OFFICER</option>
          <option value="CUSTOMER">CUSTOMER</option>
        </select>

        <button type="submit" name="signIn">Login</button>
      </form>
    </div>
  </div>
</body>

</html>