<?php
/**
 * Plugin Name: Post Word Count in Admin List
 * Plugin URI:  https://github.com/dietrichmd/wordpress_plugins
 * Description: Adds a column to the posts list displaying the word count of each post.
 * Version: 1.0
 * Author: Vestra Interactive
 * Author URI: https://vestrainteractive.com
 * License: GPLv2 or later
 */

// Function to add the word count column
function add_word_count_column( $columns ) {
  $columns['word_count'] = 'Word Count';
  return $columns;
}

// Function to display the word count in the column
function display_word_count_column( $column_name, $post_id ) {
  if ( $column_name === 'word_count' ) {
    $content = get_post_field( 'post_content', $post_id );
    $word_count = str_word_count( strip_tags( $content ) );
    echo $word_count;
  }
}

// Add actions to manage the columns
add_filter( 'manage_posts_columns', 'add_word_count_column' );
add_action( 'manage_posts_custom_column', 'display_word_count_column', 10, 2 );


// Include the GitHub Updater class
if ( file_exists( plugin_dir_path( __FILE__ ) . 'class-github-updater.php' ) ) {
    require_once plugin_dir_path( __FILE__ ) . 'class-github-updater.php';
}

// Initialize the updater
add_action( 'init', function() {
    new GitHub_Updater( 'post-wordcount', 'vestrainteractive/post-wordcount' ); // Replace with your plugin slug and folder name
});

?>
