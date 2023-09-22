<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/reg.css">
    <link rel = "icon" href = "img/logo.png" type = "image/x-icon">
</head>
<body> 
<div class="login-container" id="register-app">
    <div class="left-side">
    <a href="index.php"><img class="logo" src="img/cakes.png" alt=""></a>
    </div>
    <div class="right-side">
        <div class="login-form">
            <h2>Register New Account</h2>
            <form @submit="fnSave($event)" class="reg">
                <div class="user-box">
                    <input type="text" id="fullname" name="fullname" v-model="fullname" required>
                    <label for="fullname">Fullname</label>
                </div>
                <div class="user-box">
                    <input type="text" id="username" name="username" v-model="username" required>
                    <label for="username">Username</label>
                </div>
                <div class="user-box">
                    <input type="text" id="address" name="address" v-model="address" required>
                    <label for="address">Address</label>
                </div>
                <div class="user-box">
                    <input type="tel" id="mobile" name="mobile" v-model="mobile" required>
                    <label for="mobile">Mobile Number</label>
                </div>
                <div class="user-box">
                    <input type="email" id="email" name="email" v-model="email" required>
                    <label for="email">Email</label>
                </div>
                <div class="user-box">
                    <input type="password" id="pass" name="password" v-model="password" required>
                    <label for="password">Password</label>
                    <i class="fas fa-eye password-toggle" id="togglePassword1"></i>
                </div>
                <div class="user-box">
                    <input type="password" id="confirmPass" name="confirmPassword" v-model="confirmPassword" required>
                    <label for="confirmPassword">Confirm Password</label>
                    <i class="fas fa-eye password-toggle" id="togglePassword2"></i>
                </div>
                                <div class="user-box">
                    <label for="userRole">User Role:</label>
                    <select id="userRole" name="user_role" v-model="user_role" required>
                        <option value="1">User</option>
                        <option value="2">Seller</option>
                    </select>
                </div>

                <!-- <div v-if="user_role === '2'" class="user-box">
                    <label for="shopName">Shop Name:</label>
                    <input type="text" id="shopName" name="shopname" v-model="shopname">
                </div> -->
                <div>
                <p id="successMessage" class="success-message hidden"></p>
                <p id="errorMessage" class="error-message hidden"></p>
              </div>

                <button type="submit">
                <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                    Register</button>
                <a href="login.php">Already have an account? Login</a>
            </form>
        </div>
    </div>
</div>
<script src="js/vue.3.js"></script>
<script src="js/axios.js"></script>
<script src="js/app.register.js"></script>
        <script>
        const togglePassword1 = document.querySelector("#togglePassword1");
        const togglePassword2 = document.querySelector("#togglePassword2");
        const password1 = document.querySelector("#pass");
        const password2 = document.querySelector("#confirmPass");

        togglePassword1.addEventListener("click", function () {
          // toggle the type attribute for the first password field
          const type = password1.getAttribute("type") === "password" ? "text" : "password";
          password1.setAttribute("type", type);

          // toggle the icon class for the first password field
          this.classList.toggle("fa-eye");
          this.classList.toggle("fa-eye-slash");
        });

        togglePassword2.addEventListener("click", function () {
          // toggle the type attribute for the second password field
          const type = password2.getAttribute("type") === "password" ? "text" : "password";
          password2.setAttribute("type", type);

          // toggle the icon class for the second password field
          this.classList.toggle("fa-eye");
          this.classList.toggle("fa-eye-slash");
        });
        </script>

</body>
</html>
    
