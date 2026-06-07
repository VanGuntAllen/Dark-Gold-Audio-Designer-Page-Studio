<!-- Template source_code -->

       




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vertical Sidebar Navbar</title>
    
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

 <style>  
        
        
        video{ /* video border */
        
         border: 1px solid #ccc;
          padding: 20px; margin: 10px;
           border-radius: 20px;
            /* tranzitionstransitions applied to the vodeovideo element */
             -moz-transition: all 1s ease-in-out; -webkit-transition: all 1s ease-in-out; -o-transition: all 1s ease-in-out; 
             -ms-transition: all 1s ease-in-out; transition: all 1s ease-in-out; 
             
             }
             
             /* background color and gradient */ 
             video,  #imagecapture, #captions,#html5videoplay, #play, #stop, #fwd,#rew,#slower,#faster,#restart,#normal,#full-screen,#stop, #pause, #plus, #minus, #mute,#g ,#g2 ,#g3 ,#g4 ,#g ,#g5 ,#g6 
             { /* background color */ background-color: #22cccc; 
             
             
             /* background gradient */ background-image: linear-gradient(top, #fff, #fcc); 
             background-image: -moz-linear-gradient(top, #fff, #fcc); background-image: -webkit-linear-gradient(top, #fff, #333);
 
                  }

/* shadows */ video, #imagecapture, #captions,#html5videoplay,#play, #stop, #fwd,#rew,#slower,#faster,#restart,#normal,#full-screen,#stop, #pause, #plus, #minus, #mute  
{ 

box-shadow: 0 0 10px #ccc; 

}

video:hover, video:focus, #play:hover, #fwd :hover,#rew,#slower:hover,#faster:hover,#restart:hover,#normal:hover, #full-screen:hover, #stop:hover, #pause:hover, #plus:hover, #minus:hover, #mute:hover 
{ 
/* glow */ 
box-shadow: 0 0 20px #888; 

}

#controls { display: none; margin: 10px 30px; } /* style for buttons */ #play, #fwd,#rew,#slower,#faster,#restart,#normal,#full-screen, #stop, #pause, #plus, #minus, #mute { border: 1px solid #ccc; padding: 5px; border-radius: 10px; width: 60px; margin: 0 10px 0 0; } body{ /* color tranzitiontransition */ -webkit-transition: background-color 1s ease-in-out; -moz-transition: background-color 1s ease-in-out; -o-transition: background-color 1s ease-in-out; -ms-transition: background-color 1s ease-in-out; transition: background-color 1s ease-in-out; /* initial color */ background-color: #fff; } #butterfly{ position: absolute; left: 0; top: -6px; background-image: url(butterfly.png); width: 40px; height: 40px; } #progressbar{ display: none; /* size */ width: 400px; height: 20px; /* position and border */ position: relative; border: 1px solid #ccc; margin: 10px; border-radius: 20px; /* background color */ background-color: #cccccc; /* background gradient */ background-image: linear-gradient(top, #fff, #ccc); background-image: -moz-linear-gradient(top, #fff, #ccc); background-image: -webkit-linear-gradient(top, #fff, #fcc); background-image: -o-linear-gradient(top, #fff, #ccc); background-image: -ms-linear-gradient(top, #fff, #ccc); /* shadow */ box-shadow: 0 0 10px #ccc; } #loadingprogress{ /* border */ border-radius: 20px; /* initial size */ height: 20px; width: 0; /* background color */ background-color: #9acd00; /* background gradient */ background-image: linear-gradient(top, #ffffff, #9acd00); background-image: -moz-linear-gradient(top, #ffffff, #9acd00); background-image: -webkit-linear-gradient(top, #ffffff, #9acd00); background-image: -o-linear-gradient(top, #ffffff, #9acd00); background-image: -ms-linear-gradient(top, #ffffff, #9acd00); }

 </style> 
        
                     
                       
           
<script type="text/javascript">
    // VGA video Master function, encapsulates all functions
    function init() {
        var video = document.getElementById('my_video');
        var thecanvas = document.getElementById('thecanvas');
        var img = document.getElementById('thumbnail_img');
        
        
        video.addEventListener('pause', function(){
                               
                               draw( video, thecanvas, img);
                               
                               }, false);
                               
                               
                               
                               
                               function draw( video, thecanvas, img ){
                                   
                                   // get the canvas context for drawing
                                   var context = thecanvas.getContext('2d');
                                   
                                   // draw the video contents into the canvas x, y, width, height
                                   context.drawImage( video, 0, 0, thecanvas.width, thecanvas.height);
                                   
                                   // get the image data from the canvas object
                                   var dataURL = thecanvas.toDataURL();
                                   
                                   // set the source of the img tag
                                   img.setAttribute('src', dataURL);
                                   
                               }
                               

              if (video.canPlayType) {   // tests that we have HTML5 video support
            // if successful, display buttons and set up events
            document.getElementById("buttonbar").style.display = "block";
            document.getElementById("inputField").style.display = "block";

            //  button events
            //  Play
            document.getElementById("play").addEventListener("click", vidplay, false);
            //  Restart
            document.getElementById("restart").addEventListener("click", function(){
                setTime(0);
             }, false);
            //  Skip backward 10 seconds
            document.getElementById("rew").addEventListener("click", function(){
                setTime(-10);                
            }, false);
            //  Skip forward 10 seconds
            document.getElementById("fwd").addEventListener("click", function(){
                setTime(10);
            }, false);                
            //  set src == latest video file URL
            document.getElementById("loadVideo").addEventListener("click", getVideo, false);
                            
            // fail with message 
            video.addEventListener("error", function(err) {
                errMessage(err);
            }, true);
            //  display video duration when available
            video.addEventListener("loadedmetadata", function () {
                                   vLength = video.duration.toFixed(1);
                                   document.getElementById("vLen").textContent = vLength; // global variable
                                   }, false);
                                   

            //  display the current and remaining times
            video.addEventListener("timeupdate", function () {
                                   //  Current time
                                   var vTime = video.currentTime;
                                   document.getElementById("curTime").textContent = vTime.toFixed(1);
                                   document.getElementById("vRemaining").textContent = (vLength - vTime).toFixed(1);
                                   }, false);
                                   
                                         //  button helper functions 
            //  skip forward, backward, or restart
            function setTime(tValue) {
            //  if no video is loaded, this throws an exception 
                try {
                    if (tValue == 0) {
                        video.currentTime = tValue;
                    }
                    else {
                        video.currentTime += tValue;
                    }
                    
                 } catch (err) {
                     // errMessage(err) // show exception
                 errMessage("Video content might not be loaded");
                   }
         }
             //  play video
             function vidplay(evt) {
                if (video.src == "") {  // on first run, src is empty, go get file
                    getVideo();
                }
                button = evt.target; //  get the button id to swap the text based on the state                                    
                if (video.paused) {   // play the file, and display pause symbol
                   video.play();
                   button.textContent = "||";
                } else {              // pause the file, and display play symbol  
                   video.pause();
                   button.textContent = ">";
                }                                        
            }
            //  load video file from input field
            function getVideo() {
                var fileURL = document.getElementById("videoFile").value;  // get input field                    
                if (fileURL != ""){
                   video.src = fileURL;
                   video.load();  // if HTML source element is used
                   document.getElementById("play").click();  // start play
                 } else {
                    errMessage("Enter a valid video URL");  // fail silently
                 }
            }
            
            
            //  display an error message 
            function errMessage(msg) {
            // displays an error message for 5 seconds then clears it
                document.getElementById("errorMsg").textContent = msg;
                setTimeout("document.getElementById('errorMsg').textContent=''", 5000);
            }
            // change volume based on incoming value
            function setVol(value) {
                var vol = video.volume;
                vol += value;
                //  test for range 0 - 1 to avoid exceptions
                if (vol >= 0 && vol <= 1) {
                    // if valid value, use it
                    video.volume = vol;
                } else {
                    // otherwise substitute a 0 or 1
                    video.volume = (vol < 0) ? 0 : 1;
                }
            }
            //  button events
            //  Play
            document.getElementById("play").addEventListener("click", vidplay, false);
            //  Restart
            document.getElementById("restart").addEventListener("click", function () {
                                                                setTime(0);
                                                                }, false);
            //  Skip backward 10 seconds
            document.getElementById("rew").addEventListener("click", function () {
            setTime(-10);
            }, false);
        //  Skip forward 10 seconds
        document.getElementById("fwd").addEventListener("click", function () {
        setTime(10);
        }, false);
        //  set src == latest video file URL
        document.getElementById("loadVideo").addEventListener("click", getVideo, false);
                                                                                                                                                                
    // fail with message
    video.addEventListener("error", function (err) {
    errMessage(err);
    }, true);
    // volume buttons
    document.getElementById("volDn").addEventListener("click", function () {
setVol(-.1); // down by 10%
}, false);
document.getElementById("volUp").addEventListener("click", function () {
setVol(.1);  // up by 10%
}, false);

// playback speed buttons
document.getElementById("slower").addEventListener("click", function () {
video.playbackRate -= .25;
}, false);
document.getElementById("faster").addEventListener("click", function () {
video.playbackRate += .25;
}, false);
document.getElementById("normal").addEventListener("click", function () {
video.playbackRate = 1;
}, false);


document.getElementById("mute").addEventListener("click", function (evt) {
if (video.muted) {
video.muted = false;
evt.target.innerHTML = "<i class ='fa fa-volume-up'></i>"
} else {
video.muted = true;
evt.target.innerHTML = " <i class ='fa fa-volume-off'></i>"
}
     }, false);
        } // end of runtime
    }// end of master
</script>

                       <script type="text/javascript">


function init() {
   
   hideDesign();
 
    hideSourceCode();
}
                       
                       
                     
                     
                     
                     
                     /* ---------------------------------------------------------------------- *\
                      Function    : hide   html5 video player()
                      Description : Hide the menus used for selecting the hide   html5 video player()
                      .
                      \* ---------------------------------------------------------------------- */
                       function hidehtml5videoPlayer() {
                           
                           document.getElementById('html5videoplayer').style.display = "none";
                       }
                       
                       
                       
                       /* ---------------------------------------------------------------------- *\
                        Function    : show   html5 video player()
                        Description : Hide the menus used for selecting show   html5 video player()
                        .
                        \* ---------------------------------------------------------------------- */
                       function showhtml5videoPlayer() {
                           
                           document.getElementById('html5videoplayer').style.display = "block";
                           
                           
                       }
                       
                       
                       

                     
                     
                     
                     
                     
                      
                      /* ---------------------------------------------------------------------- *\
                       Function    : hide   ImageCapture()
                       Description : Hide the menus used for selecting the hide  ImageCapture
                       .
                       \* ---------------------------------------------------------------------- */
                       function hideImageCapture() {
                           
                           document.getElementById('imagecapture').style.display = "none";
                       }
                       
                       
                       
                       /* ---------------------------------------------------------------------- *\
                        Function    : show  ImageCapture()
                        Description : Hide the menus used for selecting show  ImageCapture
                        .
                        \* ---------------------------------------------------------------------- */
                       function showImageCapture() {
                           
                           document.getElementById('imagecapture').style.display = "block";
                           
                           
                       }
                       
 
 
                      
                      
                      /* ---------------------------------------------------------------------- *\
                       Function    : hide  Captions()
                       Description : Hide the menus used for selecting the hide Captions
                       .
                       \* ---------------------------------------------------------------------- */
                       function hideCaptions() {
                           
                           document.getElementById('captions').style.display = "none";
                       }
                       
                       
                       
                       /* ---------------------------------------------------------------------- *\
                        Function    : show  Captions()
                        Description : Hide the menus used for selecting show Captions
                        .
                        \* ---------------------------------------------------------------------- */
                       function showCaptions() {
                           
                           document.getElementById('captions').style.display = "block";
                           
                           
                       }
                       
                       
                       /* ---------------------------------------------------------------------- *\
                        Function    : hide SourceCode()
                        Description : Hide the menus used for selecting the hide SourceCode
                     .
                        \* ---------------------------------------------------------------------- */
                       function hideSourceCode() {
                           
                           document.getElementById('source_code').style.display = "none";
                       }
                       
                       
                       
                       /* ---------------------------------------------------------------------- *\
                        Function    : show SourceCode()
                        Description : Hide the menus used for selecting show SourceCode
                       .
                        \* ---------------------------------------------------------------------- */
                       function showSourceCode() {
                           
                           document.getElementById('source_code').style.display = "block";
                           
                           
                       }
                       
                       
                       
                       
                       
                       /* ---------------------------------------------------------------------- *\
                        Function    : hide  iFrame Preview
                        Description : Hide the menus used for selecting the hide IFrame
                       .
                        \* ---------------------------------------------------------------------- */
                       function hideDesign() {
                           
                           document.getElementById('design').style.display = "none";
                       }
                       
                       
                       
                       /* ---------------------------------------------------------------------- *\
                        Function    : show  iFrame  Preview
                        Description : Show the menus used for selecting  Show iFrame
                        .
                        \* ---------------------------------------------------------------------- */
                       function showDesign() {
                           
                           document.getElementById('design').style.display = "block";
                           
                           
                       }
                       
                       
                       /* ---------------------------------------------------------------------- *\
                        Function    :  hide Body Properties()
                        Description : Hide the menus used for selecting the hide the  Body TextArea
                       .
                        \* ---------------------------------------------------------------------- */
                       
                        /* ---------------------------------------------------------------------- *\
                        Function    :  Show Page Body Properties()
                        Description : Show the menus used for selecting the show the  Body TextArea
                       .
                        \* ---------------------------------------------------------------------- */
                       
                       function showBody() {
                           
                           document.getElementById('body').style.display = "block";
                           
                       }
                       
                       /* ---------------------------------------------------------------------- *\
                        Function    : Hide Page Body Properties()
                        Description : Hide the menus used for selecting the  Body TextArea .
                        \* ---------------------------------------------------------------------- */
                       
                       function hideBody() {
                           
                           document.getElementById('body').style.display = "none";
                           
                       }

                         
                       
                       
                       
                       function showBodyProperties() {
                           
                           document.getElementById('body_properties').style.display = "block";
                           
                       }
                       
                       /* ---------------------------------------------------------------------- *\
                        Function    : show  Body Properties()
                        Description : Show the menus used for selecting the  Body TextArea .
                        \* ---------------------------------------------------------------------- */
                       
                       function hideBodyProperties() {
                           
                           document.getElementById('body_properties').style.display = "none";
                           
                       }

                         
                          /* ---------------------------------------------------------------------- *\
                        Function    :  hide Body Properties()
                        Description : Hide the menus used for selecting the hide the  Body TextArea
                       .
                        \* ---------------------------------------------------------------------- */
                       
                       function showSideBarMenu() {
                           
                           document.getElementById('side-bar-menu').style.display = "block";
                           
                       }
                       
                       /* ---------------------------------------------------------------------- *\
                        Function    : show  Body Properties()
                        Description : Show the menus used for selecting the  Body TextArea .
                        \* ---------------------------------------------------------------------- */
                       
                       function hideSideBarMenu() {
                           
                           document.getElementById('side-bar-menu').style.display = "none";
                           
                       }
                         
                     
                       
                       /* ---------------------------------------------------------------------- *\
                        Function    : show  VideoAdd
                        Description : Show the menus used for selecting the  Body TextArea .
                        \* ---------------------------------------------------------------------- */
                        
                            
                       function showVideoAdd() {
                           
                           document.getElementById('video-add').style.display = "block";
                           
                       }
                       /* ---------------------------------------------------------------------- *\
                        Function    :  hide VideoAdd
                        Description : Hide the menus used for selecting the hide the  Body TextArea
                       .
                        \* ---------------------------------------------------------------------- */
                       
                       function hideVideoAdd() {
                           
                           document.getElementById('video-add').style.display = "none";
                           
                       } 
                       
                       
                       
                         /* ---------------------------------------------------------------------- *\
                        Function    : show  Grid List
                        Description : Show the menus used for selecting the  Body TextArea .
                        \* ---------------------------------------------------------------------- */
                        
                            
                       function showGridList() {
                           
                           document.getElementById('gridlist').style.display = "block";
                           
                       }
                       /* ---------------------------------------------------------------------- *\
                        Function    :  hide VideoAdd
                        Description : Hide the menus used for selecting the hide the  Body TextArea
                       .
                        \* ---------------------------------------------------------------------- */
                       
                       function hideGridList() {
                           
                           document.getElementById('gridlist').style.display = "none";
                           
                       } 
                       
                       
                       
                         
                       /* ---------------------------------------------------------------------- *\
                        Function    : show  Audio Add
                        Description : Show the menus used for selecting the  Body TextArea .
                        \* ---------------------------------------------------------------------- */
                        
                            
                       function showAudioAdd() {
                           
                           document.getElementById('audio-add').style.display = "block";
                           
                       }
                       /* ---------------------------------------------------------------------- *\
                        Function    :  hide Audio Add
                        Description : Hide the menus used for selecting the hide the  Body TextArea
                       .
                        \* ---------------------------------------------------------------------- */
                       
                       function hideAudioAdd() {
                           
                           document.getElementById('audio-add').style.display = "none";
                           
                       } 
                       
                       
                       /* ---------------------------------------------------------------------- *\
                        Function    : show   FileManager 
                        Description : Show the menus used for selecting the  Body TextArea .
                        \* ---------------------------------------------------------------------- */
                        
                            
                       function showFileManager() {
                           
                           document.getElementById('file-manager').style.display = "block";
                           
                       }
                       /* ---------------------------------------------------------------------- *\
                        Function    :  hide  FileManager 
                        Description : Hide the menus used for selecting the hide the  Body TextArea
                       .
                        \* ---------------------------------------------------------------------- */
                       
                       function hideFileManager() {
                           
                           document.getElementById('file-manager').style.display = "none";
                           
                       }  
                        /* ---------------------------------------------------------------------- *\
                        Function    : show   MenuList  
                        Description : Show the menus used for selecting the MenuList  .
                        \* ---------------------------------------------------------------------- */
                        
                            
                       function showMenuList() {
                           
                           document.getElementById('menulist').style.display = "block";
                           
                       }
                       /* ---------------------------------------------------------------------- *\
                        Function    :  hide MenuList  
                        Description : Hide the menus used for selecting the hide the  MenuList 
                       .
                        \* ---------------------------------------------------------------------- */
                       
                       function hideMenuList() {
                           
                           document.getElementById('menulist').style.display = "none";
                           
                       }  
                       /* ---------------------------------------------------------------------- *\
                        Function    : show   MenuFooter 
                        Description : Show the menus used for selecting the MenuList  .
                        \* ---------------------------------------------------------------------- */
                        
                            
                       function showMenuFooter() {
                           
                           document.getElementById('menu-footer').style.display = "block";
                           
                       }
                       /* ---------------------------------------------------------------------- *\
                        Function    :  hide Mrnu Footer 
                        Description : Hide the menus used for selecting the hide the  MenuList 
                       .
                        \* ---------------------------------------------------------------------- */
                       
                       function hideMenuFooter() {
                           
                           document.getElementById('menu-footer').style.display = "none";
                           
                       }  
                       
                       
                       /* ---------------------------------------------------------------------- *\
                        Function    : show Template Properties()
                        Description : Show the Template window  .
                        \* ---------------------------------------------------------------------- */

                       function showTemplate() {
                           
                           document.getElementById('template').style.display = "block";
                           
                       }
                       
                       /* ---------------------------------------------------------------------- *\
                        Function    : hide  Template Properties()
                        Description : hide the  Template window.
                        \* ---------------------------------------------------------------------- */
                       
                       function hideTemplate() {
                           
                           document.getElementById('template').style.display = "none";
                           
                       }

                          /* ---------------------------------------------------------------------- *\
                        Function    : Show  Template window Properties()
                        Description : Show the Template window  .
                        \* ---------------------------------------------------------------------- */
                       function showTempStyle() {
                           
                           document.getElementById('tempstyle').style.display = "block";
                           
                       }
                       
                       /* ---------------------------------------------------------------------- *\
                        Function    : hide  Template window Properties()
                        Description : hide the Template window  .
                        \* ---------------------------------------------------------------------- */
                       
                       function hideTempStyle() {
                           
                           document.getElementById('tempstyle').style.display = "none";
                           
                       }


                      
                       
          
             /* ---------------------------------------------------------------------- *\
                        Function    : Show  Add-Social-Media window Properties()
                        Description : Show the Template window  .
                        \* ---------------------------------------------------------------------- */
                       function showSocialMedia() {
                           
                           document.getElementById('add-social-media').style.display = "block";
                           
                       }
                       
                       /* ---------------------------------------------------------------------- *\
                        Function    : hide  Template window Properties()
                        Description : hide the Template window  .
                        \* ---------------------------------------------------------------------- */
                       
                       function hideSocialMedia() {
                           
                           document.getElementById('add-social-media').style.display = "none";
                           
                       }

          
          
          
          
                       
       
                           </script>
            
    <script src="https://vga.smtvs.com/dark-gold/js/form.js"></script>                  
                       
          
 
<script type="text/javascript">
      

      
      
    function Buildhtml5(form, Action){
        var Buildhtml5="";
        var html5="";
        
        
        if(Action==1){
            if(html5!=null)  {
 
  
  
   Buildhtml5 += "<div id=\"video\">\n" ;
  
  
    Buildhtml5 += " <video id=\"vga_player\" width=\"550\" height=\"310\" autoplay  poster=\""+form.html5player_poster.value+"\" preload=\""+form.html5player_preload.value+"\" type=\"video/mp4\" >\n" ;
      Buildhtml5 += " <source src=\""+form.videoFile.value+"\">\n" ;
    Buildhtml5 += "<object width=\"640\" height=\"377\" id=\"videoPlayer\" name=\"videoPlayer\" type=\"application/x-shockwave-flash\" classid=\"clsid:d27cdb6e-ae6d-11cf-96b8-444553540000\" >\n" ;
 

	   Buildhtml5 += "	<param name=\"allowfullscreen\" value=\"true\">\n" ;
	   Buildhtml5 += " <param name=\"allowscriptaccess\" value=\"always\">\n" ;
	   Buildhtml5 += " <param name=\"flashvars\" value=\"file="+form.videoFile.value+"\">\n" ;
	
	   Buildhtml5 += "	<param name=\"movie\" value=\"videoPlayer.swf\" />\n" ;
	 Buildhtml5 += "<img src=\"video.jpg\" width=\"854\" height=\"480\" alt=\"Video\">\n" ;
	 Buildhtml5 += "<p>Your browser can’t play HTML5 video. <a href=\""+form.videoFile.value+"\">Download it</a> instead.</p>\n" ;
	 Buildhtml5 += "</object>\n" ;
     Buildhtml5 += "</video>\n" ;
    
    
    Buildhtml5 += " <div id=\"video_controls_bar\">\n" ;
     
      Buildhtml5 += " <button id=\"playpausebtn\"><i class =\"fa fa-play\" ></i></button>\n" ;
   Buildhtml5 += "<input id=\"seekslider\" type=\"range\" min=\"0\" max=\"100\" value=\"0\" step=\"1\">\n" ;
     Buildhtml5 += " <span id=\"curtimetext\">00:00</span> / <span id=\"durtimetext\">00:00</span>\n" ;
      Buildhtml5 += " <button id=\"mutebtn\"><i class =\'fa fa-volume-up\'></i></button>\n" ;
     Buildhtml5 += "  <input id=\"volumeslider\" type=\"range\" min=\"0\" max=\"100\" value=\"100\" step=\"1\">\n" ;
     Buildhtml5 += " <button id=\"fullscreenbtn\"><i class =\"fa fa-desktop\" ></i> </button>\n" ;
   
     Buildhtml5 += " </div>\n" ;
  
         
 Buildhtml5 += "</div>\n";
        
    }
}



        if(Action==2){
            if(html5!=null)  {
 
   Buildhtml5 += "<link rel=\"stylesheet\" href=\"https://vga.smtvs.com/css/playerfun-8.css\">\n" ;
  
     Buildhtml5 += " <div  id=\"vga-video_player\" ><center>\n" ;
     


   Buildhtml5 += " <table  width=\""+form.tablesize.value+"\" class=\"center\">\n" ;
 
     Buildhtml5 += " <tr>\n" ;
       Buildhtml5 += " <td>\n" ;
   Buildhtml5 += " <div id=\"video_container\" >\n" ;
   Buildhtml5 += " <video id=\"vga_player\" preload=\"metadata\" playsinline   style=\"  height:450px;\">\n" ;
   Buildhtml5 += " <source src=\""+form.videoFile.value+"\" type=\"video/mp4\">\n" ;
   Buildhtml5 += " <source src=\"\" type=\"video/webm\">\n" ;

 
   Buildhtml5 += " </video>\n" ;
   Buildhtml5 += " <div id=\"video_controls_bar\"  style=\"font-size: 10px; font-family: arial, verdana, helvetica, sans serif; margin-left: 1px; color:#ffffff;\">\n" ;
   Buildhtml5 += " &nbsp;&nbsp; <button id=\"playpausebtn\"><i class =\'fa fa-play\'></i></button>\n" ;
   Buildhtml5 += "   &nbsp;\n" ;
   Buildhtml5 += " <span id=\"curtimetext\">00:00</span>\n" ; 
   Buildhtml5 += " <input id=\"seekslider\" type=\"range\" min=\"0\" max=\"100\" value=\"0\" step=\"\" >\n" ;
   Buildhtml5 += " &nbsp;\n" ;
    Buildhtml5 += " <button id=\"mutebtn\"><i class =\'fa fa-volume-up\'></i></button>\n" ;
   Buildhtml5 += " &nbsp;&nbsp;\n" ;

     Buildhtml5 += " <input id=\"volumeslider\" type=\"range\" min=\"0\" max=\"100\" value=\"100\" step=\"1\">\n" ;
   Buildhtml5 += " &nbsp;\n" ;
   Buildhtml5 += " &nbsp;\n" ;

    Buildhtml5 += " <button id=\"fullscreenbtn\">\n" ;
   Buildhtml5 += " <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-arrows-fullscreen\" viewBox=\"0 0 16 16\">\n" ;
     Buildhtml5 += " <path fill-rule=\"evenodd\" d=\"M5.828 10.172a.5.5 0 0 0-.707 0l-4.096 4.096V11.5a.5.5 0 0 0-1 0v3.975a.5.5 0 0 0 .5.5H4.5a.5.5 0 0 0 0-1H1.732l4.096-4.096a.5.5 0 0 0 0-.707zm4.344 0a.5.5 0 0 1 .707 0l4.096 4.096V11.5a.5.5 0 1 1 1 0v3.975a.5.5 0 0 1-.5.5H11.5a.5.5 0 0 1 0-1h2.768l-4.096-4.096a.5.5 0 0 1 0-.707zm0-4.344a.5.5 0 0 0 .707 0l4.096-4.096V4.5a.5.5 0 1 0 1 0V.525a.5.5 0 0 0-.5-.5H11.5a.5.5 0 0 0 0 1h2.768l-4.096 4.096a.5.5 0 0 0 0 .707zm-4.344 0a.5.5 0 0 1-.707 0L1.025 1.732V4.5a.5.5 0 0 1-1 0V.525a.5.5 0 0 1 .5-.5H4.5a.5.5 0 0 1 0 1H1.732l4.096 4.096a.5.5 0 0 1 0 .707z\"/>\n" ;
   Buildhtml5 += " </svg>\n" ;
   Buildhtml5 += " </button> &nbsp;\n" ;
    Buildhtml5 += " <p>\n" ;
         Buildhtml5 += "   <button ><img src=\""+ document.getElementById("station-img").value +"\" width=\"70\" height=\"20\" alt=\"\" class=\"img-responsive\"></button>&nbsp;&nbsp;\n" ;
           Buildhtml5 += "       </p>\n" ;
    Buildhtml5 += " </div>\n" ;
    Buildhtml5 += " </div>\n" ;
  
  		
  
  
 Buildhtml5 += "<script src=\"https://vga.smtvs.com/js/playerfun.js\">n" ;  Buildhtml5 += "<\/script>\n" ;


  
  
       
    }
}


  
        if(Action==3){
            if(html5!=null)  {
 
  
   Buildhtml5 += " <div id=\"video_container\" >\n" ;
   Buildhtml5 += " <video id=\"vga_player\" preload=\"metadata\" playsinline   style=\"  height:450px;\">\n" ;
   Buildhtml5 += ""+ document.getElementById("text").value +"\n"; 
   Buildhtml5 += " </video>\n" ;
   Buildhtml5 += " <div id=\"video_controls_bar\"  style=\"font-size: 10px; font-family: arial, verdana, helvetica, sans serif; margin-left: 1px; color:#ffffff;\">\n" ;
   Buildhtml5 += " &nbsp;&nbsp; <button id=\"playpausebtn\"><i class =\'fa fa-play\'></i></button>\n" ;
   Buildhtml5 += "   &nbsp;\n" ;
   Buildhtml5 += " <span id=\"curtimetext\">00:00</span>\n" ; 
   Buildhtml5 += " <input id=\"seekslider\" type=\"range\" min=\"0\" max=\"100\" value=\"0\" step=\"\" >\n" ;
   Buildhtml5 += " &nbsp;\n" ;
    Buildhtml5 += " <button id=\"mutebtn\"><i class =\'fa fa-volume-up\'></i></button>\n" ;
   Buildhtml5 += " &nbsp;&nbsp;\n" ;

     Buildhtml5 += " <input id=\"volumeslider\" type=\"range\" min=\"0\" max=\"100\" value=\"100\" step=\"1\">\n" ;
   Buildhtml5 += " &nbsp;\n" ;
   Buildhtml5 += " &nbsp;\n" ;

    Buildhtml5 += " <button id=\"fullscreenbtn\">\n" ;
   Buildhtml5 += " <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-arrows-fullscreen\" viewBox=\"0 0 16 16\">\n" ;
     Buildhtml5 += " <path fill-rule=\"evenodd\" d=\"M5.828 10.172a.5.5 0 0 0-.707 0l-4.096 4.096V11.5a.5.5 0 0 0-1 0v3.975a.5.5 0 0 0 .5.5H4.5a.5.5 0 0 0 0-1H1.732l4.096-4.096a.5.5 0 0 0 0-.707zm4.344 0a.5.5 0 0 1 .707 0l4.096 4.096V11.5a.5.5 0 1 1 1 0v3.975a.5.5 0 0 1-.5.5H11.5a.5.5 0 0 1 0-1h2.768l-4.096-4.096a.5.5 0 0 1 0-.707zm0-4.344a.5.5 0 0 0 .707 0l4.096-4.096V4.5a.5.5 0 1 0 1 0V.525a.5.5 0 0 0-.5-.5H11.5a.5.5 0 0 0 0 1h2.768l-4.096 4.096a.5.5 0 0 0 0 .707zm-4.344 0a.5.5 0 0 1-.707 0L1.025 1.732V4.5a.5.5 0 0 1-1 0V.525a.5.5 0 0 1 .5-.5H4.5a.5.5 0 0 1 0 1H1.732l4.096 4.096a.5.5 0 0 1 0 .707z\"/>\n" ;
   Buildhtml5 += " </svg>\n" ;
   Buildhtml5 += " </button> &nbsp;\n" ;
    Buildhtml5 += " <p>\n" ;
     Buildhtml5 += "   <button ><img src=\""+ document.getElementById("station-img").value +"\" width=\"70\" height=\"20\" alt=\"\" class=\"img-responsive\"></button>&nbsp;&nbsp;\n" ;
          
Buildhtml5 += " </div>\n" ;
Buildhtml5 += " </div>\n" ;
 
     
       
    }
}
   
  

  if(Action==4){
            if(html5!=null)  {
 
  
                        Buildhtml5 += " <ul>";
                         Buildhtml5 += "        <li class=\"xtitle\">"+videotitle.value+"</li>\r\n";
                         Buildhtml5 += "        <li class=\"xdesc\">"+ document.getElementById("text3").value +"</li>\r\n";
                                
                             Buildhtml5 += "    <li class=\"xthumb\">"+form.html5player_poster.value+"</li>\r\n";
                             Buildhtml5 += "    <li class=\"xpreview\">"+form.html5player_poster.value+"</li>\r\n";

                            

                             Buildhtml5 += " <li class=\"xsources_mp4\">"+ document.getElementById("videoFile").value +"</li>\r\n";

                             Buildhtml5 += "   <li class=\"xsources_webm\">videos/rightsideplaylist/big_buck_bunny_trailer.webm</li>\r\n";
                          Buildhtml5 += "   </ul>\r\n";
                          
  
   }


} 



if(Action==5){
            if(html5!=null)  {
        
        Buildhtml5 += " <div class=\"audioplayer-tobe skin-wave skin-wave-mode-bigwavo button-aspect-noir\" data-fakeplayer=\""+footerplayer.value+"\"  data-thumb=\""+songImage.value+"\"data-playerid=\"3232322\" data-type=\"audio\" data-source=\""+songFile.value+"\">\n";
        Buildhtml5 += "   <div class=\"meta-artist\"><span class=\"the-artist\"><strong>"+artisttitle.value+"</strong></span><span class=\"the-name\">\n";
        Buildhtml5 += " <a href=\""+artistURL.value+"\" target=\"_blank\">"+songTitle.value+"</a></span></div>\n";
          Buildhtml5 += " <div class=\"feed-description\">"+text4.value+"</div> </div>\n";
          Buildhtml5 += " <P>"+text5.value+"</P><blockquote><i class=\"fas fa-quote-left\" aria-hidden=\"true\"></i><p>.</p></blockquote>\n";
  
 }
} 


if(Action==6){
 if(html5!=null)  {
   
Buildhtml5 += "<div class=\"vplayer-tobe hide-on-mouse-out\" data-videoTitle=\"\" data-type=\"youtube\" data-src=\""+videoFile.value+"\"><div class=\"menuDescription\"><img src=\""+form.html5player_poster.value+"\" class=\"imgblock\"/><div class=\"the-title\">"+videotitle.value+"</div>"+text3.value+"</div> </div>\n";    
       
       }
} 



if(Action==7){
 if(html5!=null)  {
   
Buildhtml5 += "<div class=\"vplayer-tobe\" data-videoTitle=\"VGA Video\" data-sourcevp=\""+videoFile.value+"\" ><div class=\"menuDescription\"><img src=\""+form.html5player_poster.value+"\" class=\"imgblock\"/><div class=\"the-title\">"+videotitle.value+"</div>"+text3.value+"</div></div>\n";  


      } 
 }
 
if(Action==8){
 if(html5!=null)  {
   
       
Buildhtml5 += "<div class=\"col-md-3 col-sm-6 hero-feature\">\n"; 
Buildhtml5 += "<div class=\"thumbnail\">\n"; 
  Buildhtml5 += "<img src=\""+ document.getElementById("product-image").value +"\" alt=\"\">\n"; 
 Buildhtml5 += " <div class=\"caption\">\n"; 
  Buildhtml5 += "  <h4>"+ document.getElementById("text-header").value +"</h4>\n"; 
  Buildhtml5 += "<p><font size=\"\" face=\"Constantia\"  color=\"\" >"+ document.getElementById("product-text").value +"</p></font>\n"; 
  
Buildhtml5 += "<div class=\"product-card-info\">\n";
Buildhtml5 += "<div class=\"rating-star text\"><i class=\"bi bi-star-fill active\"></i> <i class=\"bi bi-star-fill active\"></i> <i class=\"bi bi-star-fill active\"></i> <i class=\"bi bi-star-fill active\"></i> <i class=\"bi bi-star\"></i></div>\n";
Buildhtml5 += "<h6 class=\"product-title\"><a href=\"#\">One wish</a></h6>\n";

Buildhtml5 += "<div class=\"product-price\"><span class=\"text-primary\">"+ document.getElementById("product-price").value +"<small></small></span> <del class=\"fs-sm text-muted\"><small></small></del></div>\n";

Buildhtml5 += " <div class=\"product-action\"><a href=\"#\" class=\"btn\"><i class=\"fa fa-heart\"></i> </a><a href=\"#\" class=\"btn\"><i class=\"fa fa-repeat\"></i> </a><a data-bs-toggle=\"modal\" data-bs-target=\"#px-quick-view\" href=\""+ document.getElementById("buy").value +"\"></a> <a href=\""+ document.getElementById("info-url").value +"\" class=\"btn\" target=\"new\"><i class=\"fa fa-eye\"></i> </a>\n";


Buildhtml5 += "<a href=\""+ document.getElementById("paypal-email").value +"\" class=\"btn\"><i class=\"fa fa-shopping-cart\"></i></a>\n";
                        Buildhtml5 += " </div>\n";
                     Buildhtml5 += "</div>\n";
  
  
  Buildhtml5 += "  </p>\n";
Buildhtml5 += " </div>\n";
 Buildhtml5 += "</div>\n";
Buildhtml5 += "</div>\n";
       
       
       }
} 

if(Action==9){
 if(html5!=null)  {
   
       
Buildhtml5 += "<div class=\"col-md-3 col-sm-6\">\n"; 
Buildhtml5 += "<div class=\"overlay-effect effects clearfix\">\n"; 
Buildhtml5 += "<div class=\"img\">\n"; 

 
 
  Buildhtml5 += " <a href=\""+form.html5player_poster.value+"\"  data-lightbox=\"roadtrip\" title=\""+videotitle.value+"\"><img class=\"grayscale\" src=\""+form.html5player_poster.value+"\" alt=\"\"></a> \n"; 
  
Buildhtml5 += " </div>\n";
 Buildhtml5 += "</div>\n";
Buildhtml5 += "</div>\n";
       
       
       }
} 




if(Action==10){
 if(html5!=null)  {

     
			Buildhtml5 += "	<div class=\"elementor-element elementor-element-95e904d elementor-widget elementor-widget-lucille-section-subtitle\" data-id=\"95e904d\" data-element_type=\"widget\" data-widget_type=\"lucille-section-subtitle.default\">\n";
			Buildhtml5 += "	<div class=\"elementor-widget-container\">\n";
		Buildhtml5 += "	<h4 class=\"section_subtitle lcl_elt_section_subtitle\">Tinashe - Company</h4>		</div>\n";
			Buildhtml5 += "	</div>\n";
				
			Buildhtml5 += "	<div class=\"elementor-element elementor-element-d4df8fe elementor-widget elementor-widget-spacer\" data-id=\"d4df8fe\" data-element_type=\"widget\" data-widget_type=\"spacer.default\">\n";
		Buildhtml5 += "		<div class=\"elementor-widget-container\">\n";
		Buildhtml5 += "			<div class=\"elementor-spacer\">\n";
		Buildhtml5 += "	<div class=\"elementor-spacer-inner\"></div>\n";
	Buildhtml5 += "	</div>\n";
	Buildhtml5 += "			</div>\n";
	Buildhtml5 += "			</div>\n";
	
	Buildhtml5 += "		<div class=\"elementor-element elementor-element-97017db elementor-widget elementor-widget-lucille-featured-music-album\" data-id=\"97017db\" data-element_type=\"widget\" data-widget_type=\"lucille-featured-music-album.default\">\n";
	Buildhtml5 += "				<div class=\"elementor-widget-container\">\n";
	Buildhtml5 += "					<div class=\"lc_swp_boxed clearfix\">\n";
	Buildhtml5 += "			<div class=\"album_left vc_elem_album\">\n";
	Buildhtml5 += "				<a href=\"https://smartwpress.com/lucille3/js_albums/stereotypes/\">\n";
	Buildhtml5 += "					<img fetchpriority=\"high\" width=\"559\" height=\"559\" src=\"https://smartwpress.com/lucille3/wp-content/uploads/2016/11/Stereotypes.jpg\" class=\"attachment-post-thumbnail size-post-thumbnail wp-post-image\" alt=\"\" decoding=\"async\" srcset=\"https://smartwpress.com/lucille3/wp-content/uploads/2016/11/Stereotypes.jpg 559w, https://smartwpress.com/lucille3/wp-content/uploads/2016/11/Stereotypes-100x100.jpg 100w, https://smartwpress.com/lucille3/wp-content/uploads/2016/11/Stereotypes-150x150.jpg 150w, https://smartwpress.com/lucille3/wp-content/uploads/2016/11/Stereotypes-300x300.jpg 300w\" sizes=\"(max-width: 559px) 100vw, 559px\" /></a>\n";
	Buildhtml5 += "			</div>\n";
			
	Buildhtml5 += "			<div class=\"album_right vc_elem_album\">\n";
			    
	Buildhtml5 += "				<iframe width=\"100%\" height=\"450\" scrolling=\"no\" frameborder=\"no\" src=\"https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/playlists/30870743&amp;color=f5034a&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false\"><\/iframe>\n";
			
			
	Buildhtml5 += "				<div class=\"small_content_padding lc-elt-album-content\">\n";
	Buildhtml5 += "									</div>\n";

	Buildhtml5 += "				<div class=\"lc_event_entry text_left\">\n";
	Buildhtml5 += "											<div class=\"lc_button album_buy_from lc-elt-buy-from\">\n";
	Buildhtml5 += "							<a target=\"_blank\" href=\"http://www.amazon.com\">\n";
	Buildhtml5 += "								Amazon							</a>\n";
	Buildhtml5 += "						</div>\n";
					
	Buildhtml5 += "											<div class=\"lc_button album_buy_from lc-elt-buy-from\">\n";
	Buildhtml5 += "							<a target=\"_blank\" href=\"http://itunes.apple.com\">\n";
	Buildhtml5 += "								iTunes							</a>\n";
	Buildhtml5 += "						</div>\n";
					
	Buildhtml5 += "											<div class=\"lc_button album_buy_from lc-elt-buy-from\">\n";
	Buildhtml5 += "							<a target=\"_blank\" href=\"http://www.soundcloud.com\">\n";
	Buildhtml5 += "								SoundCloud							</a>\n";
	Buildhtml5 += "						</div>\n";
					
					
	Buildhtml5 += "											<div class=\"lc_button album_buy_from lc-elt-buy-from\">\n";
	Buildhtml5 += "							<a target=\"_blank\" href=\"https://play.google.com/store\">\n";
	Buildhtml5 += "								GooglePlay							</a>\n";
	Buildhtml5 += "						</div>\n";
					
	Buildhtml5 += "									</div>\n";			
	Buildhtml5 += "			</div>\n";
			
	
	
	
	
	
       }
} 

          
if(Action==11){
            if(html5!=null)  {
          
          
           Buildhtml5 += "<div class=\"heading_titles_container\">\n";
			
		Buildhtml5 += "	<div class=\"heading_area_title title_centered swp_page_title\">\n";
		Buildhtml5 += "		<h1 class=\"entry-title title_centered swp_page_title\">"+artisttitle.value+"</h1>\n";
		Buildhtml5 += "	</div>\n";

	Buildhtml5 += "	</div>\n";
	Buildhtml5 += "	<div id=\"lc_swp_content\" data-minheight=\"150\" style=\"min-height: 150px;\">\n";
	
  Buildhtml5 += "    <div class=\"lc_content_full lc_swp_boxed lc_basic_content_padding\">\n";
Buildhtml5 += "	<div class=\"album_left\">\n";
Buildhtml5 += "		<img fetchpriority=\"high\" width=\"600\" height=\"600\" src=\""+songImage.value+"\" class=\"attachment-large size-large wp-post-image\" alt=\"\" decoding=\"async\" srcset=\""+songImage.value+" 600w, "+songImage.value+" 300w, "+songImage.value+" 100w, "+songImage.value+" 450w, "+songImage.value+" 150w\" sizes=\"(max-width: 600px) 100vw, 600px\">\n";
Buildhtml5 += "		<div class=\"lc_event_entry after_album_cover\">\n";
	Buildhtml5 += "	<i class=\"far fa-calendar-alt\" aria-hidden=\"true\"></i>\n";
							
	Buildhtml5 += "	</div>\n";

			Buildhtml5 += "	<div class=\"lc_event_entry\">\n";
			Buildhtml5 += "			<span class=\"album_detail_name\">Tag:</span>	\n";	
			Buildhtml5 += "			</div>\n";
		
			Buildhtml5 += "	<div class=\"lc_event_entry\">\n";
		Buildhtml5 += "	<span class=\"album_detail_name\">Producer:</span>\n";
		Buildhtml5 += "	</div>\n";
				
		Buildhtml5 += "		<div class=\"lc_event_entry\">\n";
		Buildhtml5 += "	<span class=\"album_detail_name\">Number of discs:</span>\n";
		Buildhtml5 += "	</div>\n";
		
	     Buildhtml5 += "<div class=\"lc_event_entry small_content_padding clearfix\">\n";
					
		   Buildhtml5 += "		</div>\n";
	   Buildhtml5 += "</div>\n";

	   Buildhtml5 += "<div class=\"album_right\">\n";
	    
	    Buildhtml5 += " <div class=\"audioplayer-tobe skin-wave skin-wave-mode-bigwavo button-aspect-noir\" data-fakeplayer=\"\"  data-thumb=\""+songImage.value+"\"data-playerid=\"3232322\" data-type=\"audio\" data-source=\""+songFile.value+"\">\n";
      Buildhtml5 += "<div class=\"meta-artist\"><span class=\"the-artist\"><strong>"+artisttitle.value+"</strong></span><span class=\"the-name\">\n";
   Buildhtml5 += " <a href=\""+artistURL.value+"\" target=\"_blank\">"+songTitle.value+"</a></span></div>\n";
    Buildhtml5 += "<div class=\"feed-description\">"+text4.value+"</div> </div>\n";
   
	   Buildhtml5 += " <P>"+text5.value+"</P><blockquote><i class=\"fas fa-quote-left\" aria-hidden=\"true\"></i><p>.</p></blockquote>\n";
   Buildhtml5 += "	<div class=\"clearfix\"></div>\n";
   Buildhtml5 += "	<div class=\"lc_sharing_icons\">\n";
	   Buildhtml5 += "	<span class=\"lc_share_item_text\">Share:</span>\n";
	   Buildhtml5 += "	<a href=\"\" target=\"_blank\" class=\"lc_share_item\">\n";
	   Buildhtml5 += "		<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-twitter-x\" viewBox=\"0 0 16 16\">\n";
     Buildhtml5 += "<path d=\"M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865z\"/>\n";
   Buildhtml5 += "</svg>\n";
   Buildhtml5 += "		</a>\n";	

	   Buildhtml5 += "	<a href=\"\" target=\"_blank\" class=\"lc_share_item\">\n";
	   Buildhtml5 += "		<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-facebook\" viewBox=\"0 0 16 16\">\n";
    Buildhtml5 += " <path d=\"M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951\"/>\n";
   Buildhtml5 += "</svg>\n";
	   Buildhtml5 += "	</a>\n";

		
	   Buildhtml5 += "		</div>\n";
	
   Buildhtml5 += "<div class=\"clearfix\"></div>\n";
	   Buildhtml5 += "				<div class=\"lc_embed_video_container_full album_cpt_video\">\n";
	   Buildhtml5 += "				 <iframe width=\"560\" height=\"315\" src=\""+yout.value+"\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen><\/iframe> \n";  
		  	    
		   Buildhtml5 += "	</div>\n";
		   Buildhtml5 += "	</div>\n";

	   Buildhtml5 += "<div class=\"clearfix\"></div>\n";
   Buildhtml5 += "</div>\n";	

	
	   Buildhtml5 += "</div>\n";
	   
	   

      } 
 }
	   

if(Action==12){
            if(html5!=null)  {
            
	Buildhtml5 += "	<div class=\"heading_titles_container\">\n";
			
		Buildhtml5 += "	<div class=\"heading_area_title title_centered swp_page_title\">\n";
	Buildhtml5 += "			<h2 class=\"entry-title title_centered swp_page_title\">"+artisttitle.value+"</h1>\n";
	Buildhtml5 += "		</div>\n";

	Buildhtml5 += "	</div>\n";

			
	Buildhtml5 += "	<div class=\"lc_post_meta lc_cpt_category cpt_post_meta lc_swp_full\">\n";
	Buildhtml5 += "				<span class=\"meta_entry lc_cpt_category\">\n";
	Buildhtml5 += "	 </span>\n";
	Buildhtml5 += "	 </div>\n";
	Buildhtml5 += "	 </div>\n";
   Buildhtml5 += "   </div>\n";
	Buildhtml5 += "	<div id=\"lc_swp_content\" data-minheight=\"150\">\n";
					


			
		
Buildhtml5 += "	<div class=\"lc_swp_boxed swp_artist_social_web clearfix\">\n";
Buildhtml5 += "		<div class=\"artist_website artist_single\">\n";
	Buildhtml5 += "<a href=\""+artistURL.value+"\" target=\"_blank\">Official website</a></div>\n";

	Buildhtml5 += "	<div class=\"artist_social_single\">\n";
	Buildhtml5 += "	<span class=\"artist_follow\">Follow:</span>\n";
			
		Buildhtml5 += "	<div class=\"artist_social_profile artist_single\">\n";
	Buildhtml5 += "	<a href=\""+facebook.value+"\" target=\"_blank\">\n";
	Buildhtml5 += "	<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-facebook\" viewBox=\"0 0 16 16\">\n";
 Buildhtml5 += " <path d=\"M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951\"/>\n";
Buildhtml5 += "</svg></a>\n";
Buildhtml5 += "</div>\n";
Buildhtml5 += "	<div class=\"artist_social_profile artist_single\">\n";
Buildhtml5 += "	<a href=\""+twitter.value+"\" target=\"_blank\">\n";
Buildhtml5 += "	<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-twitter-x\" viewBox=\"0 0 16 16\">\n";
 Buildhtml5 += " <path d=\"M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865z\"/>\n";
Buildhtml5 += "</svg></a>\n";
Buildhtml5 += "	</div>\n";

Buildhtml5 += "	<div class=\"artist_social_profile artist_single\">\n";
Buildhtml5 += "	<a href=\""+instagram.value+"\" target=\"_blank\">\n";
Buildhtml5 += "	<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-instagram\" viewBox=\"0 0 16 16\">\n";
  Buildhtml5 += "<path d=\"M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334\"/>\n";
Buildhtml5 += "</svg></a>\n";
Buildhtml5 += "	</div>\n";

Buildhtml5 += "	<div class=\"artist_social_profile artist_single\">\n";
Buildhtml5 += "	<a href=\""+youtube.value+"\" target=\"_blank\">\n";
Buildhtml5 += "	<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-youtube\" viewBox=\"0 0 16 16\">\n";
 Buildhtml5 += " <path d=\"M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.01 2.01 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.01 2.01 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31 31 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.01 2.01 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A100 100 0 0 1 7.858 2zM6.4 5.209v4.818l4.157-2.408z\"/>\n";
Buildhtml5 += "</svg></a>\n";
Buildhtml5 += "	</div>\n";
					
Buildhtml5 += "	</div>\n";
Buildhtml5 += "	</div>\n";

	Buildhtml5 += "<div class=\"lc_swp_full lc_basic_content_padding\">\n";
	Buildhtml5 += "	<div data-elementor-type=\"wp-post\" data-elementor-id=\"2726\" class=\"elementor elementor-2726\">\n";
	Buildhtml5 += "	<section class=\"elementor-section elementor-top-section elementor-element elementor-element-3a2cde96 elementor-section-boxed elementor-section-height-default elementor-section-height-default\" data-id=\"3a2cde96\" data-element_type=\"section\">\n";
	Buildhtml5 += "					<div class=\"elementor-container elementor-column-gap-no\">\n";
	Buildhtml5 += "				<div class=\"elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-3a73bc9\" data-id=\"3a73bc9\" data-element_type=\"column\">\n";
	Buildhtml5 += "		<div class=\"elementor-widget-wrap elementor-element-populated\">\n";
	Buildhtml5 += "					<div class=\"elementor-element elementor-element-6cc6b974 elementor-widget elementor-widget-text-editor\" data-id=\"6cc6b974\" data-element_type=\"widget\" data-widget_type=\"text-editor.default\">\n";
	Buildhtml5 += "			<div class=\"elementor-widget-container\">\n";
	Buildhtml5 += "		<p>"+text5.value+"</p>\n";
									    
									    
			Buildhtml5 += "	</div>	\n";					
			Buildhtml5 += "	</div>	\n";					
			Buildhtml5 += "	<div class=\"elementor-element elementor-element-3bf75d6 elementor-widget elementor-widget-spacer\" data-id=\"3bf75d6\" data-element_type=\"widget\" data-widget_type=\"spacer.default\">\n";
			Buildhtml5 += "	<div class=\"elementor-widget-container\">\n";						
			Buildhtml5 += "				<div class=\"elementor-spacer\">\n";						
		Buildhtml5 += "	<div class=\"elementor-spacer-inner\"></div>\n";						
	Buildhtml5 += "	</div>\n";
	Buildhtml5 += "					</div>\n";
	Buildhtml5 += "			</div>\n";
				   
	   
	   
	 
      } 
 }
	     
	   

if(Action==13){
if(html5!=null)  {
                
        	Buildhtml5 += "	<section id=\"about\">\n";
           	Buildhtml5 += "	 <div class=\"container px-4\">\n";
                	Buildhtml5 += "	<div class=\"row gx-4 justify-content-center\">\n";
                    	Buildhtml5 += "	<div class=\"col-lg-8\">\n";
                      	Buildhtml5 += "	  <h2>"+artisttitle.value+"</h2>\n";
                    	Buildhtml5 += "	    <p >"+text5.value+"</p>\n";
                   	Buildhtml5 += "	 </div>\n";
              	Buildhtml5 += "	  </div>\n";
           	Buildhtml5 += "	 </div>\n";
        	Buildhtml5 += "	</section>\n";
        
	 
      } 
 }
       	   
	   

if(Action==14){
 if(html5!=null)  {
   
 
       
Buildhtml5 += "<div class=\"col-md-3 col-sm-6 hero-feature\">\n"; 
Buildhtml5 += "<div class=\"thumbnail\">\n"; 
  Buildhtml5 += "<img src=\""+ document.getElementById("product-image").value +"\" alt=\"\">\n"; 
 Buildhtml5 += " <div class=\"caption\">\n"; 
  Buildhtml5 += "  <h3>"+ document.getElementById("text-header").value +"</h3>\n"; 
  Buildhtml5 += "<p>"+ document.getElementById("product-text").value +"</p>\n"; 
  Buildhtml5 += " <p><p><a href=\"\" class=\"btn btn-primary\">"+ document.getElementById("buy").value +"</a> <a href=\""+ document.getElementById("info-url").value +"\" class=\"btn btn-default\">"+ document.getElementById("more-info").value +"</a>\n"; 
  Buildhtml5 += "  </p>\n";
Buildhtml5 += " </div>\n";
 Buildhtml5 += "</div>\n";
Buildhtml5 += "</div>\n";
       
       
       }
} 	   
	   	   

 
 if(Action==15){
 if(html5!=null)  {
   Buildhtml5 += "   <div class=\"col-xs-12 col-md-6\">\n";
    Buildhtml5 += "   <img class=\"img-responsive\" alt=\"\" src=\""+songImage.value+"\">\n";
  Buildhtml5 += "   </div>\n";
 
      } 
 }
 
 
   if(Action==16){
 if(html5!=null)  {
   
 
 
  Buildhtml5 += "   <div class=\"col-xs-12 col-md-6\">\n";
     Buildhtml5 += "      <h3>"+artisttitle.value+"</h3>\n";
      Buildhtml5 += "   <P>"+text5.value+"</p>\n";
      
       Buildhtml5 += "   </div>\n";
            
        
      } 
 }  
          


 
   if(Action==17){
 if(html5!=null)  {
   
  Buildhtml5 += "   <div class=\"col-xs-12 col-md-6\">\n";
     Buildhtml5 += "      <h3>"+artisttitle.value+"</h3>\n";
      Buildhtml5 += "   <P>"+text5.value+"</p>\n";
      
      Buildhtml5 += "  <a href=\"contact.html\" class=\"btn btn-primary\" title=\"\"> Get in touch</a>\n";
       Buildhtml5 += "   </div>\n";
            
        
      } 
 }  
 
     
        
   if(Action==18){
 if(html5!=null)  {
   
        Buildhtml5 += "  <section class=\"py-5\">\n";
          Buildhtml5 += "    <div class=\"container px-4 px-lg-5 my-5\">\n";
            Buildhtml5 += "      <div class=\"row gx-4 gx-lg-5 align-items-center\">\n";
              Buildhtml5 += "        <div class=\"col-md-6\"><img class=\"card-img-top mb-5 mb-md-0\" src=\""+ document.getElementById("product-image").value +"\" alt=\"...\" /></div>\n";
                 Buildhtml5 += "     <div class=\"col-md-6\">\n";
                   Buildhtml5 += "       <div class=\"small mb-1\">SKU: </div>\n";
                     Buildhtml5 += "     <h1 class=\"display-5 fw-bolder\">"+ document.getElementById("text-header").value +"</h1>\n";
                      Buildhtml5 += "    <div class=\"fs-5 mb-5\">\n";
                      Buildhtml5 += "        <span class=\"text-decoration-line-through\">"+ document.getElementById("product-price").value +"</span>\n";
                       Buildhtml5 += "       <span></span>\n";
                        Buildhtml5 += "  </div>\n";
                        Buildhtml5 += "  <p class=\"lead\">"+ document.getElementById("product-text").value +"</p>\n";
                         Buildhtml5 += " <div class=\"d-flex\">\n";
                           Buildhtml5 += "   <input class=\"form-control text-center me-3\" id=\"inputQuantity\" type=\"num\" value=\"1\" style=\"max-width: 3rem\" />\n";
                         Buildhtml5 += "     <button class=\"btn btn-outline-dark flex-shrink-0\" type=\"button\">\n";
                            Buildhtml5 += "      <i class=\"bi-cart-fill me-1\"></i>\n";
                              Buildhtml5 += "    Add to cart\n";
                            Buildhtml5 += "  </button>\n";
                        Buildhtml5 += "  </div>\n";
                     Buildhtml5 += " </div>\n";
                Buildhtml5 += "  </div>\n";
             Buildhtml5 += " </div>\n";
        Buildhtml5 += "  </section>  \n";  
         
            
      } 
 }  
         
         
      

   if(Action==19){
 if(html5!=null)  {
    
    Buildhtml5 += "<div class=\"section-container-spacer\"> \n";  
     Buildhtml5 += "  <form action=\"\" class=\"reveal-content\"> \n";  
      Buildhtml5 += "    <div class=\"row\"> \n";  
        Buildhtml5 += "    <div class=\"col-md-6\"> \n";  
         Buildhtml5 += "     <div class\=\"form-group\"> \n";  
           Buildhtml5 += "     <input type=\"email\" class=\"form-control\" id=\"email\" placeholder=\"Email\"> \n";  
            Buildhtml5 += "  </div> \n";  
           Buildhtml5 += "   <div class=\"form-group\"> \n";  
             Buildhtml5 += "   <input type=\"text\" class=\"form-control\" id=\"subject\" placeholder=\"Subject\"> \n";  
            Buildhtml5 += "  </div> \n";  
          Buildhtml5 += "    <div class=\"form-group\"> \n";  
            Buildhtml5 += "    <textarea class=\"form-control\" rows=\"3\" placeholder=\"Enter your message\"></textarea> \n";  
           Buildhtml5 += "   </div> \n";  
           Buildhtml5 += "   <button type=\"submit\" class=\"btn btn-primary btn-lg\">Send</button> \n";  
           Buildhtml5 += " </div> \n";  
          Buildhtml5 += "  <div class=\"col-md-6\"> \n";  
           Buildhtml5 += "   <ul class=\"list-unstyled address-container\"> \n";  
              Buildhtml5 += "  <li>\n";  
             Buildhtml5 += "     <span class=\"fa-icon\"> \n";  
              Buildhtml5 += "      <i class=\"fa fa-phone\" aria-hidden=\"true\"></i> \n";  
            Buildhtml5 += "      </span> \n";  
            Buildhtml5 += ""+phone.value+" \n";  
              Buildhtml5 += "  </li> \n";  
              Buildhtml5 += "  <li> \n";  
             Buildhtml5 += "     <span class=\"fa-icon\"> \n";  
              Buildhtml5 += "      <i class=\"fa fa-at\" aria-hidden=\"true\"></i> \n";  
                Buildhtml5 += "  </span> \n";  
              Buildhtml5 += ""+email.value+"\n";  
Buildhtml5 += "</li> \n";  
  Buildhtml5 += "   <li> \n";  
                 Buildhtml5 += " <span class=\"fa-icon\"> \n";  
                 Buildhtml5 += "   <i class=\"fa fa fa-map-marker\" aria-hidden=\"true\"></i> \n";  
              Buildhtml5 += "    </span> \n";  
               Buildhtml5 += " "+address.value+"\n";  
               Buildhtml5 += " </li> \n";  
            Buildhtml5 += "  </ul> \n";  
             Buildhtml5 += " <h3>Follow me on social networks</h3> \n";  
             Buildhtml5 += " <a href=\""+linkedin.value+"\" title=\"\" class=\"fa-icon\"> \n";  
              Buildhtml5 += "  <i class=\"fa fa-linkedin\"></i> \n";  
            Buildhtml5 += "  </a> \n";  
             Buildhtml5 += " <a href=\""+instagram.value+"\" title=\"\" class=\"fa-icon\"> \n";  
              Buildhtml5 += "  <i class=\"fa fa-instagram\"></i> \n";  
            Buildhtml5 += "  </a> \n";  
            Buildhtml5 += "  <a href=\""+twitter.value+"\" title=\"\" class=\"fa-icon\"> \n";  
            Buildhtml5 += "    <i class=\"fa fa-twitter\"></i>\n";  
           Buildhtml5 += "   </a>\n";
           Buildhtml5 += "  <a href=\""+facebook.value+"\" title=\"\" class=\"fa-icon\">\n";  
             Buildhtml5 += "   <i class=\"fa fa-facebook\"></i> \n";  
           Buildhtml5 += "   </a> \n";
            Buildhtml5 += "  <a href=\""+youtube.value+"\" title=\"\" class=\"fa-icon\">\n";  
             Buildhtml5 += "   <i class=\"fa fa-youtube\"></i> \n";  
           Buildhtml5 += "   </a> \n";  
           Buildhtml5 += " </div> \n";  
         Buildhtml5 += " </div> \n";  
       Buildhtml5 += " </form> \n";  
   Buildhtml5 += " </div> \n";  
    
           
      } 
 }  
 
      

   if(Action==20){
 if(html5!=null)  {
                   Buildhtml5 += "   <div class=\"col mb-5\">\n" ;
                   Buildhtml5 += "      <div class=\"card h-100\">\n" ;
              
                  Buildhtml5 += " <img class=\"card-img-top\" src=\""+ document.getElementById("product-image").value +"\" alt=\"...\" />\n" ;
        
                          Buildhtml5 += "   <div class=\"card-body p-4\">\n" ;
                             Buildhtml5 += "  <div class=\"text-center\">\n" ;
Buildhtml5 += " <h5 class=\"fw-bolder\">"+ document.getElementById("text-header").value +"</h5>\n" ;
                                    
                                 Buildhtml5 += ""+ document.getElementById("product-price").value +"\n" ;
                                Buildhtml5 += " </div>\n" ;
                            Buildhtml5 += " </div>\n" ;
                            
                            Buildhtml5 += " <div class=\"card-footer p-4 pt-0 border-top-0 bg-transparent\">\n" ;
Buildhtml5 += "    <div class=\"text-center\"><a class=\"btn btn-outline-dark mt-auto\" href=\""+ document.getElementById("paypal-email").value +"\">"+ document.getElementById("buy").value +"</a></div>\n" ;
                            Buildhtml5 += " </div>\n" ;
                      Buildhtml5 += "   </div>\n" ;
                    Buildhtml5 += " </div>\n" ;
                   
      
      } 
 }  
 
     
    
   if(Action==21){
 if(html5!=null)  {    
         
          Buildhtml5 += "<div class=\"col-sm col-md-3 col-lg ftco-animate\"> \n";  
    	 Buildhtml5 += "			<div class=\"product\"> \n";  
    	 Buildhtml5 += "				<a href=\"#\" class=\"img-prod\"><img class=\"img-fluid\" src=\""+ document.getElementById("product-image").value +"\" alt=\" Template\">\n";
    	 Buildhtml5 += "					<div class=\"overlay\"></div> \n";  
    	 Buildhtml5 += "				</a>\n";
    	 Buildhtml5 += "				<div class=\"text py-3 px-3\"> \n";  
    	 Buildhtml5 += "					<h5><a href=\"#\">"+ document.getElementById("text-header").value +"</a></h5> \n";  
    	 Buildhtml5 += "					<div class=\"d-flex\"> \n";  
    	 Buildhtml5 += "						<div class=\"pricing\"> \n";  
		   Buildhtml5 += "  						<p class=\"price\"><span>"+ document.getElementById("product-price").value +"</span></p> \n";  
		     Buildhtml5 += "					</div> \n";  
		     Buildhtml5 += "					<div class=\"rating\"> \n";  
	    	 Buildhtml5 += "						<p class=\"text-right\"> \n";  
	    	 Buildhtml5 += "							<a href=\"#\"><span class=\"ion-ios-star-outline\"></span></a> \n";  
	    	 Buildhtml5 += "							<a href=\"#\"><span class=\"ion-ios-star-outline\"></span></a> \n";  
	    	 Buildhtml5 += "							<a href=\"#\"><span class=\"ion-ios-star-outline\"></span></a> \n";  
	    	 Buildhtml5 += "							<a href=\"#\"><span class=\"ion-ios-star-outline\"></span></a> \n";  
	    	 Buildhtml5 += "							<a href=\"#\"><span class= \"ion-ios-star-outline\"></span></a> \n";  
	    	 Buildhtml5 += "						</p> \n";  
	    	 Buildhtml5 += "					</div> \n";  
	    	 Buildhtml5 += "				</div> \n";  
    		 Buildhtml5 += "				<p class=\"bottom-area d-flex px-3\"> \n";  
    		 Buildhtml5 += "					<a href=\"#\" class=\"add-to-cart text-center py-2 mr-1\"><span>Add to cart <i class=\"ion-ios-add ml-1\"></i></span></a> \n";  
    		 Buildhtml5 += "					<a href=\"<a href=\""+ document.getElementById("paypal-email").value +"\" class=\"buy-now text-center py-2\">"+ document.getElementById("buy").value +"<span><i class=\"ion-ios-cart ml-1\"></i></span></a> \n";  
    		 Buildhtml5 += "				</p> \n";  
    		 Buildhtml5 += "			</div> \n";  
    		 Buildhtml5 += "		</div> \n";  
    		 Buildhtml5 += "	</div> \n";  
         
         
          
      } 
 }            
         
           
 if(Action==22){
 if(html5!=null)  {
 

 Buildhtml5 += " <section class=\"ftco-section bg-light\">\n";  
  Buildhtml5 += "    	<div class=\"container\">\n";  
 Buildhtml5 += " 				<div class=\"row justify-content-center mb-3 pb-3\">\n";  
  Buildhtml5 += "          <div class=\"col-md-12 heading-section text-center ftco-animate\">\n";  
   Buildhtml5 += "           <h2 class=\"mb-4\">"+ document.getElementById("text-header").value +"</h2>\n";  
    Buildhtml5 += "          <p>"+ document.getElementById("product-text").value +"</p>\n";  
    Buildhtml5 += "        </div>\n";  
     Buildhtml5 += "     </div>   \n";  		
     Buildhtml5 += " 	</div>\n";  
    	
    			
     Buildhtml5 += " </section>\n";  
     Buildhtml5 += " </div>  \n";  
           } 
 }        
         
   
	
if(Action==23){
 if(html5!=null)  {
 
Buildhtml5 += "<div class=\"heading_content_container lc_swp_boxed  has_cpt_tax title_centered swp_page_title \">\n";
Buildhtml5 += "	<div class=\"heading_titles_container\">\n";
			
Buildhtml5 += "	<div class=\"heading_area_title title_centered swp_page_title\">\n";
Buildhtml5 += "		<h1 class=\"entry-title title_centered swp_page_title\">"+artisttitle.value+"</h1>\n";
Buildhtml5 += "	</div>\n";

Buildhtml5 += "	</div>\n";
Buildhtml5 += "	<div class=\"lc_post_meta lc_cpt_category cpt_post_meta lc_swp_full\">\n";
Buildhtml5 += "		<span class=\"meta_entry lc_cpt_category\">\n";
Buildhtml5 += "	<a href=\"live-performs/\" rel=\"tag\">Live Performs</a></span>\n";
Buildhtml5 += "		</div>\n";
Buildhtml5 += "			</div>\n";
Buildhtml5 += "</div>\n";
	Buildhtml5 += "	<div id=\"lc_swp_content\" data-minheight=\"150\">\n";
Buildhtml5 += "<div class=\"lc_content_full lc_swp_boxed lc_basic_content_padding\">\n";
Buildhtml5 += "			<div class=\"lc_embed_video_container_full\">\n";
Buildhtml5 += "	<iframe src=\""+yout.value+"?autoplay=0&amp;enablejsapi=1&amp;wmode=transparent&amp;rel=0&amp;showinfo=0\" allowfullscreen></iframe>\n";
Buildhtml5 += "						</div>\n";
	
Buildhtml5 += "	<p>"+text5.value+"</p>\n";

Buildhtml5 += "<p>"+text4.value+"</p>\n";
Buildhtml5 += "	<div class=\"clearfix\"></div>\n";
Buildhtml5 += "	<div class=\"lc_sharing_icons\">\n";
Buildhtml5 += "		<span class=\"lc_share_item_text\">Share:</span>\n";
 Buildhtml5 += " <a href=\""+linkedin.value+"\" title=\"\" class=\"fa-icon\"> \n";  
              Buildhtml5 += "  <i class=\"fa fa-linkedin\"></i> \n";  
            Buildhtml5 += "  </a> \n";  
             Buildhtml5 += " <a href=\""+instagram.value+"\" title=\"\" class=\"fa-icon\"> \n";  
              Buildhtml5 += "  <i class=\"fa fa-instagram\"></i> \n";  
            Buildhtml5 += "  </a> \n";  
            Buildhtml5 += "  <a href=\""+twitter.value+"\" title=\"\" class=\"fa-icon\"> \n";  
            Buildhtml5 += "    <i class=\"fa fa-twitter\"></i>\n";  
           Buildhtml5 += "   </a>\n";
           Buildhtml5 += "  <a href=\""+facebook.value+"\" title=\"\" class=\"fa-icon\">\n";  
             Buildhtml5 += "   <i class=\"fa fa-facebook\"></i> \n";  
           Buildhtml5 += "   </a> \n";
            Buildhtml5 += "  <a href=\""+youtube.value+"\" title=\"\" class=\"fa-icon\">\n";  
             Buildhtml5 += "   <i class=\"fa fa-youtube\"></i> \n";  
           Buildhtml5 += "   </a> \n";  



Buildhtml5 += "			</div>\n";

Buildhtml5 += "<div class=\"clearfix\"></div>\n";
Buildhtml5 += "	</div>\n";	

	
Buildhtml5 += "	</div>\n"; 
     
      } 
 }        
   
   
 
 
     
form.textarea.value+=Buildhtml5; 
 
}
  
 
     
   
    
    
    function Buildhtml(form, Action){
        var Buildhtml="";
        var html="";
        



   if(Action==3){
    if(html!=null)  {
       
        Buildhtml += " <!DOCTYPE html>\n";
        Buildhtml += "<html>\n";
        Buildhtml += "<head>\n";
         Buildhtml += "   <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\n";
         Buildhtml+="<META NAME=\"Generator\" CONTENT=\"VGA HTML5 Generator Studio\">\r\n";
        Buildhtml += "<title>"; Buildhtml += ""+ document.getElementById("page-title").value +""; Buildhtml += " </title>\n";
       
        Buildhtml += "<head>\n";
     Buildhtml += " <link href=\"https://vga.smtvs.com/source/libs/bootstrap/bootstrap.min.css\" rel=\"stylesheet\">\n";
 Buildhtml += " <link rel=\'stylesheet\' type=\"text/css\" href=\"https://vga.smtvs.com/source/style/style.css\"/>\n";
  Buildhtml += "<script src=\"https://vga.smtvs.com/source/libs/jquery/jquery.js\" type=\"text/javascript\"><\/script>\n";
  Buildhtml += "<link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css\">\n";
 Buildhtml += " <link rel=\'stylesheet' type=\"text/css\" href=\"https://vga.smtvs.com/source/audioplayer/audioplayer.css\"/>\n";
  Buildhtml += "<link rel=\'stylesheet\' type=\"text/css\" href=\"https://vga.smtvs.com/source/audioplayer/audioportal-grid.css\"/>\n";
 Buildhtml += " <script src=\"https://vga.smtvs.com/source/audioplayer/audioplayer.js\" type=\"text/javascript\"><\/script>\n";
 Buildhtml += " <link href=\'http://fonts.googleapis.com/css?family=Open+Sans:300,400,600\' rel=\'stylesheet\' type=\'text/css\'>\n";


 Buildhtml += "<link rel=\'stylesheet\' id=\'woocommerce-smallscreen-css\' href=\'https://smartwpress.com/lucille3/wp-content/plugins/woocommerce/assets/css/woocommerce-smallscreen.css?ver=6.3.1\' type=\'text/css\' media=\'only screen and (max-width: 768px)\' />\n";
 Buildhtml += "<link rel=\'stylesheet\' id=\'woocommerce-general-css\' href=\'https://smartwpress.com/lucille3/wp-content/plugins/woocommerce/assets/css/woocommerce.css?ver=6.3.1\' type=\'text/css\' media=\'all\' />\n";
Buildhtml += "<style id=\'woocommerce-inline-inline-css\' type=\'text/css\'>\n";
 Buildhtml += ".woocommerce form .form-row .required { visibility: visible; }\n";
 Buildhtml += "<\/style>\n";
 Buildhtml += "<link rel=\'stylesheet\' id=\'style-css\' href=\'https://smartwpress.com/lucille3/wp-content/themes/lucille/style.css?ver=2.1.4\' type=\'text/css\' media=\'all\' />\n";




     /* ---------------------------------------------------------------------- *\
                      
        Description : social template  stylesheet
                       .
    \* ---------------------------------------------------------------------- */
 Buildhtml += " <link rel=\"stylesheet\" id=\"bp-nouveau-css\" href=\"https://vga.smtvs.com/site-css/css/buddypress.min.css\" media=\"screen\">";
 Buildhtml += " <link rel=\"stylesheet\" id=\"storefront-style-css\" href=\"https://vga.smtvs.com/site-css/css/style.css\" media=\"all\">";
 Buildhtml += " <link rel=\"stylesheet\" id=\"dashicons-css\" href=\"https://vga.smtvs.com/site-css/css/dashicons.min.css\" media=\"all\">";
 Buildhtml += " <link rel=\"stylesheet\" id=\"wp-block-library-css\" href=\"https://vga.smtvs.com/site-css/css/style.min.css\" media=\"all\">";
 Buildhtml += " <link rel=\"stylesheet\" id=\"admin-bar-css\" href=\"https://vga.smtvs.com/site-css/css/admin-bar.min.css\" media=\"all\">";
 Buildhtml += " <link rel=\"stylesheet\" id=\"wp-block-library-css\" href=\"https://vga.smtvs.com/site-css/css/style.min.css\" media=\"all\">";    
    
	
	Buildhtml += "<link rel=\"stylesheet\" id=\"admin-bar-css\" href=\"https://vga.smtvs.com/site-css/css/admin-bar.min.css\" media=\"all\">";
 Buildhtml += "<link href=\"https://vga.smtvs.com/lightbox-pages/assets/lightbox/css/lightbox.css\" rel=\"stylesheet\">";
 Buildhtml += "<link href=\"https://vga.smtvs.com/lightbox-pages/assets/flexslider/flexslider.css\" rel=\"stylesheet\"> ";        
   
    /* ---------------------------------------------------------------------- *\
                      
        Description : video template  stylesheet
                       .
    \* ---------------------------------------------------------------------- */
              
  Buildhtml += "<style>\n";  
 Buildhtml += "div#video_controls_bar{ background: ; padding:10px; color:#FFFFFF;}\n";

   Buildhtml += " * { margin: 0; padding: ; }\n";  
     Buildhtml += "  body {\n";  
      Buildhtml += "font: 16px/1.4 Georgia, Serif;\n";  
     
   Buildhtml += " }\n";  
   Buildhtml += " #page-wrap {\n";  
    Buildhtml += "	width: 50%;\n";  
     Buildhtml += " margin: 0px auto;\n";  
   Buildhtml += " }\n";  
   Buildhtml += " h1 { font-weight: normal; font-size: 42px; }\n";  
  Buildhtml += "  h1, p, pre, video, h2, figure, h3, ol, script, style { margin: 0 0 0px 0; }\n";  
   Buildhtml += " h2 { margin-top: 0px; }\n";  
   Buildhtml += " h1 { margin-bottom: 40px; }\n";  
   Buildhtml += " li { margin: 0 0 5px 20px; }\n";  
   Buildhtml += " article { background: white; padding: 10%; }\n";  
   Buildhtml += " pre, article style, article script {\n";  
   Buildhtml += " 	white-space: pre;\n";  
    Buildhtml += "	display: block;\n";  
    Buildhtml += "	padding: 10px;\n";  
    Buildhtml += "	background: #eee;\n";  
    	Buildhtml += "overflow-x: auto;\n";  
    	Buildhtml += "font: 12px Monaco, MonoSpace;\n";  
  Buildhtml += "  }\n";  

   Buildhtml += " img { max-width: 100%; }\n";  

   Buildhtml += " figure { display: block; background: #000; padding: 10px; }\n";  
  Buildhtml += "  figcaption { display: block; text-align: center; margin: 10px 0; font-style: italic; font-size: 14px; orphans: 2; }\n";  
 
 
 Buildhtml += " video { \n";
   Buildhtml += "   width: 100%; \n";
   Buildhtml += "   height: auto; \n";
 Buildhtml += " } \n";
 
 
 Buildhtml += " <\/style>\n";  
  

Buildhtml += "   <script src=\"https://vga.smtvs.com/js/playerfun.js\"><\/script>\n";
    Buildhtml += "   <script src=\"https://vga.smtvs.com/js/html5-video.js\"><\/script>\n";
    
 
  Buildhtml += "<link rel=\"stylesheet\" href=\"https://vga.smtvs.com/playerpage.css\">\n" ;
  
Buildhtml += "<link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css\">\n" ;
 
   Buildhtml += "<link rel=\"stylesheet\" href=\"https://vga.smtvs.com/css/playerfun-8.css\">\n" ; 
Buildhtml += " <link href=\"https://vga.smtvs.com/css/custom-styles.css\" rel=\"stylesheet\" >\n";
       Buildhtml += "	<link rel=\"stylesheet\" href=\"https://vga.smtvs.com/font-awesome/css/font-awesome.min.css\">\n";
       
        Buildhtml += "	<link rel=\"stylesheet\" href=\"https://vga.smtvs.com/css/bootstrap.min.css\">\n";
        Buildhtml += "	<link rel=\"stylesheet\" href=\"https://vga.smtvs.com/css/custom-elements.css\">\n";
        Buildhtml += "<link rel=\"stylesheet\" href=\"https://vga.smtvs.com/css/all.css\">\n";
    
    
  

  Buildhtml += "<link href=\'http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900,200italic,300italic,400italic,600italic,700italic,900italic\' rel=\'stylesheet\' type=\'text/css\'>\n";
  Buildhtml += "<link href=\"https://smtvs.com/layered-slider/_css/Icomoon/style.css\" rel=\"stylesheet\" type=\"text/css\" />\n";
  Buildhtml += "<link href=\"https://smtvs.com/layered-slider/_css/responsive-layered-slider.css\" rel=\"stylesheet\" type=\"text/css\" />\n";
  
  Buildhtml += "<script type=\"text/javascript\" src=\"https://smtvs.com/layered-slider/_scripts/jquery-ui-1.10.4.min.js\"><\/script>\n";
  Buildhtml += "<script type=\"text/javascript\" src=\"https://smtvs.com/layered-slider/_scripts/responsive-layered-slider.js\"><\/script> \n";

  Buildhtml += "<link rel=\"shortcut icon\"  href=\""+ document.getElementById("site-ico").value +"\">\n";

  Buildhtml += "<script src=\"https://smtvs.com/About us_files/dropdowns-enhancement.js\"><\/script>\n";
  
        
        Buildhtml += " <script src=\"https://vga.smtvs.com/dark-gold/js/scrolling-nav-gh-pages-scripts.js\" type=\"text/javascript\"><\/script>\n"; 
        
        
  Buildhtml += "<link rel=\"stylesheet\" href=\"https://vga.smtvs.com/winkel-master/css/open-iconic-bootstrap.min.css\">\n" ;
   Buildhtml += "  <link rel=\"stylesheet\" href=\"https://vga.smtvs.com/winkel-master/css/animate.css\">\n" ;
    
     Buildhtml += "<link rel=\"stylesheet\" href=\"https://vga.smtvs.com/winkel-master/css/owl.carousel.min.css\">\n" ;
     Buildhtml += "<link rel=\"stylesheet\" href=\"https://vga.smtvs.com/winkel-master/css/owl.theme.default.min.css\">\n" ;

     Buildhtml += "<link rel=\"stylesheet\" href=\"https://vga.smtvs.com/winkel-master/css/magnific-popup.css\">\n" ;

  Buildhtml += "<link rel=\"stylesheet\" href=\"https://vga.smtvs.com/winkel-master/css/aos.css\">\n" ;

     Buildhtml += "<link rel=\"stylesheet\" href=\"https://vga.smtvs.com/winkel-master/css/ionicons.min.css\">\n" ;

     Buildhtml += "<link rel=\"stylesheet\" href=\"https://vga.smtvs.com/winkel-master/css/bootstrap-datepicker.css\">\n" ;
     Buildhtml += "<link rel=\"stylesheet\" href=\"https://vga.smtvs.com/winkel-master/css/jquery.timepicker.css\">\n" ;

    
     Buildhtml += "<link rel=\"stylesheet\" href=\"https://vga.smtvs.com/winkel-master/css/flaticon.css\">\n" ;
     Buildhtml += "<link rel=\"stylesheet\" href=\"https://vga.smtvs.com/winkel-master/css/icomoon.css\">\n" ;
     Buildhtml += "<link rel=\"stylesheet\" href=\"https://vga.smtvs.com/music-template/musica/style.css\">\n";
    Buildhtml += "  <style>\n";
   Buildhtml += "  @import url(\'https://fonts.googleapis.com/css2?family=Rajdhani:wght@600;700&family=Inter:wght@300;400;500&display=swap\');\n";
   Buildhtml += "  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }\n";
   Buildhtml += "  body {background:"+pageColor.value+"; color:"+textColor.value+"; font-family: \'Inter\', sans-serif; }\n";
   Buildhtml += " a { color: inherit; }\n";
   Buildhtml += " <\/style>\n";
  
        
Buildhtml += "</head>\n" ;

        Buildhtml += "<body>\n";
Buildhtml += "<main>\n" ;
Buildhtml += "<header id=\"header\" class=\"clearfix\">\n" ;

 
		
			
	Buildhtml += "<div class=\"clearfix\">\n";
		Buildhtml += "<nav class=\"navbar navbar-default\">\n";
		Buildhtml += "	<div class=\"container-fluid\">\n";
			Buildhtml += "	<!-- Brand and toggle get grouped for better mobile display -->\n";
			Buildhtml += "	<div class=\"header-holder\">\n";
			Buildhtml += "		<div class=\"navbar-header clearfix\">\n";
			Buildhtml += "			<!-- <button id=\"left_opner\" class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\"#bs-example-navbar-collapse-1\"></button> -->\n";
			Buildhtml += "			<a href=\"javascript:void(0)\" class=\"side-opener\">\n";
			Buildhtml += "				<span></span>\n";
			Buildhtml += "				<span></span>\n";
			Buildhtml += "				<span></span>\n";
			Buildhtml += "			</a>\n";
			Buildhtml += "			<h1 class=\"logo\">\n";
			Buildhtml += "				<a href=\"https://vga.smtvs.com/\">\n";
			Buildhtml += "					<img src=\""+ document.getElementById("page-logo").value +"\" alt=\"cbtune\" class=\"img-responsive\" width=\"1%\">\n";
			Buildhtml += "					<span></span>\n";
			Buildhtml += "				</a>\n";
			Buildhtml += "			</h1>\n";
			Buildhtml += "		</div>\n";
			Buildhtml += "		<!-- Collect the nav links, forms, and other content for toggling -->\n";
			Buildhtml += "		<div class=\"collapse navbar-collapse\" id=\"bs-example-navbar-collapse-1\">\n";
			Buildhtml += "			<div class=\"menu-holder\">\n";
			Buildhtml += "				<div class=\"col search\">\n";
			
			Buildhtml += "	<form id=\"cse-search-box\" class=\"search-form\" name=\"search\" method=\"get\" role=\"search\" action=\"https://www.google.com\">\n";
		
			
			Buildhtml += "						<a href=\"javascript:void(0)\" class=\"close-search icon-arrow-back visible-xs\"></a>\n";
			Buildhtml += "						<div class=\"input-group cbsearchtype\">\n";
			 Buildhtml += "	                 <input  type=\"hidden\" name=\"cx\" value=\"partner-pub-5415568243560012:4450007219\" />\n";
                           
              Buildhtml += "	       <input type=\"hidden\" name=\"ie\" value=\"UTF-8\" /> \n";
									  
			Buildhtml += "		<input type=\"text\" class=\"form-control\" name=\"query\" placeholder=\"Search keyword here\" value=\"\" id=\"query\">\n";
			Buildhtml += "		<div class=\"input-group-btn\">\n";
			Buildhtml += "				<input type=\"hidden\" name=\"type\" class=\"type\" value=\"videos\" id=\"type\">\n";
			 Buildhtml += "	</ul>\n";
            Buildhtml += "  <svg tabindex=\"-1\" type=\"submit\" name=\"cbsearch\" id=\"cbsearch\" class=\"svg-inline--fa fa-search fa-w-16 btn btn-default btn-search\" aria-hidden=\"true\" data-prefix=\"fa\" data-icon=\"search\" role=\"img\" xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 512 512\" data-fa-i2svg=\"\"><path fill=\"currentColor\" d=\"M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z\"></path></svg><!-- <button tabindex=\"-1\" type=\"submit\" name=\"cbsearch\" id=\"cbsearch\" class=\"btn btn-default fa fa-search btn-search\"></button> -->\n";
			Buildhtml += "							</div>\n";
			Buildhtml += "						</div>\n";
			Buildhtml += "					</form><!-- form Ends -->\n";
			Buildhtml += "				</div>\n";
			Buildhtml += "				<div class=\"col btn-holder text-right\">\n";
						    
      
			Buildhtml += "					<ul class=\"nav navbar-nav navbar-right right-menu loggedout\" >\n";
		
				Buildhtml += "					<!-- Shown to small devices only Start  @todo : Add condition for logged in user -->\n";
							
			Buildhtml += "							<li class=\"dropdown\" >\n";
				 
      
                    		    
										   						    
            Buildhtml += " <a class=\"dropdown-toggle\" role=\"button\" data-toggle=\"dropdown\" href=\"#\">  <i class=\'fa fa-th\' style=\'font-size:20px\'></i></a><ul id=\"g-account-menu\" class=\"dropdown-menu\" role=\"menu\"  style=\"width:208px;height:360px; border:20px;border-color:coral; background-color:#eeeeee ;color: white;\" >\n";
				   Buildhtml += " <li><a href=\"/index.php\"  target=\"new\"><i class=\"fa fa-home\"></i>Home</a></li>\n";
                  Buildhtml += "<li><a href=\"/account.php\"  target=\"new\"><i class=\"fa fa-user\"></i>Account</a></li>\n";
                       					
				Buildhtml += "		</ul>\n";
						Buildhtml += "			<ul>\n";		         
				
				Buildhtml += "			</ul>\n";
	Buildhtml += "	<a href=\"javascript:void(0)\" class=\"btn-search-toggle btn visible-xs\">	\n";
	Buildhtml += "<svg class=\"svg-inline--fa fa-search fa-w-16\" aria-hidden=\"true\" data-prefix=\"fa\" data-icon=\"search\" role=\"img\" xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 512 512\" data-fa-i2svg=\"\"><path fill=\"currentColor\" d=\"M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z\"></path></svg><!-- <i class=\"fa fa-search\"></i> --></a>\n";																	
						
								Buildhtml += "	</div>\n";
						Buildhtml += "	</div>\n";
					Buildhtml += "	</div><!--navbar-collapse-->\n";
				Buildhtml += "	</div>\n";
			Buildhtml += "	</div><!--container-fluid-->\n";
		Buildhtml += "	</nav>\n";
	Buildhtml += "	</div>\n";

	Buildhtml += "</header>\n";

				
Buildhtml += "<script src=\"https://vga.smtvs.com/dark-gold/js/side-bar-menu.js\"><\/script>\n";
  
   
  
    
Buildhtml += "<aside id=\"sidebar\" class=\"custom-elements\">\n";
Buildhtml += "	<div class=\"scrollable-area-wrapper\" style=\"width: 220px; height: 630px;\">\n";
Buildhtml += "<div class=\"sidebar-holder scrollable-area\" style=\"position: relative; overflow: hidden; width: 213px; height: 610px;\">\n";
Buildhtml += "		<ul class=\"min-list\">\n";



Buildhtml += "			<li class=\"active\">\n";
Buildhtml += "<a href="+ document.getElementById("menu-url").value +"\"\"><svg class=\"svg-inline--fa fa-home fa-w-18\" aria-hidden=\"true\" data-prefix=\"fa\" data-icon=\"home\" role=\"img\" xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 576 512\" data-fa-i2svg=\"\"><path fill=\"currentColor\" d=\"M488 312.7V456c0 13.3-10.7 24-24 24H348c-6.6 0-12-5.4-12-12V356c0-6.6-5.4-12-12-12h-72c-6.6 0-12 5.4-12 12v112c0 6.6-5.4 12-12 12H112c-13.3 0-24-10.7-24-24V312.7c0-3.6 1.6-7 4.4-9.3l188-154.8c4.4-3.6 10.8-3.6 15.3 0l188 154.8c2.7 2.3 4.3 5.7 4.3 9.3zm83.6-60.9L488 182.9V44.4c0-6.6-5.4-12-12-12h-56c-6.6 0-12 5.4-12 12V117l-89.5-73.7c-17.7-14.6-43.3-14.6-61 0L4.4 251.8c-5.1 4.2-5.8 11.8-1.6 16.9l25.5 31c4.2 5.1 11.8 5.8 16.9 1.6l235.2-193.7c4.4-3.6 10.8-3.6 15.3 0l235.2 193.7c5.1 4.2 12.7 3.5 16.9-1.6l25.5-31c4.2-5.2 3.4-12.7-1.7-16.9z\"></path></svg><!-- <i class=\"fa fa-home\" aria-hidden=\"true\"></i> -->"+ document.getElementById("menu-text").value +"</a>\n";
Buildhtml += "			</li>\n";
Buildhtml += "						<li>\n";
Buildhtml += "	<a href=\""+ document.getElementById("menu-url2").value +"\"  target=\"new\"><svg class=\"svg-inline--fa fa-plus-circle fa-w-16\" aria-hidden=\"true\" data-prefix=\"fas\" data-icon=\"plus-circle\" role=\"img\" xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 512 512\" data-fa-i2svg=\"\"><path fill=\"currentColor\" d=\"M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm144 276c0 6.6-5.4 12-12 12h-92v92c0 6.6-5.4 12-12 12h-56c-6.6 0-12-5.4-12-12v-92h-92c-6.6 0-12-5.4-12-12v-56c0-6.6 5.4-12 12-12h92v-92c0-6.6 5.4-12 12-12h56c6.6 0 12 5.4 12 12v92h92c6.6 0 12 5.4 12 12v56z\"></path></svg><!-- <i class=\"fas fa-plus-circle\"></i>\n";
Buildhtml += "<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-film\" viewBox=\"0 0 16 16\">\n";
 Buildhtml += "<path d=\"M0 1a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V1zm4 0v6h8V1H4zm8 8H4v6h8V9zM1 1v2h2V1H1zm2 3H1v2h2V4zM1 7v2h2V7H1zm2 3H1v2h2v-2zm-2 3v2h2v-2H1zM15 1h-2v2h2V1zm-2 3v2h2V4h-2zm2 3h-2v2h2V7zm-2 3v2h2v-2h-2zm2 3h-2v2h2v-2z\"/></svg>-->"+ document.getElementById("menu-text2").value +"\n";
Buildhtml += "				</a>\n";
Buildhtml += "			</li>\n";
Buildhtml += "		</ul>\n";
Buildhtml += "		<!-- Left Column Start -->\n";
	Buildhtml += "	<div class=\"text-container\">\n";
		Buildhtml += "	<div class=\"cat-list clearfix more-text\">\n";
			Buildhtml += "	<h2>Categories</h2>\n";
				Buildhtml += "					<li>\n";
				Buildhtml += "	<a href=\""+ document.getElementById("menu-url3").value +"\">\n";
				
					Buildhtml += "<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-window\" viewBox=\"0 0 16 16\">\n";
                    Buildhtml += "	<path d=\"M2.5 4a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1zm2-.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm1 .5a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z\"/>\n";
                    Buildhtml += "	 <path d=\"M2 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2H2zm13 2v2H1V3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1zM2 14a1 1 0 0 1-1-1V6h14v7a1 1 0 0 1-1 1H2z\"/></svg>\n";
				
			
			
			
				Buildhtml += "				<span>"+ document.getElementById("menu-text3").value +"</span>\n";
				Buildhtml += "			</a>\n";
				Buildhtml += "	</li>\n";
						
					Buildhtml += "					<li>\n";
					Buildhtml += "<a href=\""+ document.getElementById("menu-url4").value +"\">\n";
					
					
					Buildhtml += "	<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-cloud-upload\" viewBox=\"0 0 16 16\">\n";
                    Buildhtml += "	<path fill-rule=\"evenodd\" d=\"M4.406 1.342A5.53 5.53 0 0 1 8 0c2.69 0 4.923 2 5.166 4.579C14.758 4.804 16 6.137 16 7.773 16 9.569 14.502 11 12.687 11H10a.5.5 0 0 1 0-1h2.688C13.979 10 15 8.988 15 7.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 2.825 10.328 1 8 1a4.53 4.53 0 0 0-2.941 1.1c-.757.652-1.153 1.438-1.153 2.055v.448l-.445.049C2.064 4.805 1 5.952 1 7.318 1 8.785 2.23 10 3.781 10H6a.5.5 0 0 1 0 1H3.781C1.708 11 0 9.366 0 7.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383z\"/>\n";
                    Buildhtml += "	<path fill-rule=\"evenodd\" d=\"M7.646 4.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V14.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3z\"/></svg>\n";
				
				
				
					Buildhtml += "			<span>"+ document.getElementById("menu-text4").value +"</span>\n";
					Buildhtml += "		</a>\n";
					Buildhtml += "	</li>\n";
						
					
						
						
						
					Buildhtml += "		<li>\n";
					Buildhtml += "		<a href=\""+ document.getElementById("menu-url5").value +"\">\n";
						Buildhtml += "<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-person-vcard\" viewBox=\"0 0 16 16\">	\n";
                Buildhtml += "<path d=\"M5 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm4-2.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5ZM9 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4A.5.5 0 0 1 9 8Zm1 2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5Z\"/>	\n";
                Buildhtml += "<path d=\"M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H2ZM1 4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H8.96c.026-.163.04-.33.04-.5C9 10.567 7.21 9 5 9c-2.086 0-3.8 1.398-3.984 3.181A1.006 1.006 0 0 1 1 12V4Z\"/></svg>	\n";			
			
					
					Buildhtml += "			<span>"+ document.getElementById("menu-text5").value +"</span>\n";
					Buildhtml += "		</a>\n";
					Buildhtml += "	</li>\n";
					Buildhtml += "				<li>\n";
					Buildhtml += "		<a href=\""+ document.getElementById("menu-url6").value +"\">\n";
					Buildhtml += "<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-person-circle\" viewBox=\"0 0 16 16\">\n";
                    Buildhtml += "	<path d=\"M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z\"/>\n";
                    Buildhtml += "	<path fill-rule=\"evenodd\" d=\"M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z\"/></svg>\n";
					Buildhtml += "			<span>"+ document.getElementById("menu-text6").value +"</span>\n";
					Buildhtml += "		</a>\n";
					Buildhtml += "	</li>\n";
								
								
								
	Buildhtml += "					</div>\n";
				
	Buildhtml += "	</div>\n";

		Buildhtml += "			<!-- footer_tube -->\n";
	Buildhtml += "	<div class=\"footer_tube\">\n";
	Buildhtml += "	<div class=\"footer-holder\">\n";
			
	Buildhtml += "		<ul class=\"footer-links column\">\n";
	Buildhtml += "		<li><a href=\""+ document.getElementById("menu-url7").value +"\">"+ document.getElementById("menu-text7").value +"</a></li>\n";
	Buildhtml += "		<li><a href=\""+ document.getElementById("menu-url8").value +"\">"+ document.getElementById("menu-text8").value +"</a></li>\n";
	Buildhtml += "		<li><a href=\""+ document.getElementById("menu-url9").value +"\">"+ document.getElementById("menu-text9").value +"</a></li>\n";
	Buildhtml += "	</ul>\n";
			
Buildhtml += "<div class=\"vscroll-down\"></div></div></div><!-- Left Column Ends -->\n";
	    Buildhtml += "</aside>     \n";	
	    
	    
	    Buildhtml += "	<div class=\"middle-section\"><br><P><br><P><br><P>\n";
	    Buildhtml += "	<div class=\"container\">\n";                                        

         Buildhtml += " <div class=\"row\">\n";
     
     
     
        
        Buildhtml += ""+ document.getElementById("textarea").value +"\n";
       
      
       Buildhtml += " <div class=\"feed-description\">\n";
     
       
      Buildhtml += "  </div>\n";

     Buildhtml += " </div>\n";
  Buildhtml += "  </div>\n";
Buildhtml += "  </div>\n";
 
 Buildhtml += "  </div>\n";
Buildhtml += "  </div>\n";
 Buildhtml += "  </div>\n";
 
 

 
      
       Buildhtml += " <div class=\"span6\" style=\"text-align: right\">\n";

       

Buildhtml += "</div>   </div>\n";



 

   Buildhtml += " <script src=\"https://vga.smtvs.com/lightbox-pages/assets/lightbox/js/lightbox.min.js\"><\/script>\n";
  Buildhtml += " <script src=\"https://vga.smtvs.com/lightbox-pages/assets/flexslider/jquery.flexslider.js\"><\/script>";



 Buildhtml += "<section class=\"mcon-footer\">\n";
   Buildhtml += "     <div class=\"container\">\n";
    Buildhtml += "        <div class=\"row\">\n";

           Buildhtml += "    </div>\n";

           Buildhtml += "    <div class=\"row\">\n";
           Buildhtml += "        <div class=\"col-md-6\">\n";
            Buildhtml += " &copy; copyright <a href=\"http://bit.ly/nM4R6u\"></a> 2013\n";

          Buildhtml += "         </div>\n";
        Buildhtml += "           <div class=\"col-md-6\" style=\"text-align: right\">\n";
        Buildhtml += "               <iframe src=\"//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2Fdigitalzoomstudio&amp;width=150&amp;height=21&amp;colorscheme=light&amp;layout=button_count&amp;action=like&amp;show_faces=true&amp;send=false&amp;appId=569360426428348\" scrolling=\"no\" frameborder=\"0\" style=\"border:none; overflow:hidden; width:150px; height:21px;\" allowTransparency=\"true\"></iframe>\n";
       Buildhtml += "            </div>\n";
        Buildhtml += "       </div>\n";
       Buildhtml += "    </div>\n";
Buildhtml += "   </section>\n";

Buildhtml += "   <div class=\"col-md-3 col-sm-6 hero-feature\"> \n";
Buildhtml += "   <div class=\"thumbnail\">\n";
Buildhtml += "<div class=\"dzsap-sticktobottom-placeholder\"></div> \n"; 
 Buildhtml += "      <section class=\"dzsap-sticktobottom  dzsap-sticktobottom-for-skin-wave-small\">  \n";

      Buildhtml += "     <style>.audioplayer.skin-wave#dzsap_footer.ap-controls .con-playpause .playbtn,.audioplayer.skin-wave#dzsap_footer .btn-embed-code,\n";

    Buildhtml += " .audioplayer.skin-wave#dzsap_footer .ap-controls .con-playpause .pausebtn { background-color: #111111;}  </style>\n";


Buildhtml += "   <div id=\"ap_footer\" class=\"audioplayer-tobe dzsap_footer button-aspect-noir button-aspect-noir--filled\"\n";

  Buildhtml += "          style=\"width:100%; \" data-thumb=\"../img/thumbs2.jpg\" data-thumb_link\img/thumb.\" data-bgimage=\"img/bg.jpg\"\n";

   Buildhtml += "         data-scrubbg=\"waves/scrubbg.\" data-scrubprog=\"waves/scrubprog.png\" data-type=\"fake\" data-source=\"fake\"\n";

  Buildhtml += "          data-sourceogg=\"../sounds/itsabeautifulday.ogg\">\n";

  Buildhtml += "       <!--  data-sourceogg=\"sounds/adg3.ogg\"  -->\n";

  Buildhtml += "       <div class=\"the-comments\">\n";

  Buildhtml += "       </div>\n";

  Buildhtml += "       <div class=\"meta-artist\"><span class=\"the-artist\">Tim McMorris</span><span class=\"the-name\"><a href=\"http://codecanyon.net/item/zoomsounds-wordpress-audio-player/6181433?ref=ZoomIt\" target=\"_blank\">It's a beautiful day</a></span>\n";

   Buildhtml += "      </div>\n";

  Buildhtml += "     </div>\n";

  Buildhtml += "   </section>\n";

 

     Buildhtml += "<script src=\"https://vga.smtvs.com/developers/video-code/js/vga-zoom.js\"><\/script>\n";
     Buildhtml += "</div>\n";
	 Buildhtml += "</div>\n";
 
     Buildhtml += " <script src=\"https://vga.smtvs.com/music-template/musica/js/jquery/jquery-2.2.4.min.js\"><\/script>\n";


     Buildhtml += " <script src=\"https://vga.smtvs.com/music-template/musica/js/bootstrap/popper.min.js\"><\/script>\n";


    Buildhtml += "  <script src=\"https://vga.smtvs.com/music-template/musica/js/bootstrap/bootstrap.min.js\"><\/script>\n";

   
     Buildhtml += " <script src=\"https://vga.smtvs.com/music-template/musica/js/plugins/plugins.js\"><\/script>\n";

    
     Buildhtml += " <script src=\"https://vga.smtvs.com/music-template/musica/js/active.js\"><\/script>\n";




        Buildhtml += "</body>\n";
        Buildhtml += "</html>";
        
        
    }
}  
        
   if(Action==15){
    if(html!=null)  {
       
        Buildhtml += " <!DOCTYPE html>\n";
        Buildhtml += "<html>\n";
        Buildhtml += "<head>\n";
         Buildhtml += "   <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\n";
         Buildhtml+="<META NAME=\"Generator\" CONTENT=\"VGA HTML5 Generator Studio\">\r\n";
        Buildhtml += "<title>"; Buildhtml += ""+ document.getElementById("page-title").value +""; Buildhtml += " </title>\n";
       
        Buildhtml += "<head>\n";
     Buildhtml += " <link href=\"https://vga.smtvs.com/source/libs/bootstrap/bootstrap.min.css\" rel=\"stylesheet\">\n";
 Buildhtml += " <link rel=\'stylesheet\' type=\"text/css\" href=\"https://vga.smtvs.com/source/style/style.css\"/>\n";
  Buildhtml += "<script src=\"https://vga.smtvs.com/source/libs/jquery/jquery.js\" type=\"text/javascript\"><\/script>\n";
  Buildhtml += "<link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css\">\n";
 Buildhtml += " <link rel=\'stylesheet' type=\"text/css\" href=\"https://vga.smtvs.com/source/audioplayer/audioplayer.css\"/>\n";
  Buildhtml += "<link rel=\'stylesheet\' type=\"text/css\" href=\"https://vga.smtvs.com/source/audioplayer/audioportal-grid.css\"/>\n";
 Buildhtml += " <script src=\"https://vga.smtvs.com/source/audioplayer/audioplayer.js\" type=\"text/javascript\"><\/script>\n";
 Buildhtml += " <link href=\'http://fonts.googleapis.com/css?family=Open+Sans:300,400,600\' rel=\'stylesheet\' type=\'text/css\'>\n";


 Buildhtml += "<link rel=\'stylesheet\' id=\'woocommerce-smallscreen-css\' href=\'https://smartwpress.com/lucille3/wp-content/plugins/woocommerce/assets/css/woocommerce-smallscreen.css?ver=6.3.1\' type=\'text/css\' media=\'only screen and (max-width: 768px)\' />\n";
 Buildhtml += "<link rel=\'stylesheet\' id=\'woocommerce-general-css\' href=\'https://smartwpress.com/lucille3/wp-content/plugins/woocommerce/assets/css/woocommerce.css?ver=6.3.1\' type=\'text/css\' media=\'all\' />\n";
Buildhtml += "<style id=\'woocommerce-inline-inline-css\' type=\'text/css\'>\n";
 Buildhtml += ".woocommerce form .form-row .required { visibility: visible; }\n";
 Buildhtml += "<\/style>\n";
 Buildhtml += "<link rel=\'stylesheet\' id=\'style-css\' href=\'https://smartwpress.com/lucille3/wp-content/themes/lucille/style.css?ver=2.1.4\' type=\'text/css\' media=\'all\' />\n";




     /* ---------------------------------------------------------------------- *\
                      
        Description : social template  stylesheet
                       .
    \* ---------------------------------------------------------------------- */
 Buildhtml += " <link rel=\"stylesheet\" id=\"bp-nouveau-css\" href=\"https://vga.smtvs.com/site-css/css/buddypress.min.css\" media=\"screen\">";
 Buildhtml += " <link rel=\"stylesheet\" id=\"storefront-style-css\" href=\"https://vga.smtvs.com/site-css/css/style.css\" media=\"all\">";
 Buildhtml += " <link rel=\"stylesheet\" id=\"dashicons-css\" href=\"https://vga.smtvs.com/site-css/css/dashicons.min.css\" media=\"all\">";
 Buildhtml += " <link rel=\"stylesheet\" id=\"wp-block-library-css\" href=\"https://vga.smtvs.com/site-css/css/style.min.css\" media=\"all\">";
 Buildhtml += " <link rel=\"stylesheet\" id=\"admin-bar-css\" href=\"https://vga.smtvs.com/site-css/css/admin-bar.min.css\" media=\"all\">";
 Buildhtml += " <link rel=\"stylesheet\" id=\"wp-block-library-css\" href=\"https://vga.smtvs.com/site-css/css/style.min.css\" media=\"all\">";    
             
   
    /* ---------------------------------------------------------------------- *\
                      
        Description : video template  stylesheet
                       .
    \* ---------------------------------------------------------------------- */
              
  Buildhtml += "<style>\n";  
 Buildhtml += "div#video_controls_bar{ background:; padding:10px; color:#FFFFFF;}\n";

   Buildhtml += " * { margin: 0; padding: ; }\n";  
     Buildhtml += "  body {\n";  
      Buildhtml += "font: 16px/1.4 Georgia, Serif;\n";  
     
   Buildhtml += " }\n";  
   Buildhtml += " #page-wrap {\n";  
    Buildhtml += "	width: 50%;\n";  
     Buildhtml += " margin: 0px auto;\n";  
   Buildhtml += " }\n";  
   Buildhtml += " h1 { font-weight: normal; font-size: 42px; }\n";  
  Buildhtml += "  h1, p, pre, video, h2, figure, h3, ol, script, style { margin: 0 0 0px 0; }\n";  
   Buildhtml += " h2 { margin-top: 0px; }\n";  
   Buildhtml += " h1 { margin-bottom: 40px; }\n";  
   Buildhtml += " li { margin: 0 0 5px 20px; }\n";  
   Buildhtml += " article { background: white; padding: 10%; }\n";  
   Buildhtml += " pre, article style, article script {\n";  
   Buildhtml += " 	white-space: pre;\n";  
    Buildhtml += "	display: block;\n";  
    Buildhtml += "	padding: 10px;\n";  
    Buildhtml += "	background: #eee;\n";  
    	Buildhtml += "overflow-x: auto;\n";  
    	Buildhtml += "font: 12px Monaco, MonoSpace;\n";  
  Buildhtml += "  }\n";  

   Buildhtml += " img { max-width: 100%; }\n";  

   Buildhtml += " figure { display: block; background: #000; padding: 10px; }\n";  
  Buildhtml += "  figcaption { display: block; text-align: center; margin: 10px 0; font-style: italic; font-size: 14px; orphans: 2; }\n";  
 
 
 Buildhtml += " video { \n";
   Buildhtml += "   width: 100%; \n";
   Buildhtml += "   height: auto; \n";
 Buildhtml += " } \n";
 
 
 Buildhtml += " <\/style>\n";  
  
Buildhtml += "  <link rel=\"stylesheet\" href=\"https://vga.smtvs.com/css/\">\n";
Buildhtml += "   <script src=\"https://vga.smtvs.com/js/playerfun.js\"><\/script>\n";
    Buildhtml += "   <script src=\"https://vga.smtvs.com/js/html5-video.js\"><\/script>\n";
    
 
  Buildhtml += "<link rel=\"stylesheet\" href=\"https://vga.smtvs.com/playerpage.css\">\n" ;
  
Buildhtml += "<link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css\">\n" ;
 
   Buildhtml += "<link rel=\"stylesheet\" href=\"https://vga.smtvs.com/css/playerfun-8.css\">\n" ; 
Buildhtml += " <link href=\"https://vga.smtvs.com/css/custom-styles.css\" rel=\"stylesheet\" >\n";
       Buildhtml += "	<link rel=\"stylesheet\" href=\"https://vga.smtvs.com/font-awesome/css/font-awesome.min.css\">\n";
       
        Buildhtml += "	<link rel=\"stylesheet\" href=\"https://vga.smtvs.com/css/bootstrap.min.css\">\n";
        Buildhtml += "	<link rel=\"stylesheet\" href=\"https://vga.smtvs.com/css/custom-elements.css\">\n";
        Buildhtml += "<link rel=\"stylesheet\" href=\"https://vga.smtvs.com/css/all.css\">\n";
    
    
  

  Buildhtml += "<link href=\'http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900,200italic,300italic,400italic,600italic,700italic,900italic\' rel=\'stylesheet\' type=\'text/css\'>\n";
  Buildhtml += "<link href=\"https://smtvs.com/layered-slider/_css/Icomoon/style.css\" rel=\"stylesheet\" type=\"text/css\" />\n";
  Buildhtml += "<link href=\"https://smtvs.com/layered-slider/_css/responsive-layered-slider.css\" rel=\"stylesheet\" type=\"text/css\" />\n";
  
  Buildhtml += "<script type=\"text/javascript\" src=\"https://smtvs.com/layered-slider/_scripts/jquery-ui-1.10.4.min.js\"><\/script>\n";
  Buildhtml += "<script type=\"text/javascript\" src=\"https://smtvs.com/layered-slider/_scripts/responsive-layered-slider.js\"><\/script> \n";

  Buildhtml += "<link rel=\"shortcut icon\"  href=\""+ document.getElementById("site-ico").value +"\">\n";

  Buildhtml += "<script src=\"https://smtvs.com/About us_files/dropdowns-enhancement.js\"><\/script>\n";
   Buildhtml += "  <style>\n";
   Buildhtml += "  @import url(\'https://fonts.googleapis.com/css2?family=Rajdhani:wght@600;700&family=Inter:wght@300;400;500&display=swap\');\n";
   Buildhtml += "  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }\n";
   Buildhtml += "  body {background:"+pageColor.value+"; color:"+textColor.value+"; font-family: \'Inter\', sans-serif; }\n";
   Buildhtml += " a { color: inherit; }\n";
   Buildhtml += " <\/style>\n";
Buildhtml += "</head>\n" ;

        Buildhtml += "<body>\n";
Buildhtml += "<main>\n" ;
Buildhtml += "<header id=\"header\" class=\"clearfix\">\n" ;

 
		
			
	Buildhtml += "<div class=\"clearfix\">\n";
		Buildhtml += "<nav class=\"navbar navbar-default\">\n";
		Buildhtml += "	<div class=\"container-fluid\">\n";
			Buildhtml += "	<!-- Brand and toggle get grouped for better mobile display -->\n";
			Buildhtml += "	<div class=\"header-holder\">\n";
			Buildhtml += "		<div class=\"navbar-header clearfix\">\n";
			Buildhtml += "			<!-- <button id=\"left_opner\" class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\"#bs-example-navbar-collapse-1\"></button> -->\n";
			Buildhtml += "			<a href=\"javascript:void(0)\" class=\"side-opener\">\n";
			Buildhtml += "				<span></span>\n";
			Buildhtml += "				<span></span>\n";
			Buildhtml += "				<span></span>\n";
			Buildhtml += "			</a>\n";
			Buildhtml += "			<h1 class=\"logo\">\n";
			Buildhtml += "				<a href=\"https://vga.smtvs.com/\">\n";
			Buildhtml += "					<img src=\""+ document.getElementById("page-logo").value +"\" alt=\"cbtune\" class=\"img-responsive\" width=\"1%\">\n";
			Buildhtml += "					<span></span>\n";
			Buildhtml += "				</a>\n";
			Buildhtml += "			</h1>\n";
			Buildhtml += "		</div>\n";
			Buildhtml += "		<!-- Collect the nav links, forms, and other content for toggling -->\n";
			Buildhtml += "		<div class=\"collapse navbar-collapse\" id=\"bs-example-navbar-collapse-1\">\n";
			Buildhtml += "			<div class=\"menu-holder\">\n";
			Buildhtml += "				<div class=\"col search\">\n";
			
			Buildhtml += "	<form id=\"cse-search-box\" class=\"search-form\" name=\"search\" method=\"get\" role=\"search\" action=\"https://www.google.com\">\n";
		
			
			Buildhtml += "						<a href=\"javascript:void(0)\" class=\"close-search icon-arrow-back visible-xs\"></a>\n";
			Buildhtml += "						<div class=\"input-group cbsearchtype\">\n";
			 Buildhtml += "	                 <input  type=\"hidden\" name=\"cx\" value=\"partner-pub-5415568243560012:4450007219\" />\n";
                           
              Buildhtml += "	       <input type=\"hidden\" name=\"ie\" value=\"UTF-8\" /> \n";
									  
			Buildhtml += "		<input type=\"text\" class=\"form-control\" name=\"query\" placeholder=\"Search keyword here\" value=\"\" id=\"query\">\n";
			Buildhtml += "		<div class=\"input-group-btn\">\n";
			Buildhtml += "				<input type=\"hidden\" name=\"type\" class=\"type\" value=\"videos\" id=\"type\">\n";
			 Buildhtml += "	</ul>\n";
            Buildhtml += "  <svg tabindex=\"-1\" type=\"submit\" name=\"cbsearch\" id=\"cbsearch\" class=\"svg-inline--fa fa-search fa-w-16 btn btn-default btn-search\" aria-hidden=\"true\" data-prefix=\"fa\" data-icon=\"search\" role=\"img\" xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 512 512\" data-fa-i2svg=\"\"><path fill=\"currentColor\" d=\"M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z\"></path></svg><!-- <button tabindex=\"-1\" type=\"submit\" name=\"cbsearch\" id=\"cbsearch\" class=\"btn btn-default fa fa-search btn-search\"></button> -->\n";
			Buildhtml += "							</div>\n";
			Buildhtml += "						</div>\n";
			Buildhtml += "					</form><!-- form Ends -->\n";
			Buildhtml += "				</div>\n";
			Buildhtml += "				<div class=\"col btn-holder text-right\">\n";
						    
      
			Buildhtml += "					<ul class=\"nav navbar-nav navbar-right right-menu loggedout\" >\n";
		
				Buildhtml += "					<!-- Shown to small devices only Start  @todo : Add condition for logged in user -->\n";
							
			Buildhtml += "							<li class=\"dropdown\" >\n";
				 
      
                    		    
										   						    
            Buildhtml += " <a class=\"dropdown-toggle\" role=\"button\" data-toggle=\"dropdown\" href=\"#\">  <i class=\'fa fa-th\' style=\'font-size:20px\'></i></a><ul id=\"g-account-menu\" class=\"dropdown-menu\" role=\"menu\"  style=\"width:208px;height:360px; border:20px;border-color:coral; background-color:#eeeeee ;color: white;\" >\n";
				   Buildhtml += " <li><a href=\"/index.php\"  target=\"new\"><i class=\"fa fa-home\"></i>Home</a></li>\n";
                  Buildhtml += "<li><a href=\"/account.php\"  target=\"new\"><i class=\"fa fa-user\"></i>Account</a></li>\n";
                       					
				Buildhtml += "		</ul>\n";
						Buildhtml += "			<ul>\n";		         
				
				Buildhtml += "			</ul>\n";
	Buildhtml += "	<a href=\"javascript:void(0)\" class=\"btn-search-toggle btn visible-xs\">	\n";
	Buildhtml += "<svg class=\"svg-inline--fa fa-search fa-w-16\" aria-hidden=\"true\" data-prefix=\"fa\" data-icon=\"search\" role=\"img\" xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 512 512\" data-fa-i2svg=\"\"><path fill=\"currentColor\" d=\"M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z\"></path></svg><!-- <i class=\"fa fa-search\"></i> --></a>\n";																	
						
								Buildhtml += "	</div>\n";
						Buildhtml += "	</div>\n";
					Buildhtml += "	</div><!--navbar-collapse-->\n";
				Buildhtml += "	</div>\n";
			Buildhtml += "	</div><!--container-fluid-->\n";
		Buildhtml += "	</nav>\n";
	Buildhtml += "	</div>\n";

	Buildhtml += "</header>\n";

				
Buildhtml += "<script src=\"https://vga.smtvs.com/dark-gold/js/side-bar-menu.js\"><\/script>\n";
  
   
  
    
Buildhtml += "<aside id=\"sidebar\" class=\"custom-elements\">\n";
Buildhtml += "	<div class=\"scrollable-area-wrapper\" style=\"width: 220px; height: 630px;\">\n";
Buildhtml += "<div class=\"sidebar-holder scrollable-area\" style=\"position: relative; overflow: hidden; width: 213px; height: 610px;\">\n";
Buildhtml += "		<ul class=\"min-list\">\n";



Buildhtml += "			<li class=\"active\">\n";
Buildhtml += "<a href="+ document.getElementById("menu-url").value +"\"\"><svg class=\"svg-inline--fa fa-home fa-w-18\" aria-hidden=\"true\" data-prefix=\"fa\" data-icon=\"home\" role=\"img\" xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 576 512\" data-fa-i2svg=\"\"><path fill=\"currentColor\" d=\"M488 312.7V456c0 13.3-10.7 24-24 24H348c-6.6 0-12-5.4-12-12V356c0-6.6-5.4-12-12-12h-72c-6.6 0-12 5.4-12 12v112c0 6.6-5.4 12-12 12H112c-13.3 0-24-10.7-24-24V312.7c0-3.6 1.6-7 4.4-9.3l188-154.8c4.4-3.6 10.8-3.6 15.3 0l188 154.8c2.7 2.3 4.3 5.7 4.3 9.3zm83.6-60.9L488 182.9V44.4c0-6.6-5.4-12-12-12h-56c-6.6 0-12 5.4-12 12V117l-89.5-73.7c-17.7-14.6-43.3-14.6-61 0L4.4 251.8c-5.1 4.2-5.8 11.8-1.6 16.9l25.5 31c4.2 5.1 11.8 5.8 16.9 1.6l235.2-193.7c4.4-3.6 10.8-3.6 15.3 0l235.2 193.7c5.1 4.2 12.7 3.5 16.9-1.6l25.5-31c4.2-5.2 3.4-12.7-1.7-16.9z\"></path></svg><!-- <i class=\"fa fa-home\" aria-hidden=\"true\"></i> -->"+ document.getElementById("menu-text").value +"</a>\n";
Buildhtml += "			</li>\n";
Buildhtml += "						<li>\n";
Buildhtml += "	<a href=\""+ document.getElementById("menu-url2").value +"\"  target=\"new\"><svg class=\"svg-inline--fa fa-plus-circle fa-w-16\" aria-hidden=\"true\" data-prefix=\"fas\" data-icon=\"plus-circle\" role=\"img\" xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 512 512\" data-fa-i2svg=\"\"><path fill=\"currentColor\" d=\"M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm144 276c0 6.6-5.4 12-12 12h-92v92c0 6.6-5.4 12-12 12h-56c-6.6 0-12-5.4-12-12v-92h-92c-6.6 0-12-5.4-12-12v-56c0-6.6 5.4-12 12-12h92v-92c0-6.6 5.4-12 12-12h56c6.6 0 12 5.4 12 12v92h92c6.6 0 12 5.4 12 12v56z\"></path></svg><!-- <i class=\"fas fa-plus-circle\"></i>\n";
Buildhtml += "<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-film\" viewBox=\"0 0 16 16\">\n";
 Buildhtml += "<path d=\"M0 1a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V1zm4 0v6h8V1H4zm8 8H4v6h8V9zM1 1v2h2V1H1zm2 3H1v2h2V4zM1 7v2h2V7H1zm2 3H1v2h2v-2zm-2 3v2h2v-2H1zM15 1h-2v2h2V1zm-2 3v2h2V4h-2zm2 3h-2v2h2V7zm-2 3v2h2v-2h-2zm2 3h-2v2h2v-2z\"/></svg>-->"+ document.getElementById("menu-text2").value +"\n";
Buildhtml += "				</a>\n";
Buildhtml += "			</li>\n";
Buildhtml += "		</ul>\n";
Buildhtml += "		<!-- Left Column Start -->\n";
	Buildhtml += "	<div class=\"text-container\">\n";
		Buildhtml += "	<div class=\"cat-list clearfix more-text\">\n";
			Buildhtml += "	<h2>Categories</h2>\n";
				Buildhtml += "					<li>\n";
				Buildhtml += "	<a href=\""+ document.getElementById("menu-url3").value +"\">\n";
				Buildhtml += "<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-person-vcard\" viewBox=\"0 0 16 16\">	\n";
                Buildhtml += "<path d=\"M5 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm4-2.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5ZM9 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4A.5.5 0 0 1 9 8Zm1 2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5Z\"/>	\n";
                Buildhtml += "<path d=\"M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H2ZM1 4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H8.96c.026-.163.04-.33.04-.5C9 10.567 7.21 9 5 9c-2.086 0-3.8 1.398-3.984 3.181A1.006 1.006 0 0 1 1 12V4Z\"/></svg>	\n";			
				Buildhtml += "				<span>"+ document.getElementById("menu-text3").value +"</span>\n";
				Buildhtml += "			</a>\n";
				Buildhtml += "	</li>\n";
						
					Buildhtml += "					<li>\n";
					Buildhtml += "<a href=\""+ document.getElementById("menu-url4").value +"\">\n";
					Buildhtml += "	<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-cloud-upload\" viewBox=\"0 0 16 16\">\n";
                    Buildhtml += "	<path fill-rule=\"evenodd\" d=\"M4.406 1.342A5.53 5.53 0 0 1 8 0c2.69 0 4.923 2 5.166 4.579C14.758 4.804 16 6.137 16 7.773 16 9.569 14.502 11 12.687 11H10a.5.5 0 0 1 0-1h2.688C13.979 10 15 8.988 15 7.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 2.825 10.328 1 8 1a4.53 4.53 0 0 0-2.941 1.1c-.757.652-1.153 1.438-1.153 2.055v.448l-.445.049C2.064 4.805 1 5.952 1 7.318 1 8.785 2.23 10 3.781 10H6a.5.5 0 0 1 0 1H3.781C1.708 11 0 9.366 0 7.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383z\"/>\n";
                    Buildhtml += "	<path fill-rule=\"evenodd\" d=\"M7.646 4.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V14.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3z\"/></svg>\n";
					Buildhtml += "			<span>"+ document.getElementById("menu-text4").value +"</span>\n";
					Buildhtml += "		</a>\n";
					Buildhtml += "	</li>\n";
						
					
						
						
						
					Buildhtml += "		<li>\n";
					Buildhtml += "		<a href=\""+ document.getElementById("menu-url5").value +"\">\n";
					Buildhtml += "<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-window\" viewBox=\"0 0 16 16\">\n";
                    Buildhtml += "	<path d=\"M2.5 4a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1zm2-.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm1 .5a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z\"/>\n";
                    Buildhtml += "	 <path d=\"M2 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2H2zm13 2v2H1V3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1zM2 14a1 1 0 0 1-1-1V6h14v7a1 1 0 0 1-1 1H2z\"/></svg>\n";
					Buildhtml += "			<span>"+ document.getElementById("menu-text5").value +"</span>\n";
					Buildhtml += "		</a>\n";
					Buildhtml += "	</li>\n";
					Buildhtml += "				<li>\n";
					Buildhtml += "		<a href=\""+ document.getElementById("menu-url6").value +"\">\n";
					Buildhtml += "<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-person-circle\" viewBox=\"0 0 16 16\">\n";
                    Buildhtml += "	<path d=\"M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z\"/>\n";
                    Buildhtml += "	<path fill-rule=\"evenodd\" d=\"M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z\"/></svg>\n";
					Buildhtml += "			<span>"+ document.getElementById("menu-text6").value +"</span>\n";
					Buildhtml += "		</a>\n";
					Buildhtml += "	</li>\n";
								
								
								
	Buildhtml += "					</div>\n";
				
	Buildhtml += "	</div>\n";

		Buildhtml += "			<!-- footer_tube -->\n";
	Buildhtml += "	<div class=\"footer_tube\">\n";
	Buildhtml += "	<div class=\"footer-holder\">\n";
			
	Buildhtml += "		<ul class=\"footer-links column\">\n";
	Buildhtml += "		<li><a href=\""+ document.getElementById("menu-url7").value +"\">"+ document.getElementById("menu-text7").value +"</a></li>\n";
	Buildhtml += "		<li><a href=\""+ document.getElementById("menu-url8").value +"\">"+ document.getElementById("menu-text8").value +"</a></li>\n";
	Buildhtml += "		<li><a href=\""+ document.getElementById("menu-url9").value +"\">"+ document.getElementById("menu-text9").value +"</a></li>\n";
	Buildhtml += "	</ul>\n";
			
Buildhtml += "<div class=\"vscroll-down\"></div></div></div><!-- Left Column Ends -->\n";
	    Buildhtml += "</aside>     \n";	
	    
	    
	    Buildhtml += "	<div class=\"middle-section\"><br><P><br><P><br><P>\n";
	    Buildhtml += "	<div id=\"container\">\n";                                        

     
     	Buildhtml += "	<div class=\"elementor-element elementor-element-95e904d elementor-widget elementor-widget-lucille-section-subtitle\" data-id=\"95e904d\" data-element_type=\"widget\" data-widget_type=\"lucille-section-subtitle.default\">\n";
			Buildhtml += "	<div class=\"elementor-widget-container\">\n";
		Buildhtml += "	<h4 class=\"section_subtitle lcl_elt_section_subtitle\"></h4>		</div>\n";
			Buildhtml += "	</div>\n";
				
			Buildhtml += "	<div class=\"elementor-element elementor-element-d4df8fe elementor-widget elementor-widget-spacer\" data-id=\"d4df8fe\" data-element_type=\"widget\" data-widget_type=\"spacer.default\">\n";
		Buildhtml += "		<div class=\"elementor-widget-container\">\n";
		Buildhtml += "			<div class=\"elementor-spacer\">\n";
		Buildhtml += "	<div class=\"elementor-spacer-inner\"></div>\n";
	Buildhtml5 += "	</div>\n";
	Buildhtml5 += "			</div>\n";
	Buildhtml5 += "			</div>\n";
	
	Buildhtml += "		<div class=\"elementor-element elementor-element-97017db elementor-widget elementor-widget-lucille-featured-music-album\" data-id=\"97017db\" data-element_type=\"widget\" data-widget_type=\"lucille-featured-music-album.default\">\n";
	Buildhtml += "				<div class=\"elementor-widget-container\">\n";
	Buildhtml += "					<div class=\"lc_swp_boxed clearfix\">\n";
	Buildhtml += "			<div class=\"album_left vc_elem_album\">\n";
	Buildhtml += "				<a href=\"https://smartwpress.com/lucille3/js_albums/stereotypes/\">\n";
	Buildhtml += "					<img fetchpriority=\"high\" width=\"559\" height=\"559\" src=\""+songImage.value+"\" class=\"attachment-post-thumbnail size-post-thumbnail wp-post-image\" alt=\"\"\" /></a>\n";
	Buildhtml += "			</div>\n";
			
	Buildhtml += "			<div class=\"album_right vc_elem_album\">\n";
			  
        Buildhtml += ""+ document.getElementById("textarea").value +"\n";   
		Buildhtml += "</div>\n";
			
	Buildhtml += "				<div class=\"small_content_padding lc-elt-album-content\">\n";
	Buildhtml += "									</div>\n";

	Buildhtml += "				<div class=\"lc_event_entry text_left\">\n";
	Buildhtml += "											<div class=\"lc_button album_buy_from lc-elt-buy-from\">\n";
	Buildhtml += "							<a target=\"_blank\" href=\"http://www.amazon.com\">\n";
	Buildhtml += "								Amazon							</a>\n";
	Buildhtml += "						</div>\n";
					
	Buildhtml += "											<div class=\"lc_button album_buy_from lc-elt-buy-from\">\n";
	Buildhtml += "							<a target=\"_blank\" href=\"http://itunes.apple.com\">\n";
	Buildhtml += "								iTunes							</a>\n";
	Buildhtml += "						</div>\n";
					
	Buildhtml += "											<div class=\"lc_button album_buy_from lc-elt-buy-from\">\n";
	Buildhtml += "							<a target=\"_blank\" href=\"http://www.soundcloud.com\">\n";
	Buildhtml += "								SoundCloud							</a>\n";
	Buildhtml += "						</div>\n";
					
					
	Buildhtml += "											<div class=\"lc_button album_buy_from lc-elt-buy-from\">\n";
	Buildhtml += "							<a target=\"_blank\" href=\"https://play.google.com/store\">\n";
	Buildhtml += "								GooglePlay							</a>\n";
	Buildhtml += "						</div>\n";
					
	Buildhtml += "									</div>\n";			
	Buildhtml += "			</div>\n";
			
	
	
     
     
         Buildhtml += "<center>\n";
         
         
         
         
         
         
         
        
         Buildhtml += "</center>\n";
      
       Buildhtml += " <div class=\"feed-description\">\n";
      
       
      Buildhtml += "  </div>\n";

     Buildhtml += " </div>\n";
  Buildhtml += "  </div>\n";
Buildhtml += "  </div>\n";
 
 Buildhtml += "  </div>\n";
Buildhtml += "  </div>\n";
 
 

 
      
       Buildhtml += " <div class=\"span6\" style=\"text-align: right\">\n";

       

Buildhtml += "</div>   </div>\n";
Buildhtml += "<BR><P><BR><P><BR><P><BR><P><BR><P><BR><P><BR><P><BR><P>\n";
 Buildhtml += "<section class=\"mcon-footer\">\n";
   Buildhtml += "     <div class=\"container\">\n";
    Buildhtml += "        <div class=\"row\">\n";

           Buildhtml += "    </div>\n";

           Buildhtml += "    <div class=\"row\">\n";
           Buildhtml += "        <div class=\"col-md-6\">\n";
            Buildhtml += " &copy; copyright <a href=\"http://bit.ly/nM4R6u\"></a> 2013\n";

          Buildhtml += "         </div>\n";
        Buildhtml += "           <div class=\"col-md-6\" style=\"text-align: right\">\n";
        Buildhtml += "               <iframe src=\"//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2Fdigitalzoomstudio&amp;width=150&amp;height=21&amp;colorscheme=light&amp;layout=button_count&amp;action=like&amp;show_faces=true&amp;send=false&amp;appId=569360426428348\" scrolling=\"no\" frameborder=\"0\" style=\"border:none; overflow:hidden; width:150px; height:21px;\" allowTransparency=\"true\"></iframe>\n";
       Buildhtml += "            </div>\n";
        Buildhtml += "       </div>\n";
       Buildhtml += "    </div>\n";
Buildhtml += "   </section>\n";

Buildhtml += "   <div class=\"col-md-3 col-sm-6 hero-feature\"> \n";
Buildhtml += "   <div class=\"thumbnail\">\n";
Buildhtml += "<div class=\"dzsap-sticktobottom-placeholder\"></div> \n"; 
 Buildhtml += "      <section class=\"dzsap-sticktobottom  dzsap-sticktobottom-for-skin-wave-small\">  \n";

      Buildhtml += "     <style>.audioplayer.skin-wave#dzsap_footer.ap-controls .con-playpause .playbtn,.audioplayer.skin-wave#dzsap_footer .btn-embed-code,\n";

    Buildhtml += " .audioplayer.skin-wave#dzsap_footer .ap-controls .con-playpause .pausebtn { background-color: #111111;}  </style>\n";


Buildhtml += "   <div id=\"ap_footer\" class=\"audioplayer-tobe dzsap_footer button-aspect-noir button-aspect-noir--filled\"\n";

  Buildhtml += "          style=\"width:100%; \" data-thumb=\"../img/thumbs2.jpg\" data-thumb_link\img/thumb.\" data-bgimage=\"img/bg.jpg\"\n";

   Buildhtml += "         data-scrubbg=\"waves/scrubbg.\" data-scrubprog=\"waves/scrubprog.png\" data-type=\"fake\" data-source=\"fake\"\n";

  Buildhtml += "          data-sourceogg=\"../sounds/itsabeautifulday.ogg\">\n";

  Buildhtml += "       <!--  data-sourceogg=\"sounds/adg3.ogg\"  -->\n";

  Buildhtml += "       <div class=\"the-comments\">\n";

  Buildhtml += "       </div>\n";

  Buildhtml += "       <div class=\"meta-artist\"><span class=\"the-artist\">Tim McMorris</span><span class=\"the-name\"><a href=\"http://codecanyon.net/item/zoomsounds-wordpress-audio-player/6181433?ref=ZoomIt\" target=\"_blank\">It's a beautiful day</a></span>\n";

   Buildhtml += "      </div>\n";

  Buildhtml += "     </div>\n";

  Buildhtml += "   </section>\n";

 

Buildhtml += "<script src=\"https://vga.smtvs.com/developers/video-code/js/vga-zoom.js\"><\/script>\n";
        Buildhtml += "</div>\n";
	    Buildhtml += "</div>\n";

        Buildhtml += "</body>\n";
        Buildhtml += "</html>";
        
        
    }
}  

form.Text3.value+=Buildhtml;
}

  
  
  
  
  </script>  
    
<script type="text/javascript">
    
    
   
    function View(form) {
        msg=open("","DisplayWindow","status=1,scrollbars=1");
        msg.document.write(form.Text3.value);
    }
    
    /* ---------------------------------------------------------------------- *\
     Function    : Generate HTML5 VideoPlayer()
     Description : HTML5 Video Player generator.
     \* ---------------------------------------------------------------------- */




function Generateform(form) {
    
    
    var txt="<video class=\""+form.Skin.value+"\" audio=\""+form.html5player_audio.value+"\" autoplay=\""+form.html5player_autoplay.value+"\" loop=\""+form.html5player_loop.value+"\" poster=\""+form.html5player_poster.value+"\" preload=\""+form.html5player_preload.value+"\" width=\""+form.html5player_width.value+"\" height=\""+form.html5player_height.value+"\" controls  controlsList=\""+form.html5PlayerControls.value+"\">" ;
    
    
    
    if(form.text.value){
        
        txt+=""+form.text.value+"";
    }
    
    
    txt+="</video>";
    
    form.textarea.value=txt;
}


function Generateform2(form) {
    
    var txt="<audio  audio=\""+form.html5player_audio.value+"\" autoplay=\""+form.html5player_autoplay.value+"\" loop=\""+form.html5player_loop.value+"\" poster=\""+form.html5player_poster.value+"\" preload=\""+form.html5player_preload.value+"\" width=\""+form.html5player_width.value+"\" height=\""+form.html5player_height.value+"\" controls  controlsList=\""+form.html5PlayerControls.value+"\">" ;
    
    
    if(form.text.value){
        
        txt+=""+form.text.value+"";
    }
    
    
    txt+="</audio>";
    
    form.textarea.value=txt;
}




function AddPlaylist(form, Action){
    var AddPlyl="";
    var plyl="";
    if(Action==1){
 if(plyl!=null)

AddPlyl="<a href=\""+form.videoFile.value+"\" class=\"currentvid\"><img src=\""+form.html5player_poster.value+"\" width=\"200\" class=\"img-responsive\"><p><time datetime=\"&gt;2021-02-13\" class=\"duration\">"+form.videoduration.value+"</time><p style=\"font-size: 10px; font-family: arial, verdana, helvetica, sans serif; margin-left: 1px; color:#000;\"class=\"f-title\"> "+form.videotitle.value+"</p></a>\n";

  
 }
  
  if(Action==2){
 if(plyl!=null)

AddPlyl="<div class=\"column\"> <img   class=\"demo cursor\"  src=\""+form.html5player_poster.value+"\" style=\"width:100%\" onclick=\"currentSlide("+form.gnumber.value+")\"  alt=\""+form.videotitle.value+"\" ></div>\n";
        
        
       
         }
    


 
form.text2.value+=AddPlyl;
    
    
}

      
      
      



function AddPlayerText(form, Action){
    var AddPlyTxt="";
    var plytxt="";
    
    if(Action==1) {
        if(plytxt!=null)
        
        AddPlyTxt="<source src=\""+form.videoFile.value+"\" type=\""+form.html5FileType.value+"\" />\r\n" ;
        
    }
    
    
    if(Action==2) {
        if(plytxt!=null)
        
        AddPlyTxt=" <track kind=\""+form.html5player_kind.value+"\" src=\""+form.html5player_captions.value+"\" srclang=\"en\" label=\"English\"></track>\r\n" ;
        
        
    }
    
    
     
    
        
     
   
    
    
    
    form.text.value+=AddPlyTxt;
}







function AddPlayer(form, Action){
    var AddPly="";
    var ply="";
    if(Action==1){
        if(ply!=null)
        AddPly="<video   src=\""+form.videoFile.value+"\"  poster=\""+form.html5player_poster.value+"\" preload=\""+form.html5player_preload.value+"\"  width=\""+form.html5player_width.value+"\" height=\""+form.html5player_height.value+"\" controls  controlsList=\""+form.html5PlayerControls.value+"\" type=\""+form.html5FileType.value+"\"></video>\r\n" ;
        
    }
    
    
    if(Action==4) {
        if(ply!=null)
        AddPly="<audio  src=\""+form.videoFile.value+"\"  preload=\""+form.html5player_preload.value+"\"   width=\""+form.html5player_width.value+"\" height=\""+form.html5player_height.value+"\" controls  controlsList=\""+form.html5PlayerControls.value+"\"></audio>\r\n" ;
        
    }
    
    
    if(Action==5) {
        if(ply!=null)
        
        AddPly="<div class=\"mySlides\"><div class=\"numbertext\"></div> <img   class=\"img-fluid img-thumbnail\"  src=\""+form.html5player_poster.value+"\"  width=\""+form.html5player_width.value+"\" onclick=\"myFunction(this);\" ></div> \r\n" ;
        
    }
    
    
    
    if(Action==6) {
        if(ply!=null)
        AddPly="<audio src=\""+form.videoFile.value+"\"    width=\""+form.html5player_width.value+"\"></audio>\r\n" ;
        
    }
    
    
    if(Action==7) {
        if(ply!=null)
        AddPly="<video  src=\""+form.videoFile.value+"\"  width=\""+form.html5player_width.value+"\" height=\""+form.html5player_height.value+"\" controls  controlsList=\""+form.html5PlayerControls.value+"\" type=\""+form.html5FileType.value+"\"></video>\r\n" ;
        
    }
    if(Action==8){
        if(ply!=null)
        AddPly="<video class=\""+form.Skin.value+"\" src=\""+form.videoFile.value+"\" width=\""+form.html5player_width.value+"\" height=\""+form.html5player_height.value+"\" type=\""+form.html5FileType.value+"\" id=\""+form.html5player_id.value+"\" poster=\""+form.html5player_poster.value+"\" preload=\""+form.html5player_preload.value+"\"></video>\n" ;
        
    }
    
     if(Action==9){
        if(ply!=null)
        AddPly="  <div class=\"mySlides\"><div class=\"numbertext\">"+form.gnumber.value+"</div>  <video class=\"img-fluid img-thumbnail\"  src=\""+form.videoFile.value+"\"  poster=\""+form.html5player_poster.value+"\" preload=\""+form.html5player_preload.value+"\"  width=\""+form.html5player_width.value+"\" height=\""+form.html5player_height.value+"\" controls  controlsList=\""+form.html5PlayerControls.value+"\" type=\""+form.html5FileType.value+"\" onclick=\"myFunction(this);\"></video></div>\r\n" ;
        
    }
  

  
  
    
    
    form.textarea.value+=AddPly;
}
</script>

           
<script type="text/javascript">
    // VGA video Master function, encapsulates all functions
    function init() {
        var video = document.getElementById('my_video');
        var thecanvas = document.getElementById('thecanvas');
        var img = document.getElementById('thumbnail_img');
        
        
        video.addEventListener('pause', function(){
                               
                               draw( video, thecanvas, img);
                               
                               }, false);
                               
                               
                               
                               
                               function draw( video, thecanvas, img ){
                                   
                                   // get the canvas context for drawing
                                   var context = thecanvas.getContext('2d');
                                   
                                   // draw the video contents into the canvas x, y, width, height
                                   context.drawImage( video, 0, 0, thecanvas.width, thecanvas.height);
                                   
                                   // get the image data from the canvas object
                                   var dataURL = thecanvas.toDataURL();
                                   
                                   // set the source of the img tag
                                   img.setAttribute('src', dataURL);
                                   
                               }
                               

              if (video.canPlayType) {   // tests that we have HTML5 video support
            // if successful, display buttons and set up events
            document.getElementById("buttonbar").style.display = "block";
            document.getElementById("inputField").style.display = "block";

            //  button events
            //  Play
            document.getElementById("play").addEventListener("click", vidplay, false);
            //  Restart
            document.getElementById("restart").addEventListener("click", function(){
                setTime(0);
             }, false);
            //  Skip backward 10 seconds
            document.getElementById("rew").addEventListener("click", function(){
                setTime(-10);                
            }, false);
            //  Skip forward 10 seconds
            document.getElementById("fwd").addEventListener("click", function(){
                setTime(10);
            }, false);                
            //  set src == latest video file URL
            document.getElementById("loadVideo").addEventListener("click", getVideo, false);
                            
            // fail with message 
            video.addEventListener("error", function(err) {
                errMessage(err);
            }, true);
            //  display video duration when available
            video.addEventListener("loadedmetadata", function () {
                                   vLength = video.duration.toFixed(1);
                                   document.getElementById("vLen").textContent = vLength; // global variable
                                   }, false);
                                   

            //  display the current and remaining times
            video.addEventListener("timeupdate", function () {
                                   //  Current time
                                   var vTime = video.currentTime;
                                   document.getElementById("curTime").textContent = vTime.toFixed(1);
                                   document.getElementById("vRemaining").textContent = (vLength - vTime).toFixed(1);
                                   }, false);
                                   
                                         //  button helper functions 
            //  skip forward, backward, or restart
            function setTime(tValue) {
            //  if no video is loaded, this throws an exception 
                try {
                    if (tValue == 0) {
                        video.currentTime = tValue;
                    }
                    else {
                        video.currentTime += tValue;
                    }
                    
                 } catch (err) {
                     // errMessage(err) // show exception
                 errMessage("Video content might not be loaded");
                   }
         }
             //  play video
             function vidplay(evt) {
                if (video.src == "") {  // on first run, src is empty, go get file
                    getVideo();
                }
                button = evt.target; //  get the button id to swap the text based on the state                                    
                if (video.paused) {   // play the file, and display pause symbol
                   video.play();
                   button.textContent = "||";
                } else {              // pause the file, and display play symbol  
                   video.pause();
                   button.textContent = ">";
                }                                        
            }
            //  load video file from input field
            function getVideo() {
                var fileURL = document.getElementById("videoFile").value;  // get input field                    
                if (fileURL != ""){
                   video.src = fileURL;
                   video.load();  // if HTML source element is used
                   document.getElementById("play").click();  // start play
                 } else {
                    errMessage("Enter a valid video URL");  // fail silently
                 }
            }
            
            
            //  display an error message 
            function errMessage(msg) {
            // displays an error message for 5 seconds then clears it
                document.getElementById("errorMsg").textContent = msg;
                setTimeout("document.getElementById('errorMsg').textContent=''", 5000);
            }
            // change volume based on incoming value
            function setVol(value) {
                var vol = video.volume;
                vol += value;
                //  test for range 0 - 1 to avoid exceptions
                if (vol >= 0 && vol <= 1) {
                    // if valid value, use it
                    video.volume = vol;
                } else {
                    // otherwise substitute a 0 or 1
                    video.volume = (vol < 0) ? 0 : 1;
                }
            }
            //  button events
            //  Play
            document.getElementById("play").addEventListener("click", vidplay, false);
            //  Restart
            document.getElementById("restart").addEventListener("click", function () {
                                                                setTime(0);
                                                                }, false);
            //  Skip backward 10 seconds
            document.getElementById("rew").addEventListener("click", function () {
            setTime(-10);
            }, false);
        //  Skip forward 10 seconds
        document.getElementById("fwd").addEventListener("click", function () {
        setTime(10);
        }, false);
        //  set src == latest video file URL
        document.getElementById("loadVideo").addEventListener("click", getVideo, false);
                                                                                                                                                                
    // fail with message
    video.addEventListener("error", function (err) {
    errMessage(err);
    }, true);
    // volume buttons
    document.getElementById("volDn").addEventListener("click", function () {
setVol(-.1); // down by 10%
}, false);
document.getElementById("volUp").addEventListener("click", function () {
setVol(.1);  // up by 10%
}, false);

// playback speed buttons
document.getElementById("slower").addEventListener("click", function () {
video.playbackRate -= .25;
}, false);
document.getElementById("faster").addEventListener("click", function () {
video.playbackRate += .25;
}, false);
document.getElementById("normal").addEventListener("click", function () {
video.playbackRate = 1;
}, false);


document.getElementById("mute").addEventListener("click", function (evt) {
if (video.muted) {
video.muted = false;
evt.target.innerHTML = "<i class ='fa fa-volume-up'></i>"
} else {
video.muted = true;
evt.target.innerHTML = " <i class ='fa fa-volume-off'></i>"
}
     }, false);
        } // end of runtime
    }// end of master
</script>

<style type="text/css">
    p > i:first-child
    {
        font-weight:bold;
        color:blue;
        
    } 
</style>
<style>
* {
  padding: 0;
  margin: 0;
  box-sizing: border-box;
  font-family: 'Montserrat', sans-serif;
}

ul {
  list-style: none;
}
.context-menu { 
  position: absolute; 
} 
.menu {
  display: flex;
  flex-direction: column;
  background-color: #fff;
  border-radius: 10px;
  box-shadow: 0 10px 20px rgb(64 64 64 / 5%);
  padding: 10px 0;
}
.menu > li > a {
  font: inherit;
  border: 0;
  padding: 10px 30px 10px 15px;
  width: 100%;
  display: flex;
  align-items: center;
  position: relative;
  text-decoration: unset;
  color: #000;
  font-weight: 500;
  transition: 0.5s linear;
  -webkit-transition: 0.5s linear;
  -moz-transition: 0.5s linear;
  -ms-transition: 0.5s linear;
  -o-transition: 0.5s linear;
}
.menu > li > a:hover {
  background:#f1f3f7;
  color: #4b00ff;
}
.menu > li > a > i {
  padding-right: 10px;
}
.menu > li.trash > a:hover {
  color: red;
}
     </style>
    
       


<link href="https://vga.smtvs.com/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="https://vga.smtvs.com/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <script src="https://vga.smtvs.com/clipboard.js"></script> 

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
 <link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.4/slate/bootstrap.min.css" rel="stylesheet">



    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
 <link href="https://vga.smtvs.com/source/libs/bootstrap/bootstrap.min.css" rel="stylesheet">  
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" />
  
<link rel="stylesheet" href="https://vga.smtvs.com/css/all.css">
 
  <style>
    .github-corner:hover .octo-arm,
    .github-corner:focus .octo-arm {
      animation: octocat-wave 560ms ease-in-out;
    }
    @keyframes octocat-wave {
      0%,
      100% {
        transform: rotate(0);
      }
      20%,
      60% {
        transform: rotate(-25deg);
      }
      40%,
      80% {
        transform: rotate(10deg);
      }
    }
    @media (max-width: 500px) {
      .github-corner:hover .octo-arm {
        animation: none;
      }
      .github-corner .octo-arm {
        animation: octocat-wave 560ms ease-in-out;
      }
    }
  </style>
  <script src="https://kit.fontawesome.com/ef69927139.js" crossorigin="anonymous"></script>
  

    <style> /*
Source - https://stackoverflow.com/q/77186496
Posted by Hector, modified by community. See post 'Timeline' for change history
Retrieved 2026-05-12, License - CC BY-SA 4.0
*/

li {
  margin: 0;
  display: block;
}

li:before {
  display:none;
}

.nav {
  border-radius: 10px 10px 0 0;
  justify-content: center;
}

.nav > li > a {
  margin-top: 10px;
  padding: 10px 20px;
  display: block;
}

.nav-tabs > li > a {
  font-size: 18px;
  color: black;
  border: none;
  text-decoration: none;
}
.nav-tabs > li > a.active {
  margin: 10px 0;
  color: white;
  background: #cccccc;
  border-radius: 0px;
}

.info {
  padding: 0px;
  text-align: left;
}

.go-to {
  margin: 0 100px;
}
 
    </style>
 
 
<style>
h2 {
  display: block;
  text-align: center;
}

.example {
  margin: 0 0 10% 0;
}

.bootstrap {
  width: 600px;
  margin-right: auto;
  margin-left: auto;
}

.save button {
  display: block;
  width: 100%;
  margin-bottom: 15px;
  font-size: 24px;
}

#preview {
  min-height: 200px;
  background-color: #EFEFEF;
}
#preview img {
  max-width: 100%;
}
</style>
 
 
 
    <style>
        :root {
            --sidebar-width: 260px; --sidebar-width-collapsed: 90px;
            --header-height-mobile: 60px; --color-primary: #0d6efd; --color-sidebar-bg: #fff;
            --color-sidebar-text: #344767; --color-sidebar-link-active-bg: rgba(0, 0, 0, 0.06);
            --color-page-bg: #f8f9fa; --color-text-primary: #333; --color-border: #e9ecef;
            --font-family-sans-serif: "Poppins", system-ui, -apple-system, sans-serif;
            --transition-speed: 0.3s;
        }
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');
        
        *, *::before, *::after { box-sizing: border-box; }
        html, body { height: 100%; margin: 0; }
        body { font-family: var(--font-family-sans-serif); background-color: var(--color-page-bg); color: var(--color-text-primary); }

        .app-layout { display: flex; min-height: 100vh; }

        /* --- Vertical Sidebar --- */
        .sidebar {
            position: fixed; top: 0; left: 0; width: var(--sidebar-width); height: 100vh;
            background-color: var(--color-sidebar-bg); border-right: 1px solid var(--color-border);
            display: flex; flex-direction: column; z-index: 1000;
            transform: translateX(-100%); transition: transform var(--transition-speed) ease;
        }
        .sidebar.is-open { transform: translateX(0); }
        .sidebar__header { padding: 1.5rem; flex-shrink: 0; border-bottom: 1px solid var(--color-border); }
        .sidebar__brand { font-size: 1.5rem; font-weight: 600; text-decoration: none; color: var(--color-text-primary); display: flex; align-items: center; gap: 0.75rem; }
        .sidebar__menu { list-style: none; margin: 0; padding: 1rem; flex-grow: 1; }
        .sidebar-link {
            display: flex; align-items: center; gap: 1rem; padding: 0.8rem 1rem;
            border-radius: 8px; margin-bottom: 0.5rem; color: var(--color-sidebar-text); text-decoration: none;
            transition: background-color 0.2s, color 0.2s;
        }
        .sidebar-link__icon { width: 24px; height: 24px; flex-shrink: 0; }
        .sidebar-link__text { white-space: nowrap; transition: opacity var(--transition-speed) ease, width var(--transition-speed) ease; }
        .sidebar-link:hover { background-color: var(--color-sidebar-link-active-bg); }
        .sidebar-link.is-active { background-color: var(--color-primary); color: #fff; }

        .sidebar__footer { padding: 1.5rem; flex-shrink: 0; border-top: 1px solid var(--color-border); }
        #sidebar-collapse-btn { display: none; } /* Hidden on mobile */
        
        /* --- Mobile Header & Content --- */
        .mobile-header { display: flex; align-items: center; justify-content: space-between; height: var(--header-height-mobile); padding: 0 1rem; background: #fff; border-bottom: 1px solid var(--color-border); }
        .page-content-wrapper { width: 100%; }
        .main-content { padding: 1.5rem; }
        .sidebar-overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); z-index: 999; }
        
        /* --- Desktop Styles --- */
        @media (min-width: 992px) {
            .mobile-header, .sidebar-overlay { display: none; }
            .sidebar { position: sticky; transform: translateX(0); transition: width var(--transition-speed) ease; }
            .page-content-wrapper { flex-grow: 1; margin-left: var(--sidebar-width); transition: margin-left var(--transition-speed) ease; }
            
            #sidebar-collapse-btn { display: flex; }

            /* --- Collapsed State --- */
            .sidebar.is-collapsed { width: var(--sidebar-width-collapsed); }
            .sidebar.is-collapsed .sidebar-link { justify-content: center; }
            .sidebar.is-collapsed .sidebar-brand { justify-content: center; }

            /* Hide all text spans when collapsed */
            .sidebar.is-collapsed .sidebar-link__text,
            .sidebar.is-collapsed .sidebar__brand span {
                opacity: 0; width: 0; padding: 0; margin: 0; overflow: hidden;
            }
            .sidebar.is-collapsed + .page-content-wrapper { margin-left: var(--sidebar-width-collapsed); }

            /* Logic for swapping collapse/expand icons */
            .icon-expand { display: none; }
            .sidebar.is-collapsed .icon-collapse { display: none; }
            .sidebar.is-collapsed .icon-expand { display: block; }
        }
    </style>
    
    
   <script src="https://vga.smtvs.com/dragfile/jquery-1.10.2.js"></script>
   
   
   <link rel="stylesheet" href="https://vga.smtvs.com/dragfile/jquery-ui.css">
     
       <script src="https://vga.smtvs.com/dragfile/jquery-ui.js"></script>
       
   <style>
       #draggable { width: 500px; height: 500px; padding: 0.5em; }
       #draggable h3 { text-align: center; margin: 0; }
       </style>
   <script>
       $(function() {
         $( "#draggable" ).draggable();
         $( "#html5videoplayer" ).draggable();
         $( "#captions" ).draggable();
         $( "#design" ).draggable();
         $( "#imagecapture" ).draggable();
         $( "#draggable5" ).draggable();
         $( "#draggable7" ).draggable();
         $( "#draggable8" ).draggable();
         $( "#draggable9" ).draggable();
         $( "#draggable10" ).draggable();
          $( "#source_code" ).draggable();
            $( "#side-bar-menu" ).draggable();
              $( "#video-add" ).draggable();
               $( "#audio-add" ).draggable();
             $( "#gridlist" ).draggable();
             $( "#file-manager" ).draggable();
             $( "#menu-footer" ).draggable();
             $( "#menulist").draggable();
             $( "#template").draggable();
             $( "#tempstyle").draggable();
              $( "#formproperties" ).draggable();
         $( "#form_builder" ).draggable();
         $( "#ImageProperties" ).draggable();
         $( "#textareaproperties" ).draggable();
          $( "#add-social-media" ).draggable();
         $( "#prop" ).draggable();
         });
       </script>

   <style>
       #resizable { width: 500px; height: 500px; padding: 0.5em; }
       #resizable h3 { text-align: center; margin: 0; }
       </style>
   
   <script>
       $(function() {
         $( "#resizable" ).resizable();
          $( "#source_code" ).resizable();
          
         });
       </script>
   
  
    
