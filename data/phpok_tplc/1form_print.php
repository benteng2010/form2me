<?php if(!defined('PHPOK_SET')){die('<h3>Error...</h3>');}?><html>
<style type='text/css'>
table{
    border-collapse:collapse;
}
table td{
    height:40px;border-top:1px solid gray;padding:0;
}
</style>
<body onLoad='window.print();'>
<h2><?php echo $forminfo[form_title];?></h2>
<table>
    <?php  $data = unserialize($msg['form_data']);;?>
           
           <?php $_i=0;$list=(is_array($list))?$list:array();foreach($list AS  $key=>$value){$_i++; ?>
              <tr> 
              <td><?php echo $value[field_name];?></td><td>&nbsp;&nbsp;</td><td><?php if(gettype($data['element_'.$key])=='array'){?><?php echo implode(',',$data['element_'.$key]);;?><?php }else{ ?><?php echo $data['element_'.$key];;?><?php } ?></td>
              </tr>
           <?php } ?>
           <tr>
           <td cols="3">创建时间:<?php echo $msg[created];?>　　IP:<?php echo $msg[ip];?></td>
           </tr>
</table>

</body>
</html>