<div class="blok1">

	<div class="entrytop">
		<div class="entry">
			<h2>Bağlantılar</h2>
		</div>
	</div>
	
	<div class="icerik" id="baglantilar">
	
		<ul>
			<li><a href="{$smarty.const.SAYFA_ADMIN_21}" title="Bekleyen yazı listesine dön.">Listeye Dön</a></li>
			<li><a href="{$smarty.const.SAYFA_ADMIN_23|sprintf:$yazi->id}" onclick="return confirm('Yazı editör kontrolüne gönderilecek! Emin misiniz?');" title="Yazıyı editörün kontrolüne göndermek için|bu bağlantıyı kullanabilirsiniz.">Editör'e Gönder</a></li>
		</ul>
	
	</div>

	<div class="entrytop">
		<div class="entry">
			<h2>Yazı Detayı</h2>
		</div>
	</div>
	
	<div class="icerik">
		
		<table class="tablo2">
			<tbody>
				<tr>
					<td>
						<div class="baslik">ID</div>
						<div class="icerik">{$yazi->id}</div>
					</td>
				</tr>
				<tr>
					<td>
						<div class="baslik">Başlık</div>
						<div class="icerik">{$yazi->baslik}</div>
					</td>
				</tr>
				<tr>
					<td>
						<div class="baslik">Özet</div>
						<div class="icerik">{$yazi->ozet|bbcode_to_html}</div>
					</td>
				</tr>
				<tr>
					<td>
						<div class="baslik">İçerik</div>
						<div class="icerik">{$yazi->icerik|bbcode_to_html}</div>
					</td>
				</tr>
				<tr>
					<td>
						<div class="baslik">Yazı Etiketleri</div>
						<div class="icerik">

							| 
	
							{foreach from=$yazi_etiketleri->result() item=yazi_etiketi}
							
								{$yazi_etiketi->adi} | 
							
							{/foreach}
							
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<div class="baslik">Eklenme Zamanı</div>
						<div class="icerik">{$yazi->eklenme_zamani|date_format:"%e.%m.%Y"}</div>
					</td>
				</tr>
				<tr>
					<td>
						<div class="baslik">Güncellenme Zamanı</div>
						<div class="icerik">{$yazi->guncellenme_zamani|date_format:"%e.%m.%Y"}</div>
					</td>
				</tr>
				<tr>
					<td>
						<div class="baslik">Hit</div>
						<div class="icerik">{$yazi->hit}</div>
					</td>
				</tr>
				<tr>
					<td>
						<div class="baslik">Yazar Adı</div>
						<div class="icerik">{$yazi->yazar_adi}</div>
					</td>
				</tr>
				<tr>
					<td>
						<div class="baslik">Kategori Adı</div>
						<div class="icerik">{$yazi->kategori_adi}</div>
					</td>
				</tr>
			</tbody>
		</table>
		
	</div>

</div>

{literal}
<script type="text/javascript">
	$().ready(function(){$('#baglantilar').ikontooltip();});
</script>
{/literal}