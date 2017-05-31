<?php
require_once('../util/autoloader.php');
require_once('../layout/header.php');
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    ?>
<div class="container body-content">

    <h2>Register.</h2>

    <form method="post" class="form-horizontal" action="/Account/Register.php" novalidate="novalidate">
        <h4>Create a new account.</h4>
        <hr>
        <div class="text-danger validation-summary-valid" data-valmsg-summary="true"><ul><li style="display:none"></li>
            </ul></div>
        <div class="form-group">
            <label class="col-md-2 control-label" for="Email">Email</label>
            <div class="col-md-10">
                <input class="form-control" type="email" data-val="true" data-val-email="The Email field is not a valid e-mail address." data-val-required="The Email field is required." id="Email" name="Email" value="" style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAAAXNSR0IArs4c6QAAAfBJREFUWAntVk1OwkAUZkoDKza4Utm61iP0AqyIDXahN2BjwiHYGU+gizap4QDuegWN7lyCbMSlCQjU7yO0TOlAi6GwgJc0fT/fzPfmzet0crmD7HsFBAvQbrcrw+Gw5fu+AfOYvgylJ4TwCoVCs1ardYTruqfj8fgV5OUMSVVT93VdP9dAzpVvm5wJHZFbg2LQ2pEYOlZ/oiDvwNcsFoseY4PBwMCrhaeCJyKWZU37KOJcYdi27QdhcuuBIb073BvTNL8ln4NeeR6NRi/wxZKQcGurQs5oNhqLshzVTMBewW/LMU3TTNlO0ieTiStjYhUIyi6DAp0xbEdgTt+LE0aCKQw24U4llsCs4ZRJrYopB6RwqnpA1YQ5NGFZ1YQ41Z5S8IQQdP5laEBRJcD4Vj5DEsW2gE6s6g3d/YP/g+BDnT7GNi2qCjTwGd6riBzHaaCEd3Js01vwCPIbmWBRx1nwAN/1ov+/drgFWIlfKpVukyYihtgkXNp4mABK+1GtVr+SBhJDbBIubVw+Cd/TDgKO2DPiN3YUo6y/nDCNEIsqTKH1en2tcwA9FKEItyDi3aIh8Gl1sRrVnSDzNFDJT1bAy5xpOYGn5fP5JuL95ZjMIn1ya7j5dPGfv0A5eAnpZUY3n5jXcoec5J67D9q+VuAPM47D3XaSeL4AAAAASUVORK5CYII=&quot;); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%;">
                <span class="text-danger field-validation-valid" data-valmsg-for="Email" data-valmsg-replace="true"></span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label" for="FullName">Full Name</label>
            <div class="col-md-10">
                <input class="form-control" type="text" data-val="true" data-val-length="The Full Name must be at least 1 and at max 60 characters long." data-val-length-max="60" data-val-length-min="1" data-val-required="The Full Name field is required." id="FullName" name="FullName" value="">
                <span class="text-danger field-validation-valid" data-valmsg-for="FullName" data-valmsg-replace="true"></span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label" for="Password">Password</label>
            <div class="col-md-10">
                <input class="form-control" type="password" data-val="true" data-val-length="The Password must be at least 6 and at max 100 characters long." data-val-length-max="100" data-val-length-min="6" data-val-required="The Password field is required." id="Password" name="Password" style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAAAXNSR0IArs4c6QAABKRJREFUWAnNl0tsVGUUxzvTTlslZUaCloZHY6BRFkp9sDBuqgINpaBp02dIDImwKDG6ICQ8jBYlhg0rxUBYEALTpulMgBlqOqHRDSikJkZdGG0CRqAGUuwDovQ1/s7NPTffnTu3zMxGvuT2vP7n8Z3vu+dOi4r+5xUoJH8sFquamZmpTqfTVeIfCARGQ6HQH83NzaP5xsu5gL6+vuVzc3NdJN1Kkhd8Ev1MMYni4uJjra2tt3wwLvUjCxgYGFg8Pj7+MV5dPOUub3/hX0zHIpFId0NDw6Q/jO4tZOzv76+Znp6+AOb5TBw7/YduWC2Hr4J/IhOD/GswGHy7vb39tyw2S+VbAC1/ZXZ29hKoiOE8RrIvaPE5WvyjoS8CX8sRvYPufYpZYtjGS0pKNoD/wdA5bNYCCLaMYMMEWq5IEn8ZDof3P6ql9pF9jp8cma6bFLGeIv5ShdISZUzKzqPIVnISp3l20caTJsaPtwvc3dPTIx06ziZkkyvY0FnoW5l+ng7guAWnpAI5w4MkP6yy0GQy+dTU1JToGm19sqKi4kBjY+PftmwRYn1ErEOq4+i2tLW1DagsNGgKNv+p6tj595nJxUbyOIF38AwipoSfnJyMqZ9SfD8jxlWV5+fnu5VX6iqgt7d3NcFeUiN0n8FbLEOoGkwdgY90dnbu7OjoeE94jG9wd1aZePRp5AOqw+9VMM+qLNRVABXKkLEWzn8S/FtbdAhnuVQE7LdVafBPq04pMYawO0OJ+6XHZkFcBQA0J1xKgyhlB0EChEWGX8RulsgjvOjEBu+5V+icWOSoFawuVwEordluG28oSCmXSs55SGSCHiXhmDzC25ghMHGbdwhJr6sAdpnyQl0FYIyoEX5CeYOuNHg/NhvGiUUxVgfV2VUAxjtqgPecp9oKoE4sNnbX9HcVgMH8nD5nAoWnKM/5ZmKyySRdq3pCmDncR4DxOwVC64eHh0OGLOcur1Vey46xUZ3IcVl5oa4OlJaWXgQwJwZyhUdGRjqE14VtSnk/mokhxnawiwUvsZmsX5u+rgKamprGMDoA5sKhRCLxpDowSpsJ8vpCj2AUPzg4uIiNfKIyNMkH6Z4hF3k+RgTYz6vVAEiKq2bsniZIC0nTtvMVMwBzoBT9tKkTHp8Ak1V8dTrOE+NgJs7VATESTH5WnVAgfHUqlXK6oHpJEI1G9zEZH/Du16leqHyS0UXBNKmeOMf5NvyislJPB8RAFz4g8IuwofLy8k319fUP1EEouw7L7mC3kUTO1nn3sb02MTFxFpsz87FfJuaH4pu5fF+reDz+DEfxkI44Q0ScSbyOpDGe1RqMBN08o+ha0L0JdeKi/6msrGwj98uZMeon1AGaSj+elr9LwK9IkO33n8cN7Hl2vp1N3PcYbUXOBbDz9bwV1/wCmXoS3+B128OPD/l2LLg8l9APXVlZKZfzfDY7ehlQv0PPQDez6zW5JJdYOXdAwHK2dGIv7GH4YtHJIvEOvvunLCHPPzl3QOLKTkl0hPbKaDUvlTU988xtwfMqQBPQ3m/4mf0yBVlDCSr/CRW0CipAMnGzb9XU1NSRvIX7kSgo++Pg9B8wltxxbHKPZgAAAABJRU5ErkJggg==&quot;); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%;">
                <span class="text-danger field-validation-valid" data-valmsg-for="Password" data-valmsg-replace="true"></span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label" for="ConfirmPassword">Confirm password</label>
            <div class="col-md-10">
                <input class="form-control" type="password" data-val="true" data-val-equalto="The password and confirmation password do not match." data-val-equalto-other="*.Password" id="ConfirmPassword" name="ConfirmPassword" style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAAAXNSR0IArs4c6QAABKRJREFUWAnNl0tsVGUUxzvTTlslZUaCloZHY6BRFkp9sDBuqgINpaBp02dIDImwKDG6ICQ8jBYlhg0rxUBYEALTpulMgBlqOqHRDSikJkZdGG0CRqAGUuwDovQ1/s7NPTffnTu3zMxGvuT2vP7n8Z3vu+dOi4r+5xUoJH8sFquamZmpTqfTVeIfCARGQ6HQH83NzaP5xsu5gL6+vuVzc3NdJN1Kkhd8Ev1MMYni4uJjra2tt3wwLvUjCxgYGFg8Pj7+MV5dPOUub3/hX0zHIpFId0NDw6Q/jO4tZOzv76+Znp6+AOb5TBw7/YduWC2Hr4J/IhOD/GswGHy7vb39tyw2S+VbAC1/ZXZ29hKoiOE8RrIvaPE5WvyjoS8CX8sRvYPufYpZYtjGS0pKNoD/wdA5bNYCCLaMYMMEWq5IEn8ZDof3P6ql9pF9jp8cma6bFLGeIv5ShdISZUzKzqPIVnISp3l20caTJsaPtwvc3dPTIx06ziZkkyvY0FnoW5l+ng7guAWnpAI5w4MkP6yy0GQy+dTU1JToGm19sqKi4kBjY+PftmwRYn1ErEOq4+i2tLW1DagsNGgKNv+p6tj595nJxUbyOIF38AwipoSfnJyMqZ9SfD8jxlWV5+fnu5VX6iqgt7d3NcFeUiN0n8FbLEOoGkwdgY90dnbu7OjoeE94jG9wd1aZePRp5AOqw+9VMM+qLNRVABXKkLEWzn8S/FtbdAhnuVQE7LdVafBPq04pMYawO0OJ+6XHZkFcBQA0J1xKgyhlB0EChEWGX8RulsgjvOjEBu+5V+icWOSoFawuVwEordluG28oSCmXSs55SGSCHiXhmDzC25ghMHGbdwhJr6sAdpnyQl0FYIyoEX5CeYOuNHg/NhvGiUUxVgfV2VUAxjtqgPecp9oKoE4sNnbX9HcVgMH8nD5nAoWnKM/5ZmKyySRdq3pCmDncR4DxOwVC64eHh0OGLOcur1Vey46xUZ3IcVl5oa4OlJaWXgQwJwZyhUdGRjqE14VtSnk/mokhxnawiwUvsZmsX5u+rgKamprGMDoA5sKhRCLxpDowSpsJ8vpCj2AUPzg4uIiNfKIyNMkH6Z4hF3k+RgTYz6vVAEiKq2bsniZIC0nTtvMVMwBzoBT9tKkTHp8Ak1V8dTrOE+NgJs7VATESTH5WnVAgfHUqlXK6oHpJEI1G9zEZH/Du16leqHyS0UXBNKmeOMf5NvyislJPB8RAFz4g8IuwofLy8k319fUP1EEouw7L7mC3kUTO1nn3sb02MTFxFpsz87FfJuaH4pu5fF+reDz+DEfxkI44Q0ScSbyOpDGe1RqMBN08o+ha0L0JdeKi/6msrGwj98uZMeon1AGaSj+elr9LwK9IkO33n8cN7Hl2vp1N3PcYbUXOBbDz9bwV1/wCmXoS3+B128OPD/l2LLg8l9APXVlZKZfzfDY7ehlQv0PPQDez6zW5JJdYOXdAwHK2dGIv7GH4YtHJIvEOvvunLCHPPzl3QOLKTkl0hPbKaDUvlTU988xtwfMqQBPQ3m/4mf0yBVlDCSr/CRW0CipAMnGzb9XU1NSRvIX7kSgo++Pg9B8wltxxbHKPZgAAAABJRU5ErkJggg==&quot;); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%;">
                <span class="text-danger field-validation-valid" data-valmsg-for="ConfirmPassword" data-valmsg-replace="true"></span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label" for="MobileNo">MobileNo</label>
            <div class="col-md-10">
                <input class="form-control" type="tel" data-val="true" data-val-length="The MobileNo must be at least 7 and at max 20 characters long." data-val-length-max="20" data-val-length-min="7" data-val-phone="The MobileNo field is not a valid phone number." id="MobileNo" name="MobileNo" value="">
                <span class="text-danger field-validation-valid" data-valmsg-for="MobileNo" data-valmsg-replace="true"></span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label" for="PhoneNumber">Home PhoneNo</label>
            <div class="col-md-10">
                <input class="form-control" type="tel" data-val="true" data-val-length="The Home PhoneNo must be at least 7 and at max 20 characters long." data-val-length-max="20" data-val-length-min="7" data-val-phone="The Home PhoneNo field is not a valid phone number." id="PhoneNumber" name="PhoneNumber" value="">
                <span class="text-danger field-validation-valid" data-valmsg-for="PhoneNumber" data-valmsg-replace="true"></span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label" for="WorkPhoneNo">Work PhoneNo</label>
            <div class="col-md-10">
                <input class="form-control" type="tel" data-val="true" data-val-length="The Work PhoneNo must be at least 7 and at max 20 characters long." data-val-length-max="20" data-val-length-min="7" data-val-phone="The Work PhoneNo field is not a valid phone number." id="WorkPhoneNo" name="WorkPhoneNo" value="">
                <span class="text-danger field-validation-valid" data-valmsg-for="WorkPhoneNo" data-valmsg-replace="true"></span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label" for="Address">Address</label>
            <div class="col-md-10">
                <input class="form-control" type="text" data-val="true" data-val-length="The Address must be at least 6 and at max 100 characters long." data-val-length-max="100" data-val-length-min="6" data-val-required="The Address field is required." id="Address" name="Address" value="">
                <span class="text-danger field-validation-valid" data-valmsg-for="Address" data-valmsg-replace="true"></span>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-offset-2 col-md-10">
                <button type="submit" class="btn btn-default">Register</button>
            </div>
        </div>

</div>
    <?php } else {
    $email = $_POST['Email'];
    $name = $_POST['FullName'];
    $password = $_POST['Password'];
    $mobileNo = $_POST['MobileNo'];
    $homephoneNo = $_POST['PhoneNumber'];
    $workphoneNo = $_POST['WorkPhoneNo'];
    $address = $_POST['Address'];
    try {
        Session::getSession()->register($email, $name, $password, $mobileNo, $homephoneNo, $workphoneNo, $address);
        $output = "<h3>Register successfully!</h3>";

    } catch (Exception $e) {
        $errorMsg = $e->getMessage();
        $output = "<script>
alert(\"$errorMsg\");
setTimeout(
function() {
  window.location.href = \"/Account/Register.php\";
}
, 3000);</script>";
        echo $output;
    }
}?>
<?php
require_once('../layout/footer.php');
require_once('../layout/validate.php');