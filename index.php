<?php error_reporting(0); session_name('ict_project_session'); session_start(); $_SESSION['authenticationProcessSKIPPINGThisIFStatement'] = 'hmm'; include('prop.php'); error_reporting(1); unset($_SESSION['tempEmpCode']); $url = $_SESSION['homepageURL']; /* if(isset($_SESSION['empCode']) && isNotEmpty($_SESSION['empCode']) && $_SESSION['empCode'] && $_SESSION['empCode'] == $_COOKIE['empCode']) header("location: $url"); else { */ if(isset($_GET[$_SESSION['resetParam']]) || $_SESSION['cookieEnabled'] == '0') { setrawcookie('empCode', null, time() - 3600, "/"); setrawcookie('empName', null, time() - 3600, "/"); $_COOKIE['empCode'] = null; $_COOKIE['empName'] = null; } $_SESSION['resetParam'] = randomVariable(); ?><!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Online Vigilance</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <?php if($_SESSION['cookieEnabled'] == '1') { ?><link rel="stylesheet" href="plugins/iCheck/all.css"><?php } ?>
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="plugins/pace/pace.min.css">
  <link rel="icon" type="image/x-icon" href="bower_components/di_faviconew.ico" />
  <link rel="shortcut icon" type="image/ico" href="bower_components/di_faviconew.ico" />
</head>
<body class="hold-transition lockscreen" oncontextmenu="return false;" ondragstart="return false;" ondrop="return false;" onselectstart="return false;">
<noscript class="jsRequiredMessage"> <p class="jsRequiredMessage">This page uses Javascript.<br>Your browser either doesn't support Javascript or you have it turned off. To see this page as it is meant to appear, please use a Javascript enabled browser.</p> <style type="text/css"> p { font-family: 'Comic Sans MS', 'Helvetica', 'sans-serif'; } p::first-letter { background-color: #666; color: #FFF; font-size: 24px; font-style:normal; display: inline-block; padding: 0 5px; border-radius: 3px; margin-right: 2px; font-family: Satisfy, cursive; } p::first-line { font-size: 18px; text-transform: smallcaps; font-style: italic; text-decoration: underline; } .jsRequired { display:none !important; } .jsRequiredMessage { display:block; background-color:#C00; color:#fff; width:100%; line-height:30px; text-align:center; font-size:16px; border:0 none; position: fixed; top: 25%; left: 50%; transform: translate(-50%, -50%); } </style> </noscript>
<div id="preloader" class="jsRequired"> <div id="loader" class="jsRequired"> </div> </div>
<style> html { overflow: hidden; height: 100%; } body { height: 100%; overflow: auto; } .bold { font-weight: bold !important; } .center { text-align: center !important; } .pointer { cursor: pointer !important; } .hide { display: none !important; } .callout { position: fixed; top: 15%; left: 50%; transform: translate(-50%, -50%); } #preloader { position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: #050505; z-index: 800; height: 100%; width: 100%; } .no-js #preloader, .oldie #preloader { display: none; } #loader { position: absolute; left: 50%; top: 50%; width: 60px; height: 60px; margin: -30px 0 0 -30px; padding: 0; } #loader:before { content: ""; border-top: 11px solid rgba(255, 255, 255, 0.1); border-right: 11px solid rgba(255, 255, 255, 0.1); border-bottom: 11px solid rgba(255, 255, 255, 0.1); border-left: 11px solid #FFFFFF; -webkit-animation: load 1.1s infinite linear; animation: load 1.1s infinite linear; display: block; border-radius: 50%; width: 60px; height: 60px; } @-webkit-keyframes load { 0% { -webkit-transform: rotate(0deg); transform: rotate(0deg); } 100% { -webkit-transform: rotate(360deg); transform: rotate(360deg); } } @keyframes load { 0% { -webkit-transform: rotate(0deg); transform: rotate(0deg); } 100% { -webkit-transform: rotate(360deg); transform: rotate(360deg); } } .lockscreen-logo, #message { overflow: hidden; border-right: .15em solid orange; white-space: nowrap; margin: 0 auto; animation: typing 3.5s steps(40, end), blink-caret .75s step-end infinite; } @keyframes typing { from { width: 0 } to { width: 100% } } @keyframes blink-caret { from, to { border-color: transparent } 50% { } } ::-webkit-scrollbar { width: 8px; height: 8px } ::-webkit-scrollbar-track { background: #FFF; -webkit-box-shadow: inset 1px 1px 2px #E0E0E0; border: 1px solid #D8D8D8 } ::-webkit-scrollbar-thumb{ background: #008D4C; -webkit-box-shadow: inset 1px 1px 2px rgba(155, 155, 155, 0.4) } ::-webkit-scrollbar-thumb:hover { -webkit-box-shadow: inset 1px 1px 10px rgba(0, 0, 0, 0.3) } ::-webkit-scrollbar-thumb:active { background: #888; -webkit-box-shadow: inset 1px 1px 2px rgba(0, 0, 0, 0.3) } .lockscreen { background: #1B76AA; background-image: url('bower_components/digitalNICPattern.png'); margin-left: -10px; margin-right: -10px; } .lockscreen-wrapper { background: #e8e8e8; margin-top: 1%; margin-bottom: 1%; } header { background: #F5F5F5; width: 100%; position: relative; display: inline-block; padding: 20px 0; } header img { max-height: 45px; } .container { position: relative; z-index: 1; } .logo { float: left; display: inline-block; } .digital-india { display: inline-block; } .thumb { margin-top: 10px; } .thumb img { max-height: 100px; } footer { background: #00588C; width: 100%; display: inline-block; position: relative; padding: 30px 0 20px; } footer p { text-align: center; margin: 0; } footer p, footer a, footer a:hover, footer a:focus { color: #9BB5C5; text-decoration: none; } header, .lockscreen-wrapper, .callout { box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22); } .icheckbox_square-green.disabled { cursor: not-allowed !important; } @media only screen and (max-width:1024px) { header .digital-india { } } @media only screen and (max-width:768px) { header .digital-india { } } @media only screen and (max-width:600px) { header .digital-india { display: none; } } @media only screen and (max-width:400px) { header .digital-india { display: none; } } </style>
<header class="jsRequired">
  <div class="container">
    <div class="logo">
      <img src="bower_components/digitalNICLogoWebsite.png" alt="Digital NIC" />
    </div>
    <div class="digital-india pull-right">
      <a onclick="openInNewTab('http://www.nic.in/');"class="nic-logo pointer"><img src="bower_components/NICLogo.png" alt="National Informatics Centre" /></a>
      <img src="bower_components/digitalIndiaLogo.png" alt="Logo" />
    </div>
  </div>
