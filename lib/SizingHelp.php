<?php 

namespace VaBien;

class SizingHelp {

    public function __construct() {

        add_filter( 'gform_pre_render_2', array($this, 'populate_product_titles') );
        add_filter( 'gform_pre_validation_2', array($this, 'populate_product_titles') );
        add_filter( 'gform_pre_submission_filter_2', array($this, 'populate_product_titles') );
        add_filter( 'gform_admin_pre_render_2', array($this, 'populate_product_titles') );

    }

    public function populate_product_titles( $form ) {
 
        foreach ( $form['fields'] as &$field ) {
            if ( ($field->type != 'select' && $field->type != 'multiselect'  && $field->type != 'checkbox') || strpos( $field->cssClass, 'populate_product_titles' ) === false ) {
                    continue;
            }
            $field->placeholder = 'Select your designs';
    
            $args = [
                'posts_per_page'   => -1,
                'order'            => 'ASC',
                'orderby'          => 'post_title',
                'post_type'        => 'product', // Change this to your Custom Post Type
                'post_status'      => 'publish',
                'meta_query' => array(
                    array(
                        'key' => '_stock_status',
                        'value' => 'instock',
                        'compare' => '=',
                    )
                )
            ];
            $custom_posts = get_posts( $args );
    
            $options = [];
            
            foreach( $custom_posts as $custom_post ) {
                $options[] = ['text' => $custom_post->post_title, 'value' => $custom_post->post_title];
            }
    
            $field->choices = $options;
        }
        return $form;
    }
    
} // end class GM_WooCommerce_Account
$vabien_sizing_help = new SizingHelp();