/*
 * @file HTML Buttons plugin for CKEditor
 * Copyright (C) 2012 Alfonso Martínez de Lizarrondo
 * A simple plugin to help create custom buttons to insert HTML blocks
 */

CKEDITOR.plugins.add( 'htmlbuttons',
{
	init : function( editor )
	{
		var buttonsConfig = editor.config.htmlbuttons;
		if (!buttonsConfig)
			return;

		function createCommand( definition )
		{
			return {
				exec: function( editor ) {
					editor.insertHtml( definition.html );
				}
			};
		}

		// Create the command for each button
		for(var i=0; i<buttonsConfig.length; i++)
		{
			var button = buttonsConfig[ i ];
			var commandName = button.name;
			editor.addCommand( commandName, createCommand(button, editor) );

			editor.ui.addButton( commandName,
			{
				label : button.title,
				command : commandName
			});
		}
	} //Init

} );

/**
 * An array of buttons to add to the toolbar.
 * Each button is an object with these properties:
 *	name: The name of the command and the button (the one to use in the toolbar configuration)
 *	icon: The icon to use. Place them in the plugin folder
 *	html: The HTML to insert when the user clicks the button
 *	title: Title that appears while hovering the button
 *
 * Default configuration with some sample buttons:
 */
CKEDITOR.config.htmlbuttons =  [
  {
    name:'bigmessage',
    icon:'big-message.png',
    html:'\n<p class="big-message">\n'+
         '  <span class="big-message-icon icon-speech"></span>This site serves to help store owners and developers install, configure, and modify their Loaded Commerce installation. If you would like to help improve this documentation, please forward your proposals to the Collaborative Documentation Effort channel in the <a href="http://forums.loadedcommerce.com/" style="color:red;"><b>Community Support Forums</b></a>.\n'+
         '</p>',
    title:'Big Message'
  },
  {
    name:'prettyprint',
    icon:'pretty-print.png',
    html:'\n<pre class="prettyprint">\n'+
         '  &lt;span class="block-arrow top"&gt;\n'+
         '        &lt;span&gt;&lt;/span&gt;\n'+
         '  &lt;/span&gt;\n'+
         '</pre>',
    title:'Pretty Print'
  },
  {
    name:'quicktip',
    icon:'quick-tip.png',
    html:'\n<div class="big-left-icon icon-info-round">\n'+
         '  <h4 class="no-margin-bottom">Quick tip</h4>\n'+
         '  This style require that the parent element has <b>position:relative</b> or <b>position:absolute</b>. If the parent has no position set, add the class <b>relative</b>.\n'+
         '</div>\n',
    title:'Quick Tip'
  }/*,
  {
    name:'',
    icon:'.png',
    html:'\n'+
         '\n'+
         '\n'+
         '\n',
    title:''
  }*/
];



        
        
      