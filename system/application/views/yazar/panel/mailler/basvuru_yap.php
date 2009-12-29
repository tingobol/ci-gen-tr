<style>

body, p {
	font-family: Arial;
	font-size:13px;
	line-height:20px;
}

</style>

<p>Merhaba <b><?php echo $kullanici->adi ?></b></p>

<p>
Yazarlık başvurunuz kaydedilmiştir. En kısa zamanda 
yöneticilerimiz tarafından incelenecektir. 
</p>
<p>
Yazarlığınız onaylandığında size mail ile bilgilendirme 
yapacağız. Bu bilgilendirmede yazar girişi yapmanız için 
gerekli bilgileri bulacaksınız.
</p>
<p>
İlginiz için teşekkür ederiz.
</p>

<p><?php echo anchor(site_url(), site_url()) ?> </p>