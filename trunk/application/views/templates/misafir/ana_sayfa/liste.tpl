{include file="header1.tpl"}

{if $yazilar->num_rows() eq 0}

	<div class="post">
		<div class="entrytop">
			<div class="entry">
				<h2>Yazı Bulunmadı</h2>
			</div>
		</div>
		
		<div class="post-content">
			<div class="ikaz">Yazı bulunamadı.</div>
		</div>
	</div>

{else}

	{foreach from=$yazilar->result() item=yazi}
	
		<div class="yazi_ozet">
		
			<div class="entrytop">
				<div class="entry">
				
					<h2><a href="{$smarty.const.SAYFA_MISAFIR_23|sprintf:$yazi->kategori_id:$yazi->id}" rel="bookmark">{$yazi->baslik}</a></h2>
		
				</div>
			</div>			
			
			<div class="post-content">
			
				{$yazi->ozet|bbcode_to_html}
			
			</div>
			
			<div class="alt_bilgi">
				<span class="devami"><a href="{$smarty.const.SAYFA_MISAFIR_23|sprintf:$yazi->kategori_id:$yazi->id}">Devamı</a></span>
				<span class="kategori"><a href="{$smarty.const.SAYFA_MISAFIR_31|sprintf:$yazi->kategori_id}">{$yazi->kategori_adi}</a></span>
				<span class="hit">Okunma: {$yazi->hit}</span>
				<span class="tarih">{$yazi->eklenme_zamani|date_format:"%e.%m.%Y"}</span>
			</div>

		</div>
		
	{/foreach}

		<div class="navigation">
		
			{if $sayfalama_lib->is_eski_kayit_var()} 
			<span class="previous-entries"> 
				<a href="{$smarty.const.SAYFA_MISAFIR_12|sprintf:$sayfalama_lib->get_eski_sayfa()}">Eski Yazılar</a>
			</span>
			{/if}
			
			{if $sayfalama_lib->is_yeni_kayit_var()}
			<span class="next-entries">
			 	<a href="{$smarty.const.SAYFA_MISAFIR_12|sprintf:$sayfalama_lib->get_yeni_sayfa()}">Yeni Yazılar</a>
			</span>
			{/if}
			
		</div>

{/if}

{include file="footer1.tpl"}