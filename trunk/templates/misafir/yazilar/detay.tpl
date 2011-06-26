<div class="yazi">

	<div class="entrytop">
		<div class="entry">
		
			<h2>{$yazi->baslik}</h2>

		</div>
	</div>			
	
	<div class="post-content">
	
		{$yazi->ozet|bbcode_to_html}
		{$yazi->icerik|bbcode_to_html}
	
	</div>
	
	<div class="alt_bilgi">
	
		<span class="kategori">Kategori: <a href="{$smarty.const.SAYFA_MISAFIR_31|sprintf:$yazi->kategori_id}">{$yazi->kategori_adi}</a></span>
		<span class="tarih">Eklenme: {$yazi->eklenme_zamani|date_format:"%e.%m.%Y"}</span>
		{if $yazi->eklenme_zamani < $yazi->guncellenme_zamani} 
		<span class="tarih">Güncellenme: {$yazi->guncellenme_zamani|date_format:"%e.%m.%Y"}</span>
		{/if}
		<span class="hit">Okunma: {$yazi->hit}</span>
		<span class="taglar">Etiketler: 
		{foreach from=$yazi_etiketleri->result() item=yazi_etiketi}
			<a href="{$smarty.const.SAYFA_MISAFIR_51|sprintf:$yazi_etiketi->id}">{$yazi_etiketi->adi}</a>
		{/foreach}
		</span>
		
	</div>
	
</div>