document.getElementById('retype_password').addEventListener('input', function() {
    var password = document.getElementById('password').value;
    var retypePassword = document.getElementById('retype_password').value;
    var errorMessage = document.getElementById('password-error');
    
    if (password !== retypePassword) {
        errorMessage.textContent = 'Passwords do not match!';
    } else {
        errorMessage.textContent = '';
    }
});
