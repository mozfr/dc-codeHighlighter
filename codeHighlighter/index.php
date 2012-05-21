<?php 
if (!defined('DC_CONTEXT_ADMIN')) { return; }

$core->blog->settings->addNameSpace('codeHighlighter');
$settings =& $core->blog->settings->codeHighlighter;

$default_tab = 'tab-1';
 
if (isset($_REQUEST['tab'])) {
	$default_tab = $_REQUEST['tab'];
}

if (!empty($_POST['savelang'])) {
	if (!empty($_POST['lang']) && ($_POST['lang'] == 1 || $_POST['lang'] == 2)) {
		$settings->put('lang', $_POST['lang'],'integer');
	}
	
	if (empty($_POST['langage'])) {
		$_POST['langage'] = array();
	}
	
	for ($i = 1; $i <= 45; $i++) {
		$settings->put('lang_'.$i, !empty($_POST['langage'][$i]),'boolean');
	}
	
	http::redirect($p_url.'&tab=tab-1&savelang=1');
}

if (!empty($_POST['savecolor'])) {
	if (!empty($_POST['color']) && ($_POST['color'] == 1 || $_POST['color'] == 2)) {
		$settings->put('color', $_POST['color'],'integer');
	}
	
	if (!empty($_POST['schemas']) && in_array($_POST['schemas'], array('default','dark','far','idea','sunburst','zenburn','vs','ascetic','magula','github','googlecode','brown_paper','school_book','ir_black','solarized_dark','solarized_light','arta','monokai'))) {
		$settings->put('color_schema', $_POST['schemas'],'string');
	}
	
	$colorPattern = '/^#[0-9A-F]{6}$/i';
	
	if (!empty($_POST['colors']) && is_array($_POST['colors'])) {
		foreach($_POST['colors'] as $k => $v){
			if (preg_match($colorPattern, $v)) {
				$settings->put('color_'.$k, $v, 'string');
			}
		}
	}
	
	$settings->put('color_string_bold',    !empty($_POST['bold']['string']),    'boolean');
	$settings->put('color_string_italic',  !empty($_POST['italic']['string']),  'boolean');
	$settings->put('color_number_bold',    !empty($_POST['bold']['number']),    'boolean');
	$settings->put('color_number_italic',  !empty($_POST['italic']['number']),  'boolean');
	$settings->put('color_label_bold',     !empty($_POST['bold']['label']),     'boolean');
	$settings->put('color_label_italic',   !empty($_POST['italic']['label']),   'boolean');
	$settings->put('color_keyword_bold',   !empty($_POST['bold']['keyword']),   'boolean');
	$settings->put('color_keyword_italic', !empty($_POST['italic']['keyword']), 'boolean');
	$settings->put('color_comment_bold',   !empty($_POST['bold']['comment']),   'boolean');
	$settings->put('color_comment_italic', !empty($_POST['italic']['comment']), 'boolean');

	http::redirect($p_url.'&tab=tab-2&savecolor=1');
}

if (isset($_GET['savelang']))
{
	$msg = "Mise à jour des langages réalisé avec succès.";
}

if (isset($_GET['savecolor']))
{
	$msg = "Mise à jour du schéma de couleur réalisé avec succès.";
}

?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Administration du plugin codeHighlighter</title>
	
	<?php echo dcPage::jsPageTabs($default_tab); ?>
