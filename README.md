eVote_dvd Example projects
===========================

About
-------------------------------------------------------
This is a sequence of progressive enhancements, taking a static HTML site
into an authenticated modern MVC website


Manifest
-------------------------------------------------------
```\eVote_dvd_version0_html```

basic flat HTML verson of the website

```\eVote_dvd_version1_php```

just changed the .html files to end in .php

```\eVote_dvd_version2_frontController```

created folder 'public' to contain public files (css,images etc.) 
and a single 'front controller' index.php file
which bases its action on the GET pamater 'action'
indivual page content has been moved into templates/about.php sitemap.php etc.
and use of 'require_once' is used to build the appropriate HTML text content for the GET action


Author
-------------------------------------------------------

Dr Matt Smith,
www.mattsmithdev.com

Senior Lecturer in Computing
Institute of Technology Blanchardstown
Dublin, Ireland
www.itb.ie
