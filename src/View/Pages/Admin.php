<?php
    $ideas = $this->data['ideas'];
    $users = $this->data['users'];
?>

<div id="containerAdmin">
    <div class="container-fluid" style="margin-top: 50px;">
        <div class="row">
                <div class="col tableBackground">
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
                                    for($i = 0; $i < count($ideas); $i++){
                                        echo '<tr>
                                        <td>'.$ideas[$i]['firstname'].'</td>
                                        <td>'.$ideas[$i]['message'].'</td>
                                        <td><button class="btn btn-danger">Supprimer</button></td>
                                    </tr>';
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col tableBackground">

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
                                        echo '<tr>
                                        <td>'.$user['firstname'].'</td>
                                        <td>'.$user['email'].'</td>
                                        <td>'.$user['nbreport'].'</td>
                                        <td><button class="btn btn-primary">
                                        ';
                                        if($user['isadmin']){
                                            echo 'Destituer';
                                        }else{
                                            echo 'Promouvoir';
                                        }
                                        echo'</button>
                                        <button class="btn btn-danger">Bannir</button></td>
                                    </tr>';
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
</div>
