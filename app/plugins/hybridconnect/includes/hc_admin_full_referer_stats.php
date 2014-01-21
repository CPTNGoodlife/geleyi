<?php $thisMailCount=0; ?>
<h4 style="text-align:left !important;">Breakdown for <?php echo $_POST["domain"]; ?></h4>
<table style="width:100%; padding-left:20px; float:right; border:0px !important; margin-bottom:20px;">
<tbody style="border:0px !important;">
<?php foreach($thisRefererStats as $thisReferal) {
if(strpos($thisReferal->referer,'.mail.') !== false) {
  $thisMailCount++;
  continue;
}
?>
<tr>
<td style="text-align:left; border:0px !important;">
<a href="<?php echo $thisReferal->referer; ?>" target="_blank">
<?php echo $thisReferal->referer; ?>
</a>
</td>
<td style="border:0px !important;">
<?php echo $thisReferal->subscribers; ?>
</td>
</tr>
<?php }
if($thisMailCount) {
?>
<tr>
<td style="text-align:left; border:0px !important;">
Subsribers sent from Emails
</td>
<td style="border:0px !important;">
<?php echo $thisMailCount; ?>
</td>
</tr>

<?php }
?>

</tbody>
</table>