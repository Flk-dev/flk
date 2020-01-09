<?php get_header(); ?> 
	<div class="in">
		<div class="container">
			<h1 class="block__title"><?php wp_title(''); ?></h1>
			<div class="row">
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<div class="col-sm-4">
						<a href="<?= get_the_permalink(); ?>" class="nd_item">
							<div class="nd_item-image">
								<?php if ( has_post_thumbnail() ) the_post_thumbnail(); ?>
							</div>
							<div class="nd_item-title"><?php the_title(); ?></div>
							<div class="nd_app">
								<div class="row">
									<?php 
										$pl = get_field('pl');
										$price = get_field('price');
										$address = get_field('address');
										$zl_pl = get_field('zl_pl');
										$et = get_field('et');

										if(!empty($pl)){ ?>
											<div class="col-sm-4">
												<b>Площадь:</b>
												<?= $pl; ?>
											</div>
										<?php }
										if(!empty($price)){ ?>
											<div class="col-sm-4">
												<b>Цена:</b>
												<?= $price; ?>
											</div>
										<?php }
										if(!empty($address)){ ?>
											<div class="col-sm-4">
												<b>Адрес:</b>
												<?= $address; ?>
											</div>
										<?php }
										if(!empty($zl_pl)){ ?>
											<div class="col-sm-4">
												<b>Жилая площадь:</b>
												<?= $zl_pl; ?>
											</div>
										<?php }
										if(!empty($et)){ ?>
											<div class="col-sm-4">
												<b>Этаж:</b>
												<?= $et; ?>
											</div>
										<?php }
									?>
								</div>
							</div>
							<?php the_excerpt(); ?>
							<div class="city_item-more">Подобнее</div>
						</a>
					</div>
				<?php endwhile; 
				else: echo '<h2>Извините, ничего не найдено...</h2>'; endif;?>
			</div>
		</div>
	</div>
<?php get_footer(); ?>