<div class="blok1">

	<div class="entrytop">
		<div class="entry">
			<h2>Kategori Ekle</h2>
		</div>
	</div>
	
	<div class="icerik">
		
		{if $hata}
		<div class="hata">{$hata}</div> 
		{/if}

		<form action="{$smarty.const.SAYFA_ADMIN_12}" class="form1" method="post" id="form1">
			
			<p>
				<b>* Adı:</b><br />
				<input type="text" name="adi" size="30" maxlength="50" title="Adını yazınız.|Ör: Kategori Adı" value="{$kategori_mod->adi}" />
			</p>
			
			<p>
				<b>Meta Açıklama:</b><br />
				<input type="text" name="meta_aciklama" size="70" maxlength="255" title="Meta açıklamasını yazınız." value="{$kategori_mod->meta_aciklama}" />
			</p>
			
			<p>
				<b>Meta Arama:</b><br />
				<input type="text" name="meta_arama" size="70" maxlength="255" title="Meta aramasını yazınız." value="{$kategori_mod->meta_arama}" />
			</p>
	
			<p>
				<input type="submit" value="Ekle" />
			</p>

		</form>

	</div>

</div>

{literal}
<script type="text/javascript">
	$().ready(function(){$('#form1').formtooltip();});	
</script>
{/literal}