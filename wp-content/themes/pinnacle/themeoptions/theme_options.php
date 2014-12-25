<?php
define( 'LAYOUT_PATH', get_template_directory() . '/assets/css/skins/' );
define( 'OPTIONS_PATH', get_template_directory_uri() . '/themeoptions/options_assets/' );

// BEGIN Config

if ( !class_exists( "ReduxFramework" ) ) {
        return;
} 

if ( !class_exists( "Redux_Framework_pinnacle_config" ) ) {
        class Redux_Framework_pinnacle_config {
          public $args = array();
                public $sections = array();
                public $theme;
                public $ReduxFramework;

                public function __construct() {

                    if (!class_exists('ReduxFramework')) {
                        return;
                    }

                    // This is needed. Bah WordPress bugs.  ;)
                    if (  true == Redux_Helpers::isTheme(__FILE__) ) {
                        $this->initSettings();
                    } else {
                        add_action('plugins_loaded', array($this, 'initSettings'), 10);
                    }

                }
                public function initSettings() {

                load_theme_textdomain('pinnacle', get_template_directory() . '/languages');
                  // Create the sections and fields
                  $this->setSections();
                  // Set the default arguments
                  $this->setArguments();
                  //add_filter('redux/options/'.$this->args['opt_name'].'/compiler', array( $this, 'compiler_action' ), 10, 2);
                  $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
                }
                /*function compiler_action($options, $css) {                  
                    // Demo of how to use the dynamic CSS and write your own static CSS file
                    $filename = dirname(__FILE__) . '/themeoptions' . '.css';
                    global $wp_filesystem;
                    if( empty( $wp_filesystem ) ) {
                      require_once( ABSPATH .'/wp-admin/includes/file.php' );
                    WP_Filesystem();
                    }

                    if( $wp_filesystem ) {
                      $wp_filesystem->put_contents(
                          $filename,
                          $css,
                          FS_CHMOD_FILE // predefined mode settings for WP files
                      );
                    }
                   
              } */

                public function setSections() {
                 

$alt_stylesheet_path = LAYOUT_PATH;
$alt_stylesheets = array(); 
if ( is_dir($alt_stylesheet_path) ) {if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) {while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) {if(stristr($alt_stylesheet_file, ".css") !== false) {$alt_stylesheets[$alt_stylesheet_file] = $alt_stylesheet_file;}}}}

$this->sections[] = array(
    'title' => __('Site Header', 'pinnacle'),
    'header' => '',
    'desc' => "<div class='redux-info-field'><h3>".__('Welcome to Pinnacle Theme Options', 'pinnacle')."</h3>
                                    <p>".__('This theme was developed by', 'pinnacle')." <a href=\"http://kadencethemes.com/\" target=\"_blank\">Kadence Themes</a></p>
                                    <p>".__('For theme documentation visit', 'pinnacle').": <a href=\"http://docs.kadencethemes.com/pinnacle/\" target=\"_blank\">docs.kadencethemes.com/pinnacle/</a>
                                    <br />
                                    ".__('For support please visit', 'pinnacle').": <a href=\"http://wordpress.org/support/\" target=\"_blank\">http://wordpress.org/support/</a></p></div>",
    'icon_class' => 'icon-large',
    'icon' => 'icon-desktop',
    'fields' => array(
         array(
            'id'=>'header_height',
            'type' => 'slider', 
            'title' => __('Header Height', 'pinnacle'),
            "default"       => "120",
            "min"       => "30",
            "step"      => "2",
            "max"       => "400",
            ),
        array(
            'id'=>'transparentheader',
            'type' => 'info',
            'desc' => __('Transparent Header', 'pinnacle'),
            ),
        array(
            'id'=>'pagetitle_intoheader',
            'type' => 'switch', 
            'title' => __('Enable Transparent header?', 'pinnacle'),
            'subtitle'=> __('This will make the page header background fill to the top of the page.', 'pinnacle'),
            "default" => 1,
            ),
        array(
            'id'=>'th_header_menu_color',
            'type' => 'color',
            'title' => __('Menu Text Color (For Transparent Header)', 'pinnacle'), 
            'subtitle' => __('Choose the font color of the menu font while background is transparent', 'pinnacle'),
            'transparent'=>false,
            'default' => '#ffffff',
            'validate' => 'color',
            'output'    => array('.kad-primary-nav ul.sf-menu a', '.nav-trigger-case.collapsed .kad-navbtn'),
            'customizer' => true,
            ),
        array(
            'id'=>'th_header_border_color',
            'type' => 'color',
            'title' => __('Border Color (For Transparent Header)', 'pinnacle'), 
            'subtitle' => __('Choose the color of bottom border while background is transparent', 'pinnacle'),
            'transparent'=>true,
            'default' => '',
            'output'    => array('border-color' => '.headerclass'),
            'validate' => 'color',
            'customizer' => true,
            ),
        array(
            'id'=>'th_header_logo_color',
            'type' => 'color',
            'title' => __('Site title font Color (For Transparent Header)', 'pinnacle'), 
            'subtitle' => __('Choose the font color for the logo while background is transparent', 'pinnacle'),
            'transparent'=>false,
            'validate' => 'color',
            'default' => '#ffffff',
            'output'    => array('.sticky-wrapper #logo a.brand, .trans-header #logo a.brand'),
            'customizer' => true,
            ),
        array(
            'id'=>'th_x1_logo_upload',
            'type' => 'media', 
            'url'=> true,
            'title' => __('Logo (For Transparent Header)', 'pinnacle'),
            'subtitle' => __('Upload your Logo.', 'pinnacle'),
            ),
        array(
            'id'=>'th_x2_logo_upload',
            'type' => 'media', 
            'url'=> true,
            'title' => __('@2x Logo (For Transparent Header) ', 'pinnacle'),
            'subtitle' => __('Should be twice the pixel size of your normal logo.', 'pinnacle'),
            ),
         ),
      );
    $this->sections[] = array(
          'icon' => 'icon-trophy',
          'icon_class' => 'icon-large',
          'title' => __('Logo Options', 'pinnacle'),
          'fields' => array(
          array(
            'id'=>'logo_container_width',
            'type' => 'select',
            'title' => __('Logo Container Width', 'pinnacle'), 
            'options' => array('16' => __('16%', 'pinnacle'),'25' => __('25%', 'pinnacle'), '33' => __('33%', 'pinnacle'),'41' => __('41%', 'pinnacle'), '50' => __('50%', 'pinnacle')),
            'default' => '33',
            'width' => 'width:60%',
            ),
        array(
            'id'=>'x1_logo_upload',
            'type' => 'media', 
            'url'=> true,
            'title' => __('Logo', 'pinnacle'),
            'subtitle' => __('Upload your Logo. If left blank theme will use site name.', 'pinnacle'),
            ),
        array(
            'id'=>'x2_logo_upload',
            'type' => 'media', 
            'url'=> true,
            'title' => __('Upload Your @2x Logo for Retina Screens', 'pinnacle'),
            'subtitle' => __('Should be twice the pixel size of your normal logo.', 'pinnacle'),
            ),
        array(
            'id'=>'font_logo_style',
            'type' => 'typography', 
            'title' => __('Sitename Logo Font', 'pinnacle'),
            //'compiler'=>true, // Use if you want to hook in your own CSS compiler
            'font-family'=>true, 
            'google'=>true, // Disable google fonts. Won't work if you haven't defined your google api key
            'font-backup'=>false, // Select a backup non-google font in addition to a google font
            'font-style'=>true, // Includes font-style and weight. Can use font-style or font-weight to declare
            'subsets'=>true, // Only appears if google is true and subsets not set to false
            'font-size'=>true,
            'line-height'=>false,
            'text-align' => false,
            'color'=>true,
            'preview'=>true,
            'output' => array('.is-sticky header #logo a.brand', '.logofont', '.none-trans-header header #logo a.brand','header #logo a.brand'),
            'subtitle'=> __("Choose size and style your sitename, if you don't use an image logo.", 'pinnacle'),
            'default'=> array(
                'font-family'=>'Raleway',
                'color'=>"#444444", 
                'font-style'=>'400',
                'font-size'=>'32px',  ),
            ),
        ),
);
$this->sections[] = array(
    'icon' => 'icon-pencil',
    'icon_class' => 'icon-large',
    'title' => __('Page Title', 'pinnacle'),
    'fields' => array(
    array(
            'id'=>'default_showpagetitle',
            'type' => 'switch', 
            'title' => __('Show the page title by default', 'pinnacle'),
            'subtitle'=> __('This can be overridden on each page.', 'pinnacle'),
            "default" => 1,
    ),
    array(
        'id'        => 'pageheader_background',
        'type'      => 'background',
        'output'    => array('.titleclass'),
        'title'     => __('Page Header Default Background', 'pinnacle'),
        ),
    array(
            'id'=>'pagetitle_color',
            'type' => 'color',
            'title' => __('Page Title Color', 'pinnacle'), 
            'subtitle' => __('Choose the default pagetitle color for your site.', 'pinnacle'),
            'transparent'=>false,
            'validate' => 'color',
            'default' => '#ffffff',
            'output'    => array('.titleclass h1'),
            'customizer' => true,
            ),
    array(
            'id'=>'pagesubtitle_color',
            'type' => 'color',
            'title' => __('Page Subtitle Color', 'pinnacle'), 
            'subtitle' => __('Choose the default subtitle color for your site.', 'pinnacle'),
            'transparent'=>false,
            'validate' => 'color',
            'default' => '#ffffff',
            'output'    => array('.titleclass .subtitle'),
            'customizer' => true,
            ),
    array(
            'id'=>'pagetitle_align',
            'type' => 'select',
            'title' => __('Page Title Align', 'pinnacle'), 
            'options' => array('center' => __('Center', 'pinnacle'),'left' => __('Left', 'pinnacle'), 'right' => __('Right', 'pinnacle')),
            'default' => 'center',
            'width' => 'width:60%',
            ),
    ),
);
$this->sections[] = array(
    'icon' => 'icon-laptop',
    'icon_class' => 'icon-large',
    'title' => __('Footer Layout', 'pinnacle'),
    'fields' => array(
        array(
                'id'=>'footer_layout',
                'type' => 'image_select',
                'title' => __('Footer Widget Layout', 'pinnacle'), 
                'subtitle' => __('Select how many columns for footer widgets', 'pinnacle'),
                'options' => array(
                        'fourc' => array('alt' => 'Four Column Layout', 'img' => OPTIONS_PATH.'img/footer-widgets-4.png'),
                        'threec' => array('alt' => 'Three Column Layout', 'img' => OPTIONS_PATH.'img/footer-widgets-3.png'),
                        'twoc' => array('alt' => 'Two Column Layout', 'img' => OPTIONS_PATH.'img/footer-widgets-2.png'),
                    ),
                'default' => 'fourc',
        ),
    ),
);
$this->sections[] = array(
    'icon' => 'icon-list-alt',
    'icon_class' => 'icon-large',
    'title' => __('Topbar Settings', 'pinnacle'),
    'fields' => array(
        array(
            'id'=>'topbar',
            'type' => 'switch', 
            'title' => __('Use Topbar?', 'pinnacle'),
            'subtitle'=> __('Choose to show or hide topbar', 'pinnacle'),
            "default"       => 0,
            ),
        array(
            'id'=>'topbar_height',
            'type' => 'slider', 
            'title' => __('Topbar Height', 'pinnacle'),
            "default"       => "30",
            "min"       => "4",
            "step"      => "2",
            "max"       => "100",
            ),
        array(
            'id'=>'topbar_mobile_hide',
            'type' => 'switch', 
            'title' => __('Hide on mobile?', 'pinnacle'),
            'subtitle'=> __('Choose to show or hide topbar on mobile', 'pinnacle'),
            "default"       => 1,
            ),
        array(
            'id'=>'topbar_icons',
            'type' => 'switch', 
            'title' => __('Use Topbar Icon Menu?', 'pinnacle'),
            'subtitle'=> __('Choose to show or hide topbar icon Menu', 'pinnacle'),
            "default"       => 0,
            ),
        array(
            'id'=>'topbar_icon_menu',
            'type' => 'kad_icons',
            'title' => __('Topbar Icon Menu', 'pinnacle'),
            'subtitle'=> __('Choose your icons for the topbar icon menu.', 'pinnacle'),
        ),
         array(
            'id'=>'topbar_iconmenu_fontsize',
            'type' => 'slider', 
            'title' => __('Icon menu font size', 'pinnacle'),
            "default"       => "14",
            "min"       => "8",
            "step"      => "1",
            "max"       => "36",
            ),
        array(
            'id'=>'show_cartcount',
            'type' => 'switch', 
            'title' => __('Show Cart total in topbar?', 'pinnacle'),
            'subtitle'=> __('This only works if using woocommerce', 'pinnacle'),
            "default"       => 1,
            ), 
        array(
            'id'=>'topbar_search',
            'type' => 'switch', 
            'title' => __('Display Search in Topbar?', 'pinnacle'),
            'subtitle'=> __('Choose to show or hide search in topbar', 'pinnacle'),
            "default"       => 1,
            ),
        array(
            'id'=>'topbar_widget',
            'type' => 'switch', 
            'title' => __('Enable widget area in left of Topbar?', 'pinnacle'),
            "default"       => 0,
            ),
        array(
            'id'=>'topbar_layout',
            'type' => 'switch', 
            'title' => __('Topbar Layout Switch', 'pinnacle'),
            'subtitle'=> __('This moves the left items to the right and right items to the left.', 'pinnacle'),
            "default"       => 0,
            ),
        ),
);
$this->sections[] = array(
    'icon' => 'icon-picture',
    'icon_class' => 'icon-large',
    'title' => __('Home Slider', 'pinnacle'),
    'desc' => "<div class='redux-info-field'><h3>".__('Home Page Slider Options', 'pinnacle')."</h3></div>",
    'fields' => array(
        array(
            'id'=>'choose_home_header',
            'type' => 'select',
            'title' => __('Choose a Home Image Slider', 'pinnacle'), 
            'subtitle' => __("If you don't want an image slider on your home page choose none.", 'pinnacle'),
            'options' => array('none' => __('None', 'pinnacle'),'pagetitle' => __('Page Title', 'pinnacle'),'flex' => __('Flex Slider', 'pinnacle'),'carousel' => __('Carousel Slider', 'pinnacle'),'latest' => __('Latest Posts', 'pinnacle'), 'video' => __('Video', 'pinnacle')),
            'default' => 'pagetitle',
            'width' => 'width:60%',
            ),
        array(
            'id'=>'hs_behindheader',
            'type' => 'switch', 
            'title' => __('Place behind Header', 'pinnacle'),
            'subtitle'=> __('This enabled the transparent header on the home page.', 'pinnacle'),
            "default" => 1,
            'required' => array('choose_home_header','=','pagetitle'), 
            ),
        array(
            'id'=>'home_page_title',
            'type' => 'textarea',
            'title' => __('Home Page Title', 'pinnacle'), 
            'validate' => 'html',
            'default' => 'Welcome to [site-name]',
            'required' => array('choose_home_header','=','pagetitle'), 
            ),
        array(
            'id'=>'home_page_sub_title',
            'type' => 'textarea',
            'title' => __('Home Page SubTitle', 'pinnacle'), 
            'subtitle' => __('optional text below home page title', 'pinnacle'),
            'validate' => 'html',
            'default' => '[site-tagline]',
            'required' => array('choose_home_header','=','pagetitle'), 
            ),
        array(
            'id'=>'home_page_title_ptop',
            'type' => 'slider', 
            'title' => __('Home Page Title Padding Top', 'pinnacle'),
            "default"       => "110",
            "min"       => "5",
            "step"      => "5",
            "max"       => "300",
            'required' => array('choose_home_header','=','pagetitle'), 
            ), 
        array(
            'id'=>'home_page_title_pbottom',
            'type' => 'slider', 
            'title' => __('Home Page Title Padding Bottom', 'pinnacle'),
            "default"       => "110",
            "min"       => "5",
            "step"      => "5",
            "max"       => "300",
            'required' => array('choose_home_header','=','pagetitle'), 
            ), 
        array(
            'id'        => 'home_pagetitle_background',
            'type'      => 'background',
            'required' => array('choose_home_header','=','pagetitle'), 
        ),
        array(
            'id'=>'home_slider',
            'type' => 'kad_slides',
            'title' => __('Slider Images', 'pinnacle'),
            'subtitle'=> __('Use large images for best results.', 'pinnacle'),
            'required' => array('choose_home_header','=',array('flex','carousel','imgcarousel')),
        ),  
        array(
            'id'=>'slider_size',
            'type' => 'slider', 
            'title' => __('Slider Max Height', 'pinnacle'),
            'subtitle' => __('Note: does not work if images are smaller than max.', 'pinnacle'),
            "default"       => "500",
            "min"       => "100",
            "step"      => "5",
            "max"       => "1000",
            'required' => array('choose_home_header','=',array('flex','carousel','imgcarousel','latest')),
            ), 
        array(
            'id'=>'slider_size_width',
            'type' => 'slider', 
            'title' => __('Slider Max Width', 'pinnacle'),
            'subtitle' => __('Note: does not work if images are smaller than max.', 'pinnacle'),
            "default"       => "1140",
            "min"       => "600",
            "step"      => "5",
            "max"       => "1140",
            'required' => array('choose_home_header','=',array('flex','carousel','latest')),
            ), 
        array(
            'id'=>'slider_autoplay',
            'type' => 'switch', 
            'title' => __('Auto Play?', 'pinnacle'),
            'subtitle'=> __('This determines if a slider automatically scrolls', 'pinnacle'),
            "default"       => 1,
            'required' => array('choose_home_header','=',array('flex','carousel','imgcarousel','latest')),
            ),
        array(
            'id'=>'slider_pausetime',
            'type' => 'slider', 
            'title' => __('Slider Pause Time', 'pinnacle'),
            'subtitle' => __('How long to pause on each slide, in milliseconds.', 'pinnacle'),
            "default"       => "7000",
            "min"       => "3000",
            "step"      => "1000",
            "max"       => "12000",
            'required' => array('choose_home_header','=',array('flex','carousel','imgcarousel','latest')),
            ), 
        array(
            'id'=>'trans_type',
            'type' => 'select',
            'title' => __('Transition Type', 'pinnacle'), 
            'subtitle' => __("Choose a transition type", 'pinnacle'),
            'options' => array('fade' => __('Fade', 'pinnacle'),'slide' => __('Slide', 'pinnacle')),
            'default' => 'fade',
            'required' => array('choose_home_header','=',array('flex','latest')),
            ),
        array(
            'id'=>'slider_transtime',
            'type' => 'slider', 
            'title' => __('Slider Transition Time', 'pinnacle'),
            'subtitle' => __('How long for slide transitions, in milliseconds.', 'pinnacle'),
            "default"       => "600",
            "min"       => "200",
            "step"      => "100",
            "max"       => "1200",
            'required' => array('choose_home_header','=',array('flex','carousel','imgcarousel','latest')),
            ), 
        array(
            'id'=>'slider_captions',
            'type' => 'switch', 
            'title' => __('Show Captions?', 'pinnacle'),
            'subtitle'=> __('Choose to show or hide captions', 'pinnacle'),
            "default"       => 0,
            'required' => array('choose_home_header','=',array('flex','carousel')),
            ),
        array(
            'id'=>'video_embed',
            'type' => 'textarea',
            'title' => __('Video Embed Code', 'pinnacle'), 
            'subtitle' => __('If your using a video on the home page place video embed code here.', 'pinnacle'),
            'default' => '',
            'required' => array('choose_home_header','=','video'),
            ),
         ),
);

$this->sections[] = array(
    'icon' => 'icon-tablet',
    'icon_class' => 'icon-large',
    'title' => __('Home Mobile Slider', 'pinnacle'),
    'desc' => "<div class='redux-info-field'><h3>".__('Create a more lightweight home slider for your mobile visitors.', 'pinnacle')."</h3></div>",
    'fields' => array(
      array(
            'id'=>'mobile_switch',
            'type' => 'switch', 
            'title' => __('Would you like to use this feature?', 'pinnacle'),
            'subtitle'=> __('Choose if you would like to show a different slider on your home page for your mobile visitors.', 'pinnacle'),
            "default"       => 0,
            ),
        array(
            'id'=>'choose_mobile_slider',
            'type' => 'select',
            'title' => __('Choose a Slider for Mobile', 'pinnacle'), 
            'subtitle' => __("Choose which slider you would like to show for mobile viewers.", 'pinnacle'),
            'options' => array('none' => __('None', 'pinnacle'),'flex' => __('Flex Slider', 'pinnacle'), 'carousel' => __('Carousel Slider', 'pinnacle'), 'pagetitle' => __('Page Title', 'pinnacle'), 'video' => __('Video', 'pinnacle')),
            'default' => 'none',
            'width' => 'width:60%',
            'required' => array('mobile_switch','=','1'),
            ),
        array(
            'id'=>'m_home_page_title',
            'type' => 'textarea',
            'title' => __('Home Page Title', 'pinnacle'), 
            'validate' => 'html',
            'default' => 'Welcome to [site-name]',
            'required' => array('choose_mobile_slider','=','pagetitle'), 
            ),
        array(
            'id'=>'m_home_page_sub_title',
            'type' => 'textarea',
            'title' => __('Home Page SubTitle', 'pinnacle'), 
            'subtitle' => __('optional text below home page title', 'pinnacle'),
            'validate' => 'html',
            'default' => '[site-tagline]',
            'required' => array('choose_mobile_slider','=','pagetitle'), 
            ),
        array(
            'id'=>'m_home_page_title_ptop',
            'type' => 'slider', 
            'title' => __('Home Page Title Padding Top', 'pinnacle'),
            "default"       => "35",
            "min"       => "5",
            "step"      => "5",
            "max"       => "200",
            'required' => array('choose_mobile_slider','=','pagetitle'), 
            ), 
        array(
            'id'=>'m_home_page_title_pbottom',
            'type' => 'slider', 
            'title' => __('Home Page Title Padding Bottom', 'pinnacle'),
            "default"       => "35",
            "min"       => "5",
            "step"      => "5",
            "max"       => "200",
            'required' => array('choose_mobile_slider','=','pagetitle'), 
            ), 
        array(
            'id'        => 'm_home_pagetitle_background',
            'type'      => 'background',
            'output'    => array('.home_titleclass'),
            'required' => array('choose_mobile_slider','=','pagetitle'), 
        ),
        array(
            'id'=>'home_mobile_slider',
            'type' => 'kad_slides',
            'title' => __('Slider Images', 'pinnacle'),
            'subtitle'=> __('Use large images for best results.', 'pinnacle'),
            'required' => array('choose_mobile_header','=',array('flex','carousel','imgcarousel','latest')),
        ),  
        array(
            'id'=>'mobile_slider_size',
            'type' => 'slider', 
            'title' => __('Slider Max Height', 'pinnacle'),
            'subtitle' => __('Note: does not work if images are smaller than max.', 'pinnacle'),
            "default"       => "300",
            "min"       => "100",
            "step"      => "5",
            "max"       => "800",
            'required' => array('choose_mobile_header','=',array('flex','carousel','imgcarousel','latest')),
            ), 
        array(
            'id'=>'mobile_slider_size_width',
            'type' => 'slider', 
            'title' => __('Slider Max Width', 'pinnacle'),
            'subtitle' => __('Note: does not work if images are smaller than max.', 'pinnacle'),
            "default"       => "480",
            "min"       => "200",
            "step"      => "5",
            "max"       => "800",
            'required' => array('choose_mobile_header','=',array('flex','carousel','imgcarousel','latest')),
            ), 
        array(
            'id'=>'mobile_slider_autoplay',
            'type' => 'switch', 
            'title' => __('Auto Play?', 'pinnacle'),
            'subtitle'=> __('This determines if a slider automatically scrolls', 'pinnacle'),
            "default"       => 1,
            'required' => array('choose_mobile_header','=',array('flex','carousel','imgcarousel','latest')),
            ),
        array(
            'id'=>'mobile_slider_pausetime',
            'type' => 'slider', 
            'title' => __('Slider Pause Time', 'pinnacle'),
            'subtitle' => __('How long to pause on each slide, in milliseconds.', 'pinnacle'),
            "default"       => "7000",
            "min"       => "3000",
            "step"      => "1000",
            "max"       => "12000",
            'required' => array('choose_mobile_header','=',array('flex','carousel','imgcarousel','latest')),
            ), 
        array(
            'id'=>'mobile_trans_type',
            'type' => 'select',
            'title' => __('Transition Type', 'pinnacle'), 
            'subtitle' => __("Choose a transition type", 'pinnacle'),
            'options' => array('fade' => __('Fade', 'pinnacle'),'slide' => __('Slide', 'pinnacle')),
            'default' => 'fade',
            'required' => array('choose_mobile_header','=',array('flex','carousel','imgcarousel','latest')),
            ),
        array(
            'id'=>'mobile_slider_transtime',
            'type' => 'slider', 
            'title' => __('Slider Transition Time', 'pinnacle'),
            'subtitle' => __('How long for slide transitions, in milliseconds.', 'pinnacle'),
            "default"       => "600",
            "min"       => "200",
            "step"      => "100",
            "max"       => "1200",
            'required' => array('choose_mobile_header','=',array('flex','carousel','imgcarousel','latest')),
            ), 
        array(
            'id'=>'mobile_slider_captions',
            'type' => 'switch', 
            'title' => __('Show Captions?', 'pinnacle'),
            'subtitle'=> __('Choose to show or hide captions', 'pinnacle'),
            "default"       => 0,
            'required' => array('choose_mobile_header','=',array('flex','carousel','imgcarousel','latest')),
            ),
        array(
            'id'=>'mobile_video_embed',
            'type' => 'textarea',
            'title' => __('Video Embed Code', 'pinnacle'), 
            'subtitle' => __('If your using a video on the home page place video embed code here.', 'pinnacle'),
            'default' => '',
            'required' => array('choose_mobile_header','=','video'),
            ),
         ),
);
$this->sections[] = array(
    'icon' => 'icon-home',
    'icon_class' => 'icon-large',
    'title' => __('Home Layout', 'pinnacle'),
    'desc' => "",
    'fields' => array(
       array(
            'id'=>'home_sidebar_layout',
            'type' => 'image_select',
            'compiler'=> false,
            'title' => __('Display a sidebar on the Home Page?', 'pinnacle'), 
            'subtitle' => __('This determines if there is a sidebar on the home page.', 'pinnacle'),
            'options' => array(
                    'full' => array('alt' => 'Full Layout', 'img' => OPTIONS_PATH .'img/1col.png'),
                    'sidebar' => array('alt' => 'Sidebar Layout', 'img' => OPTIONS_PATH .'img/2cr.png'),
                ),
            'default' => 'full',
            ),
       array(
            'id'=>'home_sidebar',
            'type' => 'select',
            'title' => __('Choose a Sidebar for your Home Page', 'pinnacle'), 
            'data' => 'sidebars',
            'default' => 'sidebar-primary',
            'width' => 'width:60%',
            ),
       array(
            "id" => "homepage_layout",
            "type" => "sorter",
            "title" => __("Homepage Layout Manager", 'pinnacle'),
            "subtitle" => __("Organize how you want the layout to appear on the homepage", 'pinnacle'),  
            'options' => array(
              "disabled" => array(
                    "placebo" => "placebo", //REQUIRED!
                    "block_six"   => __("Portfolio Carousel", 'pinnacle'),
                    "block_seven" => __("Icon Menu", 'pinnacle'),
                    "block_one"   => __("Call to Action", 'pinnacle'),
                    "block_four"  => __("Page Content", 'pinnacle'),
                ),
                "enabled" => array(
                    "placebo" => "placebo", //REQUIRED!
                    "block_five"  => __("Latest Blog Posts", 'pinnacle'),
                ),
            ),
        ),
         array(
            'id'=>'info_blog_settings',
            'type' => 'info',
            'desc' => __('Home Blog Settings', 'pinnacle'),
            ),
         array(
            'id'=>'blog_title',
            'type' => 'text',
            'title' => __('Home Blog Title', 'pinnacle'),
            'subtitle' => __('e.g. = Latest from the blog', 'pinnacle'),
            ),
         array(
            'id'=>'home_post_count',
            'type' => 'slider', 
            'title' => __('Choose How many posts on Homepage', 'pinnacle'),
            "default"       => "6",
            "min"       => "2",
            "step"      => "1",
            "max"       => "18",
            ),
         array(
            'id'=>'home_post_column',
            'type' => 'slider', 
            'title' => __('Choose how many post columns on Homepage', 'pinnacle'),
            "default"       => "3",
            "min"       => "2",
            "step"      => "1",
            "max"       => "4",
            ),
         array(
            'id'=>'home_post_type',
            'type' => 'select',
            'data' => 'categories',
            'title' => __('Limit posts to a Category', 'pinnacle'), 
            'subtitle' => __('Leave blank to select all', 'pinnacle'),
            'width' => 'width:60%',
            ),
         array(
            'id'=>'info_portfolio_settings',
            'type' => 'info',
            'desc' => __('Home Portfolio Carousel Settings', 'pinnacle'),
            ),
         array(
            'id'=>'portfolio_title',
            'type' => 'text',
            'title' => __('Home Portfolio Carousel title', 'pinnacle'),
            'subtitle' => __('e.g. = Portfolio Carousel title', 'pinnacle'),
            ),
         array(
            'id'=>'portfolio_type',
            'type' => 'select',
            'data' => 'terms',
            'args' => array('taxonomies'=>'portfolio-type', 'args'=>array()),
            'title' => __('Portfolio Carousel Category Type', 'pinnacle'), 
            'subtitle' => __('Leave blank to select all types', 'pinnacle'),
            'width' => 'width:60%',
            ),
         array(
            'id'=>'home_portfolio_carousel_column',
            'type' => 'slider', 
            'title' => __('Choose how many columns are in carousel', 'pinnacle'),
            "default"       => "3",
            "min"       => "2",
            "step"      => "1",
            "max"       => "6",
            ),
         array(
            'id'=>'home_port_car_layoutstyle',
            'type' => 'select',
            'title' => __('Portfolio Layout Style', 'pinnacle'), 
            'options' => array('default' => __('Default', 'pinnacle'),'padded_style' => __('Post Boxes', 'pinnacle'), 'flat-w-margin' => __('Flat with Margin', 'pinnacle')),
            'default' => 'default',
            'width' => 'width:60%',
            ),
           array(
            'id'=>'home_port_car_hoverstyle',
            'type' => 'select',
            'title' => __('Portfolio Hover Style', 'pinnacle'), 
            'options' => array('default' => __('Default', 'pinnacle'),'p_lightstyle' => __('Light', 'pinnacle'), 'p_darkstyle' => __('Dark', 'pinnacle'), 'p_primarystyle' => __('Primary Color', 'pinnacle')),
            'default' => 'default',
            'width' => 'width:60%',
            ),
           array(
            'id'=>'home_port_car_imageratio',
            'type' => 'select',
            'title' => __('Portfolio Image Ratio', 'pinnacle'), 
            'options' => array('default' => __('Default', 'pinnacle'),'square' => __('Square 1:1', 'pinnacle'), 'portrait' => __('Portrait 3:4', 'pinnacle'), 'landscape' => __('Landscape 4:3', 'pinnacle'), 'widelandscape' => __('Wide Landscape 4:2', 'pinnacle')),
            'default' => 'default',
            'width' => 'width:60%',
            ),
         array(
            'id'=>'home_portfolio_carousel_count',
            'type' => 'slider', 
            'title' => __('Choose how many portfolio items are in carousel', 'pinnacle'),
            "default"       => "6",
            "min"       => "4",
            "step"      => "1",
            "max"       => "18",
            ),
         array(
            'id'=>'home_portfolio_carousel_speed',
            'type' => 'slider', 
            'title' => __('Choose the carousel speed (in seconds).', 'pinnacle'),
            "default"       => "9",
            "min"       => "2",
            "step"      => "1",
            "max"       => "12",
            ),
         array(
            'id'=>'home_portfolio_carousel_scroll',
            'type' => 'select',
            'title' => __('Portfolio Carousel Scroll', 'pinnacle'), 
            'subtitle' => __("Choose how the portfolio items scroll.", 'pinnacle'),
            'options' => array('oneitem' => __('One Item', 'pinnacle'), 'all' => __('All Visible', 'pinnacle')),
            'default' => 'oneitem',
            'width' => 'width:60%',
            ),
         array(
            'id'=>'home_portfolio_order',
            'type' => 'select',
            'title' => __('Portfolio Carousel Order by', 'pinnacle'), 
            'subtitle' => __("Choose how the portfolio items should be ordered in the carousel.", 'pinnacle'),
            'options' => array('menu_order' => __('Menu Order', 'pinnacle'),'title' => __('Title', 'pinnacle'),'date' => __('Date', 'pinnacle'),'rand' => __('Random', 'pinnacle')),
            'default' => 'menu_order',
            'width' => 'width:60%',
            ),
           array(
            'id'=>'portfolio_car_lightbox',
            'type' => 'switch', 
            'title' => __('Display lightbox link in portfolio item?', 'pinnacle'),
            "default"       => 0,
            ),
           array(
            'id'=>'portfolio_show_type',
            'type' => 'switch', 
            'title' => __('Display Portfolio Types under Title', 'pinnacle'),
            "default" => 1,
            ),
           array(
            'id'=>'portfolio_show_excerpt',
            'type' => 'switch', 
            'title' => __('Display Portfolio excerpt under Title', 'pinnacle'),
            "default" => 0,
            ),
           array(
            'id'=>'info_iconmenu_settings',
            'type' => 'info',
            'desc' => __('Home Icon Menu', 'pinnacle'),
            ),
           array(
            'id'=>'icon_menu',
            'type' => 'kad_icons',
            'title' => __('Icon Menu', 'pinnacle'),
            'subtitle'=> __('Choose your icons for the icon menu.', 'pinnacle'),
        ), 
            array(
            'id'=>'home_icon_menu_column',
            'type' => 'slider', 
            'title' => __('Choose how many columns in each row', 'pinnacle'),
            "default"       => "3",
            "min"       => "2",
            "step"      => "1",
            "max"       => "6",
            ),
            array(
            'id'=>'home_icon_menu_btn',
            'type' => 'text',
            'title' => __('Icon menu button text (optional)', 'pinnacle'),
            'subtitle' => __('e.g. = Read More', 'pinnacle'),
            ),
            array(
            'id'=>'icon_font_color',
            'type' => 'color',
            'title' => __('Icon Color', 'pinnacle'), 
            'subtitle' => __('Choose the color for icon.', 'pinnacle'),
            'default' => '',
            'transparent'=>false,
            'output' => array('color' => '.home-iconmenu .home-icon-item i'),
            'validate' => 'color',
            ),
           array(
            'id'=>'icon_bg_color',
            'type' => 'color',
            'title' => __('Icon Background Color', 'pinnacle'), 
            'subtitle' => __('Choose the background color for icon. * Note the hover color is set by your primary color in basic styling.', 'pinnacle'),
            'default' => '',
            'validate' => 'color',
            'output' => array('background-color' => '.home-iconmenu .home-icon-item i'),
            ),
           array(
            'id'=>'icon_text_font_color',
            'type' => 'color',
            'title' => __('Title and Description Font Color', 'pinnacle'), 
            'subtitle' => __('Choose the color for icon menu title and description Font.', 'pinnacle'),
            'default' => '',
            'transparent'=>false,
            'validate' => 'color',
            'output' => array('color' => '.home-iconmenu .home-icon-item h4, .home-iconmenu .home-icon-item p ', 'background-color' => '.home-iconmenu .home-icon-item h4:after'),
            ),
            array(
            'id'=>'info_calltoaction_home_settings',
            'type' => 'info',
            'desc' => __('Home Call To Action Settings', 'pinnacle'),
            ),
            array(
            'id'=>'home_action_text',
            'type' => 'text',
            'title' => __('Call to Action Text', 'pinnacle'),
            ),
            array(
            'id'=>'home_action_color',
            'type' => 'color',
            'title' => __('Call to Action Text Color', 'pinnacle'), 
            'default' => '',
            'validate' => 'color',
            'transparent'=>false,
            'output' => array('color' => '.kad-call-title-case h1.kad-call-title'),
            ),
             array(
            'id'=>'home_action_text_btn',
            'type' => 'text',
            'title' => __('Call to Action Button Text', 'pinnacle'),
            'subtitle' => __('e.g. = Read More', 'pinnacle'),
            ),
             array(
            'id'=>'home_action_link',
            'type' => 'text',
            'title' => __('Call to Action Button Link', 'pinnacle'),
            ),
             array(
            'id'=>'home_action_btn_color',
            'type' => 'color',
            'title' => __('Button Text Color', 'pinnacle'), 
            'default' => '',
            'validate' => 'color',
            'transparent'=>false,
            'output' => array('color' => '.kad-call-button-case a.kad-btn-primary'),
            ),
            array(
            'id'=>'home_action_bg_color',
            'type' => 'color',
            'title' => __('Button Background Color', 'pinnacle'), 
            'default' => '',
            'validate' => 'color',
            'output' => array('background-color' => '.kad-call-button-case a.kad-btn-primary'),
            ),
             array(
            'id'=>'home_action_btn_color_hover',
            'type' => 'color',
            'title' => __('Button Hover Text Color', 'pinnacle'), 
            'default' => '',
            'validate' => 'color',
            'transparent'=>false,
            'output' => array('color' => '.kad-call-button-case a.kad-btn-primary:hover'),
            ),
            array(
            'id'=>'home_action_bg_color_hover',
            'type' => 'color',
            'title' => __('Button Hover Background Color', 'pinnacle'), 
            'default' => '',
            'validate' => 'color',
            'output' => array('background-color' => '.kad-call-button-case a.kad-btn-primary:hover'),
            ),
            array(
            'id'=>'home_action_padding',
            'type' => 'slider', 
            'title' => __('Call to action top and bottom padding.', 'pinnacle'),
            "default"       => "20",
            "min"       => "4",
            "step"      => "2",
            "max"       => "180",
            ),
             array(
                'id'        => 'home_action_background',
                'type'      => 'background',
                'output'    => array('.kt-home-call-to-action'),
                'title'     => __('Call to action background', 'pinnacle'),
                ),
           array(
            'id'=>'info_page_content',
            'type' => 'info',
            'desc' => __('Page Content Options (if home page is latest post page)', 'pinnacle'),
            ),
           array(
            'id'=>'home_post_summery',
            'type' => 'select',
            'title' => __('Latest Post Display', 'pinnacle'), 
            'subtitle' => __("If Latest Post page is front page. Choose how to show the posts.", 'pinnacle'),
            'options' => array('summary' => __('Normal Post Excerpt', 'pinnacle'),'full' => __('Normal Full Post', 'pinnacle'), 'grid' => __('Grid Post', 'pinnacle')),
            'default' => 'summery',
            'width' => 'width:60%',
            ),
        array(
            'id'=>'home_post_grid_columns',
            'type' => 'select',
            'title' => __('Post Grid Columns', 'pinnacle'), 
            'options' => array('2' => __('Two', 'pinnacle'),'3' => __('Three', 'pinnacle'), '4' => __('Four', 'pinnacle')),
            'width' => 'width:60%',
            'default' => '3',
            'required' => array('home_post_summery','=',array('grid')),
            ),

    ),
);
$this->sections[] = array(
    'icon' => 'icon-shopping-cart',
    'icon_class' => 'icon-large',
    'title' => __('Shop Settings', 'pinnacle'),
    'desc' => "<div class='redux-info-field'><h3>".__('Shop Archive Page Settings', 'pinnacle')."</h3></div>",
    'fields' => array(
      array(
            'id'=>'product_shop_layout',
            'type' => 'select',
            'title' => __('Shop Product Column Layout', 'pinnacle'), 
            'subtitle' => __('Choose how many product columns on the shop and category pages', 'pinnacle'),
            'options' => array('3' => __('Three Column', 'pinnacle'), '4' => __('Four Column', 'pinnacle')),
            'width' => 'width:60%',
            'default' => '4',
            ),
      array(
            'id'=>'shop_layout',
            'type' => 'image_select',
            'compiler'=> false,
            'title' => __('Display the sidebar on Shop Page?', 'pinnacle'), 
            'subtitle' => __('This determines if there is a sidebar on the shop page.', 'pinnacle'),
            'options' => array(
                    'full' => array('alt' => 'Full Layout', 'img' => OPTIONS_PATH .'img/1col.png'),
                    'sidebar' => array('alt' => 'Sidebar Layout', 'img' => OPTIONS_PATH .'img/2cr.png'),
                ),
            'default' => 'full',
            ),
      array(
            'id'=>'shop_sidebar',
            'type' => 'select',
            'title' => __('Choose a Sidebar for your shop page', 'pinnacle'), 
            'data' => 'sidebars',
            'default' => 'sidebar-primary',
            'width' => 'width:60%',
            ),  
      array(
            'id'=>'shop_cat_layout',
            'type' => 'image_select',
            'compiler'=> false,
            'title' => __('Display the sidebar on Product Category Pages?', 'pinnacle'), 
            'subtitle' => __('This determines if there is a sidebar on the product category pages.', 'pinnacle'),
            'options' => array(
                    'full' => array('alt' => 'Full Layout', 'img' => OPTIONS_PATH .'img/1col.png'),
                    'sidebar' => array('alt' => 'Sidebar Layout', 'img' => OPTIONS_PATH .'img/2cr.png'),
                ),
            'default' => 'full',
            ),
      array(
            'id'=>'shop_cat_sidebar',
            'type' => 'select',
            'title' => __('Choose a Sidebar for your Product Category Pages', 'pinnacle'), 
            'data' => 'sidebars',
            'default' => 'sidebar-primary',
            'width' => 'width:60%',
            ),            
      array(
            'id'=>'products_per_page',
            'type' => 'slider', 
            'title' => __('How many products per page', 'pinnacle'),
            "default"       => "12",
            "min"       => "2",
            "step"      => "1",
            "max"       => "40",
            ),
      array(
            'id'=>'shop_rating',
            'type' => 'switch', 
            'title' => __('Show Ratings in Shop and Category Pages', 'pinnacle'),
            'subtitle' => __('This determines if the rating is displayed in the product archive pages', 'pinnacle'),
            "default"=> 1,
            ),
      array(
            'id'=>'shop_hide_action',
            'type' => 'switch', 
            'title' => __('Hide Add to Cart Till Mouse Hover', 'pinnacle'),
            'subtitle' => __('This determines if add to cart button will be hidden till the mouse hovers over the product', 'pinnacle'),
            "default"=> 1,
            ),
        array(
            'id'=>'info_cat_product_size',
            'type' => 'info',
            'desc' => __('Shop Category Image Size', 'pinnacle'),
            ),
         array(
            'id'=>'product_cat_layout',
            'type' => 'select',
            'title' => __('Shop Category Column Layout', 'pinnacle'), 
            'subtitle' => __('Choose how many Category Image columns to show on the shop and category pages', 'pinnacle'),
            'options' => array('3' => __('Three Column', 'pinnacle'), '4' => __('Four Column', 'pinnacle')),
            'width' => 'width:60%',
            'default' => '3',
            ),
        array(
            'id'=>'info_shop_product_title',
            'type' => 'info',
            'desc' => __('Shop Product Title Settings', 'pinnacle'),
            ),
        array(
            'id'=>'font_shop_title',
            'type' => 'typography', 
            'title' => __('Shop & archive Product title Font', 'pinnacle'),
            'font-family'=>true, 
            'google'=>true, // Disable google fonts. Won't work if you haven't defined your google api key
            'font-backup'=>false, // Select a backup non-google font in addition to a google font
            'font-style'=>true, // Includes font-style and weight. Can use font-style or font-weight to declare
            'subsets'=>true, // Only appears if google is true and subsets not set to false
            'font-size'=>true,
            'line-height'=>true,
            'color'=>true,
            'preview'=>true, // Disable the previewer
            'output' => array('.product_item .product_details h5, .product-category.grid_item a h5'),
            'subtitle'=> __("Choose Size and Style for product titles on category and archive pages.", 'pinnacle'),
            'default'=> array(
                'font-family'=>'Raleway',
                'color'=>"", 
                'font-style'=>'700',
                'font-size'=>'15px', 
                'line-height'=>'20px', ),
            ),
        array(
            'id'=>'shop_title_uppercase',
            'type' => 'switch', 
            'title' => __('Set Product Title to Uppercase?', 'pinnacle'),
            'subtitle' => __('This makes your product titles uppercase on Category pages', 'pinnacle'),
            "default"=> 0,
            ),
        array(
            'id'=>'shop_title_min_height',
            'type' => 'slider', 
            'title' => __('Product title Min Height', 'pinnacle'),
            'subtitle' => __('If your titles are long increase this to help align your products height.', 'pinnacle'),
            "default"       => "50",
            "min"       => "20",
            "step"      => "5",
            "max"       => "120",
            ), 
         array(
            'id'=>'info_shop_img_size',
            'type' => 'info',
            'desc' => __('Product Image Sizes', 'pinnacle'),
            ),
      array(
            'id'=>'product_img_resize',
            'type' => 'switch', 
            'title' => __('Enable Product Image Aspect Ratio on Catalog pages', 'pinnacle'),
            'subtitle' => __('If turned off image dimensions are set by woocommerce settings - recommended width: 270px for Catalog Images', 'pinnacle'),
            "default"=> 1,
            ),
      array(
            'id'=>'product_simg_resize',
            'type' => 'switch', 
            'title' => __('Enable Product Image Aspect Ratio on product Page', 'pinnacle'),
            'subtitle' => __('If turned off image dimensions are set by woocommerce settings - recommended width: 468px for Single Product Image', 'pinnacle'),
            "default"=> 1,
            ),
        ),
);
    $this->sections[] = array(
    'icon' => 'icon-barcode',
    'icon_class' => 'icon-large',
    'title' => __('Product Settings', 'pinnacle'),
    'desc' => "<div class='redux-info-field'><h3>".__('Single Product Page Header', 'pinnacle')."</h3></div>",
    'fields' => array(
           array(
            'id'=>'default_showproducttitle',
            'type' => 'switch', 
            'title' => __('Show the Title in header by default', 'pinnacle'),
            'subtitle'=> __('This can be overridden on each page.', 'pinnacle'),
            "default" => 1,
            ),
        array(
            'id'=>'default_showproducttitle_inpost',
            'type' => 'switch', 
            'title' => __('Show the Title in post', 'pinnacle'),
            'subtitle'=> __('This can be overridden on each page.', 'pinnacle'),
            "default" => 1,
            ),
        array(
            'id'=>'single_product_header_title',
            'type' => 'select',
            'title' => __('Product Default Title Text', 'pinnacle'), 
            'options' => array('category' => __('Category of product', 'pinnacle'), 'posttitle' => __('Product Title', 'pinnacle'), 'custom' => __('Custom', 'pinnacle')),
            'width' => 'width:60%',
            'default' => 'category',
            ),
         array(
            'id'=>'product_header_title_text',
            'type' => 'text',
            'title' => __('Post Default Title', 'pinnacle'),
            'subtitle' => __('Example: My Shop', 'pinnacle'),
            'required' => array('single_product_header_title','=','custom'),
            ),
        array(
            'id'=>'product_header_subtitle_text',
            'type' => 'text',
            'title' => __('Post Default Subtitle', 'pinnacle'),
            'required' => array('single_product_header_title','=','custom'),
            ),
        array(
            'id'=>'product_tabs',
            'type' => 'switch', 
            'title' => __('Display product tabs?', 'pinnacle'),
            'subtitle'=> __('This determines if product tabs are displayed', 'pinnacle'),
            "default"       => 1,
            ),
        array(
            'id'=>'related_products',
            'type' => 'switch', 
            'title' => __('Display related products?', 'pinnacle'),
            'subtitle'=> __('This determines related products are displayed', 'pinnacle'),
            "default"       => 1,
            ),
    ),
);
$this->sections[] = array(
    'icon' => 'icon-camera-retro',
    'icon_class' => 'icon-large',
    'title' => __('Portfolio Options', 'pinnacle'),
    'desc' => "<div class='redux-info-field'><h3>".__('Portfolio Options', 'pinnacle')."</h3></div>",
    'fields' => array(
        array(
            'id'=>'portfolio_comments',
            'type' => 'switch', 
            'title' => __('Allow Comments on Portfolio Posts', 'pinnacle'),
            'subtitle' => __('Turn on to allow Comments on Portfolio posts', 'pinnacle'),
            "default" => 0,
            ),
        array(
            'id'=>'info_portfolio_grid_options',
            'type' => 'info',
            'desc' => __('Portfolio Grid Options', 'pinnacle'),
            ),
        array(
            'id'=>'portfolio_style_default',
            'type' => 'select',
            'width' => 'width:60%',
            'default' => 'flat-w-margin',
            'title' => __('Default Portfolio Layout Style', 'pinnacle'), 
            'subtitle' => __('This sets the defualt layout style for the portfolio post.', 'pinnacle'),
            'options' => array('padded_style' => __('Post Boxes', 'pinnacle'), 'flat-w-margin' => __('Flat with Margin', 'pinnacle')),
            ),
        array(
            'id'=>'portfolio_hover_style_default',
            'type' => 'select',
            'width' => 'width:60%',
            'default' => 'p_primarystyle',
            'title' => __('Default Hover Style', 'pinnacle'), 
            'subtitle' => __('This sets the defualt hover style for the portfolio post.', 'pinnacle'),
            'options' => array('p_primarystyle' => __('Primary Color Style', 'pinnacle'), 'p_lightstyle' => __('Light Style', 'pinnacle'), 'p_darkstyle' => __('Dark Style', 'pinnacle')),
            ),
          array(
            'id'=>'info_product_ph_defaults',
            'type' => 'info',
            'desc' => __('Single Portfolio Page Header', 'pinnacle'),
            ),
           array(
            'id'=>'default_showportfoliotitle',
            'type' => 'switch', 
            'title' => __('Show the Title in header by default', 'pinnacle'),
            'subtitle'=> __('This can be overridden on each page.', 'pinnacle'),
            "default" => 1,
            ),
        array(
            'id'=>'default_showportfoliotitle_inpost',
            'type' => 'switch', 
            'title' => __('Show the Title in post', 'pinnacle'),
            "default" => 0,
            ),
        array(
            'id'=>'single_portfolio_header_title',
            'type' => 'select',
            'title' => __('Product Default Title Text', 'pinnacle'), 
            'options' => array('category' => __('Category of Portfolio', 'pinnacle'), 'posttitle' => __('Portfolio Title', 'pinnacle'), 'custom' => __('Custom', 'pinnacle')),
            'width' => 'width:60%',
            'default' => 'posttitle',
            ),
         array(
            'id'=>'portfolio_header_title_text',
            'type' => 'text',
            'title' => __('Post Default Title', 'pinnacle'),
            'subtitle' => __('Example: My Shop', 'pinnacle'),
            'required' => array('single_portfolio_header_title','=','custom'),
            ),
        array(
            'id'=>'portfolio_header_subtitle_text',
            'type' => 'text',
            'title' => __('Post Default Subtitle', 'pinnacle'),
            'required' => array('single_portfolio_header_title','=','custom'),
            ),
        array(
            'id'=>'info_portfolio_nav_options',
            'type' => 'info',
            'desc' => __('Single Portfolio Navigation Options', 'pinnacle'),
            ),
        array(
            'id'=>'portfolio_header_nav',
            'type' => 'switch', 
            'title' => __('Show portfolio nav below post title', 'pinnacle'),
            "default" => 1,
            ),
        array(
            'id'=>'portfolio_link',
            'type' => 'select',
            'data' => 'pages',
            'width' => 'width:60%',
            'title' => __('All Projects Default Portfolio Page', 'pinnacle'), 
            'subtitle' => __('This sets the link in every portfolio post.', 'pinnacle'),
            ),
        array(
            'id'=>'info_portfolio_carousel_options',
            'type' => 'info',
            'desc' => __('Portfolio Post Bottom Carousel', 'pinnacle'),
            ),
        array(
            'id'=>'single_portfolio_carousel_default',
            'type' => 'select',
            'title' => __('Display Bottom Portfolio carousel by Default', 'pinnacle'), 
            'options' => array('no' => __('No', 'pinnacle'), 'yes' => __('Yes', 'pinnacle')),
            'width' => 'width:60%',
            'default' => 'no',
            ),
        array(
            'id'=>'single_portfolio_carousel_items',
            'type' => 'select',
            'title' => __('Bottom Portfolio Carousel Items', 'pinnacle'), 
            'options' => array('all' => __('All Portfolio Posts', 'pinnacle'), 'cat' => __('Only of same Portfolio Type', 'pinnacle')),
            'width' => 'width:60%',
            'default' => 'all',
            ),
        array(
            'id'=>'portfolio_recent_car_column',
            'type' => 'slider', 
            'title' => __('Choose how many columns to show on recent portfolio carousel.', 'pinnacle'),
            "default"       => "4",
            "min"       => "2",
            "step"      => "1",
            "max"       => "6",
            ),
        array(
            'id'=>'info_portfolio_cat_defaults',
            'type' => 'info',
            'desc' => __('Portfolio Category Pages', 'pinnacle'),
            ),
        array(
            'id'=>'portfolio_tax_column',
            'type' => 'slider', 
            'title' => __('Choose how many portfolio columns to show on portfolio catagory pages.', 'pinnacle'),
            "default"       => "4",
            "min"       => "2",
            "step"      => "1",
            "max"       => "6",
            ),
      ),
);
$this->sections[] = array(
    'icon' => 'icon-paperclip',
    'icon_class' => 'icon-large',
    'title' => __('Blog Options', 'pinnacle'),
    'desc' => "<div class='redux-info-field'><h3>".__('Blog Options', 'pinnacle')."</h3></div>",
    'fields' => array(
        array(
            'id'=>'close_comments',
            'type' => 'switch', 
            'title' => __('Show Comments Closed Text?', 'pinnacle'),
            'subtitle' => __('Choose to show or hide comments closed alert below posts.', 'pinnacle'),
            "default" => 0,
            ),
        array(
            'id'=>'hide_author_img',
            'type' => 'switch', 
            'title' => __('Show Author image with posts?', 'pinnacle'),
            'subtitle' => __('Choose to show or hide author image beside post title.', 'pinnacle'),
            "default" => 0,
            ),
      array(
            'id'=>'hide_author',
            'type' => 'switch', 
            'title' => __('Show author name with posts?', 'pinnacle'),
            'subtitle' => __('Choose to show or hide author name under post title.', 'pinnacle'),
            "default" => 1,
            ),
      array(
            'id'=>'hide_postedin',
            'type' => 'switch', 
            'title' => __('Show categories with posts?', 'pinnacle'),
            'subtitle' => __('Choose to show or hide categories in the post footer.', 'pinnacle'),
            "default" => 1,
            ),
      array(
            'id'=>'hide_posttags',
            'type' => 'switch', 
            'title' => __('Show tags with posts?', 'pinnacle'),
            'subtitle' => __('Choose to show or hide tags in the post footer.', 'pinnacle'),
            "default" => 1,
            ),
      array(
            'id'=>'hide_commenticon',
            'type' => 'switch', 
            'title' => __('Show comment count with posts?', 'pinnacle'),
            'subtitle' => __('Choose to show or hide comment count under post title.', 'pinnacle'),
            "default" => 1,
            ),
      array(
            'id'=>'hide_postdate',
            'type' => 'switch', 
            'title' => __('Show date with posts?', 'pinnacle'),
            'subtitle' => __('Choose to show or hide date under post title.', 'pinnacle'),
            "default" => 1,
            ),
      array(
            'id'=>'show_postlinks',
            'type' => 'switch', 
            'title' => __('Show Previous and Next posts links?', 'pinnacle'),
            'subtitle' => __('Choose to show or hide previous and next post links in the footer of a single post.', 'pinnacle'),
            "default" => 0,
            ),
       array(
            'id'=>'info_blog_defaults',
            'type' => 'info',
            'desc' => __('Blog Post Page Header', 'pinnacle'),
            ),
           array(
            'id'=>'default_showposttitle',
            'type' => 'switch', 
            'title' => __('Show the post title in head by default', 'pinnacle'),
            'subtitle'=> __('This can be overridden on each page.', 'pinnacle'),
            "default" => 1,
            ),
           array(
            'id'=>'single_post_header_title',
            'type' => 'select',
            'title' => __('Blog Post Default Head Title', 'pinnacle'), 
            'options' => array('category' => __('Category', 'pinnacle'), 'posttitle' => __('Post Title', 'pinnacle'), 'custom' => __('Custom', 'pinnacle')),
            'width' => 'width:60%',
            'default' => 'category',
            ),
           array(
            'id'=>'default_showposttitle_below',
            'type' => 'switch', 
            'title' => __('Show the post title below the header', 'pinnacle'),
            "default" => 1,
            'required' => array('single_post_header_title','=','posttitle'),
            ),
            array(
            'id'=>'post_header_title_text',
            'type' => 'text',
            'title' => __('Post Default Title', 'pinnacle'),
            'subtitle' => __('Example: Blog', 'pinnacle'),
            'required' => array('single_post_header_title','=','custom'),
            ),
            array(
            'id'=>'post_header_subtitle_text',
            'type' => 'text',
            'title' => __('Post Default Subtitle', 'pinnacle'),
            'required' => array('single_post_header_title','=','custom'),
            ),
      array(
            'id'=>'info_blog_defaults',
            'type' => 'info',
            'desc' => __('Blog Post Defaults', 'pinnacle'),
            ),
       array(
            'id'=>'blogpost_sidebar_default',
            'type' => 'select',
            'title' => __('Blog Post Sidebar Default', 'pinnacle'), 
            'options' => array('yes' => __('Yes, Show', 'pinnacle'), 'no' => __('No, Do not Show', 'pinnacle')),
            'width' => 'width:60%',
            'default' => 'yes',
            ),
        array(
            'id'=>'post_author_default',
            'type' => 'select',
            'title' => __('Blog Post Author Box Default', 'pinnacle'), 
            'options' => array('no' => __('No, Do not Show', 'pinnacle'), 'yes' => __('Yes, Show', 'pinnacle')),
            'width' => 'width:60%',
            'default' => 'no',
            ),
        array(
            'id'=>'post_carousel_default',
            'type' => 'select',
            'title' => __('Blog Post Bottom Carousel Default', 'pinnacle'), 
            'options' => array('no' => __('No, Do not Show', 'pinnacle'), 'recent' => __('Yes - Display Recent Posts', 'pinnacle'), 'similar' => __('Yes - Display Similar Posts', 'pinnacle')),
            'width' => 'width:60%',
            'default' => 'no',
            ),
        array(
            'id'=>'info_blog_defaults_stand',
            'type' => 'info',
            'desc' => __('Blog Post Defaults Standard', 'pinnacle'),
            ),
        array(
            'id'=>'post_summery_default',
            'type' => 'select',
            'title' => __('Standard Blog Post Summary Default', 'pinnacle'), 
            'options' => array('text' => __('Text', 'pinnacle'), 'img_portrait' => __('Portrait Image', 'pinnacle'), 'img_landscape' => __('Landscape Image', 'pinnacle')),
            'width' => 'width:60%',
            'default' => 'img_landscape',
            ),
        array(
            'id'=>'info_blog_defaults_image',
            'type' => 'info',
            'desc' => __('Blog Post Defaults Image', 'pinnacle'),
            ),
        array(
            'id'=>'image_post_summery_default',
            'type' => 'select',
            'title' => __('Image Blog Post Summary Default', 'pinnacle'), 
            'options' => array('text' => __('Text', 'pinnacle'), 'img_portrait' => __('Portrait Image', 'pinnacle'), 'img_landscape' => __('Landscape Image', 'pinnacle')),
            'width' => 'width:60%',
            'default' => 'img_portrait',
            ),
        array(
            'id'=>'image_post_blog_default',
            'type' => 'select',
            'title' => __('Single Image Post Head Content', 'pinnacle'), 
            'options' => array('none' => __('None', 'pinnacle'), 'image' => __('Image', 'pinnacle')),
            'width' => 'width:60%',
            'default' => 'image',
            ),
        array(
            'id'=>'info_blog_defaults_gallery',
            'type' => 'info',
            'desc' => __('Blog Post Defaults gallery', 'pinnacle'),
            ),
        array(
            'id'=>'gallery_post_summery_default',
            'type' => 'select',
            'title' => __('Gallery Blog Post Summary Default', 'pinnacle'), 
            'options' => array('text' => __('Text', 'pinnacle'), 'img_portrait' => __('Portrait Image', 'pinnacle'), 'img_landscape' => __('Landscape Image', 'pinnacle'),'slider_portrait' => __('Portrait Slider', 'pinnacle'), 'slider_landscape' => __('Landscape Slider', 'pinnacle')),
            'width' => 'width:60%',
            'default' => 'slider_landscape',
            ),
        array(
            'id'=>'gallery_post_blog_default',
            'type' => 'select',
            'title' => __('Single Gallery Post Head Content', 'pinnacle'), 
            'options' => array('none' => __('None', 'pinnacle'), 'flex' => __('Image Slider (Flex Slider)', 'pinnacle'),'carouselslider' => __('Carousel Slider (Caroufedsel Slider)', 'pinnacle')),
            'width' => 'width:60%',
            'default' => 'flex',
            ),
        array(
            'id'=>'info_blog_defaults_video',
            'type' => 'info',
            'desc' => __('Blog Post Defaults Video', 'pinnacle'),
            ),
        array(
            'id'=>'video_post_summery_default',
            'type' => 'select',
            'title' => __('Video Blog Post Summary Default', 'pinnacle'), 
            'options' => array('text' => __('Text', 'pinnacle'), 'img_portrait' => __('Portrait Image', 'pinnacle'), 'img_landscape' => __('Landscape Image', 'pinnacle'),'video' => __('Video', 'pinnacle')),
            'width' => 'width:60%',
            'default' => 'video',
            ),
        array(
            'id'=>'video_post_blog_default',
            'type' => 'select',
            'title' => __('Single Video Post Head Content', 'pinnacle'), 
            'options' => array('none' => __('None', 'pinnacle'), 'video' => __('Video', 'pinnacle')),
            'width' => 'width:60%',
            'default' => 'video',
            ),
        array(
            'id'=>'info_blog_category',
            'type' => 'info',
            'desc' => __('Blog Category/Archive Defaults', 'pinnacle'),
            ),
        array(
            'id'=>'category_post_summary',
            'type' => 'select',
            'title' => __('Category Display Type', 'pinnacle'), 
            'options' => array('summary' => __('Normal Post Excerpt', 'pinnacle'),'full' => __('Normal Full Post', 'pinnacle'), 'grid' => __('Grid Post', 'pinnacle')),
            'width' => 'width:60%',
            'default' => 'summary',
            ),
        array(
            'id'=>'category_post_grid_columns',
            'type' => 'select',
            'title' => __('Category Grid Columns', 'pinnacle'), 
            'options' => array('2' => __('Two', 'pinnacle'),'3' => __('Three', 'pinnacle'), '4' => __('Four', 'pinnacle')),
            'width' => 'width:60%',
            'default' => '3',
            'required' => array('category_post_summary','=',array('grid')),
            ),
        array(
            'id'=>'blog_cat_layout',
            'type' => 'image_select',
            'compiler'=> false,
            'title' => __('Display the sidebar on blog archives?', 'pinnacle'), 
            'subtitle' => __('This determines if there is a sidebar on the blog category pages.', 'pinnacle'),
            'options' => array(
                    'full' => array('alt' => 'Full Layout', 'img' => OPTIONS_PATH .'img/1col.png'),
                    'sidebar' => array('alt' => 'Sidebar Layout', 'img' => OPTIONS_PATH .'img/2cr.png'),
                ),
            'default' => 'sidebar',
            ),
      array(
            'id'=>'blog_cat_sidebar',
            'type' => 'select',
            'title' => __('Choose a Sidebar for your Category/Archive Pages', 'pinnacle'), 
            'data' => 'sidebars',
            'default' => 'sidebar-primary',
            'width' => 'width:60%',
            ),    
      ),
);

$this->sections[] = array(
    'icon' => 'icon-edit',
    'icon_class' => 'icon-large',
    'title' => __('Basic Styling', 'pinnacle'),
    'desc' => "<div class='redux-info-field'><h3>".__('Basic Stylng', 'pinnacle')."</h3></div>",
    'fields' => array(
        array(
            'id'=>'skin_stylesheet',
            'type' => 'select',
            'title' => __('Theme Skin Stylesheet', 'pinnacle'), 
            'subtitle' => __("Note* changes made in options panel will override this stylesheet. Example: Colors set in typography.", 'pinnacle'),
            'options' => $alt_stylesheets,
            'default' => 'default.css',
            'width' => 'width:60%',
            'customizer' => true,
            ),
        array(
            'id'=>'primary_color',
            'type' => 'color',
            'title' => __('Primary Color', 'pinnacle'), 
            'subtitle' => __('Choose the default Highlight color for your site.', 'pinnacle'),
            'transparent'=>false,
            'validate' => 'color',
            'customizer' => true,
            ),
        array(
            'id'=>'primary20_color',
            'type' => 'color',
            'title' => __('Primary Hover Color', 'pinnacle'), 
            'subtitle' => __('Recomended to be 20% lighter than primary color', 'pinnacle'),
            'default' => '',
            'transparent'=>false,
            'validate' => 'color',
            'customizer' => true,
            ),
        array(
            'id'=>'gray_font_color',
            'type' => 'color',
            'title' => __('Sitewide Gray Fonts', 'pinnacle'), 
            'default' => '',
            'transparent'=>false,
            'validate' => 'color',
            'customizer' => true,
            ),
        array(
            'id'=>'footerfont_color',
            'type' => 'color',
            'title' => __('Footer Font Color', 'pinnacle'), 
            'default' => '',
            'transparent'=>false,
            'validate' => 'color',
            'customizer' => true,
            ),
      ),
);
$this->sections[] = array(
    'icon' => 'icon-cogs',
    'icon_class' => 'icon-large',
    'title' => __('Advanced Styling', 'pinnacle'),
    'desc' => "<div class='redux-info-field'><h3>".__('Main Content Background', 'pinnacle')."</h3></div>",
    'fields' => array(
      array(
        'id'        => 'content_background',
        'type'      => 'background',
        'output'    => array('.contentclass'),
        'title'     => __('Content Background', 'pinnacle'),
        ),
      array(
            'id'=>'info_topbar_background',
            'type' => 'info',
            'desc' => __('Topbar Background', 'pinnacle'),
            ),
      array(
        'id'        => 'topbar_background',
        'type'      => 'background',
        'output'    => array('.topclass'),
        'title'     => __('Topbar Background', 'pinnacle'),
        ),
      array(
            'id'=>'info_header_background',
            'type' => 'info',
            'desc' => __('Header Background', 'pinnacle'),
            ),
      array(
            'id'=>'header_background_choice',
            'type' => 'select',
            'title' => __('Header Background Style', 'pinnacle'), 
            'options' => array('simple' => __('Simple', 'pinnacle'), 'full' => __('Full', 'pinnacle')),
            'width' => 'width:60%',
            'default' => 'simple',
            ),
      array(
        'id'        => 'header_background',
        'type'      => 'background',
        'output'    => array('.is_sticky .headerclass', '.none-trans-header .headerclass'),
        'title'     => __('Header Background', 'pinnacle'),
        'required' => array('header_background_choice','=','full'),
        ),
      array(
            'id'=>'header_background_color',
            'type' => 'color',
            'title' => __('Header Background Color', 'pinnacle'), 
            'default' => '',
            'transparent'=>false,
            'validate' => 'color',
            'required' => array('header_background_choice','=','simple'),
            ),
      array(
            'id'=>'header_background_transparency',
            'type' => 'select',
            'title' => __('If background is color, select Transparency', 'pinnacle'), 
            'options' => array('1' => '1','0.9' => '0.9', '0.8' => '0.8','0.7' => '0.7', '0.6' => '0.6', '0.5' => '0.5', '0.4' => '0.4', '0.3' => '0.3', '0.2' => '0.2', '0.1' => '0.1', '0' => '0'),
            'default' => '1',
            'width' => 'width:60%',
            'required' => array('header_background_choice','=','simple'),
            ),
      array(
            'id'=>'info_menu_background',
            'type' => 'info',
            'desc' => __('Menu Background', 'pinnacle'),
            ),
      array(
        'id'        => 'menu_background',
        'type'      => 'background',
        'output'    => array('.navclass'),
        'title'     => __('Menu Background', 'pinnacle'),
        ),
      array(
            'id'=>'info_mobile_background',
            'type' => 'info',
            'desc' => __('Mobile Menu Background', 'pinnacle'),
            ),
      array(
        'id'        => 'mobile_background',
        'type'      => 'background',
        'output'    => array('.mobileclass'),
        'title'     => __('Mobile Menu Background', 'pinnacle'),
        ),
      array(
            'id'=>'info_post_background',
            'type' => 'info',
            'desc' => __('Post and Page Content area Background', 'pinnacle'),
            ),
      array(
        'id'        => 'post_background',
        'type'      => 'background',
        'output'    => array('.postclass'),
        'title'     => __('Post Background', 'pinnacle'),
        ),
      array(
            'id'=>'info_footer_background',
            'type' => 'info',
            'desc' => __('Footer Background', 'pinnacle'),
            ),
    array(
        'id'        => 'footer_background',
        'type'      => 'background',
        'output'    => array('.footerclass'),
        'title'     => __('Footer Background', 'pinnacle'),
        ),
      array(
            'id'=>'info_body_background',
            'type' => 'info',
            'desc' => __('Body Background', 'pinnacle'),
            ),
      array(
        'id'        => 'body_background',
        'type'      => 'background',
        'output'    => array('body'),
        'title'     => __('Body Background', 'pinnacle'),
        'subtitle'  => __('This shows if site is using the boxed layout option.', 'pinnacle'),
        ),
    ),
);
$this->sections[] = array(
    'icon' => 'icon-text-width',
    'icon_class' => 'icon-large',
    'title' => __('Typography', 'pinnacle'),
    'desc' => "<div class='redux-info-field'><h3>".__('Header Font Options', 'pinnacle')."</h3></div>",
    'fields' => array(
      array(
            'id'=>'font_h1',
            'type' => 'typography', 
            'title' => __('H1 Headings', 'pinnacle'),
            'font-family'=>true, 
            'google'=>true, // Disable google fonts. Won't work if you haven't defined your google api key
            'font-backup'=>false, // Select a backup non-google font in addition to a google font
            'font-style'=>true, // Includes font-style and weight. Can use font-style or font-weight to declare
            'subsets'=>true, // Only appears if google is true and subsets not set to false
            'font-size'=>true,
            'line-height'=>true,
            'text-align' => false,
            'color'=>true,
            'preview'=>true, // Disable the previewer
            'output' => array('h1'),
            'subtitle'=> __("Choose Size and Style for h1 (This Styles Your Page Titles)", 'pinnacle'),
            'default'=> array(
                'font-family'=>'Raleway',
                'color'=>"", 
                'font-style'=>'700',
                'font-size'=>'44px', 
                'line-height'=>'50px', ),
            ),
    array(
            'id'=>'font_h2',
            'type' => 'typography', 
            'title' => __('H2 Headings', 'pinnacle'),
            //'compiler'=>true, // Use if you want to hook in your own CSS compiler
              'font-family'=>true, 
            'google'=>true, // Disable google fonts. Won't work if you haven't defined your google api key
            'font-backup'=>false, // Select a backup non-google font in addition to a google font
            'font-style'=>true, // Includes font-style and weight. Can use font-style or font-weight to declare
            'subsets'=>true, // Only appears if google is true and subsets not set to false
            'font-size'=>true,
            'line-height'=>true,
            'text-align' => false,
            //'word-spacing'=>false, // Defaults to false
            //'all_styles' => true,
            'color'=>true,
            'preview'=>true, // Disable the previewer
            'output' => array('h2'),
            'subtitle'=> __("Choose Size and Style for h2", 'pinnacle'),
            'default'=> array(
                'font-family'=>'Raleway',
                'color'=>"", 
                'font-style'=>'400',
                'font-size'=>'32px', 
                'line-height'=>'40px', ),
            ),
    array(
            'id'=>'font_h3',
            'type' => 'typography', 
            'title' => __('H3 Headings', 'pinnacle'),
            //'compiler'=>true, // Use if you want to hook in your own CSS compiler
            'font-family'=>true, 
            'google'=>true, // Disable google fonts. Won't work if you haven't defined your google api key
            'font-backup'=>false, // Select a backup non-google font in addition to a google font
            'font-style'=>true, // Includes font-style and weight. Can use font-style or font-weight to declare
            'subsets'=>true, // Only appears if google is true and subsets not set to false
            'font-size'=>true,
            'line-height'=>true,
            'text-align' => false,
            //'word-spacing'=>false, // Defaults to false
            //'all_styles' => true,
            'color'=>true,
            'preview'=>true, // Disable the previewer
            'output' => array('h3'),
            'subtitle'=> __("Choose Size and Style for h3", 'pinnacle'),
            'default'=> array(
                'font-family'=>'Raleway',
                'color'=>"", 
                'font-style'=>'400',
                'font-size'=>'26px', 
                'line-height'=>'40px', ),
            ),
    array(
            'id'=>'font_h4',
            'type' => 'typography', 
            'title' => __('H4 Headings', 'pinnacle'),
            //'compiler'=>true, // Use if you want to hook in your own CSS compiler
            'font-family'=>true, 
            'google'=>true, // Disable google fonts. Won't work if you haven't defined your google api key
            'font-backup'=>false, // Select a backup non-google font in addition to a google font
            'font-style'=>true, // Includes font-style and weight. Can use font-style or font-weight to declare
            'subsets'=>true, // Only appears if google is true and subsets not set to false
            'font-size'=>true,
            'line-height'=>true,
            'text-align' => false,
            //'word-spacing'=>false, // Defaults to false
            //'all_styles' => true,
            'color'=>true,
            'preview'=>true, // Disable the previewer
            'output' => array('h4'),
            'subtitle'=> __("Choose Size and Style for h4", 'pinnacle'),
            'default'=> array(
                'font-family'=>'Raleway',
                'color'=>"", 
                'font-style'=>'400',
                'font-size'=>'24px', 
                'line-height'=>'34px', ),
            ),
    array(
            'id'=>'font_h5',
            'type' => 'typography', 
            'title' => __('H5 Headings', 'pinnacle'),
            //'compiler'=>true, // Use if you want to hook in your own CSS compiler
            'font-family'=>true, 
            'google'=>true, // Disable google fonts. Won't work if you haven't defined your google api key
            'font-backup'=>false, // Select a backup non-google font in addition to a google font
            'font-style'=>true, // Includes font-style and weight. Can use font-style or font-weight to declare
            'subsets'=>true, // Only appears if google is true and subsets not set to false
            'font-size'=>true,
            'text-align' => false,
            'line-height'=>true,
            'color'=>true,
            'preview'=>true, // Disable the previewer
            'output' => array('h5'),
            'subtitle'=> __("Choose Size and Style for h5", 'pinnacle'),
            'default'=> array(
                'font-family'=>'Raleway',
                'color'=>"", 
                'font-style'=>'400',
                'font-size'=>'18px', 
                'line-height'=>'26px', ),
            ),
    array(
            'id'=>'font_subtitle',
            'type' => 'typography', 
            'title' => __('Page Subtitle', 'pinnacle'),
            'font-family'=>true, 
            'google'=>true, // Disable google fonts. Won't work if you haven't defined your google api key
            'font-backup'=>false, // Select a backup non-google font in addition to a google font
            'font-style'=>true, // Includes font-style and weight. Can use font-style or font-weight to declare
            'subsets'=>true, // Only appears if google is true and subsets not set to false
            'font-size'=>true,
            'text-align' => false,
            'line-height'=>true,
            'color'=>true,
            'preview'=>true, // Disable the previewer
            'output' => array('.subtitle'),
            'subtitle'=> __("Choose Size and Style for Page Subtitle", 'pinnacle'),
            'default'=> array(
                'font-family'=>'Raleway',
                'color'=>"", 
                'font-style'=>'400',
                'font-size'=>'16px', 
                'line-height'=>'22px', ),
            ),
    array(
            'id'=>'info_body_font',
            'type' => 'info',
            'desc' => __('Body Font Options', 'pinnacle'),
            ),
    array(
            'id'=>'font_p',
            'type' => 'typography', 
            'title' => __('Body Font', 'pinnacle'),
            //'compiler'=>true, // Use if you want to hook in your own CSS compiler
            'font-family'=>true, 
            'google'=>true, // Disable google fonts. Won't work if you haven't defined your google api key
            'font-backup'=>false, // Select a backup non-google font in addition to a google font
            'font-style'=>true, // Includes font-style and weight. Can use font-style or font-weight to declare
            'subsets'=>true, // Only appears if google is true and subsets not set to false
            'font-size'=>true,
            'line-height'=>true,
            'text-align' => false,
            //'word-spacing'=>false, // Defaults to false
            'all_styles' => true,
            'color'=>true,
            'preview'=>true, // Disable the previewer
            'output' => array('body'),
            'subtitle'=> __("Choose Size and Style for paragraphs", 'pinnacle'),
            'default'=> array(
                'font-family'=>'',
                'color'=>"", 
                'font-style'=>'400',
                'font-size'=>'14px', 
                'line-height'=>'20px', ),
            ),
  ),
);
$this->sections[] = array(
    'icon' => 'icon-reorder',
    'icon_class' => 'icon-large',
    'title' => __('Menu Settings', 'pinnacle'),
    'desc' => "<div class='redux-info-field'><h3>".__('Primary Menu Options', 'pinnacle')."</h3></div>",
    'fields' => array(
      array(
            'id'=>'font_primary_menu',
            'type' => 'typography', 
            'title' => __('Primary Menu Font', 'pinnacle'),
            //'compiler'=>true, // Use if you want to hook in your own CSS compiler
            'font-family'=>true, 
            'google'=>true, // Disable google fonts. Won't work if you haven't defined your google api key
            'font-backup'=>false, // Select a backup non-google font in addition to a google font
            'font-style'=>true, // Includes font-style and weight. Can use font-style or font-weight to declare
            'subsets'=>true, // Only appears if google is true and subsets not set to false
            'font-size'=>true,
            'line-height'=>false,
            'text-align' => false,
            //'word-spacing'=>false, // Defaults to false
            //'all_styles' => true,
            'color'=>true,
            'preview'=>true, // Disable the previewer
            'output' => array('.is-sticky .kad-primary-nav ul.sf-menu a, ul.sf-menu a, .none-trans-header .kad-primary-nav ul.sf-menu a'),
            'subtitle'=> __("Choose Size and Style for primary menu", 'pinnacle'),
            'default'=> array(
                'font-family'=>'Raleway',
                'color'=>"#444444", 
                'font-style'=>'400',
                'font-size'=>'16px', ),
            ),
    array(
            'id'=>'info_menu_mobile_font',
            'type' => 'info',
            'desc' => __('Mobile Menu Options', 'pinnacle'),
            ),
    array(
            'id'=>'font_mobile_menu',
            'type' => 'typography', 
            'title' => __('Mobile Menu Font', 'pinnacle'),
            //'compiler'=>true, // Use if you want to hook in your own CSS compiler
            'font-family'=>true, 
            'google'=>true, // Disable google fonts. Won't work if you haven't defined your google api key
            'font-backup'=>false, // Select a backup non-google font in addition to a google font
            'font-style'=>true, // Includes font-style and weight. Can use font-style or font-weight to declare
            'subsets'=>true, // Only appears if google is true and subsets not set to false
            'font-size'=>true,
            'line-height'=>true,
            'text-align' => false,
            //'word-spacing'=>false, // Defaults to false
            //'all_styles' => true,
            'color'=>true,
            'preview'=>true, // Disable the previewer
            'output' => array('.kad-nav-inner .kad-mnav, .kad-mobile-nav .kad-nav-inner li a'),
            'subtitle'=> __("Choose Size and Style for Mobile Menu", 'pinnacle'),
            'default'=> array(
                'font-family'=>'Raleway',
                'color'=>"", 
                'font-style'=>'400',
                'font-size'=>'16px', 
                'line-height'=>'20px', ),
            ),
    array(
            'id'=>'info_menu_topbar_font',
            'type' => 'info',
            'desc' => __('Topbar Menu Options', 'pinnacle'),
            ),
     array(
            'id'=>'topbar-menu-font-size',
            'type' => 'typography', 
            'title' => __('Topbar Menu Font', 'pinnacle'),
            'font-family'=>true, 
            'google'=>true, // Disable google fonts. Won't work if you haven't defined your google api key
            'font-backup'=>false, // Select a backup non-google font in addition to a google font
            'font-style'=>true, // Includes font-style and weight. Can use font-style or font-weight to declare
            'subsets'=>true, // Only appears if google is true and subsets not set to false
            'font-size'=>true,
            'line-height'=>false,
            'text-align' => false,
            'color'=>true,
            'preview'=>true, // Disable the previewer
            'output' => array('#topbar ul.sf-menu > li > a, #topbar .top-menu-cart-btn, #topbar .top-menu-search-btn, #topbar .nav-trigger-case .kad-navbtn, #topbar .topbarsociallinks li a'),
            'subtitle'=> __("Choose Size and Style for topbar menu", 'pinnacle'),
            'default'=> array(
                'font-family'=>'Raleway',
                'color'=>"", 
                'font-style'=>'400',
                'font-size'=>'11px', ),
            ),
    ),
);
$this->sections[] = array(
    'icon' => 'icon-wrench',
    'icon_class' => 'icon-large',
    'title' => __('Misc Settings', 'pinnacle'),
    'desc' => "<div class='redux-info-field'><h3>".__('Misc Settings', 'pinnacle')."</h3></div>",
    'fields' => array(
        array(
            'id'=>'pinnacle_custom_favicon',
            'type' => 'media', 
            'preview'=> true,
            'title' => __('Custom Favicon', 'pinnacle'),
            'subtitle' => __('Upload a 16px x 16px png/gif/ico image that will represent your website favicon.', 'pinnacle'),
            ),  
        array(
            'id'=>'footer_text',
            'type' => 'textarea',
            'title' => __('Footer Copyright Text', 'pinnacle'), 
            'subtitle' => __('Write your own copyright text here. You can use the following shortcodes in your footer text: [copyright] [site-name] [the-year]', 'pinnacle'),
            'default' => '[copyright] [the-year] [site-name] [theme-credit]',
            ),
        array(
            'id'=>'info_search_sidebars',
            'type' => 'info',
            'desc' => __('Search Results Sidebars', 'pinnacle'),
            ),
        array(
            'id'=>'search_sidebar',
            'type' => 'select',
            'title' => __('Search Results - choose Sidebar', 'pinnacle'), 
            'data' => 'sidebars',
            'default' => 'sidebar-primary',
            'width' => 'width:60%',
            ),
        array(
            'id'=>'info_sidebars',
            'type' => 'info',
            'desc' => __('Create Sidebars', 'pinnacle'),
            ),
        array(
            'id'=>'cust_sidebars',
            'type' => 'multi_text',
            'title' => __('Create Custom Sidebars', 'pinnacle'),
            'subtitle' => __('Type new sidebar name into textbox', 'pinnacle'),
            'default' =>__('Extra Sidebar', 'pinnacle'),
            ),
        array(
            'id'=>'info_wpgallerys',
            'type' => 'info',
            'desc' => __('Wordpress Galleries', 'pinnacle'),
            ),
        array(
            'id'=>'pinnacle_gallery',
            'type' => 'switch', 
            'title' => __('Enable Pinnacle Galleries to override Wordpress', 'pinnacle'),
            'subtitle' => __('You must have virtue/pinnacle toolkit installed to use.', 'pinnacle'),
            "default" => 1,
            ),
    ),
);
$this->sections[] = array(
    'icon' => 'icon-code',
    'icon_class' => 'icon-large',
    'title' => __('Custom CSS', 'pinnacle'),
    'desc' => "<div class='redux-info-field'><h3>".__('Custom CSS Box', 'pinnacle')."</h3></div>",
    'fields' => array(
             array(
            'id'=>'custom_css',
            'type' => 'textarea',
            'title' => __('Custom CSS', 'pinnacle'), 
            'subtitle' => __('Quickly add some CSS to your theme by adding it to this block.', 'pinnacle'),
            'validate' => 'css',
            ),
    ),
);
}
          public function setArguments() {
            $theme = wp_get_theme();
            $this->args = array(
            'dev_mode' => false,
            'update_notice' => false,
            'customizer' => false,
            'dev_mode_icon_class' => 'icon-large',
            'opt_name' => 'pinnacle',
            'system_info_icon_class' => 'icon-large',
            'display_name' => $theme->get('Name'),
            'display_version' => $theme->get('Version'),
            'google_api_key' => 'AIzaSyALkgUvb8LFAmrsczX56ZGJx-PPPpwMid0',
            'import_icon_class' => 'icon-large icon-hdd',
            'menu_title' => __('Theme Options', 'pinnacle'),
            'page_title' => __('Theme Options', 'pinnacle'),
            'page_slug' => 'ktoptions',
            'default_show' => false,
            'default_mark' => '',
            'admin_bar' => false,  
            'page_type' => 'submenu',
            'page_icon' => "kad_logo_header",
            'footer_credit' => __('Thank you for using the Pinnacle Theme by <a href="http://kadencethemes.com/" target="_blank">Kadence Themes</a>.', 'pinnacle'),
            );
            $this->args['intro_text'] = 'Upgrade to <a href="http://kadencethemes.com/product/pinnacle-premium-theme/" target="_blank" >Pinnacle Premium!</a> More great features! Over 50 more theme options, premium sliders and carousels, breadcrumbs, custom post types and much much more!';
           $this->args['share_icons']['facebook'] = array(
            'link' => 'https://www.facebook.com/KadenceThemes',
            'title' => 'Follow Kadence Themes on Facebook', 
            'icon' => 'icon-facebook',
            );

          }
     }
        new Redux_Framework_pinnacle_config();

}

function kadence_override_redux_icons_css() {
  wp_dequeue_style( 'redux-css' );
  wp_register_style('redux-custom-css', get_template_directory_uri() . '/themeoptions/options_assets/css/style.css', false, 100);    
  wp_enqueue_style('redux-custom-css');
  wp_dequeue_style( 'redux-elusive-icon' );
  wp_dequeue_style( 'redux-elusive-icon-ie7' );
}

add_action('redux-enqueue-pinnacle', 'kadence_override_redux_icons_css');