</header>
<div class="lockscreen-wrapper jsRequired">
  <div class="lockscreen-logo">
    <div class="thumb"><img src="bower_components/logoIcon.png" alt="logo"/></div>
    <a href="index.php"><b>Online</b>Vigilance</a>
  </div>
  <div class="help-block text-center bold" id="message" style="color: red;">
    Enter your NIC email ID
  </div>
  <br>
  <div class="lockscreen-name"><?php echo isset($_COOKIE['empName']) && isNotEmpty($_COOKIE['empName']) ? $_COOKIE['empName'] : null; ?></div>
  <div class="lockscreen-item">
    <div class="lockscreen-image">
      <img src="<?php echo 'serveImage.php'; ?>" alt="User Image" id="userImage">
    </div>
    <form class="lockscreen-credentials" role="form" name="form" id="form" method="post" onsubmit="return validateForm(this.id);" autocomplete="disabled">
      <div class="input-group">
        <div class="form-group has-feedback" id="usernameDiv">
          <input type="search" name="username" id="username" value="<?php echo isset($_COOKIE['empName']) && isNotEmpty($_COOKIE['empName']) ? $_COOKIE['empName'] : null; ?>" class="form-control" placeholder="Enter NIC email ID" data-sanitize="trim" data-validation="length custom" data-validation-length="max25" data-validation-regexp="([\w])\w+" data-validation-allowing="." style="border-style: none !important; border-color: rgb(255, 255, 255) !important;" onsearch="nextBox();" autocomplete="new-username" autofill="off" <?php echo isset($_COOKIE['empName']) && isNotEmpty($_COOKIE['empName']) ? 'readonly' : 'autofocus'; ?>>
          <span class="fa fa-envelope fa-lg form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback" id="passwordDiv" style="display: none;">
          <input type="password" name="password" id="password" value="" class="form-control password" placeholder="Enter your Password" style="display: block;" style="border-style: none !important; border-color: rgb(255, 255, 255) !important;" autocomplete="new-password" autofill="off">
          <span class="fa fa-lock fa-lg form-control-feedback"></span>
        </div>
        <div class="input-group-btn" id="nextButton">
          <button type="button" class="btn" onclick="nextBox();"><i class="fa fa-arrow-right text-muted"></i></button>
        </div>
        <div class="input-group-btn" id="submitButton" style="display: none;">
          <button type="submit" class="btn" onclick="submitThis('#form');"><i class="fa fa-arrow-right text-muted"></i></button>
        </div>
      </div>
    </div>
    <?php if($_SESSION['cookieEnabled'] == '1') { ?><div class="form-group center" id="rememberMeDiv">
      <label><input type="checkbox" name="rememberMe" id="rememberMe" value="Y" class="iCheck">&nbsp;&nbsp;&nbsp;Remember Me</label>
      <input type="hidden" name="rememberMeValue" id="rememberMeValue" value="0" class="form-control" placeholder="Remember Me" data-sanitize="trim" data-validation="number" data-validation-error-msg="This is a required field" data-validation-depends-on="rememberMe">
    </div><?php } ?>
  </form>
  <div class="text-center" id="invalidUsername" style="display: none;">
  </div>
  <div class="lockscreen-footer text-center">
    <br><strong> For any queries, please contact at 011-24305264<br>or mail at nic-oad(at)nic.in</strong>
  </div>
  <br>
