<?php
    $ideas = $this->data['ideas'];
    $users = $this->data['users'];
    $personalities = $this->data['allPersonalities'];
    $cities = $this->data['allCities'];
    $dishes = $this->data['allDishes'];
    $sexs = $this->data['allSexs'];
    $hobbies = $this->data['allHobbies'];
    $relationTypes = $this->data['allRelationType'];
    $diets = $this->data['allDiets'];
?>

<div id="containerAdmin">
    <div class="container-fluid" style="margin-top: 50px;">
        <div class="row">

            <form action="" method="POST" enctype="multipart/form-data">
                <input type="file" name="photo" class="uploadInput" data-content="Personality" style="display:none" />
                <input type="file" name="photo" class="uploadInput" data-content="Dish" style="display:none" />
                <input type="file" name="photo" class="uploadInput" data-content="Relation" style="display:none" />
            </form>

            <div class="col-lg-5 col-md-10 col-sm-10 tableBackground" style="padding-top:50px">
                <h3 class="titleTab">Liste des suggestions</h3>               

                <div class="table-responsive tableSize">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                            <th scope="col">Nom</th>
                            <th scope="col">Message</th>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach($ideas as $idea){
                                    echo '<tr data-id='.$idea['ididea'].'>
                                    <td>'.$idea['firstname'].'</td>
                                    <td>'.$idea['message'].'</td>
                                    <td><button data-content="Idea" class="btn btn-danger deleteTabOneElement">Supprimer</button></td>
                                </tr>';
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-lg-7">
                <ul class="nav nav-tabs" style="margin-bottom:50px">
                    <li class="nav-item">
                        <span class="nav-link active activeNav" id="firstTab" targetIDContent='contentUser'>Utilisateurs</span>
                    </li>
                    <li class="nav-item">
                        <span class="nav-link" targetIDContent='contentRelation'>Relation</span>
                    </li>
                    <li class="nav-item">
                        <span class="nav-link" targetIDContent='contentSex'>Sexe</span>
                    </li>
                    <li class="nav-item">
                        <span class="nav-link" targetIDContent='contentCity'>Ville</span>
                    </li>
                    <li class="nav-item">
                        <span class="nav-link" targetIDContent='contentDiet'>Régime alimentaire</span>
                    </li>
                    <li class="nav-item">
                        <span class="nav-link" targetIDContent='contentDish'>Plats</span>
                    </li>
                    <li class="nav-item">
                        <span class="nav-link" targetIDContent='contentPersonality'>Personnalité</span>
                    </li>
                    <li class="nav-item">
                        <span class="nav-link" targetIDContent='contentHobby'>Hobby</span>
                    </li>
                </ul>

            
            
            
                <div id="navContentContainer">
                    <div class="navContent" id="contentUser">
                        <h3 class="titleTab">Liste des utilisateurs</h3>
                        <div class="table-responsive tableSize table-hover">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                    <th scope="col">Nom</th>
                                    <th scope="col">
                                        <div class="dropdown" style="cursor:pointer">
                                            <div class="triggerDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Email <i class="fas fa-angle-down"></i>
                                            </div>
                                            <div style="padding-right:15px; padding-left:15px; width:235px" class="dropdown-menu noCursor" aria-labelledby="navbarDropdown">
                                                <div class="stayOpenDropDownItem"><input type="text" id="searchUser"/> <i id="searchIcon" class="fas fa-search"></i></div>
                                            </div>
                                        </div>
                                
                                    </th>
                                    <th scope="col">Report</th>
                                    <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="bodyTableUser">
                                    <?php
                                        foreach($users as $user){
                                            echo '<tr class="contentUserTable" data-hidden="false" data-email='.$user['email'].' onclick="document.location.href=\'/profile/'.$user['uniqid'].'\'" data-id='.$user['iduser'].'>
                                            <td>'.$user['firstname'].'</td>
                                            <td>'.$user['email'].'</td>
                                            <td>'.$user['nbreport'].'</td>
                                            <td><button class="btn btn-primary modifyAdmin">
                                            ';
                                            if($user['isadmin']){
                                                echo 'Destituer';
                                            }else{
                                                echo 'Promouvoir';
                                            }
                                            echo'</button>
                                            <button data-content="User" class="btn btn-danger deleteUser">Supprimer</button></td>
                                            </tr>';
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>


                    <div class="navContent invisible" id="contentRelation">
                    <span id="errorAddRelation" class="errorMsg"></span>
                        <div class="card AdminCard">

                            <div class="card-header">
                                Type de relation
                                <button style="float:right" onclick="triggerPopOver('tdAddRelation')" class="btn btn-primary btnAddElement">
                                            <i class="fas fa-plus"></i>
                                            <span class="addText">Ajouter</span>
                                        </button>  
                                
                            </div>
                            <div class="card-body bodyAdminCard">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                            <th scope="col">Image</th>
                                            <th scope="col">Nom</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tableBodyRelation">

                                            <tr class="relationTr" data-hidden='true' id="tdAddRelation">

                                                <td>
                                                    <div data-containImg='false' class="containerImgRelation" id="containerImgUploadRelation">

                                                    </div>
                                                </td>
                                                <td><input type="text" id="nameAddRelation"></td>
                                                <td><textarea rows='3' style="width:100%" id="descriptionAddRelation"></textarea></td>
                                                <td>                                                    
                                                    <button style="margin-bottom:10px" data-content="Relation" class="btn btn-info photoAddCard">
                                                    <i class="fas fa-plus"></i> Photo
                                                    </button>
                                                    <button id="submitAddRelation" class="btn btn-primary">Confirmer</button></td>
                                            </tr>


                                            <?php
                                                foreach($relationTypes as $relation){
                                                    echo '<tr class="relationTr" data-id='.$relation['idrelationtype'].'>
                                                    <td><div class="containerImgRelation"><img class="image" src="'.$relation['iconurl'].'"/></div></td>
                                                    <td><b>'.$relation['name'].'</b></td>
                                                    <td>'.$relation['description'].'</td>
                                                    <td><button class="btn btn-danger deleteRelation">Supprimer</button></td>
                                                    </tr>';
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div  class="navContent invisible" id="contentSex">
                        <div class="card AdminCard">
                            <div class="card-header">
                                Sexe

                                <div class="containerDropdownElement" class="dropdown">
                                    <div class="triggerDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <button class="btn btn-primary btnAddElement">
                                            <i class="fas fa-plus"></i>
                                            <span class="addText">Ajouter</span>
                                        </button>                     
                                    </div>
                                    <div class="dropdown-menu noCursor contentDropdownElement" aria-labelledby="navbarDropdown">
                                        <div class="stayOpenDropDownItem">
                                            <span id="errorAddSex" class="errorMsg"></span><br>
                                            <input id="textAddSex" type="text"/>
                                            <button data-content="Sex" class="btn btn-primary submitAddTabOneElement">
                                                Confirmer
                                            </button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="card-body bodyAdminCard">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                            <th scope="col">Nom</th>
                                            <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tableBodySex">
                                            <?php
                                                foreach($sexs as $sex){
                                                    echo '<tr data-id='.$sex['name'].'>
                                                    <td>'.$sex['name'].'</td>
                                                    <td><button data-content="Sex" class="btn btn-danger deleteTabOneElement">Supprimer</button></td>
                                                    </tr>';
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                
                    <div  class="navContent invisible" id="contentCity">
                        <div class="card AdminCard">
                            <div class="card-header">
                                Ville
                                <div class="containerDropdownElement" class="dropdown">
                                    <div class="triggerDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <button class="btn btn-primary btnAddElement">
                                            <i class="fas fa-plus"></i>
                                            <span class="addText">Ajouter</span>
                                        </button>                     
                                    </div>
                                    <div class="dropdown-menu noCursor contentDropdownElement" aria-labelledby="navbarDropdown">
                                        <div class="stayOpenDropDownItem">
                                            <span id="errorAddCity" class="errorMsg"></span><br>

                                            Ville:
                                            <input id="textAddCity" type="text" class="marginBottom"/>
                                            <br >
                                            Code postal:
                                            <input id="textAddZipCode" type="text" class="marginBottom"/>
                                            <br>
                                            <button id="submitAddCity" style="float:right"class="btn btn-primary">
                                                Confirmer
                                            </button>
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <div class="card-body bodyAdminCard">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                            <th scope="col">Ville</th>
                                            <th scope="col">Code postal</th>
                                            <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tableBodyCity">
                                            <?php
                                                foreach($cities as $city){
                                                    echo '<tr data-id='.$city['idcity'].'>
                                                    <td>'.$city['name'].'</td>
                                                    <td>'.$city['zipcode'].'</td>
                                                    <td><button class="btn btn-danger deleteCity">Supprimer</button></td>
                                                    </tr>';
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>            
                    </div>


                    <div  class="navContent invisible" id="contentDiet">
                        <div class="card AdminCard">
                            <div class="card-header">
                                Régime alimentaire
                                <div class="containerDropdownElement" class="dropdown">
                                    <div class="triggerDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <button class="btn btn-primary btnAddElement">
                                            <i class="fas fa-plus"></i>
                                            <span class="addText">Ajouter</span>
                                        </button>                     
                                    </div>
                                    <div class="dropdown-menu noCursor contentDropdownElement" aria-labelledby="navbarDropdown">
                                        <div class="stayOpenDropDownItem">
                                            <span id="errorAddDiet" class="errorMsg"></span><br>
                                            <input id="textAddDiet" type="text"/>
                                            <button data-content="Diet" class="btn btn-primary submitAddTabOneElement">
                                                Confirmer
                                            </button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="card-body bodyAdminCard">
                            <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                            <th scope="col">Nom</th>
                                            <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tableBodyDiet">
                                            <?php
                                                foreach($diets as $diet){
                                                    echo '<tr data-id='.$diet['iddiet'].'>
                                                    <td>'.$diet['name'].'</td>
                                                    <td><button data-content="Diet" class="btn btn-danger deleteTabOneElement">Supprimer</button></td>
                                                    </tr>';
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>            
                    </div>
 
                    <div class="navContent invisible" id="contentPersonality">
                        <div class="card AdminCard">
                            <div class="card-header">
                                Personnalité

                                <div class="containerPopOver">

                                    <div class="contentPopOver" id="containerPopOverPersonality" data-hidden='true'>

                                        <span id="errorAddPersonality" class="errorMsg"></span>

                                        <div>
                                            <div class="card cardElement cardPhotoAdd">
                                                    
                                                    <div data-extension="" id="containerImgUploadPersonality" class="cardImage cardImgUpload">

                                                    </div>
                                                    <div class="card-header titleCardAdd">
                                                        <textarea class="textAreaAdd" id="textAddPersonality"></textarea>
                                                    </div>
                                                </div>


                                            <div class="GroupbuttonsAdd">
                                                <button data-content="Personality" class="btn btn-secondary buttonsAdd resetAddCard"><i class="fas fa-undo-alt"></i> Réinitialiser</button>
                                                <br>
                                                <button data-content="Personality" class="btn btn-info buttonsAdd photoAddCard"><i class="fas fa-plus"></i> Ajouter photo</button>
                                                <br>
                                                <button data-content="Personality" class="btn btn-primary buttonsAdd submitAddCard">Confirmer</button>
                                            </div> 
                                        </div>                                
                                    </div>

                                    <button class="btn btn-primary btnAddElement" onclick="triggerPopOver('containerPopOverPersonality')">
                                        <i class="fas fa-plus"></i>
                                        <span class="addText">Ajouter</span>
                                    </button>   

                                </div>
                            </div>
                            <div class="card-body bodyAdminCard" id="containerCardPersonality">

                            <?php foreach($personalities as $personality): ?>
                                <div class="card cardElement">
                                    <div class="cardImage">
                                        <img src=<?=$personality['iconurl']?> class="card-img-top image" alt="...">
                                    </div>      
                                    <div class="overlay"></div>
                                    <div class="containerBtnOverlay containerDeleteBtn">
                                        <button data-content='Personality' data-id=<?=$personality['iddish']?> class="btn btnDelete deleteCard"><i class="fa fa-trash"></i> Supprimer</button>
                                    </div>
                                    <div class="card-header titleCard"><?= $personality['name']?></div>
                                </div>
                                <?php endforeach ?>
                                
                            </div>
                        </div>            
                    </div>


                    <div  class="navContent invisible" id="contentDish">
                        <div class="card AdminCard">
                            <div class="card-header">
                                Plat
                                <div class="containerPopOver">

                                    <div class="contentPopOver" id="containerPopOverDish" data-hidden='true'>

                                        <span id="errorAddDish" class="errorMsg"></span>

                                        <div>
                                            <div class="card cardElement cardPhotoAdd">
                                                    
                                                    <div data-extension="" id="containerImgUploadDish" class="cardImage cardImgUpload">

                                                    </div>
                                                    <div class="card-header titleCardAdd">
                                                        <textarea class="textAreaAdd" id="textAddDish"></textarea>
                                                    </div>
                                                </div>


                                            <div class="GroupbuttonsAdd">
                                                <button data-content="Dish" class="btn btn-secondary buttonsAdd resetAddCard"><i class="fas fa-undo-alt"></i> Réinitialiser</button>
                                                <br>
                                                <button data-content="Dish" class="btn btn-info buttonsAdd photoAddCard"><i class="fas fa-plus"></i> Ajouter photo</button>
                                                <br>
                                                <button data-content="Dish" class="btn btn-primary buttonsAdd submitAddCard">Confirmer</button>
                                            </div> 
                                        </div>                                
                                    </div>

                                    <button class="btn btn-primary btnAddElement" onclick="triggerPopOver('containerPopOverDish')">
                                        <i class="fas fa-plus"></i>
                                        <span class="addText">Ajouter</span>
                                    </button>   

                                </div>
                            </div>
                            <div class="card-body bodyAdminCard" id="containerCardDish">

                            <?php foreach($dishes as $dish): ?>

                                <div class="card cardElement">
                                    <div class="cardImage">
                                        <img src=<?=$dish['iconurl']?> class="card-img-top image" alt="...">
                                    </div> 
                                    <div class="overlay"></div>
                                    <div class="containerBtnOverlay containerDeleteBtn">
                                        <button data-content='Dish' data-id=<?=$dish['iddish']?> class="btn btnDelete deleteCard"><i class="fa fa-trash"></i> Supprimer</button>
                                    </div>
                                    <div class="card-header titleCard"><?= $dish['name']?></div>
                                </div>  
                                <?php endforeach?>
                                
                            </div>
                        </div>          
                    </div>

                    <div class="navContent invisible" id="contentHobby">
                        <div class="card AdminCard">
                            <div class="card-header">
                                Hobby
                                <div class="containerDropdownElement" class="dropdown">
                                    <div class="triggerDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <button class="btn btn-primary btnAddElement">
                                            <i class="fas fa-plus"></i>
                                            <span class="addText">Ajouter</span>
                                        </button>                     
                                    </div>
                                    <div class="dropdown-menu noCursor contentDropdownElement" aria-labelledby="navbarDropdown">
                                        <div class="stayOpenDropDownItem">
                                            <input id="textAddHobby" type="text"/>
                                            <button data-content="Hobby" class="btn btn-primary submitAddTabOneElement">
                                                Confirmer
                                            </button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="card-body bodyAdminCard" id="bodyHobby">
                            <?php foreach($hobbies as $hobby): 
                                echo '<div data-id='.$hobby['idhobby'].' class=\'containerHobby deletehobby\'>
                                <i class="fas fa-ban deleteHobbyIcon"></i><span>'.$hobby['name'].'</span>
                                </div>';
                                endforeach ?>
                            </div>
                        </div>            
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