</head>
<body>
        <form  method="post" action="" > 
    
    
<!-- Template Page design  -->  
        
        <div   id="design" class="panel panel-default"  style="Z-INDEX: 27; POSITION: absolute; display:none; background-color:#C0C0C0 ;  WIDTH: 1180px; TOP:2px; LEFT: 120px" >
            <div class="panel-heading" >
                Design
            </div>
            
            <div id="" style="position: absolute; LEFT:1140px; TOP: 3px;  Z-INDEX: 0;">
                
                <button type="button" class="btn btn-default" data-toggle="tooltip" title="Close "  onclick="hideDesign();return false;">
                    <i class="fa  fa-plus-square"></i>
                </button></div>
            <div class="panel-body"id="g5" >
               
                <iframe src="about:blank" name="preview" style="height:714px;width:1150px;border:solid 1px #b9b8b6;background:#ffffff" frameborder="0"  class="form-control">
                </iframe>
            </div></div></div>
    
<div id="source_code" class="panel panel-default" style="Z-INDEX: 22; POSITION: absolute; OVERFLOW-Y: auto; OVERFLOW-X: hidden; display:none;TOP:30px; LEFT: 200px;width:1012px;" >
        <div class="panel-heading" >
            <IMG border=0   src="HTML5_Logo_32.png" > Code Editor   <button type="button" class="btn btn-default" data-toggle="tooltip" title="Live Preview"  onclick="preview.document.write (document.getElementsByTagName ('TEXTAREA')[0].value); preview.document.close(); preview.focus(); showDesign(); return false;"style="font-family: arial, verdana, helvetica; font-size: 10px;width:85">
        <i class="fa fa-eye"></i>
    </button>
	
	 		<button type="button" class="btn btn-default" id="" data-toggle="tooltip" title="Web PreView "size="33"  style="font-family: arial, verdana, helvetica; font-size: 10px;width:80px;" onclick="View(this.form);return false;">
            <i class="fa  fa-plus-square"></i>Web View
        </button>
         
					<button type="button" class="btn btn-default" id="" data-toggle="tooltip" title="Generate html" size="33"  style="font-family: arial, verdana, helvetica; font-size: 10px;width:140px;" onclick="Buildhtml(form,3);return false;">
            <i class="fa  fa-plus-square"></i>Generate html</button>
    		
                </div>
     		
       
        
        
        
        <div id="" style="position: absolute; LEFT:962px; TOP: 3px;  Z-INDEX: 0;">
            
            <button type="button" class="btn btn-default" data-toggle="tooltip" title="Close " onClick="hideSourceCode();return false;">
                <i class="fa  fa-plus-square"></i>
            </button></div>


       <p>
 </div></div>
           
      
    

    <div >


               </div>
    </div>
    <div class="app-layout">
        <nav class="sidebar" id="app-sidebar">
            <div class="sidebar__header">
                <a href="#" class="sidebar__brand">
                    <svg viewBox="0 0 24 24" width="32" height="32"><path fill="currentColor" d="M12,2L3,7.5V16.5L12,22L21,16.5V7.5L12,2Z" /></svg>
                    <span>DarkGoldMedia</span>
                </a>
            </div>
            <ul class="sidebar__menu">
                <li><a href="#" class="sidebar-link is-active"><svg class="sidebar-link__icon" viewBox="0 0 24 24"><path fill="currentColor" d="M10,20V14H14V20H19V12H22L12,3L2,12H5V20H10Z" /></svg><span class="sidebar-link__text">Dashboard</span></a></li>
                <li><a href="" class="sidebar-link"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-music-note-beamed" viewBox="0 0 16 16">
  <path d="M6 13c0 1.105-1.12 2-2.5 2S1 14.105 1 13s1.12-2 2.5-2 2.5.896 2.5 2m9-2c0 1.105-1.12 2-2.5 2s-2.5-.895-2.5-2 1.12-2 2.5-2 2.5.895 2.5 2"/>
  <path fill-rule="evenodd" d="M14 11V2h1v9zM6 3v10H5V3z"/>
  <path d="M5 2.905a1 1 0 0 1 .9-.995l8-.8a1 1 0 0 1 1.1.995V3L5 4z"/>
