<?php
class JuggerEventsRenaming {
    protected $params;

    public function __construct( array $options ) {
        $defaults = array (
            'replacements' => array (),
            'post_type'    => array ('jugger-event')
        );

        $this->params = array_merge_recursive( $defaults, $options );
        
        add_filter( 'gettext', array( $this, 'replace'), 20, 3 );
    }

//    function replace( $translated_text, $untranslated_text ) {
//        if ( in_array(get_post_type(), $this->params['post_type']) ) {
//            $translated_text = strtr( $untranslated_text, $this->params['replacements'] );
//        }
//        
//        return $translated_text;
//    }
    
//    function replace( $translated_text, $untranslated_text ) {
//        if ( in_array(get_post_type(), $this->params['post_type']) ) {
//            foreach ($this->params['replacements'] as $key => $value) {
//                if ($key == $untranslated_text) {
//                    return $value;
//                }
//            }
//        }
//
//        return $translated_text;
//    }
}