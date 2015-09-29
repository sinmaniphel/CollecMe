<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Mink\Driver\GoutteDriver;
/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context, SnippetAcceptingContext
{


    private $driver;
    private $session;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
        // Choose a Mink driver. More about it in later chapters.
        $this->driver = new GoutteDriver();

        $this->session = new \Behat\Mink\Session($this->driver);

        // start the session
        $this->session->start();
    }

    /**
     * @Given that I am logged in as user :arg1 with password :arg
     */
    public function thatIAmLoggedInAsUserWithPassword($arg1, $arg2)
    {
        $this->session->visit("http://localhost:8000/login");
        $page = $this->session->getPage();

        // get the form
        $form = $page->findById("loginForm");
        $login = $page->findById("username");
        $password = $page->findById("password");
        $submit = $page->findButton("submit");
        
        if($page == null) {
            throw new \Exception('Could not get the page');
        }
        if($form == null) {
            echo $page->getHtml();
            throw new \Exception('Could not get the form');
            
        }

        $login->setValue($arg1);
        $password->setValue($arg2);
        $form->submit();
        
    }


    private $currentElement;
    /**
     * @When I look at the navigation bar
     */
    public function iLookAtTheNavigationBar()
    {
        $page = $this->session->getPage();

        $this->currentElement = $page->findById('my-nav-left');
        if($this->currentElement == null) {
            echo $page->getHtml();
            throw new \Exception('Cannot find nav bar in page ');
        }

        
    }

    /**
     * @Then there should be a menu item to access my collections
     */
    public function thereShouldBeAMenuItemToAccessMyCollections()
    {
        if(!$this->currentElement->has('css','#my_collections')) {
            throw new \Exception('could not find the collections item');
        }
    }

    /**
     * @Then said item should not have any sub item
     */
    public function saidItemShouldNotHaveAnySubItem()
    {
        throw new PendingException();
    }

    /**
     * @Given I have a number of collections
     */
    public function iHaveANumberOfCollections()
    {
        throw new PendingException();
    }

    /**
     * @Then there should be an item for my collections
     */
    public function thereShouldBeAnItemForMyCollections()
    {
        throw new PendingException();
    }

    /**
     * @Then that menu item should redirect me to a page listing my collections
     */
    public function thatMenuItemShouldRedirectMeToAPageListingMyCollections()
    {
        throw new PendingException();
    }

    /**
     * @Then there should be a sub menu item for each collection
     */
    public function thereShouldBeASubMenuItemForEachCollection()
    {
        throw new PendingException();
    }

    /**
     * @Then the sub menu item should redirect me to a corresponding collection
     */
    public function theSubMenuItemShouldRedirectMeToACorrespondingCollection()
    {
        throw new PendingException();
    }

}
