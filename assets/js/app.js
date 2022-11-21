function func(id){
    document.getElementById("modal_id").value=id;
}

const togglePassword = document.querySelector("#togglePassword");
const password = document.querySelector("#password");

function passhow(){
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);

    togglePassword.classList.toggle('fa-eye-slash');
}

var btnSignUp = document.getElementById("signup");

var username = document.getElementById("username_inpt");
var username_err_Para = document.getElementById("username_err");

username.onkeyup = function(e){
    var pattern = /^(?=.{8,20}$)(?![_.])(?!.*[_.]{2})[A-Za-z][A-Za-z0-9_]+(?<![_.])$/;
    var currentValue = e.target.value;
    var valid = pattern.test(currentValue);

    if(valid){
        username_err_Para.style.display = 'none';
        signup.disabled = false;
    } else {
        username_err_Para.style.display = 'block';
        signup.disabled = true;
    }
}

var sign_email = document.getElementById('email_inpt');
var sign_email_err_para = document.getElementById('email_err');

emailverif(sign_email, sign_email_err_para, btnSignUp);


function emailverif(email, msg, btn){
    email.onkeyup = function(e){
        var pattern = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
        var currentValue = e.target.value;
        var valid = pattern.test(currentValue);
        
        if(valid){
            msg.style.display = 'none';
            btn.disabled = false;
        } else {
            msg.style.display = 'block';
            btn.disabled = true;
        }
    }
    
}

var sign_passsword = document.getElementById('pass_inpt');
var sign_pass_err_para = document.getElementById('pass_err');

passverif(sign_passsword, sign_pass_err_para, btnSignUp);


function passverif(password, msg, btn){
    password.onkeyup = function(e){
        var pattern = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$/;
        var currentValue = e.target.value;
        var valid = pattern.test(currentValue);
        
        if(valid){
            msg.style.display = 'none';
            btn.disabled = false;
        } else {
            msg.style.display = 'block';
            btn.disabled = true;
        }
    }
}




