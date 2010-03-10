{include file="header1.tpl"}

<div class="blok1">

	<div class="entrytop">
		<div class="entry">
			<h2>Editörlük Başvurusu</h2>
		</div>
	</div>
	
	<div class="icerik">
		
		{if $tamam neq ""}
		<div class="tamam">{$tamam}</div> 
		{else}
		
			{if $hata neq ""}
			<div class="hata">{$hata}</div>
			{/if}
	
			<form action="{$smarty.const.SAYFA_EDITOR_5}" class="form1" method="post" id="form1">
				
				<p>
					<label for="adi">* Adınız:</label><br />
					<input type="text" name="adi" size="40" maxlength="50" title="Adını yazınız." value="{$kullanici->adi}"></input>
				</p>
				
				<p>
					<label for="mail">* Mail Adresiniz:</label><br />
					<input type="text" name="mail" size="40" maxlength="50" title="Mail adresinizi yazınız.|Yazarlığınız onaylandığında giriş bilgileriniz|bu mail adresine gönderilecektir." value="{$kullanici->mail}"></input>
				</p>
				
				<p>
					<label for="referanslari">* Referanslarınız: </label><br />
					<label class="aciklama">
					Referanslarınızı yazınız. Yazarlığınızın onaylanmasında
					rol oynayacaktır. Yaptığınız projelerden ve makalelerinizden
					bahsedebilirsiniz.
					</label>
					<textarea rows="6" cols="60" name="referanslari">{$kullanici->referanslari}</textarea>
					
				</p>
	
				<p>
					<input type="submit" value="Başvuru Yap"></input>
				</p>
			
			</form>
			
		{/if}

	</div>

</div>

<script src="{$smarty.const.DIZIN_URL_2}/js/ckeditor/ckeditor.js" type="text/javascript"></script>

{literal}
<script type="text/javascript">

	CKEDITOR.replace('referanslari', {customConfig: 'tr.gen.ci.js'});

	$().ready(function(){$('#form1').formtooltip();});
	
</script>
{/literal}

{include file="footer1.tpl"}	