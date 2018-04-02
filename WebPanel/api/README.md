# API Documentation
### Description
Hello! This is meant mostly for developers that want to authenticate the users of this web panel and database with their external applications.

### Installation
- Make sure you follow the `README` of the main WebPanel so you can setup the database and other things.
- Choose one:
  - POST request
  - GET request
- When you chose the one you want to use for your authentication delete the folder of the one you won't use(`get` or `post` folder)
- This last step is not mandatory but **HIGHLY RECOMMENDED**! You should change the `encrypt` function of the `Api` class. This function is meant to provide an unique reponse to each request. It serves to make your API/program harder to reverse engineer. There are two comments in it. I implore you to replace the code between those two. It is for your own security, not mine. You should write something that scrambles the response enough to make it hard for crackers to crack. Also, you should keep in mind that you will have to recreate that function in your own program.

### Usage
##### Auth key
There is a `checkAuthKey` function which is run every time you make a request. It accepts 2 arguments: the key from the request and the params. Params differ from function to function(ex. `checkLogin` and `registerUser` have diffrent ones). Then it compares the requested key with the expected output which is:
```php
$authkey = Config::get('api_authkey'); // This is the api_authkey variable in config.ini file
return encrypt($authkey . $params);
```
If the requested key and the output match it returns true, otherwise it returns false.
**IMPORTANT**: You should change the `api_authkey` option in the `WebPanel/config/config.ini` file!
##### Register.php
 - The template for `$params` in the `checkAuthKey` function is:
```php
$params = $username . $password;
```
 - Make a post or get request with `username`, `password` and `authkey`.
 - You will get a response that was processed with the `encrypt` function.
 - The template for the output is: 
```php
encrypt($status);
```
 - The `status` can be:
   - `taken` - The username is taken
   - `invalidkey` - The auth key is invalid
   - `error` - Unkown error
   - `success` - Success!

##### Login.php
 - The template for `$params` in the `checkAuthKey` function is:
```php
$params = $username . $password . $hwid;
```
 - Make a post or get request with `username`, `password`, `hwid` and `authkey`.
 - You will get a response that was processed with the `encrypt` function.
 - The template for the output is: 
```php
$paddedtype = '001'  //This is a dynamic variable. Here is just an example.
encrypt($username . $hwid . $status) . $paddedtype;
```
 - The `status` can be:
   - `wronghwid` - The HWID doesn't match the one in the DB
   - `invalidkey` - The auth key is invalid
   - `banned` - The user is banned
   - `invaliduserpass` - The username or password is invalid
   - `success` - Success!
*Disclaimer*: The last 3 digits of the response(`$paddedtype`) are the user type. If the type is less than 3 digits, it is padded with zeros to fill it. If the user doesn't exist/he has the wrong HWID the last 3 digits are always `000`.