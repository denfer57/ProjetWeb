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
                        <button id="search" name="search" class="btn btn-danger"><span class="glyphicon glyphicon-search"></span> Search</button>
                    </form>
                </div>

                <div class="col-lg-6">
                    <a href="http://localhost/Projetweb/Site/"><h1>Le site de malade</h1></a>
                </div>

                <form action="http://localhost/Projetweb/Site/connexion.php" method="post" class="form-horizontal">

                    <div class="col-lg-2">

                        <!-- Username input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="ndcco">Username</label>  
                            <div class="col-md-7">
                                <input id="ndcco" name="ndcco" placeholder="" class="form-control input-md" required="" type="text">
                            </div>
                        </div>

                        <!-- Password input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="mdpco">Password</label>
                            <div class="col-md-7">
                                <input id="mdpco" name="mdpco" placeholder="" class="form-control input-md" required="" type="password">
                            </div>
                        </div>

                    </div>
                    
                    <div class="col-lg-1">
                        
                        <!-- connection button-->
                        <div class="form-group">
                                <button href="http://localhost/Projetweb/Site/connexion.php" id="connect" name="connect" type="submit" class="btn btn-danger">Connect</button>
                        </div>
                        
                </form>
                    
                        <!-- subscribe button-->
                        <a href="http://localhost/Projetweb/Site/inscription.php" class="btn btn-warning">Subscribe <span class="glyphicon glyphicon-user"></span></a>
                    </div>
                </div>
                
            </section>

</html>