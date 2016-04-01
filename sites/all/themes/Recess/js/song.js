/*
* 
*  RECESS JS – SONG JS
*  Recess Creative - @2014 UID 
*  
*/


	var mediaElement;
	var analyser;
	var context;
	var replaying = false;
	var isSafariDesktop = /Safari/.test(navigator.userAgent) && /Apple Computer/.test(navigator.vendor);

	var volume = 0;

	if (window.webkitAudioContext == undefined) {
	    // context = new AudioContext();
	} else {
	    context = new webkitAudioContext();
	    analyser = context.createAnalyser();
	}        

	if( canListen() )
	{
	    $('#can-listen').show();
	}

	var spacer = 1;
	var offset = 200;

	var ctxT;
	var ctxB;
	var canvasT;
	var canvasB;

	
	function initAudioEvents()
	{
	    if( $('audio').size() == 1 && isSafariDesktop == false ) // Ensure only 1 audio tag plays 
	    {
	        if( mediaElement == undefined || replaying == true )
	        {
	            mediaElement = document.getElementsByTagName("audio")[0];
	            mediaElement.currentTime = parseInt(document.getElementById("songPositionTime").value);
	            mediaElement.volume = 0.000001;
	            mediaElement.play();

	            mediaElement.addEventListener('timeupdate', function()
	                {
	                    if( mediaElement.currentTime >= (mediaElement.duration - 0.5) )
	                    {
	                        mediaElement.pause()

	                        setTimeout( function()
	                            {
	                                $.ajax(
	                                    {
	                                        url: "/sites/all/themes/recess/php/song.php",
	                                        type: "POST",
	                                        cache: false,
	                                        async: true,
	                                        data: { type : 'GET_LATEST' },
	                                        headers : { "cache-control": "no-cache" },
	                                        success: function(data)
	                                        {
	                                            replaying = true;

	                                            var split = data.trim().split("|||");

	                                            $('.track .track-name strong').text( split[2] );
	                                            $('.track .artist').text( split[3] );

	                                            $('input#songPositionTime').val( split[1] );

	                                            mediaElement.src = split[0];

	                                            mediaElement.play();
	                                            setTimeout( function(){
	                                                 $(mediaElement).animate({volume: volume}, 2000);
	                                             }, 1000);

	                                            // console.log("Load Song...");
	                                        }
	                                    }
	                                );
	                            },
	                            4000 
	                        );
	                    }
	                }, false
	            );

	            if( replaying == false && (window.webkitAudioContext != undefined) )
	            {
	                var source = context.createMediaElementSource(mediaElement);

	                source.connect(analyser);
	                analyser.connect(context.destination);

	                window.requestAnimationFrame(analyse);
	            }
	        }
	    }
	    else if( $('audio').size() > 1 ) // Remove additional audio tags
	    {
	        if( document.getElementsByTagName("audio")[1] != undefined )
	        {
	            document.getElementsByTagName("audio")[1].pause();
	            $($('audio')[1]).remove();
	        }
	    }
	}  


	$('section.tuneage').click( function()
	    {
	        if( mediaElement != undefined )
	        {
	            $(mediaElement).animate({volume: .5}, 1000);

	            volume = .5;

	            if( canVisualize() )
	            {
	                $('.wave-container p').remove();
	                $('.wave-container img').hide();
	                $('.wave-container').addClass('active');
	            }
	            else
	            {
	                $('.wave-container p').remove();
	            }

	            if( mediaElement.paused || $('#can-listen').hasClass('start') ) 
	            {
	                $('#can-listen').removeClass('play');
	                $('#can-listen').addClass('pause');

	                mediaElement.play();
	            }
	            else
	            {
	                $('#can-listen').removeClass('pause');
	                $('#can-listen').addClass('play');   

	                mediaElement.pause();
	            }  

	            $('#can-listen').removeClass('start'); 
	        }
	    }
	).css('cursor','pointer').hover( function()
	    {
	        if( canListen() && !$('#can-listen').hasClass('start') && mediaElement != undefined )
	        {
	            if( !mediaElement.paused )
	            {
	                $('#can-listen').removeClass('play');
	                $('#can-listen').addClass('pause');
	            }
	            else
	            {
	                $('#can-listen').removeClass('pause');
	                $('#can-listen').addClass('play');   
	            }    
	        }
	    },
	    function()
	    {
	        $('#can-listen').removeClass('play');
	        $('#can-listen').removeClass('pause');
	    }
	);


	function audioStalled()
	{
	    initAudioEvents();

	    if( isSafariDesktop == false )
	    {
		    mediaElement.load();
		    mediaElement.play();
		}
	}      

	setupCanvas();

	function setupCanvas() 
	{ 
	    canvasT = document.getElementById('canvas-top'); 
	    canvasB = document.getElementById('canvas-bot'); 
	    ctxT = canvasT.getContext('2d');
	    ctxB = canvasB.getContext('2d');
	    setup = true; 
	}

	var analyse = function() 
	{
	    window.requestAnimationFrame(analyse);

	    var num_bars = canvasT.width/spacer;

	    var data = new Uint8Array(analyser.frequencyBinCount);
	    analyser.getByteFrequencyData(data);

	    ctxT.clearRect(0, 0, canvasT.width, canvasT.height);
	    ctxB.clearRect(0, 0, canvasB.width, canvasB.height);

	    for (var i = 0; i < num_bars; ++i) {
	        var magnitude = data[i+offset] - canvasT.height;
	        ctxT.fillRect(i * spacer, canvasT.height+60, 1, -magnitude);
	        ctxT.fillStyle = "#f26663";

	        ctxB.fillRect(i * spacer, canvasB.height+60, 1, -magnitude);
	        ctxB.fillStyle = "#f26663";
	    }
	}


	function canListen()
	{
	    return (navigator.userAgent.toLowerCase().indexOf('chrome') > -1) ||
	           (navigator.userAgent.toLowerCase().indexOf('firefox') > -1) ||  
	           (!!navigator.userAgent.match(/Trident.*rv[ :]*11\./))
	}

	function canVisualize()
	{
	    return (navigator.userAgent.toLowerCase().indexOf('chrome') > -1);
	}



