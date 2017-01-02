
            <div class="row">
                
        <div id="banniere">
                <div class="col-lg-3">
                    <form action="search.php" method="post">
                        <input type="text" name="recherche" id="recherche" placeholder="Search series, actors..." required=""/>
                        <a href="#" class="btn btn-primary btn-danger"><span class="glyphicon glyphicon-search"></span> Search</a>
                    </form>
                    <form action="catalogue.php" method="post">
                        <button id="search" name="search" class="btn btn-warning"><span class="glyphicon glyphicon"></span> See the catalogue</button>
                    </form>
                </div>

                <div class="col-lg-6">
                    <a href="http://localhost/Projetweb/Site/"><img src="http://localhost/Projetweb/Site//images/logo.png" alt="Logo" id="logo"></a>
                </div>
                    <div class="col-lg-1">

                        <div class="form-group">
                                <p> Username : 
                                <?php
                                echo $_SESSION['name'];
                                ?>    
                                </p>
                                <!-- profil button-->
                                <a href="http://localhost/Projetweb/Site/profile.php" class="btn btn-warning">Profil <span class="glyphicon glyphicon-user"></span></a>
                                 <!-- deconnection button-->
                                <a href="http://localhost/Projetweb/Site/deconnexion.php" class="btn btn-danger">Deconnexion</a>
                        </div>
                    
                    </div>
                </div>
                
            </div>
