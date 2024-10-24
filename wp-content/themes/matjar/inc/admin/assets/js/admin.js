/*
* Theme Name: Matjar
* @since Matjar 1.0
*/
jQuery(document).ready(function($){
    "use strict";
	
	var matjar_import_percent 			= 0,
        matjar_import_percent_increase 	= 0,
        matjar_import_index_request 		= 0,
        matjar_import_request_data 		= [],
        matjar_import_demo_name 			= '';
	
	/* Size Guide Chart Table*/
	var sizechart_table = $('#matjar-chart-table');
	if(sizechart_table.length > 0 ) {
        sizechart_table.editTable();
    }
	
	/* Color Picker */
    if( $('.matjar-color-box').length > 0 ) {
        $('.matjar-color-box').wpColorPicker();
    }
	
	if( $('.matjar-image-clear').length > 0 ) {
		var attachement_id = $('.matjar-attachment-id').val();
		if(attachement_id == ''){
			$('.matjar-image-clear').hide();
		}
		$(document).on('click','.matjar-image-clear',function(e){			
			var image_url = $(this).attr('data-src');			
			$(this).parent().find('.matjar-attr-img').attr('src',image_url);
            $(this).parent().find('.matjar-attachment-id').val('');
			$(this).parent().find('.matjar-image-clear').hide('slow');
			
		});
    }
	
	/* Upload media image */
	$(document).on('click','.matjar-image-upload',function(e){
		e.preventDefault();
		var img_wrap,img_clear,attachment_id_wrap;

		img_wrap 				=  $(this).parent().find('.matjar-attr-img');
		attachment_id_wrap	=  $(this).parent().find('.matjar-attachment-id');
		img_clear			= $(this).parent().find('.matjar-image-clear');
		var image = wp.media({ 
            title: 'Upload Image',
            multiple: false
        }).open()
        .on('select', function(e){
            var uploaded_image = image.state().get('selection').first();
            var image_url,attachment;
			attachment = uploaded_image.toJSON();
			var attachment_id = attachment.id ? attachment.id : '';
            if(typeof uploaded_image.toJSON().sizes.thumbnail === 'undefined') {
                image_url=attachment.url;
                image_url=attachment.url;
            }else{
                image_url = attachment.sizes.thumbnail.url;
            }
            img_wrap.attr('src',image_url);
            attachment_id_wrap.val(attachment_id);
			img_clear.show('slow');
		
        });
	});
	
	/* Import Demo*/
	$(document).on('click', '.matjar-import-data .theme .import-button', function(e) {
		var content_wrp = $(this).closest('.theme');
		var template_part = $('#matjar-popup-content');
		content_wrp.find('.theme-screenshot').addClass('loading');
		var template	= wp.template('matjar-popup-data');
		var demo_name,demo_deails,modalcontainer;
		demo_name = $(this).attr('data-name');
		matjar_import_demo_name = $(this).attr('data-name');
		modalcontainer = $(this).closest('.matjar-import-demo-popup');
		
		var data = {
						action	: 'get_demo_data',
						demo   	: demo_name
					};
					
		$.post(ajaxurl,data,function(response) {
			
			var data = $.parseJSON(response);
			
			if( !data.status){
				alert(data.message);
				content_wrp.find('.theme-screenshot').removeClass('loading');
				return;
			}
			
			template_part.append( template({
				title : data.title,
				demo_key : data.slug,
				preview_image : data.preview_image,
				preview_demo_link : data.preview_demo_link,
			}));
			
			$.magnificPopup.open({
				items			: {
					src	: '.matjar-import-demo-popup'
				},
				type			: 'inline',
				mainClass		: 'mfp-with-zoom',
				closeOnBgClick	: false,
				enableEscapeKey	: false,
				zoom			: {
					enabled	: true,
					duration: 300
				},
				callbacks		: {
					open	: function () {
						content_wrp.find('.theme-screenshot').removeClass('loading');
					},	
					close	:function(){
						template_part.html('');
					}
				},
			});
		});	
	});
	
	/* Process to import*/
	$(document).on('click', '.install-demo', function(e) {
		var import_btn = $(this);
		if (import_btn.hasClass('processing')) {
			return false;
		}
		if (import_btn.hasClass('disabled')) {
			return false;
		}
		if (import_btn.hasClass('import-completed')) {
			return false;
		}
		
		var c = confirm('Are you sure you want to import this demo?');
		if (!c) {
			return false;
		}
		
		import_btn.addClass('processing');
		import_btn.addClass('loading');
		$('.install-demo.processing').text('Importing...');
		$('.progress-percent').html('1%');
		$('.progress-bar').css('width','1%');
		$('.import-process').show();
		matjar_import_request_data = [],
		matjar_import_demo_name = $(this).attr('data-demo');
		
		var import_full_content = false,
		import_content 			= false,
		import_menu 			= false,
		import_widget 			= false,
		import_revslider 		= false,
		import_theme_options 	= false,
		import_attachments 		= false;
		var demo_name 			= matjar_import_demo_name;
		
        if ($('#import_content_' + demo_name).is(':checked')) {
            import_content = true;
        } else {
            import_content = false;
        }
		if ($('#import_widget_' + demo_name).is(':checked')) {
            import_widget = true;
        } else {
            import_widget = false;
        }
        if ($('#import_revslider_' + demo_name).is(':checked')) {
            import_revslider = true;
        } else {
            import_revslider = false;
        }
        if ($('#import_attachments_' + demo_name).is(':checked')) {
            import_attachments = true;
        } else {
            import_attachments = false;
        }
        if ($('#import_menu_' + demo_name).is(':checked')) {
            import_menu = true;
        } else {
            import_menu = false;
        }
        if ($('#import_theme_options_' + demo_name).is(':checked')) {
            import_theme_options = true;
        } else {
            import_theme_options = false;
        }
        if ($('#import_full_content_' + demo_name).is(':checked')) {
            import_full_content 	= true;
            import_widget 			= true;
            import_revslider 		= true;
            import_menu 			= true;
            import_content 			= true;
            import_attachments 		= true;
            import_theme_options 	= true;
        }
		
        /* Import content */
        if ( import_content ) {			
			var condent_no;
			for (condent_no = 1; condent_no <= 1; condent_no++) {
				var data = {
					'action'		: 'import_content',
					'count'			: condent_no,
					'attachments'	: import_attachments,
				}
				
				matjar_import_request_data.push(data);
			}		
        }
		
		/* Import Menu */
		if ( import_menu ) {
            matjar_import_request_data.push({
                'action'	: 'import_menu',
                'demo_name'	: demo_name,
            });
        }
		
		/* Import Theme Options */
        if ( import_theme_options ) {
            matjar_import_request_data.push({
                'action'	: 'import_theme_options',
                'demo_name'	: demo_name,
            });
        }
		
		/* Import Widget */
        if ( import_widget ) {
            matjar_import_request_data.push({'action': 'import_widget', 'demo_name': demo_name});
        }
		
		/* Import Slider */
        if ( import_revslider ) {
            matjar_import_request_data.push({'action': 'import_revslider', 'demo_name': demo_name});
        }
        
		/* Import Configuration */
        matjar_import_request_data.push({
            'action': 'import_config',
            'demo_name': demo_name,
        });
        
        var total_ajaxs = matjar_import_request_data.length;
        
        if (total_ajaxs == 0) {
            import_btn.removeClass('processing');
            import_btn.removeClass('loading');
			import_btn.addClass('import-completed');
            return;
        }
        
        matjar_import_percent_increase = (100 / total_ajaxs);
       
        matjar_import_ajax_call();
        
        e.preventDefault();
		
	});
	
	function matjar_import_ajax_call() {
        if (matjar_import_index_request == matjar_import_request_data.length) {
			alert('Import proceess done');
			location.reload();
            return;
        }
       $.ajax({
            type: 'POST',
            url: ajaxurl,
            data: matjar_import_request_data[matjar_import_index_request],
            complete: function (jqXHR, textStatus) {
                matjar_import_percent += matjar_import_percent_increase;
                matjar_import_progress_bar();
                matjar_import_index_request++;
                setTimeout(function () {
                    matjar_import_ajax_call();
                }, 200);
            }
        });
    }
	function matjar_import_progress_bar(){
		if (matjar_import_percent > 100) {
            matjar_import_percent = 100;
        }
        
        if (matjar_import_percent == 100) {
            $('.install-demo.processing').text('Import Completed');
			$('.matjar-complete-action').show();
            $('.install-demo.processing').removeClass('loading');
            $('.install-demo.processing').removeClass('processing');
            
        }
        
        var progress_bar_wrap = $('[data-demo="' + matjar_import_demo_name + '"]').closest('.matjar-import-demo-popup').find('.import-process');
        progress_bar_wrap.find('.progress-percent').html(parseInt(matjar_import_percent)+'%');  
        progress_bar_wrap.find('.progress-bar').css('width',parseInt(matjar_import_percent)+'%');
	}
	
	function full_content_change() {
        $('.import_full_content').each(function () {
            var _this = $(this);
            if (_this.is(':checked')) {
                _this.closest('.import-options').find('input[type="checkbox"]').not(_this).attr('checked', false);
                _this.closest('.import-options').find('label').not(_this.parent()).css({
                    'pointer-events': 'none',
                    'opacity': '0.4'
                });
            } else {
                _this.closest('.import-options').find('label').not(_this.parent()).css({
                    'pointer-events': 'initial',
                    'opacity': '1'
                });
            }
        })
		if ($(".import-options input:checkbox:checked").length > 0)
		{
			$('.import-options').closest('.matjar-box-body').find('.install-demo').removeClass('disabled');
		}
		else
		{
		   $('.import-options').closest('.matjar-box-body').find('.install-demo').addClass('disabled');
		}
    }
    
    full_content_change();
    
    $(document).on('change', function () {
        full_content_change()
    });
	
});

/*
* Select service icon
*/
jQuery(function($){
		
	$('.fa-service-icons > span').on('click', function(e){
		var me = $(this);
		$(this).parent().find('span').removeClass('selected');
		me.addClass('selected');
		var icon = me.find('i').attr('id');
		
		me.parents('.fa-select-icon').find('.hidden_icon').val(icon);
	
	});
})
