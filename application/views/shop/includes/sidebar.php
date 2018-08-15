<div class="sidebar hidden-after-desk">
	<h2 class="title-sidebar">SHOP CATEGORIES</h2>
	<div class="category-menu-area sidebar-section-margin" id="category-menu-area">
		<ul>
            <?php foreach($categories as $category): ?>
                <li>
                    <a href="<?php echo BASE_URL() . 'shop/cat/' . $category->id ;?>'">
                        <?php echo $category->name; ?>
                    </a>
                </li>
            <?php endforeach;?>
		</ul>
	</div>
</div>
