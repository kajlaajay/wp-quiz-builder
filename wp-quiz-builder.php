<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://digibysr.com/about/our-team/
 * @since             1.0.0
 * @package           Wp_Quiz_Builder
 *
 * @wordpress-plugin
 * Plugin Name:       WP Quiz Builder
 * Plugin URI:        https://digibysr.com
 * Description:       Logical & Sequential quiz builder
 * Version:           1.0.0
 * Author:            Ajay Kajla
 * Author URI:        https://digibysr.com/about/our-team//
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp-quiz-builder
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'WP_QUIZ_BUILDER_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wp-quiz-builder-activator.php
 */
function activate_wp_quiz_builder() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-quiz-builder-activator.php';
	Wp_Quiz_Builder_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wp-quiz-builder-deactivator.php
 */
function deactivate_wp_quiz_builder() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-quiz-builder-deactivator.php';
	Wp_Quiz_Builder_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wp_quiz_builder' );
register_deactivation_hook( __FILE__, 'deactivate_wp_quiz_builder' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wp-quiz-builder.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wp_quiz_builder() {

	$plugin = new Wp_Quiz_Builder();
	$plugin->run();

}
run_wp_quiz_builder();

function enqueue_plugin_styles_and_scripts() {
    // Enqueue Bootstrap CSS if not already registered
    if (!wp_style_is('bootstrap', 'enqueued')) {
        wp_enqueue_style('bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css');
    }

    // Enqueue Google Icons CSS if not already registered
    if (!wp_style_is('google-icons', 'enqueued')) {
        wp_enqueue_style('google-icons', 'https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0');
    }

    // Enqueue Bootstrap JS if not already registered
    if (!wp_script_is('bootstrap-js', 'enqueued')) {
        wp_enqueue_script('bootstrap-js', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js', array('jquery'), '', true);
    }
}

add_action('wp_enqueue_scripts', 'enqueue_plugin_styles_and_scripts');


// Create admin page
function quiz_admin_page() {
    add_menu_page('WP Quiz Builder', 'WP Quiz Builder', 'manage_options', 'quiz-plugin-admin', 'quiz_admin_page_content');
}

add_action('admin_menu', 'quiz_admin_page');

function quiz_admin_page_content() {
    ?>
    <div class="wrap">
        <h1>WP Quiz Builder</h1>
        <h4>Shortcode: <code>[quiz]</code></h4>
        <!-- <button id="add-question-btn">Add Question</button> -->
        <div id="questions-container">
            <!-- Questions will be added dynamically here -->
        </div>
        
    </div>
    <?php
}

// Shortcode for displaying the quiz on frontend
function quiz_shortcode() {
    ob_start();
    ?>
    <div id="quiz-container" class="quiz-container">
        <div class="question-wrapper">
            <div id="q1" class="question-container">
                <div id="qmain1" class="main-question">
                    <span class="title">Since you began to play the clarinet have you always had a brighter sound, darker sound, or neither a bright or dark sound?</span>
                    <div class="answers">
                        <div id="q1a1" class="answer" onclick="tickanswer(this,'qmain1')">
                            <span class="text">Brighter Sound</span>
                            <span class="fancy-icon"><span class="material-symbols-outlined">done</span></span>
                        </div>
                        <div id="q1a2" class="answer" onclick="tickanswer(this,'qmain1')">
                            <span class="text">Darker Sound</span>
                            <span class="fancy-icon"><span class="material-symbols-outlined">done</span></span>
                        </div>
                        <div id="q1a3" class="answer" onclick="tickanswer(this,'qmain1')">
                            <span class="text">Neither Bright or Dark</span>
                            <span class="fancy-icon"><span class="material-symbols-outlined">done</span></span>
                        </div>
                    </div>
                    <div class="question-nav">
                        <span></span>
                        <span class="material-symbols-outlined next" onclick="selectring('qmain1','next')">arrow_forward</span>
                    </div>
                </div>
                <div id="q1sub1" class="sub-question q1a1 hide">
                    <span class="title">Choose to add a Brown Color-Ring</span>
                    <div class="answers">
                        <div id="q1asub1" class="answer" onclick="tickanswer(this,'q1sub1')">
                            <span class="text">Brighter Sound</span>
                            <span class="fancy-icon"><span class="material-symbols-outlined">done</span></span>
                            <img class="answerimage" src="http://localhost/wp-plugin-creator/wp-content/uploads/2024/01/brown.png" alt="Brown Color-Ring">
                        </div>
                    </div>
                    <div class="question-nav">
                        <span class="material-symbols-outlined prev" onclick="selectring('qmain1','prev','q1asub1')">arrow_back</span>
                        <button class="btn qnav submit" onclick="selectring('qmain1','submit','q1asub1')">Submit</button>
                    </div>
                </div>
                <div id="q1sub2" class="sub-question q1a2 hide">
                    <span class="title">Choose to add a Red Color-Ring</span>
                    <div class="answers">
                        <div id="q1asub2" class="answer" onclick="tickanswer(this,'q1sub2')">
                            <span class="text">Darker Sound</span>
                            <span class="fancy-icon"><span class="material-symbols-outlined">done</span></span>
                            <img class="answerimage" src="http://localhost/wp-plugin-creator/wp-content/uploads/2024/01/red.png" alt="Red Color-Ring">
                        </div>
                    </div>
                    <div class="question-nav">
                        <span class="material-symbols-outlined prev" onclick="selectring('qmain1','prev','q1asub2')">arrow_back</span>
                        <button class="btn qnav submit" onclick="selectring('qmain1','submit','q1asub2')">Submit</button>
                    </div>
                </div>
                <div id="q1sub3" class="sub-question q1a3 hide">
                    <span class="title">Choose to add both a Red and Brown Color-Ring</span>
                    <div class="answers">
                        <div id="q1asub3" class="answer" onclick="tickanswer(this,'q1sub3')">
                            <span class="text">Neither Bright or Dark</span>
                            <span class="fancy-icon"><span class="material-symbols-outlined">done</span></span>
                            <img class="answerimage" src="http://localhost/wp-plugin-creator/wp-content/uploads/2024/01/red-and-brown.png" alt="Red Color-Ring">
                        </div>
                    </div>
                    <div class="question-nav">
                        <span class="material-symbols-outlined prev" onclick="selectring('qmain1','prev','q1asub3')">arrow_back</span>
                        <button class="btn qnav submit" onclick="selectring('qmain1','submit','q1asub3')">Submit</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="image-wrapper">
            <span class="title">Selected Rings</span>
            <div id="image-container"></div>
        </div>
        <div class="result-container hide">
            <span class="title">Hi quiz result here</span>
        </div>
    </div>
    
    <?php
    return ob_get_clean();
}

add_shortcode('quiz', 'quiz_shortcode');