 <?php
$hc_ajax_nonce = wp_create_nonce("hyconspecialsecurityforajaxstring");
?>

<h3>Activation Error Log</h3>

<table>
<tr>
<th>
Date
</th>
<th>
Error
</th>
</tr>

<?php
global $wpdb;
$hc_errors=$wpdb->get_results("select * from `hc_activation_error_log`");
foreach($hc_errors as $hc_errors) {  ?>


<tr>
<td>
<?php echo $hc_errors->date; ?>
</td>
<td>
<?php echo $hc_errors->error_message; ?>
</td>
</tr>
<?php
}
?>
</table>



