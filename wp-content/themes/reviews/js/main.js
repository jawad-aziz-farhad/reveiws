
(function($) {    
    $(document).ready(function(){
        console.log('Main-JS is Ready.')
        fileSelection(); 
    }); 

    function fileSelection(){
        $('input[type="file"]').change(function(e){
            var fileName = e.target.files[0].name;
            var imageId = $(this).attr('imageNum');
            
            if(imageId > -1){

                if(['jpg', 'png', 'jpeg'].indexOf(fileName) === -1){
                    window.alert('Please select image.');
                    return;
                }

                if (e.target.files && e.target.files[0]) {
                    var reader = new FileReader();		        
                    reader.onload = function (e) {
                        $('#image-'+ imageId).attr('src', e.target.result);
                    }
                    reader.readAsDataURL(e.target.files[0]);                
                }
            }
            
            else {
            
                if(['ogg', 'h264', 'webm', 'hls', 'vp9'].indexOf(fileName) === -1){
                    window.alert('Please select a video.');
                    return;
                }
                if (e.target.files && e.target.files[0]) {
                    var reader = new FileReader();		        
                    reader.onload = function (e) {
                      $('#reviewVideo').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(e.target.files[0]);                
                }

            }
        });
    }

    function supportsVideoType(video , type) {
        // Allow user to create shortcuts, i.e. just "webm"
        let formats = {
          ogg: 'video/ogg; codecs="theora"',
          h264: 'video/mp4; codecs="avc1.42E01E"',
          webm: 'video/webm; codecs="vp8, vorbis"',
          vp9: 'video/webm; codecs="vp9"',
          hls: 'application/x-mpegURL; codecs="avc1.42E01E"'
        };
      
        return video.canPlayType(formats[type] || type);
      }
    
})(jQuery);