</svg><span class="sidebar-link__text">Audio Studio</span></a></li>
                <li><a href="#" class="sidebar-link"><svg class="sidebar-link__icon" viewBox="0 0 24 24"><path fill="currentColor" d="M16,11.75V10.25L12,11L8,10.25V11.75L12,12.5L16,11.75M12,2L1,9L12,16L23,9L12,2M6,10.05V13L12,14.6L18,13V10.05L12,11.6L6,10.05Z" /></svg><span class="sidebar-link__text">
Audio Generator</span></a></li>
          
            
            </ul>
            <div class="sidebar__footer">
                <a href="#" class="sidebar-link" id="sidebar-collapse-btn">
                    <!-- The collapse (left arrow) icon -->
                    <svg class="sidebar-link__icon icon-collapse" viewBox="0 0 24 24"><path fill="currentColor" d="M20,11V13H8L13.5,18.5L12.08,19.92L4.16,12L12.08,4.08L13.5,5.5L8,11H20Z" /></svg>
                    <!-- The expand (right arrow) icon -->
                    <svg class="sidebar-link__icon icon-expand" viewBox="0 0 24 24"><path fill="currentColor" d="M4,11V13H16L10.5,18.5L11.92,19.92L19.84,12L11.92,4.08L10.5,5.5L16,11H4Z" /></svg>
                    <span class="sidebar-link__text">Collapse</span>
                </a>
            </div>
        </nav>
 
        <div class="page-content-wrapper">
            <header class="mobile-header">
                <button id="mobile-menu-open-btn" aria-label="Open menu" aria-controls="app-sidebar" aria-expanded="false">&#x2630;</button>
                <a href="#list2" class="sidebar__brand"><span>App</span>Panel</a>
            </header>
            <main class="main-content">
                <h1>Dashboard</h1>
                
                <p>Dark Gold Media Cloud Studio <b>Audio</b><a href="#">
                   </a><br></p>
                
                 
