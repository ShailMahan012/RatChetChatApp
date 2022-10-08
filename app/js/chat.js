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
    var ID = getUserData().ID
    if (ID == data.contact_id && getUserData().contact_id == data.ID)
        append_msg(data.msg, data.name)
};
conn.onerror = function (e) {
    alert("Unable to connect to server. Please refresh page");
}

function send_msg() {
    var msg = msg_input.value
    if (!msg) return;
    var name = getUserData().username
    var ID = getUserData().ID
    var contact_id = getUserData().contact_id
    if (!name) name = "Anonymous"


    append_msg(msg, true)

    msg = {ID:ID,  name:name, msg:msg, contact_id: contact_id}
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