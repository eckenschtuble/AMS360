<!doctype html>
<html class="no-js" lang="en">

<head>
  <meta charset="utf-8">
  <title>AMS 360</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="manifest" href="site.webmanifest">
  <link rel="apple-touch-icon" href="icon.png">
  <!-- Place favicon.ico in the root directory -->

  <link rel="stylesheet" href="https://use.typekit.net/jsc2xgt.css">
  <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/main.css">

  <meta name="theme-color" content="#fafafa">
</head>

<body>
  <!--[if lte IE 9]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  <![endif]-->

  <nav class="navbar navbar-expand-lg">
  	<a class="navbar-brand" href="index.html"><img class="logo" src="img/AMSLogo360White.png" alt="AMS 360"></a>

  	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    	<span class="navbar-toggler-icon"></span>
  	</button>

  	<div class="collapse navbar-collapse" id="navbarSupportedContent">
    	<ul class="navbar-nav mr-auto">
      	<li class="nav-item">
      		<a class="nav-link active" href="index.html">Home</a>
      	</li>
      	<li class="nav-item">
        	<a class="nav-link" href="training.html">Training</a>
      	</li>
      	<li class="nav-item">
        	<a class="nav-link" href="about.html">About</a>
      	</li>
      	<li class="nav-item">
        	<a class="nav-link" href="contact.php">Contact</a>
      	</li>
    	</ul>
  	</div>
	</nav>

  <header>
    <h1>Welcome!</h1>
  </header>

  <section class="clearfix">
    <div class="contentText">
      <h2>EMAIL FORM</h2>

      <?php
        if(isset($_POST['email'])) {
          $email_to = "waypastspooked@gmail.com";
          $email_subject = "Message from ams360inc.com";
          
          // validation expected data exists
          if(!isset($_POST['first_name']) ||
            !isset($_POST['last_name']) ||
            !isset($_POST['email']) ||
            !isset($_POST['telephone']) ||
            !isset($_POST['comments'])) {
            echo '<p class="mailError">We are sorry, but there appears to be a problem with the form you submitted.</p>';
          }
     
          $first_name = $_POST['first_name']; // required
          $last_name = $_POST['last_name']; // required
          $email_from = $_POST['email']; // required
          $telephone = $_POST['telephone']; // not required
          $comments = $_POST['comments']; // required
     
          $error_message = "";
          $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
          $string_exp = "/^[A-Za-z .'-]+$/";

          if(!preg_match($email_exp,$email_from)) {
            $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
          }

          if(!preg_match($string_exp,$first_name)) {
            $error_message .= 'The First Name you entered does not appear to be valid.<br />';
          }

          if(!preg_match($string_exp,$last_name)) {
            $error_message .= 'The Last Name you entered does not appear to be valid.<br />';
          }

          if(strlen($comments) < 2) {
            $error_message .= 'The Comments you entered do not appear to be valid.<br />';
          }

          if(strlen($error_message) > 0) {
            echo '<p class="mailError">' . $error_message . '</p>';
          }
          else{
            $email_message = "Form details below.\n\n";
       
            function clean_string($string) {
              $bad = array("content-type","bcc:","to:","cc:","href");
              return str_replace($bad,"",$string);
            }
       
            $email_message .= "First Name: ".clean_string($first_name)."\n";
            $email_message .= "Last Name: ".clean_string($last_name)."\n";
            $email_message .= "Email: ".clean_string($email_from)."\n";
            $email_message .= "Telephone: ".clean_string($telephone)."\n";
            $email_message .= "Comments: ".clean_string($comments)."\n";
       
            // create email headers
            $headers = 'From: '.$email_from."\r\n".
            'Reply-To: '.$email_from."\r\n" .
            'X-Mailer: PHP/' . phpversion();
            @mail($email_to, $email_subject, $email_message, $headers);

            echo '<p class="mailSuccess">Your message has been sent! Thank you!</p>';
          }
        }
      ?>
 
      <form name="htmlform" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <table width="450px">
          <tr>
            <td valign="top">
              <label for="first_name">First Name *</label>
            </td>
            <td valign="top">
              <input  type="text" name="first_name" maxlength="50" size="30">
            </td>
          </tr>
 
          <tr>
            <td valign="top"">
              <label for="last_name">Last Name *</label>
            </td>
            <td valign="top">
              <input type="text" name="last_name" maxlength="50" size="30">
            </td>
          </tr>

          <tr>
            <td valign="top">
              <label for="email">Email Address *</label>
            </td>
            <td valign="top">
              <input  type="text" name="email" maxlength="80" size="30">
            </td>
          </tr>

          <tr>
            <td valign="top">
              <label for="telephone">Phone Number</label>
            </td>
            <td valign="top">
              <input type="text" name="telephone" maxlength="30" size="30">
            </td>
          </tr>
          
          <tr>
            <td valign="top">
              <label for="comments">Message *</label>
            </td>
            <td valign="top">
              <textarea  name="comments" maxlength="1000" cols="25" rows="6"></textarea>
            </td>
          </tr>

          <tr>
            <td colspan="2" style="text-align:center">
              <input type="submit" value="Submit">
            </td>
          </tr>
        </table>
      </form>
    </div>
  </section>

  <footer>
    <p>PowerMILL®, PowerSHAPE®, PowerINSPECT®, and FeatureCAM®, are registered trademarks of © Autodesk Inc.</p>
  </footer>

  <script src="js/vendor/modernizr-3.6.0.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script>window.jQuery || document.write('<script src="js/vendor/jquery-3.3.1.min.js"><\/script>')</script>
  <script src="js/plugins.js"></script>
  <script src="js/main.js"></script>

  <script src="js/bootstrap/bootstrap.min.js"></script>

  <!-- Google Analytics: change UA-XXXXX-Y to be your site's ID. -->
  <script>
    window.ga = function () { ga.q.push(arguments) }; ga.q = []; ga.l = +new Date;
    ga('create', 'UA-XXXXX-Y', 'auto'); ga('send', 'pageview')
  </script>
  <script src="https://www.google-analytics.com/analytics.js" async defer></script>
</body>

</html>
