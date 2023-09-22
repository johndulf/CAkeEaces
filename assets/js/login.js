const {createApp} = Vue;

createApp({
    data(){
        return{
            
        }
    },
    methods:{
        fnLogin:function(e){
            const vm = this;
            e.preventDefault();    
            var form = e.currentTarget;
            const data = new FormData(form);
            data.append('method','fnLogin');
            axios.post('model/userModel.php',data)
            .then(function(r){
                console.log(r.data)
                if(r.data.ret == 1){
                    if(r.data.user_role == 1){
                        window.location.href = 'index.php';
                    }else if(r.data.user_role == 2){
                        window.location.href = 'dashboard.php';
                    }
                }
                else if(r.data.ret == 3){
                    invalidMessage.innerHTML = '<div class="alert alert-danger d-flex align-items-center" role="alert"><i class="fa fa-exclamation-triangle m-1"></i>Invalid Username Or Password</div>';
                    invalidMessage.style.display = 'block';
                    lockedMessage.style.display = 'none';
                }
                else if(r.data.ret == 4){
                lockedMessage.innerHTML = '<div class="alert alert-danger d-flex align-items-center" role="alert"><i class="fa fa-exclamation-triangle m-1"></i>Account Locked</div>';
                lockedMessage.style.display = 'block';
                invalidMessage.style.display = 'none';
                }
                // console.log(r.data);
            })
        },
        
    },
    created:function(){
        
    }
}).mount('#login-app')