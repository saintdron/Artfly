<?php ## �������� ����� ������� nsdeclform() // �-� ���������������� � index.php, line 20
function nsdeclform($namespacedecl) // [Forum]=Array()
{
    $n=0;
    foreach ($namespacedecl as $namens => $prefixarray) { //[Forum] => Array()
    ?>
    ><TABLE ALIGN=center BORDER=1
    ><TR
    ><TH COLSPAN=2>���������� �������� �������� ����:
      "<?php echo $namens?>"</TH
    ></TR
    ><TR
    ><TH>�������</TD
    ><TH>������� ����</TD
    ></TR
    <?php
	foreach ($prefixarray as $prefix=>$namespace) { // prefix = http:// 	?>
	><TR
	><TD>xmlns:<INPUT NAME="prefix[<?php echo $n?>]"
			VALUE="<?php echo $prefix?>"/></TD
	><TD><INPUT TYPE="hidden" NAME="ns[<?php echo $n?>]"
			VALUE="<?php echo $namespace?>"/>
	    <?php echo $namespace?></TD
	></TR
	<?php
	$n++;
	}?>
    ></TABLE
    <?php
    }
}
?>