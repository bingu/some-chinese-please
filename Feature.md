#Some Chinese Please的特点

# Introduction #

在WordPress blog系统下，有90%+的Spam是由英文字母和拉丁字母组成。

通常情况下，用中文写作的blog，其留言、trackback和pingback应该也是包含中文字的。
那么，只要拦截下不包含中文字的留言、trackback和pingback，那么blog接收到spam的概率将大大降低，接近于0。

SCP在留言、trackback和pingback发送到blog时，保存到数据库前，将检查他们是否包含有中文字。
如有，将通过检查保存到数据库中；如没有，将拦截，并返回出错的字句，而且将不保存到数据库中。