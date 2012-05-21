<?php
class codeHighlighter
{

	public static function publicHeadContent($core)
	{
		$settings =& $core->blog->settings->codeHighlighter;
		
		if($core->blog->settings->codeHighlighter->color == 2) {
			echo '<style>', "\n", 'pre code {', "\n", '  display: block; padding: 0.5em;', "\n",
                 '  background: ', $settings->color_background, ';', "\n",
                 '}', "\n\n", 'pre code, pre .ruby .subst, pre .tag .title, pre .lisp .title {', "\n",
                 '  color: ', $settings->color_text, ';', "\n",
                 '}', "\n\n", 'pre .string, pre .title, pre .constant, pre .parent, pre .tag .value, pre .rules .value, pre .rules .value .number, pre .preprocessor, pre .ruby .symbol, pre .ruby .symbol .string, pre .ruby .symbol .keyword, pre .ruby .symbol .keymethods, pre .instancevar, pre .aggregate, pre .template_tag, pre .django .variable, pre .smalltalk .class, pre .addition, pre .flow, pre .stream, pre .bash .variable, pre .apache .tag, pre .apache .cbracket, pre .tex .command, pre .tex .special, pre .erlang_repl .function_or_atom, pre .markdown .header {', "\n",
                 '  color: ', $settings->color_string, ';', "\n",
                 '  font-style : ', ($settings->color_string_italic ? 'italic' : 'normal'), ';', "\n",
                 '  font-weight: ', ($settings->color_string_bold   ? 'bold'   : 'normal'), ';', "\n",
                 '}', "\n\n", 'pre .comment, pre .annotation, pre .template_comment, pre .diff .header, pre .chunk, pre .markdown .blockquote {', "\n",
                 '  color: ', $settings->color_comment, ';', "\n",
                 '  font-style : ', ($settings->color_comment_italic ? 'italic' : 'normal'), ';', "\n",
                 '  font-weight: ', ($settings->color_comment_bold   ? 'bold'   : 'normal'), ';', "\n",
                 '}', "\n\n", 'pre .number, pre .date, pre .regexp, pre .literal, pre .smalltalk .symbol, pre .smalltalk .char, pre .go .constant,pre .change, pre .markdown .bullet, pre .markdown .link_url {', "\n",
                 '  color: ', $settings->color_number, ';', "\n",
                 '  font-style : ', ($settings->color_number_italic ? 'italic' : 'normal'), ';', "\n",
                 '  font-weight: ', ($settings->color_number_bold   ? 'bold'   : 'normal'), ';', "\n",
                 '}', "\n\n", 'pre .label, pre .javadoc, pre .ruby .string, pre .decorator, pre .filter .argument, pre .localvars, pre .array, pre .attr_selector, pre .important, pre .pseudo, pre .pi, pre .doctype, pre .deletion, pre .envvar, pre .shebang, pre .apache .sqbracket, pre .nginx .built_in, pre .tex .formula, pre .erlang_repl .reserved, pre .input_number, pre .markdown .link_label {', "\n",
                 '  color: ', $settings->color_label, '', "\n",
                 '  font-style : ', ($settings->color_label_italic ? 'italic' : 'normal'), ';', "\n",
                 '  font-weight: ', ($settings->color_label_bold   ? 'bold'   : 'normal'), ';', "\n",
                 '}', "\n\n", 'pre .keyword, pre .id, pre .phpdoc, pre .title, pre .built_in, pre .aggregate, pre .css .tag, pre .javadoctag, pre .phpdoc, pre .yardoctag, pre .smalltalk .class, pre .winutils, pre .bash .variable, pre .apache .tag, pre .go .typename, pre .tex .command, pre .markdown .strong {', "\n",
                 '  color: ', $settings->color_keyword, '', "\n",
                 '  font-style : ', ($settings->color_keyword_italic ? 'italic' : 'normal'), ';', "\n",
                 '  font-weight: ', ($settings->color_keyword_bold   ? 'bold'   : 'normal'), ';', "\n",
                 '}', "\n\n", 'pre .markdown .emphasis {', "\n",
                 '  font-style: italic;', "\n",
                 '}', "\n\n", 'pre .nginx .built_in {', "\n",
                 '  font-weight: normal;', "\n",
                 '}', "\n\n", 'pre .coffeescript .javascript, pre .xml .css, pre .xml .javascript, pre .xml .vbscript, pre .tex .formula {', "\n",
                 '  opacity: 0.5;', "\n",
                 '}', "\n", '</style>';
		} else {
			$url = "http://yandex.st/highlightjs/6.2/styles/";
			
			echo '<link rel="stylesheet" href="', $url, $settings->color_schema, '.min.css" />', "\n";
		}
	}
	
	public static function publicFooterContent($core)
	{
		$settings =& $core->blog->settings->codeHighlighter;
		
		if($core->blog->settings->codeHighlighter->lang == 2) {
			$url = $core->blog->getQmarkURL().'pf='.basename(dirname(__FILE__));
			$lang = array('1c','actionscript','apache','avrasm','axapta','bash','cmake','coffeescript','cpp','cs','css','delphi','diff','django','dos','erlang-repl','erlang','go','haskell','xml','ini','java','javascript','lisp','lua','markdown','matlab','mel','nginx','objectivec','parser3','perl','php','profile','python','renderman','ruby','rust','scala','smalltalk','sql','tex','vbscript','vhdl','vala');
			
			echo '<script src="', $url, '/js/highlight.js"></script>', "\n";
			
			for ($i = 0; $i < 45; $i++) {
				if($settings->{'lang_'.($i+1)}) {
					echo '<script src="', $url, '/js/', $lang[$i],'.min.js"></script>', "\n";
				}
			}
		
		} else {
			echo '<script src="http://yandex.st/highlightjs/6.2/highlight.min.js"></script>', "\n";
		}
		
		echo '<script>hljs.initHighlightingOnLoad();</script>', "\n";
	}
    
    public static function parse($text, $args)
    {
        $args = split(" ", $args);
        return "<pre><code class='".$args[1]."'>".$text."</code></pre>";
    }
    
    public static function highlight($wiki2xhtml)
    {
        $wiki2xhtml->registerFunction('macro:code', array('codeHighlighter', 'parse'));
    }
}
