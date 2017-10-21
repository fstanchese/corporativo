<?php
	include("../engine/User.class.php");
	include("../engine/Db.class.php");
	include("../engine/HtmlPDF.class.php");

	$user = new User ();
	$dbOracle 	= new Db ($user);
	$dbData 	= new DbData ($dbOracle);	
	
	$contratoPronatec = new HtmlPDF();


$html = <<<EOF
<style>
  h1 {
    color: navy;
    font-family: times;
    font-size: 24pt;
    text-decoration: underline;
  }
  p {
    color: red;
    font-family: helvetica;
    font-size: 12pt;
  }
</style>
<body>
<h1>Example of <i>HTML + CSS</i></h1>
<p>Example of 12pt styled paragraph.</p>
</body>
EOF;

	$contratoPronatec->Html($html);
	
?>