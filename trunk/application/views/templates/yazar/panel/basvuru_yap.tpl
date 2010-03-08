{include file="header1.tpl"}

{literal}
<script type="text/javascript">
	$().ready(function(){
		$('#form1').formtooltip();	
	});
</script>
{/literal}

<div class="blok1">

	<div class="entrytop">
		<div class="entry">
			<h2>Yazarlık Başvurusu</h2>
		</div>
	</div>
	
	<div class="icerik">
		
		{if $tamam neq ""}
		<div class="tamam">{$tamam}</div> 
		{else}
		
			{if $hata neq ""}
			<div class="hata">{$hata}</div>
			{/if}
	
			<form action="{$smarty.const.SAYFA_YAZAR_5}" class="form1" method="post" id="form1">
				
				<p>
					<label for="mail">* Adınız:</label>
					<input type="text" name="adi" size="40" maxlength="50" title="Adını yazınız." value="{$kullanici->adi}"></input>
				</p>
				
				<p>
					<label for="mail">* Mail Adresiniz:</label>
					<input type="text" name="mail" size="40" maxlength="50" title="Mail adresinizi yazınız.|Yazarlığınız onaylandığında giriş bilgileriniz|bu mail adresine gönderilecektir." value="{$kullanici->mail}"></input>
				</p>
				
				<p>
					<label for="mail">* Favori Konularınız:</label>
					<textarea rows="6" cols="60" name="favori_konulari" title="Favori konularınızı yazınız.|Ör: PHP, Code Igniter, vs.">{$kullanici->favori_konulari}</textarea>
				</p>
				
				<p>
					<label for="mail">* Referanslarınız:</label>
					<textarea rows="6" cols="60" name="referanslari" title="Referanslarınızı yazınız. Yazarlığınızın onaylanmasında|rol oynayacaktır. Yaptığınız projelerden ve makalelerinizden|bahsedebilirsiniz.">{$kullanici->referanslari}</textarea>
				</p>
	
				<p>
					<label>&nbsp;</label>
					<input type="submit" value="Başvuru Yap"></input>
				</p>
			
			</form>
			
		{/if}

	</div>

</div>

{include file="footer1.tpl"}	