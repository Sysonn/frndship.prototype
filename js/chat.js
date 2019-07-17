var intervalID;
var urlMessage;

var loadChat = function(urlMessage){

	 var loadName = function(){
       $('#chat-box').load(urlMessage);
			/* $('#chat-box').scrollTop($('#chat-box').prop("scrollHeight"));*/

      	}

     intervalID = setInterval(loadName, 500); // makes it reload every 5 sec
	}
