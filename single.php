<?php get_header(); // Подключаем хедер?> 
	<div class="in">
		<div class="container">
			<h1 class="block__title"><?php the_title(); ?></h1>
			<?php $gallery_rows = get_field('gallery');
			if (!empty($gallery_rows)) { ?>
			 	<div class="nd_gallery">
			 		<?php foreach ($gallery_rows as $gallery_row){ ?>
			 			<img src="<?= $gallery_row['gallery_image']; ?>" alt="">
			 		<?php } ?>
			 	</div>
			<?php } ?>
			<div class="nd_app">
				<div class="row">
					<?php 
						$pl = get_field('pl');
						$price = get_field('price');
						$address = get_field('address');
						$zl_pl = get_field('zl_pl');
						$et = get_field('et');

						if(!empty($pl)){ ?>
							<div class="col-sm-2">
								<b>Площадь:</b>
								<?= $pl; ?>
							</div>
						<?php }
						if(!empty($price)){ ?>
							<div class="col-sm-2">
								<b>Цена:</b>
								<?= $price; ?>
							</div>
						<?php }
						if(!empty($address)){ ?>
							<div class="col-sm-2">
								<b>Адрес:</b>
								<?= $address; ?>
							</div>
						<?php }
						if(!empty($zl_pl)){ ?>
							<div class="col-sm-2">
								<b>Жилая площадь:</b>
								<?= $zl_pl; ?>
							</div>
						<?php }
						if(!empty($et)){ ?>
							<div class="col-sm-2">
								<b>Этаж:</b>
								<?= $et; ?>
							</div>
						<?php }
					?>
				</div>
			</div>
			<?php if ( have_posts() ) while ( have_posts() ) : the_post();  ?>
				<?php the_content(); ?>
			<?php endwhile;  ?>
		</div>
	</div>
<?php get_footer(); // Подключаем футер ?>