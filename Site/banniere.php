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

                <form action="http://localhost/Projetweb/Site/connexion.php" method="post" class="form-horizontal">

                        <div class="padd20">
                    <div class="col-xs-offset-2 col-xs-2">

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
                    
                    <div class="col-xs-1">
                        
                        <!-- connection button-->
                                <input id="connect" type="submit" class="btn btn-danger" value="Connect"/>
                </form>
                    
                        <!-- subscribe button-->
                        <a href="http://localhost/Projetweb/Site/subscribe.php" class="btn btn-warning">Subscribe</a>
                    </div>
                </div>   

            </div>