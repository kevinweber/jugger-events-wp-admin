<?php
class JuggerEventsEditor {
    protected $params;

    public function __construct() {
        add_action( 'admin_head', array( $this, 'remove_media' ) );
        add_filter( 'wp_editor_settings', array( $this, 'remove_html_tab' ) );
        add_filter( 'tiny_mce_before_init', array( $this, 'slick_mce' ) );
    }

    function remove_html_tab($settings) {
        $settings['quicktags'] = false;
        return $settings;
    }

    function remove_media() {
        if( get_post_type() == 'jugger-event' ) {
            remove_action('media_buttons', 'media_buttons');
        }
    }
    
    function slick_mce( $settings ) {
        $settings['remove_linebreaks'] = true;
        $settings['paste_as_text'] = true;
        $settings['paste_text_sticky'] = true;
        $settings['paste_remove_styles'] = true;
        $settings['paste_remove_spans'] = true;
        $settings['paste_text_use_dialog'] = true;
        $settings['paste_strip_class_attributes'] = 'none';
        $settings['plugins'] = 'wordpress,wpautoresize,hr,lists,wplink,wptextpattern,wpview,paste,tabfocus,charmap';
        $settings['block_formats'] = "Paragraph=p; Heading 1=h2; Heading 2=h2";
        $settings['toolbar1'] = 'bold,italic,strikethrough,blockquote,bullist,numlist,link,unlink';//formatselect,underline
        $settings['toolbar2'] = '';

        return $settings;
    }
}