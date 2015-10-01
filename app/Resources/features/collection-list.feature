Feature: list user collections
  In order to see all my collections
  As a logged in user
  I need to have a mechanism to list my collections

  Scenario: access collections page from navigation bar
    Given that I am logged in as user "admin" with password "admin"
    When I look at the navigation bar
    Then there should be a menu item to access my collections

  Scenario: no existing collection
    Given that I am logged in as user "readonly" with password "readonly"
    When I look at the navigation bar
    Then there should be a menu item to access my collections
    But said item should not have any sub item

  Scenario: list existing collections in the navigation bar
    Given that I am logged in as user "admin" with password "admin"
    Given I have a number of collections
    When I look at the navigation bar
    Then there should be a menu item to access my collections
    And that menu item should redirect me to a page listing my collections
    And there should be a sub menu item for each collection
    And the sub menu item should redirect me to a corresponding collection


  Scenario: show collections on a collection page
    Given that I am logged in as user "admin" with password "admin"
    When I am on the page listing my collections
    Then there should be one summarized content for each collection
    And the summarized content should include a picture
    And the summarized content should include a rich text description

  Scenario: Add collection button
    Given that I am logged in as user "admin" with password "admin"
    When I am on the page listing my collections
    Then there should be a button prompting me to add a new collection
    And said button should direct me to a page allowing me to add a new collection
