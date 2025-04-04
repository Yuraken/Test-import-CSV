Projet codé dans un environement wamp64 en PHP 8.3.14, MySQL 9.1.0 et Apache 2.4.62.1

Une fois le projet dans le dossier du projet placé dans Wamp64/wwww/ et la BDD "Customer.sql" installé :
- Lancez la commande : composer install
- Lancez la commande suivante pour importer le CSV : php bin/console app:import-csv '.\public\customers-100000.csv'(ou autre chemin vers un fichier CSV du même type)
- Vous trouverez ensuite les données affichée depuis la BDD sur la page http://localhost/Test-import-CSV/public/
