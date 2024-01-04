(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

	// Add this JavaScript code for dynamic question navigation
	jQuery(document).ready(function($) {
		var currentQuestion = 0;

		$('#add-question-btn').on('click', function() {
			// Add logic to dynamically load questions using AJAX or other method
			// For simplicity, let's assume the questions are preloaded on page load
			loadQuestion(currentQuestion);
		});

		function loadQuestion(questionNumber) {
			// Implement logic to dynamically load question and display it
			// For simplicity, let's assume the question content is predefined
			var questionContent = "Question " + (questionNumber + 1) + ": What is your answer?";
			var radioOptions = '<input type="radio" name="answer" value="option1"> Option 1<br>';
			radioOptions += '<input type="radio" name="answer" value="option2"> Option 2<br>';
			// Add more radio options as needed

			var questionHTML = '<div class="question">' +
				'<p>' + questionContent + '</p>' +
				radioOptions +
				'<button class="next-question-btn">Next</button>' +
				'</div>';

			$('#questions-container').html(questionHTML);

			// Add event listener for the "Next" button
			$('.next-question-btn').on('click', function() {
				// Add logic to handle user's answer, show image, and load next question
				processAnswer(questionNumber);
				currentQuestion++;
				loadQuestion(currentQuestion);
			});
		}

		function processAnswer(questionNumber) {
			// Implement logic to handle user's answer, show image, etc.
			// For simplicity, let's assume the answer is processed on the server side
			// and the selected image URL is returned
			var selectedAnswer = $('input[name="answer"]:checked').val();

			// AJAX call to process answer and get image URL
			// Example AJAX call (this is just a placeholder, actual implementation may vary)
			$.ajax({
				url: ajax_object.ajax_url, // ajax_object is localized in WordPress
				type: 'POST',
				data: {
					action: 'process_answer',
					question_number: questionNumber,
					selected_answer: selectedAnswer,
				},
				success: function(response) {
					// Display the selected image in the result container
					$('#result-container').append('<img src="' + response.image_url + '" alt="Answer Image">');
				},
				error: function(error) {
					console.log(error);
				}
			});
		}
	});


})( jQuery );
