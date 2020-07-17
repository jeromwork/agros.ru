<?php
    /*
     *      Osclass – software for creating and publishing online classified
     *                           advertising platforms
     *
     *                        Copyright (C) 2014 OSCLASS
     *
     *       This program is free software: you can redistribute it and/or
     *     modify it under the terms of the GNU Affero General Public License
     *     as published by the Free Software Foundation, either version 3 of
     *            the License, or (at your option) any later version.
     *
     *     This program is distributed in the hope that it will be useful, but
     *         WITHOUT ANY WARRANTY; without even the implied warranty of
     *        MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
     *             GNU Affero General Public License for more details.
     *
     *      You should have received a copy of the GNU Affero General Public
     * License along with this program.  If not, see <http://www.gnu.org/licenses/>.
     */

    // meta tag robots
    osc_add_hook('header','bender2_nofollow_construct');

    bender2_add_body_class('register');
    osc_enqueue_script('jquery-validate');
    osc_current_web_theme_path('header.php') ;
?>
<div class="form-container form-horizontal form-container-box">
    <div class="header">
        <h1><?php _e('Register an account for free', 'bender2'); ?></h1>
    </div>
    <div class="resp-wrapper">
        <form name="register" action="<?php echo osc_base_url(true); ?>" method="post" >
            <input type="hidden" name="page" value="register" />
            <input type="hidden" name="action" value="register_post" />
            <ul id="error_list"></ul>
            <div class="control-group">
                <label class="control-label" for="name"><?php _e('Name', 'bender2'); ?></label>
                <div class="controls">
                    <?php UserForm::name_text(); ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="email"><?php _e('E-mail', 'bender2'); ?></label>
                <div class="controls">
                    <?php UserForm::email_text(); ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="password"><?php _e('Password', 'bender2'); ?></label>
                <div class="controls">
                    <?php UserForm::password_text(); ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="password-2"><?php _e('Repeat password', 'bender2'); ?></label>
                <div class="controls">
                    <?php UserForm::check_password_text(); ?>
                    <p id="password-error" style="display:none;">
                        <?php _e("Passwords don't match", 'bender2'); ?>
                    </p>
                </div>
            </div>
            <?php osc_run_hook('user_register_form'); ?>
            <div class="control-group">
                <div class="controls">
                    <?php //osc_show_recaptcha('register'); ?>
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <button type="submit" class="ui-button ui-button-middle ui-button-main"><?php _e("Create", 'bender2'); ?></button>
                </div>
            </div>
        </form>


<div id="phoneNC">
  <input type="tel" id="phoneNumber" />
  <button id="sign-in-button" onclick="submitPhoneNumberAuth()">Проверить телефон</button>
  <div id="recaptcha-container"></div>
</div>
<div style="display: none;" id="codeNc">
  <input type="text" id="code" />
  <button id="confirm-code" onclick="submitPhoneNumberAuthCode()">Вход на сайт</button>
</div>

        <script src="https://www.gstatic.com/firebasejs/6.3.3/firebase-app.js"></script>
        <script src="https://www.gstatic.com/firebasejs/6.3.3/firebase-auth.js"></script>


        <form  method="post" >

        <button onclick="checkFire()">          проверить гугл апи
        </button >
        </form>
<script>

  function checkFire(){
    event.preventDefault();
    let formData = new FormData();
firebase.auth().onAuthStateChanged(function(user) {
        if (user) {
          formData.append("idToken", user.ra);
          formData.append("key", user.l);
          formData.append("uid", user.uid);

let xhr = new XMLHttpRequest();
xhr.open('POST', "/")
//xhr.responseType = 'json';
xhr.send(formData);


xhr.onload = () => console.log(xhr.response);
          //console.log(user);
        } else {
          // No user is signed in.
          console.log("USER NOT LOGGED IN");
        }
      });
  }



</script>

        <script>
      // Paste the config your copied earlier
      var firebaseConfig = {
    apiKey: "AIzaSyBwx9ZVAh1zpd9STFa9lcWxGaRxeTmHwpk",
    authDomain: "polnopole.firebaseapp.com",
    databaseURL: "https://polnopole.firebaseio.com",
    projectId: "polnopole",
    storageBucket: "polnopole.appspot.com",
    messagingSenderId: "792696423797",
    appId: "1:792696423797:web:f2830f79a498b0263dbf3c",
    measurementId: "G-5R2Y705ED3"
  };
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);
  //firebase.analytics();
      // Create a Recaptcha verifier instance globally
      // Calls submitPhoneNumberAuth() when the captcha is verified
      window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier(
        "recaptcha-container",
        {
          size: "normal",
          callback: function(response) {
            submitPhoneNumberAuth();
          }
        }
      );

      // This function runs when the 'sign-in-button' is clicked
      // Takes the value from the 'phoneNumber' input and sends SMS to that phone number
      function submitPhoneNumberAuth() {
        var phoneNumber = document.getElementById("phoneNumber").value;
        var appVerifier = window.recaptchaVerifier;
        firebase
          .auth()
          .signInWithPhoneNumber(phoneNumber, appVerifier)
          .then(function(confirmationResult) {
            window.confirmationResult = confirmationResult;
            $('#phoneNC').hide();
            $('#codeNc').show();
            
          })
          .catch(function(error) {
            console.log(error);
            
          });
      }

      // This function runs when the 'confirm-code' button is clicked
      // Takes the value from the 'code' input and submits the code to verify the phone number
      // Return a user object if the authentication was successful, and auth is complete
      function submitPhoneNumberAuthCode() {
        var code = document.getElementById("code").value;
        confirmationResult
          .confirm(code)
          .then(function(result) {
            var user = result.user;
            console.log(user);
            let formData = new FormData();
            formData.append("checkfire", "check");
          formData.append("idToken", user.ra);
          formData.append("key", user.l);
          formData.append("uid", user.uid);

          let xhr = new XMLHttpRequest();
          xhr.open('POST', "?login=Phone")
          //xhr.responseType = 'json';
          xhr.send(formData);


          xhr.onload = () => {
            
            let r = JSON.parse(xhr.response);
            //console.log(r);
            if(r.redirect){
              
              document.location.href=window.location.origin+r.redirect
            }
            else{console.log(r)}
            
          };
          
          console.log('dfswe');
          })
          .catch(function(error) {
            console.log(error);
          });
      }

      //This function runs everytime the auth state changes. Use to verify if the user is logged in
      firebase.auth().onAuthStateChanged(function(user) {
        if (user) {
          console.log(user);

        } else {
          // No user is signed in.
          console.log("USER NOT LOGGED IN");
        }
      });
    </script>






    </div>
</div>
<?php UserForm::js_validation(); ?>
<?php osc_current_web_theme_path('footer.php') ; ?>
