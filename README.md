eVote_dvd Example projects
===========================

About
-------------------------------------------------------
This is a sequence of progressive enhancements, taking a static HTML site
into an authenticated modern MVC website


Manifest
-------------------------------------------------------

<hr>
```
\eVote_dvd_version00_html
```

basic flat HTML verson of the website

<hr>
```
\eVote_dvd_version01_php
```

just changed the ```.html``` files to end in ```.php```

<hr>
```
\eVote_dvd_version02_frontController
```

The following refactoring:

* created folder ```/public``` to contain public files (css,images etc.) 

* and a single 'front controller' ```index.php``` file, which bases its action on the GET parameter 'action'

* individual page content has been moved into directory ```templates```, e.g. ```templates/about.php``` sitemap.php etc.

* use of ```require_once``` is used to build the appropriate HTML text content for the GET action

<hr>
```
\eVote_dvd_version03_headerFooter
```

First attempt to move HTML code that is repeated on every page into separate ```.inc.php``` files:

* ```templates/header1.inc.php```
* ```templates/header2.inc.php```
* ```templates/footer.inc.php```


The following refactoring:

* created ```templates/header1.inc.php``` containing the HTML code that appears before the ```<title>``` element
* created ```templates/header2.inc.php``` containing the HTML code that appears after the ```<title>``` element (and before the ```<nav>``` element
* each page template outputs ```header1.inc.php``` file contents via a ```require_once``` statement
* each page template then prints out its page-specific title, e.g. ```print '<title>EVOTE DVD - about page</title>';```
* each page template outputs ```header2.inc.php``` file contents via a ```require_once``` statement
* each page template then declares template text for its page-specific nav
* each page template then declares template text for its page-specific content 
* each page template finally outputs ```footer.inc.php``` file contents via a ```require_once``` statement


<hr>
```
\eVote_dvd_version04_titleInHeader
```

Combination of ```header1.inc.php``` and ```header2.inc.php``` into a single template, which also has the HTML ```<title>``` elemement. This is achieved by the controller action function defining a PHP variable ```$title```, whose value is output in the HTML title using the PHP short output tags, e.g.:

```
<title>EVOTE DVD - <?= $pageTitle ?></title>
```

So each pages template now just does the following:

* outputs ```header.inc.php``` file contents via a ```require_once``` statement
* declares template text for its page-specific nav
* declares template text for its page-specific content 
* each page template finally outputs ```footer.inc.php``` file contents via a ```require_once``` statement

<hr>

```
\eVote_dvd_version05_navStyle
```

Improvement to move duplicated navigation code into an includable file ```nav.inc.php``` file.
What is different for each page in the navigation code block is the link to have the CSS style ```current_page```. The refactoring to reduce code duplication is to define 5 PHP variables (one for each navbar link: about / contact / index / list / sitemap).

The code in ```nav.inc.php``` creates a CSS class variable containing an empty string, if no such variable is found. But if the controller action *has* defined a nav link variable (containing ```current_page```), then that value is let unchanged.

Thus out controller functions now define 2 variables, one for the page title and one for the nav link to be highlighted:

```
function aboutAction()
{
    $pageTitle = 'About Us';
    $aboutLinkStyle = 'current_page';
    require_once __DIR__ . '/../templates/about.php';
}
```

File ```nav.inc.php``` has code to declare empty string CSS style varaibles if they have not been declared by the controller action:

    if (empty($indexLinkStyle)){
        $indexLinkStyle = '';
    }
    
    if (empty($aboutLinkStyle)){
        $aboutLinkStyle = '';
    }
    
    if (empty($listLinkStyle)){
        $listLinkStyle = '';
    }
    
    if (empty($contactLinkStyle)){
        $contactLinkStyle = '';
    }
    
    if (empty($sitemapLinkStyle)){
        $sitemapLinkStyle = '';
    }

Finally, the navigation HTMl block in ```nav.inc.php``` outputs the navlink style variable values for the CSS ```class``` attribute for each nav link (one of which should be ```current_page```):

    <nav>
        <ul>
            <li>
                <a href="index.php" class="<?= $indexLinkStyle ?>">Home</a>
            </li>
    
            <li>
                <a href="index.php?action=about" class="<?= $aboutLinkStyle ?>">About Us</a>
            </li>

    etc.

<hr>
```
\eVote_dvd_version06_htaccess
```

We can simplify the URL that is used, by asking the Apache web server to 'rewrite' the URL, prefixing ```index.php``` to the beginning of each request that cannot be resolved. I.e, if an existing file or directory is requested (e.g. style.css or images/) then that will be served. But if a file or directory cannot be found that corresponds to a request then we can ask Apache to previx ```indxex.php``` to the beginnning, and then process the request. Since we have an ```index.php``` file, we know that all requests will be processed.

Note, this is the beginning of moving towards meangingful, human-readble URLs that relate to the 'action' the user is requesting, and NOT a direct correspondance to a script file on the server. E.g. if a user wants to see the news item with ID=123, the URL might be ```/news/123```. To do this we need to have a 'routing' subsystem (perhaps we'll do that in a later step). But at this stage we can simplify things to have a URL of ```?action=list``` rather than ```index.php?action=list```. 

Apache looks for the special file ```.htaccess``` for any rules to be executed before processing the request and deciding which script to run etc.

File ```public/.htaccess``` contains the following:

    <IfModule mod_rewrite.c>
        RewriteEngine On
        RewriteCond %{REQUEST_FILENAME} !-f
        RewriteCond %{REQUEST_FILENAME} !-d
        RewriteRule (.+) index.php?p=$1 [QSA,L]
    </IfModule>

This file can be thought of as stating the following:

* turn on URL re-writing
* if a file cannot be found to match the URL, go to the next rule
* if a directory cannot be found to match the URL, go to the next rule
* prefix ```index.php``` to the beginning of the request (if it isn't already present)



Author
-------------------------------------------------------

Dr Matt Smith,
www.mattsmithdev.com

Senior Lecturer in Computing
Institute of Technology Blanchardstown
Dublin, Ireland
www.itb.ie
