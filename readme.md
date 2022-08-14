### Simple Authenticating Application

This is a template for using the DVC Framework

## Features
1. Quick to setup - easy PHP development environment
1. Simple Authenticating System
1. SQLite3
1. Clean URL's

## Running this demo
1. Creates a SQLite3 database
2. Populates it with basic data
3. **DOES NOT** lock down the system
   * but if you
     1. select settings > lockdown and save
     2. logout (button, top right)
     3. you will require a username/password to gain access (default **admin/admin**)


## Installation

```bash
git clone https://github.com/bravedave/dvc-auth.git dvcauth
cd dvcauth
composer u
```

* you will have just received an error because no database is specified

```
mv application/data/defaults-sample.json application/data/defaults.json
```

then update and run
```
composer u
./run.sh
```
