{include file="header1.tpl"}
	
<div class="yazi">

	<div class="entrytop">
		<div class="entry">
		
			<h2>{$yazi->baslik}</h2>

		</div>
	</div>			
	
	<div class="post-content">
	
		{$yazi->ozet}
		{$yazi->icerik}
	
	</div>
	
	<div class="alt_bilgi">
	
		<span class="kategori">Kategori: <a href="{$smarty.const.DIZIN_URL_21}/{$yazi->kategori_id}">{$yazi->kategori_adi}</a></span>
		<span class="tarih">Eklenme: {$yazi->eklenme_zamani|date_format:"%e.%m.%Y"}</span>
		{if $yazi->eklenme_zamani < $yazi->guncellenme_zamani} 
		<span class="tarih">Güncellenme: {$yazi->guncellenme_zamani|date_format:"%e.%m.%Y"}</span>
		{/if}
		<span class="hit">Okunma: {$yazi->hit}</span>
		<span class="taglar">Etiketler: 
		{foreach from=$yazi_etiketleri->result() item=yazi_etiketi}
			<a href="#">{$yazi_etiketi->adi}</a>
		{/foreach}
		</span>
		
	</div>
	
</div>

{include file="footer1.tpl"}