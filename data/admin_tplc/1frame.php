<?php if(!defined('PHPOK_SET')){die('<h3>Error...</h3>');}?><?php QG_C_TEMPLATE::p("global_head","","0");?>
</head>
<!-- 注意，框架一定要放在body之前，不然会失效 -->
<frameset cols="202,*" border="0">
	<frame src="admin.php?file=left" name="FLeft" id="FLeft" noresize scrolling="yes" style="overflow-x:hidden;">
	<frame src="admin.php?file=index" noresize border="0" frameborder="0" scrolling="yes" style="overflow-x:hidden" name="main" id="main">
</frameset><noframes></noframes>
<body>
当前浏览器不支持框架，请检查....
</body>
</html>