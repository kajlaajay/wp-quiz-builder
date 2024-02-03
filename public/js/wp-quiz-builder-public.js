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


function startquiz(quizclass,titleid)
{
	var quiz = document.getElementsByClassName(quizclass);
	quiz[0].classList.remove("hide");
	document.getElementById(titleid).classList.add("hide");
}

function tickanswer(e,id,action,curques,nextques)
{
	var mainElement = document.getElementById(id);
	// document.querySelector('#'+id+' .submit').classList.add("hide");

	if (mainElement) {
		var answersElement = mainElement.querySelector('.answers');

		if (answersElement) {
			var allAnswerElements = answersElement.querySelectorAll('.answer');

			allAnswerElements.forEach(function(element) {
				if(element === e)
				{
					element.classList.toggle('selected');
				}
				else
				{
					element.classList.remove('selected');
				}
			});

			var allAnsImg = answersElement.querySelectorAll('.ansimg');

			allAnsImg.forEach(function(element) {
				if(element.classList.contains(e.id))
				{
					element.classList.toggle('hide');
				}
				else
				{
					element.classList.add('hide');
				}
			});

			var allAnsNo = answersElement.querySelectorAll('.ansno');

			allAnsNo.forEach(function(element) {
				if(element.classList.contains(e.id))
				{
					element.classList.toggle('hide');
				}
				else
				{
					element.classList.add('hide');
				}
			});
		}
	}

	setTimeout(function() {
		var count = 0;
		var answersElement = mainElement.querySelector('.answers');
		var allAnswerElements = answersElement.querySelectorAll('.answer');
		allAnswerElements.forEach(function(element) 
		{
			if(element.classList.contains('selected'))
			{
				count++;
			}
		});

		if(count > 0){
			document.querySelector('#'+id+' .submit').classList.remove("hide");
			allAnswerElements.forEach(function(element) 
			{
				if(!element.classList.contains('selected'))
				{
					document.querySelector('#'+element.id).classList.add("hide");
				}
			});
		}
		else
		{
			allAnswerElements.forEach(function(element) 
			{
				if(!element.classList.contains('selected'))
				{
					document.querySelector('#'+element.id).classList.remove("hide");
				}
			});
			document.querySelector('#'+id+' .submit').classList.add("hide");
		}
	}, 0);
	
	if(action == "yes")
	{
		document.querySelector('#'+id+' .submit').setAttribute("onclick", "selectring('"+id+"','submit','"+e.id+"','"+curques+"','"+nextques+"')");
	}
	else
	{
		document.querySelector('#'+id+' .submit').setAttribute("onclick", "selectring('"+id+"','submit','','"+curques+"','"+nextques+"')");
	}

	// document.querySelector('#'+id+' .'+e.id).classList.toggle("hide");

}


var answers = [];
function selectring(id,action,subid,curques,nextques)
{
	if(subid != "")
	{
		var imgelement = document.querySelectorAll('.'+subid+' .answerimage');
		document.getElementById('imgsidebar').classList.remove('hide');

		answers.push([imgelement[0].src]);
		console.log(answers);

		document.getElementsByClassName('image-container').innerHTML = "";
		var out = "";
		answers.forEach(function(value) {
			out += `<div class="selectedanswer"><span class="answerimage"><img class="selansimage" src="${value[0]}"></span></div>`;
		})

		document.getElementById('image-container').innerHTML = out;
	}
	document.getElementById(curques).classList.add("hide");
	
	if(nextques != "result")
	{
		document.getElementById(nextques).classList.remove("hide");
	}
	else
	{
		document.getElementById('qsection').classList.add("hide");
		document.getElementById('imgsidebar').classList.add("hide");
		document.getElementById(nextques).classList.remove("hide");
		var out = "";
		answers.forEach(function(value) {
			out += `<div class="selectedanswer"><span class="answerimage"><img class="selansimage" src="${value[0]}" height="100"></span></div>`;
		})

		document.getElementById('resultimages').innerHTML = out;
	}
}






// function tickanswer(e,id,action)
// {
// 	var mainElement = document.getElementById(id);

// 	if(action == "yes")
// 	{
// 		if (mainElement) {
// 			var answersElement = mainElement.querySelector('.answers');

// 			if (answersElement) {
// 				var allAnswerElements = answersElement.querySelectorAll('.answer');

// 				allAnswerElements.forEach(function(element) {
// 					element.classList.toggle('selected', element === e);
// 				});

// 			}
// 		}

// 		document.querySelector('#'+id+' .next').classList.remove("hide");
// 		document.querySelector('#'+id+' .submit').classList.add("hide");
// 	}
// 	else if(action == "no")
// 	{
// 		if (mainElement) {
// 			var answersElement = mainElement.querySelector('.answers');

// 			if (answersElement) {
// 				var allAnswerElements = answersElement.querySelectorAll('.answer');

// 				allAnswerElements.forEach(function(element) {
// 					element.classList.toggle('selected', element === e);
// 				});

// 			}
// 		}
		
// 		document.querySelector('#'+id+' .next').classList.add("hide");
// 		document.querySelector('#'+id+' .submit').classList.remove("hide");
// 	}
// }

// var answers = [];
// function selectring(id,action,subid,curques,nextques)
// {
// 	var mainElement = document.getElementById(id);
	
// 	if(action == "next")
// 	{
// 		var selectedElementId = "";
// 		if (mainElement) 
// 		{
// 			var allAnswerElements = mainElement.querySelectorAll('.answer');
// 			for (var i = 0; i < allAnswerElements.length; i++) {
// 				if (allAnswerElements[i].classList.contains('selected')) {
// 					selectedElementId = allAnswerElements[i].id;
// 					break;
// 				}
// 			}
// 		}

