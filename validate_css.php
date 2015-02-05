<?php
    // $value needs to be your value BEFORE save.
    $css = $orig = $value;

    require_once( dirname( __FILE__ ) . '/csstidy/class.csstidy.php' );

    $csstidy = new csstidy();

    $warning = false; // Test if something was filtered out

    $csstidy->set_cfg( 'remove_bslash', false );
    $csstidy->set_cfg( 'compress_colors', false );
    $csstidy->set_cfg( 'compress_font-weight', false );
    $csstidy->set_cfg( 'optimise_shorthands', 0 );
    $csstidy->set_cfg( 'remove_last_;', false );
    $csstidy->set_cfg( 'case_properties', false );
    $csstidy->set_cfg( 'discard_invalid_properties', true );
    $csstidy->set_cfg( 'css_level', 'CSS3.0' );
    $csstidy->set_cfg( 'preserve_css', true );
    $csstidy->set_cfg( 'template', dirname( __FILE__ ) . '/csstidy/wordpress-standard.tpl' );

    $css = preg_replace( '/\\\\([0-9a-fA-F]{4})/', '\\\\\\\\$1', $prev = $css );

    if ( $css != $prev ) {
        $warning = true;
    }

    // Some people put weird stuff in their CSS, KSES tends to be greedy
    $css = str_replace( '<=', '&lt;=', $css );
    // Why KSES instead of strip_tags?  Who knows?
    $css = wp_kses_split( $prev = $css, array(), array() );
    $css = str_replace( '&gt;', '>', $css ); // kses replaces lone '>' with &gt;
    // Why both KSES and strip_tags?  Because we just added some '>'.
    $css = strip_tags( $css );

    if ( $css != $prev ) {
        $warning = true;
    }

    $csstidy->parse( $css );
    $this->value = $csstidy->print->plain();

    if ( isset( $warning ) && $warning ) {
        echo __( 'Unsafe strings were found in your CSS and have been filtered out.', 'redux-framework' );
    }
