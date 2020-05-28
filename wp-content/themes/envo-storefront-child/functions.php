<?php
if (!function_exists('envo_storefront_generate_construct_footer')) :
    /**
     * Build footer
     */
    add_action('envo_storefront_generate_footer', 'envo_storefront_generate_construct_footer');

    function envo_storefront_generate_construct_footer()
    {
?>
        <div class="footer-credits-text text-center">
            <?php
            /* translators: %s: WordPress name with wordpress.org URL */
            printf(esc_html__('Proudly powered by %s', 'envo-storefront'), '<a href="' . esc_url(__('https://www.facebook.com/mohamed.farag.33671/', 'envo-storefront')) . '">' . esc_html__('Mohamed Farag', 'envo-storefront') . '</a>');
            ?>
        </div>
<?php
    }

endif;

function custom_excerpt($post_excerpt)
{
    $newExcerpt = $post_excerpt . "<a href='#' >Read more ...</a> ";
    return $newExcerpt;
}
add_filter('the_excerpt', 'custom_excerpt');

add_action('wp_head', 'custom_theme_meta');

function custom_theme_meta()
{
    echo '<meta name="author" content="mohamed farag">';
}

add_action('init', 'create_post_type');
function create_post_type()
{
    register_post_type(
        'book',
        array(
            'labels'      => array(
                'name'          => __('Books'),
                'all_items'     => __('All Books'),
                'new_item'      => __('New Book'),
                'add_new_item'  => __('Add New Book'),
                'edit_item'     => __('Edit Book'),
                'singular_name' => __('Book'),
            ),
            'public'      => true,
            'has_archive' => true,
            'rewrite'     => array('slug' => 'book'),
            'supports'    => array('title', 'editor', 'author', 'thumbnail', 'excerpt')
        )
    );
}

add_action('init', 'create_custom_tax');
function create_custom_tax()
{
    $args = array(
        'label' => __('Genre'),
        //hierarchical true is like categories
        'hierarchical' => true,
    );
    register_taxonomy('genre', 'book', $args);
}
