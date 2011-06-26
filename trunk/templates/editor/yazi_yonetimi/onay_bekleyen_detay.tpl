<div class="blok1">

	<div class="entrytop">
		<div class="entry">
			<h2>Kontrol Bağlantıları</h2>
		</div>
	</div>
	
	<div class="icerik" id="baglantilar">
	
		<ul>
			<li><a href="{$smarty.const.SAYFA_EDITOR_11}" title="Bekleyen yazı listesine dön.">Listeye Dön</a></li>
			<li><a href="{$smarty.const.SAYFA_EDITOR_13|sprintf:$yazi->id}" onclick="return confirm('Yazı onaylanacak ve üye bilgilendirilecek! Emin misiniz?');" title="Yazı sitede yayınlanmaya başlar.">Yayınla</a></li>
			<li><a href="{$smarty.const.SAYFA_EDITOR_14|sprintf:$yazi->id}" onclick="return confirm('Yazıyı adminler inceleyecek! Emin misiniz?');" title="Yazıyı adminlerin incelemesini istiyorsanız|bu bağlantıyı kullanabilirsiniz. İncelendikten|sonra editör onayına sunuculacak.">Admin İncelemesine Gönder</a></li>
			<li><a href="{$smarty.const.SAYFA_EDITOR_15|sprintf:$yazi->id}" onclick="return confirm('Yazıyı, yazan yazar inceleyecek! Emin misiniz?');" title="Yazıyı yazan kişiden, yazısını incelemesini ve|değişiklik yapmasını istemek için bu bağlantıyı|kullanabilirsiniz.">Yazar İncelemesine Gönder</a></li>
		</ul>
	
	</div>

	<div class="entrytop">
		<div class="entry">
			<h2>Onay Bekleyen Yazı Detayı</h2>
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