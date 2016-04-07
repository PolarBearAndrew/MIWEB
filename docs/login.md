
### POST /v1/login.php

* 登入驗證

#### params

name | type | desc
---- | ---- | ----
account | string, isRequired | 使用者帳號
password | string, isRequired | 使用者密碼

#### returns

name | desc
---- | ----
login | 是否登入成功
message | 成功/失敗訊息

``` js
{
	login : true,
	message :'Login success'
}
```
