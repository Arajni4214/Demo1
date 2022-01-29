	function requiredJSFunctions() {
		AOS.init();
		titlebar('0');
		contentRefresh();
		toolTip();
		hideInfoMessage();
		backToTop();
		changePaceColor();
		// logoutOnTimeOut();
	}
	String.prototype.includesCustom = function(char) {
		if(this.indexOf(char) === -1) return false;
		else return true;
	};
	function toolTip() {
		$('[data-toggle="tooltip"]').tooltip();
	}
	function boxHideShow(this_box) {
		$(this_box).closest('.box').boxWidget('toggle');
	}
	function setButtonValue(val) {
		$('#buttonValue').val(val.toLowerCase());
	}
	function clearIt(iD) {
		$('#'+iD).val('');
		$('#'+iD).removeAttr('value');
	}
	function settingValidationOptional(textboxID, divID, clearValue) {
		if(typeof(clearValue) == 'undefined') clearValue = '0';
		if(clearValue == '1') clearIt(textBoxID);
		$('#'+textboxID).attr('data-validation-optional', 'true');
		$('#'+divID).fadeOut(500);
	}
	function settingValidationBack(textboxID, divID) {
		$('#'+textboxID).attr('data-validation-optional', 'false');
		$('#'+divID).fadeIn(500);
	}
	function backToTop() {
		if($('#backtotop').length) {
			$(window).scroll(function() {
				if($(window).scrollTop() > '120') $('#backtotop').fadeIn(250).css('display', 'block');
				else $('#backtotop').fadeOut(250);
			});
			$('#backtotop').click(function() {
				$('html, body').animate({ scrollTop: '0' }, 200);
				return false;
			});
		}
	}
	function changePaceColor() {
		$(window).scroll(function() {
			if($(window).scrollTop() > '0.5') {
				$('.pace-progress').css('background', '#000');
				$('.pace-activity').css('border-top-color', '#000');
				$('.pace-activity').css('border-left-color', '#000');
			}
		});
	}
	$(document).ajaxStart(function() {
		Pace.restart();
	});
	function hideInfoMessage() {
		$('#justInfoCallOut').fadeOut(11000);
	}
	function select2() {
		$('.select2').select2();
	}
	function select2Dynamic() {
		$('.select2-dynamic').select2({
			tags: 'true',
		});
	}
	function dataTable() {
		$('.datatablex').DataTable({
			ordering: 'true',
			info: 'true',
			language: {
				emptyTable: 'No data available yet',
			}
		});
	}
	function typeaheadAjax() {
		$('.typeahead-ajax').each(function() {
			var url = $(this).data('url');
			$(this).typeahead({
				hint: 'true',
				highlight: 'true',
				minLength: '1',
				limit: '12',
				alignWidth: 'true',
				source: function(query, processSync, processAsync) {
					return $.ajax({
						url: url,
						type: 'POST',
						data: 'q='+query,
						dataType: 'JSON',
						success: function(data) {
							var arr = [];
							var map = {};
							$.each(data, function(i, item) {
								map[item.text] = item;
								arr.push(item.text);
							});
							return processSync(arr);
						}
					});
				}
			});
		});
	}
	function select2Ajax() {
		$('.select2-ajax').each(function() {
			var url = $(this).data('url');
			$(this).select2({
				placeholder: 'Enter something to search',
				ajax: {
					url: url,
					type: 'POST',
					dataType: 'JSON',
					delay: '250',
					processResults: function(data) {
						return {
							results: $.map(data, function(item) {
								return {
									id: item.id,
									text: item.text,
								}
							})
						};
					},
					cache: 'true',
				}
			});
		});
	}
	function datepicker(orientation) {
		if(typeof(orientation) == 'undefined') orientation = 'auto';
		$('.datepickerx').datepicker({
			format: 'dd-mm-yyyy',
			autoclose: 'true',
			orientation: orientation,
			daysOfWeekDisabled: '[0, 6]',
			todayHighlight: 'true',
			daysOfWeekHighlighted: '[0, 6]',
			clearBtn: true,
		});
		$('.datepickerx').attr('readonly', true);
	}
	function fileArrayCreateElement() {
		var fileArray = document.getElementById('fileArray');
		var fileArrayCount = document.getElementById('fileArrayCount');
		fileArrayCount.value++;
		var fileArrayElement = document.createElement('input');
		fileArrayElement.setAttribute('type', 'file');
		fileArrayElement.setAttribute('name', 'fileToBeUpload[]');
		fileArrayElement.setAttribute('id', 'file'+fileArrayCount.value);
		fileArrayElement.setAttribute('accept', '.pdf');
		fileArrayElement.setAttribute('data-validation', 'mime size');
		fileArrayElement.setAttribute('data-validation-allowing', 'pdf');
		fileArrayElement.setAttribute('data-validation-max-size', '1M');
		fileArray.appendChild(fileArrayElement);
	}
	function fileArrayDeleteElement() {
		var fileArray = document.getElementById('fileArray');
		var fileArrayCount = document.getElementById('fileArrayCount');
		if(fileArrayCount.value > '0') {
			var deleteElement = document.getElementById('file'+fileArrayCount.value);
			fileArray.removeChild(deleteElement);
			fileArrayCount.value--;
		}
	}
	function isNumeric(data, isZeroAllowed) {
		if(typeof(isZeroAllowed) == 'undefined') isZeroAllowed = '0';
		return isNotEmpty(data) && (!isNaN(parseFloat(data)) && isFinite(data)) && ((isZeroAllowed == '1' && data == '0') || data > '0');
	}
	function isNotEmpty(data) {
		if(Array.isArray(data)) {
			if(data.length == '0') return false;
			else if(data.length > '0') return true;
		} else {
			if(data == '' || data == null || data.trim().length < '1') return false;
			else if(data != '' && data != null && data.trim().length >= '1') return true;
		}
	}
	function lessThanDate() {
		$.formUtils.addValidator({
			name: 'lessThanDate',
			validatorFunction: function(value, $el, config, language, $form) {
				var firstBox = $('#'+$($el).data('validation-depends-on')).val();
				var secondBox = value;
				if(isNotEmpty(firstBox) && isNotEmpty(secondBox)) return dateValidator(firstBox, secondBox)
				else return false;
			},
			errorMessage: 'This should be less than First Date (DD-MM-YYYY)',
			errorMessageKey: 'badDate',
		});
	}
	function subCatCode(catID, selectID) {
		var subCatCodeHTML = '<option value="">Select Sub-Category</option>';
		if(isNumeric(catID) && isNotEmpty(selectID)) {
			$.ajax({
				url: 'subCatCodeFetch.php',
				type: 'POST',
				data: 'catID='+catID,
				dataType: 'JSON',
				cache: false,
				processData: false,
				success: function(response) {
					if(isNotEmpty(response)) {
						for(var i = 0; i < response.length; i++) subCatCodeHTML = subCatCodeHTML + '<option value="'+response[i].id+'">'+response[i].subcat_code+' - '+response[i].subcat_desc+'</option>';
					}
					if(isNotEmpty(subCatCodeHTML)) $('#'+selectID).html(subCatCodeHTML);
					else unloadDiv(selectID);
				},
			});
		} else $('#'+selectID).html(subCatCodeHTML);
	}
	function loadDiv(iD, urlAppend) {
		if(typeof(urlAppend) == 'undefined') urlAppend = null;
		var url = $('#'+iD).data('url');
		if(isNotEmpty(urlAppend)) url += urlAppend;
		$.ajaxSetup({
			cache: 'false',
		});
		$('#'+iD).load(url);
	}
	function unloadDiv(iD) {
		$('#'+iD).html('');
		$('#'+iD).empty();
	}
	function mailOpen(mailID) {
		if(isNotEmpty(mailID)) {
			$.ajax({
				url: 'mailFetch.php',
				type: 'POST',
				data: 'mailID='+encodeURI(mailID),
				cache: false,
				processData: false,
				success: function(response) {
					if(isNotEmpty(response)) {
						if(response.includesCustom('Success')) redirectIt('viewMail.php');
						else showValidationMessage(response);
					}
				},
			});
		}
	}
	function openInNewTab(url) {
		var win = window.open(url, '_blank');
		win.focus();
	}
	function redirectIt(url) {
		window.location = url;
	}
	function logoutOnTimeOut() {
		setTimeout(function() {
			redirectIt('logout.php');
		}, 300000);
	}
	function fileOpen(fileID) {
		if(isNotEmpty(fileID)) {
			$.ajax({
				url: 'fileFetch.php',
				type: 'POST',
				data: 'fileID='+encodeURI(fileID),
				cache: false,
				processData: false,
				success: function(response) {
					if(isNotEmpty(response)) {
						if(response.includesCustom('Success')) openInNewTab('viewFile.php');
						else showValidationMessage(response);
					}
				},
			});
		}
	}
	function validate() {
		$.validate({
			modules: 'date, file, logic, sanitize',
			validateOnBlur: false,
		});
	}
	function countDownCharacter(iD) {
		if(typeof(iD) == 'undefined') iD = null;
		$('.count').each(function() {
			$(this).restrictLength($('#'+$(this).data('maxlength')));
		});
	}
	function dateValidator(fromDate, toDate) {
		var fromDate = fromDate.split('-').reverse().join('-');
		var toDate = toDate.split('-').reverse().join('-');
		return fromDate <= toDate;
	}
	function dateDifference(fromDate, toDate, weekendsExcluded, errorMessage) {
		if(typeof(weekendsExcluded) == 'undefined') weekendsExcluded = '0';
		if(typeof(errorMessage) == 'undefined') errorMessage = 'Error, Check Date.';
		if(dateValidator(fromDate, toDate)) {
			var oneDay = 24 * 60 * 60 * 1000;
			var fromDate, toDate;
			fromDate = fromDate.split('-').reverse().join('-');
			toDate = toDate.split('-').reverse().join('-');
			fromDate = new Date(fromDate);
			toDate = new Date(toDate);
			var diffDays = Math.round(Math.abs((fromDate.getTime() - toDate.getTime()) / (oneDay))) + 1;
			if(weekendsExcluded == '0') return diffDays;
			if(weekendsExcluded == '1') {
				var withOutWeekends = '0';
				for(var i = 0; i < diffDays; i++) {
					weekDay = fromDate.getDay();
					if(weekDay != '0' && weekDay != '6') withOutWeekends++;
					fromDate.setDate(fromDate.getDate() + 1);
				}
				return withOutWeekends;
			}
		} else return errorMessage;
	}
	function showValidationMessage(validationMessage) {
		$('#justValidationCallOut').html(validationMessage);
		$('#justValidationCallOut').fadeIn('slow');
		var scrollToMessage = document.getElementById('scrollToMessage');
		scrollToMessage.scrollIntoView();
		$('#justValidationModal').html(validationMessage);
		$('#justValidationButton').click();
		return false;
	}
	function hideValidationMessage() {
		$('#justValidationCallOut').fadeOut(11000);
	}
	function showSuccessMessage(successMessage, url) {
		if(typeof(url) == 'undefined') url = null;
		$('#justSuccessCallOut').html(successMessage);
		$('#justSuccessCallOut').fadeIn('slow');
		var scrollToMessage = document.getElementById('scrollToMessage');
		scrollToMessage.scrollIntoView();
		$('#justSuccessModal').html(successMessage);
		if(isNotEmpty(url)) $('#successButton').attr('onclick', 'hideSuccessMessage(\''+url+'\');');
		$('#justSuccessButton').click();
	}
	function hideSuccessMessage(url) {
		$('#justSuccessCallOut').fadeOut(11000);
		if(isNotEmpty(url)) redirectIt(url);
	}
	function fileValidation(fileArrayID, showError) {
		if(typeof(showError) == 'undefined') showError = '1';
		var fileArraylength = $('#'+fileArrayID+' input').length;
		var fileArrayUploadValue = true;
		if(fileArraylength < '1') fileArrayUploadValue = false;
		$('#'+fileArrayID+' input').each(function(index) {
			var fileUploadValue = $(this).val();
			if(!fileUploadValue) fileArrayUploadValue = false;
		});
		var message = 'Please upload Document.';
		if(fileArraylength < '1' || fileArrayUploadValue == false) { 
			if(showError == '1') showValidationMessage(message);
		}
		return fileArrayUploadValue;
	}
	function unCheckAll() {
		var allCheckboxRadioInput = $('input[type="checkbox"].iCheck, input[type="radio"].iCheck');
		for(var i = 0; i < allCheckboxRadioInput.length; i++) {
			if(allCheckboxRadioInput[i].type == 'checkbox' || allCheckboxRadioInput[i].type == 'radio') $(allCheckboxRadioInput[i]).iCheck('uncheck');
		}
	}
	function unSelectAll() {
		var allSelectInput = $('select.select2');
		for(var i = 0; i < allSelectInput.length; i++) {
			$(allSelectInput[i]).val('').trigger('change');
			if($(allSelectInput[i]).hasClass('select2-ajax')) {
				$(allSelectInput[i]).empty().trigger('change');
				unloadDiv(allSelectInput[i].id);
			}
		}
	}
	function resetAll(iD) {
		unCheckAll();
		unSelectAll();
		$('#'+iD).trigger('reset');
	}
	function checkboxRadioFunction(checkboxClass, radioClass) {
		$('input[type="checkbox"].iCheck, input[type="radio"].iCheck').iCheck({
			checkboxClass: checkboxClass,
			radioClass: radioClass,
			increaseArea: '20%'
		}).on('ifChanged', function(e) {
			var isChecked = e.currentTarget.checked;
			checkBoxRadioIfChangedfunction();
		});
	}
	function submitForm(iD, url, searchMode, diviD) {
		if(typeof(url) == 'undefined') url = null;
		if(typeof(searchMode) == 'undefined') searchMode = '0';
		if(typeof(diviD) == 'undefined') diviD = url;
		$('#'+iD).on('submit', (function(e) {
			e.preventDefault();
			$.ajax({
				url: $('#'+iD).attr('action'),
				type: 'POST',
				data: new FormData(this),
				cache: false,
				contentType: false,
				processData: false,
				beforeSend: function(x) {
					// $('button[type="submit"], input[type="submit"]').attr('disabled', true);
				},
				success: function(response) {
					if(isNotEmpty(response)) {
						if(response.includesCustom('Success')) {
							if(searchMode == '0') {
								contentRefreshNow();
								// resetAll(iD);
								// $('button[type="submit"], input[type="submit"]').attr('disabled', true);
								showSuccessMessage(response, url);
							}
							if(searchMode == '1') {
								loadDiv(diviD);
								var scrollToDivID = document.getElementById(diviD);
								scrollToDivID.scrollIntoView();
								$('button[type="submit"], input[type="submit"]').attr('disabled', false);
							}
						} else {
							showValidationMessage(response);
							$('button[type="submit"], input[type="submit"]').attr('disabled', false);
						}
					}
				},
				error: function() {
					$('button[type="submit"], input[type="submit"]').attr('disabled', false);
				},
			});
		}));
	}
	function contentRefresh(iD) {
		if(typeof(iD) == 'undefined') iD = null;
		$('.refresh').each(function() {
			var url = $(this).data('url');
			var iD = $(this).attr('id');
			$.ajaxSetup({
				cache: 'false',
			});
			$(setInterval(function() {
				$('#'+iD).load(url);
			}, 300000));
		});
	}
	function contentRefreshNow(iD) {
		if(typeof(iD) == 'undefined') iD = null;
		$('.refresh').each(function() {
			var url = $(this).data('url');
			var iD = $(this).attr('id');
			$.ajaxSetup({
				cache: 'false',
			});
			$('#'+iD).load(url);
		});
	}
	function numericValidation(now) {
		var theEvent = now || window.event;
		var key = theEvent.keyCode || theEvent.which;
		key = String.fromCharCode(key);
		var regex = /[0-9-.]|\x08/;
		if(!regex.test(key)) {
		theEvent.returnValue = false;
		if(theEvent.preventDefault) theEvent.preventDefault();
		}
	}
	function sideBar(onclickID, triggerID) {
		$('#'+onclickID).click(function() {
			if($('body').hasClass('sidebar-collapse')) $('.sidebar-toggle').trigger('click');
			$('#'+triggerID).trigger('click');
		});
	}
	function getReport(orientation, theme) {
		if(typeof(orientation) == 'undefined') orientation = 'portrait';
		if(typeof(theme) == 'undefined') theme = 'digital';
		$('#duplicateHTML').html('<style> table { border-collapse: collapse; margin: 0px auto; margin-left: auto; margin-right: auto; width: 100%; } table, th, td { border: 1px solid black; } th, td { padding-left: 5px; vertical-align: baseline; } th { padding-right: 5px; /* 20px; */ text-align: center; } td { padding-right: 5px; font-size: 12px; word-break: break-all; } </style>'+$('#print').html());
		$('#duplicateHTML').find('.noPrint').remove();
		$('#duplicateHTML table').removeAttr('class');
		$('#duplicateHTML tr').removeAttr('class');
		$('#duplicateHTML tr').removeAttr('onclick');
		$('#htmlSource').val($('#duplicateHTML').html().replace(/[\n\s\t]+/g, ' ').trim());
		$('#orientation').val(orientation);
		$('#theme').val(theme);
		$('#duplicateHTML').empty();
		$('#pdfForm').submit();
	}
	$(function() {
		var origTitle, animatedTitle, timer;
		function animateTitle(newTitle) {
			var currentState = false;
			origTitle = document.title;
			animatedTitle = 'Tab halted ! # ' + origTitle;
			timer = setInterval(startAnimation, 2000);
			function startAnimation() {
				document.title = currentState ? origTitle : animatedTitle; currentState = !currentState;
			}
		}
		function restoreTitle() {
			clearInterval(timer);
			document.title = origTitle;
		}
		$(window).blur(function() {
			animateTitle();
		});
		$(window).focus(function() {
			restoreTitle();
		});
	});
	var rev = 'fwd';
	function titlebar(val) {
		var msg = 'Online ICT Project Timeline & Schedule';
		var res = ' ';
		var speed = '100';
		var pos = val;
		var le = msg.length;
		if(rev == 'fwd') {
			if(pos < le) {
				pos = pos + 1;
				scroll = msg.substr('0', pos);
				document.title = scroll;
				timer = window.setTimeout("titlebar("+pos+")", speed);
			} else {
				rev = 'bwd';
				timer = window.setTimeout("titlebar("+pos+")", speed);
			}
		} else {
			if(pos > '0') {
				pos = pos - 1;
				var ale = le - pos;
				scrol = msg.substr(ale, le);
				document.title = scrol;
				timer = window.setTimeout("titlebar("+pos+")", speed);
			} else {
				rev = 'fwd';
				timer = window.setTimeout("titlebar("+pos+")", speed);
			}
		}
	}
		function pkSession(slno, url) {
		if(isNumeric(slno, '1') && isNotEmpty(url)) {
			$.ajax({
				url: '/VCDC/createSession.php',
				type: 'POST',
				data: 'slno='+encodeURIComponent(slno),
				cache: false,
				processData: false,
				success: function(response) {
					if(isNotEmpty(response)) {
						if(response.includesCustom('Success')) redirectIt(url);
						else showValidationMessage(response);
					}
				},
			});
		}
	}
	function timePicker() { // https://github.com/jonthornton/jquery-timepicker
		$('.timepickerx').timepicker();
	}