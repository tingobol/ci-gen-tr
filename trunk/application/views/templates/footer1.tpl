
</div>
<!-- / content -->
<!-- sidebar -->

<div id="sidebar">
	<ul>
		
		<li>
		
		{if $k_t eq $smarty.const.SABIT_GIRIS_YAPACAK_ADMIN}
		
		{elseif $k_t eq $smarty.const.SABIT_GIRIS_YAPMIS_ADMIN}
		
			<h2>Kategori Yönetimi</h2>
			<ul class="linkcat">			
				<li><a href="{$smarty.const.SAYFA_ADMIN_11}">Kategori Listesi</a></li>
				<li><a href="{$smarty.const.SAYFA_ADMIN_12}">Kategori Ekle</a></li>
			</ul>

			<h2>Yazı Yönetimi</h2>
			<ul class="linkcat">	
				<li><a href="{$smarty.const.SAYFA_ADMIN_21}">Kontrol Bekleyenler</a></li>
			</ul>
		
		{elseif $k_t eq $smarty.const.SABIT_GIRIS_YAPACAK_YAZAR}
		
		{elseif $k_t eq $smarty.const.SABIT_GIRIS_YAPMIS_YAZAR}
		
			<h2>Yazı Yönetimi</h2>
			<ul class="linkcat">		
				<li><a href="{$smarty.const.SAYFA_YAZAR_11}">Yazı Listesi</a></li>
				<li><a href="{$smarty.const.SAYFA_YAZAR_12}">Yazı Ekle</a></li>	
			</ul>
		
		{elseif $k_t eq $smarty.const.SABIT_GIRIS_YAPACAK_EDITOR}
		
		{elseif $k_t eq $smarty.const.SABIT_GIRIS_YAPMIS_EDITOR}

			<h2>Yazı Yönetimi</h2>
			<ul class="linkcat">	
				<li><a href="{$smarty.const.SAYFA_EDITOR_11}">Onay Bekleyenler</a></li>
			</ul>

		{elseif $k_t eq $smarty.const.SABIT_YENI_GELMIS_MISAFIR}

			<h2>Kategoriler</h2>
			<ul class="list-cat">
				{foreach from=$nav_kategoriler->result() item=row}
				<li><a href="{$smarty.const.SAYFA_MISAFIR_31|sprintf:$row->id}">{$row->adi}</a></li>
				{/foreach}
			</ul>
		
			<h2>Kullanıcı Türleri</h2>
			<ul class="linkcat">	
				<li><a href="{$smarty.const.SAYFA_ADMIN_0}">Admin Girişi</a></li>
				<li><a href="{$smarty.const.SAYFA_EDITOR_0}">Editör Girişi</a></li>
				<li><a href="{$smarty.const.SAYFA_YAZAR_0}">Yazar Girişi</a></li>
			</ul>
			
			<h2>Etiket Bulutu</h2>
			<div class="textwidget">{$etiket_bulutu}</div>

		{else}
		
		{/if}
		
		</li>

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
		<div class="alignleft">Tasarım: JustSkins.Com</div>
		<div class="alignright"> <a href="http://validator.w3.org/check?uri=referer" class="valid">XHTML</a> <a href="http://jigsaw.w3.org/css-validator/check?uri=referer" class="valid">CSS</a> <a href="#" class="rss">RSS</a> </div>
	</div>
	<!-- / credits -->
</div>
</body></html>