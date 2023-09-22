const {createApp} = Vue;

createApp({
    data(){
        return{
            users:[],
            // search:[],
            userid:0,
            fullname:'',
            username:'',
            password:'',
            confirmPassword:'',
            address:'',
            mobile:'',
            email:'',
            user_role:'',
            // shopname:''
        }
    },
    methods:{
        fnUnlockAccount: function(userid) {
          const vm = this;
          Swal.fire({
            title: "Confirmation",
            text: "Are you sure you want to unlock this user?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Unlocked",
            cancelButtonText: "Cancel"
          }).then(function(result) {
            if (result.isConfirmed) {
              const data = new FormData();
              data.append("method", "fnUnlockAccount");
              data.append("userid", userid);
              axios.post('model/userModel.php', data)
                .then(function(r) {
                  // Show success message using SweetAlert
                  Swal.fire({
                    title: "Success",
                    text: "Account successfully unlock",
                    icon: "success"
                  }).then(function() {
                    vm.fnGetUsers(0);
  
                  });
                })
                .catch(function(error) {
                  console.error(error);
                  // Show error message using SweetAlert
                  Swal.fire({
                    title: "Error",
                    text: "Failed to unlock account",
                    icon: "error"
                  });
                });
            }
          });
        },
  
      fnLockAccount: function(userid) {
        const vm = this;
        Swal.fire({
          title: "Confirmation",
          text: "Are you sure you want to lock this user?",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#d33",
          cancelButtonColor: "#3085d6",
          confirmButtonText: "Yes, lock it!",
          cancelButtonText: "Cancel"
        }).then(function(result) {
          if (result.isConfirmed) {
            const data = new FormData();
            data.append("method", "fnLockAccount");
            data.append("userid", userid);
            axios.post('model/userModel.php', data)
              .then(function(r) {
                // Show success message using SweetAlert
                Swal.fire({
                  title: "Success",
                  text: "User successfully lock",
                  icon: "success"
                }).then(function() {
                  vm.fnGetUsers(0);

                });
              })
              .catch(function(error) {
                console.error(error);
                // Show error message using SweetAlert
                Swal.fire({
                  title: "Error",
                  text: "Failed to lock user",
                  icon: "error"
                });
              });
          }
        });
      },

        fnSave:function(e) {
          e.preventDefault();
          const vm = this;
          const form = e.currentTarget;
          const successMessage = document.getElementById('successMessage');
          const errorMessage = document.getElementById('errorMessage');
      
          // Check if password and confirm password match
          if (this.password !== this.confirmPassword) {
            errorMessage.innerHTML = '<i class="fa fa-exclamation-triangle" style="color: red;"></i>Password and Confirm Password do not match.';
            errorMessage.style.display = 'block';
            successMessage.style.display = 'none';
            return;
          }
      
          const data = new FormData(form);
          data.append('userid', this.userid);
          data.append('method', 'fnSave');
      
          axios
            .post('model/userModel.php', data)
            .then(function(response) {
              console.log(response);
              if (response.data === 1) {
                successMessage.innerHTML = 'User Successfully registered';
                successMessage.style.display = 'block';
                errorMessage.style.display = 'none';
      
                setTimeout(function() {
                  window.location.href = 'login.php';
                  vm.fnGetUsers(0);
                }, 2000);
              } else if (response.data === 'exists_username') {
                errorMessage.innerHTML = '<i class="fa fa-exclamation-triangle" style="color: red;"></i> This username has already been registered. Please choose another username.';
                errorMessage.style.display = 'block';
                successMessage.style.display = 'none';
              } else if (response.data === 'exists_username_password') {
                errorMessage.innerHTML = '<i class="fa fa-exclamation-triangle" style="color: red;"></i> Both the username and password have already been registered. Please choose different values for both.';
                errorMessage.style.display = 'block';
                successMessage.style.display = 'none';
              } else {
                errorMessage.innerHTML = 'There was an error.';
                errorMessage.style.display = 'block';
                successMessage.style.display = 'none';
              }
            })
            .catch(function(error) {
              console.log(error);
              errorMessage.innerHTML = 'There was an error.';
              errorMessage.style.display = 'block';
              successMessage.style.display = 'none';
            });
        },
        
        
fnUpdate: function(e) {
  e.preventDefault();
  const vm = this;
  const form = e.currentTarget;
  const data = new FormData(form);
  data.append("method", "fnUpdate");
  data.append("userid", this.userid);

  axios.post("model/userModel.php", data)
    .then(function(response) {
      console.log(response);
      if (response.data === 1) {
        alert("User information has been updated.");
        window.location.reload();
        vm.fnGetUsers(0);
      } else if (response.data === 2) {
        alert("There was an error updating your information!");
      }
    })
    .catch(function(error) {
      console.log(error);
      alert("There was an error updating your information!");
    });
},


  


        
DeleteUser: function(userid) {
  const vm = this;
  Swal.fire({
    title: "Confirmation",
    text: "Are you sure you want to delete this user?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#d33",
    cancelButtonColor: "#3085d6",
    confirmButtonText: "Yes, delete it!",
    cancelButtonText: "Cancel"
  }).then(function(result) {
    if (result.isConfirmed) {
      const data = new FormData();
      data.append("method", "DeleteUser");
      data.append("userid", userid);
      axios.post('model/userModel.php', data)
        .then(function(r) {
          // Show success message using SweetAlert
          Swal.fire({
            title: "Success",
            text: "User successfully deleted",
            icon: "success"
          }).then(function() {
            // Redirect to "users.php"
            window.location.reload();
          });
        })
        .catch(function(error) {
          console.error(error);
          // Show error message using SweetAlert
          Swal.fire({
            title: "Error",
            text: "Failed to delete user",
            icon: "error"
          });
        });
    }
  });
},

  
        RestoreUser: function(userid) {
    if (confirm("Are you sure you want to restore this user?")) {
        const data = new FormData();
        data.append("method", "RestoreUser");
        data.append("userid", userid);

        axios.post('model/userModel.php', data)
            .then(function(response) {
                // Handle the restoration process
                console.log("User restored successfully!");
            })
            .catch(function(error) {
                console.log(error);
            });
    }
},

        fnGetUsers:function(userid){
            const vm = this;
            const data = new FormData();
            data.append("method","fnGetUsers");
            data.append("userid",userid);
            axios.post('model/userModel.php',data)
            .then(function(r){
                if(userid == 0){
                    vm.users = [];
                    
                    r.data.forEach(function(v){
                        
                            vm.users.push({
                                fullname: v.fullname,
                                username: v.username,
                                address: v.address,
                                mobile:v.mobile,
                                // password : v.password,
                                user_role:v.user_role,
                                // shopname:v.shopname,
                                email: v.email,
                                datecreated : v.date_created,
                                dateupdated : v.updated_at,
                                userid:v.userid,
                                counterlock: v.counterlock
                            })
                                            
                        
                    })
                }
                else{
                    r.data.forEach(function(v){
                        vm.fullname = v.fullname;
                        vm.username = v.username;
                        // vm.password = v.password;
                         vm.address = v.address;
                           vm.mobile = v.mobile;
                           vm.user_role = v.user_role;
                          //  vm.shopname = v.shopname;
                        vm.email = v.email;
                        vm.userid = v.userid;
                    })
                }
            })
        }
    },
  

    created:function(){
        this.fnGetUsers(0);
    }
}).mount('#register-app')