<ul class="nav nav-tabs" role="tablist" >
    
    
    <li role="presentation"> <a href="#list1" id="list1-tab" data-bs-toggle="tab" data-bs-target="#list1" role="tab" aria-controls="list1" aria-selected="true" class="active">Code Editor</a> </li>
    <li role="presentation"> <a href="#list2" id="list2-tab" data-bs-toggle="tab" data-bs-target="#list2" role="tab" aria-controls="list2" aria-selected="false" class="">Body Code Editor</a> </li>
    <li role="presentation"> <a href="#list3" id="list3-tab" data-bs-toggle="tab" data-bs-target="#list3" role="tab" aria-controls="list3" aria-selected="false" class="">Audio Generator </a> </li>
    <li role="presentation"> <a href="#list4" id="list4-tab" data-bs-toggle="tab" data-bs-target="#list4" role="tab" aria-controls="list4" aria-selected="false" class="">Image Gallery Generator</a> </li>
   
</ul>
<div class="tab-content">       

    <div id="list1" role="tabpanel" aria-labelledby="list1-tab" class="tab-pane active">
    <div class="info">
                 HTML Code Editor
<div class="panel-body" id="g5">
<textarea class="form-control" rows="15" cols="160"  name="file"  id="Text3" style=" Z-INDEX: 2;    font-size: 15px; color:#0000FF; font-family: arial, verdana, helvetica, sans serif; margin-left: 1px; width: 100%; height:400px;">
</textarea><P>

            
          
            <p>
               <input class="form-controls" type="text"  name="filename" id=data value=""  size="70" />
           
            <p>
            
            <input class="btn btn-default"type="submit" name="save_file" value="Save" style="font-family: arial, verdana, helvetica; font-size: 10px;width:85" />
           </div>
    
    
    
    
    
    
    </div>
    <a href="#list2" class="go-to">Go to List 2</a>
  </div>
  
    <div id="list2" role="tabpanel" aria-labelledby="list2-tab" class="tab-pane">
    <div class="info">
         <div class="panel-heading" >
            <button type="button" class="btn btn-default" data-toggle="tooltip" title="Live Preview"  onclick="preview.document.write (document.getElementsByTagName ('TEXTAREA')[0].value); preview.document.close(); preview.focus(); showDesign(); return false;"style="font-family: arial, verdana, helvetica; font-size: 10px;width:85">
        <i class="fa fa-eye"></i>
    </button>
	
	 		<button type="button" class="btn btn-default" id="" data-toggle="tooltip" title="Web PreView "size="33"  style="font-family: arial, verdana, helvetica; font-size: 10px;width:80px;" onclick="View(this.form);return false;">
            <i class="fa  fa-plus-square"></i>Web View
        </button>
         
         
					<button type="button" class="btn btn-default" id="" data-toggle="tooltip" title="Generate html" size="33"  style="font-family: arial, verdana, helvetica; font-size: 10px;width:100px;" onclick="Buildhtml(form,3);return false;">
            <i class="fa  fa-plus-square"></i>Generate html</button>
    		
    			<button type="button" class="btn btn-default" id="" data-toggle="tooltip" title="SourceCode View "size="33"
         	style="font-family: arial, verdana, helvetica; font-size: 10px;width:90px;" onClick="showSourceCode();return false;">
            <i class="fa  fa-plus-square"></i>SourceCode
        </button>
    		 
            	<button type="button" class="btn btn-default" id="" data-toggle="tooltip" title="Menu" size="33"  style="font-family: arial, verdana, helvetica; font-size: 10px;width:100px;" onClick="showMenuList();return false;">
            <i class="fa  fa-plus-square"></i>Menu List</button>
            
					<button type="button" class="btn btn-default" id="" data-toggle="tooltip" title="GridList" size="33"  style="font-family: arial, verdana, helvetica; font-size: 10px;width:100px;"  onClick="showGridList();return false;" >
            <i class="fa  fa-plus-square"></i>Shop Creator</button>
    		
    		<button class="btn btn-default"type="button" name="" value=""  size="23"  style="font-family: arial, verdana, helvetica; font-size: 10px;width:110px;" onclick="Buildhtml5(form,15);return false;">Insert About Image </button>
 <button class="btn btn-default"type="button" name="" value=""  size="23"  style="font-family: arial, verdana, helvetica; font-size: 10px;width:110px;" onclick="Buildhtml5(form,16);return false;">Insert About Text </button>
