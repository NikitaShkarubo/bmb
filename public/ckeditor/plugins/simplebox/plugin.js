CKEDITOR.plugins.add('simplebox', {
    requires: 'widget',
    icons: 'simplebox',
    init : function( editor )
    {
        //  array of placeholders to choose from that'll be inserted into the editor
        var placeholders = [
            ['<div style="background-image: url(/placeholders/about.png); background-size: contain; height: 503px; width: 1900px;"></div>', 'About us'],
            ['<div style="background-image: url(/placeholders/contact_form.png); background-size: contain; height: 454px; width: 1900px;"></div>', 'Contact form'],
            ['<div style="background-image: url(/placeholders/commitment.png); background-size: contain; height: 341px; width: 1898px;"></div>', 'Commitment'],
            ['<div style="background-image: url(/placeholders/intro.png); background-size: contain; height: 558px; width: 1902px;"></div>', 'Intro'],
            ['<div style="background-image: url(/placeholders/our_expirience.png); background-size: contain; height: 788px; width: 1894px;"></div>', 'Our experience block'],
            ['<div style="background-image: url(/placeholders/testimonials.png); background-size: contain; height: 585px; width: 1900px;"></div>', 'Testimonials']
        ];

        // init the default config - empty placeholders
        var defaultConfig = {
            format: '[[%placeholder%]]',
            placeholders : []
        };

        // merge defaults with the passed in items
        var config = CKEDITOR.tools.extend(defaultConfig, editor.config.simplebox || {}, true);

        // run through an create the set of items to use
        for (var i = 0; i < config.placeholders.length; i++) {
            // get our potentially custom placeholder format
            var placeholder = config.format.replace('%placeholder%', config.placeholders[i]);
            placeholders.push([placeholder, config.placeholders[i], config.placeholders[i]]);
        }

        // add the menu to the editor
        editor.ui.addRichCombo('simplebox',
            {
                label: 		'Insert content',
                title: 		'Insert content',
                voiceLabel: 'Insert content',
                className: 	'cke_format',
                multiSelect:false,
                panel:
                    {
                        css: [ editor.config.contentsCss, CKEDITOR.skin.getPath('editor') ],
                        voiceLabel: editor.lang.panelVoiceLabel
                    },

                init: function()
                {
                    this.startGroup( "Insert content" );
                    for (var i in placeholders)
                    {
                        this.add(placeholders[i][0], placeholders[i][1], placeholders[i][2]);
                    }
                },

                onClick: function( value )
                {
                    editor.focus();
                    editor.fire( 'saveSnapshot' );
                    editor.insertHtml(value);
                    editor.fire( 'saveSnapshot' );
                }
            });
    },
} );