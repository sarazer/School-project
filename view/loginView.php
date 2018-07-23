<?php
class LoginView {

    function login(){
        echo '
        <div class="container" style="margin-top:40px">
        <div class="row col-sm-6 col-md-4 col-md-offset-4 panel panel-default ">
            <div class="panel-heading">
                <strong><h4> Sign in to continue</h4></strong>
            </div>
            <div class="panel-body">
                <form role="form" action="" method="post">
                    <fieldset>
                        <div class="row center-block">
                            <img class="profile-img" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120" alt="">
                        </div>
                        <div class="col-sm-12 col-md-10  col-md-offset-1 ">
                            <div class="form-group input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-user"></i>
								</span>
                                <input class="form-control" placeholder="Username" name="email" type="text" autofocus>

                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-unlock-alt"></i>
								</span>
                                <input class="form-control" placeholder="Password" name="password" type="password" value="">
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-lg btn-primary btn-block" name="submit" value="Sign in">
                            </div>
                        </div>

                    </fieldset>
                </form>
            </div>
        </div>';
    }
}