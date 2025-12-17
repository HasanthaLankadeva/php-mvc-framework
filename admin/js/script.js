jQuery(document).ready(function(){
    
	jQuery(".name").focus(function(){
		jQuery(".name-help").slideDown(500);
	}).blur(function(){
		jQuery(".name-help").slideUp(500);
	});
	
	jQuery(".password").focus(function(){
		jQuery(".password-help").slideDown(500);
	}).blur(function(){
		jQuery(".password-help").slideUp(500);
	});
	
	jQuery('.login').click(function(){
		if(!jQuery(this).hasClass('active')){
			jQuery(this).siblings().removeClass('active');
			jQuery(this).addClass('active');
			
			jQuery.when(jQuery('.change-block').fadeOut(500))
					   .done(function() {
				jQuery('.form-block').fadeIn();
			});
		}
	});
	
	jQuery('.remove-item').click(function(){
		jQuery(this).parent('.filediv').remove();
	});
	
	jQuery( function() {
		opacity: 0.7,
		jQuery( "#sortable" ).sortable();
		//jQuery( "#sortable" ).disableSelection();
	});
			
	/* login scripts for pages */
	if(jQuery('body').hasClass('logged-in')){
		jQuery( function() {
			jQuery( "#cms-draggable" ).draggable({
                containment: ".holder"
            });
		});
		
		jQuery( ".messagepop" ).draggable({
			handle: ".cms-window-header"
		});
		
		jQuery("#cms-draggable .edit-btn").click(function(){
			jQuery(".editable").each(function(){
				jQuery(this).toggleClass('active-edit');
			});
		});
			
		jQuery('.editable').click(function(){
			if(jQuery(this).hasClass('active-edit')){
				var section = jQuery(this).data('section'),
					txt = jQuery(this).html();
				
				jQuery("#new_message").prepend('<textarea id="content" name="content"></textarea>');
				
				jQuery('#content').text(txt);
				jQuery('.cms-window-header').text(section);
				jQuery('.section').val(section);
				jQuery('.pop').show();
				
				tinymce.init({
					selector: '#content',
					height: 200,
					plugins: [
						'advlist autolink lists link image charmap print preview anchor',
						'searchreplace visualblocks code fullscreen',
						'insertdatetime media table contextmenu paste code'
					],
					toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
					content_css: '//www.tinymce.com/css/codepen.min.css'
				});	
				return false;
			}
		});
		
		jQuery('.close').on('click', function() {
			$('.pop').fadeOut();
			jQuery('.cms-window-header').html('');
			jQuery('#content').html('');
			jQuery('.section').val('');
			jQuery("#content").remove();
			tinyMCE.remove()
			return false;
		});
		
		/**/		
		jQuery(".media").click(function(){
			jQuery("#media").load('http://localhost/test/admin/media.php');
			jQuery("#media").addClass('active');
			jQuery( function() {
				jQuery( "#media" ).draggable();
			});
		});
	}
	
	jQuery('#languages li:not(.active, .placeholder)').click(function(){
		var lang = jQuery(this).data('lan');
		jQuery.ajax
		({ 
			url: '#',
			data: {"lang": lang},
			type: 'post',
			success:function(data){
				location.reload();
			}
		});
	});
	
	// Set Active Language on Language Switcher
	var activeLan = jQuery('#languages .active').text();
	jQuery('#languages .placeholder').text(activeLan);
	
	jQuery('.placeholder').click(function(){
		jQuery('#languages').toggleClass('show');
	});
	
	tinymce.init({
	selector: '.module-form .content',
		height: 200,
		relative_urls : 0,
		plugins: [
			'advlist autolink lists link image charmap print preview anchor',
			'searchreplace visualblocks code fullscreen',
			'insertdatetime media table contextmenu paste code',
			'textcolor colorpicker'
		],
		toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | forecolor backcolor',
		content_css: 'https://devsite.investorthinkonline.com/theme/css/theme.css'	
	});
	return false;
	
	
	jQuery( document ).ajaxComplete(function() {
		tinymce.init({
			selector: '.module-form .content',
				height: 200,
				relative_urls : 0,
				plugins: [
				'advlist autolink lists link image charmap print preview anchor',
				'searchreplace visualblocks code fullscreen',
				'insertdatetime media table contextmenu paste code',
				'textcolor colorpicker'
			],
			toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | forecolor backcolor',
			content_css: '//www.tinymce.com/css/codepen.min.css'
		});
		return false;
	});
});



jQuery(window).on('load', function() {
		
})


jQuery(window).on('resize', function() {
	
});
