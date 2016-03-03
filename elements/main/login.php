<dom-module id="login-login">

	<template>
		<style>
			paper-material {
				display: inline-block;
				padding: 15px 40px 25px 40px;
				background-color: white;
				border-radius: 2px;
				margin-left: -17px;
			}

			#loginpage {
				padding-top: 75px;
				vertical-align: center;
				width: 260px;
				height: 190px;
				margin-left: auto;
				margin-right: auto;
			}

			paper-input {
				width: 220px;
				margin-top: -10px;
			}

			#lbuttons {
				font-size: 14px;
				margin-top: 10px;
				float: right;
			}

			#login {
				background-color: var(--paper-indigo-500);
				color: #ffffff;
			}

		</style>

		<section>
			<div id="loginpage">
				<paper-material elevation="4">

					<form action="" id="loginform" method="POST" onSubmit="login(this); return false;">
					<paper-input id="user" name="user" type="text" onkeypress="keyevent(13, subloginform, event)" label="Username or e-mail" required></paper-input>
					<paper-input id="pw" name="pw" type="password" onkeypress="keyevent(13, subloginform, event)" label="Password" required></paper-input>

					<div id="lbuttons">
						<paper-button id="register" onClick="href('register');" elevation="2" raised noink>Register</paper-button>
						<paper-button id="login" elevation="2" onClick="login('#loginform');" raised>Login</paper-button>
					</div>
					</form>
				</paper-material>

				<span style="padding-top: 50px; color: #aaa;"><br /><br />Unfortunately all our databases were delted. Please register again. We apologize for the circumstances.</span>

			</div>
		</section>

	</template>

	<script>
		Polymer({
			is: "login-login",

			behaviors: [
			    Polymer.IronA11yKeysBehavior
		    ],

			properties: {
			},

			keyBindings: {
				'enter': '_login'
			},

			_login: function(event) {
				var form = document.querySelector('#loginform');
				login(form);
			}

		});
		
		function login(form){
			loginResetErrors();		
			var result = $.ajax({
				type: "POST",
				url: "scripts/login/login.php",
				data: $(form).serialize(),
				async: false
			}).responseText;
			var toastl = "";
			var showtoast = false;
			var okbutton = true;
			
			if(result == "falsemail"){
				toastl += "Your user was not registered."; $("#user").attr("invalid", true); showtoast = true;
			}
			else if(result == "falsepw"){
				toastl += "False password! <span class='link' style='color: #FF9800; float: right; margin-left: 10px;' onClick='document.querySelector(\"#toast\").hide(); href(\"login/pwreset\");'>Reset password</span>"; 
				$("#pw").attr("invalid"); 
				okbutton = false; 
				showtoast = true;
			}
			else if(result == "true"){
				href("https://deepspace.onl/settings");
			}
			else{
				toastl = "Something went wrong please contact the webmaster"
				showtoast = true;
			}

			if(showtoast){toast(toastl, 5000, okbutton);}
		}
		
		function loginResetErrors(){
			$("#user").removeAttr("invalid");
			$("#pw").removeAttr("invalid");
		}
	</script>

</dom-module>