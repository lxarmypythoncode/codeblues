document.getElementById('password').onchange = validatePassword;
document.getElementById('confirm_password').onchange = validatePassword;

function validatePassword(){
  var pass2=document.getElementById('confirm_password').value;
  var pass1=document.getElementById('password').value;
  if(pass1!=pass2)
    document.getElementById('confirm_password').setCustomValidity('Passwords do not match.');
  else
    document.getElementById('confirm_password').setCustomValidity('');
}

