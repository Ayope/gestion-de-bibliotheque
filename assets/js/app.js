function func(id){
    document.getElementById("modal_id").value=id;
}

const togglePassword = document.querySelector("#togglePassword");
const password = document.querySelector("#password");

togglePassword.addEventListener('click', function(e){
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);

    this.classList.toggle('fa-eye-slash');
})

let loginBtn = document.getElementsById("login");

loginBtn.addEventListener('click', function(e){
    document.forms['formLogin'].reset();
})


