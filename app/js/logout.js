var logout_btn = document.getElementById("logout_btn");

logout_btn.onclick = ()=> {logout()}

function logout() {
    window.location.href="logout.php";
}