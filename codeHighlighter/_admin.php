<?php
if (!defined('DC_CONTEXT_ADMIN')) { return; }

// Support du plugin en syntaxe wiki
$core->addBehavior('coreInitWikiPost', array('codeHighlighter', 'highlight'));

// Ajout de l'interface de gestion du plugin au menu de Dotclear
$_menu['Plugins']->addItem(
	# nom du lien
	'codeHighlighter',
	# URL de base de la page d'administration
	'plugin.php?p=codeHighlighter',
	# URL de l'image utilisée comme icône
	'index.php?pf=codeHighlighter/icon.png',
	# expression régulière de l'URL de la page d'administration
	preg_match('/plugin.php\?p=codeHighlighter(&.*)?$/',
		$_SERVER['REQUEST_URI']),
	# permissions nécessaires pour afficher le lien
	$core->auth->check('contentadmin',$core->blog->id));