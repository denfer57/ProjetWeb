
<!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8" />
    </head>

            <section class="row">
                
        <div id="banniere">
                <div class="col-lg-3">
                    <form action="recherche.php" method="post">
                        <input type="text" name="recherche" id="recherche" placeholder="Rechercher série, acteur..." required="true"/>
                        <a href="#" class="btn btn-primary btn-danger"><span class="glyphicon glyphicon-search"></span> Search</a>
                    </form>
                </div>

                <div class="col-lg-6">
                    <a href="http://localhost/Projetweb/Site/"><img src="http://localhost/Projetweb/Site//images/logo.png" alt="Logo" id="logo"></a>
                </div>

                <form action="http://localhost/Projetweb/Site/deconnexion.php" method="post" class="form-horizontal">
                    
                    <div class="col-lg-1">
                        
                        <!-- deconnection button-->
                        <div class="form-group">
                                <p> Username : 
                                <?php
                                echo $_SESSION['name'];
                                ?>    
                                </p>
                                <button href="http://localhost/Projetweb/Site/deconnexion.php" id="connect" name="connect" type="submit" class="btn btn-danger">Deconnexion</button>
                        </div>
                        
                </form>
                    
                    </div>
                </div>
                
            </section>

</html>