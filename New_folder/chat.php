<!DOCTYPE  html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Group</title>
		
		<!-- STYLE -->
		
		<style type="text/css">
		     ul {
                    list-style-type:none;
                    padding: 0px;
		     }
		     .mess_head {
                    color: #a8a8a8;
		     }
		     .mess_bod {
                    padding-left: 20px;
		     }
			body {
				font-family: helvetica;
				max-width: 1333px;
			}
			.mess {
                    height:45px;
                    width:45px;
                    background-color:black;
			}
			li {
				list-style: none;
			}
			.chat {
				width: 750px;
				height: 400px;
			}			
			.chat-lobby {
				width: 400px;
				height:inherit;
				background:#F3F3F3;
			}
			.chat-caption {
				position:relative;
				top: 10px;
				left:10px;
			}
			.show_content {
				position:relative;
				background:#FFFFFF;
				width:230px;
				height:50px;
			}
			.alphabetic {
				position:absolute;
				font-size:9px;
				top:30px;
				left:300px;
				width:20px;
				height:inherit;				
			}
			.chat-table {
				position:absolute;
				top:16px;
				left:405px;
				width: 350px;
				height:inherit;
				background:#F3F3F3;
			}
			.person {
				position:relative;
				background:#a8a8a8;
				width:inherit;
				height:50px;
			}
			#display_mess{
				position:relative;
				width:330px;
				height:245px;
				max-height: 245px;
				overflow: auto;
			}
			.message {
				position:inherit;
				background:#F3F3F3;				
				width:300px;
				height:46px;
			}
			.message-content {
				position:inherit;
				border-radius: 5px 5px 5px 5px;
				background:#FFFFFF;			
				height:35px;
				width:280px;
			}
			.my-message {
				position:relative;
				width:345px;
				height:50px;
				font-size:36px;
			}
			hr {
				height:5px;
				background:#FFA500;
			}
			table {
				width: 100%;
			}
			tr {
				padding: 5px;
			}
		</style>
		<script src="/js_files/jquery.js" type="text/javascript">
    </script>
    <script src="/js_files/livequery/jquery.livequery.min.js" type="text/javascript"></script>
    <script src="/js_files/chat.js" type="text/javascript">
		</script>
	</head>
	
	<body>
		<div class="chat">
			<div class="chat-lobby">
				<div class="chat-caption">
					<p>Chat Lobby</p>
				</div>
				<div>
					<ul id="friend_list">
						
					</ul>
				</div>
				
			</div>
			<div class="chat-table">
				<div class="person">
				<img id="chat_pic" class="mess" src="" />
					<span id="chat_name">Stephanie</span>
                         <span id="close">x</span>
				</div>
				<ul id="display_mess">
						
				</ul>
				<div id="mess_text">
					
				</div>
			</div>
		</div>
	</body>
</html>
