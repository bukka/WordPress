<div class="author-box">
	<ul class="nav nav-tabs" id="authorTab">
		<li class="active"><a href="#about"><?php etn_e( 'About Author' ); ?></a></li>
		<li><a href="#latest"><?php etn_e( 'Latest Posts' ); ?></a></li>
	</ul>

	<div class="tab-content postclass">
		<div class="tab-pane clearfix active" id="about">
			<div class="author-profile vcard">
				<?php echo ethnologist_author_avatar( 100 ); ?>
				<div class="author-follow">
					<?php foreach ($params['social'] as $name => $data): ?>
					<?php   if ( get_the_author_meta( $name ) ): ?>
					<?php     if ( $params['display_follow'] ): $params['display_follow'] = false; ?>
					<span class="followtext"><?php etn_e( 'Follow' ); ?> <?php the_author_meta( 'first_name' ); ?>:</span>
					<?php     endif; ?>
					<span class="<?php echo $data['class']; ?>">
						<a href="<?php echo (isset($data['url_prefix']) ? $data['url_prefix'] : '') . get_the_author_meta( $name ); ?>"
							title="<?php etn_e( 'Follow' ); ?> <?php the_author_meta( 'first_name' ); ?> <?php etn_e( 'on the social' ); ?> <?php echo $data['title']; ?>">
							<i class="<?php echo $data['icon']; ?>"></i>
						</a>
					</span>
					<?php   endif; ?>
					<?php endforeach; ?>
				</div><!--Author Follow-->

				<h5 class="author-name">
					<a href="<?php echo ethnologist_author_href(); ?>" rel="author">
						<?php echo get_the_author_meta( 'first_name' ) ?>
						<?php echo get_the_author_meta( 'last_name' ) ?>
					</a>
				</h5>
				<?php if ( get_the_author_meta( 'occupation' ) ): ?>
				<p class="author-occupation"><strong><?php the_author_meta( 'occupation' ); ?></strong></p>
				<?php endif; ?>
				<p class="author-description author-bio">
					<?php the_author_meta( 'description' ); ?>
				</p>
			</div>
		</div><!--pane-->
		<div class="tab-pane clearfix" id="latest">
			<div class="author-latestposts">
				<?php echo get_avatar( get_the_author_meta('ID'), 80 ); ?>
				<h5>
					<?php etn_e( 'Latest posts from' ); ?>
					<a href="<?php echo ethnologist_author_href(); ?>" rel="author">
						<?php echo get_the_author_meta( 'first_name' ) ?>
						<?php echo get_the_author_meta( 'last_name' ) ?>
					</a>
				</h5>
				<ul>
					<?php while ( $params['query']->have_posts() ) : $params['query']->the_post(); ?>
					<li>
						<a href="<?php the_permalink();?>"><?php the_title(); ?></a>
						<span class="recentpost-date"> - <?php echo get_the_date( etn__( 'ethnologist_post_date' ) ); ?></span>
					</li>
					<?php endwhile; ?>
				</ul>
			</div><!--Latest Post -->
		</div><!--Latest pane -->
	</div><!--Tab content -->
</div><!--Author Box -->