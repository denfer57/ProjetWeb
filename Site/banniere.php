<!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8" />
    </head>

            <section class="row">
                
        <div id="banniere">
                <div class="col-lg-3">
                    <form action="search.php" method="post">
                        <input type="text" name="recherche" id="recherche" placeholder="Search series, actors..." required=""/>
                        <a id="search" class="btn btn-danger"><span class="glyphicon glyphicon-search"></span> Search</a>
                    </form>
                    <form action="catalogue.php" method="post">
                        <a class="btn btn-warning"><span class="glyphicon glyphicon"></span> See the catalogue</a>
                    </form>
                </div>

                <div class="col-lg-6">
                    <a href="http://localhost/Projetweb/Site/"><img src="http://localhost/Projetweb/Site//images/logo.png" alt="Logo" id="logo"></a>
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
                                <input id="mdpco" name="mdpco" placeholder="" class="form-control input-md" required="" type="password"/>
                            </div>
                        </div>

                    </div>
                    
                    <div class="col-lg-1">
                        
                        <!-- connection button-->
                        <div class="form-group">
                                <input id="connect" type="submit" class="btn btn-danger" value="Connect"/>
                        </div>
                    </div>   
                </form>
                    
                        <!-- subscribe button-->
                        <a href="http://localhost/Projetweb/Site/subscribe.php" class="btn btn-warning">Subscribe</a>
                    </div>
            </section>

</html>