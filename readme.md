### DVC Simple Authenticating Template

This is a template for using the DVC Framework

## Running this demo
1. Creates a SQLite3 database
2. Populates it with basic data
3. **DOES NOT** lock down the system
   * but if you select settings > lockdown and save
     * you will require a username/password to gain access
     * default user/pass = **admin** / **admin**

## Install
To use DVC on a Windows 10 computer (Devel Environment)
1. Install PreRequisits
   * Install PHP : http://windows.php.net/download/
      * Install the non threadsafe binary
   * Install Git : https://git-scm.com/
   * Install Composer : https://getcomposer.org/
1. Clone or download this repo
   * MD C:\Data\
   * CD C:\Data
   * clone:
      * git clone https://github.com/bravedave/dvc-auth
   * or download as zip and extract
      * https://github.com/bravedave/dvc-auth/archive/master.zip
1. optionally change the name and change to the folder
   * cd dvc-auth
1. run *composer install*

To run the demo
   * Review the run.cmd
