	</div><!-- #content -->
	
  <?php 
  $address = get_field("address","option");
  $email = get_field("email","option");
  $phone = get_field("phone","option");
  $fax = get_field("fax","option");
  $contact_infos = array($address,$phone,$fax);
  ?>
  <footer id="colophon" class="site-footer" role="contentinfo">
    <div class="wrapper">
      <?php if ($contact_infos && array_filter($contact_infos)) { ?>
      <div class="footer-contact">
        <div class="t1">CONTACT</div>
        <?php if ($address) { ?>
          <div class="info contact"><?php echo $address ?></div>
        <?php } ?>
        <?php if ($phone || $fax) { ?>
          <div class="info phone-fax">
              <?php if ($phone) { ?>
              <a href="tel:<?php echo format_phone_number($phone) ?>" class="phone"><?php echo $phone ?> Office</a>  
              <?php } ?>
              <?php if ($fax) { ?>
              <a href="tel:<?php echo format_phone_number($fax) ?>" class="fax"><?php echo $fax ?> Fax</a>  
              <?php } ?>
          </div>
        <?php } ?>
        <?php if ($email) { ?>
          <div class="info contact"><a href="tel:<?php echo antispambot($email,1) ?>" class="email"><?php echo antispambot($email) ?></a>  </div>
        <?php } ?>
      </div>
      <?php } ?>
    </div>
	</footer><!-- #colophon -->
	
</div><!-- #page -->
<div id="loaderdiv"><div class="loader"><span class="loadtxt">Loading...</span></div></div>
<?php wp_footer(); ?>
</body>
</html>
