document.addEventListener("DOMContentLoaded", () => {
  const loginBtn = document.getElementById("loginBtn");

  loginBtn.addEventListener("click", function(event) {
    event.preventDefault();  // Prevent form from submitting
    func();  // Call the login validation function
  });
});

function func() {
  const username = document.getElementById("username").value;
  const pass = document.getElementById("password").value;

  if (username === 'admin' && pass === '12345678') {
    alert("sukses");
    window.location.assign("./php/home.php");
  } else {
    alert("input yang dimasukkan salah");
  }
}
