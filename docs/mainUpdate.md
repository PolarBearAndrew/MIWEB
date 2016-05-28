
用法與 mainQuery 相同

### POST /v1/mainQuery.php

* 能 Query 任何你想要的表格的資料
* 所以依照這樣, 整個資料庫的資料都能取得了

#### params

name | type | desc
---- | ---- | ----
{field} | string | 想要取得的欄位, 值請塞 `true`,
table | string, isRequired | 更新表格
where[{field}] | string | where 條件

{field} 可以填入任何該表格的欄位值

#### example

key | value
---- | ----
documentid | true
table | documents
where[document_page] | 1

#### example.returns

``` js
{
	data : true
}
```
