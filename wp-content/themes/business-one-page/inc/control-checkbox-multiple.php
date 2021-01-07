<?php
if ( ! class_exists( 'WP_Customize_Control' ) )
    return NULL;
/**
 * Multiple checkbox customize control class.
 *
 * @link http://justintadlock.com/archives/2015/05/26/multiple-checkbox-customizer-control
 */
class Business_One_Page_Customize_Control_Checkbox_Multiple extends WP_Customize_Control {

    /**
     * The type of customize control being rendered.
     * 
     * @var    string
     */
    public $type = 'checkbox-multiple';

    /**
     * Enqueue scripts/styles.
     *
     * @return void
     */
    public function enqueue() {
                                   
        $build  = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '/build' : '';
        $suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
        wp_enqueue_script( 'business-one-page-customize-controls', trailingslashit( get_template_directory_uri() ) . 'js' . $build . '/customize-controls' . $suffix . '.js', array( 'jquery' ) );
    }

    /**
     * Displays the control content.
     *
     * @return void
     */
    public function render_content() {

        if ( empty( $this->choices ) )
            return; ?>

        <?php if ( !empty( $this->label ) ) : ?>
            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
        <?php endif; ?>

        <?php if ( !empty( $this->description ) ) : ?>
            <span class="description customize-control-description"><?php echo wp_kses_post( $this->description ); ?></span>
        <?php endif; ?>

        <?php $multi_values = !is_array( $this->value() ) ? explode( ',', $this->value() ) : $this->value(); ?>

        <ul>
            <?php foreach ( $this->choices as $value => $label ) : ?>

                <li>
                    <label>
                        <input type="checkbox" value="<?php echo esc_attr( $value ); ?>" <?php checked( in_array( $value, $multi_values ) ); ?> /> 
                        <?php echo esc_html( $label ); ?>
                    </label>
                </li>

            <?php endforeach; ?>
        </ul>

        <input type="hidden" <?php $this->link(); ?> value="<?php echo esc_attr( implode( ',', $multi_values ) ); ?>" />
    <?php }
}