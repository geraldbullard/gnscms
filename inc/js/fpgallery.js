/*!
	fpGallery v1.0 - 2013-06-08
	(c) 2013 Harry Ghazanian - foliopages.com/php-jquery-ajax-photo-gallery-no-database
	This content is released under the http://www.opensource.org/licenses/mit-license.php MIT License.
*/
$(function() {		
				
	var fpGalleryDir = './'; // fpgallery folder relative path - absolute path like http://my_website.com/fpgallery may not work
		
	// find divs with class fpGallery and load album in it based on its id
	$('.fpGallery').each(function() {
		
		var targetDiv = (this.id); // id of div to load albums
		var numPerPage = $('#'+targetDiv+' div.numPerPage').prop('title');
								
		if(targetDiv=='fpGallery') {
			var fullAlbum = 1;
			var showAlb = ''; // empty will show full gallery
		} else {
			var fullAlbum = 0;
			var showAlb = $('#'+targetDiv).prop('title'); // title attrubute of div - same as album folder
		}
		
		loadGallery(fpGalleryDir,targetDiv,showAlb,numPerPage,1,fullAlbum); // inital load
				
		// in gallery view, load album when thumb is clicked
		$(this).on('click', 'a.showAlb', function() {	
			var showAlb = $(this).prop('rel');
			loadGallery(fpGalleryDir,targetDiv,showAlb,numPerPage,1,fullAlbum);
			return false;
		});	
				
		// paginate albums and pics
		$(this).on('click', 'a.pag', function() {	
			var showAlb = $(this).prop('rel');
			var pageNum = $(this).prop('rev');
			loadGallery(fpGalleryDir,targetDiv,showAlb,numPerPage,pageNum,fullAlbum);
			return false;
		});
		
		// refresh div content
		$(this).on('click', 'a.refresh', function() {
		   loadGallery(fpGalleryDir,targetDiv,'',numPerPage,1,fullAlbum);
		   return false;
		});
				
		// colorbox
		$(this).on('click', 'a.albumpix', function() {$('#'+targetDiv+' .albumpix').colorbox({rel:targetDiv, slideshow:true, slideshowSpeed:3500, slideshowAuto:false}); });

	});
		
});

function loadGallery(fpgallerydir,targetdiv,album,numperpage,pagenum,fullalbum) {                    
	$.ajax
	({
		type: 'POST',
		url: fpgallerydir+'/fpgallery.php?'+album+'&p='+pagenum,
		data: {
			album: album,
			numperpage: numperpage,
			pagenum: pagenum,
			fullalbum: fullalbum
		},
		cache: false,
		success: function(msg)
		{
			$('#'+targetdiv).html(msg).css({ opacity: 0 }).fadeTo(100,1); 
		}
	});
	return false;
}