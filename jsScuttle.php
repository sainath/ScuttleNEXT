<?php
header('Content-Type: text/javascript');
require_once 'header.inc.php';
require_once 'functions.inc.php';
$player_root = $root .'includes/player/';
?>

var usernameFlag = false;
var passwordFlag = false;
var confpasswordFlag = false;
var emailFlag = false;

var deleted = false;
function deleteBookmark(ele, input) {
  $(ele).hide();
  $(ele).parent().append("<span><?php echo T_('Are you sure?') ?> <a href=\"#\" onclick=\"deleteConfirmed(this, " + input + "); return false;\"><?php echo T_('Yes'); ?></a> - <a href=\"#\" onclick=\"deleteCancelled(this); return false;\"><?php echo T_('No'); ?></a></span>");
  return false;
}
function deleteCancelled(ele) {
  $(ele).parent().prev().show();
  $(ele).parent().remove();
  return false;
}
function deleteConfirmed(ele, input) {
  $.get("<?php echo $root; ?>ajaxDelete.php?id=" + input, function(data) {
    if (1 === parseInt(data)) {
      $(ele).parents(".xfolkentry").slideUp();
	  location.reload();	  
    }
  });
  return false;
}

function useAddress(ele) {
    var address = ele.value;
    if (address != '') {
        if (address.indexOf(':') < 0) {
            address = 'http:\/\/' + address;
        }
        getTitle(address, null);
        ele.value = address;
    }
}

function getTitle(input) {
  var title = $("#titleField").val();
  if (title.length < 1) {
    $("#titleField").css("background-image", "url(<?php echo $root; ?>loading.gif)");
    if (input.indexOf("http") > -1) {
      $.get("<?php echo $root; ?>ajaxGetTitle.php?url=" + input, function(data) {
        $("#titleField").css("background-image", "none")
                        .val(data);
      });
    }
  }
/*
  var description = $("#descriptionField").val();
  if (description.length < 1) {
    $("#descriptionField").css("background-image", "url(loading.gif)");

	 if (input.indexOf("http") > -1) {
		$.get("ajaxGetDescription.php?url=" + input, function(data) {
			$("#descriptionField").css("background-image", "none").val(data);
		});
	 }
  }
  */

  var tags = $("#tags").val();
  
  if (tags.length < 1) {
    $("#recomendedtagsSpin").show();

	 if (input.indexOf("http") > -1) {
	 
		$.get("<?php echo $root; ?>ajaxGetTags.php?url=" + input, function(data) {
			//$("#recomendedtags").css("background", "none").val(data);
			$("#recomendedtagsSpin").hide();

			var recomendedtags = jQuery.map(data.split(','), function(n) {
									return '<a style="font-size:90%" onclick="addTag(this)">'+n+'</a>';
								})
			if (recomendedtags.length > 1){
				//alert(recomendedtags);
				$("#RecomendedTags").empty();
				$("#RecomendedTags").append('<div class="collapsible"><h4 class="text-sinfo ">Recomended Tags</h4>(click on the tags to add them)<div id="popularTags" class="tags">'+recomendedtags+'</div></div><hr>').hide().slideDown();			
			}else{
				$("#RecomendedTags").empty();
				$("#RecomendedTags").append('<div class="collapsible"><h4 class="text-sinfo ">Recomended Tags</h4>No Recomended or suggestable tags</div><hr>').hide().slideDown();	
			}

		});
	 }
  }

}
 /*
function closeDialog () {
$('#tabsDemoDialog').modal('hide'); 
};
*/
function okClicked () {
document.title = document.getElementById ("xlInput").value;
closeDialog ();
};


function validateUsername(ele){

	var username = ele.value;
	if (username.length > 4){
		if (username != ''){
			clearTimeout(self.searching);
			self.searching = setTimeout(function() {
				$.get("<?php echo $GLOBALS['root']; ?>ajaxIsAvailable.php?username=" + username, function(data) {
						if (1 === parseInt(data)) {
							$("#usernameavailability").removeClass().addClass("text-success strong").html("Username available");
						} else {
							$("#usernameavailability").removeClass().addClass("text-error strong").html("Username not available");
						}
				});
			
                  }, 300);
				return false;
		}else{
			$("#usernameavailability").removeClass().addClass("text-error strong").html("username cannot be empty");
			return false;
		}		
	}else{
		$("#usernameavailability").removeClass().addClass("text-error strong").html("username must be atleast 4 characters");
		return false;
	}
	usernameFlag = true;
	return true;
}

