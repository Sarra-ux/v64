<?php

if (!class_exists('WP_Customize_Control')) {
    return null;
}

class Business_One_Page_Multi_Image_Customize_Control extends WP_Customize_Control{
    
    public $type = 'multi-image';

    public function __construct( $manager, $id, $args = array() ) {
        parent::__construct( $manager, $id, $args );
    }

    public function enqueue(){
        
        $build  = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '/build' : '';
        $suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
        wp_enqueue_media();
        wp_enqueue_script( 'business-one-page-multi-image-control', get_template_directory_uri() . '/js' . $build . '/multi-image' . $suffix . '.js', array('jquery', 'jquery-ui-sortable'), '0.1.0', true );
        wp_enqueue_style( 'business-one-page-multi-image-control', get_template_directory_uri() . '/css' . $build . '/multi-image' . $suffix . '.css' );
    }
    
    public function render_content(){
        // get the set values if any
        $image_srcs = explode(',', $this->value());
        if ( ! is_array( $image_srcs ) ){
            $image_srcs = array();
        }
        $this->the_title();
        $this->the_buttons();
        $this->the_uploaded_images( $image_srcs );
    }
    
    protected function the_title(){ ?>
        <label>
            <span class="customize-control-title">
                <?php echo esc_html( $this->label ); ?>
            </span>
        </label>
        <?php
    }
    
    public function the_buttons(){ ?>
        <div>
            <input type="hidden" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); ?> class="multi-images-control-input"/>
            <a href="javascript:void(0);" class="button-secondary multi-images-upload">
                <?php esc_html_e( 'Upload', 'business-one-page' ); ?>
            </a>
            <a href="javascript:void(0);" class="button-secondary multi-images-remove">
                <?php esc_html_e( 'Remove all images', 'business-one-page' ); ?>
            </a>
        </div>
        <?php
    }
   
    public function the_uploaded_images( $srcs = array() ){ ?>
        <div class="customize-control-content">
            <ul class="thumbnails">
                <?php 
                if ( is_array( $srcs ) ){
                    foreach ( $srcs as $src ){
                        if ( $src != '' ){ ?>
                            <li class="thumbnail" style="background-image: url(<?php echo esc_url( $src ); ?>);" data-src="<?php echo esc_url( $src ); ?>" ></li>
                    <?php }
                    }
                }
                ?>
            </ul>
        </div>
        <?php
    }       
}