<?php include('messageCallOut.php') ?>
</div>
<footer class="jsRequired">
  <div class="container">
    <p>Designed and Developed by Office Automation Division,<br>
      <a class="pointer" onclick="openInNewTab('http://www.nic.in/');">National Informatics Centre &copy; 2018-2019.</a>
    </p>
  </div>
</footer>
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="bower_components/PACE/pace.min.js"></script>
<script src="plugins/iCheck/icheck.min.js"></script>
<script src="bower_components/jQuery-Form-Validator-master/form-validator/jquery.form-validator.min.js"></script>
<script> 
 $(document).ready(function() {
    <?php echo isset($_COOKIE['empName']) && isNotEmpty($_COOKIE['empName']) ? 'nextBox(); cookieSet();' : null; ?> 
	 hideInfoMessage();
    preloader();
	<?php
     if ($_SESSION['cookieEnabled'] == '1') { ?> 
	 checkboxRadioFunction('<?php echo $_SESSION['checkBoxStyleClass ']; ?>', '<?php echo $_SESSION['radioStyleClass']; ?>'); 
	 <?php  } ?> validate();
	 submitForm('form');
});
$(document).ajaxStart(function() {
    Pace.restart();
});

function hideInfoMessage() {
    $('#justInfoCallOut').fadeOut(11000);
}

function submitThis(t) {
	$(t).submit();
}

function validate() {
    $.validate({
        modules: 'sanitize',
        errorMessagePosition: 'inline',
        validateOnBlur: 'true',
        inlineErrorMessageCallback: function(input, errorMessage, conf) {
            if (isNotEmpty(errorMessage)) showValidationMessage(errorMessage);
        },
    });
}

function showValidationMessage(validationMessage) {
    $('#justValidationCallOut').html(validationMessage);
    $('#justValidationCallOut').fadeIn('slow');
    var scrollToMessage = document.getElementById('scrollToMessage');
    hideValidationMessage();
    return false;
}

function hideValidationMessage() {
    $('#justValidationCallOut').fadeOut(4000);
}

function preloader() {
    $('#loader').fadeOut('slow', function() {
        $('#preloader').delay(300).fadeOut('slow');
    });
}

function submitForm(iD) {
    $('#' + iD).on('submit', (function(e) {
        if (isNotEmpty($('#username').val()) && isNotEmpty($('#password').val())) {
            $.ajax({
                url: 'loginCheck.php',
                type: 'POST',
                data: new FormData(this),
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function(x) {
                    checkBoxRadioIfChangedfunction();
                    $('button[type="submit"]').attr('disabled', true);
                },
                success: function(response) {
					// console.log(response);
					// alert(response);
                    if (isNotEmpty(response)) {
                        if (response.customIncludes('Success')) {
                            changePaceColor();
                            redirectIt('<?php echo $_SESSION['homepageURL']; ?>');
                        } else showValidationMessage(response);
                    }
                    $('button[type="submit"]').attr('disabled', false);
                },
                error: function() {
                    $('button[type="submit"]').attr('disabled', false);
                },
            });
        }
    }));
}

