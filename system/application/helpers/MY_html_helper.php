<?php

// yazarların eklediği yazı içeriklerini filtrelemek için kullanılır.
function html_filtrele_1($icerik) {

	return strip_tags($icerik, '<p><br><hr><b><i><u><ul><ol><li><pre><img><table><tr><td><th><thead><tbody><tfoot><code>');
}