let sessionId;
let tableBodyMessage = document.querySelector('#searchResultsMessage');
let tableHead = document.querySelector('#searchResultsConversationHead');

fetch('get_session_data.php').then((response) => {
    return response.json();
}).then((data) => {
    sessionId = data;
    return fetch('messagerie_back.php');
}).then((response) => {
    return response.json();
}).then((data) => {
    displayConversation(data, sessionId);
}).catch((error) => {
    console.log('Une erreur s\'est produite :', error);
});

function displayConversation(users, sessionId) {
    let tableBody = document.querySelector('#searchResultsConversation');
    tableBody.innerHTML = '';
    localStorage.setItem('idConversationActive', '');
    for (let i = 0; i < users.length; i++) {
        let user = users[i];
        let row = document.createElement('tr');
        let divisions = Object.values(user);
        let cell = document.createElement('td');
        let link = document.createElement('input');
        let idConversation = encodeURIComponent(divisions[0]);
        link.type = "button";
        link.id = idConversation;
        link.className = "convButton";
        console.log(link);
        if (divisions[1] === sessionId) {
            link.value = divisions[4];
            cell.appendChild(link);
            row.appendChild(cell);
        }
        if (divisions[3] === sessionId) {
            link.value = divisions[2];
            cell.appendChild(link);
            row.appendChild(cell);
        }
        tableBody.appendChild(row);
    }
    addButtons();
}

function addButtons() {
    let convButtons = document.querySelectorAll('.convButton');

    if (convButtons.length > 0) {
        convButtons.forEach((element) => {
            element.addEventListener('click', (event) => {
                fetch('messagefromconversation_back.php?idConversation=' + element.id)
                    .then((response) => {
                        return response.json();
                    })
                    .then((data) => {
                        displayMessage(data, sessionId, element);
                    })
                    .catch((error) => {
                        console.log('Une erreur s\'est produite :', error);
                    });
                localStorage.setItem('idConversationActive', element.id);
                localStorage.setItem('nameConversationActive', element.value);
            });
        });
    }
}

setInterval(fetchNewMessages, 5000);

function displayMessage(messages, sessionId) {
    let elementValue = localStorage.getItem('nameConversationActive');
    tableHead.innerHTML = elementValue;
    tableBodyMessage.innerHTML = '';
    for (let i = 0; i < messages.length; i++) {
        let message = messages[i];
        let row = document.createElement('tr');
        let divisions = Object.values(message);
        let cell = document.createElement('td');
        if (divisions[2] === sessionId) {
            //envoyé
            cell.innerHTML = divisions[1];
            row.appendChild(cell);
        }
        if (divisions[3] === sessionId) {
            //reçu
            cell.innerHTML = divisions[1];
            row.appendChild(cell);
        }
        tableBodyMessage.appendChild(row);
    }
}

document.getElementById('myForm').addEventListener('submit', function (e) {
    // Prevent the default form submission
    e.preventDefault();

    // Get the message input value
    let message = document.getElementById('messageInput').value;

    // Create a new FormData object
    let formData = new FormData();
    formData.append('text', message);
    formData.append('Sender', sessionId);
    formData.append('Reciever', localStorage.getItem('nameConversationActive'));
    formData.append('Conversation', localStorage.getItem('idConversationActive'));

    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'sendMessage.php', true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            alert('Message envoyé avec succès');
        } else {
            alert('Une erreur est survenue lors de l\'envoi du message');
        }
    };
    xhr.send(formData);
});

function fetchNewMessages() {
    let xhr = new XMLHttpRequest();
    let idConversationActive = localStorage.getItem('idConversationActive');
    xhr.open('POST', 'messageFromConversation_back.php?idConversation=' + idConversationActive, true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            let newMessages = JSON.parse(xhr.responseText);
            displayMessage(newMessages, sessionId);
        } else {
            console.error('Une erreur est survenue lors de la récupération des nouveaux messages.');
        }
    };
    xhr.send();
}
