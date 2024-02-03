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
 * Description:       Logical & Sequential Quiz Builder
 * Version:           1.0.8
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
define( 'WP_QUIZ_BUILDER_VERSION', '1.0.8' );

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

    // Enqueue PDF JS if not already registered
    wp_enqueue_script('jspdf', 'https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js', array(), '', true);
    wp_enqueue_script('html2canvas', 'https://html2canvas.hertzen.com/dist/html2canvas.min.js', array(), '', true);

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
    <div id="title" class="row">
        <div class="col-md-12" style="text-align: center;">
            <div class="title">Color Ring Quiz</div>
            <div class="text">The purpose of this quiz is to figure out the best color ring combination for you when trying new instruments.</div>
            <div class="question-nav">
                <button class="btn qnav submit" onclick="startquiz('quiz-container','title')">Start Quiz</button>
            </div>
        </div>
    </div>
    <div id="quiz-container" class="quiz-container hide">

        <div id="qsection" class="question-wrapper">
            <div id="q1" class="question-container">
                <div id="qmain1" class="main-question">
                    <span class="title">Question 1: Since you began to play the clarinet have you always had a brighter sound, darker sound, or neither a bright or dark sound?</span>
                    <div class="answers">
                        <div id="q1a1" class="answer" onclick="tickanswer(this,'qmain1','yes','q1','q2')">
                            <span class="text">Brighter Sound</span>
                            <span class="fancy-icon"><span class="material-symbols-outlined">done</span></span>
                        </div>
                        <div class="q1a1 ansimg hide">
                            <span class="text">Choose to add a Brown Color Ring</span><br>
                            <img class="answerimage" src="/wp-content/plugins/wp-quiz-builder/public/assets/brown.png" alt="Brown Color Ring">
                        </div>
                        <div id="q1a2" class="answer" onclick="tickanswer(this,'qmain1','yes','q1','q2')">
                            <span class="text">Darker Sound</span>
                            <span class="fancy-icon"><span class="material-symbols-outlined">done</span></span>
                        </div>
                        <div class="q1a2 ansimg hide">
                            <span class="text">Choose to add a Red Color Ring</span><br>
                            <img class="answerimage" src="/wp-content/plugins/wp-quiz-builder/public/assets/red.png" alt="Red Color Ring">
                        </div>
                        <div id="q1a3" class="answer" onclick="tickanswer(this,'qmain1','yes','q1','q2')">
                            <span class="text">Neither Bright or Dark</span>
                            <span class="fancy-icon"><span class="material-symbols-outlined">done</span></span>
                        </div>
                        <div class="q1a3 ansimg hide">
                            <span class="text">Choose to add both a Red and Brown Color Ring</span><br>
                            <img class="answerimage double" src="/wp-content/plugins/wp-quiz-builder/public/assets/red-and-brown.png" alt="Red and Brown Color Ring">
                        </div>
                    </div>
                    <div class="question-nav">
                        <button class="btn qnav submit hide">Next</button>
                    </div>
                </div>
            </div>

            <div id="q2" class="question-container hide">
                <div id="qmain2" class="main-question">
                    <span class="title">Question 2: Do you wish your sound could be more even and smooth all the way up?</span>
                    <div class="answers">
                        <div id="q2a1" class="answer" onclick="tickanswer(this,'qmain2','yes','q2','q3')">
                            <span class="text">Yes</span>
                            <span class="fancy-icon"><span class="material-symbols-outlined">done</span></span>
                        </div>
                        <div class="q2a1 ansimg hide">
                            <span class="text">Add a Green Color Ring</span><br>
                            <img class="answerimage" src="/wp-content/plugins/wp-quiz-builder/public/assets/green.png" alt="Green Color Ring">
                        </div>
                        <div id="q2a2" class="answer" onclick="tickanswer(this,'qmain2','no','q2','q3')">
                            <span class="text">No</span>
                            <span class="fancy-icon"><span class="material-symbols-outlined">done</span></span>
                        </div>
                        <div class="q2a2 ansno hide">
                            <span class="text">No additional Color Ring is needed</span>
                        </div>
                    </div>
                    <div class="row question-nav">
                        <div class="col-6"></div>
                        <div class="col-6">
                            <button class="btn qnav submit hide">Next</button>
                        </div>
                    </div>
                </div>
            </div>

            <div id="q3" class="question-container hide">
                <div id="qmain3" class="main-question">
                    <span class="title">Question 3: Do you play with a lot of air and need to feel like your instrument will take all of the air you use?</span>
                    <div class="answers">
                        <div id="q3a1" class="answer" onclick="tickanswer(this,'qmain3','yes','q3','q4')">
                            <span class="text">Yes</span>
                            <span class="fancy-icon"><span class="material-symbols-outlined">done</span></span>
                        </div>
                        <div class="q3a1 ansimg hide">
                            <span class="text">Add a Purple Color Ring</span><br>
                            <img class="answerimage" src="/wp-content/plugins/wp-quiz-builder/public/assets/purple.png" alt="Purple Color Ring">
                        </div>
                        <div id="q3a2" class="answer" onclick="tickanswer(this,'qmain3','no','q3','q4')">
                            <span class="text">No</span>
                            <span class="fancy-icon"><span class="material-symbols-outlined">done</span></span>
                        </div>
                        <div class="q3a2 ansno hide">
                            <span class="text">No additional Color Ring is needed</span>
                        </div>
                    </div>
                    <div class="question-nav">
                        <button class="btn qnav submit hide">Next</button>
                    </div>
                </div>
            </div>

            <div id="q4" class="question-container hide">
                <div id="qmain4" class="main-question">
                    <span class="title">Question 4: Do you wish your sound was sweeter?</span>
                    <div class="answers">
                        <div id="q4a1" class="answer" onclick="tickanswer(this,'qmain4','yes','q4','q5')">
                            <span class="text">Yes</span>
                            <span class="fancy-icon"><span class="material-symbols-outlined">done</span></span>
                        </div>
                        <div class="q4a1 ansimg hide">
                            <span class="text">Add a Pink Color Ring</span><br>
                            <img class="answerimage" src="/wp-content/plugins/wp-quiz-builder/public/assets/pink.png" alt="Pink Color Ring">
                        </div>
                        <div id="q4a2" class="answer" onclick="tickanswer(this,'qmain4','no','q4','q5')">
                            <span class="text">No</span>
                            <span class="fancy-icon"><span class="material-symbols-outlined">done</span></span>
                        </div>
                        <div class="q4a2 ansno hide">
                            <span class="text">No additional Color Ring is needed</span>
                        </div>
                    </div>
                    <div class="question-nav">
                        <button class="btn qnav submit hide">Next</button>
                    </div>
                </div>
            </div>

            <div id="q5" class="question-container hide">
                <div id="qmain5" class="main-question">
                    <span class="title">Question 5: Do you wish your sound had more resonance in it?</span>
                    <div class="answers">
                        <div id="q5a1" class="answer" onclick="tickanswer(this,'qmain5','yes','q5','result')">
                            <span class="text">Yes</span>
                            <span class="fancy-icon"><span class="material-symbols-outlined">done</span></span>
                        </div>
                        <div class="q5a1 ansimg hide">
                            <span class="text">Add an Orange Color Ring</span><br>
                            <img class="answerimage" src="/wp-content/plugins/wp-quiz-builder/public/assets/orange.png" alt="Orange Color Ring">
                        </div>
                        <div id="q5a2" class="answer" onclick="tickanswer(this,'qmain5','no','q5','result')">
                            <span class="text">No</span>
                            <span class="fancy-icon"><span class="material-symbols-outlined">done</span></span>
                        </div>
                        <div class="q5a2 ansno hide">
                            <span class="text">No additional Color Ring is needed</span>
                        </div>
                    </div>
                    <div class="question-nav">
                        <button class="btn qnav submit hide">Submit</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="imgsidebar" class="image-wrapper hide">
            <span class="title">Selected Rings</span>
            <div id="image-container"></div>
        </div>

        <div id="result" class="result-container hide p-3 ">
            <div id="printarea" class="">
                <div class="row">
                    <div class="col" style="text-align: center;">
                        <img src="/wp-content/plugins/wp-quiz-builder/public/assets/getserio-logo.png" alt="getserio" style="max-height: 100px;margin-bottom: 30px;margin-top: 0px;"><br>
                        <span class="title"><b>Recap</b></span><br>
                        <span class="title">Your color ring choices are:</span>
                    </div>
                </div>
                <div class="row mt-3">
                    <div id="resultimages" class="col">

                    </div>
                </div>
                
            </div>
            <div class="row pdbuttons">
                <div class="col" style="text-align: center;">
                    <span class="title2">You can print or download your selection</span>
                </div>
            </div>
            <div class="row mt-2 mb-4">
                <div class="col" style="text-align: center;">
                    <button class="btn m-1" onclick="printDiv()">Print</button><button class="btn m-1" onclick="downloadPDF()">Download PDF</button>
                </div>
            </div>
        </div>
    </div>
    
    <?php
    return ob_get_clean();
}

add_shortcode('quiz', 'quiz_shortcode');