<button class="btn btn-default"type="button" name="" value=""  size="23"  style="font-family: arial, verdana, helvetica; font-size: 10px;width:100px;" onclick="Buildhtml5(form,17);return false;">Text &Info Link</button>
<button class="btn btn-default"type="button" name="" value=""  size="23"  style="font-family: arial, verdana, helvetica; font-size: 10px;width:100px;" onclick="Buildhtml5(form,19);return false;">Insert From</button>

     		
                
        
       
    <section class="section">
      <div class="row">
        <div class="col-lg-9">

          <div class="card">
            <div class="card-body">
            
               
	 <textarea class="form-control" name="body" id="textarea"  rows="20" cols="200"   style=" Z-INDEX: 2;    font-size: 19px; color:#0000FF; 
font-family: arial, verdana, helvetica, sans serif; margin-left: 1px; "></textarea>

		</div>
             
          </div>

        </div>
 
                <div class="col-lg-3">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Example </h5>
              <p>This is an example page with no content. You can use it as a starter for your custom pages  .</p>
              
<!-- Button (Double) --> 
 <div id="scroll3" style="width:170px;height:365px;background-color:#ffffff;overflow:scroll">
<div class="control-group">
   
  <label class="control-label" for="button1id"><font size="3" face="Arial Baltic"  color="#222222" >Templeat</font ></label>
  <div class="controls">
     
    <button id="button2id" name="button2id"  onclick="Buildhtml(form,15);return false;" class="btn btn-default" title ="Audio Album Page Template"><img alt="" src="https://vga.smtvs.com/dark-gold/images/album-temp.jpg" height="100" width="130" align="" border="1"/></button><P></P>
  

     
  </div>
