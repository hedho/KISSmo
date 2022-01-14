<!------ monaco has been here tweaking and coding this ---->
<!------  This is the oddprotocol.org team             ---->
<!------ You heard about us!                           ---->
<!------ It's running under BSD/ODDPROTCOL License     ---->
<!------ 1. Search for "$email_to =" and change!       ---->
<!------ 2. Search for "$email_from =" and change it!  ---->
<!------ 1. Is where you wanna recieve you're messages ---->
<!------ 2. Is what email you wanna recieve mails as   ---->

<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact KISSmo!</title>
	<style>
		body {
			background: whitesmoke;
			font-family: monospace;
		}
		span.error {
			display: block;
			padding: 5px;
			background: red;
			color: white;
		}
		span.hidden {
			visibility: hidden;
			padding: 0;
			margin: 0;
		}
		span.success {
			display: block;
			padding: 5px;
			background: green;
			color: white;
		}
		span.success.hidden {
			visibility: hidden;
			padding: 0;
			margin: 0;
		}
	</style>
</head>

<body>
	<section id="contact">
		<div>
			<div>

				<div>
					<h2>Contact KISSmo</h2>
					<?php
						// define variables and set to empty values				
						$name = $email = $inquiry = $email_message = "";
						$submitted = 0;

						if ($_SERVER["REQUEST_METHOD"] == "POST") {
						   if (empty($_POST["name"])) {
							 $nameErr = "Name is required";
						   } else {
							 $name = clean_data($_POST["name"]);
							 $fill["name"] = $name;
							 // check if name only contains letters and whitespace
							 if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
							   $nameErr = "Only letters and white space allowed"; 
							 }
						   }
						   
						   if (empty($_POST["email"])) {
							 $emailErr = "Email is required";
						   } else {
							 $email = clean_data($_POST["email"]);
							 $fill["email"] = $email;
							 // check if e-mail address is well-formed
							 if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
							   $emailErr = "Invalid email format"; 
							 }
						   }
							 
						   if (empty($_POST["inquiry"])) {
							 $inquiryErr = "You Cannot Submit an Empty Inquiry";
						   } else {
							 $inquiry = clean_data($_POST["inquiry"]);
							 $fill["inquiry"] = $inquiry;
						   }
						}

						function clean_data($data) {
							// Strip whitespace (or other characters) from the beginning and end of string
							$data = trim($data);
							// Un-quotes quoted string
							$data = stripslashes($data);
							// Convert special characters to HTML entities
							$data = htmlspecialchars($data);
							return $data;
						}
						// Send email if no errors
						if (isset($fill)) {
							if (empty($nameErr) && empty($emailErr) && empty($inquiryErr)) {
								// Inquiry sent from address below
								$email_from = "contact@paste.oddprotocol.org";
								
								// Send form contents to address below
								$email_to = "support@paste.oddprotocol.org";
								
								// Email message subject
								$today = date("j F, Y. H:i:s");
								$email_subject = "Contact from KISSmo [$today]";
								
								function clean_string($string) {

									$bad = array("content-type","bcc:","to:","cc:","href");

									return str_replace($bad,"",$string);

								}

								$email_message .= "Username: ".clean_string($name)."\n";

								$email_message .= "Email: ".clean_string($email)."\n";


								$email_message .= "Message: ".clean_string($inquiry)."\n";
								
								// create email headers
								$headers = 'From: '.$email_from."\r\n".
								 
								'Reply-To: '.$email_from."\r\n" .
								 
								'X-Mailer: PHP/' . phpversion();
								 
								@mail($email_to, $email_subject, $email_message, $headers);
								
								$submitted = 1;
							}
						}
					?>
					<div>
						<form name="contactus" method="post" action="contact.php">
							<div>
<span> <a href="./">Home</a> | <a href="./archive.php">Archive</a> | <a href="./about.html">About</a> | <a href="./contact.php">Contact</a></span></br>								
<span>* Contact or request something about KISSmo, or report any bug has to do with KISSmo script, please fill a valid email in order for us to be able to contact you back and give you a feedback on you're request/report/debugging.</span>
							</div>
							<br>
							<div>
								<div>
									<span>Username</span>
								</div>
								<div>
									<input type="text" name="name" placeholder="You're username" value="<?php
										if (isset($fill["name"]) && $submitted == 0) {
											echo $fill["name"];
										}?>">
									<span class="<?php
										if (empty($nameErr)) {
											 echo "hidden";
										   } else {
											 echo "error";
										}
									?>"><?php echo $nameErr;?></span>
								</div>
							</div>
							<div>
								<div>
									<span>Email</span>
								</div>
								<div>
									<input type="text" name="email" placeholder="Email Address" value="<?php
										if (isset($fill["email"]) && $submitted == 0) {
											echo $fill["email"];
										}?>">
									<span class="<?php
										if (empty($emailErr)) {
											 echo "hidden";
										   } else {
											 echo "error";
										}
									?>"><?php echo $emailErr;?></span>
								</div>
							</div>

								<div>
									<span>Message:</span>
								</div>
								<div>
									<textarea name="inquiry" placeholder="You're detailed message fill it here please!" style="margin: 0px; width: 80%; height: 249px;"><?php
										if (isset($fill["inquiry"]) && $submitted == 0) {
											echo $fill["inquiry"];
										}?></textarea>
									<span class="<?php
										if (empty($inquiryErr)) {
											 echo "hidden";
										   } else {
											 echo "error";
										}
									?>"><?php echo $inquiryErr;?></span>
									<div>
										<input type="submit" value="Submit" class="small button" />
									</div>
								</div>
							</div>
						</form>
								
						<!-- Success message -->
						<span class="success <?php if ($submitted == 0) { echo "hidden"; } ?>" >You're message has been <strong>Successfully sent</strong></span>
					</div>
				</div>
			</div>
		</div>
	</section>
</body>

</html>
