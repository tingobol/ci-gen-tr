<div class="blok1">

	<div class="entrytop">
		<div class="entry">
			<h2>İletişim Sayfası</h2>
		</div>
	</div>
	
	<div class="icerik">

		{if $tamam}
		<div class="tamam">{$tamam}</div>
		{else}
		
			{if $hata}
			<div class="hata">{$hata}</div> 
			{/if}
		
			<form action="{$smarty.const.SAYFA_MISAFIR_41}" class="form1" method="post" id="form1">
				
				<p>
					<b>* Konu: </b><br />
					{$html_select_iletisim_konulari}
				</p>
				
				<p>
					<b>* Adınız:</b><br />
					<input type="text" id="adi" name="adi" size="30" maxlength="255" title="Adınızı yazınız." value="{$iletisim_mesaji_mod->adi}" />
				</p>
				
				<p>
					<b>* Mail Adresiniz:</b><br />
					<input type="text" name="mail" size="40" maxlength="255" title="Mail adresinizi yazınız." value="{$iletisim_mesaji_mod->mail}" />
				</p>
				
				<p>
					<b>* Mesajınız:</b><br />
					<textarea name="mesaj" cols="60" rows="10" title="Mesajınızı yazınız. En kısa zamanda|mesajınız kontrol edilecektir.">{$iletisim_mesaji_mod->mesaj}</textarea>
				</p>
				
				<p>
					<input type="submit" value="Gönder" />
				</p>
			
			</form>
			
		{/if}

	</div>

</div>

{literal}
<script type="text/javascript">
	$().ready(function(){$('#form1').formtooltip();});
</script>
{/literal}