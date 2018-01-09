
$(document).ready(function(){
  
	$('#check-search').keyup(function(e){
					var tosearch=$('#check-search').val();
					if(e.keyCode==8){
					$('#notif-today').scrollTo(0,1000);
	                $('#notif-before').scrollTo(0,1000);
					}
		else{
					if(tosearch.length>=4){
						tosearch.toString().trim();
						
						var which_to=$('a#notif-before').attr('class').trim();
						if(which_to==="green darken-3"){//if tab notif-before is not actif
							var today_id=$('u.today:contains('+tosearch+')').attr("id");
					
							$('ul#notif-today').scrollTo('#'+today_id,1000);
						}
						else if(which_to!=="green darken-3"){//else if notif-before is active
							var before_id=$('u.before:contains('+tosearch+')').attr("id");
				
							$('ul#notif-before').scrollTo('#'+before_id,1000);
						}
						else{
						alert("ok");
						}
						
					}else{
					}
		}});
		
		
		$('#noti-count').click(function(){
		$('#notification-form').slideToggle('up');
		});
				$('#notif-before').hide();
                function before(){
                 
					var before=1;
					$.ajax({
					url:'checking.php',
				    type:'GET',data:{content:before},
						success:function(data){
						if(data.length==0){
							
						} else{
							if(data==-1){
								notallw();
								return false;
							}
								
                            
            
							
							var result =jQuery.parseJSON(data);
$(result).each(function(key, value) {
	var book_don=value.book_no;
	var book_done=book_don.toString().replace('/','').replace('-','');
	var book_donee=book_done.replace('-','').replace('-','');
$('#notif-before').append('<li class="col s12"><div id="noti'+book_donee+'cad" class="card-panel waves-effect z-depth-1"><div class="row valign-wrapper"><div class="col s2"><img src="pictures/'+value.s_id+'.jpg" alt="" class="responsive-img"></div><div class="col s8"><div style="font-size:15px;margin-top: 15px;font-family: cursive;"><u id="noti'+book_donee+'cad" class="before">'+value.s_name+'</u><br><i>book:</i>'+value.book_title+'<br><i>book no:</i>'+value.book_no+'<br><i>rent on:</i>'+value.due_date+'<br><span class="preview"></span><span class="meta"></span></div></div><div class="col s2"><input  type="checkbox" style="height:40px;background-color: rgba(17, 132, 156); width: 40px;" id="'+value.s_id+'"class="check responsive" name="'+value.s_id+'" value="'+value.book_no+'" /></div></div></div></li>'); 
    $('.check').attr("disabled",false);
updtid=value.id;

     $('.check').click(function(){
        var student=$(this).attr("name");
        var book=$(this).attr("value");
          $(this).attr("disabled",true);
		 
		  var new_i=book.toString().replace('/','').replace('-','');
	var new_id='#noti'+new_i+'cad';
		 var check_id=new_id.replace('-','').replace('-','');
		 $(check_id).fadeOut(1000,function(){
			  $(this).remove();
		 });
        $.ajax({  
url:'checking.php',
type:'GET',
data:{s_id:student,book_no:book},
success: function(data){
}
});
 }); 
    
});
}	
	}
	});	}//end function before
			
				function  coun(){
				var count=1;
				$.ajax({
				url:'checking.php',
					type:'GET',
					data:{count:count},
					success:function(data){
				if(data.length==0){
				}else{
					if(data==-1){
						notallw();
						return false;
					}
				var count=data;
                    
				$('title').text("("+count+")non-checked");
					$('#count').html(".."+count+"");
				}
					}
				});
				}
			
                function updatenotif(){
                
       var updtid=$('#updtid').val();
                  
        updtid=parseInt(updtid);
        if(updtid==0){
        updtid=1;
        }else{updtid=updtid}
$.ajax({  
url:'checking.php',
type:'GET',
data:{id:updtid},
success: function(data){
    if(data.length==0){
	//if no result found	
    }
    else{
    	if(data==-1){
			notallw();
			return false;
		}
                        var audioElement = document.createElement('audio');
        audioElement.setAttribute('src', 'assets/sound.mp3');
        audioElement.setAttribute('autoplay', 'autoplay');
        //audioElement.load()

        $.get();

        audioElement.addEventListener("load", function() {
            audioElement.play();
        }, true);
var result =jQuery.parseJSON(data);
       
        
$(result).each(function(key, value) { 
	var book_don=value.book_no;
	var book_done=book_don.toString().replace('/','').replace('-','');
	var book_donee=book_done.replace('-','').replace('-','');
$('#notif-today').append('<li class="col s12"><div id="noti'+book_donee+'cad" class="card-panel waves-effect z-depth-1"><div class="row valign-wrapper"><div class="col s2"><img src="pictures/'+value.s_id+'.jpg" alt="" class="responsive-img"></div><div class="col s8"><div style="font-size:15px;margin-top: 15px;font-family: cursive;"><u id="noti'+value.s_name+'cad" class="today">'+value.s_name+'</u><br><i>book:</i>'+value.book_title+'<br><i>book no:</i>'+value.book_no+'<br><span class="preview"></span><span class="meta"></span></div></div><div class="col s2"><input  type="checkbox" style="height:40px;background-color: rgba(17, 132, 156); width: 40px;" id="'+value.s_id+'"class="check responsive" name="'+value.s_id+'" value="'+value.book_no+'" /></div></div></div></li>'); 
    $('.check').attr("disabled",false);
updtid=value.id;
    
     $('.check').click(function(){
        var student=$(this).attr("name");
        var book=$(this).attr("value");
          $(this).attr("disabled",true);
		 var new_i=book.toString().replace('/','').replace('-','');
	var new_id='#noti'+new_i+'cad';
		 var check_id=new_id.replace('-','').replace('-','');
		 $(check_id).fadeOut(1000,function(){
			  $(this).remove();
		 });
        $.ajax({  
url:'checking.php',
type:'GET',
data:{s_id:student,book_no:book},
success: function(data){
	
}
			
});
 }); 

});

    $('#updtid').val(updtid);

    }
}
});  

}
				before();
				setInterval(function(){updatenotif();
									   coun();
},1000);
function notallw(){
	alert("First log in to view this page");
	
	return false;
	//window.location='http://localhost/library/index1.php';
}

});
                
