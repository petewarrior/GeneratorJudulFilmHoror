<?php
require 'facebook/facebook.php';

// Create our Application instance (replace this with your appId and secret).
$facebook = new Facebook( array('appId' => '476721465680950', 'secret' => '' ));



if($_GET['access_token']) $facebook->setAccessToken($_GET['access_token']);

// We may or may not have this data based on whether the user is logged in.
//
// If we have a $user id here, it means we know the user is logged into
// Facebook, but we don't know if the access token is valid. An access
// token is invalid if the user logged out of Facebook.

// Get User ID
$user = $facebook -> getUser();

if ($user) {
    try {
        // Proceed knowing you have a logged in user who's authenticated.
        $user_profile = $facebook -> api('/me');
    } catch (FacebookApiException $e) {
        error_log($e);
        print_r($e);
        $user = null;
    }
}

$iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_CBC);

$key = "bangketikus";
$iv = "";

for($i = 0; $i < $iv_size; $i++) {
    $iv .= $i % 10;
}

?>

<?php

$hantu = array("Genderuwo",
            "Tuyul",
            "Pocong",
            "Drakula",
            "Vampir",
            "Manusia Serigala",
            "Banshee",
            "Boggart",
            "Hantu",
            "Psikopat",
            "Dukun Santet",
            "Sundel Bolong",
            "Kuntilanak"
            );

$artis = array("Jupe",
            "Depe",
            "Nikita",
            "Sule",
            "Tukul",
            "Olga",
            "Chantal",
            "Farah",
            "Vicky"
            );

$lokasi = array("Manggarai",
            "Karawang",
            "Bekasi",
            "Cinere",
            "Jeruk Purut",
            "Sunter",
            "Senopati",
            "Thamrin",
            "Grogol"
            );

$landmark = array("Jembatan",
                "Terowongan",
                "Kuburan",
                "Hutan",
                "Rumah Tua",
                "Hotel",
                "Goa",
                "Sungai"
                );
                
$waktu = array('Jumat Kliwon',
            'Malam Pengantin',
            'Bulan Purnama'
            );
            
$verb_passive = array('Digoyang',
            'Dicium',
            'Kesurupan',
            'Dikejar',
            'Dikutuk',
            'Diteror',
            'Diculik',
            'VS',
            'Dirayu'
            );
            
$beginning = array('Dendam',
            'Kembalinya',
            'Kemarahan', 
            'Dendam Kesumat',
            'Rayuan',
            'Sejarah',
            'Asal Mula'
            );
            
$pattern = array('hantu verb_passive hantu',
            'artis verb_passive hantu',
            'hantu landmark lokasi',
            'artis verb_passive hantu landmark lokasi',
            'artis verb_passive hantu waktu',
            'artis verb_passive hantu',
            'beginning hantu'
            );

