<div class="vcard">
<?php if ( ! empty( $params['company'] ) ): ?>
	<h5 class="vcard-company"><i class="icon-building"></i><?php echo $params['company']; ?></h5>
<?php endif;?>
<?php if ( ! empty( $params['name'] ) ): ?>
	<p class="vcard-name"><i class="icon-user"></i><?php echo $params['name']; ?></p>
<?php endif;?>
<?php if ( ! empty( $params['street_address'] ) || ! empty( $params['locality'] ) || ! empty( $params['region'] ) ): ?>
	<p class="vcard-address"><i class="icon-map-marker"></i><?php echo $params['street_address']; ?>
		<span><?php echo $params['locality']; ?> <?php echo $params['region']; ?> <?php echo $params['postal_code']; ?></span>
	</p>
<?php endif;?>
<?php if ( ! empty($params['tel'] ) ): ?>
	<p class="tel"><i class="icon-tablet"></i> <?php echo $params['tel']; ?></p>
<?php endif;?>
<?php if ( ! empty( $params['fixedtel'] ) ): ?>
	<p class="tel fixedtel"><i class="icon-phone"></i> <?php echo $params['fixedtel']; ?></p>
<?php endif;?>
<?php if ( ! empty( $params['email'] ) ): ?>
	<p><a class="email" href="mailto:<?php echo antispambot( $params['email'] );?>">
		<i class="icon-envelope"></i> <?php echo antispambot( $params['email'] ); ?></a>
	</p>
<?php endif;?>
</div>