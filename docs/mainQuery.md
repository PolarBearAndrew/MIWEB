
*** 這寫法有點 hack, 不要亂學~"~, prototype 的暫時性解法而已 ***

### GET /v1/mainQuery.php

* 能 Query 任何你想要的表格的資料
* 所以依照這樣, 整個資料庫的資料都能取得了

#### params

name | type | desc
---- | ---- | ----
{field} | string | 想要取得的欄位, 值請塞 `true`,
table | string, isRequired | 來源表格
where[{field}] | string | where 條件

{field} 可以填入任何該表格的欄位值

#### example

key | value
---- | ----
documentid | true
table | document_page
where[document_page] | 1

#### example.returns

``` js
{
	data : [
			{
				documentid : 1
			}
		]
	}
```
