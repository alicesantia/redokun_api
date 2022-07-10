DB 
Run script redokun_db.sql (in folder redokun) to create db.
Table call_attempts will contain info of api calls.
Table service contains number of calls allowed for each method. You may change the limit but shouldn't change the code.

GET CALLS
http://redokun.local/rest_api/get
If call number exceeds limit you will get a "429 TOO MANY REQUESTS" header.

http://redokun.local/rest_api/post
You may try calling the wrong method, returned header will be "400 BAD REQUEST".

POST CALLS
http://redokun.local/welcome
Click button to make post calls.
If call number exceeds limit you will get a "429 TOO MANY REQUESTS" header.

PROJECT STRUCTURE
Controller Welcome.php: simply loads view welcome_message.php to make post calls.
Controller Rest_api.php: post and get methods are here.
Library Rest_server.php: the core logic for rate limiting.
Library Rest_db.php: utility class for db operations.


