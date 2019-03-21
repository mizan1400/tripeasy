
function isEmpty(value){
	return (value.length < 1);
}

function validEmail(v) {
    var r = new RegExp("[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?");
    return (v.match(r) == null) ? false : true;
}

function lengthChecker(value){
	return (value.length < 8);
}

function isExists(elem){
	if ($(elem).length > 0) {
		return true;
	}
	return false;
}


function changeUploadedImage(e) {
	var reader = new FileReader();

	reader.onload = function (e) {
		$('#uploaded-image').attr('src', e.target.result);
		$('#uploaded-image').addClass('active').fadeIn(2000);
		$('#upload-content').hide();
	};
	reader.readAsDataURL(e.target.files[0]);
}

function validateImage(input, e){
	var imageName = $(input).val(),
		extension = imageName.substring(imageName.lastIndexOf('.') + 1).toLowerCase();

	if (extension == 'jpg' || extension == 'png' || extension == 'jpeg' || extension == 'gif') {
		changeUploadedImage(e);
	} else {
		//changeUploadedImage(e);
		$(input).val("");
		alert("Invalid Image file.");
	}
}

function ucFirst(str) {
    str = str.toLowerCase().replace(/\b[a-z]/g, function(letter) {
        return letter.toUpperCase();
    });
    str = str.replace('_', ' ');
    return str;
}

(function ($) {

    "use strict";
	
	$('[data-validation]').on('submit', function(){

        $('.image-upload').removeClass('has-error');
        $('input').removeClass('has-error');
        $('.err-msg').remove();

        var hasError = false;
        $('[data-required]').each(function(){
            var $this = $(this);
            if(isEmpty($this.val())){
                hasError = true;

                if($this.data('required') != 'image'){
                    $this.addClass('has-error');
                    $this.after('<h6 class="err-msg">' + ucFirst($this.attr('name')) + ' is required.' + '</h6>');
                }else{
                    var imageUpload = $this.closest('.image-upload');
                    imageUpload.addClass('has-error');
                    imageUpload.after('<h6 class="err-msg">' + ucFirst($this.attr('name')) + ' is required.' + '</h6>');
                }
            }
        });

        if(hasError){
            return false;
        }
	});

	if(isExists('#uploaded-image')){
		if(!isEmpty($('#uploaded-image').attr('src'))){
			$('#upload-content').hide();
		}
	}


	$('.image-input').on('change', function (e) {
		validateImage($(this), e);
	});

	$(window).bind("load", function() {
		if(isExists('.masonry-grid')){
			$('.masonry-grid').masonry({
				itemSelector: '.masonry-item',
				percentPosition: true,
			});
		}
	});
	
})(jQuery);



