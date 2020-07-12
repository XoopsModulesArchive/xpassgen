<?php
include("../../mainfile.php");
include(XOOPS_ROOT_PATH."/header.php");
$xoopsOption['show_rblock'] = 1;
if (file_exists('language/'.$GLOBALS['xoopsConfig']['language'].'/modinfo.php')) {
  include_once 'language/'.$GLOBALS['xoopsConfig']['language'].'/modinfo.php';
}else{
  include_once 'language/english/modinfo.php';
}
function generatePassword($plength,$include_letters,$include_capitals,$include_numbers,$include_punctuation)
    {

        if(!is_numeric($plength) || $plength <= 0)
        {
            $plength = 8;
        }
        if($plength > 64)
        {
            $plength = 64;
        }
                $chars = "";

                if ($include_letters == true) { $chars .= 'abcdefghijklmnopqrstuvwxyz'; }
                if ($include_capitals == true) { $chars .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'; }
                if ($include_numbers == true) { $chars .= '0123456789'; }
                if ($include_punctuation == true) { $chars .= '`¬£$%^&*()-_=+[{]};:@#~,<.>/?'; }
                if ($include_letters == false AND $include_capitals == false AND $include_numbers == false AND $include_punctuation == false) {
                    $chars .= '0';
                }
        mt_srand(microtime() * 1000000);
        for($i = 0; $i < $plength; $i++)
        {
            $key = mt_rand(0,strlen($chars)-1);
            $pwd = $pwd . $chars{$key};       }
			
        for($i = 0; $i < $plength; $i++)
        {
            $key1 = mt_rand(0,strlen($pwd)-1);
            $key2 = mt_rand(0,strlen($pwd)-1);

            $tmp = $pwd{$key1};
            $pwd{$key1} = $pwd{$key2};
            $pwd{$key2} = $tmp;
        }

      
        $pwd = htmlentities($pwd, ENT_QUOTES);

        return $pwd;
    }
?>
<html>
<head>
<title><? echo ''._PASSGEN_TITLE.''; ?></title>
<style type="text/css">
</style>
</head>
<body>
<?php
if ($_POST["Submit"] == true) {
echo "<br>\n";
echo "<br>\n";
echo "<center>\n";
echo ''._PASSGEN_IMAGE.'';
echo "";
echo "<br>\n";
echo "<center>";
    echo ''._PASSGEN_PASSWORDS.'<hr><b>';
    for ($i = 1; ; $i++) {
       if ($i > $_POST["quantity"]) {
           break;
       }
           echo generatePassword($_POST["length"],$_POST["letters"],$_POST["capitals"],$_POST["numbers"],$_POST["punctuation"]) . " <hr> ";
    }
    echo "</b>";
	
	
	
	echo '<br /><center><form action><input type=\'button\' value=\''._PASSGEN_GOBACK.'\' onclick=\'history.go(-1)\'></form>';
}

else
{
?>
<br><br><center><?echo ''._PASSGEN_IMAGE.'';?></center>
<br><br>
    <form name="password_form" method="post">
    <table align="center"border="0" cellspacing="0" cellpadding="0">
      <tr>
	  
        <td align="right"><? echo ''._PASSGEN_LENGTH.''; ?></td>
        <td align="left"><select name="length" size="1">
          <?php
            for ($i = 1; ; $i++) {
               if ($i > 64) {
                   break;
               }
               if ($i == 8) {
                echo "<option value=$i selected>$i</option>\n";
               }
               else
               {
                echo "<option value=$i>$i</option>\n";
               }
            }
          ?>
        </select></td>
        </tr>
      <tr>
        <td align="right"><? echo ''._PASSGEN_LETTERS.''; ?>   </td>
        <td>
          <input type="checkbox" name="letters" value="true" checked>
          (<? echo ''._PASSGEN_EG.''; ?> abcdef)    </td>
        </tr>
      <tr>
       <td align="right"><? echo ''._PASSGEN_CAP_LETTERS.''; ?></td>
        <td>
          <input type="checkbox" name="capitals" value="true">
          (<? echo ''._PASSGEN_EG.''; ?> AbcDEf)    </td>
        </tr>
      <tr>
       <td align="right"><? echo ''._PASSGEN_NUMBERS.''; ?></td>
        <td><input type="checkbox" name="numbers" value="true">
          (<? echo ''._PASSGEN_EG.''; ?> a9b8c7d)</td>
        </tr>
      <tr>
        <td align="right"><? echo ''._PASSGEN_PUNCT.''; ?></td>
        <td><input type="checkbox" name="punctuation" value="true">
          (<? echo ''._PASSGEN_EG.''; ?> a!b*c_d)</td>
        </tr>
      <tr>
        <td align="right"><? echo ''._PASSGEN_QUANTITY.''; ?></td>
        <td><select name="quantity" size="1">
          <?php
            for ($i = 1; ; $i++) {
               if ($i > 50) {
                   break;
               }
               echo "<option value=$i>$i</option>\n";
            }
          ?>
        </select></td>
        </tr>
    </table align="center">
    <p align="center"> 
      &nbsp;&nbsp;&nbsp;
	  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="Submit" value="<? echo ''._PASSGEN_GENERATE.''; ?>">
      <input type="reset" name="Reset" value="<? echo ''._PASSGEN_RESET.''; ?>">
    
	</p>
    </form>
	
<?php
}
?> 
<br><center><small><a href="http://www.danordesign.com/" target="_blank">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<? echo ''._PASSGEN_BY.''; ?> Danordesign </a></center> 
<?php
include(XOOPS_ROOT_PATH."/footer.php");

?> 