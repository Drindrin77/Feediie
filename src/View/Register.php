<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <title>Feediie</title>
    </head>
    <body>
        <script type="text/javascript">
        function Validate() {
            var password = document.getElementById("password");
            var confirmPassword = document.getElementById("confirmPassword");
            if (password.value != confirmPassword.value) {
                alert("Passwords do not match.");
                password.style.border = 2px solid red;
                confirmPassword.style.border =2px solid red;
                return false;
            }
            return true;
        }
        </script>
        <?php
        include 'header';
        ?>
        <div class="container">
            <div>
                <!-- Insertion de la photo -->
                <img src="https://cdn.pratico-pratiques.com/app/uploads/sites/3/2018/08/20193108/gateau-mousse-aux-trois-chocolat.jpeg" alt="Gateau au chocolat">
            </div>
            <div>
                <form>
                    <div class="form-group">
                        <!-- Connection-->
                        <label for="emailInput">Email:</label>
                        <input type="email" id="email" required size="50" class="form-control" placeholder="email@mail.com">
                    </div>
                    <div class="form-group">
                        <input type="password" id="password">
                    </div>
                    <input type="button" id="btnSubmit" value="Connexion" class="btn btn-primary" onclick="return Validate()" />
                </form>
                <div class="row-md-2">
                    <!-- Inscrivez-vous -->
                    <p> 
                        Pas encore de compte ? <a href="/register">Inscrivez-vous</a> 
                    </p>
                </div>
            </div>           
        </div>
        <?php
        include 'footer';
        ?>
       <!--
        <div class="pt-5 mt-2">
            {{--
            <div class="nav-scroller bg-danger shadow-sm">
                <nav class="nav nav-underline">
                    <a class="nav-link active" href="#">Dashboard</a>
                    <a class="nav-link" href="#">Friends
                        <span class="badge badge-pill bg-light align-text-bottom">27</span>
                    </a>
                    <a class="nav-link" href="#">Explore</a>
                    <a class="nav-link" href="#">Suggestions</a>
                </nav>
            </div>
            --}}
            @if(Auth::check())
                <div class="scrollmenu bg-danger" style="overflow: auto;white-space: nowrap;">
                    <button class="btn" data-toggle="modal" data-target="#addFichier">Créer un fichier</button>
                    <button class="btn" data-toggle="modal" data-target="#addDossier">Créer un répertoire</button>
                    <button class="btn" data-toggle="modal" data-target="#importDossier">Importer un répertoire</button>
                </div>
                <div id="modals">
                    @include('modals/ajoutFichier')
                    @include('modals/ajoutDossier')
                    @include('modals/importDossier')
                </div>
            @endif
            <div class="p-3">
                {{--
                <div class="col-md-2 d-none d-md-block bg-light sidebar">
                    @include('accueil/explorateur')
                </div>
                --}}
                <div class="w-100">
                    @include('base/message')
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            Répertoire :&nbsp;
                            @php
                                $array_path = explode("/", str_replace(storage_path('app/public'), "Accueil", rtrim($path,"/")));
                                $cpt=1;
                            @endphp
                            @foreach($array_path as $path_part)
                                @if($cpt == count($array_path))
                                    <li class="breadcrumb-item active" aria-current="page">
                                        {{$path_part}}
                                    </li>
                                @else
                                    <li class="breadcrumb-item d-flex">
                                        <form action="breadcrumbTraveller" method="POST">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="folder_id" value="{{DB::table('register')->select('id')->where('path',$path)->get()[0]->id}}">
                                            <input type="hidden" name="breadcrumb_index" value="{{count($array_path)-$cpt}}">
                                            <button class="btn text-info p-0 mt-0">{{$path_part}}</button>
                                        </form>
                                    </li>
                                @endif
                                @php $cpt++; @endphp
                            @endforeach
                        </ol>
                    </nav>
                    @if(Auth::check() && (App\Models\Rights::hasRightUser(Auth::user()->id,$path) == 2))
                        <div>
                            <p>Bonjour <a href="/user/profile"><strong><u>{{ Auth::user()->name }}</u></strong></a></p>
                        </div>
                    @endif
                    @if(Auth::check())
                        <div class="row">
                            @include('accueil/server_files')
                        </div>
                    @else
                        Veuillez vous connecter pour accéder aux fichiers 
                    @endif

                </div>
            </div>
        </div>
        --> 
        
        
    </body>
</html>