jQuery(document).ready(function($){
	
	//toggle 3d navigation
	$('.cd-3d-nav-trigger').on('click', function(){
		toggle3dBlock(!$('.cd-header').hasClass('nav-is-visible'));
	});

	//select a new item from the 3d navigation
	$('.cd-3d-nav a').on('click', function(){
		var selected = $(this);
		selected.parent('li').addClass('cd-selected').siblings('li').removeClass('cd-selected');
		updateSelectedNav('close');
	});

	$(window).on('resize', function(){
		window.requestAnimationFrame(updateSelectedNav);
	});
   
	function toggle3dBlock(addOrRemove) {
		if(typeof(addOrRemove)==='undefined') addOrRemove = true;	
		$('.cd-header').toggleClass('nav-is-visible', addOrRemove);
		$('main').toggleClass('nav-is-visible', addOrRemove);
		$('.cd-3d-nav-container').toggleClass('nav-is-visible', addOrRemove);
	}

	//this function update the .cd-marker position
	function updateSelectedNav(type) {
		var selectedItem = $('.cd-selected'),
			selectedItemPosition = selectedItem.index() + 1, 
			leftPosition = selectedItem.offset().left,
			backgroundColor = selectedItem.data('color');

		$('.cd-marker').removeClassPrefix('color').addClass('color-'+ selectedItemPosition).css({
			'left': leftPosition,
		});
		if( type == 'close') {
			$('.cd-marker').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(){
				toggle3dBlock(false);
			});
		}
	}

	$.fn.removeClassPrefix = function(prefix) {
	    this.each(function(i, el) {
	        var classes = el.className.split(" ").filter(function(c) {
	            return c.lastIndexOf(prefix, 0) !== 0;
	        });
	        el.className = $.trim(classes.join(" "));
	    });
	    return this;
	};
});


	     



//for universal search
	$(document).ready(function(){
		$('#search').bind('keyup', function(){
			var searchTerm = jQuery.trim($(this).val());
            if(isNaN(searchTerm)){
			if(searchTerm == ''){
				$('#search-container ul').html('');
			}else{
				//send the data to the database
				$.ajax({
					url: 'search.php',
					type: 'GET',
					data: {s:searchTerm},
					beforeSend: function(){
						$('#search-container ul').html('<li class="loading"><img src="test/Preloader_4.gif" style="width:100%;"></li>');
					},
					success: function(data){
						var res =jQuery.parseJSON(data);
						$(res).each(function(key, value) {
							
							$('#search-container ul').append('<li onClick="direct('+value.s_id.toUpperCase()+')"><a id="'+value.s_id+'" href="student.php?stud='+value.s_id+'">' + value.s_name.toUpperCase() + '<span class="right">'+value.class.toUpperCase()+ ' '+value.section.toUpperCase()+'</span></a></li>');
						});
                        $('#search-container ul .loading').hide();
					}
				});
			}
            }else $('#search-container ul').html('');
		});
        
        		$('#seart').bind('keyup', function(){
			var searchTerm = jQuery.trim($(this).val());
            if(isNaN(searchTerm)){
			if(searchTerm == ''){
				$('#search-container ul').html('');
			}else{
				//send the data to the database
				$.ajax({
					url: 'search.php',
					type: 'GET',
					data: {ts:searchTerm},
					beforeSend: function(){
						$('#search-container ul').html('<li class="loading"><img src="test/Preloader_4.gif" style="width:100%;"></li>');
					},
					success: function(data){
						var res =jQuery.parseJSON(data);
						$(res).each(function(key, value) {
							
							$('#search-container ul').append('<li onClick="direct('+value.s_id.toUpperCase()+')"><a id="'+value.s_id+'" href="student.php?stud='+value.s_id+'">' + value.s_name.toUpperCase() + '<span class="right">'+value.class.toUpperCase()+ ' '+value.section.toUpperCase()+'</span></a></li>');
						});
                        $('#search-container ul .loading').hide();
					}
				});
			}
            }else $('#search-container ul').html('');
		});
        
        $('#search-container ul li a').click(function(){
            var id=$(this).attr('id');
            location.href='student.php?stud='+id+'';
;        });
        $('#search').bind('blur',function(){
            
        })
         $('#seart').bind('blur',function(){
            
        })
        
    
	});


       	// Wait for window load
		$(window).load(function() {
			// Animate loader off screen
			$(".se-pre-con").fadeOut("slow");;
		});



function direct(id){
              window.location='student.php?stud='+id+'';
          }
function direct2(id){
              window.location='outsider.php?stud='+id+'';
          }
function direct3(id){
              window.location='check_stud.php?id='+id+'';
          }

//for loading css and jss dynamically

function loadjscssfile(filename, filetype){
	if (filetype=="js"){ //if filename is a external JavaScript file
		var fileref=document.createElement('script')
		fileref.setAttribute("type","text/javascript")
		fileref.setAttribute("src", filename)
	}
	else if (filetype=="css"){ //if filename is an external CSS file
		var fileref=document.createElement("link")
		fileref.setAttribute("rel", "stylesheet")
		fileref.setAttribute("type", "text/css")
		fileref.setAttribute("href", filename)
	}
	if (typeof fileref!="undefined")
		document.getElementsByTagName("head")[0].appendChild(fileref)
}



function checkloadjscssfile(filename, filetype){
	if (filesadded.indexOf("["+filename+"]")==-1){
		loadjscssfile(filename, filetype)
		filesadded+="["+filename+"]" //List of files added in the form "[filename1],[filename2],etc"
	}
	else
		alert("file already added!")
}


 