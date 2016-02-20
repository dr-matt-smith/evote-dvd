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

<hr>
```
\eVote_dvd_version07_dvdTableRow
```

Up to now the contents of the HTML table of DVD votes has been 'hard coded' into out ```list.php``` template.

Let's now make this a data-driven, dynamic table, so ```list.php``` will be given a PHP array of values, and loop through wrapping HTML tags around the values.

Refactor the ```listAction()``` function in ```mainController.php``` to create an array of our DVD records:

    function listAction()
    {
        $pageTitle = 'DVD listings';
        $listLinkStyle = 'current_page';
    
        $dvds = [];
        $dvds[] = [1, 'Jaws', 'thriller', 10.00, 5, 1, 'starsHalf.png', 'half star'];
        $dvds[] = [2, 'Jaws II', 'thriller', 5.99, 90, 77, 'stars5.png', '5 star'];
        $dvds[] = [3, 'Shrek', 'comedy', 10.00, 50, 5, 'stars3.png', '3 star'];
        $dvds[] = [4, 'Shrek II', 'comedy', 4.99, 0, 0, '', ''];
        $dvds[] = [5, 'Alien', 'scifi', 19.00, 95, 201, 'stars5.png', '5 star'];
    
        require_once __DIR__ . '/../templates/list.php';
    }