</div>

  </div>
 

       
        <P>Video-pagebuilder-html-editor Porwered By SMTVS-VGA
            
                </div>   </div>
                <P>

  
</div> </div> 
    
    </div> </div> </div> 
    
    
    
  
  
  
    <div id="list3" role="tabpanel" aria-labelledby="list3-tab" class="tab-pane">
    <div class="info"><H4>Audio Generator </4H>
     
            <div class="panel-body" id="">
                
                 
                                    <div id= "inputField"  >
                 <button class="btn btn-default"type="button" name="" value=""  size="23"  style="font-family: arial, verdana, helvetica; font-size: 10px;width:100px;" onclick="Buildhtml5(form,5);return false;">Insert Audio</button>
   <button class="btn btn-default"type="button" name="" value=""  size="23"  style="font-family: arial, verdana, helvetica; font-size: 10px;width:110px;" onclick="Buildhtml5(form,11);return false;">Insert Audio Temp</button>
 <button class="btn btn-default"type="button" name="" value=""  size="23"  style="font-family: arial, verdana, helvetica; font-size: 10px;width:100px;" onclick="Buildhtml5(form,12);return false;">Insert Bio Text</button>
   <button type="button" class="btn btn-default" data-toggle="tooltip"  style="font-family: arial, verdana, helvetica; font-size: 10px;width:80px;"title="SocialMedia" onClick="showSocialMedia();return false;">
                 Social Media   
                </button> 
    <button type="button" class="btn btn-default" data-toggle="tooltip"  style="font-family: arial, verdana, helvetica; font-size: 10px;width:130px;"title="Live Performs " onClick="Buildhtml5(form,23);return false;">
                 Live Performs page 
                </button>              
               <button type="button" class="btn btn-default" data-toggle="tooltip"  style="font-family: arial, verdana, helvetica; font-size: 10px;width:130px;"title="Live Performs " onClick="Buildhtml5(form,24);return false;">
                 Live play
                </button>       
             
              </div>
               <P><span style="font-family: arial, verdana, helvetica; font-size: 11px; font-weight: bold;  color:#000000;"></span>
                                   
                                    <div id= "inputField"  >
                                        
                                           <select class="form-control" name="" id="footerplayer" style="font-family: arial, verdana, helvetica; font-size: 11px; width:250px;  ">
  <option value="">footerPlay Off</option>
  <option value="#ap_footer">footerPlay On</option>
  </select>       
                      	<select class="form-control" name="pageColor" id="pageColor" style="font-family: arial, verdana, helvetica; font-size: 11px; width: 250px;"> 

							<option value="" selected="selected">-Select Page Color-</option> 

							<option value=""> -- Standard -- </option>

							<option  value="#FF0000">Red</option> 

							<option value=" #FF6600 ">Orange</option> 

							<option value="#FFFF00">Yellow</option> 

							<option value=" #00FF00">Green</option> 

							<option value="#000000">Black</option> 

							<option value=" #FFFFFF">White</option> 

							<option value=" #0000FF">Blue</option> 

							<option  value="#C0C0C0">Silver</option> 

							<option value="#FF00FF">Magenta</option> 

							<option value=" #00FFFF">Cyan</option> 

							<option  value="  #FFCC00">Gold</option>

							<option value=""> -- Custom -- </option>

							<script>addColors(1);</script>

						</select>
						       	<select class="form-control" name="textColor" id="textColor" style="font-family: arial, verdana, helvetica; font-size: 11px; width: 250px;"> 

							<option value="" selected="selected">-Select Text Color-</option> 

							<option value=""> -- Standard -- </option>

							<option  value="#FF0000">Red</option> 

							<option value=" #FF6600 ">Orange</option> 

							<option value="#FFFF00">Yellow</option> 

							<option value=" #00FF00">Green</option> 

							<option value="#000000">Black</option> 

							<option value=" #FFFFFF">White</option> 

							<option value=" #0000FF">Blue</option> 

							<option  value="#C0C0C0">Silver</option> 

							<option value="#FF00FF">Magenta</option> 

							<option value=" #00FFFF">Cyan</option> 

							<option  value="  #FFCC00">Gold</option>

							<option value=""> -- Custom -- </option>

							<script>addColors(1);</script>

						</select>
						         
                                  
                                    </div>
                                    <span style="font-family: arial, verdana, helvetica; font-size: 11px; font-weight: bold;  color:#000000;"></span>
                                   
                                    <div id= "inputField"  >
                                        <input class="form-control" type="text" id="artisttitle" value=" " style=" width:410px;" placeholder="Artist Name"/>
                                         
                                  
                                    </div>
                                      <p>
                                  <span style="font-family: arial, verdana, helvetica; font-size: 11px; font-weight: bold;  color:#000000;"></span>
                                          
                                   <div id= "inputField"  >
                                        <input class="form-control" type="url" id="artistURL" value=" " style=" width:410px;"  placeholder="Artist_url"/>
                                        </div> 
                                    <p>
                                  <span style="font-family: arial, verdana, helvetica; font-size: 11px; font-weight: bold;  color:#000000;"></span>
                                          
                                   <div id= "inputField"  >
                                        <input class="form-control" type="text" id="songTitle" value=" " style=" width:410px;" placeholder="Song Title:"/>
                                        </div>  <p>
                                              <span style="font-family: arial, verdana, helvetica; font-size: 11px; font-weight: bold;  color:#000000;"></span>
                                  
                                        <div id= "inputField"  >
                                        <input class="form-control" type="text" id="songImage" value=" " style=" width:410px;" placeholder="Somg Image:"/>
                                        
                                    </div> 
                                    
                                    <p> <span style="font-family: arial, verdana, helvetica; font-size: 11px; font-weight: bold;  color:#000000;"></span>
                                  
                                         <div id= "inputField"  >
                                        <input class="form-control" type="url" id="songFile" value=" " style=" width:410px;"  placeholder="Song URL:"/>
                                        
                                    </div> 
                                     
                                    <p> <span style="font-family: arial, verdana, helvetica; font-size: 11px; font-weight: bold;  color:#000000;"></span>
                                  
                                         <div id= "inputField"  >
                                        <input class="form-control" type="url" id="yout" value="https://www.youtube.com/embed/RtAjkAOGGqg?si=QjsyYpwnsSdTNtK6" style=" width:410px;"  placeholder="Youtube URL:"/>
                                        
                                    </div>
                                    
                                    <p><span style="font-family: arial, verdana, helvetica; font-size: 11px; font-weight: bold;  color:#000000;"></span>
                                  
                                        <div id= "inputField"  >
                                         <textarea class="form-control" id="text4" rows="1" style=" width:410px;"  placeholder="Song Description:"></textarea>
                                        </div>
                                   
                                    
                                  
                <p><span style="font-family: arial, verdana, helvetica; font-size: 11px; font-weight: bold;  color:#000000;"></span>
                                  
                                        <div id= "inputField"  >
                                         <textarea class="form-control" id="text5" rows="1" style=" width:410px;" placeholder="Artist Description:"></textarea>
                                        </div>
                                    </div>
                 
    
    
    
    
    
    </div>
  </div></center>
    <div id="list4" role="tabpanel" aria-labelledby="list4-tab" class="tab-pane">
    <div class="info">
        <P>list4-tab</P>
                                 
   
   
   
    <button class="btn btn-default"type="button" name="" value=""style="font-family: arial, verdana, helvetica; font-size: 10px;width:140px;" onclick="Buildhtml5(form,9);return false;">gallery Image-</button>
 
                                    
                                    <div id= "inputField"  >
                                 
                                 <span style="font-family: arial, verdana, helvetica; font-size: 11px; font-weight: bold;  color:#000000;">Title:</span>
                                    <P>
                                    <input class="form-control" type="text" id="videotitle" value="" style=" width:310px;"/>
                                        </div><P>
                                       

                                  <div id= "inputField"  >

                                    <span style="font-family: arial, verdana, helvetica; font-size: 11px; font-weight: bold;  color:#000000;">Gallery Image</span>
                                    <BR>
                                    <input class="form-control" type="text" name="html5player_poster" value="" size="45"style=" width:310px;" /><P>
                                    </div>
                                         
       
       
       
       
       
     </div>
  </div>
