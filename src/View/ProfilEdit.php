
<div class="form-group">
    <label for="passwordInput">Ancien mot de passe</label>
    <br>
    <input class="w-75" required type="password" id="oldPassword" name="password" placeholder="Mot de passe">
</div>

<div class="form-group">
    <label for="passwordInput">Nouveau mot de passe</label>
    <br>
    <input class="w-75" required type="password" id="newPassword" name="password" placeholder="Mot de passe">
</div>
<div class="form-group">
    <label for="confirmedPasswordInput">Confirmer le mot de passe</label>
    <br>
    <input class="w-75" required type="password" id="confirmPassword" name="confirmedPasswordInput" id="confirmedPasswordInput" placeholder="Confirmation du mot de passe">
</div>

<div>
    <input type="button" id="btnSubmit" value="Confirmer"/>
</div>


<script>


        $("#btnSubmit").click(function(e){
            let oldPassword = $("#oldPassword").val()
            let newPassword = $("#newPassword").val()
            let confirmPassword = $("#confirmPassword").val()

            let isValid = true
            if(!oldPassword.trim()){
                console.log("OLD PASSWORD EMPTY")
                isValid = false
            }
            if(!newPassword.trim()){
                console.log("NEW PASSWORD EMPTY")
                isValid = false
            }
            if(!confirmPassword.trim()){
                console.log("CONFIRM PASSWORD EMPTY")
                isValid = false
            }
            if(newPassword != confirmPassword){
                console.log("NEWPASSWORD != CONFIRMPASSWORD")
                isValid = false
            }

            if(isValid){
                if(newPassword == oldPassword){
                    console.log("NEWPASSWORD == OLDPASSWORd")
                }else{

                    $.post("/ajax.php?entity=user&action=resetpassword",
                    {   
                        'oldPassword': oldPassword,
                        'newPassword': newPassword
                    })
                    .fail(function(e){
                        console.log("fail",e)
                    })
                    .done(function(e){
                        console.log("done",e)
                        if(e['status']==='success'){
                            console.log("success")
                        }else{
                            console.log("error")
                        }
                    })

                }
            }
            
        })


</script>