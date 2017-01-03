
    <div class="row">
                
        <div id="banniere">
                <div class="col-xs-3">
                    <div class="padd40">
                    <form action="http://localhost/Projetweb/Site/search.php" method="post">
                        <input type="text" name="recherche" id="recherche" placeholder="Search series, actors..." required=""/>
                        <input id="search" class="btn btn-danger" type="submit" value="Search"/>
                    </form>
                    <a href = "http://localhost/Projetweb/Site/catalogue.php" class="btn btn-warning"><span class="glyphicon glyphicon"></span> See the catalogue</a>
                    </div>
                </div>

                <div class="col-xs-offset-2 col-xs-2">
                    <a href="http://localhost/Projetweb/Site/"><img src="http://localhost/Projetweb/Site//images/logo.png" alt="Logo" id="logo"></a>
                </div>
                <div class="padd40">
                    <div class="col-xs-offset-3 col-xs-2">

                        <div class="form-group">
                                <p> Username : 
                                <?php
                                echo $_SESSION['name'];
                                ?>    
                                </p>
                                <!-- profil button-->
                                <a href="http://localhost/Projetweb/Site/profile.php" class="btn btn-warning">Profile <span class="glyphicon glyphicon-user"></span></a>
                                 <!-- deconnection button-->
                                <a href="http://localhost/Projetweb/Site/deconnexion.php" class="btn btn-danger">Deconnexion</a>
                        </div>
                    
                    </div>
                </div>
            </div>
                
    </div>
