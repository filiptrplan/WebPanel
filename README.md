# Web Panel
### Description
This is a web panel that is meant for managing users of a specific software. By default it includes a web panel from where you can add, remove and ban users. There is also an HWID field that can be customized but as this panel is meant mostly for software owners it is included by default.

<!-- TOC -->

- [Web Panel](#web-panel)
    - [Description](#description)
    - [Installation](#installation)
    - [Usage](#usage)
    - [Credits](#credits)
    - [License](#license)
    - [Changelog](#changelog)

<!-- /TOC -->

### Installation
 - Download the repository to your computer
 - Next you should open the SQL admin panel of your choice. The most popular is phpMyAdmin, therefore I will be providing the instructions for this one:
    - Open up your phpMyAdmin panel.
    - On the lefthand side select the database you created or create one now.
    - Select the `Import` option on the top navigation bar.
    - Click `Choose a file` and then select the `db.sql` found in the root directory of the repository
    - Lastly click `Go` on the bottom of the page
    - Done!
  - After that you should configure the `db.ini` file found in the `WebPanel\inc` folder of the repository:
    - Keep the `host` as `localhost`
    - Change the `db_name` field to the name of the database you selected earlier. Disclaimer: You shoud change the `test` and leave the quotes.
    - Change the `username` field to the username of your database account. Make sure it has `UPDATE`, `INSERT`, `SELECT` and `DELETE` privileges.
    - Change the `password` field to the password of your database account.
  - The last step is uploading the `WebPanel` folder to your webhost. This is usually done by using a FTP client like [FileZilla](https://filezilla-project.org/).
- This step is not mandatory but **HIGHLY RECOMMENDED**:
  - It involves changing the permission of the `db.ini` file.
  - After you uploaded the file to your webhost you should change its permissions.
  - If you are using FileZilla use [this tutorial](http://www.dummies.com/web-design-development/wordpress/navigation-customization/how-to-change-file-permissions-using-filezilla-on-your-ftp-site/) and set the numeric permission to `770` or if you are using the linux command line navigate to the `WebPanel/inc` folder and execute `sudo chmod 770 db.ini`.

### Usage
The project is quite straightforward to use. In order to login use the username `admin` and password `admin` on the `login.php` page. On the lefthand side there is a navigation menu where you can find links to the various pages. 

If you want to remove a user you have to first ban them and then you go to the banned users section and remove them.
It is recommended that you create your own user account on the add user page and give it a type of 100. After that you should delete the default `admin` account.

![Screenshot](https://i.imgur.com/Ouu5bQ8.png)
![Screenshot](https://i.imgur.com/oxgCISi.png)
![Screenshot](https://i.imgur.com/MxGvOK6.png)
![Screenshot](https://i.imgur.com/2L0e1nz.png)

### Credits
Currently all credit goes to me 1234filip aka. Fomic

### License
This project is licensed under the MIT license. It is included in the `LICENSE` file.

### Changelog
[Click here to open the changelog](CHANGELOG.md)