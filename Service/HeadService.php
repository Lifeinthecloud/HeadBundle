<?php

namespace LITC\HeadBundle\Service;

/**
 * HeadService
 * Classe de balise HEAD
 * Générateur de balises d'en-tête HEAD
 *
 * @package LITC\HeadBundle\Service
 *
 * @version 1.1
 * @date 07/01/2015
 * @author Antoine DARCHE & Grégory DARCHE (Life in the cloud)
 * @organisation Lifeinthecloud
 * @url http://lifeinthecloud.fr
 */
class HeadService
{
    private $elements;   	//!< (array) Tableau des balises ajoutées

    public function __construct()
    {
        $this->init();
    }
    
    /*
     * Initialize the Elements needed by default
     */
    public function init()
    {
        $this->elements = array(
            # Commentaires
            'comments' => "<!-- ".date('Y-d-m H:m:s')." -->\r\n",
            # META
            'meta' => array(
                'http-equiv' => array(
                    #update: remplacement de content-language par Content-Type, et "utf" en lettre capitales par nicolas le 19052008
                    'Content-Type' => 'text/html; charset=UTF-8',
                    'X-UA-Compatible' => 'IE=edge',
                    'Content-language' => 'fr-FR',
                    'Robots' => 'all,follow,index',
                    'expires' => '',
                    'refresh' => '',
                    'set-cookie' => ''
                ),
                'schemes' => array(
                    'ISBN' => '',
                ),
                'name' => array(
                    'viewport' => 'width=device-width, initial-scale=1',
                    'title' => 'iZite : Création de site internet ',
                    'keywords' => 'lifeinthecloud, Life in the cloud, Cloud, DARCHE, simple, développement',
                    'description' => 'Ma description',
                    'author' => 'Antoine Darche',
                    'copyright' => 'Antoine Darche 2009',
                    'rev' => 'darche.antoine@gmail.com',
                    'generator' => 'Antoine Darche !',
                    'rating' => 'general',
                    'revisit-after' => '7 days',
                    'robots' => 'all',
                    'google-site-verification' => '7oNxy6O6iS_HQLNB9QzOPxnxr-vCwsLHBkzpqvz3fdI', // Clé de référencement Google => centre pour les webmaster
                    'msvalidate.01' => 'EB06A8E5197BEFCB40A9A3095438AD47',  /* Clé de référencement bing */
                    'y_key' => '3d747fbd6816ad66'           /* Clé de référencement yahoo */
                )
            ),
            # Link
            'link' => array(
                'favicon' => 'favicon.png',
                'stylesheet' => array(
                    'files' => array(
                        'screen' => array(),
                        'print' => array(),
                        'media' => array(),
                        'aural' => array(),
                        'tty' => array(),
                        'tv' => array(),
                        'projection' => array(),
                        'handheld' => array(),
                        'braille' => array(),
                        'all' => array(),
                        'scripts' => array(),
                    )
                )
            ),
            # Scripts
            'script' => array(
                'javascript' => array(
                    'files' => array(),
                    'scripts' => array(),
                )
            )
        );
    }


    #----------------------------------------------------------------------------
    # Fonctions title, http, metatags, keywords, description
    #----------------------------------------------------------------------------


    /**
     * setTitle
     * Définir la balise META TITLE
     *
     * @param $str  (string) Titre de la page
     * @param $opt    (string)  optionnel - traitement de la variable
     *                            + permet l'ajout a la valeur actuelle (default)
     *                            = permet le remplacement de la valeur actuelle
     */
    public function setTitle($str, $opt='+')
    {
        if ($opt=='=')
            $this->elements['meta']['name']['title'] = $str;
        else
            $this->elements['meta']['name']['title'].= $str;
    }


    /**
     * setKeywords
     * Définir la balise META KEYWORD
     *
     * @param $str   (string)  Mots clés de la page
     * @param $opt    (string)  optionnel - traitement de la variable
     *                            + permet l'ajout a la valeur actuelle (default)
     *                            = permet le remplacement de la valeur actuelle
     */
    public function setKeywords($str, $opt='+')
    {
        if ($opt == '=')
            $this->elements['meta']['name']['keywords'] = $str;
        else
            $this->elements['meta']['name']['keywords'].= ','.$str;
    }


    /**
     * setDescription
     * Définir la balise META DESCRIPTION
     *
     * @param $str   (string)  Description de la page
     */
    public function setDescription($str, $opt='+')
    {
        if ($opt == '=')
            $this->elements['meta']['name']['description'] = $str;
        else
            $this->elements['meta']['name']['description'].= ','.$str;
    }


    /**
     * setMetaName
     * Définir les balises META avec l'attribut NAME
     *
     * @param $name   (string)  Contenu de l'attribut NAME
     * @param   $content(string)  valeur de l'attribut CONTENT
     */
    public function setMetaName($name, $content)
    {
        $this->elements['meta']['name'][$name] = $content;
    }


    /**
     * setMetaHttp
     * Définir les balises META avec l'attribut HTTP
     *
     * @param $name   (string)  Contenu de l'attribut HTTP
     * @param   $content(string)  valeur de l'attribut CONTENT
     */
    public function setMetaHttp($name, $content)
    {
        $this->elements['meta']['http-equiv'][$name] = $content;
    }


