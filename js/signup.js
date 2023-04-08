(function() {
    'use strict';
    window.addEventListener('load', function() {
      var password = document.getElementById('password');
      var con_password = document.getElementById('con_password');
      var pw_invalid = document.getElementById('pw_invalid');
      var con_invalid = document.getElementById('con_invalid');
      var forms = document.getElementsByClassName('needs-validation');
      var validation = Array.prototype.filter.call(forms, function(form) {
        form.addEventListener('submit', function(event) {
          if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
            form.classList.add('was-validated');
          }
          validatePassword();
          function validatePassword(){
            if (password.value != con_password.value) {
            event.preventDefault();
            event.stopPropagation();
              password.setCustomValidity("Passwords Don't Match");
              pw_invalid.innerHTML = "";
              con_password.setCustomValidity("Passwords Don't Match");
              con_invalid.innerHTML = "Password tidak sesuai!"
            } else {
              password.setCustomValidity("");
              con_password.setCustomValidity("");
            }
          if (password.value == "") {
            pw_invalid.innerHTML = "";
          }
          if (con_password.value == "") {
            con_invalid.innerHTML = "";
          }
          password.onkeyup = validatePassword;
        con_password.onkeyup = validatePassword;
          }
        }, false);
      });
    }, false);
  })();