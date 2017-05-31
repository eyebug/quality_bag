<?php
require_once('../util/autoloader.php');
require_once('../layout/header.php');
if($_SERVER['REQUEST_METHOD'] == 'GET'){

?>
<div class="container body-content">

    <h2>Log in.</h2>
    <div class="row">
        <div class="col-md-8">
            <section>
                <form method="post" class="form-horizontal" action="/Account/Login.php" novalidate="novalidate">
                    <h4>Use a local account to log in.</h4>
                    <hr>
                    <div class="text-danger validation-summary-valid" data-valmsg-summary="true"><ul><li style="display:none"></li>
                        </ul></div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="Email">Email</label>
                        <div class="col-md-10">
                            <input class="form-control" type="email" data-val="true" data-val-email="The Email field is not a valid e-mail address." data-val-required="The Email field is required." id="Email" name="Email" value="" autocomplete="off" style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR4nGP6zwAAAgcBApocMXEAAAAASUVORK5CYII=&quot;); cursor: auto;">
                            <span class="text-danger field-validation-valid" data-valmsg-for="Email" data-valmsg-replace="true"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="Password">Password</label>
                        <div class="col-md-10">
                            <input class="form-control" type="password" data-val="true" data-val-required="The Password field is required." id="Password" name="Password" autocomplete="off" style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR4nGP6zwAAAgcBApocMXEAAAAASUVORK5CYII=&quot;);">
                            <span class="text-danger field-validation-valid" data-valmsg-for="Password" data-valmsg-replace="true"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-10">
                            <div class="checkbox">
                                <label for="RememberMe">
                                    <input data-val="true" data-val-required="The Remember me? field is required." id="RememberMe" name="RememberMe" type="checkbox" value="true">
                                    Remember me?
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-10">
                            <button type="submit" class="btn btn-default">Log in</button>
                        </div>
                    </div>
                    <p>
                        <a href="/Account/Register.php">Register as a new user?</a>
                    </p>
                    <input name="__RequestVerificationToken" type="hidden" value="CfDJ8GG2SVg-i2pBux38Xw0ISL8ukw0PnQlx0IQGgAVdfEspjYmFV2BJx0RW3rW9mDVQiNSarzq29gfIfeMkabk5miLyUC8RDkHEH5IbBOhDDbUQbnm8epdVZc9fNcd2LeF8X1yyLt1U7ms6fW8mwOz6yMI"><input name="RememberMe" type="hidden" value="false"></form>
            </section>
        </div>
        <div class="col-md-4">
            <section>
                <h4>Use another service to log in.</h4>
                <hr>
                <div>
                    <p>
                        There are no external authentication services configured. See <a href="http://go.microsoft.com/fwlink/?LinkID=532715">this article</a>
                        for details on setting up this ASP.NET application to support logging in via external services.
                    </p>
                </div>
            </section>
        </div>
    </div>



</div>
<?php } elseif($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['Email'];
    $password = $_POST['Password'];
    try{
        Session::getSession()->login($email, $password);
        $output = "<div class=\"container body-content\"><h3>Login successfully!</h3></div>
<script>
setTimeout(
function() {
  window.location.href = \"/index.php\";
}
, 1000);
</script>";
        echo $output;

    }catch(Exception $e){
        $errorMsg = $e->getMessage();
        $output = "
<script>
alert(\"$errorMsg\");
setTimeout(
function() {
  window.location.href = \"/Account/Login.php\";
}
, 1000);
</script>";
        echo $output;
    }

    ?>

    <?php } else {?>

    <?php }?>
<?php
require_once('../layout/footer.php');
require_once('../layout/validate.php');