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
                                    <td class="deleteIdea"><button class="btn btn-danger">Supprimer</button></td>
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
                        <div class="table-responsive tableSize">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                    <th scope="col">Nom</th>
                                    <th scope="col">
                                        <div class="dropdown">
                                            <div class="triggerDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Email <i class="fas fa-angle-down"></i>
                                            </button>
                                            <div class="dropdown-menu noCursor" aria-labelledby="navbarDropdown">
                                                <div class="stayOpenDropDownItem"><input type="text"/> <i id="searchIcon" class="fas fa-search"></i></div>
                                            </div>
                                        </div>
                                
                                    </th>
                                    <th scope="col">Report</th>
                                    <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        foreach($users as $user){
                                            echo '<tr data-id='.$user['iduser'].'>
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
                                            <button class="btn btn-danger deleteUser">Bannir</button></td>
                                        </tr>';
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>


                    <div class="navContent invisible" id="contentRelation">
                        <div class="card AdminCard">
                            <div class="card-header">
                                Type de relation
                                <button id="btnAddDish" class="btn btn-primary btnAddElement">
                                    <i class="fas fa-plus"></i>
                                    <span class="addText">Ajouter</span>
                                </button>
                            </div>
                            <div class="card-body bodyAdminCard">
                                <div class="table-responsive tableSize">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                            <th scope="col">Nom</th>
                                            <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                foreach($relationTypes as $relation){
                                                    echo '<tr data-id='.$relation['idrelationtype'].'>
                                                    <td>'.$relation['name'].'</td>
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
                                <button id="btnAddDish" class="btn btn-primary btnAddElement">
                                    <i class="fas fa-plus"></i>
                                    <span class="addText">Ajouter</span>
                                </button>
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
                                        <tbody>
                                            <?php
                                                foreach($sexs as $sex){
                                                    echo '<tr data-id='.$sex['name'].'>
                                                    <td>'.$sex['name'].'</td>
                                                    <td><button class="btn btn-danger deleteSex">Supprimer</button></td>
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
                                <button id="btnAddDish" class="btn btn-primary btnAddElement">
                                    <i class="fas fa-plus"></i>
                                    <span class="addText">Ajouter</span>
                                </button>
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
                                        <tbody>
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
                                <button id="btnAddDish" class="btn btn-primary btnAddElement">
                                    <i class="fas fa-plus"></i>
                                    <span class="addText">Ajouter</span>
                                </button>
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
                                        <tbody>
                                            <?php
                                                foreach($diets as $diet){
                                                    echo '<tr data-id='.$diet['iddiet'].'>
                                                    <td>'.$diet['name'].'</td>
                                                    <td><button class="btn btn-danger deleteDiet">Supprimer</button></td>
                                                    </tr>';
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>            
                    </div>
 
                    <div  class="navContent invisible" id="contentPersonality">
                        <div class="card AdminCard">
                            <div class="card-header">
                                Personnalité
                                <button id="btnAddDish" class="btn btn-primary btnAddElement">
                                    <i class="fas fa-plus"></i>
                                    <span class="addText">Ajouter</span>
                                </button>
                            </div>
                            <div class="card-body bodyAdminCard">

                            <?php foreach($personalities as $personality): ?>
                                <div class="card cardElement">
                                    <div class="cardImage">
                                        <img src=<?=$personality['iconurl']?> class="card-img-top image" alt="...">
                                    </div>      
                                    <div class="overlay"></div>
                                    <div class="containerBtnOverlay containerDeleteBtn">
                                        <button data-id=<?=$personality['iddish']?> class="btn btnDelete deletePersonality"><i class="fa fa-trash"></i> Supprimer</button>
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
                                <button id="btnAddDish" class="btn btn-primary btnAddElement">
                                    <i class="fas fa-plus"></i>
                                    <span class="addText">Ajouter</span>
                                </button>
                            </div>
                            <div class="card-body bodyAdminCard">

                            <?php foreach($dishes as $dish): ?>

                                <div class="card cardElement">
                                    <div class="cardImage">
                                        <img src=<?=$dish['iconurl']?> class="card-img-top image" alt="...">
                                    </div> 
                                    <div class="overlay"></div>
                                    <div class="containerBtnOverlay containerDeleteBtn">
                                        <button data-id=<?=$dish['iddish']?> class="btn btnDelete deleteDish"><i class="fa fa-trash"></i> Supprimer</button>
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
                                <button id="btnAddDish" class="btn btn-primary btnAddElement">
                                    <i class="fas fa-plus"></i>
                                    <span class="addText">Ajouter</span>
                                </button>
                            </div>
                            <div class="card-body bodyAdminCard">
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
