<?php
if (!defined('DC_RC_PATH')) { return; }

$core->addBehavior('publicHeadContent',array('codeHighlighter','publicHeadContent'));
$core->addBehavior('publicFooterContent',array('codeHighlighter','publicFooterContent'));
