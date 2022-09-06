$( function() {
    $( "#tabs" ).tabs();
    var reset_active_button = false;
    $( ".nav-link.most-viewed-post" ).click( function() {

        // 1. get current tab that just is clicked
        let tab = $( this );
        let new_tab = tab.data( 'tab' );

        // 2. reset active button (avoid to double active button)
    	active_button = $( ".nav-link.tabs-1.active" );
    	if ( active_button.data( 'tab' ) !== new_tab && reset_active_button === false ) {
    		active_button.removeClass( 'active' );
    		reset_active_button = true;
    	}

        // 3. toggle active state for 2 tabs
        let old_tab = localStorage.getItem( 'old_tab' );
        if ( old_tab !== new_tab ) {
            let tabClass = localStorage.getItem( 'old_tab' );
            $( "." + tabClass ).removeClass( 'active' );
        }

        // 4. save current tag to storage
        localStorage.setItem( 'old_tab', new_tab );

        // 5. active/deactive current tab
        tab.hasClass( 'active' ) ? tab.removeClass( 'active' ) : tab.addClass( 'active' );
    } );
} );
