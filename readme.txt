=== Co-marquage service-public.fr by emendo.fr ===
Contributors: emendo.fr
Donate link: http://www.emendo.fr/
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl.html
Tags: comarquage, co-marquage, service public, service, public, gov, emendo, demarche, guide
Requires at least: 3.9
Tested up to: 4.3
Stable tag: 0.4.0

Link to the French government service (co-marquage) : service-public.fr

== Description ==

Ce plugin permet d'intégrer les pages d'informations de [service-public.fr](http://www.service-public.fr) directement dans votre site Internet.
Vous disposez ainsi du co-marquage service-public.fr pour votre site Internet sous Wordpress.<br>
Grâce à un shortcode, il affiche toutes les informations administratives (Comment faire une carte d'identité, ...).
Il suffit d'ajouter ce shortcode dans la page de votre choix. ex pour les particuliers : 
    [comarquage category="part"]
<br>Conçu spécifiquement pour les collectivités territoriales française, votre mairie pourra proposer des démarches en ligne à travers le site mon.service-public.fr via ce plugin.

[emendo](http://www.emendo.fr/) a développé ce plugin dans le cadre de projets réalisés pour des collectivités. Nous en assurons aujourd'hui la maintenance et le mettons à disposition.

> <strong>Support Premium</strong><br>
> [EMENDO](http://www.emendo.fr/contact/) vous propose un support Premium. En lien direct avec nos développeurs, nous vous assisterons dans le cadre de l'installation et de l'utilisation du plugin.
> C'est une façon de soutenir notre travail, tout en vous simplifiant la gestion de votre site.

= Fonctionnement =
* Copie les données provenant de service-public.fr dans votre espace web
* Vérifie toutes les 24 heures s'il existe une mise à jour des données de service-public.fr
* Affiche de façon formaté les données de service-public.fr (voir l'onglet Screenshots)
* Permet l'affichage des établissements locaux

= Etablissements locaux & Téléservices =
En fonction du sujet (carte d'identité, assurance, ...), l'internaute est dirigé vers les établissements locaux (mairie, tribunal, service des impôts, ...) ou vers les services en lignes.
En souscrivant aux téléservices de [mon.service-public.fr](http://mon.service-public.fr) votre mairie proposera des démarches en ligne (état civil, liste électorale, recensement, ... ) via ce plugin.
Pour plus d'informations sur la démarche, veuillez-vous rendre dans la page de réglage du plugin.

> <strong>Signaler un Bug</strong><br>
> Nous utilisons la plateforme Bitbucket pour le suivi des bugs.
> Vous constatez un bug ou souhaitez une amélioration : [gestion des bugs sous Bitbucket](https://bitbucket.org/emendo-fr/emendo-comarquage/issues?status=new&status=open)


<br>
<br>
<hr>
<br>


This plugin allows you to integrate information pages from [service-public.fr](http://www.service-public.fr) directly into your website.
This gives you the service-public.fr co-marquage for your Wordpress website.
Simply by aadding a shortcode, it displays all the administrative information (New identity card, ...).
Just add the shortcode in the page of your choice. eg for individuals: [co-marquage category = "part"]
Designed specifically for French local authorities, your city may propose steps online through the site mon.service-public.fr via this plugin.

[Emendo](http://www.emendo.fr/) developed this plugin in the draft framework created for communities. We now provide maintenance and make available.

> <Strong> Premium Support </strong><br>
> [Emendo](http://www.emendo.fr/contact/) offers a premium support. Directly related to our developers, we will assist you through the installation and use of the plugin.
> This is a way to support our work, while simplifying your site management.

= Features =
* Copy service-public.fr data to your web space
* Checks every 24 hours if there is update available at service-public.fr
* Displays formatted data (see the Screenshots tab)
* Allows the display of local institutions

= Online service & Local Institutions =
Depending on the subject (identity card, insurance, ...), the user is directed to the local institutions (town hall, court, tax office, ...) or to the online services.
By subscribing to the online service [mon.service-public.fr](http://mon.service-public.fr) your city will propose procedures online (electoral list, census ...) via this plugin .
For more information on the process, please visit the plugin settings page.

> <Strong> Report Bug </strong> <br>
> We use bitbucket platform for tracking bugs.
> You experience a bug or would like an improvement: [Bug Tracking under bitbucket](https://bitbucket.org/emendo-fr/emendo-comarquage/issues?status=new&status=open)


== Installation ==

Explications en français ;)

- Copiez ce plugin dans votre dossier de plugins (wp-content/plugins/)
- Activez le depuis l'interface d'administration de wordpress : sous le menu "Extensions"
- Aller ensuite dans les réglages pour préciser les informations sur votre commune (Département, code INSEE, ...)
- Il vous faut ensuite ajouter le shortcode dans la page qui affichera le guide. ex : 
    [comarquage category="part"]. 
<br>categorie disponible : part, pro ou asso

Pour des questions graphique et de visibilité, nous conseillons l'affichage dans un template de page sans colonne latérale.


== Changelog ==

= 0.4.0 =
Release Date: 2015-11-23

* Bugfixes:
	* Fixe some CSS issu
	* Fixe test on frontend / alert
	* Fixe errors on activate
	* Fixe unsaved options in settings page
* Enhancements:
	* Add a install checkup before enable plugin
	* Error management during file transfert
	* Change sidebar block header. Remove h3 headings from list
	* Use HTTPS link for service-public data download
	* Enhance settings page in the admin

= 0.3.9 =
Release Date: 2015-11-09

* Bugfixes:
	* Fixes error on plugin manual activate

= 0.3.8 =
Release Date: 2015-11-09

* Bugfixes:
	* Fixes CSS problem with bootstrap theme
	* Fixes XML directory delete bug
	* Updated the minimum required version of WordPress to 4.0.

* Improve : 
	* CSS
	* Modification in XSL format (v3 compatibility)
	* Prepare the update for v3 flow

= 0.3.7 =
Release Date: 2015-06-03

* First release publish on wordpress repository


== Screenshots ==

1. Sommaire d’accueil
2. Exemple d’une page de guide pour une démarche
3. Exemple de localisation
4. Page de réglages dans l'admin
