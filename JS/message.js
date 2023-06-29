document.getElementById('sendButton').addEventListener('click', sendMessage);

function sendMessage() {
    const messageInput = document.getElementById('messageInput');
    const message = messageInput.value;

    fetch('/chat', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({message})
    })
        .then(response => response.json())
        .then(data => {
            console.log('Réponse du serveur :', data);
        })
        .catch(error => {
            console.error('Erreur lors de l\'envoi du message:', error);
        });
    messageInput.value = '';
}

setInterval(getMessages, 1000);

function getMessages() {
    fetch('/chat')
        .then(response => response.json())
        .then(data => {
            const chatbox = document.getElementById('chatbox');
            chatbox.innerHTML = ''; // Effacer les anciens messages

            data.messages.forEach(message => {
                const messageElement = document.createElement('p');
                messageElement.textContent = message;
                chatbox.appendChild(messageElement);
            });
        })
        .catch(error => {
            console.error('Erreur lors de la récupération des messages:', error);
        });
}