<?php 

$host = "";
if(!empty($_SERVER['HTTPS'])) {
    $host = "https://";
} else {
    $host = "http://";
}

$host .= $_SERVER['HTTP_HOST']. '/filmhoror';

require 'facebook/facebook.php';

// Create our Application instance (replace this with your appId and secret).
$facebook = new Facebook( array('appId' => '476721465680950', 'secret' => '78e70b8ad92fd3c661a01f0002736948' ));

/*if($_GET['state'] == 'goat' && $_GET['code']) {
header("location:https://graph.facebook.com/oauth/access_token?client_id=476721465680950&".
"redirect_uri=".rawurlencode($host.'/filmhoror.php')."&".
"client_secret=78e70b8ad92fd3c661a01f0002736948&code=".
$_GET['code']);

//print_r($_GET['code']);
} else {
	header("location:https://www.facebook.com/dialog/oauth?client_id=476721465680950
	&redirect_uri=".$host."/index.php
	&scope=publish_actions
	&state=goat");
} */
if($_REQUEST['code']) {
	//print_r($_GET['code']);
	$loginCode = "https://graph.facebook.com/oauth/access_token?"
	    ."client_id=476721465680950"
	    ."&redirect_uri=". rawurlencode($host)
	    ."&client_secret=78e70b8ad92fd3c661a01f0002736948"
	    ."&code=".$_REQUEST['code'];
		
	$response = file_get_contents($loginCode);
	$params = null;
    parse_str($response, $params);
	print_r($response);
	
	$loginUrl = $host . '/filmhoror.php?access_token=' 
       . $params['access_token'];
	
} else {
	$params = array(
	  'scope' => 'publish_stream',
	  'redirect_uri' => $host
	);

	$loginUrl = $facebook->getLoginUrl($params);
}
?>
<html>
    <head>
        <title>Generator Judul Film Horor</title>
    </head>
<script type="text/javascript">
	//alert('<?=print_r($_REQUEST['code']) ?>');
    // window.location.assign('<?php echo $loginUrl; ?>');
</script>
</html>