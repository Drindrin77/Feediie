$(document).ready(function () {
    console.log("go")   
    $("#btnSubmit").click(function (e) {
        let email = $("#email").val()
        let password = $("#password").val()
        let passwordConfirmed = $("#confirmedPassword").val()
        let birthday = $("#birthday").val()
        let sex = $("#sex option:selected").val();
        let city = $("#city option:selected").val();
        let name = $("#name").val()
        let firstName = $("#firstname").val()
        
        var dateFormat = /^(19|20)\d\d[- /.](0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])$/
        var textFormat = /([a-zA-Z]+)/;
        var numberFormat = /([0-9])/;

        document.getElementById("createError").hidden = true;
        document.getElementById("emailError").hidden = true;
        document.getElementById("cityError").hidden = true;
        document.getElementById("passwordError").hidden = true;
        document.getElementById("birthdayError").hidden = true;
        document.getElementById("sexError").hidden = true;
        document.getElementById("matchPwdError").hidden = true;
        document.getElementById("nameError").hidden = true;
        document.getElementById("fNameError").hidden = true;

        let isValid = true
        if (!password.trim()) {
            document.getElementById("passwordError").hidden = false;
            isValid = false
        }
        
        if( !name.trim()){
            document.getElementById("nameError").hidden = false;
            isValid = false
        }
        if( !firstName.trim()){
            document.getElementById("fNameError").hidden = false;
            isValid = false
        }


        if (!email.trim()) {
            document.getElementById("emailError").hidden = false;
            isValid = false
        }
    
        var mailFormat = /^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/;
        if(!email.match(mailFormat)){
            document.getElementById("emailError").hidden = false;
            isValid = false;
        }
        
        var passwordFormat = /^((?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!#$%&'*+-/=?^_`{|}~]))(?=.{6,})/;
        if(!password.match(passwordFormat)){
            document.getElementById("passwordError").hidden = false;
            isValid = false;
        }
        

        if(!birthday.match(dateFormat)){
            document.getElementById("birthdayError").hidden = false;
            isValid = false;
        }

        if(!city.match(numberFormat)){
            document.getElementById("cityError").hidden = false;
            isValid = false;
        }

        if(!sex.match(textFormat)){
            document.getElementById("sexError").hidden = false;
            isValid = false;
        }
        
        if(password != passwordConfirmed){
            document.getElementById("matchPwdError").hidden = false;
            isValid = false;
        }

        if (isValid) {
            $.post("/ajax.php?entity=user&action=register",
            {
                'name': name,
                'firstname': firstName,
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
                if(e['status'] == 'success'){
                    console.log("Success");
                    if(e['success'][0] === "echec"){
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
})