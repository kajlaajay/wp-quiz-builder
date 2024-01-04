(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
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

	

})( jQuery );

function tickanswer(e,id)
{
	var mainElement = document.getElementById(id);

	if (mainElement) {
		var answersElement = mainElement.querySelector('.answers');

		if (answersElement) {
			var allAnswerElements = answersElement.querySelectorAll('.answer');

			allAnswerElements.forEach(function(element) {
				element.classList.toggle('selected', element === e);
			});

		}
	}
}

var answers = [];
function selectring(id,action,subid)
{
	var mainElement = document.getElementById(id);
	
	if(action == "next")
	{
		var selectedElementId = "";
		if (mainElement) 
		{
			var allAnswerElements = mainElement.querySelectorAll('.answer');
			for (var i = 0; i < allAnswerElements.length; i++) {
				if (allAnswerElements[i].classList.contains('selected')) {
					selectedElementId = allAnswerElements[i].id;
					break;
				}
			}
		}

		if(selectedElementId != "")
		{
			mainElement.classList.add('hide');
		}
		else
		{
			alert("Please select the answer first");
		}

		var subQuestions = document.querySelectorAll('.question-container .sub-question');
		subQuestions.forEach(function(subQuestion) {

			if (!subQuestion.classList.contains(selectedElementId)) {
				subQuestion.classList.add('hide');
			}
			else
			{
				subQuestion.classList.remove('hide');
			}

		});
	}
	else if(action == "prev")
	{
		mainElement.classList.remove('hide');
		var subQuestions = document.querySelectorAll('.question-container .sub-question');
		subQuestions.forEach(function(subQuestion) {

			if (!subQuestion.classList.contains(id)) {
				subQuestion.classList.add('hide');
			}

		});

		var subqans = document.getElementById(subid);
		subqans.classList.remove('selected');

	}
	else if(action == "submit")
	{
		var nameelement = document.querySelectorAll('#'+subid+' .text');
		var imgelement = document.querySelectorAll('#'+subid+' .answerimage');

		answers.push([nameelement[0].innerHTML,imgelement[0].src]);
		console.log(answers);

		document.getElementsByClassName('image-container').innerHTML = "";
		var out = "";
		answers.forEach(function(value) {
			out += `<div class="selectedanswer"><span class="answerimage"><img class="selansimage" src="${value[1]}"></span><span class="text">${value[0]}</span></div>`;
			// $('.image-container').append(out);
		})

		document.getElementById('image-container').innerHTML = out;
	}
}