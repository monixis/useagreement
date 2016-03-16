/**
 * @author Monish.Singh1
 */
$(document).ready(function() {
	var requestsCnt = 0;
    $("#buttonAdd-request").click(function(){
    	requestsCnt = requestsCnt + 1;
    	var request_input = "request_input" + requestsCnt + "";
    	
    	var requests = "<div id=" + request_input + " style='border-bottom: 1px solid; padding: 10px;'><label class='label' for='collection'>Collection:</label><br/><input type='text' id='request_collection' class='textinput'/><label class='label' for='boxno'>Box Number:</label><br/><input type='text' id='request_boxno' class='textinput'/><label class='label' for='itemno'>Item Numbers:</label><br/><input type='text' id='request_itemno' class='textinput'/><label class='label' for='dpi'>Requested Resolution (dpi):</label><br/><input type='checkbox' name='request_dpi' value='72' class='checkbox'>72</input><input type='checkbox' name='request_dpi' value='300' class='checkbox'>300</input><input type='checkbox' name='request_dpi' value='600' class='checkbox'>600</input><input type='checkbox' name='request_dpi' value='1200' class='checkbox'>1200</input><br/><br/><label class='label' for='format'>Requested File Format:</label><br/><input type='checkbox' name='request_format' value='pdf' class='checkbox'>PDF</input><input type='checkbox' name='request_format' value='jpeg' class='checkbox'>JPEG</input><input type='checkbox' name='request_format' value='tiff' class='checkbox'>TIFF</input><br/><br/><label class='label' for='avformat'>Audio/Video File Format:</label><br/><input type='checkbox' name='request_avformat' value='wav' class='checkbox'>WAV</input><input type='checkbox' name='request_avformat' value='mp3' class='checkbox'>MP3</input><input type='checkbox' name='request_avformat' value='mpeg' class='checkbox'>MPEG</input><input type='checkbox' name='request_avformat' value='hd' class='checkbox'>HD</input><br/><br/><label class='label' for='desc'>Description of Use (Provided by the researcher):</label><br/><textarea id='request_desc' rows='4' cols='4'/></textarea></div><!-- request_input0 -->"
    	
    	$('div#formcontents').append(requests);
    	
    });
    
 });