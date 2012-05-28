<?php 

 /**
  *  Yunohost - Self-hosting for dummies
  *  Copyright (C) 2012  Kload <kload@kload.fr>
  *
  *  This program is free software: you can redistribute it and/or modify
  *  it under the terms of the GNU Affero General Public License as
  *  published by the Free Software Foundation, either version 3 of the
  *  License, or (at your option) any later version.
  *
  *  This program is distributed in the hope that it will be useful,
  *  but WITHOUT ANY WARRANTY; without even the implied warranty of
  *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  *  GNU Affero General Public License for more detailsYou
  *
  *  . should have received a copy of the GNU Affero General Public License
  *  along with this program.  If not, see <http://www.gnu.org/licenses/>.
  */

 $user = $_SERVER["PHP_AUTH_USER"];
 $password = $_SERVER["PHP_AUTH_PW"];
 $domain = substr($_SERVER["HTTP_EMAIL"], strpos($_SERVER["HTTP_EMAIL"], '@') + 1);

function scanAppDirectory($directory){

  $apps = array();
  $openDirectory = opendir($directory);
  while($entry = @readdir($openDirectory)) {
    if(is_dir($directory.'/'.$entry) && $entry != '.' && $entry != '..') {
        $apps[] = $entry;
    }
  }
  closedir($openDirectory);
  return $apps;
}

$apps = scanAppDirectory('.');

$mailbox = imap_open('{127.0.0.1:143/novalidate-cert}INBOX', $user, $password);
$mail = imap_mailboxmsginfo($mailbox);

 ?>
<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Yunohost Apps</title>
  <link media="all" type="text/css" href="style.css" rel="stylesheet">
</head>
<body class="gradient" style="overflow: hidden">
    <iframe name="glu" id="glu" width="100%" src="http://yunohost.org" style=""></iframe>
    <div class="navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="brand" href="/"><img src="logo.png"></a>
          <div class="deco"><a href="http://auth.<?php echo $domain ?>/index.pl?logout=1" title="Log out"><img src="shutdown.png"></a></div>

          <div class="username"><strong><?php echo $user ?></strong></div>
          <a href="#" class="after">&rsaquo;</a>
          <div class="nav-collapse">
            <ul class="nav pull-right">
              <li class="tab">
                <a class="active" href="http://yunohost.org">Home</a>
              </li>
              <?php foreach ($apps as $app) { ?>
                <li class="tab">
                  <a href="/<?php echo $app ?>"><?php echo ucfirst($app) ?></a>
                </li>
              <?php } ?>           
          </div><!--/.nav-collapse -->
          <a href="#" class="before">&lsaquo;</a>
        </div>
      </div>
    </div>

    <div class="mail_indicator">
      <div class="mail_container">
        <a class="mail_image" title="New mails">
          <span class="mail_counter"><?php echo $mail->Unread ?></span>
        </a>
      </div>
    </div>
 

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="../admin/public/js/libs/jquery-1.7.1.min.js"><\/script>')</script>
<script type="text/javascript" src="script.js"></script>
<script type="text/javascript" src="https://static.jappix.com/php/get.php?l=en&amp;t=js&amp;g=mini.xml"></script>

<script type="text/javascript">
   jQuery(document).ready(function() {
      MINI_ANIMATE = false;
      HOST_MAIN = "<?php echo $domain ?>";
      HOST_BOSH_MINI = 'http://<?php echo $domain ?>:5280/http-bind/';
      launchMini(false, false, <?php echo '"'.$domain.'", '.'"'.$user.'", "'.$password.'"' ?>);
   });
</script>
</body>
</html>

