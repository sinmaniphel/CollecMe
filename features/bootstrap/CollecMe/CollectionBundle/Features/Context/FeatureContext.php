<?php
namespace CollecMe\CollectionBundle\Features\Context;

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


    private $said;
    /**
     * @When I look at the navigation bar
     */
    public function iLookAtTheNavigationBar()
    {
        $page = $this->session->getPage();

        $this->said = $page->findById('my-nav-left');
        if($this->said == null) {
            echo $page->getHtml();
            throw new \Exception('Cannot find nav bar in page ');
        }


    }

    /**
     * @Then there should be a menu item to access my collections
     */
    public function thereShouldBeAMenuItemToAccessMyCollections()
    {
        if(!$this->said->has('css','li#my_collections')) {
            throw new \Exception('could not find the collections item');
        }
        $this->said = $this->said->find('css','#my_collections');
    }

    /**
     * @Then said item should not have any sub item
     */
    public function saidItemShouldNotHaveAnySubItem()
    {
        if($this->said->has('css','ul')) {
            throw new \Exception('there should not a sub item to '.$this->said->getTagName());
        }
    }

    /**
     * @Given I have a number of collections
     */
    public function iHaveANumberOfCollections()
    {
        // Skip that, there is no way to check it at that time
    }

   
    /**
     * @Then that menu item should redirect me to a page listing my collections
     */
    public function thatMenuItemShouldRedirectMeToAPageListingMyCollections()
    {
        $link = $this->said->find('xpath','a');
        if(null==$link)
        {
            throw new \Exception('there should be a link associated to the menu item');
        }
        $href = $link->getAttribute('href');
        
        if(0!==strcmp('collection/list',$href)) {
            throw new \Exception("expected link collection/list and foud ".$href);
        }
    }

    /**
     * @Then there should be a sub menu item for each collection
     */
    public function thereShouldBeASubMenuItemForEachCollection()
    {
        if(!$this->said->has('css','ul')) {
            throw new \Exception('there should a sub item to '.$this->said->getTagName());
        }

    }

    /**
     * @Then the sub menu item should redirect me to a corresponding collection
     */
    public function theSubMenuItemShouldRedirectMeToACorrespondingCollection()
    {
        throw new PendingException();
    }

    
    
   
  
   
    /**
     * @When I am on the page listing my collections
     */
    public function iAmOnThePageListingMyCollections()
    {
        $this->session->visit("http://localhost:8000/collection/list");
        if($this->session->getStatusCode()!=200) {
            throw new \Exception('Expected status 200, got '.$this->session->getStatusCode());
        }
    }

    /**
     * @Then there should be one summarized content for each collection
     */
    public function thereShouldBeOneSummarizedContentForEachCollection()
    {
        throw new PendingException();
    }

    /**
     * @Then the summarized content should include a picture
     */
    public function theSummarizedContentShouldIncludeAPicture()
    {
        throw new PendingException();
    }

    /**
     * @Then the summarized content should include a rich text description
     */
    public function theSummarizedContentShouldIncludeARichTextDescription()
    {
        throw new PendingException();
    }

    /**
     * @Then there should be a button prompting me to add a new collection
     */
    public function thereShouldBeAButtonPromptingMeToAddANewCollection()
    {
        throw new PendingException();
    }

    /**
     * @When said button should direct me to a page allowing me to add a new collection
     */
    public function saidButtonShouldDirectMeToAPageAllowingMeToAddANewCollection()
    {
        throw new PendingException();
    }

}