if(!$_GET['result']) {
    
    $ptnNum = rand(0, count($pattern) - 1);         
    $ptn = explode(" ", $pattern[$ptnNum]);
    
    $resId = time() . "|".$user. "|" . $ptnNum;
    $res = "";
    
    foreach($ptn as $a) {
        $rand = rand(0, count(${$a}) - 1);
        $resId .= "|" . $rand;
        $res .= ${$a}[$rand] . " ";
    }
    //$hash = $resId;
    $hash = rawurlencode(base64_encode(mcrypt_encrypt(MCRYPT_BLOWFISH, $key, $resId, MCRYPT_MODE_CBC, $iv)));
    
?>
<script type="text/javascript">
window.location.assign('http://petewarrior.com/filmhoror/filmhoror.php?access_token=<?=$_GET['access_token']; ?>&just_created=1&result=<?=$hash; ?>');
</script>
<?php
} else {
    $hash = base64_decode(rawurldecode($_GET['result']));
    $result = mcrypt_decrypt(MCRYPT_BLOWFISH, $key, $hash, MCRYPT_MODE_CBC, $iv);
    $r = explode("|", $result);
    
    //print_r($r);
    
    $timestamp = $r[0];
    $userid = $r[1];
    $ptn = explode(" ", $pattern[$r[2]]);
    //print_r($ptn);
    //print_r(count($ptn));
    $res = "";
    
    
    for($i = 0; $i < count($ptn); ++$i) {
        $x = intval($r[$i+3]);
        $append = ${$ptn[$i]}[$x] . " ";
        $res .= $append;
        //print_r($x);
        //print_r($append);
        //print_r(${$ptn[$i]});
    }
    
    $datetime = new DateTime();
    $datetime->setTimestamp($timestamp);
    $formatted_datetime = $datetime->format('Y-m-d H:i:s');
    
    //print_r($user);
?>



<!DOCTYPE html>
<html xmlns:fb="http://ogp.me/ns/fb#">
<head>
<title>Generator Judul Film Horor</title>


<meta property="fb:admins" content="petewarrior"/>
<meta property="fb:app_id" content="476721465680950"/>
  <meta property="og:title"  content="<?php echo $res; ?>" /> 
  <meta property="og:description"  content="Temukan judul film horormu di sini!" /> 
<meta property="og:type"   content="filmhoror:title" /> 
  <meta property="og:url"    content="http://petewarrior.com/filmhoror/filmhoror.php?result=<?=rawurlencode($_GET['result']); ?>" /> 
  

  <meta property="og:image"  content="http://petewarrior.com/filmhoror/kuntilanak_lucu.jpg" /> 

<link href='http://fonts.googleapis.com/css?family=Eagle+Lake|Life+Savers' rel='stylesheet' type='text/css'>


<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-2053162-2']);
  _gaq.push(['_setDomainName', 'petewarrior.com']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</head>
<body style="background: #000; background-repeat:no-repeat; background-image: url('trees.jpg'); background-size: 100% auto;">

<div id="fb-root"></div>
<script>

var access_token;

window.fbAsyncInit = function() {
    FB.init({
      appId      : '476721465680950', // App ID
      //channelUrl : '//WWW.YOUR_DOMAIN.COM/channel.html', // Channel File
      status     : true, // check login status
      cookie     : true, // enable cookies to allow the server to access the session
      xfbml      : true  // parse XFBML
    });

    // Additional initialization code here
    //alert('FB JS loaded');
    FB.getLoginStatus(function(response) {
       if (response.status === 'connected') {
        // the user is logged in and has authenticated your
        // app, and response.authResponse supplies
        // the user's ID, a valid access token, a signed
        // request, and the time the access token 
        // and signed request each expire
        var uid = response.authResponse.userID;
        accessToken = response.authResponse.accessToken;
        //alert('logged in');
        startFB();
      } else if (response.status === 'not_authorized') {
        // the user is logged in to Facebook, 
        // but has not authenticated your app
      } else {
        // the user isn't logged in to Facebook.
      } 
    });
    
  };
  
    (function(d){
     var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement('script'); js.id = id; js.async = true;
     js.src = "//connect.facebook.net/en_US/all.js";
     ref.parentNode.insertBefore(js, ref);
   }(document));
   
        
function startFB() {
<?php if($_GET['just_created'] == 1) { ?>
	// open graph here
	FB.api('/me/filmhoror:generate', 'post', 
	{ title: 'http://petewarrior.com/filmhoror/filmhoror.php?result=<?=rawurlencode($_GET['result']); ?>'
	   },
	function(response) {
	  //alert(JSON.stringify(response));
	}
	);
	
	// popup feed dialog, just in case
	var obj = {
          method: 'feed',
          link: 'http://petewarrior.com/filmhoror/filmhoror.php?result=<?=rawurlencode($_GET['result']); ?>',
          picture: 'http://petewarrior.com/filmhoror/kuntilanak_lucu.jpg',
          name: 'Judul film horor saya adalah "<?php echo $res; ?>"',
          description: 'dari Generator Judul Film Horor',
          actions: [{name: 'Temukan judul film horormu!', link: 'http://petewarrior.com/filmhoror'}]
          //description: 'Using Dialogs to interact with users.'
        };

        function callback(response) {
          //document.getElementById('msg').innerHTML = "Post ID: " + response['post_id'];
        }

        FB.ui(obj, callback);
<?php } ?>
    
}

function explicitOG() {
    FB.api('/me/filmhoror:generate', 'post', 
        { title: 'http://petewarrior.com/filmhoror/filmhoror.php?result=<?=rawurlencode($_GET['result']); ?>',
        "fb:explicitly_shared": true },
        function(response) {
          //alert(JSON.stringify(response));
        }
        
    );
}

</script>

<style type="text/css">
    .box {
        float: left;
        width: 300px;
        margin: 5px;
    }
    
    .username a {
        text-decoration: none;
        font-weight: bold;
        color: white;
    }
</style>

<div align="center">
<div style="font-family: 'Life Savers', cursive; font-size: 1.3em; color: #fff;"> Judul film horor <span class="username"><fb:name uid="<?=$userid ?>" useyou="false" /></span> adalah...</div>
<div style="font-family: 'Eagle Lake', cursive; font-size: 2.5em; color: #f00;"><?php echo $res; ?></div>
<div style="color: #888; font-size: 10px;">Dibuat pada: <?php echo $formatted_datetime; ?> GMT -0500<br />
    Gambar kuntilanak oleh <a href="http://raindart.deviantart.com/art/Indonesia-Ghost-Kuntilanak-313971471" target="_blank">~raindart</a>
</div>
<!--div style="margin: 10px auto;"><a href="#" onclick="explicitOG()">Post di wall</a></div-->
<div style="margin: 10px auto;"><a href="http://petewarrior.com/filmhoror">Cari tahu judul film horormu!</a></div>
<fb:facepile href="http://petewarrior.com/filmhoror" max_rows="1" width="300" colorscheme="dark"></fb:facepile>
<fb:like send="true" href="http://petewarrior.com/filmhoror/filmhoror.php?result=<?=$_GET['result'] ?>" layout="button_count" width="90" show_faces="false" colorscheme="dark"></fb:like>
<a href="https://twitter.com/share" class="twitter-share-button" data-related="petewarrior" data-url="http://petewarrior.com/filmhoror/filmhoror.php?result=<?=urlencode($_GET['result']) ?>" data-lang="id" data-size="medium" data-count="horizontal" data-hashtags="filmhoror" data-text="Judul Film Hororku: <?=$res ?>">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
<!--div class="fb-like" data-href="http://petewarrior.com/filmhoror" data-send="false" data-width="450" data-show-faces="true" data-colorscheme="dark" data-font="segoe ui"></div-->
<div align="center" id="comments" style="position: relative; margin: 10px auto;">
<fb:comments href="http://petewarrior.com/filmhoror/" num_posts="4" width="600" colorscheme="dark"></fb:comments>
</div>

    <div style="margin: 10px auto; position: relative; width: 620px; padding: 0px;">
        <div class="box">
            <fb:like-box href="http://www.facebook.com/petewarriordotcom" width="300" height="250" show_faces="true" stream="false" header="true"></fb:like-box>
        </div>
        <div class="box">
            <fb:activity app_id="476721465680950" width="300" height="250" header="true" font="segoe ui" recommendations="true"></fb:activity>
        </div>
    </div>
</div>


</body>
</html>

<?php }; ?>