function validatePassword(ele){
	var password = ele.value;
	
	if (password.length < 6){
		$("#passwordlength").removeClass().addClass("text-error strong").html("Password must be at least 6 characters");
		passwordFlag = false;
		return false;
	}
	$("#passwordlength").removeClass().html("");
	passwordFlag = true;
	return true;
}

function validateConfPassword(ele, pass){
	var confpass = ele.value;
	password = pass.value;
	alert(confpass + "->" + password);
	if(password == confpass){
		$("#confpasswordlength").removeClass().addClass("text-error strong").html("Both passwords should match");
		confpasswordFlag = true;
		return true;
	}else{
		confpasswordFlag = false;
		return false;
	}
}

function validateEmail(email){
	var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    
	if(email.match(re)){
	$("#emailvalidation").removeClass().addClass("text-error strong").html("Please enter a valid email address");
		emailFlag = true;
		return true;
	}else{
		emailFlag = false;
		return false;
	}
}

/* Page load */
$(function() {

	$('#tags').popover();
	$('#descriptionField').popover();

	$('#scrollbox4').enscroll({
		verticalTrackClass: 'track4',
		verticalHandleClass: 'handle4',
		minScrollbarLength: 28
	});

// this one requires the value to be the same as the first parameter
	$.validator.methods.equal = function(value, element, param) {
		return value == param;
	};

//element.parent("span").next("span")
// START validate signup form on keyup and submit
/* Validation 
	$("#register").validate({
		debug: true,
			errorElement: "span",
			errorContainer: $("#warning, #summary"),
			errorPlacement: function(error, element) {
			//alert(error.toSource());
			//element.hide()
			//element.prepend("test");

			$('#messageF').prepend(error);
			},
		success: function(label) {
				label.text("ok!").addClass("messageS");
			},
		rules: {
			username: {
				required: true,
				minlength: 4
			},
			password: {
				required: true,
				minlength: 6
			},
			passconf: {
				required: true,
				minlength: 6,
				equalTo: "#password"
			},
			email: {
				required: true,
				email: true
			},
			agree: "required"
		},
		messages: {
			firstname: "Please enter your firstname",
			lastname: "Please enter your lastname",
			username: {
				required: "Please enter a username",
				minlength: "Your username must consist of at least 4 characters"
			},
			password: {
				required: "Please provide a password",
				minlength: "Your password must be at least 6 characters long"
			},
			confirm_password: {
				required: "Please provide a password",
				minlength: "Your password must be at least 6 characters long",
				equalTo: "Please enter the same password as above"
			},
			email: "Please enter a valid email address",
			agree: "Please accept our policy"
		}
	}); 
	*/
// END validate signup form on keyup and submit	


  // Insert Flash player for MP3 links
  if ($("#bookmarks").length > 0) {
    $("a[href$=.mp3].taggedlink").each(function() {
      var url  = this.href;
      var code = '<object type="application/x-shockwave-flash" data="<?php echo $player_root ?>musicplayer_f6.swf?song_url=' + url +'&amp;b_bgcolor=ffffff&amp;b_fgcolor=000000&amp;b_colors=0000ff,0000ff,ff0000,ff0000&buttons=<?php echo $player_root ?>load.swf,<?php echo $player_root ?>play.swf,<?php echo $player_root ?>stop.swf,<?php echo $player_root ?>error.swf" width="14" height="14">';
          code = code + '<param name="movie" value="<?php echo $player_root ?>musicplayer.swf?song_url=' + url +'&amp;b_bgcolor=ffffff&amp;b_fgcolor=000000&amp;b_colors=0000ff,0000ff,ff0000,ff0000&amp;buttons=<?php echo $player_root ?>load.swf,<?php echo $player_root ?>play.swf,<?php echo $player_root ?>stop.swf,<?php echo $player_root ?>error.swf" />';
          code = code + '</object> ';
      $(this).prepend(code);
    });
  }
})
