<?php get_header(); /* TEMPLATE NAME: Home */ ?>

	<div class="container">
		<div class="city in">
			<div class="block__title">Города</div>
			<div class="row">
				<?php
				$city_rows = get_terms([
					'taxonomy'     => 'ndcity',
				]);
				foreach ($city_rows as $city_row) {
					$link = get_term_link($city_row->term_id); ?>
				
					<div class="col-sm-3">
						<a href="<?= $link; ?>" class="city_item">
							<div class="city_item-image">
								<img src="<?php the_field('image','ndcity_' . $city_row->term_id . '', $city_row->term_id); ?>" alt="">
							</div>
							<div class="city_item-title"><?= $city_row->name; ?></div>
							<?php the_field('text','ndcity_' . $city_row->term_id . '', $city_row->term_id); ?>
							<div class="city_item-more">Подобнее</div>
						</a>
					</div>

				<?php } ?>
			</div>
		</div>
		<div class="nd in">
			<div class="block__title">Последние объекты</div>
			<div class="row">
				<?php 

				$args = [
					'post_type'=> 'nd',
					'posts_per_page' => 6,
					'order'=> 'date'
				];

				$query = new WP_Query($args);
				while ( $query->have_posts() ) { $query->the_post(); ?>

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

				<?php } wp_reset_query();?>	
			</div>
		</div>
		<div class="in">
			<form method="post" class="nd_form">
				<div class="block__title">Форма заполнения</div>
				<div class="form-row">
					<input type="text" name="title" placeholder="Наименование: ">
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="form-row">
							<select name="type">
								<option value="0">Выбрать тип</option>
								<?php 
								$type_rows = get_terms([
									'taxonomy'     => 'ndcat',
								]);
								foreach ($type_rows as $typ_rows) { ?>
									<option value="<?= $typ_rows->term_id; ?>"><?= $typ_rows->name; ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-row">
							<select name="city">
								<option value="0">Выбрать город</option>
								<?php foreach ($city_rows as $city_row) { ?>
									<option value="<?= $city_row->term_id; ?>"><?= $city_row->name; ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
				</div>
				<div class="form-row">
					<input type="text" name="pl" placeholder="Площадь: ">
				</div>
				<div class="form-row">
					<input type="text" name="price" placeholder="Цена: ">
				</div>
				<div class="form-row">
					<input type="text" name="address" placeholder="Адрес: ">
				</div>
				<div class="form-row">
					<input type="text" name="zh_pl" placeholder="Жилая прощадь: ">
				</div>
				<div class="form-row">
					<input type="text" name="et" placeholder="Этаж: ">
				</div>
				<button>Сохранить</button>
				<div class="umessage"></div>
			</form>
		</div>

	</div>

<?php get_footer(); ?>