</div>
                
                
                
            </main>
        </div>
    </div>
              
       
              
        <div id="gridlist" class="panel panel-default" style="Z-INDEX: 22; POSITION: absolute;   OVERFLOW-Y: auto; OVERFLOW-X: hidden; display:none; TOP:75px; LEFT: 200px;width:500px;" >
        <div class="panel-heading" >
            <div id="" style="position: absolute; LEFT:458px; TOP: 1px;  Z-INDEX: 0;">
            <button type="button" class="btn btn-default" id="g5" data-toggle="tooltip" title="Close " onClick="hideGridList();return false;">
                <i class="fa  fa-plus-square"></i>
            </button> 
            
            
            </div>
            GridList
                </div><br>
        <button class="btn btn-default"type="button" name="" value=""  size="33"  style="font-family: arial, verdana, helvetica; font-size: 10px;width:90px;" onclick="Buildhtml5(form,8);return false;">Insert Product</button>
  <button class="btn btn-default"type="button" name="" value=""  size="33"  style="font-family: arial, verdana, helvetica; font-size: 10px;width:90px;" onclick="Buildhtml5(form,14);return false;">Insert GridList</button>
 

   <button class="btn btn-default"type="button" name="" value=""   size="33" style="font-family: arial, verdana, helvetica; font-size: 10px;width:115px;" onclick="Buildhtml(form,5);return false;">Insert Product Page</button>
       <button class="btn btn-default"type="button" name="" value=""  size="23"  style="font-family: arial, verdana, helvetica; font-size: 10px;width:90px;" onclick="Buildhtml5(form,18);return false;">Cart Product</button>
   <button class="btn btn-default"type="button" name="" value=""  size="23"  style="font-family: arial, verdana, helvetica; font-size: 10px;width:90px;" onclick="Buildhtml5(form,20);return false;">Insert Shop</button>

