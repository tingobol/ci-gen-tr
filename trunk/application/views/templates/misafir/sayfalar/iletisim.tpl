{include file="header1.tpl"}

<div class="blok1">

	<div class="entrytop">
		<div class="entry">
			<h2>İletişim Sayfası</h2>
		</div>
	</div>
	
	<div class="icerik">

		{if $tamam neq ""}
		<div class="tamam">{$tamam}</div>
		{else}
		
			{if $hata neq ""}
			<div class="hata">{$hata}</div> 
			{/if}
		
			<form action="{$smarty.const.SAYFA_MISAFIR_41}" class="form1" method="post" id="form1">
				
				<p>
					<label for="konu_id">* Konu: </label><br />
					<select name="konu_id" title="Mesajınız için bir konu seçiniz.">
					   {html_options values=$konu_ids output=$konu_names selected=$konu_selected_id}
					</select>
				</p>
				
				<p>
					<label for="adi">* Adınız:</label><br />
					<input type="text" name="adi" size="30" maxlength="255" title="Adınızı yazınız." value="{$iletisim_mesaji->adi}" />
				</p>
				
				<p>
					<label for="mail">* Mail Adresiniz:</label><br />
					<input type="text" name="mail" size="40" maxlength="255" title="Mail adresinizi yazınız." value="{$iletisim_mesaji->mail}" />
				</p>
				
				<p>
					<label for="mesaj">* Mesajınız:</label><br />
					<textarea name="mesaj" cols="60" rows="10" title="Mesajınızı yazınız. En kısa zamanda|mesajınız kontrol edilecektir.">{$iletisim_mesaji->mesaj}</textarea>
				</p>
				
				<p>
					<input type="submit" value="Gönder" />
				</p>
			
			</form>
			
		{/if}

	</div>

</div>

<script src="{$smarty.const.DIZIN_URL_2}/js/ckeditor/ckeditor.js" type="text/javascript"></script>

{literal}
<script type="text/javascript">

	CKEDITOR.replace('mesaj', {customConfig: 'tr.gen.ci.js'});

	$().ready(function(){
		$('#form1').formtooltip();	
	});
	
</script>
{/literal}

{include file="footer1.tpl"}	