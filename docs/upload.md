
### POST /v1/upload.php

* 上傳檔案

#### params

name | type | desc
---- | ---- | ----
file | file | 需要上傳的檔案

#### file.types

* 允許的檔案類別

type | desc
---- | ----
.jpg |
.jpeg |
.png |
.gif | ...

#### returns

name | desc
---- | ----
檔案案路徑 | 記得測試看看怎麼取用

``` js
{
	path : "/images/Art.jpg"
}
```
