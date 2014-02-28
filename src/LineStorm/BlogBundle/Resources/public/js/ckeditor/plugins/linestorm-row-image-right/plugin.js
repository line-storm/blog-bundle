CKEDITOR.plugins.add( 'linestorm-row-image-right', {
    requires: 'widget',

    icons: 'simplebox',

    init: function( editor ) {
        // Plugin logic goes here...
        editor.widgets.add( 'linestorm-row-image-right', {
            button: 'Create a row with a image box on the right',
            template:
                '<div class="simplebox">' +
                    '<h2 class="simplebox-title">Title</h2>' +
                    '<div class="simplebox-content"><p>Content...</p></div>' +
                    '</div>',
            editables: {
                title: {
                    selector: '.simplebox-title'
                },
                content: {
                    selector: '.simplebox-content'
                }
            },

            allowedContent:
                'div(!simplebox); div(!simplebox-content); h2(!simplebox-title)',

            requiredContent: 'div(simplebox)',

            upcast: function( element ) {
                return element.name == 'div' && element.hasClass( 'simplebox' );
            }
        } );
    }
} );
