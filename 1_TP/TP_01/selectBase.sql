#Classe Matricule Nom Prenom
# Combien d'étudiants ?
SELECT 
    COUNT(*) AS nbEtudiants
FROM
    etudiants;

#Combien d'étudiants en 1TL1 ?
SELECT 
    COUNT(*) AS '1TL1'
FROM
    etudiants
WHERE
    Classe = '1TL1';

#Combien d'étudiants dans tous les groupes ?
SELECT 
    Classe, COUNT(*) AS nbr
FROM
    etudiants
GROUP BY classe;

#Combien d'étudiants par année-section ?
SELECT 
    LEFT(Classe, 2) AS anSec, COUNT(*) AS nbr
FROM
    etudiants
GROUP BY anSec;

#Combien d'étudiants par section ?
SELECT 
    RIGHT(LEFT(Classe, 2), 1) AS anSec, COUNT(*) AS nbr
FROM
    etudiants
GROUP BY anSec;

# combien de fois reviennent chaque prénoms ? 
SELECT 
    prenom, COUNT(*) AS nbr
FROM
    etudiants
GROUP BY prenom;

# quel est le plus grand nombre de fois que revient un prénom ?  
SELECT 
    MAX(nbr) AS num
FROM
    (SELECT 
        COUNT(*) AS nbr
    FROM
        etudiants
    GROUP BY prenom) AS nbr;

# quel est(sont) le(s) prénom(s) qui revien(nen)t le plus souvent ?
SELECT 
    prenom
FROM
    etudiants
GROUP BY prenom
HAVING COUNT(*) = (SELECT 
        MAX(nbr) AS num
    FROM
        (SELECT 
            COUNT(*) AS nbr
        FROM
            etudiants
        GROUP BY prenom) AS nbr);
	# avec limit
SELECT 
    prenom
FROM
    etudiants
GROUP BY prenom
ORDER BY COUNT(prenom) DESC
LIMIT 0 , 2;

# Y-a-t-il un(des) cas d'homonymie ? 
# dans etudians : 
SELECT 
    nom, prenom, COUNT(*) AS nbr
FROM
    etudiants
WHERE
    nom = nom AND prenom = prenom
GROUP BY nom , prenom
HAVING COUNT(*) > 1;

# dans etudians_2 : 
SELECT 
    nom, prenom, COUNT(*) AS nbr
FROM
    etudiants_2
WHERE
    nom = nom AND prenom = prenom
GROUP BY nom , prenom
HAVING COUNT(*) > 1;

#Quels sont les étudiants concernés par une homonymie ? 
# dans étudiants 
SELECT 
    *
FROM
    etudiants
WHERE
    COALESCE(classe, matricule, nom, prenom) IS NOT NULL
        AND nom = (SELECT 
            nom
        FROM
            etudiants
        WHERE
            nom = nom AND prenom = prenom
        GROUP BY nom , prenom
        HAVING COUNT(*) > 1);
#dans étudiants_2
SELECT 
    *
FROM
    etudiants_2
WHERE
    COALESCE(classe, matricule, nom, prenom) IS NOT NULL
        AND nom IN (SELECT 
            nom
        FROM
            etudiants_2
        WHERE
            nom = nom AND prenom = prenom
        GROUP BY nom , prenom
        HAVING COUNT(*) > 1);