function validateForm(iD) {
    return false;
    null;
} <?php if ($_SESSION['cookieEnabled'] == '1') { ?>
 function checkboxRadioFunction(checkboxClass, radioClass) {
        $('input[type="checkbox"].iCheck, input[type="radio"].iCheck').iCheck({
            checkboxClass: checkboxClass,
            radioClass: radioClass,
            increaseArea: '20%'
        }).on('ifChanged', function(e) {
            var isChecked = e.currentTarget.checked;
            checkBoxRadioIfChangedfunction();
        });
    }<?php
} ?> function openInNewTab(url) {
    var win = window.open(url, '_blank');
    win.focus();
}

function redirectIt(url) {
    window.location = url;
}

function nextBox() {
    /* $('#password').val($('#username').val()); $('#form').submit(); return; */
    if (isNotEmpty($('#username').val())) {
        photoFetch($('#username').val());
        $('#usernameDiv').hide();
        $('#passwordDiv').show();
        $('#password').attr('data-sanitize', 'trim');
        $('#password').attr('data-validation', 'required length');
        $('#password').attr('data-validation-length', 'max25');
        $('#message').html('Enter your password now to retrieve<?php echo isset($_COOKIE['empName']) && isNotEmpty($_COOKIE['empName']) ?'back' : null; ?> your session');
        $('#invalidUsername').html('Not ' + $('#username').val() + ' Or sign in as a different user ? <a class="bold pointer" onclick="redirectIt(\'index.php?<?php echo $_SESSION['resetParam']; ?>\');">Click here</a>');
        $('#invalidUsername').show();
        $('#submitButton').show();
        $('#nextButton').hide();
        $('#password').focus();
    } else return false;
}

function photoFetch(userID) {
    if (isNotEmpty(userID)) {
        $.ajax({
            url: 'serveImage.php',
            type: 'POST',
            data: 'userID=' + userID,
            cache: false,
            processData: false,
            success: function(response) {
                if (isNotEmpty(response)) {
                    if (response.customIncludes('Success')) $('#userImage').attr('src', 'serveImage.php');
                }
            },
        });
    }
}

function checkBoxRadioIfChangedfunction() {
    if ($('.iCheck:checked').length === 1 && $('#rememberMe').is(':checked') == true) $('#rememberMeValue').val('1');
    else $('#rememberMeValue').val('0');
}
$('#username').keypress(function(e) {
    var key = e.which;
    if (key == 13) nextBox();
});

function cookieSet() {
    $('#rememberMe').iCheck('check');
    $('#rememberMeDiv').hide();
    $('#rememberMeValue').val('1');
}

function isNotEmpty(data) {
    if (Array.isArray(data)) {
        if (data.length == '0') return false;
        else if (data.length > '0') return true;
    } else {
        if (data == '' || data == null || data.trim().length < '1') return false;
        else if (data != '' && data != null && data.trim().length >= '1') return true;
    }
}
String.prototype.customIncludes = function(char) {
    if (this.indexOf(char) === -1) return false;
    else return true;
};
$(function() {
    var origTitle, animatedTitle, timer;

    function animateTitle(newTitle) {
        var currentState = false;
        origTitle = document.title;
        animatedTitle = 'Tab halted ! # ' + origTitle;
        timer = setInterval(startAnimation, '2000');

        function startAnimation() {
            document.title = currentState ? origTitle : animatedTitle;
            currentState = !currentState;
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
    var msg = 'Welcome to Online Vigilance';
    var res = ' ';
    var speed = '100';
    var pos = val;
    var le = msg.length;
    if (rev == 'fwd') {
        if (pos < le) {
            pos = pos + 1;
            scroll = msg.substr('0', pos);
            document.title = scroll;
            timer = window.setTimeout("titlebar(" + pos + ")", speed);
        } else {
            rev = 'bwd';
            timer = window.setTimeout("titlebar(" + pos + ")", speed);
        }
    } else {
        if (pos > '0') {
            pos = pos - 1;
            var ale = le - pos;
            scrol = msg.substr(ale, le);
            document.title = scrol;
            timer = window.setTimeout("titlebar(" + pos + ")", speed);
        } else {
            rev = 'fwd';
            timer = window.setTimeout("titlebar(" + pos + ")", speed);
        }
    }
}
titlebar('0');

function changePaceColor() {
    $('.pace-progress').css('background', '#000');
    $('.pace-activity').css('border-top-color', '#000');
    $('.pace-activity').css('border-left-color', '#000');
}
</script>
</body>
</html><?php // } ?>