document.addEventListener("DOMContentLoaded", function() {
    // Récupération des données depuis le script PHP
    fetch('get_photos.php')
        .then(response => response.json())
        .then(data => {
            // Création des éléments de la galerie
            const galleryContainer = document.querySelector('.gallery-container');

            data.forEach(photo => {
                const imgElement = document.createElement('img');
                imgElement.src = photo['url']; // Assurez-vous d'avoir une colonne 'url' dans votre base de données
                imgElement.alt = photo['description']; // Assurez-vous d'avoir une colonne 'description' dans votre base de données
                galleryContainer.appendChild(imgElement);
            });
        })
        .catch(error => console.error('Erreur lors de la récupération des photos :', error));
});
