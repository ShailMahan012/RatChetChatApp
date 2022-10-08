var chats = document.getElementById("chats")
var msg_input = document.getElementById("msg_input")
var name_input = document.getElementById("name")
var send_btn = document.getElementById("send_btn")

var conn = new WebSocket('ws://localhost:8080');
conn.onopen = function (e) {
    console.log("Connection established!");
    send_btn.disabled = false; 
};

conn.onmessage = function (e) {
    var data = JSON.parse(e.data)
    
    append_msg(data.msg, data.name)
};
conn.onerror = function (e) {
    alert("Unable to connect to server. Please refresh page");
}

function send_msg() {
    var msg = msg_input.value
    if (!msg) return;
    var name = getUserData().user;
    if (!name) name = "Anonymous"


    append_msg(msg, true)

    msg = {name:name, msg:msg}
    msg = JSON.stringify(msg)

    conn.send(msg)
}

function append_msg(msg, user) {
    if (user == true)
        msg = `<div class="msg msg_your">::<span>${msg}</span></div>`
    else
        msg = `<div class="msg msg_other">${user}: ${msg}</div>`
    chats.innerHTML += msg 
}