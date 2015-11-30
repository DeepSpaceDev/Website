<dom-module id="login-register">

	<template>
		
		<style>
			paper-material {
				display: block;
				margin: 15px auto;
				padding: 15px 40px 25px 40px;
				background-color: white;
				border-radius: 2px;
				vertical-align: center;
				max-width: 900px;				
			}
			
			paper-input {
				margin-top: -10px;
			}
			
			.g-recaptcha {
				float: left;
			}
			
			.error{
				--paper-input-container-color: red;
			}
						
			#regpagecard {
				display: none;
			}
			
			#reggooglecard {
				padding-top: 25px; 
			}
			
			#regvia {
				padding-top: 10px;
			}
			
			#pw {
				width: 48%; 
				float: left;
			}
			
			#pwrepeat {
				width: 48%; 
				float: right;
			}			
			
			#submitbutton {
				background-color: var(--paper-indigo-500);
				color: #ffffff;
			}
			
			@media all and (min-width: 775px){
				.g-recaptcha {
					float: right;
					margin-top: -90px;
				}
			}
			
		</style>

		<section>
			<paper-material id="regvia">
					<h3>Register on Sese7.de via:</h3>
					<paper-radio-group id="regmethod" selected="{{meth}}">
						<paper-radio-button id="reggoogle" name="g">Google</paper-radio-button>
						<paper-radio-button id="regweb" name="w">Website</paper-radio-button>
					</paper-radio-group>
			</paper-material>

			<paper-material id="reggooglecard">
				<google-signin client-id="222483067566-rg4ki08ppvj2vplqshohb6tp7tvq8rl4.apps.googleusercontent.com" scopes="https://www.googleapis.com/auth/drive" disabled></google-signin>
			</paper-material>

			<div id="regpagecard">
				<form action="" onSubmit="handleRegisterRequest(this); return false;" method="POST" id="regform">
					<paper-material id="general">
						<div id="regwebheader">
							<h2>General Information</h2>
							More specific account options located in settings.<br /><br />
						</div>
						<div id="regcaptcha" class="g-recaptcha" onLoad="$.getScript('https://www.google.com/recaptcha/api.js');" data-sitekey="6LdbGBITAAAAAM4qXAXdW7QnCFAJL-Wm-w2Lj3yn"></div>
						<paper-input id="mail" name="mail" label="Mail"></paper-input>
						<paper-input id="pw" name="pw" type="password" label="Password"></paper-input>
						<paper-input id="pwrepeat" name="pwrepeat" type="password" label="Repeat password"></paper-input>
						<br />
						<div style="width: 100%; text-align: right; margin-top: 50px;">
							<paper-button onClick="subform();" id="submitbutton" elevation="2" raised>Submit</paper-button>
						</div>
					</paper-material>
				</form>
			</div>
		</section>

	</template>

	<script>
		Polymer({
			is: 'login-register',

			properties: {
				meth: {
					type: String,
					value: 'w'
				}
			},
			
			listeners: {
				'regmethod.paper-radio-group-changed' : 'webRegChange'
			},
			
			webRegChange: function(e){
				switch(document.querySelector('#regmethod').selectedItem.id){
					case "regweb":  regcardswitch("w", true); break;
					case "reggoogle": regcardswitch("g", true); break;
				}
			},
			
			ready: function(){
			
				if(this.get("meth") == "w"){
					regcardswitch("w", false);
				}				
			}

		});
		
		function regcardswitch(card, internal){
			if(card == "w"){
				$("#regpagecard").slideDown(); $("#reggooglecard").slideUp(); 
				if(internal){href("/register/w", "nochange");}
				$.getScript( "https://www.google.com/recaptcha/api.js");
			}
			else if(card == "g"){
				$("#regpagecard").slideUp(); $("#reggooglecard").slideDown();
				if(internal){href("/register/g", "nochange");}
			}
		}
		function handleRegisterRequest(form){	
			registerResetErrors();
			var result = $.ajax({
				type: "POST",
				url: "scripts/login/register.php",
				data: $(form).serialize(),
				async: false
			}).responseText.split("~");
			var toastl = "";
			var showtoast = false;
			for(i = 0; i < result.length; i++){
				if(result[i] == "recaptcha"){
					toastl += "Please do the recaptcha! "; $(".g-recaptcha").css("border", "1px solid red"); showtoast = true;
				}
				else if(result[i] == "mail"){
					toastl += " Please input a valid mail!"; $("#mail").attr("invalid", true); showtoast = true;
				}
				else if(result[i] == "passwd"){
					toastl += " Your passwords are not matching!"; $("#pw").attr("invalid", true); $("#pwrepeat").val(""); showtoast = true;
				}
				else if(result[i] == "mailtaken"){
					toastl += " Your mail already was taken!"; $("#mail").attr("invalid", true); $("#mail").val(""); showtoast = true;
				}
				else if(result[i] == "true"){
					toastl += "A mail to verify your email has been sent."; href("login"); showtoast = true;
					form.reset();
				}
			}
			if(showtoast){toast(toastl, 10000, true);}
			grecaptcha.reset();
		}
		
		function registerResetErrors(){
			$(".g-recaptcha").css("border", "");
			$("#mail").removeAttr("invalid");
			$("#pw").removeAttr("invalid");
		}
		function subform(){
			$('#regform').submit();
		}
	</script>

</dom-module>