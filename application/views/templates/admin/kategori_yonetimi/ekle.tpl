{include file="header1.tpl"}
	
<div class="blok1">

	<div class="entrytop">
		<div class="entry">
			<h2>Kategori Ekle</h2>
		</div>
	</div>
	
	<div class="icerik">
		
		{if $hata neq ""}
		<div class="hata">{$hata}</div> 
		{/if}

		<form action="{$smarty.const.SAYFA_ADMIN_12}" class="form1" method="post" id="form1">
			
			<p>
				<b>* Adı:</b><br />
				<input type="text" name="adi" size="30" maxlength="50" title="Adını yazınız.|Ör: Kategori Adı" value="{$kategori->adi}" />
			</p>
			
			<p>
				<b>Meta Açıklama:</b><br />
				<input type="text" name="aciklama" size="70" maxlength="255" title="Meta açıklamasını yazınız." value="{$kategori->aciklama}" />
			</p>
			
			<p>
				<b>Meta Arama:</b><br />
				<input type="text" name="arama" size="70" maxlength="25" title="Meta aramasını yazınız." value="{$kategori->arama}" />
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

{include file="footer1.tpl"}	