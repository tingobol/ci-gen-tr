<!--
		<div class="navigation">
			<span class="previous-entries"><a href="http://www.justskins.com/page/2">Previous Entries</a></span>
			<span class="next-entries"></span>
		</div>
		-->
</div>
<!-- / content -->
<!-- sidebar -->

<div id="sidebar">
	<ul>
		<!--
		<li id="text-1" class="widget widget_text">
			<h2 class="sidebartitle">Custom Themes</h2>
			<div class="textwidget">Need a custom theme for your website, blog or forum?
				We create custom skins for Wordpress, vBulletin, Drupal, Joomla and OSCommerce. <strong><a href="http://www.justskins.com/request-quote">Contact
				us for a free quote</a></strong>.<br />
				<br />
				<br />
			</div>
		</li>
		-->
		
		<li>
		
		<?php if (@$k_t == k_t_giris_yapacak_admin) { // admin giriş yapmak isterse ?>
				
		<?php } elseif (@$k_t == k_t_giris_yapmis_admin) { // admin giriş yaptıysa ?>
			<h2>Kategori Yönetimi</h2>
			<ul class="linkcat">			
				<li><?php echo anchor(sayfa_admin_11, 'Kategori Listesi') ?></li>
				<li><?php echo anchor(sayfa_admin_12, 'Kategori Ekle') ?></li>
			</ul>
		<?php } elseif (@$k_t == k_t_giris_yapacak_yazar) { // yazar giriş yapmak isterse ?>

		<?php } elseif (@$k_t == k_t_giris_yapmis_yazar) { // yazar giriş yaptıysa ?>
			<h2>Yazı Yönetimi</h2>
			<ul class="linkcat">			
				<li><?php echo anchor(sayfa_yazar_11, 'Yazı Listesi') ?></li>
				<li><?php echo anchor(sayfa_yazar_12, 'Yazı Ekle') ?></li>
			</ul>
		<?php } elseif (@$k_t == k_t_giris_yapacak_editor) { // editor giriş yapmak isterse ?>

		<?php } elseif (@$k_t == k_t_giris_yapmis_editor) { // editor giriş yaptıysa ?>
			<h2>Yazı Yönetimi</h2>
			<ul class="linkcat">			
				<li><?php echo anchor(sayfa_editor_11, 'Onay Bekleyenler') ?></li>
			</ul>
		<?php } elseif (@$k_t == k_t_yeni_gelmis_misafir) { // misafir ?>
			
			<h2>Kategoriler</h2>
			<ul class="list-cat">
				<?php foreach ($nav_kategoriler->result() as $row) { ?>
				<li><?php echo anchor(sprintf(sayfa_misafir_31, $row->id), $row->adi) ?></li>
				<?php } ?>
			</ul>
		
			<h2>Kullanıcı Türleri</h2>
			<ul class="linkcat">			
				<li><?php echo anchor(sayfa_admin_0, 'Admin Girişi') ?></li>
				<li><?php echo anchor(sayfa_editor_0, 'Editör Girişi') ?></li>
				<li><?php echo anchor(sayfa_yazar_0, 'Yazar Girişi') ?></li>
			</ul>
			
		<?php } else { // diğer durumlarda ?>

		<?php } ?>
		
		</li>
		
		<!--
		<li id="text-2" class="widget widget_text">
			<h2 class="sidebartitle">Products</h2>
			<div class="textwidget">
				<ul class="linkcat">
					<li><a href="http://www.justskins.com/skins/wordpress-themes" title="Wordpress Themes">Wordpress
							Themes</a></li>
					<li><a href="http://www.justskins.com/skins/download-vbulletin-styles" title="vBulletin Styles">vBulletin
							Styles</a></li>
					<li><a href="http://www.justskins.com/skins/invision-board-skins" title="Invision Board Skins">Invision
							Board Skins</a></li>
					<li><a href="http://www.justskins.com/skins/phpbb-skins" title="phpBB Skins">phpBB
							Skins</a></li>
					<li><a href="http://www.justskins.com/skins/css-designs-templates" title="CSS Designs">CSS
							Designs</a></li>
					<li><a href="http://www.justskins.com/skins/yahoo-store-design" title="Yahoo Store Design">Yahoo
							Store Design</a></li>
					<li><a href="http://www.justskins.com/skins/oscommerce-skins" title="OSCommerce Skins">OSCommerce
							Skins</a></li>
					<li><a href="http://www.justskins.com/skins/joomla-templates" title="Joomla Templates">Joomla
							Templates</a></li>
					<li><a href="http://www.justskins.com/skins/mambo-templates" title="Mambo Templates">Mambo
							Templates</a></li>
					<li><a href="http://www.justskins.com/skins/php-nuke-themes" title="PHP-Nuke Themes">PHP-Nuke
							Themes</a></li>
					<li><a href="http://www.justskins.com/skins/postnuke-themes" title="Postnuke Themes">Postnuke
							Themes</a></li>
				</ul>
			</div>
		</li>
		
		<li id="categories-1" class="widget widget_categories">
			<h2 class="sidebartitle">Categories</h2>
			<ul>
				<li class="cat-item cat-item-134"><a href="http://www.justskins.com/themes/apple" title="View all posts filed under Apple">Apple</a> </li>
				<li class="cat-item cat-item-3"><a href="http://www.justskins.com/themes/css-designs" title="View all posts filed under CSS Designs">CSS
						Designs</a> </li>
				<li class="cat-item cat-item-20"><a href="http://www.justskins.com/themes/css-layouts" title="View all posts filed under CSS Layouts">CSS
						Layouts</a> </li>
				<li class="cat-item cat-item-44"><a href="http://www.justskins.com/themes/design" title="View all posts filed under Design">Design</a> </li>
				<li class="cat-item cat-item-74"><a href="http://www.justskins.com/themes/development" title="View all posts filed under Development">Development</a> </li>
				<li class="cat-item cat-item-51"><a href="http://www.justskins.com/themes/drupal" title="View all posts filed under Drupal">Drupal</a> </li>
				<li class="cat-item cat-item-242"><a href="http://www.justskins.com/themes/ecommerce" title="View all posts filed under ecommerce">ecommerce</a> </li>
				<li class="cat-item cat-item-25"><a href="http://www.justskins.com/themes/firefox" title="View all posts filed under firefox">firefox</a> </li>
				<li class="cat-item cat-item-19"><a href="http://www.justskins.com/themes/icons" title="View all posts filed under Icons">Icons</a> </li>
				<li class="cat-item cat-item-55"><a href="http://www.justskins.com/themes/joomla" title="View all posts filed under Joomla">Joomla</a> </li>
				<li class="cat-item cat-item-256"><a href="http://www.justskins.com/themes/linux" title="View all posts filed under linux">linux</a> </li>
				<li class="cat-item cat-item-101"><a href="http://www.justskins.com/themes/myspace" title="View all posts filed under Myspace">Myspace</a> </li>
				<li class="cat-item cat-item-181"><a href="http://www.justskins.com/themes/open-source" title="View all posts filed under Open Source">Open
						Source</a> </li>
				<li class="cat-item cat-item-6"><a href="http://www.justskins.com/themes/oscommerce-skins" title="View all posts filed under OSCommerce Skins">OSCommerce
						Skins</a> </li>
				<li class="cat-item cat-item-24"><a href="http://www.justskins.com/themes/photoshop" title="View all posts filed under PhotoShop">PhotoShop</a> </li>
				<li class="cat-item cat-item-59"><a href="http://www.justskins.com/themes/shopping-carts" title="View all posts filed under Shopping Carts">Shopping
						Carts</a> </li>
				<li class="cat-item cat-item-14"><a href="http://www.justskins.com/themes/tools-utilities" title="View all posts filed under Tools &amp; Utilities">Tools &amp; Utilities</a> </li>
				<li class="cat-item cat-item-1"><a href="http://www.justskins.com/themes/vbulletin-styles-skins" title="Free and Professional vBulletin Styles">vBulletin
						Styles</a> </li>
				<li class="cat-item cat-item-127"><a href="http://www.justskins.com/themes/wallpapers" title="View all posts filed under Wallpapers">Wallpapers</a> </li>
				<li class="cat-item cat-item-176"><a href="http://www.justskins.com/themes/web-internet" title="View all posts filed under Web &amp; Internet">Web &amp; Internet</a> </li>
				<li class="cat-item cat-item-95"><a href="http://www.justskins.com/themes/web-browsers" title="View all posts filed under Web Browsers">Web
						Browsers</a> </li>
				<li class="cat-item cat-item-311"><a href="http://www.justskins.com/themes/windows" title="View all posts filed under Windows">Windows</a> </li>
				<li class="cat-item cat-item-58"><a href="http://www.justskins.com/themes/wordpress" title="View all posts filed under Wordpress">Wordpress</a> </li>
				<li class="cat-item cat-item-48"><a href="http://www.justskins.com/themes/wordpress-plugins" title="View all posts filed under Wordpress Plugins">Wordpress
						Plugins</a> </li>
				<li class="cat-item cat-item-2"><a href="http://www.justskins.com/themes/wordpress-themes" title="View all posts filed under Wordpress Themes">Wordpress
						Themes</a> </li>
				<li class="cat-item cat-item-22"><a href="http://www.justskins.com/themes/xhtml" title="View all posts filed under XHTML">XHTML</a> </li>
			</ul>
		</li>
		<li id="recent-posts" class="widget widget_recent_entries">
			<h2 class="sidebartitle">Recent Posts</h2>
			<ul>
				<li><a href="http://www.justskins.com/development/7-web-design-tutorials-from-psd-to-htmlcss/2262">7
						Web Design Tutorials from PSD to HTML/CSS </a></li>
				<li><a href="http://www.justskins.com/tools-utilities/how-to-install-sweetcron-on-xampp/2261">How
						to install Sweetcron on XAMPP </a></li>
				<li><a href="http://www.justskins.com/wordpress/photo-blog-wordpress-themes/2260">6
						PhotoBlog Portfolio WordPress Themes </a></li>
				<li><a href="http://www.justskins.com/design/10-css-grid-layout-generator/2247">10
						CSS Grid Layout Generators </a></li>
				<li><a href="http://www.justskins.com/development/how-to-backup-of-mysql-database-using-phpmyadmin/2233">How
						To Backup Of MySQL Database Using PhpMyAdmin </a></li>
				<li><a href="http://www.justskins.com/icons/10-excellent-icon-sets/2222">10
						Excellent Icon Sets </a></li>
				<li><a href="http://www.justskins.com/design/5-mac-applications-for-web-and-graphic-design/2207">5
						Mac Applications For Web And Graphic Design </a></li>
				<li><a href="http://www.justskins.com/design/15-stylish-navigation-menus-for-inspiration/2206">15
						Stylish Navigation Menus For Inspiration </a></li>
				<li><a href="http://www.justskins.com/wordpress-plugins/5-useful-wordpress-plugins-for-google-adsense/2202">5
						Useful Wordpress Plugins For Google Adsense </a></li>
				<li><a href="http://www.justskins.com/design/10-useful-css-tips-and-tutorials/2189">10
						Useful CSS Tips And Tutorials </a></li>
				<li><a href="http://www.justskins.com/design/15-inspirational-website-introductions/2135">15
						Inspirational Website Introductions </a></li>
				<li><a href="http://www.justskins.com/wordpress-plugins/15-useful-seo-plugins-for-wordpress/2123">15
						Useful SEO Plugins For Wordpress </a></li>
				<li><a href="http://www.justskins.com/design/10-tutorials-for-advanced-web-designers/2091">10
						Tutorials For Advanced Web Designers </a></li>
				<li><a href="http://www.justskins.com/design/10-useful-text-editor-for-developer/2074">10
						Useful Text Editor For Developer </a></li>
				<li><a href="http://www.justskins.com/design/free-web-based-applications/2084">Free
						Web Based Applications </a></li>
			</ul>
		</li>
		-->
	</ul>
</div>
<!-- / sidebar -->
<hr class="clear" />
</div>
<!-- / page -->
</div>
<!-- / wrapper -->
<div id="footerbg">
	<!-- footer -->
	<div id="footer">
		<hr class="clear" />
	</div>
	<!-- / footer -->
	<!-- credits -->
	<div id="credits">
		<div class="alignleft">Tasarım: JustSkins.Com | {elapsed_time} sn.</div>
		<div class="alignright"> <a href="http://validator.w3.org/check?uri=referer" class="valid">XHTML</a> <a href="http://jigsaw.w3.org/css-validator/check?uri=referer" class="valid">CSS</a> <a href="#" class="rss">RSS</a> </div>
	</div>
	<!-- / credits -->
</div>
</body></html>