<P></P><button class="btn btn-default"type="button" name="" value=""  size="23"  style="font-family: arial, verdana, helvetica; font-size: 10px;width:100px;" onclick="Buildhtml5(form,21);return false;">Insert  Product 2</button>
<button class="btn btn-default"type="button" name="" value=""  size="23"  style="font-family: arial, verdana, helvetica; font-size: 10px;width:100px;" onclick="Buildhtml5(form,22);return false;">Product header</button>


        <div id="" style="position: absolute; LEFT:552px; TOP: 3px;  Z-INDEX: 0;">
           </div>

        <div class="panel-body" id="g">
                         <span style="font-family: arial, verdana, helvetica; font-size: 11px; font-weight: bold;  color:#000000;">Paypal Email:</span>
                                    <P>
                                    <div id= "inputField"  >
                                        <input class="form-control" type="email" id="paypal-email" value=" " style=" width:310px;"/>
                                        
                                    </div> 
              <span style="font-family: arial, verdana, helvetica; font-size: 11px; font-weight: bold;  color:#000000;">Product Price:</span>
                                    <P>
                                    <div id= ""  >
                                        <input class="form-control" type="text" id="product-price" value=" " style=" width:310px;"/>
                                        
                                    </div> 
                
               
               
          <span style="font-family: arial, verdana, helvetica; font-size: 11px; font-weight: bold;  color:#000000;"> Product-Image:</span>
                                    <P>
                                    <div id= "inputField"  >
                                        <input class="form-control" type="text" id="product-image" value="" style=" width:310px;"/>
                                        
                                    </div> 
              
              
                                    <span style="font-family: arial, verdana, helvetica; font-size: 11px; font-weight: bold;  color:#000000;">Header:</span>
                                    <P>
                                    <div id= "inputField"  >
                                        <input class="form-control" type="text" id="text-header" value="Feature Label " style=" width:310px;"/>
                                        
                                    </div> 
                                       
                                   
                                    
                                    <span style="font-family: arial, verdana, helvetica; font-size: 11px; font-weight: bold;  color:#000000;">More-info Text:</span>
                                    <P>
                                    <div id= "inputField"  >
                                        <input class="form-control" type="text" id="more-info" value=" More Info" style=" width:310px;"/>
                                        
                                    </div> 
              
              
                                    <span style="font-family: arial, verdana, helvetica; font-size: 11px; font-weight: bold;  color:#000000;">More-info URL:</span>
                                    <P>
                                    <div id= "inputField"  >
                                        <input class="form-control" type="url" id="info-url" value=" " style=" width:310px;"/>
                                        
                                    </div>      
                                    <span style="font-family: arial, verdana, helvetica; font-size: 11px; font-weight: bold;  color:#000000;">Buy Now!  Text:</span>
                                    <P>
                                    <div id= "inputField"  >
                                        <input class="form-control" type="text" id="buy" value="Buy Now! " style=" width:310px;"/>
                                        
                                    </div> 
              
                                      <span style="font-family: arial, verdana, helvetica; font-size: 11px; font-weight: bold;  color:#000000;">Description:</span> 
                                 <P>
    <textarea class="form-control" rows="3" cols="30" name="" value="" id="product-text" style=" Z-INDEX: 0; OVERFLOW-Y: auto; OVERFLOW-X: hidden; width:370px;">
                                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                                </textarea>             
                                    
                                    
                                    </div> 
              
              
              
               </div>
    </div>             
              
              
              
              
              
           <div id="add-social-media" class="panel panel-default" style="Z-INDEX: 22; POSITION: absolute; OVERFLOW-Y: auto; OVERFLOW-X: hidden; display:none; TOP:75px; LEFT: 100px;width:340px;" >
            <div class="panel-heading" >
                <IMG border=0   src="HTML5_Logo_32.png" >Contact  & Social media Info
                    </div>
            
            <div id="" style="position: absolute; LEFT:295px; TOP: 3px;  Z-INDEX: 0;">
                
                <button type="button" class="btn btn-default" data-toggle="tooltip" title="Close " onClick="hideSocialMedia();return false;">
                    <i class="fa  fa-plus-square"></i>
                </button></div>

            <div class="panel-body" id="g">
                
              
                                    <span style="font-family: arial, verdana, helvetica; font-size: 11px; font-weight: bold;  color:#000000;">Add Facebook:</span>
                                    <P>
                                    <div id= "inputField"  >
                                        <input class="form-control" type="text" id="facebook" value="https://facebook.com/ " style=" width:310px;"/>
                                        
                                    </div> 
              
               <div id= "inputField"  >
                                        <input class="form-control" type="text" id="linkedin" value="https://www.linkedin.com/" style=" width:310px;"/>
                                        
                                    </div>
                                    <span style="font-family: arial, verdana, helvetica; font-size: 11px; font-weight: bold;  color:#000000;">Add Twitter-x:</span>
                                    <P>
                                    <div id= "inputField"  >
                                        <input class="form-control" type="text" id="twitter" value="https://www.twitter.com/ " style=" width:310px;"/>
                                        
                                    </div> 
                                      <span style="font-family: arial, verdana, helvetica; font-size: 11px; font-weight: bold;  color:#000000;">Add Instagram:</span>
                                    <P>
                                    <div id= "inputField"  >
                                        <input class="form-control" type="text" id="instagram" value="https://www.instagram.com/ " style=" width:310px;"/>
                                        
                                    </div> 
              
              
                                    <span style="font-family: arial, verdana, helvetica; font-size: 11px; font-weight: bold;  color:#000000;">Add Youtube:</span>
                                    <P>
                                   
                                    <div id= "inputField"  >
                                        <input class="form-control" type="text" id="youtube" value="https://youtube.com/" style=" width:310px;"/>
                                        
                                    </div>
               <div id= "inputField"  >
                                        <input class="form-control" type="text" id="phone" value="" style=" width:310px;"/>
                                        
                                    </div>
                                    
                                 <div id= "inputField"  >
                                        <input class="form-control" type="text" id="email" value="" style=" width:310px;"/>
                                        
                                    </div> <div id= "inputField"  >
                                        <input class="form-control" type="text" id="address" value="" style=" width:310px;"/>
                                        
                                    </div>
                                    
               </div>
    </div>  
        
	   
	   
           
              
        <div id="menulist" class="panel panel-default" style="Z-INDEX: 22; POSITION: absolute;   OVERFLOW-Y: auto; OVERFLOW-X: hidden; display:none; TOP:75px; LEFT: 300px;width:280px;" >
        <div class="panel-heading" >
            <div id="" style="position: absolute; LEFT:230px; TOP: 5px;  Z-INDEX: 0;">
            <button type="button" class="btn btn-default" id="g5" data-toggle="tooltip" title="Close " onClick="hideMenuList();return false;">
                <i class="fa  fa-plus-square"></i>
            </button> 
            </div>
            <IMG border=0   src="HTML5_Logo_32.png" > Page Title/Menu Header
                </div>
        
        <div id="" style="position: absolute; LEFT:552px; TOP: 3px;  Z-INDEX: 0;">
           </div>

        <div class="panel-body" id="g"> 
        <div  id="scroll"  style="width:250px;height:410px;background-color:#fff;  overflow:scroll"    align="rihgt" >
           <span style="font-family: arial, verdana, helvetica; font-size: 11px; font-weight: bold;  color:#000000;">Page Title:</span>
                                    <P>
                                    <div id= "inputField"  >
                                        <input class="form-control" type="text" id="page-title" value="New Page" style=" width:310px;"/>
                                        
                                    </div> 
               <span style="font-family: arial, verdana, helvetica; font-size: 11px; font-weight: bold;  color:#000000;">Page Icon Image:</span>
                                    <P>
                                    <div id= "inputField"  >
                                        <input class="form-control" type="text" id="site-ico" value="https://smtvs.com/index-img/android-chrome-512x512.png" style=" width:310px;"/>
                                        
                                    </div> 
       
           <span style="font-family: arial, verdana, helvetica; font-size: 11px; font-weight: bold;  color:#000000;">Logo Image:</span>
                                    <P>
                                    <div id= "inputField"  >
                                        <input class="form-control" type="text" id="page-logo" value="https://vga.smtvs.com/dark-gold/images/logo-image.jpg" style=" width:310px;"/>
                                        
                                    </div> 
              
              
                                    <span style="font-family: arial, verdana, helvetica; font-size: 11px; font-weight: bold;  color:#000000;">Logo URL:</span>
                                    <P>
                                    <div id= "inputField"  >
                                        <input class="form-control" type="text" id="logo-url" value="https://vga.smtvs.com/" style=" width:310px;"/>
                                        
                                    </div> 
          
          
          
            <span style="font-family: arial, verdana, helvetica; font-size: 11px; font-weight: bold;  color:#000000;">Home Menu:</span>
                                    <P>
                                    <div id= "inputField"  >
                                        <input class="form-control" type="text" id="menu-text" value="Home " style=" width:310px;"/>
                                        
                                    </div> 
              
              
                                    <span style="font-family: arial, verdana, helvetica; font-size: 11px; font-weight: bold;  color:#000000;">Home Menu URL:</span>
                                    <P>
                                    <div id= "inputField"  >
                                        <input class="form-control" type="text" id="menu-url" value=" " style=" width:310px;"/>
                                        
                                    </div> 
          
          
          
          
          <span style="font-family: arial, verdana, helvetica; font-size: 11px; font-weight: bold;  color:#000000;"> Menu Text 2:</span>
                                    <P>
                                    <div id= "inputField"  >
                                        <input class="form-control" type="text" id="menu-text2" value="Channels " style=" width:310px;"/>
                                        
                                    </div> 
              
              
                                    <span style="font-family: arial, verdana, helvetica; font-size: 11px; font-weight: bold;  color:#000000;">Menu URL 2:</span>
                                    <P>
                                    <div id= "inputField"  >
                                        <input class="form-control" type="text" id="menu-url2" value=" " style=" width:310px;"/>
                                        
                                    </div> 
                                    
                                    
                                    
                                    
                                  <span style="font-family: arial, verdana, helvetica; font-size: 11px; font-weight: bold;  color:#000000;">Menu  Text 3 :</span>
                                    <P>
                                    <div id= "inputField"  >
                                        <input class="form-control" type="text" id="menu-text3" value="Dashboard" style=" width:310px;"/>
                                        
                                    </div> 
              
              
                                    <span style="font-family: arial, verdana, helvetica; font-size: 11px; font-weight: bold;  color:#000000;">Menu URL 3:</span>
                                    <P>
                                    <div id= "inputField"  >
                                        <input class="form-control" type="text" id="menu-url3" value=" " style=" width:310px;"/>
                                        
                                    </div>   
                                    
                                    
                                      
                                  <span style="font-family: arial, verdana, helvetica; font-size: 11px; font-weight: bold;  color:#000000;">Menu  Text 4 :</span>
                                    <P>
                                    <div id= "inputField"  >
                                        <input class="form-control" type="text" id="menu-text4" value="Upload " style=" width:310px;"/>
                                        
                                    </div> 
              
              
                                    <span style="font-family: arial, verdana, helvetica; font-size: 11px; font-weight: bold;  color:#000000;">Menu URL 4:</span>
                                    <P>
                                    <div id= "inputField"  >
                                        <input class="form-control" type="text" id="menu-url4" value=" " style=" width:310px;"/>
                                        
                                    </div>   
                                    
                                    
                                      
                                  <span style="font-family: arial, verdana, helvetica; font-size: 11px; font-weight: bold;  color:#000000;">Menu  Text 5 :</span>
                                    <P>
                                    <div id= "inputField"  >
                                        <input class="form-control" type="text" id="menu-text5" value=" Profile" style=" width:310px;"/>
                                        
                                    </div> 
              
              
                                    <span style="font-family: arial, verdana, helvetica; font-size: 11px; font-weight: bold;  color:#000000;">Menu URL 5:</span>
                                    <P>
                                    <div id= "inputField"  >
                                        <input class="form-control" type="text" id="menu-url5" value=" " style=" width:310px;"/>
                                        
                                    </div>   
                                    
                                      
                                  <span style="font-family: arial, verdana, helvetica; font-size: 11px; font-weight: bold;  color:#000000;">Menu  Text 6 :</span>
                                    <P>
                                    <div id= "inputField"  >
                                        <input class="form-control" type="text" id="menu-text6" value="Setting " style=" width:310px;"/>
                                        
                                    </div> 
              
              
                                    <span style="font-family: arial, verdana, helvetica; font-size: 11px; font-weight: bold;  color:#000000;">Menu URL 6:</span>
                                    <P>
                                    <div id= "inputField"  >
                                        <input class="form-control" type="text" id="menu-url6" value=" " style=" width:310px;"/>
                                        
                                    </div>   
                                 
                                 <span style="font-family: arial, verdana, helvetica; font-size: 11px; font-weight: bold;  color:#000000;">Menu  Text 7 :</span>
                                    <P>
                                    <div id= "inputField"  >
                                        <input class="form-control" type="text" id="menu-text7" value="About Us " style=" width:310px;"/>
                                        
                                    </div> 
              
              
                                    <span style="font-family: arial, verdana, helvetica; font-size: 11px; font-weight: bold;  color:#000000;">Menu URL 7:</span>
                                    <P>
                                    <div id= "inputField"  >
                                        <input class="form-control" type="text" id="menu-url7" value=" " style=" width:310px;"/>
                                        
                                    </div>   
                               
                                  <span style="font-family: arial, verdana, helvetica; font-size: 11px; font-weight: bold;  color:#000000;">Menu  Text 8 :</span>
                                    <P>
                                    <div id= "inputField"  >
                                        <input class="form-control" type="text" id="menu-text8" value="Terms of service " style=" width:310px;"/>
                                        
                                    </div> 
              
              
                                    <span style="font-family: arial, verdana, helvetica; font-size: 11px; font-weight: bold;  color:#000000;">Menu URL 8:</span>
                                    <P>
                                    <div id= "inputField"  >
                                        <input class="form-control" type="text" id="menu-url8" value=" " style=" width:310px;"/>
                                        
                                    </div>   
                                           
                                    <span style="font-family: arial, verdana, helvetica; font-size: 11px; font-weight: bold;  color:#000000;">Menu  Text 9 :</span>
                                    <P>
                                    <div id= "inputField"  >
                                        <input class="form-control" type="text" id="menu-text9" value="Help" style=" width:310px;"/>
                                        
                                    </div> 
              
              
                                    <span style="font-family: arial, verdana, helvetica; font-size: 11px; font-weight: bold;  color:#000000;">Menu URL 9:</span>
                                    <P>
                                    <div id= "inputField"  >
                                        <input class="form-control" type="text" id="menu-url9" value=" " style=" width:310px;"/>
                                        
                                    </div>  
                                 
                   
                   <br><P></P>
                   
                    </div>            
          
       </div>    
        </div>    
        
     
           <div id="gridlist" class="panel panel-default" style="Z-INDEX: 22; POSITION: absolute;   OVERFLOW-Y: auto; OVERFLOW-X: hidden; display:none; TOP:75px; LEFT: 400px;width:400px;" >
        <div class="panel-heading" >
            <div id="" style="position: absolute; LEFT:355px; TOP: 5px;  Z-INDEX: 0;">
            <button type="button" class="btn btn-default" id="g5" data-toggle="tooltip" title="Close " onClick="hideGridList();return false;">
                <i class="fa  fa-plus-square"></i>
            </button> 
            
            
            </div>
            <IMG border=0   src="HTML5_Logo_32.png" > GridList
                </div>
               
        
     

           
  </form>          
           
           
           
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('app-sidebar');
        const collapseBtn = document.getElementById('sidebar-collapse-btn');
        const mobileOpenBtn = document.getElementById('mobile-menu-open-btn');
        const isCollapsedKey = 'sidebarIsCollapsed';

        if (collapseBtn && sidebar) {
            if (localStorage.getItem(isCollapsedKey) === 'true') sidebar.classList.add('is-collapsed');
            collapseBtn.addEventListener('click', (e) => {
                e.preventDefault();
                sidebar.classList.toggle('is-collapsed');
                localStorage.setItem(isCollapsedKey, sidebar.classList.contains('is-collapsed'));
            });
        }
        
        if (mobileOpenBtn && sidebar) {
            mobileOpenBtn.addEventListener('click', () => {
                sidebar.classList.add('is-open');
                mobileOpenBtn.setAttribute('aria-expanded', 'true');
                const overlay = document.createElement('div');
                overlay.className = 'sidebar-overlay';
                document.body.appendChild(overlay);
                overlay.addEventListener('click', closeMobileMenu);
            });
        }
        
        function closeMobileMenu() {
            sidebar.classList.remove('is-open');
            mobileOpenBtn.setAttribute('aria-expanded', 'false');
            const overlay = document.querySelector('.sidebar-overlay');
            if (overlay) overlay.remove();
        }
    });
    </script>
</body>
</html>
