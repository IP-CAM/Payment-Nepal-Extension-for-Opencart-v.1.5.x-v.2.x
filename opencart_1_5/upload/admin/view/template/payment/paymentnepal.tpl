<?php
?>
<?php echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <?php if ($error_warning) { ?>
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/payment.png" alt="" /> <?php echo $lang->get('heading_title'); ?></h1>
      <div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $lang->get('button_save'); ?></a><a onclick="location = '<?php echo $lang->get('cancel'); ?>';" class="button"><?php echo $lang->get('button_cancel'); ?></a></div>
    </div>
    <div class="content">
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        <table class="form">
          <tr>
            <td><span class="required">*</span> <?php echo $entry_paymentnepal_name; ?></td>
            <td><input type="text" name="paymentnepal_name" value="<?php echo $paymentnepal_name; ?>" />
              <?php if (isset($_error['paymentnepal_name'])) { ?>
              <span class="error"><?php echo $_error['paymentnepal_name']; ?></span>
              <?php } ?></td>
          </tr>

          <tr>
            <td> <?php echo $entry_paymentnepal_callback; ?></td>
            <td><?php echo HTTP_CATALOG.'index.php?route=payment/paymentnepal/callback'; ?></td>
          </tr>
          <tr>
            <td> <?php echo $entry_paymentnepal_success; ?></td>
            <td><?php echo HTTP_CATALOG.'index.php?route=checkout/success'; ?></td>
          </tr>
          <tr>
            <td> <?php echo $entry_paymentnepal_error; ?></td>
            <td><?php echo HTTP_CATALOG.'index.php?route=payment/paymentnepal/error'; ?></td>
          </tr>

          <tr>
            <td><span class="required">*</span> <?php echo $entry_paymentnepal_secret; ?></td>
            <td><input type="text" name="paymentnepal_secret" value="<?php echo $paymentnepal_secret; ?>" />
              <?php if (isset($_error['paymentnepal_secret'])) { ?>
              <span class="error"><?php echo $_error['paymentnepal_secret']; ?></span>
              <?php } ?></td>
          </tr>
          
          
          <tr>
          </tr>
          
          <tr>
            <td><span class="required">*</span> <?php echo $entry_paymentnepal_key; ?></td>
            <td><input type="text" name="paymentnepal_key" value="<?php echo $paymentnepal_key; ?>" />
              <?php if (isset($_error['paymentnepal_key'])) { ?>
              <span class="error"><?php echo $_error['paymentnepal_key']; ?></span>
              <?php } ?></td>
          </tr>
          
          <tr>
            <td><?php echo $entry_paymentnepal_total; ?></td>
            <td><input type="text" name="paymentnepal_total" value="<?php echo $paymentnepal_total; ?>" /></td>
          </tr> 

<tr> <td><?php echo $entry_paymentnepal_commission; ?></td>
		<td>
<?php if ($paymentnepal_commission) { ?>
<input type="checkbox" name="paymentnepal_commission" checked="checked" />
<?php } else { ?>
<input type="checkbox" name="paymentnepal_commission" />
<?php }?>
</td>
	  </tr>  
	  <tr> <td><?php echo $entry_paymentnepal_payment_type; ?></td>
		<td>
<?php if ($paymentnepal_payment_type) { ?>
<input type="checkbox" name="paymentnepal_payment_type" checked="checked" />
<?php } else { ?>
<input type="checkbox" name="paymentnepal_payment_type" />
<?php }?></td>
	  </tr> 
 <tr> <td><?php echo $entry_paymentnepal_payment_spg; ?></td>
		<td>
<?php if ($paymentnepal_payment_spg) { ?>
<input type="checkbox" name="paymentnepal_payment_spg" checked="checked" />
<?php } else { ?>
<input type="checkbox" name="paymentnepal_payment_spg" />
<?php }?></td>
	  </tr> 

 <tr> <td><?php echo $entry_paymentnepal_payment_wm; ?></td>
		<td>
<?php if ($paymentnepal_payment_wm) { ?>
<input type="checkbox" name="paymentnepal_payment_wm" checked="checked" />
<?php } else { ?>
<input type="checkbox" name="paymentnepal_payment_wm" />
<?php }?></td>
	  </tr>  

 <tr> <td><?php echo $entry_paymentnepal_payment_ym; ?></td>
		<td>
<?php if ($paymentnepal_payment_ym) { ?>
<input type="checkbox" name="paymentnepal_payment_ym" checked="checked" />
<?php } else { ?>
<input type="checkbox" name="paymentnepal_payment_ym" />
<?php }?></td>
	  </tr>   

 <tr> <td><?php echo $entry_paymentnepal_payment_mc; ?></td>
		<td>
<?php if ($paymentnepal_payment_mc) { ?>
<input type="checkbox" name="paymentnepal_payment_mc" checked="checked" />
<?php } else { ?>
<input type="checkbox" name="paymentnepal_payment_mc" />
<?php }?></td>
	  </tr>  

 <tr> <td><?php echo $entry_paymentnepal_payment_qiwi; ?></td>
		<td>
<?php if ($paymentnepal_payment_qiwi) { ?>
<input type="checkbox" name="paymentnepal_payment_qiwi" checked="checked" />
<?php } else { ?>
<input type="checkbox" name="paymentnepal_payment_qiwi" />
<?php }?></td>
	  </tr>  
      
          <tr>
            <td><?php echo $entry_paymentnepal_order_status_id; ?></td>
            <td><select name="paymentnepal_order_status_id">
                <?php foreach ($order_statuses as $order_status) { ?>
                <?php if ($order_status['order_status_id'] == $paymentnepal_order_status_id) { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select></td>
          </tr>
          
          <tr>
            <td><?php echo $entry_paymentnepal_geo_zone_id; ?></td>
            <td><select name="paymentnepal_geo_zone_id">
                <option value="0"><?php echo $lang->get('text_all_zones'); ?></option>
                <?php foreach ($geo_zones as $geo_zone) { ?>
                <?php if ($geo_zone['geo_zone_id'] == $paymentnepal_geo_zone_id) { ?>
                <option value="<?php echo $geo_zone['geo_zone_id']; ?>" selected="selected"><?php echo $geo_zone['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $geo_zone['geo_zone_id']; ?>"><?php echo $geo_zone['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select></td>
          </tr>
          
          <tr>
            <td><?php echo $entry_paymentnepal_status; ?></td>
            <td><select name="paymentnepal_status">
                <?php if ($paymentnepal_status) { ?>
                <option value="1" selected="selected"><?php echo $lang->get('text_enabled'); ?></option>
                <option value="0"><?php echo $lang->get('text_disabled'); ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $lang->get('text_enabled'); ?></option>
                <option value="0" selected="selected"><?php echo $lang->get('text_disabled'); ?></option>
                <?php } ?>
              </select></td>
          </tr>
          <tr>
            <td><?php echo $entry_paymentnepal_sort_order; ?></td>
            <td><input type="text" name="paymentnepal_sort_order" value="<?php echo $paymentnepal_sort_order; ?>" size="1" /></td>
          </tr>
        </table>
      </form>
    </div>
  </div>
</div>
<?php echo $footer; ?>
