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
    console.log("Élément lâché :", droppedElement);
    if (draggingElement) {
        console.log("Élément lâché :", draggingElement);
        let delimiter = ".";
        str = draggingElement.src.slice(64);
        let index = str.indexOf(delimiter);
        if (index !== -1) {
            let newStr = str.slice(0, index);
            console.log(newStr);
        }
        if (newStr == 'barbes') {
            
        }
    }


});
avatar.addEventListener('dragover', (event) => {
    event.preventDefault();
});
