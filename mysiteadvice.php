<?php

class MySiteAdvice extends Module{

    /*
    CONSTRUCTEUR
    */

    // La méthode du constructeur pour un module fonctionnel
    public function __construct(){
         // Nom technique
        $this->name = "mysiteadvice";

        // Nom public
        $this->displayName = "Mon module de témoignages pour le site";

        // Catégorie de module
        $this->tab = "front_office_features";
        // Version du module
        $this->version = "0.1.0";
        // Nom de l'auteur
        $this->author = "Camille Niquet";
        // Description du module
        $this->description = "Ce module permet aux clients de laisser des témoignages sur votre site.";

        // Flag Bootstrap
        $this->bootstrap = true;

        // Appel de la méthode parent
        parent::__construct();

    } // consctruct()


    /*
    PAGE DE CONFIGURATION
    */

    // Création de la page configuration (affiche automatiquement un lien de configuration)
    // Fonction standard getContent -> retourne le contenu affiché
    public function getContent(){
        // Appel de la fonction saveConfiguration
        $this->saveConfiguration();
        // Appel de la fonction assignConfiguration
        $this->assignConfiguration();
        // Méthode display utilise automatiquement le template du répertoire views/...
        return $this->display(__FILE__, 'getContent.tpl');
    }

    /*
    SAUVEGARDE DE LA CONFIGURATION
    */

    public function saveConfiguration(){
        //Si le formulaire a été envoyé 
        if(Tools::isSubmit("submit_mysiteadvice_form")){

            // Récupère la valeur POST associée à la clé passée en paramètre
            $enable_advices = Tools::getValue('enable_advices');
            // Sauvegarde des valeurs (clé en premier paramètre et valeur en second)
            // updateValue crée une nouvelle entrée dans la table de config ou la met à jour 
            Configuration::updateValue('MYADVICE_ADVICES', $enable_advices);

            // Assigne une variable de confirmation à l'objet Smarty
            $this->context->smarty->assign('confirmation', 'ok');
        }
    }


    /*
    AFFICHAGE DE LA CONFIGURATION SAUVEGARDEE DANS SMARTY
    */
    public function assignConfiguration(){
            // Récupère les valeurs de confirmation 
            $enable_advices = Configuration::get('MYADVICE_ADVICES');

            // Assigne les valeurs de confirmation à Smarty
            $this->context->smarty->assign('enable_advices', $enable_advices);

    }

    /*
    METHODE D'INSTALLATION POUR ACCROCHER LE MODULE SUR UN HOOK
    */

    public function install(){
        // La méthode install ajoute le module dans la table SQL ps_module
        parent::install();
        // registerHook a besoin de la valeur id_module donc install doit être appelée avant
        $this->registerHook('displayHome');
        // La valeur de retour indique si l'installation a réussi (true par défaut)
        return true;
    }

    /*
    AFFICHAGE DU TEMPLATE
    */

    public function hookDisplayHome($params){
        // Appel des fonctions
        $this->processHomeTabContent();
        $this->assignHomeTabContent();

        // Affichage du template
        return $this->display(__FILE__, 'displayHome.tpl');        
    }


    /*
    ENREGISTREMENT DES COMMENTAIRES DANS LA BASE DE DONNEES
    */

    public function processHomeTabContent(){
        // Vérifie si le formulaire est soumis
        if(Tools::isSubmit('mymod_pc_submit_advice')){
            // Récupération des données postées
            $advice = Tools::getValue('advice');
            // Tableau associatif des données à insérer
            $insert = array(
                // Méthode pSQL pour protéger la requête d'une injection de dépendances
                'advice' => pSQL($advice),
                'date_add' => date('Y-m-d H:i:s'),
            );
            // Insertion des données
            // Instanciation de Db et appel de la méthode statique getInstance pour se connecter à la BD
            Db::getInstance()->insert('mymod_advice', $insert);
        }
    }

    /*
    AFFICHAGE DES COMMENTAIRES
    */

    public function assignHomeTabContent(){
        // Récupération des valeurs de configuration
        $enable_advices = Configuration::get('MYADVICE_ADVICES');

        // Requête SQL pour extraire les témoignages
        $advices = Db::getInstance()->executeS(
            // La constante _DB_PREFIX_ permet de spécifier le préfixe choisi (=ps_)
            'SELECT * FROM ' . _DB_PREFIX_ . 'mymod_advice'
        );

        // Assignation des valeurs récupérées à Smarty
        $this->context->smarty->assign('enable_advices', $enable_advices);
        $this->context->smarty->assign('advices', $advices);
    }

} // class MySiteAdvice