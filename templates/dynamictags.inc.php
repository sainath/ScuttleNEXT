<?php

$tagservice  =& ServiceFactory::getServiceInstance('TagService');
$userservice =& ServiceFactory::getServiceInstance('UserService');

$logged_on_userid = $userservice->getCurrentUserId();

$userPopularTags        =& $tagservice->getPopularTags($logged_on_userid, 25, $logged_on_userid);
$userPopularTagsCloud   =& $tagservice->tagCloud($userPopularTags, 5, 90, 175); 
$userPopularTagsCount   = count($userPopularTags);

//if ($userPopularTagsCount > 0) {
?>

<script type="text/javascript">
Array.prototype.contains = function (ele) {
    for (var i = 0; i < this.length; i++) {
        if (this[i] == ele) {
            return true;
        }
    }
    return false;
};

Array.prototype.remove = function (ele) {
    var arr = new Array();
    var count = 0;
    for (var i = 0; i < this.length; i++) {
        if (this[i] != ele) {
            arr[count] = this[i];
            count++;
        }
    }
    return arr;
};

function addonload(addition) {
    var existing = window.onload;
    window.onload = function () {
        existing();
        addition();
    }
}

addonload(
    function () {
        var taglist = document.getElementById('tags');
        var tags = taglist.value.split(', ');
        
        var populartags = document.getElementById('popularTags').getElementsByTagName('span');
        
        for (var i = 0; i < populartags.length; i++) {
            if (tags.contains(populartags[i].innerHTML)) {
                populartags[i].className = 'selected';
            }
        }
    }
);

function addTag(ele) {
    var thisTag = ele.innerHTML;
    var taglist = document.getElementById('tags');
	
    var tags = taglist.value.split(', ');

    // If tag is already listed, remove it
    if (tags.contains(thisTag)) {
        tags = tags.remove(thisTag);
        ele.className = 'unselected';
        
    // Otherwise add it
    } else {
        tags.splice(0, 0, thisTag);
        ele.className = 'selected';
    }
    
    taglist.value = tags.join(', ');
    
    document.getElementById('tags').focus();
}
//
document.write('<div id="RecomendedTags"><IMG style="display:none;" id="recomendedtagsSpin" SRC="../ajax-loader.gif" WIDTH="100" HEIGHT="100" BORDER="0" ALT="">');
//document.write('<div>test</div>');
document.write('<\/div>');


</script>

<?php //} ?>