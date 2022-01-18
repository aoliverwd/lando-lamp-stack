# Lando - WordPress LAMP Stack

## Local Development Environment

Local development environment is handled via [Lando](https://lando.dev/). Lando documentation can be viewed [here](https://docs.lando.dev/)

### Setup, install and run Lando

### 1. Environment Variables

1. Save `dotenv-example` as `.env` in the same root folder.
2. Open `.env` file and amend vales. For database credentials please refer to the lando [lamp documentation](https://docs.lando.dev/config/lamp.html#connecting-to-your-database) or use the below:

```
DB_HOST=database
DB_PASSWORD=lamp
DB_NAME=lamp
DB_USER=lamp
```

### 2. Configure Lando

Lando configuration can be amended via the `.lando.yml` file. For more information on configureing the Lando development environment please refer to the [Lando documentation](https://docs.lando.dev/basics/first-app.html#hello-world).

If Lando is not installed, head over to [Lando documentation](https://docs.lando.dev/basics/installation.html#system-requirements) for system requirements and installation instructions

### 3. Run Lando

Once configured cd into the project directory. Lando can be ran via the below CLI command:

```
lando start
```

After a successful start up you should see something similar to the below:

```
 NAME             website-local                                 
 LOCATION         
 SERVICES         appserver, database, phpmyadmin               
 APPSERVER URLS   https://localhost:50853                       
                  http://localhost:50854                        
                  http://website-local.lndo.site/               
                  https://website-local.lndo.site/              
 PHPMYADMIN URLS  http://localhost:50852  
```

## Database access, Source files and Services

### Database access

Access to the instance database can made via the PHPMyAdmin service.

### 4. Importing a database

Instructions form importing a database via the Lando CLI can be found on the [official Lando documentation](https://docs.lando.dev/config/lamp.html#importing-your-database). Alternatively enter the below command via the Lando CLI:

```
lando example-database/lamp.2022-01-18-1642497258.sql.gz
```

### 5. Update absolute paths in the Database

Absolute paths will require amending when creating another site instance. This can be achieved by executing the below SQL queries via the mysql CLI. The below CLI command Drops into a MySQL shell on the Lando database service:

```
lando mysql lamp
```

**Note: Ensure the OLD_URL and NEW_URL variables are amended with the required URL’s**

```
UPDATE wp_options SET option_value = replace(option_value, 'OLD_URL', 'NEW_URL') WHERE option_name = 'home' OR option_name = 'siteurl';
UPDATE wp_posts SET guid = replace(guid, 'OLD_URL','NEW_URL');
UPDATE wp_posts SET post_content = replace(post_content, 'OLD_URL', 'NEW_URL');
UPDATE wp_postmeta SET meta_value = replace(meta_value,'OLD_URL','NEW_URL');
UPDATE wp_options SET option_value = replace(option_value, 'OLD_URL', 'NEW_URL') WHERE option_name = 'home' OR option_name = 'siteurl';
UPDATE wp_posts SET guid = replace(guid, 'OLD_URL','NEW_URL');
UPDATE wp_posts SET post_content = replace(post_content, 'OLD_URL', 'NEW_URL');
UPDATE wp_postmeta SET meta_value = replace(meta_value,'OLD_URL','NEW_URL');
```

### Source files

By default this repository is setup to use WordPress. However any source files can be added to the project.

The Lando configuration in the repo exposes `/public_html` to port 80 so source files should be placed here.

### WordPress Config

A default `wp-config.php` has been added to the `/public_html`. **Do not change or remove this document**.

### Installing WordPress

1. SSH into Lando instance: ```lando ssh```
2. CD into public_html folder: ```cd public_html```
4. Install latest WordpRess core files: ```php wp-cli.phar core download```

### WordPress Admin Login

Username: ```site.admin``` or ```dev@example.com```
Password: ```zh02iI@cH6p*!RUO(v```

### Sending emails from Lando instance

It's recommanded to use a external service like mailtrap.io