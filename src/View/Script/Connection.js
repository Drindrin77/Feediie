$(document).ready(function () {
    $("#btnSubmit").click(function (e) {
        let email = $("#email").val()
        let password = $("#password").val()
        document.getElementById("matchError").hidden = true;
        
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
        console.log("Ici")
        //Pas encore fait
        if (isValid) {
            $.post("/ajax.php?entity=user&action=connection",
            {
                'email': email,
                'password': password
            })
            .fail(function (e){
                console.log("fail", e)
            })
            .done(function (e){
                if(e['status'] === 'success'){
                    console.log("Success");
                    console.log(e);
                    if(e['data'][0] === "rate"){
                        console.log("Ratttttt")
                        document.getElementById("matchError").hidden = false;
                    }else{
                        document.location.href = "/";
                    }
                }else{
                    //Error
                }
            })
        }
    
    })
    
    
    $("#btnForgotten").click(function (e) {
        let emailForgotten = $("#email").val()
        
        let isValid = true
    
        if (!emailForgotten.trim()) {
            console.log(email);
            document.getElementById("emailError").hidden = false;
            isValid = false
        }
    
        var mailFormat = /^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/;
        if(!emailForgotten.match(mailFormat)){
            document.getElementById("emailError").hidden = false;
            isValid = false;
        }else{
            document.getElementById("emailError").hidden = true;
        }
    
        //Pas encore fait
        if (isValid) {
            $.post("/ajax.php?entity=user&action=passwordForgotten",
            {
                'email': emailForgotten
            })
            .fail(function (e){
                console.log("fail", e)
            })
            .done(function (e){
                if(e['status'] === 'success'){
                    console.log("Success");
                    document.location.href = "/connection";
                }else{
                    //Error
                }
            })
        }
    
    })
});
