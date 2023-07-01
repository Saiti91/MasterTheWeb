fetch('user_management_back.php')
    .then(function (response) {
        return response.json();
    })
    .then(function (data) {
        displaySearchResults(data, ""); // Afficher tous les éléments avec une chaîne de recherche vide
    })
    .catch(function (error) {
        console.log('Une erreur s\'est produite:', error);
    });

document.getElementById('suser').addEventListener('input', function () {
    let searchValue = this.value.trim(); // Obtenez la valeur de recherche et supprimez les espaces vides avant et après
    fetch('user_management_back.php')
        .then(function (response) {
            return response.json();
        })
        .then(function (data) {
            displaySearchResults(data, searchValue); // Appel de la fonction displaySearchResults avec la valeur de recherche mise à jour
        })
        .catch(function (error) {
            console.log('Une erreur s\'est produite:', error);
        });
});
let subRuser = document.getElementById('subRUser');
subRuser.preventDefault();

function displaySearchResults(users, searchInputValue) {

    let tableBody = document.querySelector('#searchResults');
    tableBody.innerHTML = '';
    for (let i = 0; i < users.length; i++) {
        let user = users[i];
        let row = document.createElement('tr');

        let divisions = Object.values(user)

        for (let i = 0; i < divisions.length; i++) {
            if (divisions[2].includes(searchInputValue)) {

                let Cell = document.createElement('td');
                Cell.textContent = divisions[i];
                row.appendChild(Cell);
                if (i == divisions.length - 1) {
                    Cell = document.createElement('td')
                    Cell.innerHTML = ' <a class="btn btn-secondary btn-sm" href="user_consulter.php?id=' + divisions[0] + '">Consulter </a> \
                                <a class="btn btn-primary btn-sm" href="user_modifier.php?id=' + divisions[0] + '">Modifier </a> \
                                <a class="btn btn-danger btn-sm" href="user_supprimer.php?id=' + divisions[0] + '">Supprimer </a>'
                    row.appendChild(Cell)
                }
            }
        }
        tableBody.appendChild(row);
    }
}



