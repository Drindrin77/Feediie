$(document).ready(function () {
    $("#btnSubmit").click(function (e) {
        let email = $("#email").val()
        let password = $("#password").val()
        let birthday = $("#birthday").val()
        let sex = $("#sex").val()
        let city = $("#city").val()

        document.getElementById("createError").hidden = true;
        
        let isValid = true
        if (!password.trim()) {
            document.getElementById("passwordError").hidden = false;
            isValid = false
        }
    
        if (!email.trim()) {
            console.log(email);
            document.getElementById("emailError").hidden = false;
            isValid = false
        }
    
        var mailFormat = /^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/;
        if(!email.match(mailFormat)){
            document.getElementById("emailError").hidden = false;
            isValid = false;
        }else{
            document.getElementById("emailError").hidden = true;
        }
        
        var passwordFormat = /^((?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!#$%&'*+-/=?^_`{|}~]))(?=.{6,})/;
        if(password.match(passwordFormat)){
            document.getElementById("passwordError").hidden = true;
        }else{
            document.getElementById("passwordError").hidden = false;
            isValid = false;
        }
        
        if (isValid) {
            $.post("/ajax.php?entity=user&action=register",
            {
                'email': email,
                'password': password,
                'birthday': birthday,
                'sex': sex,
                'city': city
            })
            .fail(function (e){
                console.log("fail", e)
            })
            .done(function (e){
                if(e['status'] === 'success'){
                    console.log("Success");
                    if(e['success'][0] === "rate"){
                        document.getElementById("createError").hidden = false;
                    }else{
                        document.location.href = "/";
                    }
                }else{
                    console.log("ici3")
                    //Error
                }
            })
        }
    
    })
    