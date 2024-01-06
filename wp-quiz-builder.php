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
 * Version:           1.0.2
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
    <div id="quiz-container" class="quiz-container">

        <div id="qsection" class="question-wrapper">
            <div id="q1" class="question-container">
                <div id="qmain1" class="main-question">
                    <span class="title">Question 1: Since you began to play the clarinet have you always had a brighter sound, darker sound, or neither a bright or dark sound?</span>
                    <div class="answers">
                        <div id="q1a1" class="answer" onclick="tickanswer(this,'qmain1','yes')">
                            <span class="text">Brighter Sound</span>
                            <span class="fancy-icon"><span class="material-symbols-outlined">done</span></span>
                        </div>
                        <div id="q1a2" class="answer" onclick="tickanswer(this,'qmain1','yes')">
                            <span class="text">Darker Sound</span>
                            <span class="fancy-icon"><span class="material-symbols-outlined">done</span></span>
                        </div>
                        <div id="q1a3" class="answer" onclick="tickanswer(this,'qmain1','yes')">
                            <span class="text">Neither Bright or Dark</span>
                            <span class="fancy-icon"><span class="material-symbols-outlined">done</span></span>
                        </div>
                    </div>
                    <div class="question-nav">
                        <span></span>
                        <span class="material-symbols-outlined next hide" onclick="selectring('qmain1','next')">arrow_forward</span>
                    </div>
                </div>
                <div id="q1sub1" class="sub-question q1a1 hide">
                    <span class="title">Choose to add a Brown Color-Ring</span>
                    <div class="answers">
                        <div id="q1asub1" class="answer" onclick="tickanswer(this,'q1sub1','no')">
                            <span class="text">Brighter Sound</span>
                            <span class="fancy-icon"><span class="material-symbols-outlined">done</span></span><br>
                            <img class="answerimage" src="/wp-content/plugins/wp-quiz-builder/public/assets/brown.png" alt="Brown Color-Ring">
                        </div>
                    </div>
                    <div class="question-nav">
                        <span class="material-symbols-outlined prev" onclick="selectring('qmain1','prev','q1asub1')">arrow_back</span>
                        <button class="btn qnav submit" onclick="selectring('qmain1','submit','q1asub1','q1','q2')">Submit</button>
                    </div>
                </div>
                <div id="q1sub2" class="sub-question q1a2 hide">
                    <span class="title">Choose to add a Red Color-Ring</span>
                    <div class="answers">
                        <div id="q1asub2" class="answer" onclick="tickanswer(this,'q1sub2','no')">
                            <span class="text">Darker Sound</span>
                            <span class="fancy-icon"><span class="material-symbols-outlined">done</span></span><br>
                            <img class="answerimage" src="/wp-content/plugins/wp-quiz-builder/public/assets/red.png" alt="Red Color-Ring">
                        </div>
                    </div>
                    <div class="question-nav">
                        <span class="material-symbols-outlined prev" onclick="selectring('qmain1','prev','q1asub2')">arrow_back</span>
                        <button class="btn qnav submit" onclick="selectring('qmain1','submit','q1asub2','q1','q2')">Submit</button>
                    </div>
                </div>
                <div id="q1sub3" class="sub-question q1a3 hide">
                    <span class="title">Choose to add both a Red and Brown Color-Ring</span>
                    <div class="answers">
                        <div id="q1asub3" class="answer" onclick="tickanswer(this,'q1sub3','no')">
                            <span class="text">Neither Bright or Dark</span>
                            <span class="fancy-icon"><span class="material-symbols-outlined">done</span></span><br>
                            <img class="answerimage" src="/wp-content/plugins/wp-quiz-builder/public/assets/red-and-brown.png" alt="Red Color-Ring">
                        </div>
                    </div>
                    <div class="question-nav">
                        <span class="material-symbols-outlined prev" onclick="selectring('qmain1','prev','q1asub3')">arrow_back</span>
                        <button class="btn qnav submit" onclick="selectring('qmain1','submit','q1asub3','q1','q2')">Submit</button>
                    </div>
                </div>
            </div>

            <div id="q2" class="question-container hide">
                <div id="qmain2" class="main-question">
                    <span class="title">Question 2: Do you wish your sound could be more even and smooth all the way up?</span>
                    <div class="answers">
                        <div id="q2a1" class="answer" onclick="tickanswer(this,'qmain2','yes')">
                            <span class="text">Yes</span>
                            <span class="fancy-icon"><span class="material-symbols-outlined">done</span></span>
                        </div>
                        <div id="q2a2" class="answer" onclick="tickanswer(this,'qmain2','no')">
                            <span class="text">No</span>
                            <span class="fancy-icon"><span class="material-symbols-outlined">done</span></span>
                        </div>
                    </div>
                    <div class="row question-nav">
                        <div class="col-6"></div>
                        <div class="col-6 p-0">
                            <span class="material-symbols-outlined next hide" onclick="selectring('qmain2','next')">arrow_forward</span><button class="btn qnav submit hide" onclick="selectring('qmain2','submit','','q2','q3')">Submit</button>
                        </div>
                    </div>
                </div>
                <div id="q2sub1" class="sub-question q2a1 hide">
                    <span class="title">Choose to add a Green Color-Ring</span>
                    <div class="answers">
                        <div id="q2asub1" class="answer" onclick="tickanswer(this,'q2sub1','yes')">
                            <span class="text">Yes</span>
                            <span class="fancy-icon"><span class="material-symbols-outlined">done</span></span><br>
                            <img class="answerimage" src="/wp-content/plugins/wp-quiz-builder/public/assets/green.png" alt="Green Color-Ring">
                        </div>
                    </div>
                    <div class="question-nav">
                        <span class="material-symbols-outlined prev" onclick="selectring('qmain2','prev','q2asub1')">arrow_back</span>
                        <button class="btn qnav submit" onclick="selectring('qmain2','submit','q2asub1','q2','q3')">Submit</button>
                    </div>
                </div>
            </div>

            <div id="q3" class="question-container hide">
                <div id="qmain3" class="main-question">
                    <span class="title">Question 3: Do you play with a lot of air and need to feel like your instrument will take all of the air you use?</span>
                    <div class="answers">
                        <div id="q3a1" class="answer" onclick="tickanswer(this,'qmain3','yes')">
                            <span class="text">Yes</span>
                            <span class="fancy-icon"><span class="material-symbols-outlined">done</span></span>
                        </div>
                        <div id="q3a2" class="answer" onclick="tickanswer(this,'qmain3','no')">
                            <span class="text">No</span>
                            <span class="fancy-icon"><span class="material-symbols-outlined">done</span></span>
                        </div>
                    </div>
                    <div class="question-nav">
                        <div class="col-6"></div>
                        <div class="col-6 p-0">
                            <span class="material-symbols-outlined next hide" onclick="selectring('qmain3','next')">arrow_forward</span><button class="btn qnav submit hide" onclick="selectring('qmain3','submit','','q3','q4')">Submit</button>
                        </div>
                    </div>
                </div>
                <div id="q3sub1" class="sub-question q3a1 hide">
                    <span class="title">Choose to add a Purple Color-Ring</span>
                    <div class="answers">
                        <div id="q3asub1" class="answer" onclick="tickanswer(this,'q3sub1','yes')">
                            <span class="text">Yes</span>
                            <span class="fancy-icon"><span class="material-symbols-outlined">done</span></span><br>
                            <img class="answerimage" src="/wp-content/plugins/wp-quiz-builder/public/assets/purple.png" alt="Purple Color-Ring">
                        </div>
                    </div>
                    <div class="question-nav">
                        <span class="material-symbols-outlined prev" onclick="selectring('qmain3','prev','q3asub1')">arrow_back</span>
                        <button class="btn qnav submit" onclick="selectring('qmain3','submit','q3asub1','q3','q4')">Submit</button>
                    </div>
                </div>
            </div>

            <div id="q4" class="question-container hide">
                <div id="qmain4" class="main-question">
                    <span class="title">Question 4: Do you wish your sound was sweeter?</span>
                    <div class="answers">
                        <div id="q4a1" class="answer" onclick="tickanswer(this,'qmain4','yes')">
                            <span class="text">Yes</span>
                            <span class="fancy-icon"><span class="material-symbols-outlined">done</span></span>
                        </div>
                        <div id="q4a2" class="answer" onclick="tickanswer(this,'qmain4','no')">
                            <span class="text">No</span>
                            <span class="fancy-icon"><span class="material-symbols-outlined">done</span></span>
                        </div>
                    </div>
                    <div class="question-nav">
                        <div class="col-6"></div>
                        <div class="col-6 p-0">
                            <span class="material-symbols-outlined next hide" onclick="selectring('qmain4','next')">arrow_forward</span><button class="btn qnav submit hide" onclick="selectring('qmain4','submit','','q4','q5')">Submit</button>
                        </div>
                    </div>
                </div>
                <div id="q4sub1" class="sub-question q4a1 hide">
                    <span class="title">Choose to add a Pink Color-Ring</span>
                    <div class="answers">
                        <div id="q4asub1" class="answer" onclick="tickanswer(this,'q4sub1','yes')">
                            <span class="text">Yes</span>
                            <span class="fancy-icon"><span class="material-symbols-outlined">done</span></span><br>
                            <img class="answerimage" src="/wp-content/plugins/wp-quiz-builder/public/assets/pink.png" alt="Pink Color-Ring">
                        </div>
                    </div>
                    <div class="question-nav">
                        <span class="material-symbols-outlined prev" onclick="selectring('qmain4','prev','q4asub1')">arrow_back</span>
                        <button class="btn qnav submit" onclick="selectring('qmain4','submit','q4asub1','q4','q5')">Submit</button>
                    </div>
                </div>
            </div>

            <div id="q5" class="question-container hide">
                <div id="qmain5" class="main-question">
                    <span class="title">Question 5: Do you wish your sound had more resonance in it?</span>
                    <div class="answers">
                        <div id="q5a1" class="answer" onclick="tickanswer(this,'qmain5','yes')">
                            <span class="text">Yes</span>
                            <span class="fancy-icon"><span class="material-symbols-outlined">done</span></span>
                        </div>
                        <div id="q5a2" class="answer" onclick="tickanswer(this,'qmain5','no')">
                            <span class="text">No</span>
                            <span class="fancy-icon"><span class="material-symbols-outlined">done</span></span>
                        </div>
                    </div>
                    <div class="question-nav">
                        <div class="col-6"></div>
                        <div class="col-6 p-0">
                            <span class="material-symbols-outlined next hide" onclick="selectring('qmain5','next')">arrow_forward</span><button class="btn qnav submit hide" onclick="selectring('qmain3','submit','','q5','result')">Submit</button>
                        </div>
                    </div>
                </div>
                <div id="q5sub1" class="sub-question q5a1 hide">
                    <span class="title">Choose to add a Orange Color-Ring</span>
                    <div class="answers">
                        <div id="q5asub1" class="answer" onclick="tickanswer(this,'q5sub1','yes')">
                            <span class="text">Yes</span>
                            <span class="fancy-icon"><span class="material-symbols-outlined">done</span></span><br>
                            <img class="answerimage" src="/wp-content/plugins/wp-quiz-builder/public/assets/orange.png" alt="Orange Color-Ring">
                        </div>
                    </div>
                    <div class="question-nav">
                        <span class="material-symbols-outlined prev" onclick="selectring('qmain5','prev','q5asub1')">arrow_back</span>
                        <button class="btn qnav submit" onclick="selectring('qmain5','submit','q5asub1','q5','result')">Submit</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="imgsidebar" class="image-wrapper">
            <span class="title">Selected Rings</span>
            <div id="image-container"></div>
        </div>

        <div id="result" class="result-container hide p-3 ">
            <div id="printarea" class="container">
                <div class="row">
                    <div class="col" style="text-align: center;">
                        <img src="/wp-content/plugins/wp-quiz-builder/public/assets/getserio-logo.png" alt="getserio" style="max-height: 100px;margin-bottom: 30px;margin-top: 30px;"><br>
                        <span class="title">Your color-ring choices are:</span>
                    </div>
                </div>
                <div class="row mt-3">
                    <div id="resultimages" class="col">

                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col" style="text-align: center;">
                    <span class="title2">You can print or download your selection</span>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col" style="text-align: left;">
                    <button class="btn m-4" onclick="printDiv()">Print</button><button class="btn m-4" onclick="downloadPDF()">Download PDF</button>
                </div>
            </div>
        </div>
    </div>
    
    <?php
    return ob_get_clean();
}

add_shortcode('quiz', 'quiz_shortcode');