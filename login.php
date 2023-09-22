<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/login.css">
    <link rel = "icon" href = "img/logo.png" type = "image/x-icon">
    <style>

    </style>
</head>
<body>

      <div class="login-container" id="login-app">
        <div class="left-side">
            <a href="index.php"><img class="logo" src="img/cakes.png" alt=""></a>
        </div>
        <div class="right-side" >
            <div class="login-form" >
            <h2>Login</h2>
                <form @submit="fnLogin($event)">
                    <div class="form-group">
                        <input type="text" name="username" required>
                        <label for="username">Username</label>
                    </div>
                    

                <div class="form-group">
                <input type="password" name="password" id="idpass" required>
                <label for="password">Password</label>
                  <i class="password-toggle  fas fa-eye bg-light text-dark" id="togglePassword" required=""></i>
            </div>
            <div>
            <p id="invalidMessage" class="hidden"></p>
                <p id="lockedMessage" class="hidden"></p>
                </div>
                    <div class="button-container">
                        <button type="submit">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                          Login
                        </button>
                      <a class="forgot-password" href='reg.php'>Sign Up</a>
                           
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script src="js/vue.3.js"></script>
    <script src="js/axios.js"></script>
    <script src="js/login.js"></script>
    <script>
           const formFields = document.querySelectorAll('input[type="text"], input[type="password"]');

              formFields.forEach((field) => {
                  field.addEventListener('input', () => {
                      if (field.value !== '') {
                          field.classList.add('has-content');
                      } else {
                          field.classList.remove('has-content');
                      }
                  });
              });



    const togglePassword = document.querySelector("#togglePassword");
        const password = document.querySelector("#idpass");

        togglePassword.addEventListener("click", function () {
          // toggle the type attribute for the first password field
          const type = password.getAttribute("type") === "password" ? "text" : "password";
          password.setAttribute("type", type);

          // toggle the icon class for the first password field
          this.classList.toggle("fa-eye");
          this.classList.toggle("fa-eye-slash");
        });

    
      </script>
</body>
</html>