// 		if(selectedElementId != "")
// 		{
// 			mainElement.classList.add('hide');
// 		}
// 		else
// 		{
// 			alert("Please select the answer first");
// 		}

// 		var subQuestions = document.querySelectorAll('.question-container .sub-question');
// 		subQuestions.forEach(function(subQuestion) {

// 			if (!subQuestion.classList.contains(selectedElementId)) {
// 				subQuestion.classList.add('hide');
// 			}
// 			else
// 			{
// 				subQuestion.classList.remove('hide');
// 			}

// 		});
// 	}
// 	else if(action == "prev")
// 	{
// 		mainElement.classList.remove('hide');
// 		var subQuestions = document.querySelectorAll('.question-container .sub-question');
// 		subQuestions.forEach(function(subQuestion) {

// 			if (!subQuestion.classList.contains(id)) {
// 				subQuestion.classList.add('hide');
// 			}

// 		});

// 		var subqans = document.getElementById(subid);
// 		subqans.classList.remove('selected');

// 	}
// 	else if(action == "submit")
// 	{
// 		if(subid != "")
// 		{
// 			var imgelement = document.querySelectorAll('#'+subid+' .answerimage');

// 			answers.push([imgelement[0].src]);
// 			console.log(answers);

// 			document.getElementsByClassName('image-container').innerHTML = "";
// 			var out = "";
// 			answers.forEach(function(value) {
// 				out += `<div class="selectedanswer"><span class="answerimage"><img class="selansimage" src="${value[0]}"></span></div>`;
// 			})

// 			document.getElementById('image-container').innerHTML = out;
// 			console.log("curques: "+curques);
// 			console.log("nextques: "+nextques);
// 			document.getElementById(curques).classList.add("hide");
			
// 			if(nextques != "result")
// 			{
// 				document.getElementById(nextques).classList.remove("hide");
// 			}
// 			else
// 			{
// 				document.getElementById('qsection').classList.add("hide");
// 				document.getElementById('imgsidebar').classList.add("hide");
// 				document.getElementById(nextques).classList.remove("hide");
// 				var out = "";
// 				answers.forEach(function(value) {
// 					out += `<div class="selectedanswer"><span class="answerimage"><img class="selansimage" src="${value[0]}" height="150"></span></div>`;
// 				})

// 				document.getElementById('resultimages').innerHTML = out;
// 			}
// 		}
// 		else if(subid == "")
// 		{
// 			document.getElementById(curques).classList.add("hide");
			
// 			if(nextques != "result")
// 			{
// 				document.getElementById(nextques).classList.remove("hide");
// 			}
// 			else
// 			{
// 				document.getElementById('qsection').classList.add("hide");
// 				document.getElementById('imgsidebar').classList.add("hide");
// 				document.getElementById(nextques).classList.remove("hide");
// 				var out = "";
// 				answers.forEach(function(value) {
// 					out += `<div class="selectedanswer"><span class="answerimage"><img class="selansimage" src="${value[0]}" height="150"></span></div>`;
// 				})

// 				document.getElementById('resultimages').innerHTML = out;
// 			}
// 		}
// 	}
// }


// window.html2canvas = html2canvas;

function downloadPDF() 
{
	var date = new Date();
	var datetime = date.getFullYear()+"-"+(date.getMonth()+1)+"-"+ date.getDate()+"-"+date.getHours()+"-"+date.getMinutes()+"-"+ date.getSeconds();
	window.jsPDF = window.jspdf.jsPDF;
	const pdf = new jsPDF();
	const element = document.getElementById('printarea');

	// Add the content to the PDF
	pdf.html(element, {
		callback: function(doc) {
			// Save the PDF
			doc.save('color-ring-quiz-result-'+datetime+'.pdf');
		},
		x: 30,
		y: 15,
		width: 150, //target width in the PDF document
		windowWidth: 650 //window width in CSS pixels
	});
}

function printDiv() 
{
	const printContents = document.getElementById('printarea');
	const originalContents = document.body.innerHTML;

	document.body.innerHTML = printContents.innerHTML;
	setTimeout(function() {
		window.print();
		document.body.innerHTML = originalContents;
	}, 1);
}




	// else if(action == "submit")
	// {
	// 	if(subid != "")
	// 	{
	// 		var nameelement = document.querySelectorAll('#'+subid+' .text');
	// 		var imgelement = document.querySelectorAll('#'+subid+' .answerimage');

	// 		answers.push([nameelement[0].innerHTML,imgelement[0].src]);
	// 		console.log(answers);

	// 		document.getElementsByClassName('image-container').innerHTML = "";
	// 		var out = "";
	// 		answers.forEach(function(value) {
	// 			out += `<div class="selectedanswer"><span class="answerimage"><img class="selansimage" src="${value[1]}"></span><span class="text">${value[0]}</span></div>`;
	// 			// $('.image-container').append(out);
	// 		})

	// 		document.getElementById('image-container').innerHTML = out;
	// 		console.log("curques: "+curques);
	// 		console.log("nextques: "+nextques);
	// 		document.getElementById(curques).classList.add("hide");
	// 		document.getElementById(nextques).classList.remove("hide");
	// 	}
	// 	else if(subid != "")
	// 	{
	// 		document.getElementById(curques).classList.add("hide");
	// 		document.getElementById(nextques).classList.remove("hide");
	// 	}
	// }