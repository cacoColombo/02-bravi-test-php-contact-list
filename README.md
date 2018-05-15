# Setup

* Import database file (bravi_contact_list.sql)
* Serve the application

Using your favorite API development enviroment.

* Set headers

`Content-Type`   : `x-www-form-urlencoded`
`Client-Service` : `frontend-client`
`Auth-Key`       : `bravi`



List of the API :

Authentication:
`[POST]` `/auth/login?username=admin&password=Admin123$`

* Set headers again
`Authentication` : `<token>`
`User-ID`        : `<id>`

List all contacts:
`[GET]` `/contacts/list`

Show all contact information:
`[GET]` `/contacts/list/detail/<contact_id>`

Add new contact:
`[POST]` `/contacts/add` json `{ "name" : "<name>", "nickname" : "<nickname>"}`

Add new contact info:
`[POST]` `/contacts/addinfo/<contact_id>` json `{ "description" : "<description>", "value" : "<value>"}`

Update contact:
`[PUT]` `/contacts/update/<contact_id>` json `{ "name" : "<name>", "nickname" : "<nickname>"}`

Update contact info:
`[PUT]` `/contacts/updateinfo/<contact_info_id>` json `{ "description" : "<description>", "value" : "<value>"}`

Delete contact:
`[DELETE]` `/contacts/delete/<contact_id>`

Delete contact info:
`[DELETE]` `/contacts/deleteinfo/<contact_info_id>`

`[POST]` `/auth/logout`
