var contacts_div = document.getElementById("contacts_div")


function display_contact(ID, username, email) {
    if (parent_page == "contacts") {
        var btn_onclick = "start_chat"
        var btn_text = "CHAT"
    }
    else if (parent_page == "search") {
        var btn_onclick = "add_contact"
        var btn_text = "ADD"
    }
    else {
        alert("wtf!")
    }
    let contact = `
            <div class="row contact">
                <div class="col col-3">${username}</div>
                <div class="col" style="background-color: #f2f3f7;">${email}</div>
                <div class="col col-auto"><button onclick="${btn_onclick}(${ID})" class="btn btn-sm btn-primary">${btn_text}</button></div>
            </div>
    `;
    contacts_div.innerHTML += contact;
}

function add_contact(ID) {
    window.location.href = "add_contact.php?ID=" + ID;
}

function start_chat(ID) {
    window.location.href = "chat.php?ID=" + ID;
}