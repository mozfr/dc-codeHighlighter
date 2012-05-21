<?php
if (!defined('DC_CONTEXT_ADMIN')) { return; }
 
# On lit la version du plugin
$m_version = $core->plugins->moduleInfo('codeHighlighter','version');
 
# On lit la version du plugin dans la table des versions
$i_version = $core->getVersion('codeHighlighter');
 
# La version dans la table est supérieure ou égale à
# celle du module, on ne fait rien puisque celui-ci
# est installé
if (version_compare($i_version,$m_version,'>=')) {
	return;
}
 
# La procédure d'installation commence vraiment là
$core->setVersion('codeHighlighter',$m_version);

$core->blog->settings->addNameSpace('codeHighlighter');
$settings =& $core->blog->settings->codeHighlighter;

if (!isset($settings->lang))               { $settings->put('lang',  1,'integer'); }
if (!isset($settings->color))              { $settings->put('color', 1,'integer'); }
if (!isset($settings->color_background))   { $settings->put('color_background', '#F0F0F0','string'); }
if (!isset($settings->color_text))         { $settings->put('color_text',       '#000000','string'); }
if (!isset($settings->color_string))       { $settings->put('color_string',     '#880000','string'); }
if (!isset($settings->color_number))       { $settings->put('color_number',     '#008800','string'); }
if (!isset($settings->color_label))        { $settings->put('color_label',      '#8888FF','string'); }
if (!isset($settings->color_keyword))      { $settings->put('color_keyword',    '#000000','string'); }
if (!isset($settings->color_comment))      { $settings->put('color_comment',    '#888888','string'); }
if (!isset($settings->color_keyword_bold)) { $settings->put('color_keyword_bold', true, 'boolean'); }