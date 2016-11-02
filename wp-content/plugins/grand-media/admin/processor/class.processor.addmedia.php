<?php

/**
 * GmediaProcessor_AddMedia
 */
class GmediaProcessor_AddMedia extends GmediaProcessor {

    private static $me = null;
    public $url;
    public $import = false;

    /**
     * GmediaProcessor_Library constructor.
     */
    public function __construct() {
        parent::__construct();

        global $gmCore;

        $this->import = $gmCore->_get('import', false, true);
        $this->url    = add_query_arg(array('import' => $this->import), $this->url);

    }

    protected function processor() {
        global $gmCore;

        if(!$gmCore->caps['gmedia_upload']) {
            wp_die(__('You are not allowed to be here', 'grand-media'));
        }

    }

    public static function getMe() {
        if ( self::$me == null ) {
            self::$me = new GmediaProcessor_AddMedia();
        }

        return self::$me;
    }
}

global $gmProcessorAddMedia;
$gmProcessorAddMedia = GmediaProcessor_AddMedia::getMe();
