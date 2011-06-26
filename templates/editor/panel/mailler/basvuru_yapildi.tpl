{literal}
<style>

body, p { font-family: Arial; font-size:13px; line-height:20px; }

</style> 
{/literal} 

<p>Merhaba <b>{$admin->adi}</b>,</p>

<p>Yeni editör başvurusu yapıldı. Detaylar;</p>
<hr />
<table style="border-collapse: collapse;">
	<tr>
		<th style="text-align: right; padding: 6px; min-width: 160px;">Editörün Adı: </th>
		<td>{$editor_mod->adi}</td>
	</tr>
	<tr>
		<th style="text-align: right; padding: 6px; min-width: 160px;">Mail Adresi: </th>
		<td>{$editor_mod->mail}</td>
	</tr>
	<tr>
		<th style="text-align: right; padding: 6px; min-width: 160px;">Referansları: </th>
		<td>{$editor_mod->referanslari}</td>
	</tr>
</table>
<hr />
<p><a href="{$url2}">Admin Sayfası</a></p>