</head>
<body>
	
	<h2><?php echo html::escapeHTML($core->blog->name).' &rsaquo; '.'codeHighlighter'; ?></h2>
 
 	<?php if (!empty($msg)) {echo '<p class="message">'.$msg.'</p>';} ?>

	<div class="multi-part" id="tab-1" title="Langages">
		<h3>Choix des langages à colorer</h3>
		
		<form method="post" action="<?php echo($p_url); ?>">
			<p><?php echo $core->formNonce(); ?></p>
			<fieldset>
				<legend>Version pré-construite</legend>
				<p>
					<label class="classic"><?php echo form::radio(array('lang'),html::escapeHTML('1'), $settings->lang != 2); ?> Utiliser highlight.js hébergé chez <a href="http://api.yandex.ru/jslibs/libs.xml#highlightjs">Yandex</a></label>
				</p>
				<blockquote>Cette version supporte les langages suivant : HTML/XML, Javascript, CSS, PHP, Ruby, Perl, Python, C++, C#, Java, SQL, Bash, Ini et Diff</blockquote>
			</fieldset>
			<fieldset>
				<legend>Version personnalisée</legend>
				<p>
					<label class="classic"><?php echo form::radio(array('lang'),html::escapeHTML('2'), $settings->lang == 2); ?> Utiliser une version personnalisé de highlight.js</label>
				</p>
				
				<div class="three-cols clear">
					<div class="col">
						<ul>
							<ol><label class="classic"><?php echo form::checkbox('langage[1]','1C',$settings->lang_1), ' 1C'; ?></label></ol>
							<ol><label class="classic"><?php echo form::checkbox('langage[2]','AVR Assembler',$settings->lang_2), ' AVR Assembler'; ?></label></ol>
							<ol><label class="classic"><?php echo form::checkbox('langage[3]','ActionScript',$settings->lang_3), ' ActionScript'; ?></label></ol>
							<ol><label class="classic"><?php echo form::checkbox('langage[4]','Apache',$settings->lang_4), ' Apache'; ?></label></ol>
							<ol><label class="classic"><?php echo form::checkbox('langage[5]','Axapta',$settings->lang_5), ' Axapta'; ?></label></ol>
							<ol><label class="classic"><?php echo form::checkbox('langage[6]','Bash',$settings->lang_6), ' Bash'; ?></label></ol>
							<ol><label class="classic"><?php echo form::checkbox('langage[7]','C#',$settings->lang_7), ' C#'; ?></label></ol>
							<ol><label class="classic"><?php echo form::checkbox('langage[8]','C++',$settings->lang_8), ' C++'; ?></label></ol>
							<ol><label class="classic"><?php echo form::checkbox('langage[9]','CMake',$settings->lang_9), ' CMake'; ?></label></ol>
							<ol><label class="classic"><?php echo form::checkbox('langage[10]','CoffeeScript',$settings->lang_10), ' CoffeeScript'; ?></label></ol>
							<ol><label class="classic"><?php echo form::checkbox('langage[11]','CSS',$settings->lang_11), ' CSS'; ?></label></ol>
							<ol><label class="classic"><?php echo form::checkbox('langage[12]','DOS .bat',$settings->lang_12), ' DOS .bat'; ?></label></ol>
							<ol><label class="classic"><?php echo form::checkbox('langage[13]','Delphi',$settings->lang_13), ' Delphi'; ?></label></ol>
							<ol><label class="classic"><?php echo form::checkbox('langage[14]','Diff',$settings->lang_14), ' Diff'; ?></label></ol>
							<ol><label class="classic"><?php echo form::checkbox('langage[15]','Django',$settings->lang_15), ' Django'; ?></label></ol>
						</ul>
					</div>
					<div class="col">
						<ul>
							<ol><label class="classic"><?php echo form::checkbox('langage[16]','Erlang',$settings->lang_16), ' Erlang'; ?></label></ol>
							<ol><label class="classic"><?php echo form::checkbox('langage[17]','Erlang REPL',$settings->lang_17), ' Erlang REPL'; ?></label></ol>
							<ol><label class="classic"><?php echo form::checkbox('langage[18]','Go',$settings->lang_18), ' Go'; ?></label></ol>
							<ol><label class="classic"><?php echo form::checkbox('langage[19]','Haskell',$settings->lang_19), ' Haskell'; ?></label></ol>
							<ol><label class="classic"><?php echo form::checkbox('langage[20]','HTML, XML',$settings->lang_20), ' HTML, XML'; ?></label></ol>
							<ol><label class="classic"><?php echo form::checkbox('langage[21]','Ini',$settings->lang_21), ' Ini'; ?></label></ol>
							<ol><label class="classic"><?php echo form::checkbox('langage[22]','Java',$settings->lang_22), ' Java'; ?></label></ol>
							<ol><label class="classic"><?php echo form::checkbox('langage[23]','JavaScript',$settings->lang_23), ' JavaScript'; ?></label></ol>
							<ol><label class="classic"><?php echo form::checkbox('langage[24]','Lisp',$settings->lang_24), ' Lisp'; ?></label></ol>
							<ol><label class="classic"><?php echo form::checkbox('langage[25]','Lua',$settings->lang_25), ' Lua'; ?></label></ol>
							<ol><label class="classic"><?php echo form::checkbox('langage[26]','MEL',$settings->lang_26), ' MEL'; ?></label></ol>
							<ol><label class="classic"><?php echo form::checkbox('langage[27]','Markdown',$settings->lang_27), ' Markdown'; ?></label></ol>
							<ol><label class="classic"><?php echo form::checkbox('langage[28]','Matlab',$settings->lang_28), ' Matlab'; ?></label></ol>
							<ol><label class="classic"><?php echo form::checkbox('langage[29]','Nginx',$settings->lang_29), ' Nginx'; ?></label></ol>
							<ol><label class="classic"><?php echo form::checkbox('langage[30]','Objective C',$settings->lang_30), ' Objective C'; ?></label></ol>
						</ul>
					</div>
					<div class="col">
						<ul>
							<ol><label class="classic"><?php echo form::checkbox('langage[31]','Parser3',$settings->lang_31), ' Parser3'; ?></label></ol>
							<ol><label class="classic"><?php echo form::checkbox('langage[32]','Perl',$settings->lang_32), ' Perl'; ?></label></ol>
							<ol><label class="classic"><?php echo form::checkbox('langage[33]','PHP',$settings->lang_33), ' PHP'; ?></label></ol>
							<ol><label class="classic"><?php echo form::checkbox('langage[34]','Python',$settings->lang_34), ' Python'; ?></label></ol>
							<ol><label class="classic"><?php echo form::checkbox('langage[35]','Python profile',$settings->lang_35), ' Python profile'; ?></label></ol>
							<ol><label class="classic"><?php echo form::checkbox('langage[36]','RenderMan',$settings->lang_36), ' RenderMan'; ?></label></ol>
							<ol><label class="classic"><?php echo form::checkbox('langage[37]','Ruby',$settings->lang_37), ' Ruby'; ?></label></ol>
							<ol><label class="classic"><?php echo form::checkbox('langage[38]','Rust',$settings->lang_38), ' Rust'; ?></label></ol>
							<ol><label class="classic"><?php echo form::checkbox('langage[39]','Scala',$settings->lang_39), ' Scala'; ?></label></ol>
							<ol><label class="classic"><?php echo form::checkbox('langage[40]','Smalltalk',$settings->lang_40), ' Smalltalk'; ?></label></ol>
							<ol><label class="classic"><?php echo form::checkbox('langage[41]','SQL',$settings->lang_41), ' SQL'; ?></label></ol>
							<ol><label class="classic"><?php echo form::checkbox('langage[42]','TeX',$settings->lang_42), ' TeX'; ?></label></ol>
							<ol><label class="classic"><?php echo form::checkbox('langage[43]','VBScript',$settings->lang_43), ' VBScript'; ?></label></ol>
							<ol><label class="classic"><?php echo form::checkbox('langage[44]','VHDL',$settings->lang_44), ' VHDL'; ?></label></ol>
							<ol><label class="classic"><?php echo form::checkbox('langage[45]','Vala',$settings->lang_45), ' Vala'; ?></label></ol>
						</ul>
					</div>
				</div>
			</fieldset>
			<p><input type="submit" name="savelang" value="Enregistrer" /></p>
		</form>
	</div>
 
	<div class="multi-part" id="tab-2" title="Couleurs">
		<h3>Choix du schémas de coloration</h3>
		
		<form method="post" action="<?php echo($p_url); ?>">
			<p><?php echo $core->formNonce(); ?></p>
			<fieldset>
				<legend>Version pré-construite</legend>
				<p>
					<label class="classic"><?php echo form::radio(array('color'),html::escapeHTML('1'),$settings->color != 2); ?> Utiliser un schémas hébergé chez <a href="http://api.yandex.ru/jslibs/libs.xml#highlightjs">Yandex</a></label>
				</p>
				<p><label>Schémas&nbsp;: <?php echo form::combo('schemas',array(
					'Default'           => 'default',
					'Dark'              => 'dark',
					'FAR'               => 'far',
					'IDEA'              => 'idea',
					'Sunburst'          => 'sunburst',
					'Zenburn'           => 'zenburn',
					'Visual Studio'     => 'vs',
					'Ascetic'           => 'ascetic',
					'Magula'            => 'magula',
					'GitHub'            => 'github',
					'Google Code'       => 'googlecode',
					'Brown Paper'       => 'brown_paper',
					'School Book'       => 'school_book',
					'IR Black'          => 'ir_black',
					'Solarized - Dark'  => 'solarized_dark',
					'Solarized - Light' => 'solarized_light',
					'Arta'              => 'arta',
					'Monokai'           => 'monokai'
				),$settings->color_schema); ?></label></p>
			</fieldset>
			<fieldset>
				<legend>Version personnalisée</legend>
				<p>
					<label class="classic"><?php echo form::radio(array('color'),html::escapeHTML('2'),$settings->color == 2); ?> Utiliser un schémas personalisé</label>
				</p>
				<p>
					<label>Arrière-plan&nbsp; <?php echo form::field('colors[background]',10,7,$settings->color_background); /* #F0F0F0 */ ?></label>
				</p>
				<p>
					<label>Textes&nbsp; <?php echo form::field('colors[text]',10,7,$settings->color_text); /* #000000 */ ?></label>
				</p>
				<p>
					<label>Chaines de caractères&nbsp; <?php echo form::field('colors[string]',10,7,$settings->color_string); /* #880000 */ ?></label>
					<label class="classic"><?php echo form::checkbox('bold[string]','1',$settings->color_string_bold); ?>Gras</label> / 
					<label class="classic"><?php echo form::checkbox('italic[string]','1',$settings->color_string_italic); ?>Italic</label>
				</p>
				<p>
					<label>Nombres&nbsp; <?php echo form::field('colors[number]',10,7,$settings->color_number); /* #008800 */ ?></label>
					<label class="classic"><?php echo form::checkbox('bold[number]','1',$settings->color_number_bold); ?>Gras</label> / 
					<label class="classic"><?php echo form::checkbox('italic[number]','1',$settings->color_number_italic); ?>Italic</label>
				</p>
				<p>
					<label>Elements de langage&nbsp; <?php echo form::field('colors[label]',10,7,$settings->color_label); /* #8888FF */ ?></label>
					<label class="classic"><?php echo form::checkbox('bold[label]','1',$settings->color_label_bold); ?>Gras</label> / 
					<label class="classic"><?php echo form::checkbox('italic[label]','1',$settings->color_label_italic); ?>Italic</label>
				</p>
				<p>
					<label>Mots-clés&nbsp; <?php echo form::field('colors[keyword]',10,7,$settings->color_keyword); /* #000000 */ ?></label>
					<label class="classic"><?php echo form::checkbox('bold[keyword]','1',$settings->color_keyword_bold); ?>Gras</label> / 
					<label class="classic"><?php echo form::checkbox('italic[keyword]','1',$settings->color_keyword_italic); ?>Italic</label>
				</p>
				<p>
					<label>Commentaires&nbsp; <?php echo form::field('colors[comment]',10,7,$settings->color_comment); /* #888888 */ ?></label>
					<label class="classic"><?php echo form::checkbox('bold[comment]','1',$settings->color_comment_bold); ?>Gras</label> / 
					<label class="classic"><?php echo form::checkbox('italic[comment]','1',$settings->color_comment_italic); ?>Italic</label>
				</p>
			</fieldset>
			<p><input type="submit" name="savecolor" value="Enregistrer" /></p>
		</form>
	</div>
	
	<?php 
	if (!isset($__resources['help']['help']))
	{
		$__resources['help']['help'] = dirname(__FILE__).'/help.html';
	}

	dcPage::helpBlock('help');
	?>
</body>
</html>