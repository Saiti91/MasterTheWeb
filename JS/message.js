let sessionId;
fetch('get_session_data.php')
    .then(function (response) {
        return response.json();
    })
    .then(function (data) {
        sessionId = data;
        return fetch('messagerie_back.php');
    })
    .then(function (response) {
        return response.json();
    })
    .then(function (data) {
        displayConversation(data, sessionId);
    })
    .catch(function (error) {
        console.log('Une erreur s\'est produite :', error);
    });

function displayConversation(users, sessionId) {
    let tableBody = document.querySelector('#searchResultsConversation');
    tableBody.innerHTML = '';

    for (let i = 0; i < users.length; i++) {
        let user = users[i];
        let row = document.createElement('tr');
        let divisions = Object.values(user);
        let cell = document.createElement('td');
        if (divisions[0] === sessionId) {
            cell.textContent = divisions[3];
            row.appendChild(cell);
        }
        if (divisions[2] === sessionId) {
            cell.textContent = divisions[1];
            row.appendChild(cell);
        }

        tableBody.appendChild(row);
    }
}
