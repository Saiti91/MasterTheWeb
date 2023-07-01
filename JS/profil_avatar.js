let draggables = document.querySelectorAll(".draggable");
let avatar = document.querySelector(".avatar");
let draggingElement = null;

draggables.forEach(draggable => {
    draggable.addEventListener('dragstart', () => {
        draggable.classList.add('dragging');
        draggingElement = draggable;
    });
    draggable.addEventListener('dragend', (event) => {
        draggable.classList.remove('dragging')
    });
    draggable.addEventListener('drop', (event) => {
        console.log(event.target);
    });
});

avatar.addEventListener('drop', (event) => {
    event.preventDefault();
    let droppedElementId = event.dataTransfer.getData("text/plain");
    let droppedElement = document.getElementById('avatarImage');
    let classDragging = draggingElement.classList[1];
    if (draggingElement) {
        let delimiter = ".";
        str = draggingElement.src.slice(64);
        let index = str.indexOf(delimiter);
        if (index !== -1) {
            let newStr = str.slice(0, index);
            let item = newStr.slice(0, -1);
            console.log(item);
            getAvatarImage(newStr, item);
        }
    }
});
avatar.addEventListener('dragover', (event) => {
    event.preventDefault();
});

function getAvatarImage(image, classname) {
    let imageV = document.querySelectorAll('.' + classname);
    imageV.forEach((element, index) => {
        element.style.display = 'none';
    });
    let imageRec = document.getElementById(image);
    imageRec.style.display = 'block';
}


// Stocker l'avatar sélectionné
function storeAvatar(avatar) {
    localStorage.setItem('selectedAvatar', avatar);
}

// Récupérer l'avatar stocké
function getStoredAvatar() {
    return localStorage.getItem('selectedAvatar');
}

// Exemple d'utilisation pour stocker l'avatar sélectionné
let avatarId = "avatar123";
storeAvatar(avatarId);

// Exemple d'utilisation pour récupérer l'avatar stocké
let storedAvatar = getStoredAvatar();
console.log(storedAvatar); // Affiche "avatar123"