And refactor ```list.php``` to loop through this array, extracting the values for each DVD (into meaningfully named variables, and output the values as HTML table cells:

    <?php
        foreach($dvds as $dvd) {
            $id = $dvd[0];
            $title = $dvd[1];
            $category = $dvd[2];
            $price = $dvd[3];
            $voteAverage = $dvd[4];
            $numVotes= $dvd[5];
            $imageFile = $dvd[6];
            $altText = $dvd[7];
            ?>
    
            <tr>
                <td><?= $id ?></td>
                <td><?= $title ?></td>
                <td><?= $category ?></td>
                <td>&euro; <?= $price ?></td>
                <td><?= $voteAverage ?> %</td>
                <td><?= $numVotes ?></td>
                <?php
                if ($numVotes > 0) {
                    print '<td><img src="images/' . $imageFile . '" alt="' . $altText . '"></td>';
                } else {
                    print '<td>(no votes yet)</td>';
                }
                ?>
            </tr>
    
            <?php
        }
    ?>

<hr>
```
\eVote_dvd_version08_associativeArray
```

Rather than relying on the position of a value in the integer-indexed array, let's use meaningful 'keys'. So the ```listAction()``` function in ```mainController.php``` creates an array of arrays - each DVD represented by an associative array with keys like ```id```, ```title``` etc.:

    function listAction()
    {
        $pageTitle = 'DVD listings';
        $listLinkStyle = 'current_page';
    
    
        $dvds = [];
        $dvds[] = [
            'id' => 1,
            'title' => 'Jaws',
            'category' => 'thriller',
            'price' => 10.00,
            'voteAverage' => 5,
            'numVotes' => 1,
            'imageFile' => 'starsHalf.png',
            'altText' => 'half star'
        ];
    
        $dvds[] = [
            'id' => 2,
            'title' => 'Jaws II',
            'category' => 'thriller',
            'price' => 5.99,
            'voteAverage' => 90,
            'numVotes' => 77,
            'imageFile' => 'stars5.png',
            'altText' => '5 star'
        ];
        
   ... and so on ...

While it means more code in function ```listAction()``` in ```mainController.php```, it is less code in our output template  ```list.php```, since we don't need temporary variables for our code to be meaningful:
 
    <?php
        foreach($dvds as $dvd) {
            ?>
    
            <tr>
                <td><?= $dvd['id'] ?></td>
                <td><?= $dvd['title'] ?></td>
                <td><?= $dvd['category'] ?></td>
                <td>&euro; <?= $dvd['price'] ?></td>
                <td><?= $dvd['voteAverage'] ?> %</td>
                <td><?= $dvd['numVotes'] ?></td>
                <?php
                if ($dvd['numVotes'] > 0) {
                    print '<td><img src="images/' . $dvd['imageFile'] . '" alt="' . $dvd['altText'] . '"></td>';
                } else {
                    print '<td>(no votes yet)</td>';
                }
                ?>
            </tr>
    
            <?php
        }
    ?>

<hr>
```
\eVote_dvd_version09_objects
```

A disadvantage of associative arrays is the possibility of misspelling a 'key'. But there is a better solution than associative arrays - let's create a Dvd class, with properties (and getters/setters) for our properties.

In directory ```/src``` create a new file ```Dvd.php``` to hold our new class:

    <?php
    
    class Dvd 
    {
        // implement the class here 
    }
    
Note, in order for function ```listAction()``` in ```mainController.php``` to be able to work with our class, we need to add a ```require_once``` statement for the PHP class declaration to be read by the PHP interpreter:

    // in: src/mainController.php    
    require_once __DIR__ . '/Dvd.php';


In the class we will declare private properties for each Dvd object property:

    <?php
    
    class Dvd 
    {
        private $id;
        private $title;
        private $category;
        private $price;
        private $voteAverage;
        private $numVotes;
        private $imageFile;
        private $altText;
    }

In ```src/Dvd.php``` we also declare getters/setters for the properties (although not a setter for 'id' since that should never change):

        public function getId()
        {
            return $this->id;
        }
    
        public function getTitle()
        {
            return $this->title;
        }
    
        public function getCategory()
        {
            return $this->category;
        }
    
        public function getPrice()
        {
            return $this->price;
        }
    
        public function getVoteAverage()
        {
            return $this->voteAverage;
        }
    
        public function getNumVotes()
        {
            return $this->numVotes;
        }
    
        public function getImageFile()
        {
            return $this->imageFile;
        }
    
        public function getAltText()
        {
            return $this->altText;
        }

Finally in ```src/Dvd.php``` we need to delcare a constructor function, that receives all the pieces of data for a Dvd object as parameters, are stores them in the corresponding properties:

        public function __construct($id, $title, $category, $price, $voteAverage, $numVotes, $imageFile, $altText)
        {
            $this->id = $id;
            $this->title = $title;
            $this->category = $category;
            $this->price = $price;
            $this->voteAverage = $voteAverage;
            $this->numVotes = $numVotes;
            $this->imageFile = $imageFile;
            $this->altText = $altText;
        }

    
In function ```listAction()``` of ```mainController.php``` we can now create an object for each Dvd, and add these to an array of objects:

    function listAction()
    {
        $pageTitle = 'DVD listings';
        $listLinkStyle = 'current_page';
    
        $dvds = [];
        $dvds[] = new Dvd(1, 'Jaws', 'thriller', 10.00, 5, 1, 'starsHalf.png', 'half star');
        $dvds[] = new Dvd(2, 'Jaws II', 'thriller', 5.99, 90, 77, 'stars5.png', '5 star');
        $dvds[] = new Dvd(3, 'Shrek', 'comedy', 10.00, 50, 5, 'stars3.png', '3 star');
        $dvds[] = new Dvd(4, 'Shrek II', 'comedy', 4.99, 0, 0, '', '');
        $dvds[] = new Dvd(5, 'Alien', 'scifi', 19.00, 95, 201, 'stars5.png', '5 star');
    
        require_once __DIR__ . '/../templates/list.php';
    }

Finally, in output template script ```templates/list.php``` we need to loop through the array of objects, extracting each property's value using its public getter method:

    <?php
        foreach($dvds as $dvd) {
            ?>
    
            <tr>
                <td><?= $dvd->getId() ?></td>
                <td><?= $dvd->getTitle() ?></td>
                <td><?= $dvd->getCategory() ?></td>
                <td>&euro; <?= $dvd->getPrice() ?></td>
                <td><?= $dvd->getVoteAverage() ?> %</td>
                <td><?= $dvd->getNumVotes() ?></td>
                <?php
                if ($dvd->getNumVotes() > 0) {
                    print '<td><img src="images/' . $dvd->getImageFile() . '" alt="' . $dvd->getAltText() . '"></td>';
                } else {
                    print '<td>(no votes yet)</td>';
                }
                ?>
            </tr>
    
            <?php
        }
    ?>

<hr>
```
\eVote_dvd_version10_getStarImage
```

That ```if``` statement in our loop is a bit annoying, since we want to keep out output templates as simple as possible (they receive data and display it). I.e. this bit of ```/templates/list.php```:

    <?php
    if ($dvd->getNumVotes() > 0) {
        print '<td><img src="images/' . $dvd->getImageFile() . '" alt="' . $dvd->getAltText() . '"></td>';
    } else {
        print '<td>(no votes yet)</td>';
    }
    ?>

One solution is to move the logic about what to display based on the number of votes as a method class ```/src/Dvd.php```:

        public function getStarImageHTML()
        {
            if ($this->numVotes < 1){
                return '(no votes yet)';
            }
    
            if ($this->voteAverage > 80){
                return  '<img src="images/stars5.png" alt="five starts star">';
            }
    
            if ($this->voteAverage > 60){
                return  '<img src="images/stars4.png" alt="four star">';
            }
    
            if ($this->voteAverage > 45){
                return  '<img src="images/stars3.png" alt="three star">';
            }
    
            if ($this->voteAverage > 25){
                return  '<img src="images/stars2.png" alt="two star">';
            }
    
            if ($this->voteAverage > 10){
                return  '<img src="images/stars1.png" alt="one star">';
            }
    
            // if get here, just give half a star
            return  '<img src="images/starsHalf.png" alt="half star">';
    
        }

Now our template output code is much simpler in ```/templates/list.php```, since outputting the HTML for the star image (or text to say not votes) is simply a call to the objects method ```getStartImageHTML()```:

    <?php
        foreach($dvds as $dvd) {
            ?>
    
            <tr>
                <td><?= $dvd->getId() ?></td>
                <td><?= $dvd->getTitle() ?></td>
                <td><?= $dvd->getCategory() ?></td>
                <td>&euro; <?= $dvd->getPrice() ?></td>
                <td><?= $dvd->getVoteAverage() ?> %</td>
                <td><?= $dvd->getNumVotes() ?></td>
                <td><?= $dvd->getStarImageHTML() ?></td>
            </tr>
    
            <?php
        }
    ?>

NOTE - this isn't ideal, since we have VIEW logic encoded into our class - we can fix this later with a Twig sub-template I think...

<hr>
```
\eVote_dvd_version11_repository
```

At present we are 'hard coding' all the DVD objects in our controller function ```listAction()``` (in file```src/mainController.php```):
    
    function listAction()
    {
        $pageTitle = 'DVD listings';
        $listLinkStyle = 'current_page';
    
        $dvds = [];
        $dvds[] = new Dvd(1, 'Jaws', 'thriller', 10.00, 5, 1);
        etc.
        
But really our controller functions should 'collect' the data from a data source, and process them and pass the appropriate values to our 'view' templates. So let's move the object creation out of our controller function, and into a 'repository' class (that at some later date could be replaced with some separate data source, such as a database...).

We'll create a new class ```src/DvdRepository.php```:

    class DvdRepository
    {
    }
    
This class will have a private list of Dvd objects, and a public constructor that populates this array with our 5 sample DVD objects:

    class DvdRepository
    {
        private $dvds = [];
        
        public function __construct()
        {
            $this->dvds = [];
            $this->dvds[] = new Dvd(1, 'Jaws', 'thriller', 10.00, 5, 1);
            $this->dvds[] = new Dvd(2, 'Jaws II', 'thriller', 5.99, 90, 77);
            $this->dvds[] = new Dvd(3, 'Shrek', 'comedy', 10.00, 50, 5);
            $this->dvds[] = new Dvd(4, 'Shrek II', 'comedy', 4.99, 0, 0);
            $this->dvds[] = new Dvd(5, 'Alien', 'scifi', 19.00, 95, 201);
        }
    }
    
Finally we'll add a public method ```getAll()```, so that other objects can get a copy of this array of Dvds:

    class DvdRepository
    {
        private $dvds = [];
        
        public function __construct()
        {
            $this->dvds = [];
            $this->dvds[] = new Dvd(1, 'Jaws', 'thriller', 10.00, 5, 1);
            $this->dvds[] = new Dvd(2, 'Jaws II', 'thriller', 5.99, 90, 77);
            $this->dvds[] = new Dvd(3, 'Shrek', 'comedy', 10.00, 50, 5);
            $this->dvds[] = new Dvd(4, 'Shrek II', 'comedy', 4.99, 0, 0);
            $this->dvds[] = new Dvd(5, 'Alien', 'scifi', 19.00, 95, 201);
        }
    
        public function getAll()
        {
            return $this->dvds;
        }
    }

Our main controller function for the list action now just has to create an instance of our Repository, and then get all Dvds, before passing them on to the template (```src/mainController.php```):

    function listAction()
    {
        $pageTitle = 'DVD listings';
        $listLinkStyle = 'current_page';
        
        $dvdRepository = new DvdRepository();
        $dvds = $dvdRepository->getAll();
    
        require_once __DIR__ . '/../templates/list.php';
    }

<hr>
```
\eVote_dvd_version12_controllerClass
```

Since we're already using classes and objects, lets turn our list of functions in ```mainController.php``` into a class MainController with public methods. So now we have ```src/MainController.php``` looking as follows:

    <?php
    namespace Itb;
    
    class MainController
    {
    
        public function aboutAction()
        {
            $pageTitle = 'About Us';
            $aboutLinkStyle = 'current_page';
            require_once __DIR__ . '/../templates/about.php';
        }
    
        public function contactAction()
        {
            $pageTitle = 'Contact Us';
            $contactLinkStyle = 'current_page';
            require_once __DIR__ . '/../templates/contact.php';
        }

        etc.
    }
    
Note, we have also introduced the ```namespace``` Itb, so that we can make use of the Composer autoloader to have all classes loaded with a single ```require_once``` statement in ```index.php```. This simple involves the following:

* declare that ```Itb``` namespaced classes can be found in directory ```src``` - we do this in the ```composer.json``` file

    {
      "autoload":{
        "psr-4":{
          "Itb\\":"src/"
        }
      }
    }

* add the ```namespace Itb;``` statement at the beginning of each class declaration file, e.g. in ```src/MainController.php```:

        <?php
        namespace Itb;
        
        class MainController
        {
            ...
        }

* add a statement in ```public/index.php``` to read in the Composer autoloaded

    require_once __DIR__ . '/../vendor/autoload.php';

* in```public/index.php``` we need to create an instance of our ```MainController``` class, and then call methods of this object instance, corresponding to the value of ```$action```:

    require_once __DIR__ . '/../vendor/autoload.php';

    $mainController = new MainController();
    
    if ('about' == $action){
        $mainController->aboutAction();
    etc.

* (optional) have ```use``` statements to save having to write the fully namespaced class name each time, so the first few lines of ```public/index.php``` now look like this:

    <?php
    require_once __DIR__ . '/../vendor/autoload.php';
    
    use Itb\MainController;
    
    // get action GET parameter (if it exists)
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
    
    $mainController = new MainController();
    
    if ('about' == $action){
        $mainController->aboutAction();
    } else if ('contact' == $action) {
        $mainController->contactAction();
    } else if ('list' == $action) {
        $mainController->listAction();
    } else if ('sitemap' == $action) {
        $mainController->sitemapAction();
    } else {
        // default is home page ('index' action)
        $mainController->indexAction();
    }

At present we are 'hard coding' all the DVD objects in our controller function ```listAction()``` (in file```src/mainController.php```):
    
<hr>
```
\eVote_dvd_version13_twigTemplating
```

Since we're using objects and Composer, we can now very easily download 3rd party PHP components, and make use of the powerful Twig templating system.

We get composer to download Twig by simply typing the following at the CLI prompt:

    composer require twig/twig
    
Composer then downloads the details and source code from Packagist/Github, putting it into directory ```/vendor```.

Since we've a bit more setup to do in ```public/index.php``` it now makese sense to move all our setup code into a separate file ```app/setup.php```, so that the core contents of ```public/index.php``` are all about interpreting the user request, and identifying the appropriate controller method to invoke.

So we create this file ```app/setup.php```, which creates the required Twig objects, and states that the Twig templates can be found in ```/templates```:

    <?php
    //----- autoload any classes we are using ------
    require_once __DIR__ . '/../vendor/autoload.php';
    
    // let's simply how we refer to our MainController class
    use Itb\MainController;
    
    //----- Twig setup --------------
    $templatesPath = __DIR__ . '/../templates';
    $loader = new Twig_Loader_Filesystem($templatesPath);
    $twig = new Twig_Environment($loader);
    
    // create an instance of our MainController class, 
    // for use in index.php
    $mainController = new MainController();

Our ```public/index.php``` now just contains the following:

    <?php
    require_once __DIR__ . '/../app/setup.php';
    
    if ('about' == $action){
        $mainController->aboutAction($twig);
    } else if ('contact' == $action) {
        $mainController->contactAction($twig);
    } else if ('list' == $action) {
        $mainController->listAction($twig);
    } else if ('sitemap' == $action) {
        $mainController->sitemapAction($twig);
    } else {
        // default is home page ('index' action)
        $mainController->indexAction($twig);
    }
    
You'll notice we are passing a reference to object $twig to each controller method, that's so they can call on Twig to build the text HTML reponse for us.

The methods in ```src/MainController.php``` now receive an arguement ```$twig```, and each controller's task is to collect any required data, and then call Twig to render the appropriate template with any collected data:

    <?php
    namespace Itb;
    
    class MainController
    {
        public function aboutAction(\Twig_Environment $twig)
        {
            $argsArray = [];
            $template = 'about';
            $htmlOutput = $twig->render($template . '.html.twig', $argsArray);
            print $htmlOutput;
        }

        ...
    }

For most methods, all the information is in the Twig template, so we see above that the ```aboutAction(...)``` method simply passes an empty array to ```$twig```, along with the name of the template ```about.html.twig```.

Our ```listAction(...)``` method has more work to do, since it needs to create a repository and get all the Dvd objects:

        public function listAction(\Twig_Environment $twig)
        {
            $dvdRepository = new DvdRepository();
            $dvds = $dvdRepository->getAll();
    
            $argsArray = [
                'dvds' => $dvds,
            ];
    
            $template = 'list';
            $htmlOutput = $twig->render($template . '.html.twig', $argsArray);
            print $htmlOutput;
        }
        
Finally, we have to write our Twig templates. Each page is based on a master templated we have named ```templates/_base.html.twig```. This declares all the basic HTML for a page, and several 'overridable' Twig 'blocks', such as the page title, where the main body content goes, and navbar link stypes, to allow the current page's navigation link to be specially highlighted:

    <!doctype html>
    <html lang="en">
    <head>
        <title>EVOTE DVD - {% block pageTitle %}{% endblock %}</title>
        <meta charset="utf-8">
        <style>
            @import "css/basic.css";
            @import "css/nav.css";
            @import "css/footer.css";
        </style>
    </head>
    <body>
    
    <header>
        <img src="images/smithit_logo.gif" alt="logo">
    </header>
    
    <nav>
        <ul>
            <li>
                <a href="/" class="{% block indexLinkStyle %}{% endblock %}">Home</a>
            </li>
    
            <li>
                <a href="/?action=about" class="{% block aboutLinkStyle %}{% endblock %}">About Us</a>
            </li>
    
            <li>
                <a href="/?action=list" class="{% block listLinkStyle %}{% endblock %}">DVD ratings</a>
            </li>
    
            <li>
                <a href="/?action=contact" class="{% block contactLinkStyle %}{% endblock %}">Contact Us</a>
            </li>
    
            <li>
                <a href="/?action=sitemap" class="{% block sitemapLinkStyle %}{% endblock %}">Site Map</a>
            </li>
        </ul>
    </nav>
    
    {% block main %}
    {% endblock %}
    
    
    <footer>
        2016 &copy; A Matt Smith productions interntional enterprises limited production
    </footer>
    
    </body>
    </html>
    
Each individual page template simply declares that it subclasses (inherits from) the ```_base.html.twig``` template, and then gives its own content for any blocks whose content is different for that page. For example the ```index.html.twig``` template contains the following:

    {% extends '_base.html.twig' %}
    
    {# ------------------------------------------------- #}
    {% block pageTitle %}Home page{% endblock %}
    
    {# ------------------------------------------------- #}
    {% block indexLinkStyle %}current_page{% endblock %}
    
    {# ------------------------------------------------- #}
    {% block main %}
    
    <h1>
    Welcome to SmithIT Home Page
    </h1>
    
    <p>
    This site offers you the chance to VOTE on your favourite DVD films ...
    </p>
    
    {% endblock %}

As we can see above, Twig templating means that we really can focus on what is particular to a page, leaving all the standard HTML and page layout issues to the parent ```_base.html.twig```.

The only template that has a bit more work to do is for the list of DVDs. So our ```list.html.twig``` template contains the following Twig ```for``` loop:

    {% extends '_base.html.twig' %}
    
    {# ------------------------------------------------- #}
    {% block pageTitle %}List DVDs page{% endblock %}
    
    {# ------------------------------------------------- #}
    {% block listLinkStyle %}current_page{% endblock %}
    
    {# ------------------------------------------------- #}
    {% block main %}
    
    <!-- start table for displaying DVD details -->
    <h2>Lists of DVDs and their average votes</h2>
    
    <table>
        <tr>
            <th> ID </th>
            <th> title </th>
            <th> category </th>
            <th> price </th>
            <th> vote average </th>
            <th> num votes </th>
            <th> stars </th>
        </tr>
    
    {% for dvd in dvds %}
        <tr>
            <td>{{ dvd.id }}</td>
            <td>{{ dvd.title }}</td>
            <td>{{ dvd.category }}</td>
            <td>&euro; {{ dvd.price }}</td>
            <td>{{ dvd.voteAverage }} %</td>
            <td>{{ dvd.numVotes }}</td>
    
            {# have to use 'raw' filter, since we WANT the HTML codes to be HTML and no just characters #}
            <td>{{ dvd.starImageHTML | raw}}</td>
        </tr>
   {% endfor %}
    
    </table>
    
    {% endblock %}

<hr>
```
\eVote_dvd_version14_twigInclude
```

Having HTML output logic built into our Dvd class is not a good idea. So let's move the logic from DVD.getStarImageHTML() into a Twig template. Since we'll be using this logic for EACH Dvd object, we'll put the logic into a separate Twig template, which can be repeatedly 'included', once for each Dvd.

So our list Twig template ```templates/list.html.twig``` now looks as follows:

    {% for dvd in dvds %}
        <tr>
            <td>{{ dvd.id }}</td>
            <td>{{ dvd.title }}</td>
            <td>{{ dvd.category }}</td>
            <td>&euro; {{ dvd.price }}</td>
            <td>{{ dvd.voteAverage }} %</td>
            <td>{{ dvd.numVotes }}</td>
    
            <td>
                {% include '_starImage.html.twig' with {'numVotes':dvd.numVotes, 'voteAverage':dvd.voteAverage} %}
            </td>
    
        </tr>
    {% endfor %}
    
As we can see above, for the last HTML table cell content we are 'including' our partial Twig template named ```_starImage.html.twig```. Also, to make the logic easier, we are passing to this included template the ```numVotes``` and ```voteAverage``` of the current Dvd object, naming these parameters simply ```numVotes``` and ```voteAverage```. We so this making use of the ```with {<paramlist>}``` construct that can be part of a Twig include.

The contents of template ```templates/_starImage.html.twig``` is quite straightforward, it is the same *logic* as we had in the Dvd.getStarImageHTML()``` method, just recoded into Twig statements. Note that since there is no equivalent of a 'return' statement in Twig, we've have to build quite a long ```if-elseif-...-else-endif``` statement block. But the logic is still straightforward to understand:

    {% if numVotes < 1 %}
        (no votes yet)
    {% endif %}
    
    {% if voteAverage > 80 %}
        <img src="images/stars5.png" alt="five starts star">
    {% elseif voteAverage > 60 %}
        <img src="images/stars4.png" alt="four star">
    {% elseif voteAverage > 45 %}
        <img src="images/stars3.png" alt="three star">
    {% elseif voteAverage > 25 %}
        <img src="images/stars2.png" alt="two star">
    {% elseif voteAverage > 10 %}
        <img src="images/stars1.png" alt="one star">
    {% elseif voteAverage > 0 %}
        <img src="images/starsHalf.png" alt="half star">
    {% endif %}



todo
-------

* get DB PDO connection example working 
* add in combo drop down menu for AMIN page (so user not asked to TYPE IN an ID for an existing record...)


Author
-------------------------------------------------------

Dr Matt Smith,
www.mattsmithdev.com

Senior Lecturer in Computing
Institute of Technology Blanchardstown
Dublin, Ireland
www.itb.ie
