{include file="header1.tpl"}

{if $yazilar eq ""}

	<div class="post">
		<div class="entrytop">
			<div class="entry">
				<h2>Yazı Bulunmadı</h2>
			</div>
		</div>
		
		<div class="post-content">
			<div class="bilgi">Yazı bulunamadı.</div>
		</div>
	</div>

{else}

	{foreach from=$yazilar->result() item=yazi}
	
		<div class="post">
		
			<div class="entrytop">
				<div class="entry">
				
					<h2><a href="{$smarty.const.SAYFA_MISAFIR_23|sprintf:$yazi->id}" rel="bookmark">{$yazi->baslik}</a></h2>
		
				</div>
			</div>			
			
			<div class="post-content">
			
				{$yazi->ozet}
			
			</div>
			
			<div class="post-info">
				<span class="yazi-devami"><a href="{$smarty.const.SAYFA_MISAFIR_23|sprintf:$yazi->id}">Devamı</a></span>
				<span class="yazi-kategori"><a href="{$smarty.const.DIZIN_URL_21}/{$yazi->kategori_id}">{$yazi->kategori_adi}</a></span>
				<span class="yazi-hit">Okunma: {$yazi->hit}</span>
				<span class="yazi-tarih">{$yazi->eklenme_zamani|date_format:"%e.%m.%Y"}</span>
			</div>
			
			<!-- 
			<div class="post-info">
				<span class="post-cat"><a href="">sadasd</a></span> <span class="post-comments"><a href="http://www.justskins.com/development/7-web-design-tutorials-from-psd-to-htmlcss/2262#comments" title="Comment on 7 Web Design Tutorials from PSD to HTML/CSS">1 Comment &#187;</a></span>
			</div>
			 -->
		</div>
		
	{/foreach}

		<div class="navigation">
			<span class="previous-entries"> 
				 
				{if $sayfalama_lib->is_eski_kayit_var()} 
					<a href="{$smarty.const.DIZIN_URL_12}/{$sayfalama_lib->get_eski_sayfa()}">Eski Yazılar</a>
				{/if}
				
			</span>
			<span class="next-entries">
			
				{if $sayfalama_lib->is_yeni_kayit_var()} 
					<a href="{$smarty.const.DIZIN_URL_12}/{$sayfalama_lib->get_yeni_sayfa()}">Yeni Yazılar</a>
				{/if}
				
			</span>
		</div>

{/if}

{include file="footer1.tpl"}