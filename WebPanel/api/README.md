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
The usage is very simple. Just make a POST or GET request to the `login.php` file in its respective folder. You should include an `username`, `password` and `hwid` parameters that contain the username, password and HWID respectively. The API will fire the `checkLogin` function which in return will fire the `encrypt` function that spits out the appropriate response.

*Disclaimer*: The last 3 digits of the response are the user type. If the type is less than 3 digits, it is padded with zeros to fill it. If the user doesn't exist/he has the wrong HWID the last 3 digits are always `000`.