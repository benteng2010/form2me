<?php if(!defined('PHPOK_SET')){die('<h3>Error...</h3>');}?><?php QG_C_TEMPLATE::p("global_head","","0");?>
</head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<body>
<div style="margin-top:-40px">
<div style="width:20%; float:left; text-align:left">
<iframe name="FLeft" id="FLeft" src="admin.php?file=left" frameborder="0" scrolling="yes" width="220px" height="100%" onload="document.all['FLeft'].style.height=FLeft.document.body.scrollHeight;document.all['FLeft'].style.width=FLeft.document.body.scrollWidth" style="float:left" ></iframe>
 </div>
<div id="index" style="float:right; width:80%; text-align:left">
<iframe name="main" id="main" src="admin.php?file=index" frameborder="0" scrolling="no" width="100%" height="100%" onload="document.all['main'].style.height=main.document.body.scrollHeight;document.all['main'].style.width=main.document.body.scrollWidth" ></iframe>
</div>
</div>
</body>
</html>