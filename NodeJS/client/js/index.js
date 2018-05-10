$('.loginButton').on('click', function(event) {
  let credenciales = {
    username: $('#user').val(),
    password: $('#pass').val()
  };

  var url = 'http://localhost:8082/app/login';
  $.post(url, credenciales, function(response) {
    if (response == "OK") {
          localStorage.setItem("user",credenciales.username);
          window.location.href = 'main.html';
        }else {
          alert(response);
        }
    });
})