    /**
     * setMetaSchemes
     * Définir les balises META SHEMES
     *
     * @param $name   (string)  Contenu de l'attribut HTTP
     * @param   $content(string)  valeur de l'attribut CONTENT
     */
    public function setMetaSchemes($name, $content)
    {
        $this->elements['meta']['schemes'][$name] = $content;
    }


    /**
     * setFavicon
     * Définir la balise LINK FAVICON
     *
     * @param $file   (string)  URL de l'icone
     */
    public function setFavicon($file)
    {
        $this->elements['link']['favicon'] = $file;
    }


    #----------------------------------------------------------------------------
    # Fonctions feuilles et scripts Javascript et CSS
    #----------------------------------------------------------------------------


    /**
     * addCssFile
     * Ajouter un fichier de style CSS
     *
     * @param $file   (string)  URL du fichier
     * @param   $media  (string)  Optionnel - type de media (default:screen)
     */
    public function addCssFile($file, $media='screen')
    {
        array_push($this->elements['link']['stylesheet']['files'][$media], $file);
    }


    /**
     * addCssScript
     * Ajouter une portion de code CSS
     *
     * @param $file   (string)  portion de code
     */
    public function addCssScript($script)
    {
        $this->elements['link']['stylesheet']['scripts'][] = $script;
    }


    /**
     * addJsFile
     * Ajouter un fichier javascript
     *
     * @param $file   (string)  URL du fichier
     */
    public function addJsFile($file)
    {
        array_push($this->elements['script']['javascript']['files'], $file);
    }


    /**
     * addJsScript
     * Ajouter une portion de code Javascript
     *
     * @param $file   (string)  portion de code
     */
    public function addJsScript($script)
    {
        $this->elements['script']['javascript']['scripts'][] = $script;
    }


    #----------------------------------------------------------------------------
    # Fonctions pour créer le code HTML <HEAD>
    #----------------------------------------------------------------------------


    /**
     * create
     * Créer la portion HTML contenant l'ensemble des balises générées
     *
     * @return (string)  Portion HTML
     */
    private function create()
    {
        $h = $this->elements['comments'];
        $h.= "<title>".$this->cutString($this->elements['meta']['name']['title'], 80)."</title>\r\n";
        foreach($this->elements['meta']['http-equiv'] as $key => $value) {
            if (!empty($value))
                $h.= "<meta http-equiv=\"".$key."\" content=\"".$value."\" />\r\n";
        }
        foreach($this->elements['meta']['schemes'] as $key => $value) {
            if (!empty($value))
                $h.= "<meta schemes=\"".$key."\" name=\"identifier\" content=\"".$value."\" />\r\n";
        }
        foreach($this->elements['meta']['name'] as $key => $value) {
            if (!empty($value)) {
                if ($key=='keywords')
                    $value = $this->cutString($value, 1000);
                else if ($key=='description')
                    $value = $this->cutString($value, 2000);
                $h.= "<meta name=\"".$key."\" content=\"".$value."\" />\r\n";
            }
        }
        foreach($this->elements['link']['stylesheet']['files'] as $media => $files) {
            foreach($files as $value) {
                $h.= "<link rel=\"stylesheet\" type=\"text/css\" href=\"".$value."\" media=\"".$media."\" />\r\n";
            }
        }
        if (!empty($this->elements['link']['favicon']))
            $h.= "<link rel=\"shortcut icon\" href=\"".$this->elements['link']['favicon']."\" />\r\n";
        $code='';
        if (isset($this->elements['link']['stylesheet']['scripts'])) {
            foreach($this->elements['link']['stylesheet']['scripts'] as $value) {
                $code.= $value;
            }
        }
        if ($code!=='')
            $h.= "<style type=\"text/css\">".$code."</style>\r\n";
        foreach($this->elements['script']['javascript']['files'] as $value) {
            $h.= "<script type=\"text/javascript\" src=\"".$value."\"></script>\r\n";
        }
        $code='';
        foreach($this->elements['script']['javascript']['scripts'] as $value) {
            $code.= $value;
        }
        if ($code!=='')
            $h.= "<script type=\"text/javascript\">".$code."</script>\r\n";
        $h = substr($h, 0, -2);

        return $h;
    }


    /**
     * __toString
     * Retourne la portion HTML contenant l'ensemble des balises générées
     *
     * @return (string)  Portion HTML
     */
    public function __toString()
    {
        return $this->create();
    }


    #----------------------------------------------------------------------------
    # Fonctions privées diverses, debug et destructeur
    #----------------------------------------------------------------------------


    private function cutString($str, $nbChars)
    {
        if(strlen($str)>=$nbChars)
            return $str=substr($str,0,$nbChars);
        else
            return $str;
    }


    public function debug()
    {
        $str = nl2br(htmlentities($this->create()));
        $str.= '<pre>';
        $str.= print_r($this, true);
        $str.= '</pre>';
        return $str;
    }


    private function __destructor()
    {
        unset($this);
    }
    //fin.
}