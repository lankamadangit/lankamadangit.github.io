<?
include $skin_folder."/foot.php";
?>
<!-- Body }} -->
        </td>
    </tr>
    <tr>
        <td>
<!-- {{ BOTTOM -->
<?
if($v) include ("./menu/{$v}/BOTTOM.php");
else include ("./menu/kr/BOTTOM.php");
?>
<!-- BOTTOM }} -->
        </td>
    </tr>
</table>
</body>

</html>