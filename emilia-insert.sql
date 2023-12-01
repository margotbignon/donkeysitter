INSERT INTO petSitters (lastName, firstName, phoneNb, email, password, birthDate, image, description, petSitterSince, residenceType_id, sitterStreet, sitterPostalCode, sitterCity, animalType_id) VALUES ('Lefèvre', 'Darius', '0789678955', 'd.lefevre@gmail.com', 'azerty123', '1989-12-01', 'img/profils/profil-darius.jpg', "J'ai grandi entouré d'animaux, et mes amis m'ont toujours choisi pour prendre soin de leurs compagnons en leur absence. Pour moi, chaque animal a sa propre personnalité unique, et je m'engage à leur offrir l'amour et les soins qu'ils méritent, tout comme je le fais pour Rajah (mon chat). Avec moi, vos amis à quatre pattes seront entre de bonnes mains", ''2015-01-01'', '1', '13 rue de la Réunion', '93300', 'Montreuil', '3');




SELECT petSitters.*, services.*, residenceTypes.*
FROM p AS petSitters 
LEFT JOIN s AS services ON p.service_id = s.idservice
LEFT JOIN residenceTypes AS r ON p.residenceType_id = r.idresidenceTypes
WHERE idpetSitter = :id;