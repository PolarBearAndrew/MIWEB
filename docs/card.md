
### GET /v1/card_document_list.php

* 需要登入
* 取得該使用者的作品清單
* 會自動取動登入的使用者 id

#### params

* `memberid` 使用登入儲存在後端的登入者 id

#### returns

* 回傳的欄位名稱跟官方的 shcema 一模一樣, 故此請參閱官方文件

name | desc
---- | ----
page[] | ...
text[] | ...

``` js
{
	"page": [
		{
			"text": [
				{
					"textid": 1,
					"objectid": 64,
					"pageid": 1,
					"name": "华擎数字科技有限公司",
					"objectheight": 60,
					"objectwidth": 483,
					"objectxpos": 278,
					"objectypos": 70,
					"text": "华擎数字科技有限公司",
					"charfont": "HYJinKaiJ.ttf",
					"charsize": 44,
					"charcolor": "rgb(0,0,0)",
					"charstrokesize": 0,
					"charstrokecolor": "ffffff",
					"charalign": 0,
					"charbold": 0,
					"charitalic": 0,
					"objectkey": 1,
					"zindex": 501,
					"rotation": 0,
					"objectwarning": 0
				},
				{
					// ....
				}
			]
		}
	]
}
```

************

### GET /v1/card_document_list.php

* 需要登入
* 取得該使用者的作品清單
* 會自動取動登入的使用者 id

#### params

* `memberid` 使用登入儲存在後端的登入者 id

#### returns

* 回傳的欄位名稱跟官方的 shcema 一模一樣, 故此請參閱官方文件

name | desc
---- | ----
page[] | ...
text[] | ...

``` js
{
	"page": [
		{
			"text": [
				{
					"textid": 1,
					"objectid": 64,
					"pageid": 1,
					"name": "华擎数字科技有限公司",
					"objectheight": 60,
					"objectwidth": 483,
					"objectxpos": 278,
					"objectypos": 70,
					"text": "华擎数字科技有限公司",
					"charfont": "HYJinKaiJ.ttf",
					"charsize": 44,
					"charcolor": "rgb(0,0,0)",
					"charstrokesize": 0,
					"charstrokecolor": "ffffff",
					"charalign": 0,
					"charbold": 0,
					"charitalic": 0,
					"objectkey": 1,
					"zindex": 501,
					"rotation": 0,
					"objectwarning": 0
				},
				{
					// ....
				}
			]
		}
	]
}
```

**************

### GET /v1/card_document_show.php

* 需要登入
* 取得該使用者的指定作品
* 會自動取動登入的使用者 id

#### params

* `memberid` 使用登入儲存在後端的登入者 id

name | type | desc
---- | ---- | ----
documentid | number, require | document.id

#### returns

* 回傳的欄位名稱跟官方的 shcema 一模一樣, 故此請參閱官方文件

name | desc
---- | ----
page[] | ...
text[] | ...

``` js
{
	"page": [
		{
			"text": [
				{
					"textid": 1,
					"objectid": 64,
					"pageid": 1,
					"name": "华擎数字科技有限公司",
					"objectheight": 60,
					"objectwidth": 483,
					"objectxpos": 278,
					"objectypos": 70,
					"text": "华擎数字科技有限公司",
					"charfont": "HYJinKaiJ.ttf",
					"charsize": 44,
					"charcolor": "rgb(0,0,0)",
					"charstrokesize": 0,
					"charstrokecolor": "ffffff",
					"charalign": 0,
					"charbold": 0,
					"charitalic": 0,
					"objectkey": 1,
					"zindex": 501,
					"rotation": 0,
					"objectwarning": 0
				},
				{
					// ....
				}
			]
		}
	]
}
```

*************

### GET /v1/card_layout_show.php

* 取得指定的 layout
* 這個並沒有檢查是否登入
* 就是這樣~喵~

#### params

none

#### returns

``` js

// ...

```
